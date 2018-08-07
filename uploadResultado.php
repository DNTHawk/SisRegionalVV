<?php
session_start();

require_once 'conexao.php';

require 'verifica_sessao.php';

?>


<?php
if ($_SESSION['user_funcao'] == '1'){
  include_once("menu_administrador.php");
  ?>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Upload Resultado</h3>
        <h4>Resultado Fechamento Mês</h4>
        <form method="POST" action="processa.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="arquivo">Arquivo</label>
            <input type="file" name="arquivo">
            <p class="help-block">Selecionar planilha com resultados.</p>
          </div>
          <input class="btn btn-primary" type="submit" value="Enviar">
        </form>
      </div>
    </div>
    <br><br>
    <div class="row">
      <div class="col-md-12">
        <form action="exportar_resultados.php" method="post">
          <label>Nome do arquivo exportado: </label>
          <input type="text" name="nome_arquivo">
          <input type="submit" value="Exportar">
        </form>
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
  include_once("menu_regional.php");
  include_once("naoPermissao.php");
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

