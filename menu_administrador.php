<!DOCTYPE html>
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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Resultados<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="resultados.php">Resultados</a></li>
              <li><a href="uploadResultado.php">Upload Resultados</a></li>
            </ul>
          </li>
          <li><a href="os.php">O.S.</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Score<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="simulador_regional.php">Gerente Regional</a></li>
              <li><a href="simulador_gerente.php">Gerente Loja</a></li>
              <li><a href="simulador_car.php">CAR</a></li>
              <li><a href="simulador_cal.php">CAL</a></li>
              <li><a href="cad_score.php">Resultado Score</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cadastros<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="cad_filial.php">Filial</a></li>
              <li><a href="cad_funcao.php">Função</a></li>
              <li><a href="cad_pessoa.php">Usuário</a></li>
              <li><a href="cad_acesso_sistema.php">Senhas</a></li>
              <li><a href="cad_ferias.php">Férias</a></li>
              <li><a href="cad_demandas.php">Demandas</a></li>
              <li><a href="cad_feriado.php">Feriados</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Contatos <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="consulta_cal.php">CAL's</a></li>
              <li><a href="consulta_gerente.php">Gerentes</a></li>
            </ul>
          </li>
          <li class="visible-xs"><a href="anotacao.php">Anotações</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><?php echo $_SESSION['user_name']; ?> </a></li>
          <li><a href="logout.php">Sair</a></li>
        </ul>
      </div>
    </div>
  </nav>