<?php
require 'conexao.php';

session_start();
$id = $_SESSION['user_id'];

$password = (isset($_POST["password"]) && $_POST["password"] != null) ? $_POST["password"] : "";
$password2 = (isset($_POST["password2"]) && $_POST["password2"] != null) ? $_POST["password2"] : "";


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
  $password2 = (isset($_POST["password2"]) && $_POST["password2"] != null) ? $_POST["password2"] : "";
  $passwordHash = sha1(md5($password));
  $perguntaSeguranca = (isset($_POST["perguntaSeguranca"]) && $_POST["perguntaSeguranca"] != null) ? $_POST["perguntaSeguranca"] : "";
  $respPerguntaSeguranca = (isset($_POST["respPerguntaSeguranca"]) && $_POST["respPerguntaSeguranca"] != null) ? $_POST["respPerguntaSeguranca"] : "";
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

if ($password == $password2) {
	if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $matricula != "") {
    try {
      if ($idPessoa != "") {
        $stmt = $conexao->prepare("UPDATE pessoa  SET matricula=?, filialPessoa=?, funcaoPessoa=?, nome=?, cpf=?, email=?, numCelular=?, passwordHash=?, perguntaSeguranca=?, respPerguntaSeguranca=? WHERE idPessoa = ?");
        $stmt->bindParam(11, $idPessoa);
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
      $stmt->bindParam(9, $perguntaSeguranca);
      $stmt->bindParam(10, $respPerguntaSeguranca);

      if ($stmt->execute()) {
        if ($stmt->rowCount() > 0) {
          echo"<script language='javascript' type='text/javascript'>alert('Senha Cadastrada!');window.location.href='form-login.php';</script>";
          $idPessoa = null;
          $matricula = null;
          $filialPessoa = null;
          $funcaoPessoa = null;
          $nome = null;
          $cpf = null;
          $email = null;
          $numCelular = null;
          $passwordHash = null;
          $perguntaSeguranca = null;
          $respPerguntaSeguranca = null;
          
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

}else{
	echo"<script language='javascript' type='text/javascript'>alert('Senhas não conferem!')</script>";
}

try {
  $stmt = $conexao->prepare("SELECT * FROM pessoa WHERE idPessoa = '$id'");
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
    $perguntaSeguranca = $rs->perguntaSeguranca;
    $respPerguntaSeguranca = $rs->respPerguntaSeguranca;
  } else {
    throw new PDOException("Erro: Não foi possível executar a declaração sql");
  }
} catch (PDOException $erro) {
  echo "Erro: ".$erro->getMessage();
}   
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Regional 513</title>

  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/aparencia.css">    
  <link rel="manifest" href="pwa/manifest.json">
  <script language="JavaScript" type="text/javascript" src="js/mascara.js"></script>
  <script language="JavaScript" type="text/javascript" src="js/efeito.js"></script>
  <script language="JavaScript" type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

  <style>
  td{
    text-transform: uppercase;
    font-size: 12px;
  }

  body{
    background-image: url('img/536.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
    background-size: cover;
  }
</style>

</head>
<body>
	<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="form-login.php">Regional 513</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="form-login.php">Login</a></li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </nav>



  <div class="container">
    <div class="row">
      <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-2 col-xs-10 col-xs-offset-1 formSenha">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 style="text-align: center"> Cadastre a Sua Senha</h2>
          </div>
        </div>
        <form action="?act=save" method="POST" name="form1">
          <input type="hidden" name="idPessoa" class="form-control" required <?php
          if (isset($idPessoa) && $idPessoa != null || $idPessoa != "") { echo "value=\"{$idPessoa}\"";} ?> />
          <div class="row">
            <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                   <label for="password">Digite a Senha</label>
                   <input type="password" name="password" class="form-control" required>
                 </div>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                   <label for="password2">Digite a Senha Novamente</label>
                   <input type="password" name="password2" class="form-control" required>
                 </div>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                   <label for="perguntaSeguranca">Pergunta de Segurança</label>
                   <select class="form-control" name="perguntaSeguranca" required="">
                     <option value="">Escolha uma pergunta</option>
                     <option value="Nome do melhor amigo de infancia?">Nome do melhor amigo de infância?</option>
                     <option value="Cidade aonde sua mãe nasceu?">Cidade aonde sua mãe nasceu?</option>
                     <option value="Ultimo nome do seu pai?">Ultimo nome do seu pai?</option>
                     <option value="Primeiro pais que você visitou?">Primeiro pais que você visitou?</option>
                     <option value="Seu time do coração?">Seu time do coração?</option>
                     <option value="Sua primeira profição?">Sua primeira profição?</option>
                     <option value="Seu estilo de musica preferida?">Sua musica preferida?</option>
                   </select>
                 </div>
               </div>
             </div>
             <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="form-group">
                   <label for="respPerguntaSeguranca">Resposta Pergunta</label>
                   <input type="text" name="respPerguntaSeguranca" class="form-control" required>
                 </div>
               </div>
             </div>
             <input type="hidden" name="nome" <?php
             if (isset($nome) && $nome != null || $nome != "") { echo "value=\"{$nome}\"";} ?> />
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
                 <input type="submit" value="Salvar" class="btn btn-primary btn-block" />
               </div>
             </div>
           </div>
         </div>
       </div>
     </form>
   </div>
 </div>
</div>

<div class="hidden-xs">
  <a style="text-decoration: none; color: #fff; position: fixed; bottom: 40px; right: 5px; font-size: 10px;" href="https://br.freepik.com/fotos-gratis/conceito-empresarial-com-espaco-de-copia-mesa-de-escritorio-com-foco-na-caneta-e-quadro-de-analise-computador-caderno-xicara-de-cafe-na-mesa-tons-de-entrada-filtro-retro-foco-seletivo_1238836.htm">Foto projetada pela Freepik</a>
</div>

<div class="footer">
  <p>Copyright © Felipe Rodrigo 2017 / Desenvolvido por - Felipe Rodrigo</p>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>