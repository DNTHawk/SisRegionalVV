<?php
session_start();

require_once 'conexao.php';

require 'verifica_sessao.php';

?>
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
  <link rel="stylesheet" type="text/css" href="css/style.css">

  <style>
  .centro{
    width: 80px;
  }
</style>

</head>

<div class="carregando" id="carregando"></div>
<div class="corpo" id="corpo">
  <?php
  if ($_SESSION['user_funcao'] == '1'){
    include_once("menu_administrador.php");
    ?>
    <div class="container hidden-xs">
      <div class="row" style="margin-top: 20px">
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="fca.php"><img class="centro" src="img/data-search-interface-symbol-of-a-bars-graphic-with-a-magnifier-tool.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>FCA</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_score.php"><img class="centro" src="img/business-improvement.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Score</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="resultados.php"><img class="centro" src="img/line-chart.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Resultados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_ferias.php"><img class="centro" src="img/person-lying-on-a-beach-under-an-umbrella.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Férias</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="os.php"><img class="centro" src="img/tool-button.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>O.S</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_acesso_sistema.php"><img class="centro" src="img/open-lock.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Senhas</b></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 20px">
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_pessoa.php"><img class="centro" src="img/add-user-symbol.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Usuários</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_filial.php"><img class="centro" src="img/front-store.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Filiais</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_demandas.php"><img class="centro" src="img/test.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Demandas</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_feriado.php"><img class="centro" src="img/car-with-luggage.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Feriados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="anotacao.php"><img class="centro" src="img/written-page.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Anotações</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">

          </div>
        </div>
      </div>
    </div>
    <br><br><br>
    <?php
  }
  else if ($_SESSION['user_funcao'] == '2') { 
    include_once("menu_gerente.php");
    ?>
    <div class="container hidden-xs">
      <div class="row" style="margin-top: 20px">
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="fca.php"><img class="centro" src="img/data-search-interface-symbol-of-a-bars-graphic-with-a-magnifier-tool.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>FCA</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_score.php"><img class="centro" src="img/business-improvement.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Score</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="simulador_gerente.php"><img class="centro" src="img/paper-pencil-and-calculator.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Simulador</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="resultados.php"><img class="centro" src="img/line-chart.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Resultados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_feriado.php"><img class="centro" src="img/car-with-luggage-on-the-roof-rack.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Feriados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="anotacao.php"><img class="centro" src="img/written-page.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Anotações</b></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br><br><br>
    <?php
  }
  else if ($_SESSION['user_funcao'] == '3') { 
    include_once("menu_cal.php");
    ?>
    <div class="container hidden-xs">
      <div class="row" style="margin-top: 20px">
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_score.php"><img class="centro" src="img/business-improvement.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Score</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="simulador_regional.php"><img class="centro" src="img/paper-pencil-and-calculator.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Simulador</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="resultados.php"><img class="centro" src="img/line-chart.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Resultados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="#"><img class="centro" src="img/test.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Demandas</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_feriado.php"><img class="centro" src="img/car-with-luggage-on-the-roof-rack.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Feriados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="anotacao.php"><img class="centro" src="img/written-page.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Anotações</b></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br><br><br>
    <?php
  }
  else if ($_SESSION['user_funcao'] == '4') { 
    include_once("menu_regional.php");
    ?>
    <div class="container hidden-xs">
      <div class="row" style="margin-top: 20px">
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="fca.php"><img class="centro" src="img/data-search-interface-symbol-of-a-bars-graphic-with-a-magnifier-tool.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>FCA</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_score.php"><img class="centro" src="img/business-improvement.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Score</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="simulador_regional.php"><img class="centro" src="img/paper-pencil-and-calculator.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Simulador</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="resultados.php"><img class="centro" src="img/line-chart.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Resultados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_ferias.php"><img class="centro" src="img/person-lying-on-a-beach-under-an-umbrella.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Férias</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="feedback.php"><img class="centro" src="img/businessmen-talking-in-business-meeting.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>FeedBack</b></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 20px">
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_feriado.php"><img class="centro" src="img/car-with-luggage-on-the-roof-rack.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Feriados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="anotacao.php"><img class="centro" src="img/written-page.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Anotações</b></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br><br><br>
    <?php
  }
  else if ($_SESSION['user_funcao'] == '5') { 
    include_once("menu_car.php");
    ?>
    <div class="container hidden-xs">
      <div class="row" style="margin-top: 20px">
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="fca.php"><img class="centro" src="img/data-search-interface-symbol-of-a-bars-graphic-with-a-magnifier-tool.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>FCA</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_score.php"><img class="centro" src="img/business-improvement.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Score</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="simulador_car.php"><img class="centro" src="img/paper-pencil-and-calculator.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Simulador</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="resultados.php"><img class="centro" src="img/line-chart.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Resultados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_ferias.php"><img class="centro" src="img/person-lying-on-a-beach-under-an-umbrella.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Férias</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="os.php"><img class="centro" src="img/tool-button.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>O.S</b></p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 20px">
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_feriado.php"><img class="centro" src="img/car-with-luggage-on-the-roof-rack.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Feriados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="anotacao.php"><img class="centro" src="img/written-page.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Anotações</b></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br><br><br>
    <?php
  }
  else if ($_SESSION['user_funcao'] == '6') { 
    include_once("menu_consultorTreinamento.php");
    ?>
    <div class="container hidden-xs">
      <div class="row" style="margin-top: 20px">
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="fca.php"><img class="centro" src="img/data-search-interface-symbol-of-a-bars-graphic-with-a-magnifier-tool.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>FCA</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_score.php"><img class="centro" src="img/business-improvement.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Score</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="resultados.php"><img class="centro" src="img/line-chart.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Resultados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_ferias.php"><img class="centro" src="img/person-lying-on-a-beach-under-an-umbrella.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Férias</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_feriado.php"><img class="centro" src="img/car-with-luggage-on-the-roof-rack.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Feriados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="anotacao.php"><img class="centro" src="img/written-page.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Anotações</b></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br><br><br>
    <?php
  }
  else if ($_SESSION['user_funcao'] == '7') { 
    include_once("menu_consultorTreinamentoRegional.php");
    ?>
    <div class="container hidden-xs">
      <div class="row" style="margin-top: 20px">
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="fca.php"><img class="centro" src="img/data-search-interface-symbol-of-a-bars-graphic-with-a-magnifier-tool.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>FCA</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_score.php"><img class="centro" src="img/business-improvement.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Score</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="resultados.php"><img class="centro" src="img/line-chart.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Resultados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_ferias.php"><img class="centro" src="img/person-lying-on-a-beach-under-an-umbrella.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Férias</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="cad_feriado.php"><img class="centro" src="img/car-with-luggage-on-the-roof-rack.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Feriados</b></p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="col-md-8 col-md-offset-2">
            <div class="row">
              <div class="col-md-12">
                <a href="anotacao.php"><img class="centro" src="img/written-page.png"></a>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <p style="text-align: center"><b>Anotações</b></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br><br><br>
    <?php
  } 
  else{}

    ?>

<!--<div class="container">
    <div class="row">
      <div class="col-md-11"></div>
      <div class="col-md-1">
        <a href="#"><img class="centro duvidas" src="img/educational-questions-hand-drawn-speech-bubble.png"></a>
      </div>
    </div>
  </div>-->

  <?php
  include_once("rodape.php");
  ?>
</div>

