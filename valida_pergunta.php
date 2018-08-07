<?php

require 'conexao.php';

session_start();
$id = $_SESSION['user_id'];

$resposta = isset($_POST['resposta']) ? $_POST['resposta'] : '';

if (empty($resposta))
{
	echo"<script language='javascript' type='text/javascript'>alert('O campo Resposta deve ser preenchido');window.location.href='pergunta_seguranca.php';</script>";
	exit;
}

$PDO = db_connect();

$sql = "SELECT * FROM pessoa WHERE respPerguntaSeguranca = :resposta AND  idPessoa = '$id'" ;
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':resposta', $resposta);

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['user_id'] = $id;

if (count($users) > 0) {

	header('Location: nova_senha.php');
}else{

	echo"<script language='javascript' type='text/javascript'>alert('Resposta Incorreta!');window.location.href='pergunta_seguranca.php';</script>";
	exit;
}

?>
