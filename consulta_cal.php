<?php
error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php'; 

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

?>
<div class="carregando" id="carregando"></div>
<div class="corpo" id="corpo">
<?php

if ($_SESSION['user_funcao'] == '1'){
    include_once("menu_administrador.php");
    include_once("cal.php");   
}
else if ($_SESSION['user_funcao'] == '2') { 
    include_once("menu_gerente.php");
    include_once("cal.php");
}
else if ($_SESSION['user_funcao'] == '3') { 
    include_once("menu_cal.php");
    include_once("cal.php");
}
else if ($_SESSION['user_funcao'] == '4') { 
    include_once("menu_regional.php");
    include_once("cal.php");
}
else if ($_SESSION['user_funcao'] == '5') { 
    include_once("menu_car.php");
    include_once("cal.php");
}
else if ($_SESSION['user_funcao'] == '6') { 
    include_once("menu_consultorTreinamento.php");
    include_once("cal.php");
}
else if ($_SESSION['user_funcao'] == '7') { 
    include_once("menu_consultorTreinamentoRegional.php");
    include_once("cal.php");
}
else{}
include_once("rodape.php");

?>
</div>