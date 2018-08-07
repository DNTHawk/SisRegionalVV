<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Regional 513</title>
  <link rel="shortcut icon" href="img/icon.png">
  <link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/aparencia.css"> 
  <link rel="manifest" href="pwa/manifest.json">   
  <script language="JavaScript" type="text/javascript" src="js/mascara.js"></script>
  <script language="JavaScript" type="text/javascript" src="js/sw.js"></script>
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
        <a class="navbar-brand" href="form-login.php">Regional 513</a>
      </div>
    </div>
  </nav>

  <div class="hidden-xs hidden-sm">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-4 form">
          <div class="row">
            <div class="col-md-12">
              <h3 style="text-align: center"> Login</h2>
            </div>
          </div>     
          <form action="login.php" method="post">
            <div class="row">
              <div style="margin-top: 20px" class="col-md-12">
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                      <label for="matricula">Matricula: </label>
                      <input class="form-control" type="text" name="matricula">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                      <label for="password">Senha: </label>
                      <input class="form-control" type="password" name="password">
                    </div>
                  </div>
                </div>
                <div style="margin-bottom: 10px;" class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <button class="btn btn-primary btn-block" type="submit">Entrar</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-10 col-md-offset-1">
                    <a href="primeiro_acesso.php" class="btn btn-primary btn-block">Primeiro Acesso</a>
                  </div>
                </div>
                <div class="row">
                  <div style="margin-top: 5px;" class="col-md-10 col-md-offset-1">
                    <a href="esqueceu_senha.php">Esqueceu a sua senha?</a>
                  </div>
                </div>
              </div>
            </div>        
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="visible-sm">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-sm-offset-3 form">
          <div class="row">
            <div class="col-sm-12">
              <h2 style="text-align: center"> Login</h2>
            </div>
          </div>     
          <form action="login.php" method="post">
            <div class="row">
              <div style="margin-top: 20px" class="col-sm-12">
                <div class="row">
                  <div class="col-sm-10 col-sm-offset-1">
                    <div class="form-group">
                      <label for="matricula">Matricula: </label>
                      <input class="form-control" type="text" name="matricula">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-10 col-sm-offset-1">
                    <div class="form-group">
                      <label for="password">Senha: </label>
                      <input class="form-control" type="password" name="password">
                    </div>
                  </div>
                </div>
                <div style="margin-bottom: 10px;" class="row">
                  <div class="col-sm-10 col-sm-offset-1">
                    <button class="btn btn-primary btn-block" type="submit">Entrar</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-10 col-sm-offset-1">
                    <a href="primeiro_acesso.php" class="btn btn-primary btn-block">Primeiro Acesso</a>
                  </div>
                </div>
                <div class="row">
                  <div style="margin-top: 5px;" class="col-sm-10 col-sm-offset-1">
                    <a href="esqueceu_senha.php">Esqueceu a sua senha?</a>
                  </div>
                </div>
              </div>
            </div>        
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="visible-xs">
    <div class="container">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 form-mob">
          <div class="row">
            <div class="col-xs-12">
              <h2 style="text-align: center"> Login</h2>
            </div>
          </div>     
          <form action="login.php" method="post">
            <div class="row">
              <div style="margin-top: 20px" class="col-xs-12">
                <div class="row">
                  <div class="col-xs-10 col-xs-offset-1">
                    <div class="form-group">
                      <label for="matricula">Matricula: </label>
                      <input class="form-control" type="text" name="matricula">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-10 col-xs-offset-1">
                    <div class="form-group">
                      <label for="password">Senha: </label>
                      <input class="form-control" type="password" name="password">
                    </div>
                  </div>
                </div>
                <div style="margin-bottom: 10px;" class="row">
                  <div class="col-xs-10 col-xs-offset-1">
                    <button class="btn btn-primary btn-block" type="submit">Entrar</button>
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-10 col-xs-offset-1">
                    <a href="primeiro_acesso.php" class="btn btn-primary btn-block">Primeiro Acesso</a>
                  </div>
                </div>
                <div class="row">
                  <div style="margin-top: 5px;" class="col-xs-10 col-xs-offset-1">
                    <a href="esqueceu_senha.php">Esqueceu a sua senha?</a>
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

  <div class="footer">
    <p>Copyright © Felipe Rodrigo 2018 / Desenvolvido por - Felipe Rodrigo</p>
  </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="lib/bootstrap/js/bootstrap.min.js"></script>
<script src="js/startsw.js"></script>
</body>
</html>