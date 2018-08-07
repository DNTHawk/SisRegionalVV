<?php 

error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php';

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

try{
    $stmt4 = $conexao->prepare("SELECT * FROM mesAnoAtual");
    if ($stmt4->execute()) {
        while ($rs4 = $stmt4->fetch(PDO::FETCH_OBJ)) {
            $mesAtual = $rs4->mes;
            $anoAtual = $rs4->ano;
        }
        $mesAnoAtual = $mesAtual.$anoAtual;
    } else {
        echo "Erro: Não foi possível recuperar os dados do banco de dados";
    }
} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}

$mesAnoAtual = $mesAtual.$anoAtual;

$parametroMes = filter_input(INPUT_POST, "parametroMes");
$parametroAno = filter_input(INPUT_POST, "parametroAno");
$parametroAtual = $parametroMes.$parametroAno;

$filialUser = $_SESSION['user_filial'];



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idResultado = (isset($_POST["idResultado"]) && $_POST["idResultado"] != null) ? $_POST["idResultado"] : "";
    $resultadoFilial = (isset($_POST["resultadoFilial"]) && $_POST["resultadoFilial"] != null) ? $_POST["resultadoFilial"] : "";
    $mes = (isset($_POST["mes"]) && $_POST["mes"] != null) ? $_POST["mes"] : "";
    $ano = (isset($_POST["ano"]) && $_POST["ano"] != null) ? $_POST["ano"] : "";
    $metaLb = (isset($_POST["metaLb"]) && $_POST["metaLb"] != null) ? $_POST["metaLb"] : "";
    $realLb = (isset($_POST["realLb"]) && $_POST["realLb"] != null) ? $_POST["realLb"] : "";
    $lb = (isset($_POST["lb"]) && $_POST["lb"] != null) ? $_POST["lb"] : "";
    $metaVendaMercantil = (isset($_POST["metaVendaMercantil"]) && $_POST["metaVendaMercantil"] != null) ? $_POST["metaVendaMercantil"] : "";
    $realVendaMercantil = (isset($_POST["realVendaMercantil"]) && $_POST["realVendaMercantil"] != null) ? $_POST["realVendaMercantil"] : "";
    $vendaMercantil = (isset($_POST["vendaMercantil"]) && $_POST["vendaMercantil"] != null) ? $_POST["vendaMercantil"] : "";
    $metaVendaMoveis = (isset($_POST["metaVendaMoveis"]) && $_POST["metaVendaMoveis"] != null) ? $_POST["metaVendaMoveis"] : "";
    $realVendaMoveis = (isset($_POST["realVendaMoveis"]) && $_POST["realVendaMoveis"] != null) ? $_POST["realVendaMoveis"] : "";
    $vendaMoveis = (isset($_POST["vendaMoveis"]) && $_POST["vendaMoveis"] != null) ? $_POST["vendaMoveis"] : "";
    $metaEficiencia = (isset($_POST["metaEficiencia"]) && $_POST["metaEficiencia"] != null) ? $_POST["metaEficiencia"] : "";
    $realEficiencia = (isset($_POST["realEficiencia"]) && $_POST["realEficiencia"] != null) ? $_POST["realEficiencia"] : "";
    $eficiencia = (isset($_POST["eficiencia"]) && $_POST["eficiencia"] != null) ? $_POST["eficiencia"] : "";
    $metaCdc = (isset($_POST["metaCdc"]) && $_POST["metaCdc"] != null) ? $_POST["metaCdc"] : "";
    $realCdc = (isset($_POST["realCdc"]) && $_POST["realCdc"] != null) ? $_POST["realCdc"] : "";
    $cdc = (isset($_POST["cdc"]) && $_POST["cdc"] != null) ? $_POST["cdc"] : "";
    $metaFamilia1 = (isset($_POST["metaFamilia1"]) && $_POST["metaFamilia1"] != null) ? $_POST["metaFamilia1"] : "";
    $realFamilia1 = (isset($_POST["realFamilia1"]) && $_POST["realFamilia1"] != null) ? $_POST["realFamilia1"] : "";
    $familia1 = (isset($_POST["familia1"]) && $_POST["familia1"] != null) ? $_POST["familia1"] : "";
    $metaFamilia2 = (isset($_POST["metaFamilia2"]) && $_POST["metaFamilia2"] != null) ? $_POST["metaFamilia2"] : "";
    $realFamilia2 = (isset($_POST["realFamilia2"]) && $_POST["realFamilia2"] != null) ? $_POST["realFamilia2"] : "";
    $familia2 = (isset($_POST["familia2"]) && $_POST["familia2"] != null) ? $_POST["familia2"] : "";
    $metaFamilia3 = (isset($_POST["metaFamilia3"]) && $_POST["metaFamilia3"] != null) ? $_POST["metaFamilia3"] : "";
    $realFamilia3 = (isset($_POST["realFamilia3"]) && $_POST["realFamilia3"] != null) ? $_POST["realFamilia3"] : "";
    $familia3 = (isset($_POST["familia3"]) && $_POST["familia3"] != null) ? $_POST["familia3"] : "";
    $metaMixServico = (isset($_POST["metaMixServico"]) && $_POST["metaMixServico"] != null) ? $_POST["metaMixServico"] : "";
    $realMixServico = (isset($_POST["realMixServico"]) && $_POST["realMixServico"] != null) ? $_POST["realMixServico"] : "";
    $mixServico = (isset($_POST["mixServico"]) && $_POST["mixServico"] != null) ? $_POST["mixServico"] : "";
    $metaPlanos = (isset($_POST["metaPlanos"]) && $_POST["metaPlanos"] != null) ? $_POST["metaPlanos"] : "";
    $realPlanos = (isset($_POST["realPlanos"]) && $_POST["realPlanos"] != null) ? $_POST["realPlanos"] : "";
    $planos = (isset($_POST["planos"]) && $_POST["planos"] != null) ? $_POST["planos"] : "";
    $metaCartoes = (isset($_POST["metaCartoes"]) && $_POST["metaCartoes"] != null) ? $_POST["metaCartoes"] : "";
    $realCartoes = (isset($_POST["realCartoes"]) && $_POST["realCartoes"] != null) ? $_POST["realCartoes"] : "";
    $cartoes = (isset($_POST["cartoes"]) && $_POST["cartoes"] != null) ? $_POST["cartoes"] : "";
    $metaDesconto = (isset($_POST["metaDesconto"]) && $_POST["metaDesconto"] != null) ? $_POST["metaDesconto"] : "";
    $realDesconto = (isset($_POST["realDesconto"]) && $_POST["realDesconto"] != null) ? $_POST["realDesconto"] : "";
    $desconto = (isset($_POST["desconto"]) && $_POST["desconto"] != null) ? $_POST["desconto"] : "";

    $mesAno = $mes.$ano;
} else if (!isset($idResultado)) {
    $idResultado = (isset($_GET["idResultado"]) && $_GET["idResultado"] != null) ? $_GET["idResultado"] : "";
}



if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $resultadoFilial != "") {
    try {
        if ($idResultado != "") {
            $stmt = $conexao->prepare("UPDATE resultados  SET resultadoFilial=?, mes=?, ano=?, metaLb=?, realLb=?, lb=?, metaVendaMercantil=?, realVendaMercantil=?, vendaMercantil=?, metaVendaMoveis=?, realVendaMoveis=?, vendaMoveis=?, metaEficiencia=?, realEficiencia=?, eficiencia=?, metaCdc=?, realCdc=?, cdc=?, metaFamilia1=?, realFamilia1=?, familia1=?, metaFamilia2=?, realFamilia2=?, familia2=?, metaFamilia3=?, realFamilia3=?, familia3=?, metaMixServico=?, realMixServico=?, mixServico=?, metaPlanos=?, realPlanos=?, planos=?, metaCartoes=?, realCartoes=?, cartoes=?, metaDesconto=?, realDesconto=?, desconto=?, mesAno=? WHERE idResultado = ?");
            $stmt->bindParam(41, $idResultado);
        } else {
            $stmt = $conexao->prepare("INSERT INTO resultados (resultadoFilial, mes, ano, metaLb, realLb, lb, metaVendaMercantil, realVendaMercantil, vendaMercantil, metaVendaMoveis, realVendaMoveis, vendaMoveis, metaEficiencia, realEficiencia, eficiencia, metaCdc, realCdc, cdc, metaFamilia1, realFamilia1, familia1, metaFamilia2, realFamilia2, familia2, metaFamilia3, realFamilia3, familia3, metaMixServico, realMixServico, mixServico, metaPlanos, realPlanos, planos, metaCartoes, realCartoes, cartoes, metaDesconto, realDesconto, desconto, mesAno) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $resultadoFilial);
        $stmt->bindParam(2, $mes);
        $stmt->bindParam(3, $ano);
        $stmt->bindParam(4, $metaLb);
        $stmt->bindParam(5, $realLb);
        $stmt->bindParam(6, $lb);
        $stmt->bindParam(7, $metaVendaMercantil);
        $stmt->bindParam(8, $realVendaMercantil);
        $stmt->bindParam(9, $vendaMercantil);
        $stmt->bindParam(10, $metaVendaMoveis);
        $stmt->bindParam(11, $realVendaMoveis);
        $stmt->bindParam(12, $vendaMoveis);
        $stmt->bindParam(13, $metaEficiencia);
        $stmt->bindParam(14, $realEficiencia);
        $stmt->bindParam(15, $eficiencia);
        $stmt->bindParam(16, $metaCdc);
        $stmt->bindParam(17, $realCdc);
        $stmt->bindParam(18, $cdc);
        $stmt->bindParam(19, $metaFamilia1);
        $stmt->bindParam(20, $realFamilia1);
        $stmt->bindParam(21, $familia1);
        $stmt->bindParam(22, $metaFamilia2);
        $stmt->bindParam(23, $realFamilia2);
        $stmt->bindParam(24, $familia2);
        $stmt->bindParam(25, $metaFamilia3);
        $stmt->bindParam(26, $realFamilia3);
        $stmt->bindParam(27, $familia3);
        $stmt->bindParam(28, $metaMixServico);
        $stmt->bindParam(29, $realMixServico);
        $stmt->bindParam(30, $mixServico);
        $stmt->bindParam(31, $metaPlanos);
        $stmt->bindParam(32, $realPlanos);
        $stmt->bindParam(33, $planos);
        $stmt->bindParam(34, $metaCartoes);
        $stmt->bindParam(35, $realCartoes);
        $stmt->bindParam(36, $cartoes);
        $stmt->bindParam(37, $metaDesconto);
        $stmt->bindParam(38, $realDesconto);
        $stmt->bindParam(39, $desconto);
        $stmt->bindParam(40, $mesAno);


        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Dados cadastrados com sucesso!')</script>";
                $idResultado = null;
                $resultadoFilial = null;
                $mes = null;
                $ano = null;
                $metaLb = null;
                $realLb = null;
                $lb = null;
                $metaVendaMercantil = null;
                $realVendaMercantil = null;
                $vendaMercantil = null;
                $metaVendaMoveis = null;
                $realVendaMoveis = null;
                $vendaMoveis = null;
                $metaEficiencia = null;
                $realEficiencia = null;
                $eficiencia = null;
                $metaCdc = null;
                $realCdc = null;
                $cdc = null;
                $metaFamilia1 = null;
                $realFamilia1 = null;
                $familia1 = null;
                $metaFamilia2 = null;
                $realFamilia2 = null;
                $familia2 = null;
                $metaFamilia3 = null;
                $realFamilia3 = null;
                $Familia3 = null;
                $metaMixServico = null;
                $realMixServico = null;
                $mixServico = null;
                $metaPlanos = null;
                $realPlanos = null;
                $planos = null;
                $metaCartoes = null;
                $realCartoes = null;
                $cartoes = null;
                $metaDesconto = null;
                $realDesconto = null;
                $desconto = null;
                $mesAno = null;
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

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idResultado != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND idResultado = ?");
        $stmt->bindParam(1, $idResultado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idResultado = $rs->idResultado;
            $resultadoFilial = $rs->resultadoFilial;
            $mes = $rs->mes;
            $ano = $rs->ano;
            $metaLb = $rs->metaLb;
            $realLb = $rs->realLb;
            $lb = $rs->lb;
            $metaVendaMercantil = $rs->metaVendaMercantil;
            $realVendaMercantil = $rs->realVendaMercantil;
            $vendaMercantil = $rs->vendaMercantil;
            $metaVendaMoveis = $rs->metaVendaMoveis;
            $realVendaMoveis = $rs->realVendaMoveis;
            $vendaMoveis = $rs->vendaMoveis;
            $metaEficiencia = $rs->metaEficiencia;
            $realEficiencia = $rs->realEficiencia;
            $eficiencia = $rs->eficiencia;
            $metaCdc = $rs->metaCdc;
            $realCdc = $rs->realCdc;
            $cdc = $rs->cdc;
            $metaFamilia1 = $rs->metaFamilia1;
            $realFamilia1 = $rs->realFamilia1;
            $familia1 = $rs->familia1;
            $metaFamilia2 = $rs->metaFamilia2;
            $realFamilia2 = $rs->realFamilia2;
            $familia2 = $rs->familia2;
            $metaFamilia3 = $rs->metaFamilia3;
            $realFamilia3 = $rs->realFamilia3;
            $familia3 = $rs->familia3;
            $metaMixServico = $rs->metaMixServico;
            $realMixServico = $rs->realMixServico;
            $mixServico = $rs->mixServico;
            $metaPlanos = $rs->metaPlanos;
            $realPlanos = $rs->realPlanos;
            $planos = $rs->planos;
            $metaCartoes = $rs->metaCartoes;
            $realCartoes = $rs->realCartoes;
            $cartoes = $rs->cartoes;
            $metaDesconto = $rs->metaDesconto;
            $realDesconto = $rs->realDesconto;
            $desconto = $rs->desconto;
            $mesAno = $rs->mesAno;
            $filial = $rs->filial;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}else{
    $idResultado = null;
    $resultadoFilial = null;
    $mes = null;
    $ano = null;
    $metaLb = null;
    $realLb = null;
    $lb = null;
    $metaVendaMercantil = null;
    $realVendaMercantil = null;
    $vendaMercantil = null;
    $metaVendaMoveis = null;
    $realVendaMoveis = null;
    $vendaMoveis = null;
    $metaEficiencia = null;
    $realEficiencia = null;
    $eficiencia = null;
    $metaCdc = null;
    $realCdc = null;
    $cdc = null;
    $metaFamilia1 = null;
    $realFamilia1 = null;
    $familia1 = null;
    $metaFamilia2 = null;
    $realFamilia2 = null;
    $familia2 = null;
    $metaFamilia3 = null;
    $realFamilia3 = null;
    $familia3 = null;
    $metaMixServico = null;
    $realMixServico = null;
    $mixServico = null;
    $metaPlanos = null;
    $realPlanos = null;
    $planos = null;
    $metaCartoes = null;
    $realCartoes = null;
    $cartoes = null;
    $metaDesconto = null;
    $realDesconto = null;
    $desconto = null;
    $mesAno = null;
    $filial = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idResultado != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM resultados WHERE idResultado = ?");
        $stmt->bindParam(1, $idResultado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "<script>alert('Registo foi excluído com êxito')</script>";
            $idResultado = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}?>

<div class="carregando" id="carregando"></div>
<div class="corpo" id="corpo">

    <?php 
    if ($_SESSION['user_funcao'] == '1'){
        include_once("menu_administrador.php");
        ?>

        <div class="container">
            <?php if ($idResultado != null) {?>
            <div class="row">
                <div class="col-md-12">
                    <h3>Cadastro de Resultados</h3>
                </div>
            </div>
            <form action="?act=save" method="POST" name="form1">
                <div class="row">
                    <input type="hidden" name="idResultado" <?php if (isset($idResultado) && $idResultado != null || $idResultado != "") { echo "value=\"{$idResultado}\""; }?> />
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="resultadoFilial">Filial:</label>
                                <?php
                                    $sql = "SELECT * from filial order by filial asc";
                                    $stm = $conexao->prepare($sql);
                                    $stm->execute();
                                    $filiais = $stm->fetchAll(PDO::FETCH_OBJ);
                                ?>
                            <select class="form-control" name="resultadoFilial" id="resultadoFilial" required>
                            <?php 
                                if (isset($resultadoFilial) && $resultadoFilial != null || $resultadoFilial != ""){?> <option value="<?=$resultadoFilial?>"><?=$filial?></option> <?php
                                }else{
                                ?><option value="">Responsavel:</option><?php
                                }
                            ?>
                            <?php foreach($filiais as $filial):?>
                                <option value=<?=$filial->idFilial?>><?=$filial->filial?></option>
                            <?php endforeach;?>
                            </select>
                            <span class='msg-erro msg-status'></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="mes">Mês:</label>
                            <select name="mes" class="form-control" required>
                                <?php 
                                    if (isset($mes) && $mes != null || $mes != ""){?> <option value="<?=$mes?>"><?=$mes?></option> <?php
                                    }else{
                                        ?><option value="">Escolha o Mês</option><?php
                                    }
                                ?>
                                <option value="Janeiro">Janeiro</option>
                                <option value="Fevereiro">Fevereiro</option>
                                <option value="Março">Março</option>
                                <option value="Abril">Abril</option>
                                <option value="Maio">Maio</option>
                                <option value="Junho">Junho</option>
                                <option value="Julho">Julho</option>
                                <option value="Agosto">Agosto</option>
                                <option value="Setembro">Setembro</option>
                                <option value="Outubro">Outubro</option>
                                <option value="Novembro">Novembro</option>
                                <option value="Dezembro">Dezembro</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="ano">Ano:</label>
                            <select name="ano" class="form-control" required>
                                <?php 
                                    if (isset($ano) && $ano != null || $ano != ""){?> <option value="<?=$ano?>"><?=$ano?></option> <?php
                                    }else{
                                        ?><option value="">Escolha o Ano</option><?php
                                    }
                                ?>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                     <div class="col-md-2">
                        <div class="form-group">
                            <label for="metaLb"> Meta LB:</label>
                            <input type="text" name="metaLb" placeholder="0.000,00" class="form-control" required <?php
                            if (isset($metaLb) && $metaLb != null || $metaLb != "") { echo "value=\"{$metaLb}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="realLb"> Real. LB:</label>
                            <input type="text" name="realLb" placeholder="0.000,00" class="form-control" required <?php
                            if (isset($realLb) && $realLb != null || $realLb != "") { echo "value=\"{$realLb}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="lb"> Ating. LB:</label>
                            <input type="text" name="lb" placeholder="000,00%" class="form-control" required <?php
                            if (isset($lb) && $lb != null || $lb != "") { echo "value=\"{$lb}\"";} ?> />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="metaVendaMercantil"> Meta Mercantil:</label>
                            <input type="text" name="metaVendaMercantil" placeholder="0.000,00" class="form-control" required <?php
                            if (isset($metaVendaMercantil) && $metaVendaMercantil != null || $metaVendaMercantil != "") { echo "value=\"{$metaVendaMercantil}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="realVendaMercantil"> Real. Mercantil:</label>
                            <input type="text" name="realVendaMercantil" placeholder="0.000,00" class="form-control" required <?php if (isset($realVendaMercantil) && $realVendaMercantil != null || $realVendaMercantil != "") { echo "value=\"{$realVendaMercantil}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="vendaMercantil"> Ating. Venda Mercantil:</label>
                            <input type="text" name="vendaMercantil" placeholder="000,00%" class="form-control" required <?php
                            if (isset($vendaMercantil) && $vendaMercantil != null || $vendaMercantil != "") { echo "value=\"{$vendaMercantil}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="metaVendaMoveis"> Meta Móveis:</label>
                            <input type="text" name="metaVendaMoveis" placeholder="0.000,00" class="form-control" required <?php
                            if (isset($metaVendaMoveis) && $metaVendaMoveis != null || $metaVendaMoveis != "") { echo "value=\"{$metaVendaMoveis}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="realVendaMoveis"> Real. Móveis:</label>
                            <input type="text" name="realVendaMoveis" placeholder="0.000,00" class="form-control" required <?php
                            if (isset($realVendaMoveis) && $realVendaMoveis != null || $realVendaMoveis != "") { echo "value=\"{$realVendaMoveis}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="vendaMoveis"> Ating. Venda Móveis:</label>
                            <input type="text" name="vendaMoveis" placeholder="000,00%" class="form-control" required <?php if (isset($vendaMoveis) && $vendaMoveis != null || $vendaMoveis != "") { echo "value=\"{$vendaMoveis}\"";} ?> />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="metaCdc"> Meta CDC:</label>
                            <input type="text" name="metaCdc" placeholder="00,00%" class="form-control" required <?php
                            if (isset($metaCdc) && $metaCdc != null || $metaCdc != "") { echo "value=\"{$metaCdc}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="realCdc"> Real. CDC:</label>
                            <input type="text" name="realCdc" placeholder="00,00%" class="form-control" required <?php if (isset($realCdc) && $realCdc != null || $realCdc != "") { echo "value=\"{$realCdc}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cdc"> Ating. CDC:</label>
                            <input type="text" name="cdc" placeholder="000,00%" class="form-control" required <?php if (isset($cdc) && $cdc != null || $cdc != "") { echo "value=\"{$cdc}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="metaEficiencia"> Meta Eficiência:</label>
                            <input type="text" name="metaEficiencia" placeholder="00,00%" class="form-control" required <?php if (isset($metaEficiencia) && $metaEficiencia != null || $metaEficiencia != "") { echo "value=\"{$metaEficiencia}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="realEficiencia"> Real. Eficiência:</label>
                            <input type="text" name="realEficiencia" placeholder="00,00%" class="form-control" required <?php if (isset($realEficiencia) && $realEficiencia != null || $realEficiencia != "") { echo "value=\"{$realEficiencia}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="eficiencia"> Ating. Eficiência:</label>
                            <input type="text" name="eficiencia" placeholder="000,00%" class="form-control" required <?php if (isset($eficiencia) && $eficiencia != null || $eficiencia != "") { echo "value=\"{$eficiencia}\"";} ?> />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="metaFamilia1"> Meta Familia 1:</label>
                            <input type="text" name="metaFamilia1" placeholder="0.000,00" class="form-control" required <?php if (isset($metaFamilia1) && $metaFamilia1 != null || $metaFamilia1 != "") { echo "value=\"{$metaFamilia1}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="realFamilia1"> Real. Familia 1:</label>
                            <input type="text" name="realFamilia1" placeholder="0.000,00" class="form-control" required <?php if (isset($realFamilia1) && $realFamilia1 != null || $realFamilia1 != "") { echo "value=\"{$realFamilia1}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="familia1"> Ating. Familia 1:</label>
                            <input type="text" name="familia1" placeholder="000,00%" class="form-control" required <?php if (isset($familia1) && $familia1 != null || $familia1 != "") { echo "value=\"{$familia1}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="metaFamilia2"> Meta Familia 2:</label>
                            <input type="text" name="metaFamilia2" placeholder="0.000,00" class="form-control" required <?php if (isset($metaFamilia2) && $metaFamilia2 != null || $metaFamilia2 != "") { echo "value=\"{$metaFamilia2}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="realFamilia2"> Real. Familia 2:</label>
                            <input type="text" name="realFamilia2" placeholder="0.000,00" class="form-control" required <?php if (isset($realFamilia2) && $realFamilia2 != null || $realFamilia2 != "") { echo "value=\"{$realFamilia2}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="familia2"> Ating. Familia 2:</label>
                            <input type="text" name="familia2" placeholder="000,00%" class="form-control" required <?php if (isset($familia2) && $familia2 != null || $familia2 != "") { echo "value=\"{$familia2}\"";} ?> />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="metaFamilia3"> Meta Familia 3:</label>
                            <input type="text" name="metaFamilia3" placeholder="0.000,00" class="form-control" required <?php if (isset($metaFamilia3) && $metaFamilia3 != null || $metaFamilia3 != "") { echo "value=\"{$metaFamilia3}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="realFamilia3"> Real. Familia 3:</label>
                            <input type="text" name="realFamilia3" placeholder="0.000,00" class="form-control" required <?php if (isset($realFamilia3) && $realFamilia3 != null || $realFamilia3 != "") { echo "value=\"{$realFamilia3}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="familia3"> Ating. Familia 3:</label>
                            <input type="text" name="familia3" placeholder="000,00%" class="form-control" required <?php if (isset($familia3) && $familia3 != null || $familia3 != "") { echo "value=\"{$familia3}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="metaMixServico"> Meta Serviços:</label>
                            <input type="text" name="metaMixServico" placeholder="0.000,00" class="form-control" required <?php if (isset($metaMixServico) && $metaMixServico != null || $metaMixServico != "") { echo "value=\"{$metaMixServico}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="realMixServico"> Real. Serviços:</label>
                            <input type="text" name="realMixServico" placeholder="0.000,00" class="form-control" required <?php if (isset($realMixServico) && $realMixServico != null || $realMixServico != "") { echo "value=\"{$realMixServico}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="mixServico"> Ating. Serviços:</label>
                            <input type="text" name="mixServico" placeholder="000,00%" class="form-control" required <?php if (isset($mixServico) && $mixServico != null || $mixServico != "") { echo "value=\"{$mixServico}\"";} ?> />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="metaPlanos"> Meta Planos:</label>
                            <input type="text" name="metaPlanos" placeholder="0.000,00" class="form-control" required <?php if (isset($metaPlanos) && $metaPlanos != null || $metaPlanos != "") { echo "value=\"{$metaPlanos}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="realPlanos"> Real. Planos:</label>
                            <input type="text" name="realPlanos" placeholder="0.000,00" class="form-control" required <?php if (isset($realPlanos) && $realPlanos != null || $realPlanos != "") { echo "value=\"{$realPlanos}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="planos"> Ating. Planos:</label>
                            <input type="text" name="planos" placeholder="000,00%" class="form-control" required <?php if (isset($planos) && $planos != null || $planos != "") { echo "value=\"{$planos}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="metaCartoes"> Meta Cartões:</label>
                            <input type="text" name="metaCartoes" class="form-control" required <?php if (isset($metaCartoes) && $metaCartoes != null || $metaCartoes != "") { echo "value=\"{$metaCartoes}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="realCartoes"> Real. Cartões:</label>
                            <input type="text" name="realCartoes" class="form-control" required <?php if (isset($realCartoes) && $realCartoes != null || $realCartoes != "") { echo "value=\"{$realCartoes}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cartoes"> Ating. Cartões:</label>
                            <input type="text" name="cartoes" placeholder="000,00%" class="form-control" required <?php if (isset($cartoes) && $cartoes != null || $cartoes != "") { echo "value=\"{$cartoes}\"";} ?> />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="metaDesconto"> Meta Desconto:</label>
                            <input type="text" name="metaDesconto" placeholder="0,00%" class="form-control" required <?php if (isset($metaDesconto) && $metaDesconto != null || $metaDesconto != "") { echo "value=\"{$metaDesconto}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="realDesconto"> Real. Desconto:</label>
                            <input type="text" name="realDesconto" placeholder="0,00%" class="form-control" required <?php if (isset($realDesconto) && $realDesconto != null || $realDesconto != "") { echo "value=\"{$realDesconto}\"";} ?> />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="desconto"> Ating. Desconto:</label>
                            <input type="text" name="desconto" placeholder="000,00%" class="form-control" required <?php if (isset($desconto) && $desconto != null || $desconto != "") { echo "value=\"{$desconto}\"";} ?> />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <input type="submit" value="Salvar" class="btn btn-primary"/>
                        <input type="reset" value="Limpar" class="btn btn-primary"/>
                    </div>
                </div>
            </form>
            <hr>
            <?php
            } ?>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="parametroMes">Mês:</label>
                            <select class="form-control" name="parametroMes">
                                <option value="<?php echo($mesAtual) ?>">Mês Atual</option>
                                <option value="Janeiro">Janeiro</option>
                                <option value="Fevereiro">Fevereiro</option>
                                <option value="Março">Março</option>
                                <option value="Abril">Abril</option>
                                <option value="Maio">Maio</option>
                                <option value="Junho">Junho</option>
                                <option value="Julho">Julho</option>
                                <option value="Agosto">Agosto</option>
                                <option value="Setembro">Setembro</option>
                                <option value="Outubro">Outubro</option>
                                <option value="Novembro">Novembro</option>
                                <option value="Dezembro">Dezembro</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="parametroAno">Ano:</label>
                            <select class="form-control" name="parametroAno">
                                <option value="<?php echo($anoAtual)?>">Ano Atual</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            <input style="margin-top: 25px;" type="submit" class="btn btn-primary btn-block" value="Filtrar">
                        </div>
                    </div>
                    <div style="margin-top: 2px;" class="col-md-1 hidden-xs">
                        <a href="extrairExcelResultado.php" data-toggle="tooltip" data-placement="left" title="Gerar Excel"><span style="color: #000; font-size: 20px" class="glyphicon glyphicon-save-file"></span></a>
                    </div> 
                </div>
            </form>
            <div style="margin-top: 10px; margin-bottom: 10px" class="row">
                <div class="col-md-3">
                    <h3 style="margin-top: 0!important;"><?php 
                        if (($parametroMes) || ($parametroAno)) {
                            echo ($parametroMes);?> / <?php echo ($parametroAno);  
                        }else{
                            echo ($mesAtual);?> / <?php echo ($anoAtual);
                        }  
                        ?> 
                    </h3>
                </div>           
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h4>Vendas Mercantil / Moveis / Desconto</h4>
                </div>
            </div> 
            <div class="row hidden-xs">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table style="text-align: right; width: 100%">
                            <tr class="tr1">
                                <th class="filial">Filial</th>
                                <th class="mercantil">Meta Mercantil</th>
                                <th class="mercantil">Real. Mercantil</th>
                                <th class="mercantil">Ating. Mercantil</th>
                                <th class="moveis">Meta Móveis</th>
                                <th class="moveis">Real. Móveis</th>
                                <th class="moveis">Ating. Móveis</th>
                                <th class="desconto">Meta Desconto</th>
                                <th class="desconto">Real. Desconto</th>
                                <th class="desconto">Ating. Desconto</th>
                                <th style="width: 60px;">Ações</th>
                            </tr>
                            <?php
                            if ($parametroAtual) {
                                try{
                                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial = '20' order by filial.filial");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr>";
                                            echo "<td>".$rs->filial
                                            ."</td><td>R$ ".number_format($rs->metaVendaMercantil, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realVendaMercantil, 0, ',', '.')
                                            ."</td><td>".number_format($rs->vendaMercantil, 1, ',', '')
                                            ."%</td><td>R$ ".number_format($rs->metaVendaMoveis, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realVendaMoveis, 0, ',', '.')
                                            ."</td><td>".number_format($rs->vendaMoveis, 1, ',', '')
                                            ."%</td><td>".number_format($rs->metaDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs->realDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs->desconto, 1, ',', '')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                    if ($stmt2->execute()) {
                                        while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr style='background: #2F4F4F; color: #fff'>";
                                            echo "<td>".$rs2->filial
                                            ."</td><td>R$ ".number_format($rs2->metaVendaMercantil, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realVendaMercantil, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->vendaMercantil, 1, ',', '')
                                            ."%</td><td>R$ ".number_format($rs2->metaVendaMoveis, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realVendaMoveis, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->vendaMoveis, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->metaDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->realDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->desconto, 1, ',', '')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                } catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }
                            }else{
                                try{
                                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial = '20' order by filial.filial");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr>";
                                            echo "<td>".$rs->filial
                                            ."</td><td>R$ ".number_format($rs->metaVendaMercantil, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realVendaMercantil, 0, ',', '.')
                                            ."</td><td>".number_format($rs->vendaMercantil, 1, ',', '')
                                            ."%</td><td>R$ ".number_format($rs->metaVendaMoveis, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realVendaMoveis, 0, ',', '.')
                                            ."</td><td>".number_format($rs->vendaMoveis, 1, ',', '')
                                            ."%</td><td>".number_format($rs->metaDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs->realDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs->desconto, 1, ',', '')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                    if ($stmt2->execute()) {
                                        while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr style='background: #2F4F4F; color: #fff'>";
                                            echo "<td>".$rs2->filial
                                            ."</td><td>R$ ".number_format($rs2->metaVendaMercantil, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realVendaMercantil, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->vendaMercantil, 1, ',', '')
                                            ."%</td><td>R$ ".number_format($rs2->metaVendaMoveis, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realVendaMoveis, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->vendaMoveis, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->metaDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->realDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->desconto, 1, ',', '')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                } catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row visible-xs">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table style="text-align: right; width: 1200px">
                            <tr class="tr1">
                                <th class="filial">Filial</th>
                                <th class="mercantil">Meta Mercantil</th>
                                <th class="mercantil">Real. Mercantil</th>
                                <th class="mercantil">Ating. Mercantil</th>
                                <th class="moveis">Meta Móveis</th>
                                <th class="moveis">Real. Móveis</th>
                                <th class="moveis">Ating. Móveis</th>
                                <th class="desconto">Meta Desconto</th>
                                <th class="desconto">Real. Desconto</th>
                                <th class="desconto">Ating. Desconto</th>
                                <th style="width: 60px;">Ações</th>
                            </tr>
                            <?php
                            if ($parametroAtual) {
                                try{
                                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial = '20' order by filial.filial");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr>";
                                            echo "<td>".$rs->filial
                                            ."</td><td>R$ ".number_format($rs->metaVendaMercantil, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realVendaMercantil, 0, ',', '.')
                                            ."</td><td>".number_format($rs->vendaMercantil, 1, ',', '')
                                            ."%</td><td>R$ ".number_format($rs->metaVendaMoveis, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realVendaMoveis, 0, ',', '.')
                                            ."</td><td>".number_format($rs->vendaMoveis, 1, ',', '')
                                            ."%</td><td>".number_format($rs->metaDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs->realDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs->desconto, 1, ',', '')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                    if ($stmt2->execute()) {
                                        while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr style='background: #2F4F4F; color: #fff'>";
                                            echo "<td>".$rs2->filial
                                            ."</td><td>R$ ".number_format($rs2->metaVendaMercantil, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realVendaMercantil, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->vendaMercantil, 1, ',', '')
                                            ."%</td><td>R$ ".number_format($rs2->metaVendaMoveis, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realVendaMoveis, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->vendaMoveis, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->metaDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->realDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->desconto, 1, ',', '')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                } catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }
                            }else{
                                try{
                                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial = '20' order by filial.filial");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr>";
                                            echo "<td>".$rs->filial
                                            ."</td><td>R$ ".number_format($rs->metaVendaMercantil, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realVendaMercantil, 0, ',', '.')
                                            ."</td><td>".number_format($rs->vendaMercantil, 1, ',', '')
                                            ."%</td><td>R$ ".number_format($rs->metaVendaMoveis, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realVendaMoveis, 0, ',', '.')
                                            ."</td><td>".number_format($rs->vendaMoveis, 1, ',', '')
                                            ."%</td><td>".number_format($rs->metaDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs->realDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs->desconto, 1, ',', '')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                    if ($stmt2->execute()) {
                                        while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr style='background: #2F4F4F; color: #fff'>";
                                            echo "<td>".$rs2->filial
                                            ."</td><td>R$ ".number_format($rs2->metaVendaMercantil, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realVendaMercantil, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->vendaMercantil, 1, ',', '')
                                            ."%</td><td>R$ ".number_format($rs2->metaVendaMoveis, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realVendaMoveis, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->vendaMoveis, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->metaDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->realDesconto, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->desconto, 1, ',', '')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                } catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h4>CDC / Eficiencia</h4>
                </div>
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table style="width: 750px; text-align: right;" >
                            <tr>
                                <th class="filial">Filial</th>
                                <th class="cdc">Meta CDC</th>
                                <th class="cdc">Real. CDC</th>
                                <th class="cdc">Ating. CDC</th>
                                <th class="eficiencia">Meta Eficiência</th>
                                <th class="eficiencia">Real. Eficiência</th>
                                <th class="eficiencia">Ating. Eficiência</th>
                                <th>Ações</th>
                            </tr>
                            <?php 
                            if ($parametroAtual) {
                                try{
                                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial = '20' order by filial.filial");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr>";
                                            echo "<td>".$rs->filial
                                            ."</td><td>".number_format($rs->metaCdc, 1, ',', '')
                                            ."%</td><td>".number_format($rs->realCdc, 1, ',', '')
                                            ."%</td><td>".number_format($rs->cdc, 1, ',', '')
                                            ."%</td><td>".number_format($rs->metaEficiencia, 2, ',', '')
                                            ."%</td><td>".number_format($rs->realEficiencia, 2, ',', '')
                                            ."%</td><td>".number_format($rs->eficiencia, 2, ',', '')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                    if ($stmt2->execute()) {
                                        while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr style='background: #2F4F4F; color: #fff'>";
                                            echo "<td>".$rs2->filial
                                            ."</td><td>".number_format($rs2->metaCdc, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->realCdc, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->cdc, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->metaEficiencia, 2, ',', '')
                                            ."%</td><td>".number_format($rs2->realEficiencia, 2, ',', '')
                                            ."%</td><td>".number_format($rs2->eficiencia, 2, ',', '')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                } catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                } 
                            }else{
                                try{
                                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial = '20' order by filial.filial");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr>";
                                            echo "<td>".$rs->filial
                                            ."</td><td>".number_format($rs->metaCdc, 1, ',', '')
                                            ."%</td><td>".number_format($rs->realCdc, 1, ',', '')
                                            ."%</td><td>".number_format($rs->cdc, 1, ',', '')
                                            ."%</td><td>".number_format($rs->metaEficiencia, 2, ',', '')
                                            ."%</td><td>".number_format($rs->realEficiencia, 2, ',', '')
                                            ."%</td><td>".number_format($rs->eficiencia, 2, ',', '')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                    if ($stmt2->execute()) {
                                        while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr style='background: #2F4F4F; color: #fff'>";
                                            echo "<td>".$rs2->filial
                                            ."</td><td>".number_format($rs2->metaCdc, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->realCdc, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->cdc, 1, ',', '')
                                            ."%</td><td>".number_format($rs2->metaEficiencia, 2, ',', '')
                                            ."%</td><td>".number_format($rs2->realEficiencia, 2, ',', '')
                                            ."%</td><td>".number_format($rs2->eficiencia, 2, ',', '')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                } catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                } 
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h4>Mix Serviços</h4>
                </div>
            </div>
            <div class="row hidden-xs">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table style="text-align: right; width: 120%" >
                            <tr>
                                <th class="filial">Filial</th>
                                <th class="familia1">Meta Família 1</th>
                                <th class="familia1">Real. Família 1</th>
                                <th class="familia1">Ating. Família 1</th>
                                <th class="familia2">Meta Família 2</th>
                                <th class="familia2">Real. Família 2</th>
                                <th class="familia2">Ating. Família 2</th>
                                <th class="familia3">Meta Família 3</th>
                                <th class="familia3">Real. Família 3</th>
                                <th class="familia3">Ating. Família 3</th>
                                <th class="servico">Meta Serviços</th>
                                <th class="servico">Real. Serviços</th>
                                <th class="servico">Ating. Serviços</th>
                                <th style="width: 76px;">Ações</th>
                            </tr>
                            <?php 
                            if ($parametroAtual) {
                                try{
                                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial = '20' order by filial.filial");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr>";
                                            echo "<td>".$rs->filial
                                            ."</td><td>R$ ".number_format($rs->metaFamilia1, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realFamilia1, 0, ',', '.')
                                            ."</td><td>".number_format($rs->familia1, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs->metaFamilia2, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realFamilia2, 0, ',', '.')
                                            ."</td><td>".number_format($rs->familia2, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs->metaFamilia3, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realFamilia3, 0, ',', '.')
                                            ."</td><td>".number_format($rs->familia3, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs->metaMixServico, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realMixServico, 0, ',', '.')
                                            ."</td><td>".number_format($rs->mixServico, 1, ',', '.')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                    if ($stmt2->execute()) {
                                        while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr style='background: #2F4F4F; color: #fff'>";
                                            echo "<td>".$rs2->filial
                                            ."</td><td>R$ ".number_format($rs2->metaFamilia1, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realFamilia1, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->familia1, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs2->metaFamilia2, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realFamilia2, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->familia2, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs2->metaFamilia3, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realFamilia3, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->familia3, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs2->metaMixServico, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realMixServico, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->mixServico, 1, ',', '.')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                } catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }
                            }else{
                                try{
                                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial = '20' order by filial.filial");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr>";
                                            echo "<td>".$rs->filial
                                            ."</td><td>R$ ".number_format($rs->metaFamilia1, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realFamilia1, 0, ',', '.')
                                            ."</td><td>".number_format($rs->familia1, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs->metaFamilia2, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realFamilia2, 0, ',', '.')
                                            ."</td><td>".number_format($rs->familia2, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs->metaFamilia3, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realFamilia3, 0, ',', '.')
                                            ."</td><td>".number_format($rs->familia3, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs->metaMixServico, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realMixServico, 0, ',', '.')
                                            ."</td><td>".number_format($rs->mixServico, 1, ',', '.')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                    if ($stmt2->execute()) {
                                        while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr style='background: #2F4F4F; color: #fff'>";
                                            echo "<td>".$rs2->filial
                                            ."</td><td>R$ ".number_format($rs2->metaFamilia1, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realFamilia1, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->familia1, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs2->metaFamilia2, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realFamilia2, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->familia2, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs2->metaFamilia3, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realFamilia3, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->familia3, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs2->metaMixServico, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realMixServico, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->mixServico, 1, ',', '.')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                } catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row visible-xs">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table style="text-align: right; width: 1500px" >
                            <tr>
                                <th class="filial">Filial</th>
                                <th class="familia1">Meta Família 1</th>
                                <th class="familia1">Real. Família 1</th>
                                <th class="familia1">Ating. Família 1</th>
                                <th class="familia2">Meta Família 2</th>
                                <th class="familia2">Real. Família 2</th>
                                <th class="familia2">Ating. Família 2</th>
                                <th class="familia3">Meta Família 3</th>
                                <th class="familia3">Real. Família 3</th>
                                <th class="familia3">Ating. Família 3</th>
                                <th class="servico">Meta Serviços</th>
                                <th class="servico">Real. Serviços</th>
                                <th class="servico">Ating. Serviços</th>
                                <th style="width: 76px;">Ações</th>
                            </tr>
                            <?php 
                            if ($parametroAtual) {
                                try{
                                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial = '20' order by filial.filial");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr>";
                                            echo "<td>".$rs->filial
                                            ."</td><td>R$ ".number_format($rs->metaFamilia1, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realFamilia1, 0, ',', '.')
                                            ."</td><td>".number_format($rs->familia1, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs->metaFamilia2, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realFamilia2, 0, ',', '.')
                                            ."</td><td>".number_format($rs->familia2, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs->metaFamilia3, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realFamilia3, 0, ',', '.')
                                            ."</td><td>".number_format($rs->familia3, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs->metaMixServico, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realMixServico, 0, ',', '.')
                                            ."</td><td>".number_format($rs->mixServico, 1, ',', '.')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                    if ($stmt2->execute()) {
                                        while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr style='background: #2F4F4F; color: #fff'>";
                                            echo "<td>".$rs2->filial
                                            ."</td><td>R$ ".number_format($rs2->metaFamilia1, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realFamilia1, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->familia1, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs2->metaFamilia2, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realFamilia2, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->familia2, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs2->metaFamilia3, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realFamilia3, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->familia3, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs2->metaMixServico, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realMixServico, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->mixServico, 1, ',', '.')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                } catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }
                            }else{
                                try{
                                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial = '20' order by filial.filial");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr>";
                                            echo "<td>".$rs->filial
                                            ."</td><td>R$ ".number_format($rs->metaFamilia1, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realFamilia1, 0, ',', '.')
                                            ."</td><td>".number_format($rs->familia1, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs->metaFamilia2, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realFamilia2, 0, ',', '.')
                                            ."</td><td>".number_format($rs->familia2, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs->metaFamilia3, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realFamilia3, 0, ',', '.')
                                            ."</td><td>".number_format($rs->familia3, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs->metaMixServico, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realMixServico, 0, ',', '.')
                                            ."</td><td>".number_format($rs->mixServico, 1, ',', '.')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                    if ($stmt2->execute()) {
                                        while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr style='background: #2F4F4F; color: #fff'>";
                                            echo "<td>".$rs2->filial
                                            ."</td><td>R$ ".number_format($rs2->metaFamilia1, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realFamilia1, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->familia1, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs2->metaFamilia2, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realFamilia2, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->familia2, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs2->metaFamilia3, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realFamilia3, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->familia3, 1, ',', '.')
                                            ."%</td><td>R$ ".number_format($rs2->metaMixServico, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realMixServico, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->mixServico, 1, ',', '.')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                } catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <h4>Planos / Cartões</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table style="width: 800px; text-align: right;">
                            <tr>
                                <th class="filial">Filial</th>
                                <th class="planos">Meta Planos</th>
                                <th class="planos">Real. Planos</th>
                                <th class="planos">Ating. Planos</th>
                                <th class="cartoes">Meta Cartões</th>
                                <th class="cartoes">Real. Cartões</th>
                                <th class="cartoes">Ating. Cartões</th>
                                <th>Ações</th>
                            </tr>
                            <?php 
                            if ($parametroAtual) {
                                try{
                                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial = '20' order by filial.filial");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr>";
                                            echo "<td>".$rs->filial
                                            ."</td><td>R$ ".number_format($rs->metaPlanos, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realPlanos, 0, ',', '.')
                                            ."</td><td>".number_format($rs->planos, 1, ',', '.')
                                            ."</td><td>".number_format($rs->metaCartoes, 0, ',', '.')
                                            ." Un.</td><td>".number_format($rs->realCartoes, 0, ',', '.')
                                            ." Un.</td><td>".number_format($rs->cartoes, 1, ',', '.')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                    if ($stmt2->execute()) {
                                        while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr style='background: #2F4F4F; color: #fff'>";
                                            echo "<td>".$rs2->filial
                                            ."</td><td>R$ ".number_format($rs2->metaPlanos, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realPlanos, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->planos, 1, ',', '.')
                                            ."</td><td>".number_format($rs2->metaCartoes, 0, ',', '.')
                                            ." Un.</td><td>".number_format($rs2->realCartoes, 0, ',', '.')
                                            ." Un.</td><td>".number_format($rs2->cartoes, 1, ',', '.')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                } catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }
                            }else{
                                try{
                                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial = '20' order by filial.filial");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr>";
                                            echo "<td>".$rs->filial
                                            ."</td><td>R$ ".number_format($rs->metaPlanos, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs->realPlanos, 0, ',', '.')
                                            ."</td><td>".number_format($rs->planos, 1, ',', '.')
                                            ."</td><td>".number_format($rs->metaCartoes, 0, ',', '.')
                                            ." Un.</td><td>".number_format($rs->realCartoes, 0, ',', '.')
                                            ." Un.</td><td>".number_format($rs->cartoes, 1, ',', '.')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                    if ($stmt2->execute()) {
                                        while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                            echo "<tr style='background: #2F4F4F; color: #fff'>";
                                            echo "<td>".$rs2->filial
                                            ."</td><td>R$ ".number_format($rs2->metaPlanos, 0, ',', '.')
                                            ."</td><td>R$ ".number_format($rs2->realPlanos, 0, ',', '.')
                                            ."</td><td>".number_format($rs2->planos, 1, ',', '.')
                                            ."</td><td>".number_format($rs2->metaCartoes, 0, ',', '.')
                                            ." Un.</td><td>".number_format($rs2->realCartoes, 0, ',', '.')
                                            ." Un.</td><td>".number_format($rs2->cartoes, 1, ',', '.')
                                            ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                           echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                } catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <?php
                try {
                    $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%'");
                    $stmt->bindParam(1, $idResultado, PDO::PARAM_INT);
                    if ($stmt->execute()) {
                        $rs = $stmt->fetch(PDO::FETCH_OBJ);
                        $lb = $rs->lb;
                    } else {
                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                    }
                    $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%'");
                    $stmt2->bindParam(1, $idResultado, PDO::PARAM_INT);
                    if ($stmt2->execute()) {
                        $rs2 = $stmt2->fetch(PDO::FETCH_OBJ);
                        $lb2 = $rs2->lb;
                    } else {
                        throw new PDOException("Erro: Não foi possível executar a declaração sql");
                    }
                }catch (PDOException $erro) {
                    echo "Erro: ".$erro->getMessage();
                }

                if ($lb != null || $lb2 != null) {
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>LB</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table style="width: 400px; text-align: right;">
                                    <tr>
                                        <th class="filial">Filial</th>
                                        <th class="planos">Meta LB</th>
                                        <th class="planos">Real. LB</th>
                                        <th class="planos">Ating. LB</th>
                                        <th>Ações</th>
                                    </tr>
                                    <?php 
                                    if ($parametroAtual) {
                                        try{
                                            $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                            $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial = '20' order by filial.filial");
                                            if ($stmt->execute()) {
                                                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                                    echo "<tr>";
                                                    echo "<td>".$rs->filial
                                                    ."</td><td>R$ ".number_format($rs->metaLb, 0, ',', '.')
                                                    ."</td><td>R$ ".number_format($rs->realLb, 0, ',', '.')
                                                    ."</td><td>".number_format($rs->lb, 1, ',', '.')
                                                    ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                            }
                                            if ($stmt2->execute()) {
                                                while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                                    echo "<tr style='background: #2F4F4F; color: #fff'>";
                                                    echo "<td>".$rs2->filial
                                                    ."</td><td>R$ ".number_format($rs2->metaLb, 0, ',', '.')
                                                    ."</td><td>R$ ".number_format($rs2->realLb, 0, ',', '.')
                                                    ."</td><td>".number_format($rs2->lb, 1, ',', '.')
                                                    ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                            }
                                        } catch (PDOException $erro) {
                                            echo "Erro: ".$erro->getMessage();
                                        }
                                    }else{
                                        try{
                                            $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                            $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial = '20' order by filial.filial");
                                            if ($stmt->execute()) {
                                                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                                    echo "<tr>";
                                                    echo "<td>".$rs->filial
                                                    ."</td><td>R$ ".number_format($rs->metaLb, 0, ',', '.')
                                                    ."</td><td>R$ ".number_format($rs->realLb, 0, ',', '.')
                                                    ."</td><td>".number_format($rs->lb, 1, ',', '.')
                                                    ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                            }
                                            if ($stmt2->execute()) {
                                                while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                                    echo "<tr style='background: #2F4F4F; color: #fff'>";
                                                    echo "<td>".$rs2->filial
                                                    ."</td><td>R$ ".number_format($rs2->metaLb, 0, ',', '.')
                                                    ."</td><td>R$ ".number_format($rs2->realLb, 0, ',', '.')
                                                    ."</td><td>".number_format($rs2->lb, 1, ',', '.')
                                                    ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                            }
                                        } catch (PDOException $erro) {
                                            echo "Erro: ".$erro->getMessage();
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
            <?php
                }else{
            ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>IR</h4>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table style="width: 450px; text-align: right;">
                                    <tr>
                                        <th class="filial">Filial</th>
                                        <th class="planos">Fator Mercadoria</th>
                                        <th class="planos">Fator Meio de Pagamento</th>
                                        <th class="planos">Fator Desconto</th>
                                        <th class="planos">IR</th>
                                        <th>Ações</th>
                                    </tr>
                                    <?php 
                                    if ($parametroAtual) {
                                        try{
                                            $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                            $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.idFilial = '20' order by filial.filial");
                                            if ($stmt->execute()) {
                                                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                                    echo "<tr>";
                                                    echo "<td>".$rs->filial
                                                    ."</td><td>".number_format($rs->fatorMercadoria, 2, ',', '.')
                                                    ."%</td><td>".number_format($rs->fatorMeioPagamento, 2, ',', '.')
                                                    ."%</td><td>-".number_format($rs->fatorDesconto, 2, ',', '.')
                                                    ."%</td><td>".number_format($rs->ir, 2, ',', '.')
                                                    ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                            }
                                            if ($stmt2->execute()) {
                                                while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                                    echo "<tr style='background: #2F4F4F; color: #fff'>";
                                                    echo "<td>".$rs2->filial
                                                    ."</td><td>".number_format($rs2->fatorMercadoria, 2, ',', '.')
                                                    ."%</td><td>".number_format($rs2->fatorMeioPagamento, 2, ',', '.')
                                                    ."%</td><td>-".number_format($rs2->fatorDesconto, 2, ',', '.')
                                                    ."%</td><td>".number_format($rs2->ir, 2, ',', '.')
                                                    ."%</td><td><a rs2=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                            }
                                        } catch (PDOException $erro) {
                                            echo "Erro: ".$erro->getMessage();
                                        }
                                    }else{
                                        try{
                                            $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial <> '20' order by filial.filial");
                                            $stmt2 = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.idFilial = '20' order by filial.filial");
                                            if ($stmt->execute()) {
                                                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                                    echo "<tr>";
                                                    echo "<td>".$rs->filial
                                                    ."</td><td>".number_format($rs->fatorMercadoria, 2, ',', '.')
                                                    ."%</td><td>".number_format($rs->fatorMeioPagamento, 2, ',', '.')
                                                    ."%</td><td>-".number_format($rs->fatorDesconto, 2, ',', '.')
                                                    ."%</td><td>".number_format($rs->ir, 2, ',', '.')
                                                    ."%</td><td><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                            }
                                            if ($stmt2->execute()) {
                                                while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
                                                    echo "<tr style='background: #2F4F4F; color: #fff'>";
                                                    echo "<td>".$rs2->filial
                                                    ."</td><td>".number_format($rs2->fatorMercadoria, 2, ',', '.')
                                                    ."%</td><td>".number_format($rs2->fatorMeioPagamento, 2, ',', '.')
                                                    ."%</td><td>-".number_format($rs2->fatorDesconto, 2, ',', '.')
                                                    ."%</td><td>".number_format($rs2->ir, 2, ',', '.')
                                                    ."%</td><td><a href=\"?act=upd&idResultado=".$rs2->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                            }
                                        } catch (PDOException $erro) {
                                            echo "Erro: ".$erro->getMessage();
                                        }
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
            <?php
                }
            ?>
            
        </div>

    <?php }
    else if ($_SESSION['user_funcao'] == '2') { 
        include_once("menu_gerente.php");
        include_once("consulta_resultado_gerente.php");
    }
    else if ($_SESSION['user_funcao'] == '3') { 
        include_once("menu_cal.php");
        include_once("consulta_resultado_gerente.php");
    }
    else if ($_SESSION['user_funcao'] == '4') { 
        include_once("menu_regional.php");
        include_once("consulta_resultado_regional.php");        
    }
    else if ($_SESSION['user_funcao'] == '5') { 
        include_once("menu_car.php");
        include_once("consulta_resultado_regional.php"); 
    }
    else if ($_SESSION['user_funcao'] == '6') { 
        include_once("menu_consultorTreinamento.php");
        include_once("consulta_resultado_regional.php");        
    }
    else if ($_SESSION['user_funcao'] == '7') { 
        include_once("menu_consultorTreinamentoRegional.php");
        include_once("consulta_resultado_regional.php"); 

    }
    else{} ?>
</div>
<br><br><br>
<?php

include_once("rodape.php");

?>