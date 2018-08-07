
<?php

$servidor = "localhost";
$usuario = "id3133150_regional513";
$senha = "dnt19101996";
$dbname = "id3133150_regional513";

	//Criar a conexao
$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);

	//$dados = $_FILES['arquivo'];
	//var_dump($dados);


if(!empty($_FILES['arquivo']['tmp_name'])){
	$arquivo = new DomDocument();
	$arquivo->load($_FILES['arquivo']['tmp_name']);
		//var_dump($arquivo);
	
	$linhas = $arquivo->getElementsByTagName("Row");
		//var_dump($linhas);
	
	$primeira_linha = true;
	
	foreach($linhas as $linha){
		if($primeira_linha == false){
			$resultadoFilial = $linha->getElementsByTagName("Data")->item(0)->nodeValue;
			$mes = $linha->getElementsByTagName("Data")->item(1)->nodeValue;
			$ano = $linha->getElementsByTagName("Data")->item(2)->nodeValue;
			$fatorMercadoria = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
			$fatorMeioPagamento = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
			$fatorDesconto = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
			$ir = $linha->getElementsByTagName("Data")->item(6)->nodeValue;
			$metaVendaMercantil = $linha->getElementsByTagName("Data")->item(7)->nodeValue;
			$realVendaMercantil = $linha->getElementsByTagName("Data")->item(8)->nodeValue;
			$vendaMercantil = $linha->getElementsByTagName("Data")->item(9)->nodeValue;
			$metaVendaMoveis = $linha->getElementsByTagName("Data")->item(10)->nodeValue;
			$realVendaMoveis = $linha->getElementsByTagName("Data")->item(11)->nodeValue;
			$vendaMoveis = $linha->getElementsByTagName("Data")->item(12)->nodeValue;
			$metaEficiencia = $linha->getElementsByTagName("Data")->item(13)->nodeValue;
			$realEficiencia = $linha->getElementsByTagName("Data")->item(14)->nodeValue;
			$eficiencia = $linha->getElementsByTagName("Data")->item(15)->nodeValue;
			$metaCdc = $linha->getElementsByTagName("Data")->item(16)->nodeValue;
			$realCdc = $linha->getElementsByTagName("Data")->item(17)->nodeValue;
			$cdc = $linha->getElementsByTagName("Data")->item(18)->nodeValue;
			$metaFamilia1 = $linha->getElementsByTagName("Data")->item(19)->nodeValue;
			$realFamilia1 = $linha->getElementsByTagName("Data")->item(20)->nodeValue;
			$familia1 = $linha->getElementsByTagName("Data")->item(21)->nodeValue;
			$metaFamilia2 = $linha->getElementsByTagName("Data")->item(22)->nodeValue;
			$realFamilia2 = $linha->getElementsByTagName("Data")->item(23)->nodeValue;
			$familia2 = $linha->getElementsByTagName("Data")->item(24)->nodeValue;
			$metaFamilia3 = $linha->getElementsByTagName("Data")->item(25)->nodeValue;
			$realFamilia3 = $linha->getElementsByTagName("Data")->item(26)->nodeValue;
			$familia3 = $linha->getElementsByTagName("Data")->item(27)->nodeValue;
			$metaFamilia4 = $linha->getElementsByTagName("Data")->item(28)->nodeValue;
			$realFamilia4 = $linha->getElementsByTagName("Data")->item(29)->nodeValue;
			$familia4 = $linha->getElementsByTagName("Data")->item(30)->nodeValue;
			$metaMixServico = $linha->getElementsByTagName("Data")->item(31)->nodeValue;
			$realMixServico = $linha->getElementsByTagName("Data")->item(32)->nodeValue;
			$mixServico = $linha->getElementsByTagName("Data")->item(33)->nodeValue;
			$metaPlanos = $linha->getElementsByTagName("Data")->item(34)->nodeValue;
			$realPlanos = $linha->getElementsByTagName("Data")->item(35)->nodeValue;
			$planos = $linha->getElementsByTagName("Data")->item(36)->nodeValue;
			$metaCartoes = $linha->getElementsByTagName("Data")->item(37)->nodeValue;
			$realCartoes = $linha->getElementsByTagName("Data")->item(38)->nodeValue;
			$cartoes = $linha->getElementsByTagName("Data")->item(39)->nodeValue;
			$metaDesconto = $linha->getElementsByTagName("Data")->item(40)->nodeValue;
			$realDesconto = $linha->getElementsByTagName("Data")->item(41)->nodeValue;
			$desconto = $linha->getElementsByTagName("Data")->item(42)->nodeValue;
			$mesAno = $mes.$ano;
			
				//Inserir o usuário no BD
			$result_usuario = "INSERT INTO resultados (resultadoFilial, mes, ano, fatorMercadoria, fatorMeioPagamento, fatorDesconto,ir, metaVendaMercantil, realVendaMercantil, vendaMercantil, metaVendaMoveis, realVendaMoveis, vendaMoveis, metaEficiencia, realEficiencia, eficiencia, metaCdc, realCdc, cdc, metaFamilia1, realFamilia1, familia1, metaFamilia2, realFamilia2, familia2, metaFamilia3, realFamilia3, familia3, metaFamilia4, realFamilia4, familia4, metaMixServico, realMixServico, mixServico, metaPlanos, realPlanos, planos, metaCartoes, realCartoes, cartoes, metaDesconto, realDesconto, desconto, mesAno) VALUES ('$resultadoFilial','$mes','$ano', '$fatorMercadoria', '$fatorMeioPagamento', '$fatorDesconto','$ir', '$metaVendaMercantil', '$realVendaMercantil', '$vendaMercantil', '$metaVendaMoveis', '$realVendaMoveis', '$vendaMoveis', '$metaEficiencia', '$realEficiencia', '$eficiencia', '$metaCdc', '$realCdc', '$cdc', '$metaFamilia1', '$realFamilia1', '$familia1', '$metaFamilia2', '$realFamilia2', '$familia2', '$metaFamilia3', '$realFamilia3', '$familia3', '$metaFamilia4', '$realFamilia4', '$familia4', '$metaMixServico', '$realMixServico', '$mixServico', '$metaPlanos', '$realPlanos', '$planos', '$metaCartoes', '$realCartoes', '$cartoes', '$metaDesconto', '$realDesconto', '$desconto', '$mesAno')";
			$resultado_usuario = mysqli_query($conn, $result_usuario);

			$delete = "DELETE FROM resultados WHERE resultadoFilial = '0'";
			$delete_result = mysqli_query($conn, $delete);
			
		}
		$primeira_linha = false;

		
	}
	echo"<script language='javascript' type='text/javascript'>alert('Resultados Cadastrados!');window.location.href='uploadResultado.php';</script>";
}else{
	echo"<script language='javascript' type='text/javascript'>alert('Planilha não encotrada!');window.location.href='uploadResultado.php';</script>";
}	


?>