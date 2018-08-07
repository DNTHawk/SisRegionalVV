<!DOCTYPE html>
<html lang="pt">
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

  <div class="">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-2 col-xs-10 col-xs-offset-1 form">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <h3 style="text-align: center"> Primeiro Acesso</h2>
            </div>
          </div>
          <form action="valida_primeiro_acesso.php" method="POST" name="form1">
            <div class="row">
              <div style="margin-top: 20px" class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="matricula">Matricula: </label>
                      <input class="form-control" type="text" name="matricula" id="matricula" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label for="cpf">CPF:</label>
                      <input type="text" name="cpf" class="form-control" onKeyPress="MascaraCPF(form1.cpf);" maxlength="14" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <input class="btn btn-primary btn-block" type="submit" value="Entrar">
                  </div>
                </div>
              </div>  
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="hidden-xs">
    <a style="text-decoration: none; color: #fff; position: fixed; bottom: 40px; right: 5px; font-size: 10px;" href="https://br.freepik.com/fotos-gratis/conceito-empresarial-com-espaco-de-copia-mesa-de-escritorio-com-foco-na-caneta-e-quadro-de-analise-computador-caderno-xicara-de-cafe-na-mesa-tons-de-entrada-filtro-retro-foco-seletivo_1238836.htm">Foto projetada pela Freepik</a>
  </div>
  
  <?php 
  include_once("rodape.php");
  ?>