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
<!DOCTYPE html>
<html>
<head>
	<title>Relatorio CAL's</title>
	<style type="text/css">
  table td, th{
   border: solid 1px #A4A4A4;
 }

 table{
   border-collapse: collapse;
 }
</style>
</head>
<body>
	
	<h2 style="text-align: center; width: 100%; ">Lista de CAL's</h2>
	
	<table style="width: 1100px" class="table table-bordered">
    <tr>
      <th>Matricula</th>
      <th>Nome</th>
      <th>Filial</th>
      <th>Email</th>
      <th>Ramal Filial</th>
      <th>Numero Celular</th>
      <th>Corporativo</th>
    </tr>
    <?php 
    try{
      $stmt = $conexao->prepare("SELECT * FROM pessoa, funcao, filial WHERE pessoa.filialPessoa = filial.idFilial and pessoa.			funcaoPessoa = funcao.idFuncao and pessoa.funcaoPessoa = '3' order by filial.filial");
      if ($stmt->execute()) {
        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
          echo "<tr>";
          echo "<td>".$rs->matricula
          ."</td><td>".$rs->nome
          ."</td><td>".$rs->filial
          ."</td><td>".$rs->email
          ."</td><td>".$rs->numRamal
          ."</td><td>".$rs->numCelular
          ."</td><td>".$rs->numCorporativo;
          echo "</tr>";
        }
      } else {
        echo "Erro: Não foi possível recuperar os dados do banco de dados";
      }
    } catch (PDOException $erro) {
      echo "Erro: ".$erro->getMessage();
    }
    ?>
  </table>

  <br><br>
  <a style="margin-left: 10px" href="consulta_cal.php"><span>Voltar</span></a>

  <SCRIPT LANGUAGE="JavaScript">
    window.print();
  </SCRIPT>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>