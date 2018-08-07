<?php
error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php'; 

$nome = null;
$password = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$idPessoa = (isset($_POST["idPessoa"]) && $_POST["idPessoa"] != null) ? $_POST["idPessoa"] : "";
	$matricula = (isset($_POST["matricula"]) && $_POST["matricula"] != null) ? $_POST["matricula"] : "";
	$filialPessoa = (isset($_POST["filialPessoa"]) && $_POST["filialPessoa"] != null) ? $_POST["filialPessoa"] : "";
	$funcaoPessoa = (isset($_POST["funcaoPessoa"]) && $_POST["funcaoPessoa"] != null) ? $_POST["funcaoPessoa"] : "";
	$nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
	$cpf = (isset($_POST["cpf"]) && $_POST["cpf"] != null) ? $_POST["cpf"] : "";
	$email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
	$numCelular = (isset($_POST["numCelular"]) && $_POST["numCelular"] != null) ? $_POST["numCelular"] : "";
	$password = (isset($_POST["password"]) && $_POST["password"] != null) ? $_POST["password"] : "";

	$passwordHash = sha1(md5($password));
} else if (!isset($idPessoa)) {
	$idPessoa = (isset($_GET["idPessoa"]) && $_GET["idPessoa"] != null) ? $_GET["idPessoa"] : "";
}   

try {
	$conexao = db_connect();
	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conexao->exec("set names utf8");
} catch (PDOException $erro) {
	echo "Erro na conexão:".$erro->getMessage();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $matricula != "") {
	try {
		if ($idPessoa != "") {
			$stmt = $conexao->prepare("UPDATE pessoa  SET matricula=?, filialPessoa=?, funcaoPessoa=?, nome=?, cpf=?, email=?, numCelular=?, passwordHash=? WHERE idPessoa = ?");
			$stmt->bindParam(9, $idPessoa);
		} else {
			$stmt = $conexao->prepare("INSERT INTO pessoa (matricula, filialPessoa, funcaoPessoa, nome, cpf, email, numCelular, passwordHash) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		}
		$stmt->bindParam(1, $matricula);
		$stmt->bindParam(2, $filialPessoa);
		$stmt->bindParam(3, $funcaoPessoa);
		$stmt->bindParam(4, $nome);
		$stmt->bindParam(5, $cpf);
		$stmt->bindParam(6, $email);
		$stmt->bindParam(7, $numCelular);
		$stmt->bindParam(8, $passwordHash);

		if ($stmt->execute()) {
			if ($stmt->rowCount() > 0) {
				echo "<script>alert('Dados cadastrados com sucesso!')</script>";
				$idPessoa = null;
				$matricula = null;
				$filialPessoa = null;
				$funcaoPessoa = null;
				$nome = null;
				$cpf = null;
				$email = null;
				$numCelular = null;
				$passwordHash = null;
				
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

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idPessoa != "") {
	try {
		$stmt = $conexao->prepare("SELECT * FROM pessoa WHERE idPessoa = ?");
		$stmt->bindParam(1, $idPessoa, PDO::PARAM_INT);
		if ($stmt->execute()) {
			$rs = $stmt->fetch(PDO::FETCH_OBJ);
			$idPessoa = $rs->idPessoa;
			$matricula = $rs->matricula;
			$filialPessoa = $rs->filialPessoa  ;
			$funcaoPessoa = $rs->funcaoPessoa;
			$nome = $rs->nome;
			$cpf = $rs->cpf;
			$email = $rs->email;
			$numCelular = $rs->numCelular;
			$passwordHash = $rs->passwordHash;
		} else {
			throw new PDOException("Erro: Não foi possível executar a declaração sql");
		}
	} catch (PDOException $erro) {
		echo "Erro: ".$erro->getMessage();
	}
}else{
	$matricula = null;
	$filialPessoa = null;
	$funcaoPessoa = null;
	$nome = null;
	$cpf = null;
	$email = null;
	$numCelular = null;
	$passwordHash = null;
	$password = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idPessoa != "") {
	try {
		$stmt = $conexao->prepare("DELETE FROM pessoa WHERE idPessoa = ?");
		$stmt->bindParam(1, $idPessoa, PDO::PARAM_INT);
		if ($stmt->execute()) {
			echo "<script>alert('Registro excluido com sucesso!')</script>";
			$idPessoa = null;
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
		<?php if ($idPessoa != null) {?>
		<div class="row">
			<div class="col-md-12">
				<h3>Cadastro de Senhas</h3>
			</div>
		</div>
		<form action="?act=save" method="POST" name="form1">
			<div class="row">
				<input type="hidden" name="idPessoa" class="form-control" required <?php
				if (isset($idPessoa) && $idPessoa != null || $idPessoa != "") { echo "value=\"{$idPessoa}\"";} ?> />
				<div class="col-md-3">
					<div class="form-group">
						<label for="nome">Nome:</label>
						<input <?php { if (isset($nome) && $nome != null || $nome != "") { echo "id=\"{disabledInput}\"";} } ?> type="text" name="nome" class="form-control" required <?php
						if (isset($nome) && $nome != null || $nome != "") { echo "value=\"{$nome}\"";} ?> />
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="password">Senha</label>
						<input <?php { if (isset($nome) && $nome != null || $nome != "") { echo "id=\"{disabledInput}\"";} } ?> type="password" name="password" class="form-control" required>
					</div>
				</div> 
			</div>
			<input type="hidden" name="matricula" <?php
			if (isset($matricula) && $matricula != null || $matricula != "") { echo "value=\"{$matricula}\"";} ?> />

			<input type="hidden" name="filialPessoa" <?php
			if (isset($filialPessoa) && $filialPessoa != null || $filialPessoa != "") { echo "value=\"{$filialPessoa}\"";} ?> />

			<input type="hidden" name="funcaoPessoa" <?php
			if (isset($funcaoPessoa) && $funcaoPessoa != null || $funcaoPessoa != "") { echo "value=\"{$funcaoPessoa}\"";} ?> />

			<input type="hidden" name="cpf" <?php
			if (isset($cpf) && $cpf != null || $cpf != "") { echo "value=\"{$cpf}\"";} ?> />

			<input type="hidden" name="email" <?php
			if (isset($email) && $email != null || $email != "") { echo "value=\"{$email}\"";} ?> />

			<input type="hidden" name="numCelular" <?php
			if (isset($numCelular) && $numCelular != null || $numCelular != "") { echo "value=\"{$numCelular}\"";} ?> /> 

			<div class="row">
				<div class="col-md-12">
					<input type="submit" value="Salvar" class="btn btn-primary" />
					<input type="reset" value="Limpar" class="btn btn-primary" />
				</div>
			</div>
			<?php
			}?>
			<div class="row">
				<div class="col-md-12">
				</br>
				<center>
					<p>*Escolher abaixo um usuario para cadastrar a senha.</p>
				</center>
			</div>
		</div>
	</form>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<h4>Usuarios sem cadastro no sistema.</h4>
		</div>
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
						<th>Ações</th>
					</tr>
					<?php
					try {
						$stmt = $conexao->prepare("SELECT * FROM pessoa, funcao, filial WHERE pessoa.filialPessoa = filial.idFilial and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.passwordHash = 'NULL' order by filial");
						if ($stmt->execute()) {
							while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
								echo "<tr>";
								echo "<td>".$rs->nome
								."</td><td>".$rs->matricula
								."</td><td>".$rs->filial
								."</td><td>".$rs->nomeFuncao
								."</td><td><center><a href=\"?act=upd&idPessoa=".$rs->idPessoa."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
								."&nbsp;";
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
	<hr>
	<div class="row">
		<div class="col-md-12">
			<h4>Usuarios cadastrados no sistema.</h4>
		</div>
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
						<th>Ações</th>
					</tr>
					<?php
					try {
						$stmt = $conexao->prepare("SELECT * FROM pessoa, funcao, filial WHERE pessoa.filialPessoa = filial.idFilial and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.passwordHash <> 'NULL' order by filial");
						if ($stmt->execute()) {
							while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
								echo "<tr>";
								echo "<td>".$rs->nome
								."</td><td>".$rs->matricula
								."</td><td>".$rs->filial
								."</td><td>".$rs->nomeFuncao
								."</td><td><center><a href=\"?act=upd&idPessoa=".$rs->idPessoa."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
								."&nbsp";
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
<br><br><br>
<?php }
else if ($_SESSION['user_funcao'] == '2') { 
	include_once("menu_gerente.php");
}else if ($_SESSION['user_funcao'] == '3') { 
	include_once("menu_cal.php");
}else if ($_SESSION['user_funcao'] == '4') { 
	include_once("menu_regional.php");
}else if ($_SESSION['user_funcao'] == '4') { 
	include_once("menu_regional_car.php");
} else{}
	include_once("rodape.php");
?>
</div>