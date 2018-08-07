<?php
error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php'; 

$parametro = filter_input(INPUT_POST, "parametro");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idFilial = (isset($_POST["idFilial"]) && $_POST["idFilial"] != null) ? $_POST["idFilial"] : "";
    $filial = (isset($_POST["filial"]) && $_POST["filial"] != null) ? $_POST["filial"] : "";
    $cidade = (isset($_POST["cidade"]) && $_POST["cidade"] != null) ? $_POST["cidade"] : "";
    $endereco = (isset($_POST["endereco"]) && $_POST["endereco"] != null) ? $_POST["endereco"] : "";
    $bairro = (isset($_POST["bairro"]) && $_POST["bairro"] != null) ? $_POST["bairro"] : "";
    $cep = (isset($_POST["cep"]) && $_POST["cep"] != null) ? $_POST["cep"] : "";
    $numCorporativo = (isset($_POST["numCorporativo"]) && $_POST["numCorporativo"] != null) ? $_POST["numCorporativo"] : "";
    $numRamal = (isset($_POST["numRamal"]) && $_POST["numRamal"] != null) ? $_POST["numRamal"] : "";
} else if (!isset($idFilial)) {
    $idFilial = (isset($_GET["idFilial"]) && $_GET["idFilial"] != null) ? $_GET["idFilial"] : "";
}

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $filial != "") {
    try {
        if ($idFilial != "") {
            $stmt = $conexao->prepare("UPDATE filial  SET filial=?, cidade=?, endereco=?, bairro=?, cep=?, numCorporativo=?, numRamal=? WHERE idFilial = ?");
            $stmt->bindParam(8, $idFilial);
        } else {
            $stmt = $conexao->prepare("INSERT INTO filial (filial, cidade, endereco, bairro, cep, numCorporativo, numRamal) VALUES (?, ?, ?, ?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $filial);
        $stmt->bindParam(2, $cidade);
        $stmt->bindParam(3, $endereco);
        $stmt->bindParam(4, $bairro);
        $stmt->bindParam(5, $cep);
        $stmt->bindParam(6, $numCorporativo);
        $stmt->bindParam(7, $numRamal);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
               echo"<script language='javascript' type='text/javascript'>alert('Dados cadastrado com sucesso!');window.location.href='cad_filial.php';</script>";
               $idFilial = null;
               $filial = null;
               $cidade = null;
               $endereco = null;
               $bairro = null;
               $cep = null;
               $numCorporativo = null;
               $numRamal = null;
               
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

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idFilial != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM filial, cidade WHERE filial.cidade = cidade.idCidade AND idFilial = ?");
        $stmt->bindParam(1, $idFilial, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idFilial = $rs->idFilial;
            $filial = $rs->filial;
            $cidade = $rs->cidade;
            $endereco = $rs->endereco;
            $bairro = $rs->bairro;
            $cep = $rs->cep;
            $numCorporativo = $rs->numCorporativo;
            $numRamal = $rs->numRamal;
            $nomeCidade = $rs->nomeCidade;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}else{
    $filial = null;
    $cidade = null;
    $endereco = null;
    $bairro = null;
    $cep = null;
    $numCorporativo = null;
    $numRamal = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idFilial != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM filial WHERE idFilial = ?");
        $stmt->bindParam(1, $idFilial, PDO::PARAM_INT);
        if ($stmt->execute()) {
           echo"<script language='javascript' type='text/javascript'>alert('Registro foi excluido com sucesso!');window.location.href='cad_filial.php';</script>";
           $idFilial = null;
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
                <h3>Cadastro de Filiais</h3>
            </div>
        </div>
        <form action="?act=save" method="POST" name="form1">
            <input type="hidden" name="idFilial" <?php
            if (isset($idFilial) && $idFilial != null || $idFilial != "") {
                echo "value=\"{$idFilial}\"";
            }
            ?> />
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="filial">Número Filial:*</label>
                        <input type="text" name="filial" class="form-control" required <?php
                        if (isset($filial) && $filial != null || $filial != "") { echo "value=\"{$filial}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cidade">Cidade:</label>
                        <?php
                        $sql = "SELECT * from cidade order by nomeCidade asc";
                        $stm = $conexao->prepare($sql);
                        $stm->execute();
                        $cidades = $stm->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <select class="form-control" name="cidade" id="cidade" required>
                        <?php 
                            if (isset($cidade) && $cidade != null || $cidade != ""){?> <option value="<?=$cidade?>"><?=$nomeCidade?></option> <?php
                            }else{
                                ?><option value="">Cidade:</option><?php
                            }
                        ?>
                        <?php foreach($cidades as $cidade):?>
                            <option value=<?=$cidade->idCidade?>><?=$cidade->nomeCidade?></option>
                        <?php endforeach;?>
                        </select>
                        <span class='msg-erro msg-status'></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="endereco">Endereço:*</label>
                        <input type="text" name="endereco" class="form-control" required <?php
                        if (isset($endereco) && $endereco != null || $endereco != "") { echo "value=\"{$endereco}\"";} ?> /> 
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="bairro">Bairro:*</label>
                        <input type="text" name="bairro" class="form-control" required <?php
                        if (isset($bairro) && $bairro != null || $bairro != "") { echo "value=\"{$bairro}\"";} ?> />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cep">CEP:*</label>
                        <input type="text" name="cep" class="form-control cep-mask" placeholder="Ex.: 00000-000" required <?php
                        if (isset($cep) && $cep != null || $cep != "") { echo "value=\"{$cep}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="numCorporativo">Celular Corporativo:*</label>
                        <input type="text" name="numCorporativo" class="form-control cel-sp-mask" placeholder="Ex.: (00) 00000-0000" maxlength="14" autocomplete="off" required <?php
                        if (isset($numCorporativo) && $numCorporativo != null || $numCorporativo != "") { echo "value=\"{$numCorporativo}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="numRamal">Número Ramal:*</label>
                        <input type="text" name="numRamal" class="form-control" required <?php
                        if (isset($numRamal) && $numRamal != null || $numRamal != "") { echo "value=\"{$numRamal}\"";} ?> />
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
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="parametro">Filial:</label>
                        <select class="form-control" name="parametro">
                            <option value="">Todas as Filiais</option>
                            <option value="189">189</option>
                            <option value="311">311</option>
                            <option value="1124">1124</option>
                            <option value="1137">1137</option>
                            <option value="1202">1202</option>
                            <option value="1208">1208</option>
                            <option value="1278">1278</option>
                            <option value="1316">1316</option>
                            <option value="1338">1338</option>
                            <option value="1397">1397</option>
                            <option value="1529">1529</option>
                            <option value="1548">1548</option>
                            <option value="1754">1754</option>
                            <option value="1765">1765</option>
                            <option value="1777">1777</option>
                            <option value="1830">1830</option>
                            <option value="1906">1906</option>
                            <option value="1909">1909</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <input style="margin-top: 25px;" type="submit" class="btn btn-primary btn-block" value="Filtrar">
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Filial</th>
                            <th>Cidade</th>
                            <th>Endereço</th>
                            <th>Bairro</th>
                            <th>CEP</th>
                            <th>Número Corporativo</th>
                            <th>Número Ramal</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                        if($parametro){
                            try {
                                $stmt = $conexao->prepare("SELECT * FROM filial, cidade WHERE filial.cidade = cidade.idCidade AND filial like '$parametro%' order by idFilial");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->filial
                                        ."</td><td>".$rs->nomeCidade
                                        ."</td><td>".$rs->endereco
                                        ."</td><td>".$rs->bairro
                                        ."</td><td>".$rs->cep
                                        ."</td><td>".$rs->numCorporativo
                                        ."</td><td>".$rs->numRamal
                                        ."</td><td><center><a href=\"?act=upd&idFilial=".$rs->idFilial."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFilial=".$rs->idFilial."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                }
                            }catch (PDOException $erro) {
                                echo "Erro: ".$erro->getMessage();
                            }  
                        }else {
                            try {
                                $stmt = $conexao->prepare("SELECT * FROM filial, cidade WHERE filial.cidade = cidade.idCidade order by idFilial");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->filial
                                        ."</td><td>".$rs->nomeCidade
                                        ."</td><td>".$rs->endereco
                                        ."</td><td>".$rs->bairro
                                        ."</td><td>".$rs->cep
                                        ."</td><td>".$rs->numCorporativo
                                        ."</td><td>".$rs->numRamal
                                        ."</td><td><center><a href=\"?act=upd&idFilial=".$rs->idFilial."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFilial=".$rs->idFilial."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                }
                            }catch (PDOException $erro) {
                                echo "Erro: ".$erro->getMessage();
                            } 
                        } 
                        
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <?php }
else if ($_SESSION['user_funcao'] == '2' ) { 
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

