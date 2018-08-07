<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Regional 513</title>
  <link rel="shortcut icon" href="img/icon.png">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/aparencia.css">    
  <link rel="manifest" href="pwa/manifest.json">
  <script language="JavaScript" type="text/javascript" src="js/mascara.js"></script>
  <script language="JavaScript" type="text/javascript" src="js/efeito.js"></script>
  <script language="JavaScript" type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
  
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
        <a class="navbar-brand" href="index.php">Regional 513</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="fca.php">FCA</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Score <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="cad_score.php">Resultado Score</a></li>
              <li><a href="simulador_gerente.php">Simulador</a></li>
            </ul>
          </li>
          <li><a href="resultados.php">Resultado Mensal</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contatos <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="consulta_cal.php">CAL's</a></li>
              <li><a href="consulta_gerente.php">Gerentes</a></li>
            </ul>
          </li>
          <li><a href="anotacao.php">Anotações</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><?php echo $_SESSION['user_name']; ?> </a></li>
          <li><a href="logout.php">Sair</a></li>
        </ul>
      </div>
    </div>
  </nav>