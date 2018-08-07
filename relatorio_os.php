<?php 

error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php';


$parametro = filter_input(INPUT_POST, "parametro");


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
	<title>Relatorio O.S</title>
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
	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    <div class="row">
     <div class="col-md-3">
       <div class="form-group">
         <label for="parametro">Centro Custo:</label>
         <?php
         $sql = "SELECT DISTINCT centroCusto from os order by centroCusto asc";
         $stm = $conexao->prepare($sql);
         $stm->execute();
         $oss = $stm->fetchAll(PDO::FETCH_OBJ);
         ?>
         <select class="form-control" name="parametro" id="parametro" required>
           <option>Todos</option>
           <?php foreach($oss as $os):?>
             <option value=<?=$os->centroCusto?>><?=$os->centroCusto?></option>
           <?php endforeach;?>
         </select>
         <span class='msg-erro msg-status'></span>
       </div>
     </div>
     <div class="col-md-3">
      <input style="margin-top: 25px;" type="submit" class="btn btn-primary" value="Filtrar">
    </div>
  </div>
</form>
<hr>
<h4>Lista de O.S abertas</h4>
<table style="width: 100%; text-align: left;">
 <tr>
  <th style="width: 120px;">Centro de Custo</th>
  <th style="width: 60px;">Filial</th>
  <th>Data Solicitação</th>
  <th style="width: 200px">Solicitante</th>
  <th>Matricula</th>
  <th style="width: 140px;">Telefone</th>
  <th style="width: 130px;">Tipo Servico</th>
  <th style="width: 400px">Descrição</th>
</tr>
<?php
if ($parametro) {
  try{
    $stmt = $conexao->prepare("SELECT * FROM os, pessoa, filial WHERE os.solicitante = pessoa.idPessoa AND pessoa.filialPessoa = filial.idFilial AND os.concluido = 'Não' AND centroCusto like '$parametro'");
    if ($stmt->execute()) {
      while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
       $array_data = explode('-', $rs->dataSolicitacao);
       $data_formatada_solicitacao = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];

       $array_data = explode('-', $rs->dataManutencao);
       $data_formatada_manutencao = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
       echo "<tr>";
       echo "<td>".$rs->centroCusto
       ."</td><td>".$rs->filial
       ."</td><td>".$data_formatada_solicitacao
       ."</td><td>".$rs->nome
       ."</td><td>".$rs->matricula
       ."</td><td>".$rs->numCorporativo
       ."</td><td>".$rs->tipoServico
       ."</td><td>".$rs->descricao
       ."</td>";
       echo "</tr>";
     }
   } else {
    echo "Erro: Não foi possível recuperar os dados do banco de dados";
  }
} catch (PDOException $erro) {
  echo "Erro: ".$erro->getMessage();
}
}else{
  try{
    $stmt = $conexao->prepare("SELECT * FROM os, pessoa, filial WHERE os.solicitante = pessoa.idPessoa AND pessoa.filialPessoa = filial.idFilial AND os.concluido = 'Não'");
    if ($stmt->execute()) {
      while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
        $array_data = explode('-', $rs->dataSolicitacao);
        $data_formatada_solicitacao = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];

        $array_data = explode('-', $rs->dataManutencao);
        $data_formatada_manutencao = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
        echo "<tr>";
        echo "<td>".$rs->centroCusto
        ."</td><td>".$rs->filial
        ."</td><td>".$data_formatada_solicitacao
        ."</td><td>".$rs->nome
        ."</td><td>".$rs->matricula
        ."</td><td>".$rs->numCorporativo
        ."</td><td>".$rs->tipoServico
        ."</td><td>".$rs->descricao
        ."</td>";
        echo "</tr>";
      }
    } else {
     echo "Erro: Não foi possível recuperar os dados do banco de dados";
   }
 } catch (PDOException $erro) {
  echo "Erro: ".$erro->getMessage();
}
}
?>
</table>
<hr>
<h4>Lista de O.S encerradas</h4>
<table style="width: 100%; text-align: left;">
 <tr>
  <th>Centro de Custo</th>
  <th>Filial</th>
  <th>Data Solicitação</th>
  <th>Solicitante</th>
  <th>Matricula</th>
  <th>Telefone</th>
  <th>Numero O.S</th>
  <th>Tipo Servico</th>
  <th style="width: 300px">Descrição</th>
  <th>Data Manutenção</th>
</tr>
<?php
if ($parametro) {
 try{
  $stmt = $conexao->prepare("SELECT * FROM os, pessoa, filial WHERE os.solicitante = pessoa.idPessoa AND pessoa.filialPessoa = filial.idFilial AND os.concluido = 'Sim' AND centroCusto like '$parametro'");
  if ($stmt->execute()) {
    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
     $array_data = explode('-', $rs->dataSolicitacao);
     $data_formatada_solicitacao = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];

     $array_data = explode('-', $rs->dataManutencao);
     $data_formatada_manutencao = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
     echo "<tr>";
     echo "<td>".$rs->centroCusto
     ."</td><td>".$rs->filial
     ."</td><td>".$data_formatada_solicitacao
     ."</td><td>".$rs->nome
     ."</td><td>".$rs->matricula
     ."</td><td>".$rs->numCorporativo
     ."</td><td>".$rs->numeroOs
     ."</td><td>".$rs->tipoServico
     ."</td><td>".$rs->descricao
     ."</td><td>".$data_formatada_manutencao
     ."</td>";
     echo "</tr>";
   }
 } else {
   echo "Erro: Não foi possível recuperar os dados do banco de dados";
 }
} catch (PDOException $erro) {
  echo "Erro: ".$erro->getMessage();
}
}else{
 try{
  $stmt = $conexao->prepare("SELECT * FROM os, pessoa, filial WHERE os.solicitante = pessoa.idPessoa AND pessoa.filialPessoa = filial.idFilial AND os.concluido = 'Sim'");
  if ($stmt->execute()) {
    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
     $array_data = explode('-', $rs->dataSolicitacao);
     $data_formatada_solicitacao = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];

     $array_data = explode('-', $rs->dataManutencao);
     $data_formatada_manutencao = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
     echo "<tr>";
     echo "<td>".$rs->centroCusto
     ."</td><td>".$rs->filial
     ."</td><td>".$data_formatada_solicitacao
     ."</td><td>".$rs->nome
     ."</td><td>".$rs->matricula
     ."</td><td>".$rs->numCorporativo
     ."</td><td>".$rs->numeroOs
     ."</td><td>".$rs->tipoServico
     ."</td><td>".$rs->descricao
     ."</td><td>".$data_formatada_manutencao
     ."</td>";
     echo "</tr>";
   }
 } else {
   echo "Erro: Não foi possível recuperar os dados do banco de dados";
 }
} catch (PDOException $erro) {
  echo "Erro: ".$erro->getMessage();
}
}
?>
</table>
<br><br>
<div class="row">
  <input type="button" name="imprimir" value="Imprimir" onclick="window.print();">
  <button><a style="text-decoration: none; color: black;" href="os.php">Voltar</a></button>
</div>

  </body>
  </html>