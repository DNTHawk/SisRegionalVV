<?php
error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idFuncao = (isset($_POST["idFuncao"]) && $_POST["idFuncao"] != null) ? $_POST["idFuncao"] : "";
    $nomeFuncao = (isset($_POST["nomeFuncao"]) && $_POST["nomeFuncao"] != null) ? $_POST["nomeFuncao"] : "";
} else if (!isset($idFuncao)) {
    $idFuncao = (isset($_GET["idFuncao"]) && $_GET["idFuncao"] != null) ? $_GET["idFuncao"] : "";
}

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nomeFuncao != "") {
    try {
        if ($idFuncao != "") {
            $stmt = $conexao->prepare("UPDATE funcao  SET nomeFuncao=? WHERE idFuncao = ?");
            $stmt->bindParam(2, $idFuncao);
        } else {
            $stmt = $conexao->prepare("INSERT INTO funcao (nomeFuncao) VALUES (?)");
        }
        $stmt->bindParam(1, $nomeFuncao);
        

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo"<script language='javascript' type='text/javascript'>alert('Dados cadastrados com sucesso!');window.location.href='cad_funcao.php';</script>";
                $idFuncao = null;
                $nomeFuncao = null;
                
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idFuncao != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM funcao WHERE idFuncao = ?");
        $stmt->bindParam(1, $idFuncao, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idFuncao = $rs->idFuncao;
            $nomeFuncao = $rs->nomeFuncao;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}else{
    $nomeFuncao = null;
    
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idFuncao != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM funcao WHERE idFuncao = ?");
        $stmt->bindParam(1, $idFuncao, PDO::PARAM_INT);
        if ($stmt->execute()) {
             echo"<script language='javascript' type='text/javascript'>alert('Erro ao lançar Feedback!');window.location.href='cad_funcao.php';</script>";
            $idFuncao = null;
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
    <div class="row">
            <div class="col-md-12">
                <h3>Cadastro de Funções</h3>
            </div>
        </div>
    <form action="?act=save" method="POST" name="form1">
        <input type="hidden" name="idFuncao" <?php
            if (isset($idFuncao) && $idFuncao != null || $idFuncao != "") { echo "value=\"{$idFuncao}\""; }?> />
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nomeFuncao">Função:</label>
                    <input type="text" name="nomeFuncao" class="form-control" required <?php
                            if (isset($nomeFuncao) && $nomeFuncao != null || $nomeFuncao != "") { echo "value=\"{$nomeFuncao}\"";} ?> />
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
    <hr>
    <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <th>Função</th>
                        <th>Ações</th>
                    </tr>
                    <?php 
                        try{
                            $stmt = $conexao->prepare("SELECT * FROM funcao order by idFuncao");
                            if ($stmt->execute()) {
                                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    echo "<tr>";
                                        echo "<td>".$rs->idFuncao
                                            ."</td><td>".$rs->nomeFuncao
                                            ."</td><td><center><a href=\"?act=upd&idFuncao=".$rs->idFuncao."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                            ."&nbsp;"
                                            ."<a href=\"?act=del&idFuncao=".$rs->idFuncao."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
                                    echo "</tr>";
                                }
                            } else {
                            echo "Erro: Não foi possível recuperar os dados do banco de dados";
                            }
                        } catch (PDOException $erro) {
                            echo "Erro: ".$erro->getMessage();
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php }
else if ($_SESSION['user_funcao'] == '2') { 
    include_once("menu_gerente.php");
    include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '3') { 
    include_once("menu_cal.php");
    include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '4') { 
    include_once("menu_regional.php");
    include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '5') { 
    include_once("menu_regional_car.php");
    include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '6') { 
    include_once("menu_consultorTreinamento.php");
    include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '7') { 
    include_once("menu_consultorTreinamentoRegional.php");
    include_once("naoPermissao.php");
} else{}

include_once("rodape.php");
?>
</div>


