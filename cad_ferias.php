<?php
error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php'; 

$paramentroCargo = filter_input(INPUT_POST, "paramentroCargo");

$_SESSION['paramentroCargo'] = $paramentroCargo;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idFerias = (isset($_POST["idFerias"]) && $_POST["idFerias"] != null) ? $_POST["idFerias"] : "";
    $pessoaFerias = (isset($_POST["pessoaFerias"]) && $_POST["pessoaFerias"] != null) ? $_POST["pessoaFerias"] : "";
    $dataSaida = (isset($_POST["dataSaida"]) && $_POST["dataSaida"] != null) ? $_POST["dataSaida"] : "";
    $dataVolta = (isset($_POST["dataVolta"]) && $_POST["dataVolta"] != null) ? $_POST["dataVolta"] : "";
    $periodo = (isset($_POST["periodo"]) && $_POST["periodo"] != null) ? $_POST["periodo"] : "";
    $decTerceiro = (isset($_POST["decTerceiro"]) && $_POST["decTerceiro"] != null) ? $_POST["decTerceiro"] : "";
} else if (!isset($idFerias)) {
    $idFerias = (isset($_GET["idFerias"]) && $_GET["idFerias"] != null) ? $_GET["idFerias"] : "";
}

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $pessoaFerias != "") {
    try {
        if ($idFerias != "") {
            $stmt = $conexao->prepare("UPDATE ferias  SET pessoaFerias=?, dataSaida=?, dataVolta=?, periodo=?, decTerceiro=? WHERE idFerias = ?");
            $stmt->bindParam(6, $idFerias);
        } else {
            $stmt = $conexao->prepare("INSERT INTO ferias (pessoaFerias, dataSaida, dataVolta, periodo, decTerceiro) VALUES (?, ?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $pessoaFerias);
        $stmt->bindParam(2, $dataSaida);
        $stmt->bindParam(3, $dataVolta);
        $stmt->bindParam(4, $periodo);
        $stmt->bindParam(5, $decTerceiro);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo"<script language='javascript' type='text/javascript'>alert('Dados cadastrados com sucesso!');window.location.href='cad_ferias.php';</script>";
                $idFerias = null;
                $pessoaFerias = null;
                $dataSaida = null;
                $dataVolta = null;
                $periodo = null;
                $decTerceiro = null;
                
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

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idFerias != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa WHERE ferias.pessoaFerias = pessoa.idPessoa AND idFerias = ?");
        $stmt->bindParam(1, $idFerias, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idFerias = $rs->idFerias;
            $pessoaFerias = $rs->pessoaFerias;
            $nomePessoa = $rs->nome;
            $dataSaida = $rs->dataSaida ;
            $dataVolta = $rs->dataVolta;
            $periodo = $rs->periodo;
            $decTerceiro = $rs->decTerceiro;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}else{
    $pessoaFerias = null;
    $dataSaida = null;
    $dataVolta = null;
    $periodo = null;
    $decTerceiro = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idFerias != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM ferias WHERE idFerias = ?");
        $stmt->bindParam(1, $idFerias, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo"<script language='javascript' type='text/javascript'>alert('Registro excluido com sucesso!');window.location.href='cad_ferias.php';</script>";
            $idFerias = null;
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
                <h3>Cadastro de Ferias</h3>
            </div>
            <div style="margin-top: 20px; font-size: 20px;" class="col-md-1 hidden-xs">
                <a href="relatorio_ferias.php" data-toggle="tooltip" data-placement="left" title="Imprimir"><span style="color: #000" class="glyphicon glyphicon-print"></span></a>
            </div>
        </div>
        <form action="?act=save" method="POST" name="form1">
            <div class="row">
                <input type="hidden" name="idFerias" <?php
                if (isset($idFerias) && $idFerias != null || $idFerias != "") {
                    echo "value=\"{$idFerias}\"";
                }
                ?> />
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="pessoaFerias">Nome:</label>
                        <?php
                        $sql = "SELECT * from pessoa WHERE funcaoPessoa = '2' or funcaoPessoa = '3' order by matricula asc";
                        $stm = $conexao->prepare($sql);
                        $stm->execute();
                        $pessoas = $stm->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <select class="form-control" name="pessoaFerias" id="pessoaFerias" required>
                        <?php 
                            if (isset($pessoaFerias) && $pessoaFerias != null || $pessoaFerias != ""){?> <option value="<?=$pessoaFerias?>"><?=$nomePessoa?></option> <?php
                            }else{
                                ?><option value="">Nome:</option><?php
                            }
                        ?>
                        <?php foreach($pessoas as $pessoa):?>
                            <option value=<?=$pessoa->idPessoa?>><?=$pessoa->nome?></option>
                        <?php endforeach;?>
                        </select>
                        <span class='msg-erro msg-status'></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="dataSaida">Data Saida:</label>
                        <input type="date" name="dataSaida" class="form-control" required <?php
                        if (isset($dataSaida) && $dataSaida != null || $dataSaida != "") { echo "value=\"{$dataSaida}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="dataVolta">Data Volta:</label>
                        <input type="date" name="dataVolta" class="form-control" required <?php
                        if (isset($dataVolta) && $dataVolta != null || $dataVolta != "") { echo "value=\"{$dataVolta}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="periodo">Período:</label>
                        <input type="number" name="periodo" class="form-control" required <?php
                        if (isset($periodo) && $periodo != null || $periodo != "") { echo "value=\"{$periodo}\"";} ?> />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group" style="margin-top: 30px;">
                        <label for="decTerceiro"> Décimo Terceiro: </label>
                        <label class="radio-inline">
                            <input type="radio" name="decTerceiro" id="concluido1" value="Sim"> Sim
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="decTerceiro" id="concluido2" value="Não"> Não
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
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="paramentroCargo">Cargo:</label>
                        <select class="form-control" name="paramentroCargo" id="paramentroCargo" required="">
                            <option value="">Selecione o Cargo</option>
                            <option value="3">CAL</option>
                            <option value="2">Gerente Loja</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <input style="margin-top: 25px;" type="submit" class="btn btn-primary" value="Filtrar">
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nome</th>
                            <th>Matricula</th>
                            <th>Função</th>
                            <th>Data Saida</th>
                            <th>Data Volta</th>
                            <th>Período</th>
                            <th>Décimo Terceiro</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                        if($paramentroCargo){
                            try {
                                $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa, funcao WHERE ferias.pessoaFerias = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and funcao.idFuncao like '$paramentroCargo%' order by dataSaida");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $array_data_saida = explode('-', $rs->dataSaida);
                                        $data_formatada_saida = $array_data_saida[2] . '/' . $array_data_saida[1] . '/' . $array_data_saida[0];
                                        $array_data_volta = explode('-', $rs->dataVolta);
                                        $data_formatada_volta = $array_data_volta[2] . '/' . $array_data_volta[1] . '/' . $array_data_volta[0];
                                        echo "<tr>";
                                        echo "<td>".$rs->nome
                                        ."</td><td style='text-align: center'>".$rs->matricula
                                        ."</td><td style='text-align: center'>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$data_formatada_saida
                                        ."</td><td style='text-align: center'>".$data_formatada_volta
                                        ."</td><td style='text-align: center'>".$rs->periodo
                                        ."</td><td style='text-align: center'>".$rs->decTerceiro
                                        ."</td><td><center><a href=\"?act=upd&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                                $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa, funcao WHERE ferias.pessoaFerias = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by dataSaida");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $array_data_saida = explode('-', $rs->dataSaida);
                                        $data_formatada_saida = $array_data_saida[2] . '/' . $array_data_saida[1] . '/' . $array_data_saida[0];
                                        $array_data_volta = explode('-', $rs->dataVolta);
                                        $data_formatada_volta = $array_data_volta[2] . '/' . $array_data_volta[1] . '/' . $array_data_volta[0];
                                        echo "<tr>";
                                        echo "<td>".$rs->nome
                                        ."</td><td style='text-align: center'>".$rs->matricula
                                        ."</td><td style='text-align: center'>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$data_formatada_saida
                                        ."</td><td style='text-align: center'>".$data_formatada_volta
                                        ."</td><td style='text-align: center'>".$rs->periodo
                                        ."</td><td style='text-align: center'>".$rs->decTerceiro
                                        ."</td><td><center><a href=\"?act=upd&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
    ?>
    <div class="container">
        <div style="margin-bottom: 10px" class="row">
            <div class="col-md-3">
                <h3>Consulta de Ferias</h3>
            </div>
            <div style="margin-top: 20px; font-size: 20px;" class="col-md-1 hidden-xs">
                <a href="relatorio_ferias.php" data-toggle="tooltip" data-placement="left" title="Imprimir"><span style="color: #000" class="glyphicon glyphicon-print"></span></a>
            </div>
        </div>
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="paramentroCargo">Cargo:</label>
                        <select class="form-control" name="paramentroCargo" id="paramentroCargo" required="">
                            <option value="">Selecione o Cargo</option>
                            <option value="3">CAL</option>
                            <option value="2">Gerente Loja</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <input style="margin-top: 25px;" type="submit" class="btn btn-primary" value="Filtrar">
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nome</th>
                            <th>Matricula</th>
                            <th>Filial</th>
                            <th>Função</th>
                            <th>Data Saida</th>
                            <th>Data Volta</th>
                            <th>Período</th>
                            <th>Décimo Terceiro</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                        if($paramentroCargo){
                            try {
                                $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa, funcao, filial WHERE ferias.pessoaFerias = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.filialPessoa = filial.idFilial and funcao.idFuncao like '$paramentroCargo%' order by dataSaida");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $array_data_saida = explode('-', $rs->dataSaida);
                                        $data_formatada_saida = $array_data_saida[2] . '/' . $array_data_saida[1] . '/' . $array_data_saida[0];
                                        $array_data_volta = explode('-', $rs->dataVolta);
                                        $data_formatada_volta = $array_data_volta[2] . '/' . $array_data_volta[1] . '/' . $array_data_volta[0];
                                        echo "<tr>";
                                        echo "<td>".$rs->nome
                                        ."</td><td style='text-align: center'>".$rs->matricula
                                        ."</td><td style='text-align: center'>".$rs->filial
                                        ."</td><td style='text-align: center'>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$data_formatada_saida
                                        ."</td><td style='text-align: center'>".$data_formatada_volta
                                        ."</td><td style='text-align: center'>".$rs->periodo
                                        ."</td><td style='text-align: center'>".$rs->decTerceiro
                                        ."</td><td><center><a href=\"?act=upd&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                                $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa, funcao, filial WHERE ferias.pessoaFerias = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.filialPessoa = filial.idFilial and funcao.idFuncao like '$paramentroCargo%' order by dataSaida");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $array_data_saida = explode('-', $rs->dataSaida);
                                        $data_formatada_saida = $array_data_saida[2] . '/' . $array_data_saida[1] . '/' . $array_data_saida[0];
                                        $array_data_volta = explode('-', $rs->dataVolta);
                                        $data_formatada_volta = $array_data_volta[2] . '/' . $array_data_volta[1] . '/' . $array_data_volta[0];
                                        echo "<tr>";
                                        echo "<td>".$rs->nome
                                        ."</td><td style='text-align: center'>".$rs->matricula
                                        ."</td><td style='text-align: center'>".$rs->filial
                                        ."</td><td style='text-align: center'>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$data_formatada_saida
                                        ."</td><td style='text-align: center'>".$data_formatada_volta
                                        ."</td><td style='text-align: center'>".$rs->periodo
                                        ."</td><td style='text-align: center'>".$rs->decTerceiro
                                        ."</td><td><center><a href=\"?act=upd&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
    <?php
}
else if ($_SESSION['user_funcao'] == '5') { 
    include_once("menu_car.php");
    ?>
    <div class="container">
        <div style="margin-bottom: 10px" class="row">
            <div class="col-md-3">
                <h3>Consulta de Ferias</h3>
            </div>
            <div style="margin-top: 20px; font-size: 20px;" class="col-md-1 hidden-xs">
                <a href="relatorio_ferias.php" data-toggle="tooltip" data-placement="left" title="Imprimir"><span style="color: #000" class="glyphicon glyphicon-print"></span></a>
            </div>
        </div>
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="paramentroCargo">Cargo:</label>
                        <select class="form-control" name="paramentroCargo" id="paramentroCargo" required="">
                            <option value="">Selecione o Cargo</option>
                            <option value="3">CAL</option>
                            <option value="2">Gerente Loja</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <input style="margin-top: 25px;" type="submit" class="btn btn-primary" value="Filtrar">
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nome</th>
                            <th>Matricula</th>
                            <th>Filial</th>
                            <th>Função</th>
                            <th>Data Saida</th>
                            <th>Data Volta</th>
                            <th>Período</th>
                            <th>Décimo Terceiro</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                        if($paramentroCargo){
                            try {
                                $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa, funcao, filial WHERE ferias.pessoaFerias = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.filialPessoa = filial.idFilial and funcao.idFuncao like '$paramentroCargo%' order by dataSaida");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $array_data_saida = explode('-', $rs->dataSaida);
                                        $data_formatada_saida = $array_data_saida[2] . '/' . $array_data_saida[1] . '/' . $array_data_saida[0];
                                        $array_data_volta = explode('-', $rs->dataVolta);
                                        $data_formatada_volta = $array_data_volta[2] . '/' . $array_data_volta[1] . '/' . $array_data_volta[0];
                                        echo "<tr>";
                                        echo "<td>".$rs->nome
                                        ."</td><td style='text-align: center'>".$rs->matricula
                                        ."</td><td style='text-align: center'>".$rs->filial
                                        ."</td><td style='text-align: center'>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$data_formatada_saida
                                        ."</td><td style='text-align: center'>".$data_formatada_volta
                                        ."</td><td style='text-align: center'>".$rs->periodo
                                        ."</td><td style='text-align: center'>".$rs->decTerceiro
                                        ."</td><td><center><a href=\"?act=upd&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                                $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa, funcao, filial WHERE ferias.pessoaFerias = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.filialPessoa = filial.idFilial and funcao.idFuncao like '$paramentroCargo%' order by dataSaida");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $array_data_saida = explode('-', $rs->dataSaida);
                                        $data_formatada_saida = $array_data_saida[2] . '/' . $array_data_saida[1] . '/' . $array_data_saida[0];
                                        $array_data_volta = explode('-', $rs->dataVolta);
                                        $data_formatada_volta = $array_data_volta[2] . '/' . $array_data_volta[1] . '/' . $array_data_volta[0];
                                        echo "<tr>";
                                        echo "<td>".$rs->nome
                                        ."</td><td style='text-align: center'>".$rs->matricula
                                        ."</td><td style='text-align: center'>".$rs->filial
                                        ."</td><td style='text-align: center'>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$data_formatada_saida
                                        ."</td><td style='text-align: center'>".$data_formatada_volta
                                        ."</td><td style='text-align: center'>".$rs->periodo
                                        ."</td><td style='text-align: center'>".$rs->decTerceiro
                                        ."</td><td><center><a href=\"?act=upd&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
    <?php
}
else if ($_SESSION['user_funcao'] == '6') { 
    include_once("menu_consultorTreinamento.php");
    ?>
    <div class="container">
        <div style="margin-bottom: 10px" class="row">
            <div class="col-md-3">
                <h3>Consulta de Ferias</h3>
            </div>
            <div style="margin-top: 20px; font-size: 20px;" class="col-md-1 hidden-xs">
                <a href="relatorio_ferias.php" data-toggle="tooltip" data-placement="left" title="Imprimir"><span style="color: #000" class="glyphicon glyphicon-print"></span></a>
            </div>
        </div>
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="paramentroCargo">Cargo:</label>
                        <select class="form-control" name="paramentroCargo" id="paramentroCargo" required="">
                            <option value="">Selecione o Cargo</option>
                            <option value="3">CAL</option>
                            <option value="2">Gerente Loja</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <input style="margin-top: 25px;" type="submit" class="btn btn-primary" value="Filtrar">
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nome</th>
                            <th>Matricula</th>
                            <th>Filial</th>
                            <th>Função</th>
                            <th>Data Saida</th>
                            <th>Data Volta</th>
                            <th>Período</th>
                            <th>Décimo Terceiro</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                        if($paramentroCargo){
                            try {
                                $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa, funcao, filial WHERE ferias.pessoaFerias = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.filialPessoa = filial.idFilial and funcao.idFuncao like '$paramentroCargo%' order by dataSaida");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $array_data_saida = explode('-', $rs->dataSaida);
                                        $data_formatada_saida = $array_data_saida[2] . '/' . $array_data_saida[1] . '/' . $array_data_saida[0];
                                        $array_data_volta = explode('-', $rs->dataVolta);
                                        $data_formatada_volta = $array_data_volta[2] . '/' . $array_data_volta[1] . '/' . $array_data_volta[0];
                                        echo "<tr>";
                                        echo "<td>".$rs->nome
                                        ."</td><td style='text-align: center'>".$rs->matricula
                                        ."</td><td style='text-align: center'>".$rs->filial
                                        ."</td><td style='text-align: center'>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$data_formatada_saida
                                        ."</td><td style='text-align: center'>".$data_formatada_volta
                                        ."</td><td style='text-align: center'>".$rs->periodo
                                        ."</td><td style='text-align: center'>".$rs->decTerceiro
                                        ."</td><td><center><a href=\"?act=upd&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                                $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa, funcao, filial WHERE ferias.pessoaFerias = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.filialPessoa = filial.idFilial and funcao.idFuncao like '$paramentroCargo%' order by dataSaida");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $array_data_saida = explode('-', $rs->dataSaida);
                                        $data_formatada_saida = $array_data_saida[2] . '/' . $array_data_saida[1] . '/' . $array_data_saida[0];
                                        $array_data_volta = explode('-', $rs->dataVolta);
                                        $data_formatada_volta = $array_data_volta[2] . '/' . $array_data_volta[1] . '/' . $array_data_volta[0];
                                        echo "<tr>";
                                        echo "<td>".$rs->nome
                                        ."</td><td style='text-align: center'>".$rs->matricula
                                        ."</td><td style='text-align: center'>".$rs->filial
                                        ."</td><td style='text-align: center'>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$data_formatada_saida
                                        ."</td><td style='text-align: center'>".$data_formatada_volta
                                        ."</td><td style='text-align: center'>".$rs->periodo
                                        ."</td><td style='text-align: center'>".$rs->decTerceiro
                                        ."</td><td><center><a href=\"?act=upd&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
    <?php
}
else if ($_SESSION['user_funcao'] == '7') { 
    include_once("menu_consultorTreinamentoRegional.php");
    ?>
    <div class="container">
        <div style="margin-bottom: 10px" class="row">
            <div class="col-md-3">
                <h3>Consulta de Ferias</h3>
            </div>
            <div style="margin-top: 20px; font-size: 20px;" class="col-md-1 hidden-xs">
                <a href="relatorio_ferias.php" data-toggle="tooltip" data-placement="left" title="Imprimir"><span style="color: #000" class="glyphicon glyphicon-print"></span></a>
            </div>
        </div>
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="paramentroCargo">Cargo:</label>
                        <select class="form-control" name="paramentroCargo" id="paramentroCargo" required="">
                            <option value="">Selecione o Cargo</option>
                            <option value="3">CAL</option>
                            <option value="2">Gerente Loja</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <input style="margin-top: 25px;" type="submit" class="btn btn-primary" value="Filtrar">
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nome</th>
                            <th>Matricula</th>
                            <th>Filial</th>
                            <th>Função</th>
                            <th>Data Saida</th>
                            <th>Data Volta</th>
                            <th>Período</th>
                            <th>Décimo Terceiro</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                        if($paramentroCargo){
                            try {
                                $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa, funcao, filial WHERE ferias.pessoaFerias = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.filialPessoa = filial.idFilial and funcao.idFuncao like '$paramentroCargo%' order by dataSaida");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $array_data_saida = explode('-', $rs->dataSaida);
                                        $data_formatada_saida = $array_data_saida[2] . '/' . $array_data_saida[1] . '/' . $array_data_saida[0];
                                        $array_data_volta = explode('-', $rs->dataVolta);
                                        $data_formatada_volta = $array_data_volta[2] . '/' . $array_data_volta[1] . '/' . $array_data_volta[0];
                                        echo "<tr>";
                                        echo "<td>".$rs->nome
                                        ."</td><td style='text-align: center'>".$rs->matricula
                                        ."</td><td style='text-align: center'>".$rs->filial
                                        ."</td><td style='text-align: center'>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$data_formatada_saida
                                        ."</td><td style='text-align: center'>".$data_formatada_volta
                                        ."</td><td style='text-align: center'>".$rs->periodo
                                        ."</td><td style='text-align: center'>".$rs->decTerceiro
                                        ."</td><td><center><a href=\"?act=upd&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                                $stmt = $conexao->prepare("SELECT * FROM ferias, pessoa, funcao, filial WHERE ferias.pessoaFerias = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.filialPessoa = filial.idFilial and funcao.idFuncao like '$paramentroCargo%' order by dataSaida");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $array_data_saida = explode('-', $rs->dataSaida);
                                        $data_formatada_saida = $array_data_saida[2] . '/' . $array_data_saida[1] . '/' . $array_data_saida[0];
                                        $array_data_volta = explode('-', $rs->dataVolta);
                                        $data_formatada_volta = $array_data_volta[2] . '/' . $array_data_volta[1] . '/' . $array_data_volta[0];
                                        echo "<tr>";
                                        echo "<td>".$rs->nome
                                        ."</td><td style='text-align: center'>".$rs->matricula
                                        ."</td><td style='text-align: center'>".$rs->filial
                                        ."</td><td style='text-align: center'>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$data_formatada_saida
                                        ."</td><td style='text-align: center'>".$data_formatada_volta
                                        ."</td><td style='text-align: center'>".$rs->periodo
                                        ."</td><td style='text-align: center'>".$rs->decTerceiro
                                        ."</td><td><center><a href=\"?act=upd&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFerias=".$rs->idFerias."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
    <?php
} else{}

include_once("rodape.php");
?>
</div>