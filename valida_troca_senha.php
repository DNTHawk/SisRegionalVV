<?php

require 'conexao.php';

$matricula = isset($_POST['matricula']) ? $_POST['matricula'] : '';
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';

if (empty($matricula) || empty($cpf) )
{
	echo"<script language='javascript' type='text/javascript'>alert('O campo Matricula deve ser preenchido');window.location.href='esqueceu_senha.php';</script>";
	exit;
}

$PDO = db_connect();

$sql = "SELECT * FROM pessoa WHERE matricula = :matricula AND cpf = :cpf" ;
$stmt = $PDO->prepare($sql);

$stmt->bindParam(':matricula', $matricula);
$stmt->bindParam(':cpf', $cpf);

$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) > 0) {

	$sql2 = "SELECT * FROM pessoa  WHERE matricula = :matricula AND cpf = :cpf AND pessoa.passwordHash <> 'NULL'" ;
	$stmt2 = $PDO->prepare($sql2);

	$stmt2->bindParam(':matricula', $matricula);
	$stmt2->bindParam(':cpf', $cpf);

	$stmt2->execute();

	$users = $stmt2->fetchAll(PDO::FETCH_ASSOC);

	if (count($users) <= 0) {
		echo"<script language='javascript' type='text/javascript'>alert('Matricula não possui senha cadastrada!');window.location.href='primeiro_acesso.php';</script>";
	}

	$user = $users[0];

	session_start();
	$_SESSION['user_id'] = $user['idPessoa'];

	header('Location: pergunta_seguranca.php');
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Matricula não encotrada!');window.location.href='primeiro_acesso.php';</script>";
	exit;
}

?>
