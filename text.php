<?php

$nomeArquivo = $_POST["nomeArquivo"];
$idPessoa = $_POST["nomeColaborador"];
$tipoMovimentacao = $_POST["tipoMovimentacao"];
$tempoCasa = $_POST["tempoCasa"];
$tempoLoja = $_POST["tempoLoja"];
$tempoFuncao = $_POST["tempoFuncao"];
$filialDestino = $_POST["filialDestino"];
$politicaTransferencia = $_POST["politicaTransferencia"];
$orcamentoTransferencia = $_POST["orcamentoTransferencia"];


define('DB_HOST', 'localhost');
define('DB_USER', 'id3133150_regional513');
define('DB_PASS', 'dnt19101996');
define('DB_NAME', 'id3133150_regional513');

// habilita todas as exibições de erros
ini_set('display_errors', true);
error_reporting(E_ALL);

function db_connect()
{
	$PDO = new PDO('mysql:host=' . DB_HOST . ';port=3307;dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

	return $PDO;
}

try {
	$conexao = db_connect();
	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conexao->exec("set names utf8");
} catch (PDOException $erro) {
	echo "Erro na conexão:".$erro->getMessage();
}




//Faz a consulta no banco de dados
try {
	$stmt = $conexao->prepare("SELECT * FROM pessoa, filial, funcao, score, salario WHERE pessoa.filialPessoa = filial.idFilial AND pessoa.funcaoPessoa = funcao.idFuncao AND score.idPessoa = pessoa.idPessoa AND salario.idPessoa = pessoa.idPessoa AND pessoa.idPessoa = '$idPessoa'");
	if ($stmt->execute()) {
		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
			$nome = $rs->nome;
			$filial = $rs->filial;
			$funcao = $rs->nomeFuncao;
			$quartilDiretoria = $rs->quartilDiretoria;
			$quartilRegional = $rs->quartilRegional;
			$salario = $rs->salario;
			$porteLojaAtual = $rs->porte;
		}
	} else {
		echo "Erro: Não foi possível recuperar os dados do banco de dados";
	}
}catch (PDOException $erro) {
	echo "Erro: ".$erro->getMessage();
} 

try {
	$stmt2 = $conexao->prepare("SELECT * FROM filial WHERE filial.filial = '$filialDestino'");
	if ($stmt2->execute()) {
		while ($rs2 = $stmt2->fetch(PDO::FETCH_OBJ)) {
			$porteLojaDestino = $rs2->porte;
		}
	} else {
		echo "Erro: Não foi possível recuperar os dados do banco de dados";
	}
}catch (PDOException $erro) {
	echo "Erro: ".$erro->getMessage();
} 

if ($tipoMovimentacao == "Transferencia") {
	$conteudoTransferencia = $nome." Filial ".$filial." ".$funcao." Transferencia \r\nResumo para as tranferências de gerente o comentario do GESTOR deverá ser preenchido com estas informações: \r\n
Quartil da Regional: ".$quartilRegional."; \r\n
Quartil da Diretoria: ".$quartilDiretoria."; \r\n
Sálario atual: ".$salario."; \r\n
Tempo de Casa: ".$tempoCasa.";\r\n
Tempo na Loja Atual: ".$tempoLoja.";\r\n
Tempo na Função Atual: ".$tempoFuncao.";\r\n
Filial de Origem: ".$filial.";\r\n
Filial de Destino: ".$filialDestino.";\r\n
Porte da Loja Atual: ".$porteLojaAtual.";\r\n
Porte da Loja Destino: ".$porteLojaDestino.";\r\n
Politica de Tranferência SIM ou NAO: ".$politicaTransferencia.";\r\n
Orçamento de Tranferência (Foi aprovado pela Diretoria Sim ou Não)?: ".$orcamentoTransferencia.";\r\n
ENPS: ;\r\n
NPS: ;\r\n
PDI Encaminhamento do Ciclo de Gente: ;\r\n
Nota avaliação de Aderência ao Movve da Loja: ;\r\n
Resultados Ultimos 6 Meses (Somente a media %), (Caso a questão seja de quartil 3 e 4 trazer a média dos resultados de 1 ano). OBS: Deverá descrever se o resultado apresentado é da média dos últimos 6 meses ou do ano. ;\r\n
% Atingimento da Meta Venda Mercantil: ;\r\n
% Atingimento da Meta de Eficiência: ;\r\n
% Atingimento da Meta CDC: ;\r\n
% LB Atingimento da Meta: ;\r\n
% Atingimento da Meta de Desconto: ;";

	$conteudo = $conteudoTransferencia;
}elseif ($tipoMovimentacao == "Desligamento") {
	$conteudoDesligamento = $nome." Filial ".$filial." ".$funcao." Desligamento \r\nResumo para as tranferências de gerente o comentario do GESTOR deverá ser preenchido com estas informações: \r\n
	Quartil da Regional: ".$quartilRegional." \r\n
	Quartil da Diretoria: ".$quartilDiretoria." \r\n
	Sálario atual: ".$salario." \r\n
	Tempo de Casa: ".$tempoCasa."\r\n
	Tempo na Loja Atual: ".$tempoLoja."\r\n
	Tempo na Função Atual: ".$tempoFuncao."\r\n
	Filial de Origem: ".$filial." \r\n
	Porte da Loja Atual: \r\n
	Porte da Loja Destino: \r\n
	Politica de Tranferência SIM ou NAO: \r\n
	Orçamento de Tranferência (Foi aprovado pela Diretoria Sim ou Não)?: \r\n
	ENPS: \r\n
	NPS: \r\n
	PDI Encaminhamento do Ciclo de Gente: \r\n
	Nota avaliação de Aderência ao Movve da Loja: \r\n
	Resultados Ultimos 6 Meses (Somente a media %), (Caso a questão seja de quartil 3 e 4 trazer a média dos resultados de 1 ano). OBS: Deverá descrever se o resultado apresentado é da média dos últimos 6 meses ou do ano. \r\n
	% Atingimento da Meta Venda Mercantil: \r\n
	% Atingimento da Meta de Eficiência: \r\n
	% Atingimento da Meta CDC: \r\n
	% LB Atingimento da Meta: \r\n
	% Atingimento da Meta de Desconto:";

	$conteudo = $conteudoDesligamento;
} elseif ($tipoMovimentacao == "Promoção") {
	$conteudoPromocao = $nome." Filial ".$filial." ".$funcao." Promoção \r\nResumo para as tranferências de gerente o comentario do GESTOR deverá ser preenchido com estas informações: \r\n
	Quartil da Regional: ".$quartilRegional." \r\n
	Quartil da Diretoria: ".$quartilDiretoria." \r\n
	Sálario atual: ".$salario." \r\n
	Tempo de Casa: ".$tempoCasa."\r\n
	Tempo na Loja Atual: ".$tempoLoja."\r\n
	Tempo na Função Atual: ".$tempoFuncao."\r\n
	Filial de Origem: ".$filial." \r\n
	Porte da Loja Atual: \r\n
	Porte da Loja Destino: \r\n
	Politica de Tranferência SIM ou NAO: \r\n
	Orçamento de Tranferência (Foi aprovado pela Diretoria Sim ou Não)?: \r\n
	ENPS: \r\n
	NPS: \r\n
	PDI Encaminhamento do Ciclo de Gente: \r\n
	Nota avaliação de Aderência ao Movve da Loja: \r\n
	Resultados Ultimos 6 Meses (Somente a media %), (Caso a questão seja de quartil 3 e 4 trazer a média dos resultados de 1 ano). OBS: Deverá descrever se o resultado apresentado é da média dos últimos 6 meses ou do ano. \r\n
	% Atingimento da Meta Venda Mercantil: \r\n
	% Atingimento da Meta de Eficiência: \r\n
	% Atingimento da Meta CDC: \r\n
	% LB Atingimento da Meta: \r\n
	% Atingimento da Meta de Desconto:";

	$conteudo = $conteudoPromocao;
} else {
	$conteudoMerito = $nome." Filial ".$filial." ".$funcao." Merito \r\nResumo para as tranferências de gerente o comentario do GESTOR deverá ser preenchido com estas informações: \r\n
	Quartil da Regional: ".$quartilRegional." \r\n
	Quartil da Diretoria: ".$quartilDiretoria." \r\n
	Sálario atual: ".$salario." \r\n
	Tempo de Casa: ".$tempoCasa."\r\n
	Tempo na Loja Atual: ".$tempoLoja."\r\n
	Tempo na Função Atual: ".$tempoFuncao."\r\n
	Filial de Origem: ".$filial." \r\n
	Porte da Loja Atual: \r\n
	Porte da Loja Destino: \r\n
	Politica de Tranferência SIM ou NAO: \r\n
	Orçamento de Tranferência (Foi aprovado pela Diretoria Sim ou Não)?: \r\n
	ENPS: \r\n
	NPS: \r\n
	PDI Encaminhamento do Ciclo de Gente: \r\n
	Nota avaliação de Aderência ao Movve da Loja: \r\n
	Resultados Ultimos 6 Meses (Somente a media %), (Caso a questão seja de quartil 3 e 4 trazer a média dos resultados de 1 ano). OBS: Deverá descrever se o resultado apresentado é da média dos últimos 6 meses ou do ano. \r\n
	% Atingimento da Meta Venda Mercantil: \r\n
	% Atingimento da Meta de Eficiência: \r\n
	% Atingimento da Meta CDC: \r\n
	% LB Atingimento da Meta: \r\n
	% Atingimento da Meta de Desconto:";

	$conteudo = $conteudoMerito;
}





header("Content-Type: application/txt");
header("Content-Disposition:attachment; filename = ".$nomeArquivo.".txt");
echo $conteudo;

?>