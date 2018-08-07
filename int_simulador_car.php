<?php 
session_start();

require_once 'conexao.php';

require 'verifica_sessao.php';


$ResVendaPedido = 0;
$ResVendaBalcao = 0;
$ResDespesas = 0;
$ResAvaliacaoMovve = 0;
$ResTunover = 0;
$ResPCD = 0;
$ResENPS = 0;
$ResProdutividadeBalcao = 0;
$ResNPS = 0;
$ResIQV = 0;
$ResForaLinha = 0;
$ResGiroLento = 0;
$ResPerdaInventario = 0;

$pontoVendaPedido = 0;
$pontoVendaBalcao = 0;
$pontoDespesas = 0;
$pontoAvaliacaoMovve = 0;
$pontoTunover = 0;
$pontoPCD = 0;
$pontoENPS = 0;
$pontoProdutividadeBalcao = 0;
$pontoNPS = 0;
$pontoIQV = 0;
$pontoForaLinha = 0;
$pontoGiroLento = 0;
$pontoPerdaInventario = 0;


$resultado = 0;
$gestaoNegocio = 0;
$gestaoGente = 0;
$gestaoCliente = 0;
$gestaoOperacional = 0;

$score = 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$ResVendaPedido = (isset($_POST["ResVendaPedido"]) && $_POST["ResVendaPedido"] != null) ? $_POST["ResVendaPedido"] : "";
	$ResVendaBalcao = (isset($_POST["ResVendaBalcao"]) && $_POST["ResVendaBalcao"] != null) ? $_POST["ResVendaBalcao"] : "";
	$ResDespesas = (isset($_POST["ResDespesas"]) && $_POST["ResDespesas"] != null) ? $_POST["ResDespesas"] : "";
	$ResLucroBruto = (isset($_POST["ResLucroBruto"]) && $_POST["ResLucroBruto"] != null) ? $_POST["ResLucroBruto"] : "";
	$ResDespesas = (isset($_POST["ResDespesas"]) && $_POST["ResDespesas"] != null) ? $_POST["ResDespesas"] : "";
	$ResAvaliacaoMovve = (isset($_POST["ResAvaliacaoMovve"]) && $_POST["ResAvaliacaoMovve"] != null) ? $_POST["ResAvaliacaoMovve"] : "";
	$ResTunover = (isset($_POST["ResTunover"]) && $_POST["ResTunover"] != null) ? $_POST["ResTunover"] : "";
	$ResPCD = (isset($_POST["ResPCD"]) && $_POST["ResPCD"] != null) ? $_POST["ResPCD"] : "";
	$ResENPS = (isset($_POST["ResENPS"]) && $_POST["ResENPS"] != null) ? $_POST["ResENPS"] : "";
	$ResProdutividadeVendedor = (isset($_POST["ResProdutividadeVendedor"]) && $_POST["ResProdutividadeVendedor"] != null) ? $_POST["ResProdutividadeVendedor"] : "";
	$ResNPS = (isset($_POST["ResNPS"]) && $_POST["ResNPS"] != null) ? $_POST["ResNPS"] : "";
	$ResIQV = (isset($_POST["ResIQV"]) && $_POST["ResIQV"] != null) ? $_POST["ResIQV"] : "";
	$ResForaLinha = (isset($_POST["ResForaLinha"]) && $_POST["ResForaLinha"] != null) ? $_POST["ResForaLinha"] : "";
	$ResGiroLento = (isset($_POST["ResGiroLento"]) && $_POST["ResGiroLento"] != null) ? $_POST["ResGiroLento"] : "";
	$ResPerdaInventario = (isset($_POST["ResPerdaInventario"]) && $_POST["ResPerdaInventario"] != null) ? $_POST["ResPerdaInventario"] : "";
}

	//Primeiro Agrupamento Resultados

/*Conjunto Resultado Venda Pedido*/
if (is_numeric($ResVendaPedido)) {
	if ($ResVendaPedido < 80) {
		$pontoVendaPedido = 0;
	}elseif (($ResVendaPedido >= 80.0) && ($ResVendaPedido < 90.0)) {
		$pontoVendaPedido = 10;
	}elseif (($ResVendaPedido >= 90.0) && ($ResVendaPedido < 92.0)) {
		$pontoVendaPedido = 20;
	}elseif (($ResVendaPedido >= 92.0) && ($ResVendaPedido < 94.0)) {
		$pontoVendaPedido = 30;
	}elseif (($ResVendaPedido >= 94.0) && ($ResVendaPedido < 95.0)) {
		$pontoVendaPedido = 40;
	}elseif (($ResVendaPedido >= 95.0) && ($ResVendaPedido < 96.0)) {
		$pontoVendaPedido = 50;
	}elseif (($ResVendaPedido >= 96.0) && ($ResVendaPedido < 97.0)) {
		$pontoVendaPedido = 60;
	}elseif (($ResVendaPedido >= 97.0) && ($ResVendaPedido < 98.0)) {
		$pontoVendaPedido = 70;
	}elseif (($ResVendaPedido >= 98.0) && ($ResVendaPedido < 99.0)) {
		$pontoVendaPedido = 80;
	}elseif (($ResVendaPedido >= 99.0) && ($ResVendaPedido < 100.0)) {
		$pontoVendaPedido = 90;
	}elseif (($ResVendaPedido >= 100.0) && ($ResVendaPedido < 105.0)) {
		$pontoVendaPedido = 100;
	}elseif (($ResVendaPedido >= 105.0) && ($ResVendaPedido < 108.0)) {
		$pontoVendaPedido = 110;
	}elseif (($ResVendaPedido >= 108.0) && ($ResVendaPedido < 110.0)) {
		$pontoVendaPedido = 120;
	}elseif (($ResVendaPedido >= 110.0) && ($ResVendaPedido < 115.0)) {
		$pontoVendaPedido = 130;
	}elseif (($ResVendaPedido >= 115.0) && ($ResVendaPedido < 118.0)) {
		$pontoVendaPedido = 140;
	}elseif (($ResVendaPedido >= 118.0) && ($ResVendaPedido < 120.0)) {
		$pontoVendaPedido = 150;
	}elseif (($ResVendaPedido >= 120.0) && ($ResVendaPedido < 123.0)) {
		$pontoVendaPedido = 160;
	}elseif (($ResVendaPedido >= 123.0) && ($ResVendaPedido < 125.0)) {
		$pontoVendaPedido = 170;
	}elseif (($ResVendaPedido >= 125.0) && ($ResVendaPedido < 128.0)) {
		$pontoVendaPedido = 180;
	}elseif (($ResVendaPedido >= 128.0) && ($ResVendaPedido < 130.0)) {
		$pontoVendaPedido = 190;
	}else{
		$pontoVendaPedido = 200;
	}
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor Venda Mercantil está Incorreto!');window.location.href='simulador_car.php';</script>";
}

/*Conjunto Resultado Eficiencia*/
if (is_numeric($ResVendaBalcao)) {
	if ($ResVendaBalcao < 80) {
		$pontoVendaBalcao = 0;
	}elseif (($ResVendaBalcao >= 80.0) && ($ResVendaBalcao < 90.0)) {
		$pontoVendaBalcao = 10;
	}elseif (($ResVendaBalcao >= 90.0) && ($ResVendaBalcao < 92.0)) {
		$pontoVendaBalcao = 20;
	}elseif (($ResVendaBalcao >= 92.0) && ($ResVendaBalcao < 94.0)) {
		$pontoVendaBalcao = 30;
	}elseif (($ResVendaBalcao >= 94.0) && ($ResVendaBalcao < 95.0)) {
		$pontoVendaBalcao = 40;
	}elseif (($ResVendaBalcao >= 95.0) && ($ResVendaBalcao < 96.0)) {
		$pontoVendaBalcao = 50;
	}elseif (($ResVendaBalcao >= 96.0) && ($ResVendaBalcao < 97.0)) {
		$pontoVendaBalcao = 60;
	}elseif (($ResVendaBalcao >= 97.0) && ($ResVendaBalcao < 98.0)) {
		$pontoVendaBalcao = 70;
	}elseif (($ResVendaBalcao >= 98.0) && ($ResVendaBalcao < 99.0)) {
		$pontoVendaBalcao = 80;
	}elseif (($ResVendaBalcao >= 99.0) && ($ResVendaBalcao < 100.0)) {
		$pontoVendaBalcao = 90;
	}elseif (($ResVendaBalcao >= 100.0) && ($ResVendaBalcao < 105.0)) {
		$pontoVendaBalcao = 100;
	}elseif (($ResVendaBalcao >= 105.0) && ($ResVendaBalcao < 108.0)) {
		$pontoVendaBalcao = 110;
	}elseif (($ResVendaBalcao >= 108.0) && ($ResVendaBalcao < 110.0)) {
		$pontoVendaBalcao = 120;
	}elseif (($ResVendaBalcao >= 110.0) && ($ResVendaBalcao < 115.0)) {
		$pontoVendaBalcao = 130;
	}elseif (($ResVendaBalcao >= 115.0) && ($ResVendaBalcao < 118.0)) {
		$pontoVendaBalcao = 140;
	}elseif (($ResVendaBalcao >= 118.0) && ($ResVendaBalcao < 120.0)) {
		$pontoVendaBalcao = 150;
	}elseif (($ResVendaBalcao >= 120.0) && ($ResVendaBalcao < 123.0)) {
		$pontoVendaBalcao = 160;
	}elseif (($ResVendaBalcao >= 123.0) && ($ResVendaBalcao < 125.0)) {
		$pontoVendaBalcao = 170;
	}elseif (($ResVendaBalcao >= 125.0) && ($ResVendaBalcao < 128.0)) {
		$pontoVendaBalcao = 180;
	}elseif (($ResVendaBalcao >= 128.0) && ($ResVendaBalcao < 130.0)) {
		$pontoVendaBalcao = 190;
	}else{
		$pontoVendaBalcao = 200;
	}
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor Eficiência está Incorreta!');window.location.href='simulador_car.php';</script>";
}

/*Conjunto Resultado CDC*/
if (is_numeric($ResDespesas)) {
	if ($ResDespesas < 80) {
		$pontoDespesas = 0;
	}elseif (($ResDespesas >= 80.0) && ($ResDespesas < 90.0)) {
		$pontoDespesas = 10;
	}elseif (($ResDespesas >= 90.0) && ($ResDespesas < 92.0)) {
		$pontoDespesas = 20;
	}elseif (($ResDespesas >= 92.0) && ($ResDespesas < 94.0)) {
		$pontoDespesas = 30;
	}elseif (($ResDespesas >= 94.0) && ($ResDespesas < 95.0)) {
		$pontoDespesas = 40;
	}elseif (($ResDespesas >= 95.0) && ($ResDespesas < 96.0)) {
		$pontoDespesas = 50;
	}elseif (($ResDespesas >= 96.0) && ($ResDespesas < 97.0)) {
		$pontoDespesas = 60;
	}elseif (($ResDespesas >= 97.0) && ($ResDespesas < 98.0)) {
		$pontoDespesas = 70;
	}elseif (($ResDespesas >= 98.0) && ($ResDespesas < 99.0)) {
		$pontoDespesas = 80;
	}elseif (($ResDespesas >= 99.0) && ($ResDespesas < 100.0)) {
		$pontoDespesas = 90;
	}elseif (($ResDespesas >= 100.0) && ($ResDespesas < 105.0)) {
		$pontoDespesas = 100;
	}elseif (($ResDespesas >= 105.0) && ($ResDespesas < 108.0)) {
		$pontoDespesas = 110;
	}elseif (($ResDespesas >= 108.0) && ($ResDespesas < 110.0)) {
		$pontoDespesas = 120;
	}elseif (($ResDespesas >= 110.0) && ($ResDespesas < 115.0)) {
		$pontoDespesas = 130;
	}elseif (($ResDespesas >= 115.0) && ($ResDespesas < 118.0)) {
		$pontoDespesas = 140;
	}elseif (($ResDespesas >= 118.0) && ($ResDespesas < 120.0)) {
		$pontoDespesas = 150;
	}elseif (($ResDespesas >= 120.0) && ($ResDespesas < 123.0)) {
		$pontoDespesas = 160;
	}elseif (($ResDespesas >= 123.0) && ($ResDespesas < 125.0)) {
		$pontoDespesas = 170;
	}elseif (($ResDespesas >= 125.0) && ($ResDespesas < 128.0)) {
		$pontoDespesas = 180;
	}elseif (($ResDespesas >= 128.0) && ($ResDespesas < 130.0)) {
		$pontoDespesas = 190;
	}else{
		$pontoDespesas = 200;
	}
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor CDC está Incorreto!');window.location.href='simulador_car.php';</script>";
}

$peso10 = 10/100;
$peso15 = 15/100;
$peso20 = 20/100;
$peso25 = 25/100;
$peso30 = 30/100;
$peso40 = 40/100;
$peso50 = 50/100;
$peso100 = 100/100;

//Bloco filtro peso do indicador de resultado
$filtroPesoVendaPedido = $peso30 * $pontoVendaPedido;
$filtroPesoVendaBalcao = $peso50 * $pontoVendaBalcao;
$filtroPesoDespesas = $peso20 * $pontoDespesas;

//soma de todos as notas depois do primeiro filtro de peso
$notaResultado = $filtroPesoVendaPedido + $filtroPesoVendaBalcao + $filtroPesoDespesas;

//Segundo agrupamento Gestão de Negócio
if (is_numeric($ResAvaliacaoMovve)) {
	if ($ResAvaliacaoMovve < 52.5) {
		$pontoAvaliacaoMovve = 0;
	}elseif (($ResAvaliacaoMovve >= 52.5) && ($ResAvaliacaoMovve < 55.0)) {
		$pontoAvaliacaoMovve = 10;
	}elseif (($ResAvaliacaoMovve >= 55.0) && ($ResAvaliacaoMovve < 57.5)) {
		$pontoAvaliacaoMovve = 20;
	}elseif (($ResAvaliacaoMovve >= 57.5) && ($ResAvaliacaoMovve < 60.0)) {
		$pontoAvaliacaoMovve = 30;
	}elseif (($ResAvaliacaoMovve >= 60.0) && ($ResAvaliacaoMovve < 62.5)) {
		$pontoAvaliacaoMovve = 40;
	}elseif (($ResAvaliacaoMovve >= 62.5) && ($ResAvaliacaoMovve < 65.0)) {
		$pontoAvaliacaoMovve = 50;
	}elseif (($ResAvaliacaoMovve >= 65.0) && ($ResAvaliacaoMovve < 67.5)) {
		$pontoAvaliacaoMovve = 60;
	}elseif (($ResAvaliacaoMovve >= 67.5) && ($ResAvaliacaoMovve < 70.0)) {
		$pontoAvaliacaoMovve = 70;
	}elseif (($ResAvaliacaoMovve >= 70.0) && ($ResAvaliacaoMovve < 72.5)) {
		$pontoAvaliacaoMovve = 80;
	}elseif (($ResAvaliacaoMovve >= 72.5) && ($ResAvaliacaoMovve < 75.0)) {
		$pontoAvaliacaoMovve = 90;
	}elseif (($ResAvaliacaoMovve >= 75.0) && ($ResAvaliacaoMovve < 77.5)) {
		$pontoAvaliacaoMovve = 100;
	}elseif (($ResAvaliacaoMovve >= 77.5) && ($ResAvaliacaoMovve < 80.0)) {
		$pontoAvaliacaoMovve = 110;
	}elseif (($ResAvaliacaoMovve >= 80.0) && ($ResAvaliacaoMovve < 82.5)) {
		$pontoAvaliacaoMovve = 120;
	}elseif (($ResAvaliacaoMovve >= 82.5) && ($ResAvaliacaoMovve < 85.0)) {
		$pontoAvaliacaoMovve = 130;
	}elseif (($ResAvaliacaoMovve >= 85.0) && ($ResAvaliacaoMovve < 87.5)) {
		$pontoAvaliacaoMovve = 140;
	}elseif (($ResAvaliacaoMovve >= 87.5) && ($ResAvaliacaoMovve < 90.0)) {
		$pontoAvaliacaoMovve = 150;
	}elseif (($ResAvaliacaoMovve >= 90.0) && ($ResAvaliacaoMovve < 92.5)) {
		$pontoAvaliacaoMovve = 160;
	}elseif (($ResAvaliacaoMovve >= 92.5) && ($ResAvaliacaoMovve < 95.0)) {
		$pontoAvaliacaoMovve = 170;
	}elseif (($ResAvaliacaoMovve >= 95.0) && ($ResAvaliacaoMovve < 97.5)) {
		$pontoAvaliacaoMovve = 180;
	}elseif (($ResAvaliacaoMovve >= 97.5) && ($ResAvaliacaoMovve < 100.00)) {
		$pontoAvaliacaoMovve = 190;
	}else{
		$pontoAvaliacaoMovve = 200;
	}
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor Avaliação MOVVE está Incorreto!');window.location.href='simulador_car.php';</script>";
}

$filtroPesoAvaliacaoMovve = $peso100 * $pontoAvaliacaoMovve;

$notaGestaoNegocio = $filtroPesoAvaliacaoMovve;

//Terceiro agrupamento Gestão de Gente

if (is_numeric($ResTunover)) {
	if ($ResTunover <= 50.0) {
		$pontoTunover = 200;
	}elseif (($ResTunover > 50.0)&& ($ResTunover <=55.0)) {
		$pontoTunover = 190;
	}elseif (($ResTunover > 55.0)&& ($ResTunover <=60.0)) {
		$pontoTunover = 180;
	}elseif (($ResTunover > 60.0)&& ($ResTunover <=65.0)) {
		$pontoTunover = 170;
	}elseif (($ResTunover > 65.0)&& ($ResTunover <=70.0)) {
		$pontoTunover = 160;
	}elseif (($ResTunover > 70.0)&& ($ResTunover <=75.0)) {
		$pontoTunover = 150;
	}elseif (($ResTunover > 75.0)&& ($ResTunover <=80.0)) {
		$pontoTunover = 140;
	}elseif (($ResTunover > 80.0)&& ($ResTunover <=85.0)) {
		$pontoTunover = 130;
	}elseif (($ResTunover > 85.0)&& ($ResTunover <=90.0)) {
		$pontoTunover = 120;
	}elseif (($ResTunover > 90.0)&& ($ResTunover <=95.0)) {
		$pontoTunover = 110;
	}elseif (($ResTunover > 95.0)&& ($ResTunover <=100.0)) {
		$pontoTunover = 100;
	}elseif (($ResTunover > 100.0)&& ($ResTunover <=105.0)) {
		$pontoTunover = 90;
	}elseif (($ResTunover > 105.0)&& ($ResTunover <=110.0)) {
		$pontoTunover = 80;
	}elseif (($ResTunover > 110.0)&& ($ResTunover <=115.0)) {
		$pontoTunover = 70;
	}elseif (($ResTunover > 115.0)&& ($ResTunover <=120.0)) {
		$pontoTunover = 60;
	}elseif (($ResTunover > 120.0)&& ($ResTunover <=125.0)) {
		$pontoTunover = 50;
	}elseif (($ResTunover > 125.0)&& ($ResTunover <=130.0)) {
		$pontoTunover = 40;
	}elseif (($ResTunover > 130.0)&& ($ResTunover <=135.0)) {
		$pontoTunover = 30;
	}elseif (($ResTunover > 135.0)&& ($ResTunover <=140.0)) {
		$pontoTunover = 20;
	}elseif (($ResTunover > 140.0)&& ($ResTunover <=145.0)) {
		$pontoTunover = 10;
	}else{
		$pontoTunover = 0;
	}
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor Turnover está Incorreto!');window.location.href='simulador_car.php';</script>";
}

if (is_numeric($ResPCD)) {
	if ($ResPCD < 55.0) {
		$pontoPCD = 0;
	}elseif (($ResPCD >= 55.0) && ($ResPCD < 60.0)) {
		$pontoPCD = 10;
	}elseif (($ResPCD >= 60.0) && ($ResPCD < 65.0)) {
		$pontoPCD = 20;
	}elseif (($ResPCD >= 65.0) && ($ResPCD < 70.0)) {
		$pontoPCD = 30;
	}elseif (($ResPCD >= 70.0) && ($ResPCD < 75.0)) {
		$pontoPCD = 40;
	}elseif (($ResPCD >= 75.0) && ($ResPCD < 80.0)) {
		$pontoPCD = 50;
	}elseif (($ResPCD >= 80.0) && ($ResPCD < 85.0)) {
		$pontoPCD = 60;
	}elseif (($ResPCD >= 85.0) && ($ResPCD < 90.0)) {
		$pontoPCD = 70;
	}elseif (($ResPCD >= 90.0) && ($ResPCD < 95.0)) {
		$pontoPCD = 80;
	}elseif (($ResPCD >= 95.0) && ($ResPCD < 100.0)) {
		$pontoPCD = 90;
	}elseif (($ResPCD >= 100.0) && ($ResPCD < 105.0)) {
		$pontoPCD = 100;
	}elseif (($ResPCD >= 105.0) && ($ResPCD < 110.0)) {
		$pontoPCD = 110;
	}elseif (($ResPCD >= 110.0) && ($ResPCD < 115.0)) {
		$pontoPCD = 120;
	}elseif (($ResPCD >= 115.0) && ($ResPCD < 120.0)) {
		$pontoPCD = 130;
	}elseif (($ResPCD >= 120.0) && ($ResPCD < 125.0)) {
		$pontoPCD = 140;
	}elseif (($ResPCD >= 125.0) && ($ResPCD < 130.0)) {
		$pontoPCD = 150;
	}elseif (($ResPCD >= 130.0) && ($ResPCD < 135.0)) {
		$pontoPCD = 160;
	}elseif (($ResPCD >= 135.0) && ($ResPCD < 140.0)) {
		$pontoPCD = 170;
	}elseif (($ResPCD >= 140.0) && ($ResPCD < 145.0)) {
		$pontoPCD = 180;
	}elseif (($ResPCD >= 145.0) && ($ResPCD < 150.00)) {
		$pontoPCD = 190;
	}else{
		$pontoPCD = 200;
	}
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor PCD está Incorreto!');window.location.href='simulador_car.php';</script>";
}


if (is_numeric($ResENPS)) {
	if ($ResENPS < 52.5) {
		$pontoENPS = 0;
	}elseif (($ResENPS >= 52.5) && ($ResENPS < 55.0)) {
		$pontoENPS = 10;
	}elseif (($ResENPS >= 55.0) && ($ResENPS < 57.5)) {
		$pontoENPS = 20;
	}elseif (($ResENPS >= 57.5) && ($ResENPS < 60.0)) {
		$pontoENPS = 30;
	}elseif (($ResENPS >= 60.0) && ($ResENPS < 62.5)) {
		$pontoENPS = 40;
	}elseif (($ResENPS >= 62.5) && ($ResENPS < 65.0)) {
		$pontoENPS = 50;
	}elseif (($ResENPS >= 65.0) && ($ResENPS < 67.5)) {
		$pontoENPS = 60;
	}elseif (($ResENPS >= 67.5) && ($ResENPS < 70.0)) {
		$pontoENPS = 70;
	}elseif (($ResENPS >= 70.0) && ($ResENPS < 72.5)) {
		$pontoENPS = 80;
	}elseif (($ResENPS >= 72.5) && ($ResENPS < 75.0)) {
		$pontoENPS = 90;
	}elseif (($ResENPS >= 75.0) && ($ResENPS < 77.5)) {
		$pontoENPS = 100;
	}elseif (($ResENPS >= 77.5) && ($ResENPS < 80.0)) {
		$pontoENPS = 110;
	}elseif (($ResENPS >= 80.0) && ($ResENPS < 82.5)) {
		$pontoENPS = 120;
	}elseif (($ResENPS >= 82.5) && ($ResENPS < 85.0)) {
		$pontoENPS = 130;
	}elseif (($ResENPS >= 85.0) && ($ResENPS < 87.5)) {
		$pontoENPS = 140;
	}elseif (($ResENPS >= 87.5) && ($ResENPS < 90.0)) {
		$pontoENPS = 150;
	}elseif (($ResENPS >= 90.0) && ($ResENPS < 92.5)) {
		$pontoENPS = 160;
	}elseif (($ResENPS >= 92.5) && ($ResENPS < 95.0)) {
		$pontoENPS = 170;
	}elseif (($ResENPS >= 95.0) && ($ResENPS < 97.5)) {
		$pontoENPS = 180;
	}elseif (($ResENPS >= 97.5) && ($ResENPS < 100.00)) {
		$pontoENPS = 190;
	}else{
		$pontoENPS = 200;
	}
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor E-NPS está Incorreto!');window.location.href='simulador_car.php';</script>";
}

if (is_numeric($ResProdutividadeBalcao)) {
	if ($ResProdutividadeBalcao < 71.5) {
		$pontoProdutividadeBalcao = 0;
	}elseif (($ResProdutividadeBalcao >= 71.5) && ($ResProdutividadeBalcao < 73.0)) {
		$pontoProdutividadeBalcao = 10;
	}elseif (($ResProdutividadeBalcao >= 73.0) && ($ResProdutividadeBalcao < 74.5)) {
		$pontoProdutividadeBalcao = 20;
	}elseif (($ResProdutividadeBalcao >= 74.5) && ($ResProdutividadeBalcao < 76.0)) {
		$pontoProdutividadeBalcao = 30;
	}elseif (($ResProdutividadeBalcao >= 76.0) && ($ResProdutividadeBalcao < 77.5)) {
		$pontoProdutividadeBalcao = 40;
	}elseif (($ResProdutividadeBalcao >= 77.5) && ($ResProdutividadeBalcao < 79.0)) {
		$pontoProdutividadeBalcao = 50;
	}elseif (($ResProdutividadeBalcao >= 79.0) && ($ResProdutividadeBalcao < 80.5)) {
		$pontoProdutividadeBalcao = 60;
	}elseif (($ResProdutividadeBalcao >= 80.5) && ($ResProdutividadeBalcao < 82.0)) {
		$pontoProdutividadeBalcao = 70;
	}elseif (($ResProdutividadeBalcao >= 82.0) && ($ResProdutividadeBalcao < 83.5)) {
		$pontoProdutividadeBalcao = 80;
	}elseif (($ResProdutividadeBalcao >= 83.5) && ($ResProdutividadeBalcao < 85.0)) {
		$pontoProdutividadeBalcao = 90;
	}elseif (($ResProdutividadeBalcao >= 85.0) && ($ResProdutividadeBalcao < 86.5)) {
		$pontoProdutividadeBalcao = 100;
	}elseif (($ResProdutividadeBalcao >= 86.5) && ($ResProdutividadeBalcao < 88.0)) {
		$pontoProdutividadeBalcao = 110;
	}elseif (($ResProdutividadeBalcao >= 88.0) && ($ResProdutividadeBalcao < 89.5)) {
		$pontoProdutividadeBalcao = 120;
	}elseif (($ResProdutividadeBalcao >= 89.5) && ($ResProdutividadeBalcao < 91.0)) {
		$pontoProdutividadeBalcao = 130;
	}elseif (($ResProdutividadeBalcao >= 91.0) && ($ResProdutividadeBalcao < 92.5)) {
		$pontoProdutividadeBalcao = 140;
	}elseif (($ResProdutividadeBalcao >= 92.5) && ($ResProdutividadeBalcao < 94.0)) {
		$pontoProdutividadeBalcao = 150;
	}elseif (($ResProdutividadeBalcao >= 94.0) && ($ResProdutividadeBalcao < 95.5)) {
		$pontoProdutividadeBalcao = 160;
	}elseif (($ResProdutividadeBalcao >= 95.5) && ($ResProdutividadeBalcao < 97.0)) {
		$pontoProdutividadeBalcao = 170;
	}elseif (($ResProdutividadeBalcao >= 97.0) && ($ResProdutividadeBalcao < 98.5)) {
		$pontoProdutividadeBalcao = 180;
	}elseif (($ResProdutividadeBalcao >= 98.5) && ($ResProdutividadeBalcao < 100.00)) {
		$pontoProdutividadeBalcao = 190;
	}else{
		$pontoProdutividadeBalcao = 200;
	}
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor Produtividade Vendedor está Incorreto!');window.location.href='simulador_car.php';</script>";
}

//Bloco filtro peso do indicador de resultado
$filtroPesoTunover = $peso25 * $pontoTunover;
$filtroPesoPCD = $peso25 * $pontoPCD;
$filtroPesoENPS = $peso25 * $pontoENPS;
$filtroPesoPB = $peso25 * $pontoProdutividadeBalcao;

//soma de todos as notas depois do primeiro filtro de peso
$notaGestaoGente = $filtroPesoTunover + $filtroPesoPCD + $filtroPesoENPS + $filtroPesoPB;


// Conjunto agrupamento Gestão de Cliente
if (is_numeric($ResNPS)) {
	if ($ResNPS < 52.5) {
		$pontoNPS = 0;
	}elseif (($ResNPS >= 52.5) && ($ResNPS < 55.0)) {
		$pontoNPS = 10;
	}elseif (($ResNPS >= 55.0) && ($ResNPS < 57.5)) {
		$pontoNPS = 20;
	}elseif (($ResNPS >= 57.5) && ($ResNPS < 60.0)) {
		$pontoNPS = 30;
	}elseif (($ResNPS >= 60.0) && ($ResNPS < 62.5)) {
		$pontoNPS = 40;
	}elseif (($ResNPS >= 62.5) && ($ResNPS < 65.0)) {
		$pontoNPS = 50;
	}elseif (($ResNPS >= 65.0) && ($ResNPS < 67.5)) {
		$pontoNPS = 60;
	}elseif (($ResNPS >= 67.5) && ($ResNPS < 70.0)) {
		$pontoNPS = 70;
	}elseif (($ResNPS >= 70.0) && ($ResNPS < 72.5)) {
		$pontoNPS = 80;
	}elseif (($ResNPS >= 72.5) && ($ResNPS < 75.0)) {
		$pontoNPS = 90;
	}elseif (($ResNPS >= 75.0) && ($ResNPS < 77.5)) {
		$pontoNPS = 100;
	}elseif (($ResNPS >= 77.5) && ($ResNPS < 80.0)) {
		$pontoNPS = 110;
	}elseif (($ResNPS >= 80.0) && ($ResNPS < 82.5)) {
		$pontoNPS = 120;
	}elseif (($ResNPS >= 82.5) && ($ResNPS < 85.0)) {
		$pontoNPS = 130;
	}elseif (($ResNPS >= 85.0) && ($ResNPS < 87.5)) {
		$pontoNPS = 140;
	}elseif (($ResNPS >= 87.5) && ($ResNPS < 90.0)) {
		$pontoNPS = 150;
	}elseif (($ResNPS >= 90.0) && ($ResNPS < 92.5)) {
		$pontoNPS = 160;
	}elseif (($ResNPS >= 92.5) && ($ResNPS < 95.0)) {
		$pontoNPS = 170;
	}elseif (($ResNPS >= 95.0) && ($ResNPS < 97.5)) {
		$pontoNPS = 180;
	}elseif (($ResNPS >= 97.5) && ($ResNPS < 100.00)) {
		$pontoNPS = 190;
	}else{
		$pontoNPS = 200;
	}
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor NPS está Incorreto!');window.location.href='simulador_car.php';</script>";
}

$filtroPesoNPS = $peso100 * $pontoNPS;

$notaGestaoCliente = $filtroPesoNPS;

//Conjunto agrupamento Gestão Operacional
if (is_numeric($ResIQV)) {
	if ($ResIQV < 1.0) {
		$pontoIQV = 0;
	}elseif (($ResIQV >= 1.0) && ($ResIQV < 1.5)) {
		$pontoIQV = 10;
	}elseif (($ResIQV >= 1.5) && ($ResIQV < 2.0)) {
		$pontoIQV = 30;
	}elseif (($ResIQV >= 2.0) && ($ResIQV < 2.5)) {
		$pontoIQV = 50;
	}elseif (($ResIQV >= 2.5) && ($ResIQV < 3)) {
		$pontoIQV = 80;
	}elseif (($ResIQV >= 3.0) && ($ResIQV < 3.5)) {
		$pontoIQV = 100;
	}elseif (($ResIQV >= 3.5) && ($ResIQV < 4.0)) {
		$pontoIQV = 120;
	}elseif (($ResIQV >= 4.0) && ($ResIQV < 4.5)) {
		$pontoIQV = 150;
	}elseif (($ResIQV >= 4.5) && ($ResIQV < 5.0)) {
		$pontoIQV = 170;
	}elseif ($ResIQV == 5.0) {
		$pontoIQV = 200;
	}else{
		echo"<script language='javascript' type='text/javascript'>alert('Valor do IQV não pode ultrapassar 5 ou ser negativo!');window.location.href='simulador_car.php';</script>";
	}
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor IQV está Incorreto!');window.location.href='simulador_car.php';</script>";
}

if (is_numeric($ResForaLinha)) {
	if ($ResForaLinha == 0.0) {
		$pontoForaLinha = 200;
	}elseif (($ResForaLinha > 0.0)&& ($ResForaLinha <=5.0)) {
		$pontoForaLinha = 190;
	}elseif (($ResForaLinha > 5.0)&& ($ResForaLinha <=10.0)) {
		$pontoForaLinha = 180;
	}elseif (($ResForaLinha > 10.0)&& ($ResForaLinha <=15.0)) {
		$pontoForaLinha = 170;
	}elseif (($ResForaLinha > 15.0)&& ($ResForaLinha <=20.0)) {
		$pontoForaLinha = 160;
	}elseif (($ResForaLinha > 20.0)&& ($ResForaLinha <=25.0)) {
		$pontoForaLinha = 150;
	}elseif (($ResForaLinha > 25.0)&& ($ResForaLinha <=30.0)) {
		$pontoForaLinha = 140;
	}elseif (($ResForaLinha > 30.0)&& ($ResForaLinha <=35.0)) {
		$pontoForaLinha = 130;
	}elseif (($ResForaLinha > 35.0)&& ($ResForaLinha <=40.0)) {
		$pontoForaLinha = 120;
	}elseif (($ResForaLinha > 40.0)&& ($ResForaLinha <=45.0)) {
		$pontoForaLinha = 110;
	}elseif (($ResForaLinha > 45.0)&& ($ResForaLinha <=50.0)) {
		$pontoForaLinha = 100;
	}elseif (($ResForaLinha > 50.0)&& ($ResForaLinha <=55.0)) {
		$pontoForaLinha = 90;
	}elseif (($ResForaLinha > 55.0)&& ($ResForaLinha <=60.0)) {
		$pontoForaLinha = 80;
	}elseif (($ResForaLinha > 60.0)&& ($ResForaLinha <=65.0)) {
		$pontoForaLinha = 70;
	}elseif (($ResForaLinha > 65.0)&& ($ResForaLinha <=70.0)) {
		$pontoForaLinha = 60;
	}elseif (($ResForaLinha > 70.0)&& ($ResForaLinha <=75.0)) {
		$pontoForaLinha = 50;
	}elseif (($ResForaLinha > 75.0)&& ($ResForaLinha <=80.0)) {
		$pontoForaLinha = 40;
	}elseif (($ResForaLinha > 80.0)&& ($ResForaLinha <=85.0)) {
		$pontoForaLinha = 30;
	}elseif (($ResForaLinha > 85.0)&& ($ResForaLinha <=90.0)) {
		$pontoForaLinha = 20;
	}elseif (($ResForaLinha > 90.0)&& ($ResForaLinha <=95.0)) {
		$pontoForaLinha = 10;
	}else{
		$pontoForaLinha = 0;
	}	
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor Fora de Linha está Incorreto!');window.location.href='simulador_car.php';</script>";
}

if (is_numeric($ResGiroLento)) {
	if ($ResGiroLento == 0.0) {
		$pontoGiroLento = 200;
	}elseif (($ResGiroLento > 0.0)&& ($ResGiroLento <=5.0)) {
		$pontoGiroLento = 190;
	}elseif (($ResGiroLento > 5.0)&& ($ResGiroLento <=10.0)) {
		$pontoGiroLento = 180;
	}elseif (($ResGiroLento > 10.0)&& ($ResGiroLento <=15.0)) {
		$pontoGiroLento = 170;
	}elseif (($ResGiroLento > 15.0)&& ($ResGiroLento <=20.0)) {
		$pontoGiroLento = 160;
	}elseif (($ResGiroLento > 20.0)&& ($ResGiroLento <=25.0)) {
		$pontoGiroLento = 150;
	}elseif (($ResGiroLento > 25.0)&& ($ResGiroLento <=30.0)) {
		$pontoGiroLento = 140;
	}elseif (($ResGiroLento > 30.0)&& ($ResGiroLento <=35.0)) {
		$pontoGiroLento = 130;
	}elseif (($ResGiroLento > 35.0)&& ($ResGiroLento <=40.0)) {
		$pontoGiroLento = 120;
	}elseif (($ResGiroLento > 40.0)&& ($ResGiroLento <=45.0)) {
		$pontoGiroLento = 110;
	}elseif (($ResGiroLento > 45.0)&& ($ResGiroLento <=50.0)) {
		$pontoGiroLento = 100;
	}elseif (($ResGiroLento > 50.0)&& ($ResGiroLento <=55.0)) {
		$pontoGiroLento = 90;
	}elseif (($ResGiroLento > 55.0)&& ($ResGiroLento <=60.0)) {
		$pontoGiroLento = 80;
	}elseif (($ResGiroLento > 60.0)&& ($ResGiroLento <=65.0)) {
		$pontoGiroLento = 70;
	}elseif (($ResGiroLento > 65.0)&& ($ResGiroLento <=70.0)) {
		$pontoGiroLento = 60;
	}elseif (($ResGiroLento > 70.0)&& ($ResGiroLento <=75.0)) {
		$pontoGiroLento = 50;
	}elseif (($ResGiroLento > 75.0)&& ($ResGiroLento <=80.0)) {
		$pontoGiroLento = 40;
	}elseif (($ResGiroLento > 80.0)&& ($ResGiroLento <=85.0)) {
		$pontoGiroLento = 30;
	}elseif (($ResGiroLento > 85.0)&& ($ResGiroLento <=90.0)) {
		$pontoGiroLento = 20;
	}elseif (($ResGiroLento > 90.0)&& ($ResGiroLento <=95.0)) {
		$pontoGiroLento = 10;
	}else{
		$pontoGiroLento = 0;
	}	
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor Giro Lento está Incorreto!');window.location.href='simulador_car.php';</script>";
}


if (is_numeric($ResPerdaInventario)) {
	if ($ResPerdaInventario == 0.0) {
		$pontoPerdaInventario = 200;
	}elseif (($ResPerdaInventario > 0.0)&& ($ResPerdaInventario <=5.0)) {
		$pontoPerdaInventario = 190;
	}elseif (($ResPerdaInventario > 5.0)&& ($ResPerdaInventario <=10.0)) {
		$pontoPerdaInventario = 180;
	}elseif (($ResPerdaInventario > 10.0)&& ($ResPerdaInventario <=15.0)) {
		$pontoPerdaInventario = 170;
	}elseif (($ResPerdaInventario > 15.0)&& ($ResPerdaInventario <=20.0)) {
		$pontoPerdaInventario = 160;
	}elseif (($ResPerdaInventario > 20.0)&& ($ResPerdaInventario <=25.0)) {
		$pontoPerdaInventario = 150;
	}elseif (($ResPerdaInventario > 25.0)&& ($ResPerdaInventario <=30.0)) {
		$pontoPerdaInventario = 140;
	}elseif (($ResPerdaInventario > 30.0)&& ($ResPerdaInventario <=35.0)) {
		$pontoPerdaInventario = 130;
	}elseif (($ResPerdaInventario > 35.0)&& ($ResPerdaInventario <=40.0)) {
		$pontoPerdaInventario = 120;
	}elseif (($ResPerdaInventario > 40.0)&& ($ResPerdaInventario <=45.0)) {
		$pontoPerdaInventario = 110;
	}elseif (($ResPerdaInventario > 45.0)&& ($ResPerdaInventario <=50.0)) {
		$pontoPerdaInventario = 100;
	}elseif (($ResPerdaInventario > 50.0)&& ($ResPerdaInventario <=55.0)) {
		$pontoPerdaInventario = 90;
	}elseif (($ResPerdaInventario > 55.0)&& ($ResPerdaInventario <=60.0)) {
		$pontoPerdaInventario = 80;
	}elseif (($ResPerdaInventario > 60.0)&& ($ResPerdaInventario <=65.0)) {
		$pontoPerdaInventario = 70;
	}elseif (($ResPerdaInventario > 65.0)&& ($ResPerdaInventario <=70.0)) {
		$pontoPerdaInventario = 60;
	}elseif (($ResPerdaInventario > 70.0)&& ($ResPerdaInventario <=75.0)) {
		$pontoPerdaInventario = 50;
	}elseif (($ResPerdaInventario > 75.0)&& ($ResPerdaInventario <=80.0)) {
		$pontoPerdaInventario = 40;
	}elseif (($ResPerdaInventario > 80.0)&& ($ResPerdaInventario <=85.0)) {
		$pontoPerdaInventario = 30;
	}elseif (($ResPerdaInventario > 85.0)&& ($ResPerdaInventario <=90.0)) {
		$pontoPerdaInventario = 20;
	}elseif (($ResPerdaInventario > 90.0)&& ($ResPerdaInventario <=95.0)) {
		$pontoPerdaInventario = 10;
	}else{
		$pontoPerdaInventario = 0;
	}	
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Valor Perda de Inventario está Incorreto!');window.location.href='simulador_car.php';</script>";
}


//Bloco filtro peso do indicador de resultado
$filtroPesoIQV = $peso25 * $pontoIQV;
$filtroPesoForaLinha = $peso25 * $pontoForaLinha;
$filtroPesoGiroLento = $peso25 * $pontoForaLinha;
$filtroPesoPerdaIventario = $peso25 * $pontoPerdaInventario;

//soma de todos as notas depois do primeiro filtro de peso
$notaGestaoOpercaional = $filtroPesoIQV + $filtroPesoForaLinha + $filtroPesoGiroLento + $filtroPesoPerdaIventario;

//Filtro Final dos grupamentos
$resultado = $peso40 * $notaResultado;
$gestaoNegocio = $peso20 * $notaGestaoNegocio;
$gestaoGente = $peso15 * $notaGestaoGente;
$gestaoCliente = $peso15 * $notaGestaoCliente;
$gestaoOperacional = $peso10 * $notaGestaoOpercaional;

$score = $resultado + $gestaoNegocio + $gestaoGente + $gestaoCliente + $gestaoOperacional;

?>
<?php
if ($_SESSION['user_funcao'] == '1'){
	include_once("menu_administrador.php");
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 style="text-align: center">Resultado Score Desempenho</h2>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<table>
					<tr>
						<th style="width: 120px">Score Total</th>
						<th style="width: 120px">Resultado</th>
						<th style="width: 120px">Gestão de Negócios</th>
						<th style="width: 120px">Gestão de Gente</th>
						<th style="width: 120px">Gestão de Clientes</th>
						<th style="width: 120px">Gestão Operacional (AQO)</th>
					</tr>
					<tr>
						<td style="text-align: center;"><?php echo ($score) ?></td>
						<td style="text-align: center;"><?php echo ($resultado) ?></td>
						<td style="text-align: center;"><?php echo ($gestaoNegocio) ?></td>
						<td style="text-align: center;"><?php echo ($gestaoGente) ?></td>
						<td style="text-align: center;"><?php echo ($gestaoCliente) ?></td>
						<td style="text-align: center;"><?php echo ($gestaoOperacional) ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<?php
}
else if ($_SESSION['user_funcao'] == '2') { 
	include_once("menu_gerente.php");
	include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '3') { 
	include_once("menu_cal.php");
	include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '4') { 
	include_once("menu_regional.php");
	include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '5') { 
	include_once("menu_car.php");
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 style="text-align: center">Resultado Score Desempenho</h2>
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<table>
					<tr>
						<th style="width: 120px">Score Total</th>
						<th style="width: 120px">Resultado</th>
						<th style="width: 120px">Gestão de Negócios</th>
						<th style="width: 120px">Gestão de Gente</th>
						<th style="width: 120px">Gestão de Clientes</th>
						<th style="width: 120px">Gestão Operacional (AQO)</th>
					</tr>
					<tr>
						<td style="text-align: center;"><?php echo ($score) ?></td>
						<td style="text-align: center;"><?php echo ($resultado) ?></td>
						<td style="text-align: center;"><?php echo ($gestaoNegocio) ?></td>
						<td style="text-align: center;"><?php echo ($gestaoGente) ?></td>
						<td style="text-align: center;"><?php echo ($gestaoCliente) ?></td>
						<td style="text-align: center;"><?php echo ($gestaoOperacional) ?></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<?php
}
else if ($_SESSION['user_funcao'] == '6') { 
	include_once("menu_consultorTreinamento.php");
	include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '7') { 
	include_once("menu_consultorTreinamentoRegional.php");
	include_once("naoPermissao.php");
} 
else{}

	include_once("rodape.php");
?>

