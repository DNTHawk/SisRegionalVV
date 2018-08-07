<?php
session_start();

require_once 'conexao.php';

require 'verifica_sessao.php';

$parametro = filter_input(INPUT_POST, "parametro");
$parametro2 = filter_input(INPUT_POST, "parametro2");

$data = date('Y/m/d');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idOs = (isset($_POST["idOs"]) && $_POST["idOs"] != null) ? $_POST["idOs"] : "";
    $centroCusto = (isset($_POST["centroCusto"]) && $_POST["centroCusto"] != null) ? $_POST["centroCusto"] : "";
    $solicitante = (isset($_POST["solicitante"]) && $_POST["solicitante"] != null) ? $_POST["solicitante"] : "";
    $tipoServico = (isset($_POST["tipoServico"]) && $_POST["tipoServico"] != null) ? $_POST["tipoServico"] : "";
    $descricao = (isset($_POST["descricao"]) && $_POST["descricao"] != null) ? $_POST["descricao"] : "";
    $dataManutencao = (isset($_POST["dataManutencao"]) && $_POST["dataManutencao"] != null) ? $_POST["dataManutencao"] : "";
    $concluido = (isset($_POST["concluido"]) && $_POST["concluido"] != null) ? $_POST["concluido"] : "";
    $numeroOs = (isset($_POST["numeroOs"]) && $_POST["numeroOs"] != null) ? $_POST["numeroOs"] : "";
    $dataSolicitacao = (isset($_POST["dataSolicitacao"]) && $_POST["dataSolicitacao"] != null) ? $_POST["dataSolicitacao"] : "";

} else if (!isset($idOs)) {
    $idOs = (isset($_GET["idOs"]) && $_GET["idOs"] != null) ? $_GET["idOs"] : "";
}

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $centroCusto != "") {
    try {
        if ($idOs != "") {
            $stmt = $conexao->prepare("UPDATE os  SET centroCusto=?, solicitante=?, tipoServico=?, descricao=? ,dataManutencao=?, concluido=?, numeroOs=?, dataSolicitacao=? WHERE idOs = ?");
            $stmt->bindParam(9, $idOs);
        } else {
            $stmt = $conexao->prepare("INSERT INTO os (centroCusto, solicitante, tipoServico, descricao, dataManutencao, concluido, numeroOs, dataSolicitacao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $centroCusto);
        $stmt->bindParam(2, $solicitante);
        $stmt->bindParam(3, $tipoServico);
        $stmt->bindParam(4, $descricao);
        $stmt->bindParam(5, $dataManutencao);
        $stmt->bindParam(6, $concluido);
        $stmt->bindParam(7, $numeroOs);
        $stmt->bindParam(8, $dataSolicitacao);
        

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
               echo"<script language='javascript' type='text/javascript'>alert('Dados cadastrado com sucesso!');window.location.href='os.php';</script>";
               $idOs = null;
               $centroCusto = null;
               $solicitante = null;
               $tipoServico = null;  
               $descricao = null;
               $dataManutencao = null;
               $concluido = null;
               $numeroOs = null;
               $dataSolicitacao = null;
               
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

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idOs != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM os, pessoa WHERE os.solicitante = pessoa.idPessoa AND idOs = ?");
        $stmt->bindParam(1, $idOs, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idOs = $rs->idOs;
            $centroCusto = $rs->centroCusto;
            $solicitante = $rs->solicitante;
            $nome = $rs->nome;
            $tipoServico = $rs->tipoServico;
            $descricao = $rs->descricao;
            $dataManutencao = $rs->dataManutencao;
            $concluido = $rs->concluido;
            $numeroOs = $rs->numeroOs;
            $dataSolicitacao = $rs->dataSolicitacao;
            
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}else{
    $centroCusto = null;
    $solicitante = null;
    $tipoServico = null;
    $descricao = null;
    $dataManutencao = null;
    $concluido = null;
    $numeroOs = null;
    $dataSolicitacao = null;
    
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idOs != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM os WHERE idOs = ?");
        $stmt->bindParam(1, $idOs, PDO::PARAM_INT);
        if ($stmt->execute()) {
           echo"<script language='javascript' type='text/javascript'>alert('Registro foi excluido com sucesso!');window.location.href='os.php';</script>";
           $idOs = null;
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
    include_once("cad_os.php");
}
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
    include_once("cad_os.php");
}
else if ($_SESSION['user_funcao'] == '5') {
    include_once("menu_car.php");
    include_once("cad_os.php");
}
else if ($_SESSION['user_funcao'] == '6') { 
    include_once("menu_consultorTreinamento.php");
    include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '7') { 
    include_once("menu_consultorTreinamentoRegional.php");
    include_once("naoPermissao.php");
}
else{}
    include_once("rodape.php");
?>
</div>


