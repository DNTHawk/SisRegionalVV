<?php
error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php'; 


$matriculaAnotacao = $_SESSION['user_matricula'];


try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

try {
    $stmt = $conexao->prepare("SELECT * FROM anotacao WHERE matricula = '$matriculaAnotacao'");
    $stmt->bindParam(1, $idAnotacao, PDO::PARAM_INT);
    if ($stmt->execute()) {
        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            $idAnotacao = $rs->idAnotacao;
            $matricula = $rs->matricula;
            $anotacao = $rs->anotacao;
        }
    } else {
        echo "Erro: Não foi possível recuperar os dados do banco de dados";
    }
} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}

if ($idAnotacao != NULL || $idAnotacao != '') {
    
}else{
    $idAnotacao = null;
    $matricula = null;
    $anotacao = null;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idAnotacao = (isset($_POST["idAnotacao"]) && $_POST["idAnotacao"] != null) ? $_POST["idAnotacao"] : "";
    $matricula = $matriculaAnotacao;
    $anotacao = (isset($_POST["anotacao"]) && $_POST["anotacao"] != null) ? $_POST["anotacao"] : "";
    
} else if (!isset($idAnotacao)) {
    $idAnotacao = (isset($_GET["idAnotacao"]) && $_GET["idAnotacao"] != null) ? $_GET["idAnotacao"] : "";
}


if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $matricula != "") {
    try {
        if ($idAnotacao != "") {
            $stmt = $conexao->prepare("UPDATE anotacao  SET matricula=?, anotacao=? WHERE idAnotacao = ?");
            $stmt->bindParam(3, $idAnotacao);
        } else {
            $stmt = $conexao->prepare("INSERT INTO anotacao (matricula, anotacao) VALUES (?, ?)");
        }
        $stmt->bindParam(1, $matricula);
        $stmt->bindParam(2, $anotacao);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo"<script language='javascript' type='text/javascript'>alert('FCA cadastrado com sucesso!');window.location.href='anotacao.php';</script>";
                $idAnotacao = null;
                $matricula = null;
                $anotacao = null;
            } else {
                echo"<script language='javascript' type='text/javascript'>alert('Erro ao cadastrar FCA!');window.location.href='anotacao.php';</script>";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idAnotacao != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM anotacao WHERE idAnotacao = ? AND matricula = '$matriculaAnotacao'");
        $stmt->bindParam(1, $idAnotacao, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idAnotacao = $rs->idAnotacao;
            $matricula = $rs->matricula;
            $anotacao = $rs->anotacao;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idAnotacao != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM anotacao WHERE idAnotacao = ?");
        $stmt->bindParam(1, $idAnotacao, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo"<script language='javascript' type='text/javascript'>alert('FCA excluido com sucesso!');window.location.href='anotacao.php';</script>";
            $idAnotacao = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
?>
<div class="carregando" id="carregando"></div>
<div class="corpo" id="corpo">
<?php

if ($_SESSION['user_funcao'] == '1'){
    include_once("menu_administrador.php");
    ?>
    <div class="container">
        <div style="margin-bottom: 10px" class="row">
            <div class="col-md-3">
                <h3>Anotações</h3>
            </div>
        </div>
        <form action="?act=save" method="POST" name="form1">
            <div class="row">
                <input type="hidden" name="idAnotacao" <?php if (isset($idAnotacao) && $idAnotacao != null || $idAnotacao != "") {echo "value=\"{$idAnotacao}\""; }?> />
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" name="anotacao" rows="20" placeholder="Digite a sua Anotações..." d><?php if (isset($anotacao) && $anotacao != null || $anotacao != "") {echo ($anotacao); }?></textarea> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Salvar" class="btn btn-primary" />
                    <input type="reset" value="Limpar" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
    <?php 
    }
    else if ($_SESSION['user_funcao'] == '2') { 
        include_once("menu_gerente.php");
        ?>
    <div class="container">
        <div style="margin-bottom: 10px" class="row">
            <div class="col-md-3">
                <h3>Anotações</h3>
            </div>
        </div>
        <form action="?act=save" method="POST" name="form1">
            <div class="row">
                <input type="hidden" name="idAnotacao" <?php if (isset($idAnotacao) && $idAnotacao != null || $idAnotacao != "") {echo "value=\"{$idAnotacao}\""; }?> />
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" name="anotacao" rows="20" placeholder="Digite a sua Anotações..."><?php if (isset($anotacao) && $anotacao != null || $anotacao != "") {echo ($anotacao); }?></textarea> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Salvar" class="btn btn-primary" />
                    <input type="reset" value="Limpar" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
    <?php
    }
    else if ($_SESSION['user_funcao'] == '3') { 
        include_once("menu_cal.php");
        ?>
    <div class="container">
        <div style="margin-bottom: 10px" class="row">
            <div class="col-md-3">
                <h3>Anotações</h3>
            </div>
        </div>
        <form action="?act=save" method="POST" name="form1">
            <div class="row">
                <input type="hidden" name="idAnotacao" <?php if (isset($idAnotacao) && $idAnotacao != null || $idAnotacao != "") {echo "value=\"{$idAnotacao}\""; }?> />
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" name="anotacao" rows="20" placeholder="Digite a sua Anotações..." ><?php if (isset($anotacao) && $anotacao != null || $anotacao != "") {echo ($anotacao); }?></textarea> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Salvar" class="btn btn-primary" />
                    <input type="reset" value="Limpar" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
    <?php
    }
    else if ($_SESSION['user_funcao'] == '4') { 
        include_once("menu_regional.php");
        ?>
    <div class="container">
        <div style="margin-bottom: 10px" class="row">
            <div class="col-md-3">
                <h3>Anotações</h3>
            </div>
        </div>
        <form action="?act=save" method="POST" name="form1">
            <div class="row">
                <input type="hidden" name="idAnotacao" <?php if (isset($idAnotacao) && $idAnotacao != null || $idAnotacao != "") {echo "value=\"{$idAnotacao}\""; }?> />
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" name="anotacao" rows="20" placeholder="Digite a sua Anotações..." ><?php if (isset($anotacao) && $anotacao != null || $anotacao != "") {echo ($anotacao); }?></textarea> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Salvar" class="btn btn-primary" />
                    <input type="reset" value="Limpar" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
    <?php
    }
    else if ($_SESSION['user_funcao'] == '5') { 
        include_once("menu_car.php");
        ?>
    <div class="container">
        <div style="margin-bottom: 10px" class="row">
            <div class="col-md-3">
                <h3>Anotações</h3>
            </div>
        </div>
        <form action="?act=save" method="POST" name="form1">
            <div class="row">
                <input type="hidden" name="idAnotacao" <?php if (isset($idAnotacao) && $idAnotacao != null || $idAnotacao != "") {echo "value=\"{$idAnotacao}\""; }?> />
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" name="anotacao" rows="20" placeholder="Digite a sua Anotações..." ><?php if (isset($anotacao) && $anotacao != null || $anotacao != "") {echo ($anotacao); }?></textarea> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Salvar" class="btn btn-primary" />
                    <input type="reset" value="Limpar" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
    <?php
    }
    else if ($_SESSION['user_funcao'] == '6') { 
        include_once("menu_consultorTreinamento.php");
        ?>
    <div class="container">
        <div style="margin-bottom: 10px" class="row">
            <div class="col-md-3">
                <h3>Anotações</h3>
            </div>
        </div>
        <form action="?act=save" method="POST" name="form1">
            <div class="row">
                <input type="hidden" name="idAnotacao" <?php if (isset($idAnotacao) && $idAnotacao != null || $idAnotacao != "") {echo "value=\"{$idAnotacao}\""; }?> />
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" name="anotacao" rows="20" placeholder="Digite a sua Anotações..." ><?php if (isset($anotacao) && $anotacao != null || $anotacao != "") {echo ($anotacao); }?></textarea> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Salvar" class="btn btn-primary" />
                    <input type="reset" value="Limpar" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
    <?php
    }
    else if ($_SESSION['user_funcao'] == '7') { 
        include_once("menu_consultorTreinamentoRegional.php");
        ?>
    <div class="container">
        <div style="margin-bottom: 10px" class="row">
            <div class="col-md-3">
                <h3>Anotações</h3>
            </div>
        </div>
        <form action="?act=save" method="POST" name="form1">
            <div class="row">
                <input type="hidden" name="idAnotacao" <?php if (isset($idAnotacao) && $idAnotacao != null || $idAnotacao != "") {echo "value=\"{$idAnotacao}\""; }?> />
                <div class="col-md-12">
                    <div class="form-group">
                        <textarea class="form-control" name="anotacao" rows="20" placeholder="Digite as suas Anotações..." ><?php if (isset($anotacao) && $anotacao != null || $anotacao != "") {echo ($anotacao); }?></textarea> 
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Salvar" class="btn btn-primary" />
                    <input type="reset" value="Limpar" class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>
    <?php
    } else{}

    include_once("rodape.php");
    ?>
</div>