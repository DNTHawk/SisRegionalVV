<?php
session_start();

require_once 'conexao.php';

require 'verifica_sessao.php';

$filial = $_SESSION['user_filial'];
$gerente = $_SESSION['user_name'];

$valor1 = 95.0001;
$valor2 = 100.0001;
$valor3 = 110.0001;

$valor4 = 90.0001;
$valor5 = 105.0001;

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

try{
    $stmt5 = $conexao->prepare("SELECT * FROM mesAnoFCA");
    if ($stmt5->execute()) {
        while ($rs5 = $stmt5->fetch(PDO::FETCH_OBJ)) {
            $mesFca1 = $rs5->mes;
            $anoFca1 = $rs5->ano;
        }
    } else {
        echo "Erro: Não foi possível recuperar os dados do banco de dados";
    }
} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}
    
$parametroMes = filter_input(INPUT_POST, "parametroMes");
$parametroAno = filter_input(INPUT_POST, "parametroAno");


$parametroRegLoja = filter_input(INPUT_POST, "parametroRegLoja");
$parametroRegMes = filter_input(INPUT_POST, "parametroRegMes");
$parametroRegAno = filter_input(INPUT_POST, "parametroRegAno");

$parametroAtual = $mesFca1.$anoFca1;

try {
    $stmt = $conexao->prepare("SELECT * FROM fca WHERE filialFca = '$filial' AND mesAno like '$parametroAtual%'");
    $stmt->bindParam(1, $idFca, PDO::PARAM_INT);
    if ($stmt->execute()) {
        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            $array_data = explode('-', $rs->prazoMixServico);
            $data_formatada_prazoMixServico = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];

            $idFca = $rs->idFca;
            $filialFca = $rs->filialFca;
            $mesFca = $rs->mesFca;
            $anoFca = $rs->anoFca;
            $gerenteFca = $rs->gerenteFca;
            $fatoMercantil = $rs->fatoMercantil;
            $causaMercantil = $rs->causaMercantil;
            $acaoMercantil = $rs->acaoMercantil;
            $fatoMoveis = $rs->fatoMoveis;
            $causaMoveis = $rs->causaMoveis;
            $acaoMoveis = $rs->acaoMoveis;
            $fatoDesconto = $rs->fatoDesconto;
            $causaDesconto = $rs->causaDesconto;
            $acaoDesconto = $rs->acaoDesconto;
            $fatoEficiencia = $rs->fatoEficiencia;
            $causaEficiencia = $rs->causaEficiencia;
            $acaoEficiencia = $rs->acaoEficiencia;
            $fatoCdc = $rs->fatoCdc;
            $causaCdc = $rs->causaCdc;
            $acaoCdc = $rs->acaoCdc;
            $fatoMixServico = $rs->fatoMixServico;
            $causaMixServico = $rs->causaMixServico;
            $acaoMixServico = $rs->acaoMixServico;
            $fatoPlanos = $rs->fatoPlanos;
            $causaPlanos = $rs->causaPlanos;
            $acaoPlanos = $rs->acaoPlanos;
            $fatoCartoes = $rs->fatoCartoes;
            $causaCartoes = $rs->causaCartoes;
            $acaoCartoes = $rs->acaoCartoes;
            $prazoMercantil = $rs->prazoMercantil;
            $prazoMoveis = $rs->prazoMoveis;
            $prazoDesconto = $rs->prazoDesconto;
            $prazoEficiencia = $rs->prazoEficiencia;
            $prazoCdc = $rs->prazoCdc;
            $prazoMixServico = $rs->prazoMixServico;
            $prazoPlanos = $rs->prazoPlanos;
            $prazoCartoes = $rs->prazoCartoes;
            $respMercantil = $rs->respMercantil;
            $respMoveis = $rs->respMoveis;
            $respDesconto = $rs->respDesconto;
            $respEficiencia = $rs->respEficiencia;
            $respCdc = $rs->respCdc;
            $respMixServico = $rs->respMixServico;
            $respPlanos = $rs->respPlanos;
            $respCartoes = $rs->respCartoes;
            $mesAno = $rs->mesAno;

            
        }
    } else {
        echo "Erro: Não foi possível recuperar os dados do banco de dados";
    }
} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}

if ($idFca != NULL || $idFca != '') {
    
}else{
    $idFca = null;
    $filialFca = null;
    $mesFca = null;
    $anoFca = null;
    $gerenteFca = null;
    $fatoMercantil = null;
    $causaMercantil = null;
    $acaoMercantil = null;
    $fatoMoveis = null;
    $causaMoveis = null;
    $acaoMoveis = null;
    $fatoDesconto = null;
    $causaDesconto = null;
    $acaoDesconto = null;
    $fatoMoveis = null;
    $causaMoveis = null;
    $acaoMoveis = null;
    $fatoDesconto = null;
    $causaDesconto = null;
    $acaoDesconto = null;
    $fatoEficiencia = null;
    $causaEficiencia = null;
    $acaoEficiencia = null;
    $fatoCdc = null;
    $causaCdc = null;
    $acaoCdc = null;
    $fatoMixServico = null;
    $causaMixServico = null;
    $acaoMixServico = null;
    $fatoPlanos = null;
    $causaPlanos = null;
    $acaoPlanos = null;
    $fatoCartoes = null;
    $causaCartoes = null;
    $acaoCartoes = null;
    $prazoMercantil = null;
    $prazoMoveis = null;
    $prazoDesconto = null;
    $prazoEficiencia = null;
    $prazoCdc = null;
    $prazoMixServico = null;
    $prazoPlanos = null;
    $prazoCartoes = null;
    $respMercantil = null;
    $respMoveis = null;
    $respDesconto = null;
    $respEficiencia = null;
    $respCdc = null;
    $respMixServico = null;
    $respCartoes = null;
    $respPlanos = null;
    $mesAno = null;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idFca = (isset($_POST["idFca"]) && $_POST["idFca"] != null) ? $_POST["idFca"] : "";
    $filialFca = $filial;
    $mesFca = $mesFca1;
    $anoFca = $anoFca1;
    $gerenteFca = $gerente;
    $fatoMercantil = (isset($_POST["fatoMercantil"]) && $_POST["fatoMercantil"] != null) ? $_POST["fatoMercantil"] : "";
    $causaMercantil = (isset($_POST["causaMercantil"]) && $_POST["causaMercantil"] != null) ? $_POST["causaMercantil"] : "";
    $acaoMercantil = (isset($_POST["acaoMercantil"]) && $_POST["acaoMercantil"] != null) ? $_POST["acaoMercantil"] : "";
    $fatoMoveis = (isset($_POST["fatoMoveis"]) && $_POST["fatoMoveis"] != null) ? $_POST["fatoMoveis"] : "";
    $causaMoveis = (isset($_POST["causaMoveis"]) && $_POST["causaMoveis"] != null) ? $_POST["causaMoveis"] : "";
    $acaoMoveis = (isset($_POST["acaoMoveis"]) && $_POST["acaoMoveis"] != null) ? $_POST["acaoMoveis"] : "";
    $fatoDesconto = (isset($_POST["fatoDesconto"]) && $_POST["fatoDesconto"] != null) ? $_POST["fatoDesconto"] : "";
    $causaDesconto = (isset($_POST["causaDesconto"]) && $_POST["causaDesconto"] != null) ? $_POST["causaDesconto"] : "";
    $acaoDesconto = (isset($_POST["acaoDesconto"]) && $_POST["acaoDesconto"] != null) ? $_POST["acaoDesconto"] : "";
    $fatoEficiencia = (isset($_POST["fatoEficiencia"]) && $_POST["fatoEficiencia"] != null) ? $_POST["fatoEficiencia"] : "";
    $causaEficiencia = (isset($_POST["causaEficiencia"]) && $_POST["causaEficiencia"] != null) ? $_POST["causaEficiencia"] : "";
    $acaoEficiencia = (isset($_POST["acaoEficiencia"]) && $_POST["acaoEficiencia"] != null) ? $_POST["acaoEficiencia"] : "";
    $fatoCdc = (isset($_POST["fatoCdc"]) && $_POST["fatoCdc"] != null) ? $_POST["fatoCdc"] : "";
    $causaCdc = (isset($_POST["causaCdc"]) && $_POST["causaCdc"] != null) ? $_POST["causaCdc"] : "";
    $acaoCdc = (isset($_POST["acaoCdc"]) && $_POST["acaoCdc"] != null) ? $_POST["acaoCdc"] : "";
    $fatoMixServico = (isset($_POST["fatoMixServico"]) && $_POST["fatoMixServico"] != null) ? $_POST["fatoMixServico"] : "";
    $causaMixServico = (isset($_POST["causaMixServico"]) && $_POST["causaMixServico"] != null) ? $_POST["causaMixServico"] : "";
    $acaoMixServico = (isset($_POST["acaoMixServico"]) && $_POST["acaoMixServico"] != null) ? $_POST["acaoMixServico"] : "";
    $fatoPlanos = (isset($_POST["fatoPlanos"]) && $_POST["fatoPlanos"] != null) ? $_POST["fatoPlanos"] : "";
    $causaPlanos = (isset($_POST["causaPlanos"]) && $_POST["causaPlanos"] != null) ? $_POST["causaPlanos"] : "";
    $acaoPlanos = (isset($_POST["acaoPlanos"]) && $_POST["acaoPlanos"] != null) ? $_POST["acaoPlanos"] : "";
    $fatoCartoes = (isset($_POST["fatoCartoes"]) && $_POST["fatoCartoes"] != null) ? $_POST["fatoCartoes"] : "";
    $causaCartoes = (isset($_POST["causaCartoes"]) && $_POST["causaCartoes"] != null) ? $_POST["causaCartoes"] : "";
    $acaoCartoes = (isset($_POST["acaoCartoes"]) && $_POST["acaoCartoes"] != null) ? $_POST["acaoCartoes"] : "";
    $prazoMercantil = (isset($_POST["prazoMercantil"]) && $_POST["prazoMercantil"] != null) ? $_POST["prazoMercantil"] : "";
    $prazoMoveis = (isset($_POST["prazoMoveis"]) && $_POST["prazoMoveis"] != null) ? $_POST["prazoMoveis"] : "";
    $prazoDesconto = (isset($_POST["prazoDesconto"]) && $_POST["prazoDesconto"] != null) ? $_POST["prazoDesconto"] : "";
    $prazoEficiencia = (isset($_POST["prazoEficiencia"]) && $_POST["prazoEficiencia"] != null) ? $_POST["prazoEficiencia"] : "";
    $prazoCdc = (isset($_POST["prazoCdc"]) && $_POST["prazoCdc"] != null) ? $_POST["prazoCdc"] : "";
    $prazoMixServico = (isset($_POST["prazoMixServico"]) && $_POST["prazoMixServico"] != null) ? $_POST["prazoMixServico"] : "";
    $prazoPlanos = (isset($_POST["prazoPlanos"]) && $_POST["prazoPlanos"] != null) ? $_POST["prazoPlanos"] : "";
    $prazoCartoes = (isset($_POST["prazoCartoes"]) && $_POST["prazoCartoes"] != null) ? $_POST["prazoCartoes"] : "";
    $respMercantil = (isset($_POST["respMercantil"]) && $_POST["respMercantil"] != null) ? $_POST["respMercantil"] : "";
    $respMoveis = (isset($_POST["respMoveis"]) && $_POST["respMoveis"] != null) ? $_POST["respMoveis"] : "";
    $respDesconto = (isset($_POST["respDesconto"]) && $_POST["respDesconto"] != null) ? $_POST["respDesconto"] : "";
    $respEficiencia = (isset($_POST["respEficiencia"]) && $_POST["respEficiencia"] != null) ? $_POST["respEficiencia"] : "";
    $respCdc = (isset($_POST["respCdc"]) && $_POST["respCdc"] != null) ? $_POST["respCdc"] : "";
    $respMixServico = (isset($_POST["respMixServico"]) && $_POST["respMixServico"] != null) ? $_POST["respMixServico"] : "";
    $respPlanos = (isset($_POST["respPlanos"]) && $_POST["respPlanos"] != null) ? $_POST["respPlanos"] : "";
    $respCartoes = (isset($_POST["respCartoes"]) && $_POST["respCartoes"] != null) ? $_POST["respCartoes"] : "";

    $mesAno = $mesFca1.$anoFca;
} else if (!isset($idFca)) {
    $idFca = (isset($_GET["idFca"]) && $_GET["idFca"] != null) ? $_GET["idFca"] : "";
}



if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $filialFca != "") {
    try {
        if ($idFca != "") {
            $stmt = $conexao->prepare("UPDATE fca  SET filialFca=?, mesFca=?, anoFca=?, gerenteFca=?, fatoMercantil=?, causaMercantil=?, acaoMercantil=?, fatoMoveis=?, causaMoveis=?, acaoMoveis=?, fatoDesconto=?, causaDesconto=?, acaoDesconto=?, fatoEficiencia=?, causaEficiencia=?, acaoEficiencia=?, fatoCdc=?, causaCdc=?, acaoCdc=?, fatoMixServico=?, causaMixServico=?, acaoMixServico=?, fatoPlanos=?, causaPlanos=?, acaoPlanos=?, fatoCartoes=?, causaCartoes=?, acaoCartoes=?, prazoMercantil=?, prazoMoveis=?, prazoDesconto=?, prazoEficiencia=?, prazoCdc=?, prazoMixServico=?, prazoPlanos=?, prazoCartoes=?, respMercantil=?, respMoveis=?, respDesconto=?, respEficiencia=?, respCdc=?, respMixServico=?, respPlanos=?, respCartoes=?, mesAno=? WHERE idFca = ?");
            $stmt->bindParam(46, $idFca);
        } else {
            $stmt = $conexao->prepare("INSERT INTO fca (filialFca, mesFca, anoFca, gerenteFca, fatoMercantil, causaMercantil, acaoMercantil, fatoMoveis, causaMoveis, acaoMoveis, fatoDesconto, causaDesconto, acaoDesconto, fatoEficiencia, causaEficiencia, acaoEficiencia, fatoCdc, causaCdc, acaoCdc, fatoMixServico, causaMixServico, acaoMixServico,  fatoPlanos, causaPlanos, acaoPlanos, fatoCartoes, causaCartoes, acaoCartoes, prazoMercantil, prazoMoveis, prazoDesconto, prazoEficiencia, prazoCdc, prazoMixServico, prazoPlanos, prazoCartoes, respMercantil, respMoveis, respDesconto, respEficiencia, respCdc, respMixServico, respPlanos, respCartoes, mesAno) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $filialFca);
        $stmt->bindParam(2, $mesFca);
        $stmt->bindParam(3, $anoFca);
        $stmt->bindParam(4, $gerenteFca);
        $stmt->bindParam(5, $fatoMercantil);
        $stmt->bindParam(6, $causaMercantil);
        $stmt->bindParam(7, $acaoMercantil);
        $stmt->bindParam(8, $fatoMoveis);
        $stmt->bindParam(9, $causaMoveis);
        $stmt->bindParam(10, $acaoMoveis);
        $stmt->bindParam(11, $fatoDesconto);
        $stmt->bindParam(12, $causaDesconto);
        $stmt->bindParam(13, $acaoDesconto);
        $stmt->bindParam(14, $fatoEficiencia);
        $stmt->bindParam(15, $causaEficiencia);
        $stmt->bindParam(16, $acaoEficiencia);
        $stmt->bindParam(17, $fatoCdc);
        $stmt->bindParam(18, $causaCdc);
        $stmt->bindParam(19, $acaoCdc);
        $stmt->bindParam(20, $fatoMixServico);
        $stmt->bindParam(21, $causaMixServico);
        $stmt->bindParam(22, $acaoMixServico);
        $stmt->bindParam(23, $fatoPlanos);
        $stmt->bindParam(24, $causaPlanos);
        $stmt->bindParam(25, $acaoPlanos);
        $stmt->bindParam(26, $fatoCartoes);
        $stmt->bindParam(27, $causaCartoes);
        $stmt->bindParam(28, $acaoCartoes);
        $stmt->bindParam(29, $prazoMercantil);
        $stmt->bindParam(30, $prazoMoveis);
        $stmt->bindParam(31, $prazoDesconto);
        $stmt->bindParam(32, $prazoEficiencia);
        $stmt->bindParam(33, $prazoCdc);
        $stmt->bindParam(34, $prazoMixServico);
        $stmt->bindParam(35, $prazoPlanos);
        $stmt->bindParam(36, $prazoCartoes);
        $stmt->bindParam(37, $respMercantil);
        $stmt->bindParam(38, $respMoveis);
        $stmt->bindParam(39, $respDesconto);
        $stmt->bindParam(40, $respEficiencia);
        $stmt->bindParam(41, $respCdc);
        $stmt->bindParam(42, $respMixServico);
        $stmt->bindParam(43, $respPlanos);
        $stmt->bindParam(44, $respCartoes);
        $stmt->bindParam(45, $mesAno);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo"<script language='javascript' type='text/javascript'>alert('FCA cadastrado com sucesso!');window.location.href='fca.php';</script>";
                $idFca = null;
                $filialFca = null;
                $mesFca = null;
                $anoFca = null;
                $gerenteFca = null;
                $fatoMercantil = null;
                $causaMercantil = null;
                $acaoMercantil = null;
                $fatoMoveis = null;
                $causaMoveis = null;
                $acaoMoveis = null;
                $fatoDesconto = null;
                $causaDesconto = null;
                $acaoDesconto = null;
                $fatoMoveis = null;
                $causaMoveis = null;
                $acaoMoveis = null;
                $fatoDesconto = null;
                $causaDesconto = null;
                $acaoDesconto = null;
                $fatoEficiencia = null;
                $causaEficiencia = null;
                $acaoEficiencia = null;
                $fatoCdc = null;
                $causaCdc = null;
                $acaoCdc = null;
                $fatoMixServico = null;
                $causaMixServico = null;
                $acaoMixServico = null;
                $fatoPlanos = null;
                $causaPlanos = null;
                $acaoPlanos = null;
                $fatoCartoes = null;
                $causaCartoes = null;
                $acaoCartoes = null;
                $prazoMercantil = null;
                $prazoMoveis = null;
                $prazoDesconto = null;
                $prazoEficiencia = null;
                $prazoCdc = null;
                $prazoMixServico = null;
                $prazoPlanos = null;
                $prazoCartoes = null;
                $respMercantil = null;
                $respMoveis = null;
                $respDesconto = null;
                $respEficiencia = null;
                $respCdc = null;
                $respMixServico = null;
                $respCartoes = null;
                $respPlanos = null;
                $mesAno = null;
            } else {
                echo"<script language='javascript' type='text/javascript'>alert('Erro ao cadastrar FCA!');window.location.href='fca.php';</script>";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idFca != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM fca WHERE idFca = ? AND mesAno = '$mesAnoAtual'");
        $stmt->bindParam(1, $idFca, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idFca = $rs->idFca;
            $filialFca = $rs->filialFca;
            $mesFca = $rs->mesFca;
            $anoFca = $rs->anoFca;
            $gerenteFca = $rs->gerenteFca;
            $fatoMercantil = $rs->fatoMercantil;
            $causaMercantil = $rs->causaMercantil;
            $acaoMercantil = $rs->acaoMercantil;
            $fatoMoveis = $rs->fatoMoveis;
            $causaMoveis = $rs->causaMoveis;
            $acaoMoveis = $rs->acaoMoveis;
            $fatoDesconto = $rs->fatoDesconto;
            $causaDesconto = $rs->causaDesconto;
            $acaoDesconto = $rs->acaoDesconto;
            $fatoEficiencia = $rs->fatoEficiencia;
            $causaEficiencia = $rs->causaEficiencia;
            $acaoEficiencia = $rs->acaoEficiencia;
            $fatoCdc = $rs->fatoCdc;
            $causaCdc = $rs->causaCdc;
            $acaoCdc = $rs->acaoCdc;
            $fatoMixServico = $rs->fatoMixServico;
            $causaMixServico = $rs->causaMixServico;
            $acaoMixServico = $rs->acaoMixServico;
            $fatoPlanos = $rs->fatoPlanos;
            $causaPlanos = $rs->causaPlanos;
            $acaoPlanos = $rs->acaoPlanos;
            $fatoCartoes = $rs->fatoCartoes;
            $causaCartoes = $rs->causaCartoes;
            $acaoCartoes = $rs->acaoCartoes;
            $prazoMercantil = $rs->prazoMercantil;
            $prazoMoveis = $rs->prazoMoveis;
            $prazoDesconto = $rs->prazoDesconto;
            $prazoEficiencia = $rs->prazoEficiencia;
            $prazoCdc = $rs->prazoCdc;
            $prazoMixServico = $rs->prazoMixServico;
            $prazoPlanos = $rs->prazoPlanos;
            $prazoCartoes = $rs->prazoCartoes;
            $respMercantil = $rs->respMercantil;
            $respMoveis = $rs->respMoveis;
            $respDesconto = $rs->respDesconto;
            $respEficiencia = $rs->respEficiencia;
            $respCdc = $rs->respCdc;
            $respMixServico = $rs->respMixServico;
            $respPlanos = $rs->respPlanos;
            $respCartoes = $rs->respCartoes;
            $mesAno = $rs->mesAno;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idFca != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM fca WHERE idFca = ?");
        $stmt->bindParam(1, $idFca, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo"<script language='javascript' type='text/javascript'>alert('FCA excluido com sucesso!');window.location.href='fca.php';</script>";
            $idFca = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

if ($_SESSION['user_funcao'] == '1'){
    include_once("menu_administrador.php");
    include_once("fca_regional.php");
}
else if ($_SESSION['user_funcao'] == '2') { 
    include_once("menu_gerente.php");
    include_once("fca_gerente.php");
}
else if ($_SESSION['user_funcao'] == '3') { 
    include_once("menu_cal.php");
    include_once("fca_regional.php");
}
else if ($_SESSION['user_funcao'] == '4') { 
    include_once("menu_regional.php");
    include_once("fca_regional.php");
}
else if ($_SESSION['user_funcao'] == '5') { 
    include_once("menu_car.php");
    include_once("fca_regional.php");
}
else if ($_SESSION['user_funcao'] == '6') { 
    include_once("menu_consultorTreinamento.php");
    include_once("fca_regional.php");
}
else if ($_SESSION['user_funcao'] == '7') { 
    include_once("menu_consultorTreinamentoRegional.php");
    include_once("fca_regional.php");
} 
else{}


    ?>
<br><br><br><br><br>
<?php
include_once("rodape.php");
?>