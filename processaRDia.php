
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
				$metaLb = $linha->getElementsByTagName("Data")->item(3)->nodeValue;
				$realLb = $linha->getElementsByTagName("Data")->item(4)->nodeValue;
				$lb = $linha->getElementsByTagName("Data")->item(5)->nodeValue;
				$metaVendaMercantil = $linha->getElementsByTagName("Data")->item(6)->nodeValue;
				$realVendaMercantil = $linha->getElementsByTagName("Data")->item(7)->nodeValue;
				$vendaMercantil = $linha->getElementsByTagName("Data")->item(8)->nodeValue;
				$metaVendaMoveis = $linha->getElementsByTagName("Data")->item(9)->nodeValue;
				$realVendaMoveis = $linha->getElementsByTagName("Data")->item(10)->nodeValue;
				$vendaMoveis = $linha->getElementsByTagName("Data")->item(11)->nodeValue;
				$metaEficiencia = $linha->getElementsByTagName("Data")->item(12)->nodeValue;
				$realEficiencia = $linha->getElementsByTagName("Data")->item(13)->nodeValue;
				$eficiencia = $linha->getElementsByTagName("Data")->item(14)->nodeValue;
				$metaCdc = $linha->getElementsByTagName("Data")->item(15)->nodeValue;
				$realCdc = $linha->getElementsByTagName("Data")->item(16)->nodeValue;
				$cdc = $linha->getElementsByTagName("Data")->item(17)->nodeValue;
				$metaFamilia1 = $linha->getElementsByTagName("Data")->item(18)->nodeValue;
				$realFamilia1 = $linha->getElementsByTagName("Data")->item(19)->nodeValue;
				$familia1 = $linha->getElementsByTagName("Data")->item(20)->nodeValue;
				$metaFamilia2 = $linha->getElementsByTagName("Data")->item(21)->nodeValue;
				$realFamilia2 = $linha->getElementsByTagName("Data")->item(22)->nodeValue;
				$familia2 = $linha->getElementsByTagName("Data")->item(23)->nodeValue;
				$metaFamilia3 = $linha->getElementsByTagName("Data")->item(24)->nodeValue;
				$realFamilia3 = $linha->getElementsByTagName("Data")->item(25)->nodeValue;
				$familia3 = $linha->getElementsByTagName("Data")->item(26)->nodeValue;
				$metaMixServico = $linha->getElementsByTagName("Data")->item(27)->nodeValue;
				$realMixServico = $linha->getElementsByTagName("Data")->item(28)->nodeValue;
				$mixServico = $linha->getElementsByTagName("Data")->item(29)->nodeValue;
				$metaPlanos = $linha->getElementsByTagName("Data")->item(30)->nodeValue;
				$realPlanos = $linha->getElementsByTagName("Data")->item(31)->nodeValue;
				$planos = $linha->getElementsByTagName("Data")->item(32)->nodeValue;
				$metaCartoes = $linha->getElementsByTagName("Data")->item(33)->nodeValue;
				$realCartoes = $linha->getElementsByTagName("Data")->item(34)->nodeValue;
				$cartoes = $linha->getElementsByTagName("Data")->item(35)->nodeValue;
				$metaDesconto = $linha->getElementsByTagName("Data")->item(36)->nodeValue;
				$realDesconto = $linha->getElementsByTagName("Data")->item(37)->nodeValue;
				$desconto = $linha->getElementsByTagName("Data")->item(38)->nodeValue;
				$mesAno = $mes.$ano;
				

						try{
    						$stmt = $conn->prepare("SELECT * FROM resultados WHERE mesAno = '$mesa'");
    						if ($stmt->execute()) {
        						while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
        							$idResultado = $rs1->idResultado;
						            $filial = $rs->filial;
            						$mesAno1 = $rs->mesAno;
        						}
    						} else {
        						echo "Erro: Não foi possível recuperar os dados do banco de dados";
    						}
						} catch (PDOException $erro) {
    						echo "Erro: ".$erro->getMessage();
						}
					
				//Inserir o usuário no BD

				if ($mesAno == $mesAno1) {
					$result_usuario = "UPDATE resultados SET resultadoFilial='$resultadoFilial', mes='$mes', ano='$ano', metaLb, realLb, lb, metaVendaMercantil, realVendaMercantil, vendaMercantil, metaVendaMoveis, realVendaMoveis, vendaMoveis, metaEficiencia, realEficiencia, eficiencia, metaCdc, realCdc, cdc, metaFamilia1, realFamilia1, familia1, metaFamilia2, realFamilia2, familia2, metaFamilia3, realFamilia3, familia3, metaMixServico, realMixServico, mixServico, metaPlanos, realPlanos, planos, metaCartoes, realCartoes, cartoes, metaDesconto, realDesconto, desconto, mesAno";
					$resultado_usuario = mysqli_query($conn, $result_usuario);
				}else{
					$result_usuario = "INSERT INTO resultados (resultadoFilial, mes, ano, metaLb, realLb, lb, metaVendaMercantil, realVendaMercantil, vendaMercantil, metaVendaMoveis, realVendaMoveis, vendaMoveis, metaEficiencia, realEficiencia, eficiencia, metaCdc, realCdc, cdc, metaFamilia1, realFamilia1, familia1, metaFamilia2, realFamilia2, familia2, metaFamilia3, realFamilia3, familia3, metaMixServico, realMixServico, mixServico, metaPlanos, realPlanos, planos, metaCartoes, realCartoes, cartoes, metaDesconto, realDesconto, desconto, mesAno) VALUES ('$resultadoFilial','$mes','$ano', '$metaLb', '$realLb', '$lb', '$metaVendaMercantil', '$realVendaMercantil', '$vendaMercantil', '$metaVendaMoveis', '$realVendaMoveis', '$vendaMoveis', '$metaEficiencia', '$realEficiencia', '$eficiencia', '$metaCdc', '$realCdc', '$cdc', '$metaFamilia1', '$realFamilia1', '$familia1', '$metaFamilia2', '$realFamilia2', '$familia2', '$metaFamilia3', '$realFamilia3', '$familia3', '$metaMixServico', '$realMixServico', '$mixServico', '$metaPlanos', '$realPlanos', '$planos', '$metaCartoes', '$realCartoes', '$cartoes', '$metaDesconto', '$realDesconto', '$desconto', '$mesAno')";
					$resultado_usuario = mysqli_query($conn, $result_usuario);
				}
				

				$delete = "DELETE FROM resultados WHERE resultadoFilial = '0'";
				$delete_result = mysqli_query($conn, $delete);
				
			}
			$primeira_linha = false;

			
		}
		echo"<script language='javascript' type='text/javascript'>alert('Resultados Cadastrados!');window.location.href='uploadResultado.php';</script>";
		}	
	
	
?>