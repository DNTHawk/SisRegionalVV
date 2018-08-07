<?php
error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php'; 

$paramentroCargo = filter_input(INPUT_POST, "paramentroCargo");

$_SESSION['paramentroCargo'] = $paramentroCargo;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idDemanda = (isset($_POST["idDemanda"]) && $_POST["idDemanda"] != null) ? $_POST["idDemanda"] : "";
    $nomeDemanda = (isset($_POST["nomeDemanda"]) && $_POST["nomeDemanda"] != null) ? $_POST["nomeDemanda"] : "";
    $enviadoPor = (isset($_POST["enviadoPor"]) && $_POST["enviadoPor"] != null) ? $_POST["enviadoPor"] : "";
    $dataPrazo = (isset($_POST["dataPrazo"]) && $_POST["dataPrazo"] != null) ? $_POST["dataPrazo"] : "";
    $realizado = (isset($_POST["realizado"]) && $_POST["realizado"] != null) ? $_POST["realizado"] : "";
} else if (!isset($idDemanda)) {
    $idDemanda = (isset($_GET["idDemanda"]) && $_GET["idDemanda"] != null) ? $_GET["idDemanda"] : "";
}

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nomeDemanda != "") {
    try {
        if ($idDemanda != "") {
            $stmt = $conexao->prepare("UPDATE demandas  SET nomeDemanda=?, enviadoPor=?, dataPrazo=?, realizado=? WHERE idDemanda = ?");
            $stmt->bindParam(5, $idDemanda);
        } else {
            $stmt = $conexao->prepare("INSERT INTO demandas (nomeDemanda, enviadoPor, dataPrazo, realizado) VALUES (?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $nomeDemanda);
        $stmt->bindParam(2, $enviadoPor);
        $stmt->bindParam(3, $dataPrazo);
        $stmt->bindParam(4, $realizado);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo"<script language='javascript' type='text/javascript'>alert('Dados cadastrados com sucesso!');window.location.href='cad_demandas.php';</script>";
                $idDemanda = null;
                $nomeDemanda = null;
                $enviadoPor = null;
                $dataPrazo = null;
                $realizado = null;
                
            } else {
                echo "<script>alert('Erro ao efetivar o cadastro!')</script>";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idDemanda != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM demandas WHERE  idDemanda = ?");
        $stmt->bindParam(1, $idDemanda, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idDemanda = $rs->idDemanda;
            $nomeDemanda = $rs->nomeDemanda;
            $enviadoPor = $rs->enviadoPor;
            $dataPrazo = $rs->dataPrazo;
            $realizado = $rs->realizado;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}else{
    $nomeDemanda = null;
    $enviadoPor = null;
    $dataPrazo = null;
    $realizado = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idDemanda != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM demandas WHERE idDemanda = ?");
        $stmt->bindParam(1, $idDemanda, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo"<script language='javascript' type='text/javascript'>alert('Registro excluido com sucesso!');window.location.href='cad_demandas.php';</script>";
            $idDemanda = null;
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
                <h3>Cadastro de Demandas</h3>
            </div>
            <!--<div style="margin-top: 20px; font-size: 20px;" class="col-md-1 hidden-xs">
                <a href="relatorio_demandas.php" data-toggle="tooltip" data-placement="left" title="Imprimir"><span style="color: #000" class="glyphicon glyphicon-print"></span></a>
            </div>-->
        </div>
        <form action="?act=save" method="POST" name="form1">
            <div class="row">
                <input type="hidden" name="idDemanda" <?php
                if (isset($idDemanda) && $idDemanda != null || $idDemanda != "") {
                    echo "value=\"{$idDemanda}\"";
                }
                ?> />
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="nomeDemanda">Demanda:</label>
                            <input type="text" name="nomeDemanda" class="form-control" required <?php if (isset($nomeDemanda) && $nomeDemanda != null || $nomeDemanda != "") { echo "value=\"{$nomeDemanda}\"";} ?> />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="enviadoPor">Enviado Por:</label>
                            <input type="text" name="enviadoPor" class="form-control" required <?php if (isset($enviadoPor) && $enviadoPor != null || $enviadoPor != "") { echo "value=\"{$enviadoPor}\"";} ?> />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="dataPrazo">Prazo:</label>
                        <input type="date" name="dataPrazo" class="form-control" required <?php
                        if (isset($dataPrazo) && $dataPrazo != null || $dataPrazo != "") { echo "value=\"{$dataPrazo}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group" style="margin-top: 30px;">
                        <label for="realizado"> Realizado: </label>
                        <label class="radio-inline">
                            <input type="radio" name="realizado" id="concluido1" value="Sim" required> Sim
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="realizado" id="concluido2" value="Não"> Não
                        </label>
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
            <div class="col-md-12">
                <h3>Não Finalizadas</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Demanda</th>
                            <th>Enviado Por</th>
                            <th>Prazo</th>
                            <th>Realizado</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                        try {
                            $stmt = $conexao->prepare("SELECT * FROM demandas WHERE realizado = 'Não' order by dataPrazo");
                            if ($stmt->execute()) {
                                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    $array_data_prazo = explode('-', $rs->dataPrazo);
                                    $data_formatada = $array_data_prazo[2] . '/' . $array_data_prazo[1] . '/' . $array_data_prazo[0];
                                    echo "<tr>";
                                    echo "<td>".$rs->nomeDemanda
                                    ."</td><td style='text-align: center'>".$rs->enviadoPor
                                    ."</td><td style='text-align: center'>".$data_formatada
                                    ."</td><td style='text-align: center'>".$rs->realizado
                                    ."</td><td><center><a href=\"?act=upd&idDemanda=".$rs->idDemanda."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                    ."&nbsp;"
                                    ."<a href=\"?act=del&idDemanda=".$rs->idDemanda."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                            }
                        }catch (PDOException $erro) {
                            echo "Erro: ".$erro->getMessage();
                        }  
                        ?>
                    </table>
                    <br><br><br>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h3>Finalizadas</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Demanda</th>
                            <th>Enviado Por</th>
                            <th>Prazo</th>
                            <th>Realizado</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                        try {
                            $stmt = $conexao->prepare("SELECT * FROM demandas WHERE realizado = 'Sim' order by dataPrazo");
                            if ($stmt->execute()) {
                                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    $array_data_prazo = explode('-', $rs->dataPrazo);
                                    $data_formatada = $array_data_prazo[2] . '/' . $array_data_prazo[1] . '/' . $array_data_prazo[0];
                                    echo "<tr>";
                                    echo "<td>".$rs->nomeDemanda
                                    ."</td><td style='text-align: center'>".$rs->enviadoPor
                                    ."</td><td style='text-align: center'>".$data_formatada
                                    ."</td><td style='text-align: center'>".$rs->realizado
                                    ."</td><td><center><a href=\"?act=upd&idDemanda=".$rs->idDemanda."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                    ."&nbsp;"
                                    ."<a href=\"?act=del&idDemanda=".$rs->idDemanda."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                            }
                        }catch (PDOException $erro) {
                            echo "Erro: ".$erro->getMessage();
                        }  
                        ?>
                    </table>
                    <br><br><br>
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
        ?>
            <div class="container">
                <div class="row">
            <div class="col-md-12">
                <h3>Não Finalizadas</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Demanda</th>
                            <th>Enviado Por</th>
                            <th>Prazo</th>
                            <th>Realizado</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                        try {
                            $stmt = $conexao->prepare("SELECT * FROM demandas WHERE realizado = 'Não' order by dataPrazo");
                            if ($stmt->execute()) {
                                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    $array_data_prazo = explode('-', $rs->dataPrazo);
                                    $data_formatada_prazo = $array_data_prazo[2] . '/' . $array_data_prazo[1] . '/' . $array_data_prazo[0];
                                    echo "<tr>";
                                    echo "<td>".$rs->nomeDemanda
                                    ."</td><td style='text-align: center'>".$rs->enviadoPor
                                    ."</td><td style='text-align: center'>".$data_formatada
                                    ."</td><td style='text-align: center'>".$rs->realizado
                                    ."</td><td><center><a href=\"?act=upd&idDemanda=".$rs->idDemanda."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                    ."&nbsp;"
                                    ."<a href=\"?act=del&idDemanda=".$rs->idDemanda."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                            }
                        }catch (PDOException $erro) {
                            echo "Erro: ".$erro->getMessage();
                        }  
                        ?>
                    </table>
                    <br><br><br>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h3>Finalizadas</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Demanda</th>
                            <th>Enviado Por</th>
                            <th>Prazo</th>
                            <th>Realizado</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                        try {
                            $stmt = $conexao->prepare("SELECT * FROM demandas WHERE realizado = 'Sim' order by dataPrazo");
                            if ($stmt->execute()) {
                                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    $array_data_prazo = explode('-', $rs->dataPrazo);
                                    $data_formatada = $array_data_prazo[2] . '/' . $array_data_prazo[1] . '/' . $array_data_prazo[0];
                                    echo "<tr>";
                                    echo "<td>".$rs->nomeDemanda
                                    ."</td><td style='text-align: center'>".$rs->enviadoPor
                                    ."</td><td style='text-align: center'>".$data_formatada
                                    ."</td><td style='text-align: center'>".$rs->realizado
                                    ."</td><td><center><a href=\"?act=upd&idDemanda=".$rs->idDemanda."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                    ."&nbsp;"
                                    ."<a href=\"?act=del&idDemanda=".$rs->idDemanda."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                            }
                        }catch (PDOException $erro) {
                            echo "Erro: ".$erro->getMessage();
                        }  
                        ?>
                    </table>
                    <br><br><br>
                </div>
            </div>
        </div>
            </div>
        <?php
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