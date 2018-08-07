<?php 
$conn = mysql_connect("localhost","id3133150_regional513","dnt19101996");
$db = mysql_select_db("id3133150_regional513");

$busca = "SELECT * FROM os, pessoa, filial WHERE os.solicitante = pessoa.idPessoa AND pessoa.filialPessoa = filial.idFilial AND os.concluido = 'Sim' AND centroCusto like '$parametro'";

$total_reg = "10";

$pagina=$_GET['pagina'];

if (!$pagina) {
	$pc = "1";
} else {
	$pc = $pagina;
}

$inicio = $pc - 1;
$inicio = $inicio * $total_reg;

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 

$limite = mysql_query("$busca LIMIT $inicio,$total_reg");
$todos = mysql_query("$busca");
 
$tr = mysql_num_rows($todos); // verifica o número total de registros
$tp = $tr / $total_reg; // verifica o número total de páginas
 
// vamos criar a visualização
while ($dados = mysql_fetch_array($limite)) {
$nome = $dados["nome"];
echo "Nome: $nome<br>";
}
 
// agora vamos criar os botões "Anterior e próximo"
$anterior = $pc -1;
$proximo = $pc +1;
if ($pc>1) {
echo " <a href='?pagina=$anterior'><- Anterior</a> ";
}
echo "|";
if ($pc<$tp) {
echo " <a href='?pagina=$proximo'>Próxima -></a>";
}

?>
</body>
</html>