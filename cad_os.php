<div class="container">
  <div class="row">
    <div class="col-md-4">
      <h3>Registro de Ordem de Serviço</h3>
    </div>
    <div style="margin-top: 20px; font-size: 20px; position: relative; left: -55px;" class="col-md-1 hidden-xs">
      <a href="relatorio_os.php" data-toggle="tooltip" data-placement="left" title="Imprimir"><span style="color: #000" class="glyphicon glyphicon-print"></span></a>

      <a style="margin-left: 10px;" href="extrairExcelOs.php" data-toggle="tooltip" data-placement="left" title="Gerar Excel"><span style="color: #000" class="glyphicon glyphicon-save-file"></span></a>
    </div>
  </div>
  <br>
  <form action="?act=save" method="POST" name="form1">
    <input type="hidden" name="idOs" <?php if (isset($idOs) && $idOs != null || $idOs != "") { echo "value=\"{$idOs}\""; }?> />
    <div class="row">
      <div class="col-md-3">
        <div class="form-group">
          <label for="numeroOs">Numero O.S:</label>
          <input type="text" class="form-control" name="numeroOs" <?php if (isset($numeroOs) && $numeroOs != null || $numeroOs != "") { echo "value=\"{$numeroOs}\""; }?> />
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label for="centroCusto">Centro de Custo:</label>
          <select class="form-control" name="centroCusto" required>
            <?php 
            if (isset($centroCusto) && $centroCusto != null || $centroCusto != ""){?> <option value="<?=$centroCusto?>"><?=$centroCusto?></option> <?php
          }else{
            ?>
            <option value="">Centro de Custo</option>
            <?php
          }  
          ?>
          <option value="2101890003">2101890003</option>
          <option value="2103110003">2103110003</option>
          <option value="2111240003">2111240003</option>
          <option value="2111370003">2111370003</option>
          <option value="2112020003">2112020003</option>
          <option value="2112080003">2112080003</option>
          <option value="2112780003">2112780003</option>
          <option value="2113160003">2113160003</option>
          <option value="2113380003">2113380003</option>
          <option value="2113970003">2113970003</option>
          <option value="2115290003">2115290003</option>
          <option value="2115480003">2115480003</option>
          <option value="2117540003">2117540003</option>
          <option value="2117650003">2117650003</option>
          <option value="2117770003">2117770003</option>
          <option value="2118300003">2118300003</option>
          <option value="2119060003">2119060003</option>
          <option value="2119090003">2119090003</option>
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="solicitante">Responsável:</label>
        <?php
        $sql = "SELECT * from pessoa WHERE funcaoPessoa = '2' order by matricula asc";
        $stm = $conexao->prepare($sql);
        $stm->execute();
        $pessoas = $stm->fetchAll(PDO::FETCH_OBJ);
        ?>
        <select class="form-control" name="solicitante" id="solicitante" required>
          <?php 
          if (isset($solicitante) && $solicitante != null || $solicitante != ""){
            ?> 
            <option value="<?=$solicitante?>"><?=$nome?></option> 
            <?php
          }else{
            ?>
            <option value="">Responsável:</option>
            <?php
          }
          ?>
          <?php foreach($pessoas as $pessoa):?>
            <option value=<?=$pessoa->idPessoa?>><?=$pessoa->nome?></option>
          <?php endforeach;?>
        </select>
        <span class='msg-erro msg-status'></span>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="tipoServico">Tipo Serviço:</label>
        <select class="form-control" name="tipoServico" required>
          <?php 
          if (isset($tipoServico) && $tipoServico != null || $tipoServico != ""){
            ?>
            <option value="<?=$tipoServico?>"><?=$tipoServico?></option> 
            <?php
          }else{
            ?>
            <option value="">Tipo de Serviço</option>
            <?php                
          }
          ?>
          <option value="Hidráulica">Hidráulica</option>
          <option value="Elétrica">Elétrica</option>
          <option value="Alvenaria">Alvenaria</option>
          <option value="Ar Condicionado">Ar Condicionado</option>
          <option value="Pintura">Pintura</option>
          <option value="Lógica">Lógica</option>
          <option value="Telhado">Telhado</option>
          <option value="Serralheria">Serralheria</option>
          <option value="Vidraçaria">Vidraçaria</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea style="text-transform: uppercase;" class="form-control" name="descricao" rows="3" required ><?php if (isset($descricao) && $descricao != null || $descricao != "") {echo ($descricao); }?> </textarea>           
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="dataSolicitacao">Data Solicitação:</label>
        <input type="date" name="dataSolicitacao" class="form-control" <?php if (isset($dataSolicitacao) && $dataSolicitacao != null || $dataSolicitacao != "") { echo "value=\"{$dataSolicitacao}\"";} ?>/>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="dataManutencao">Data Manutenção:</label>
        <input type="date" name="dataManutencao" class="form-control" <?php if (isset($dataManutencao) && $dataManutencao != null || $dataManutencao != "") { echo "value=\"{$dataManutencao}\"";} ?>/>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group" style="margin-top: 30px;">
        <label for="concluido"> Manutenção Realizada: </label>
        <label class="radio-inline">
          <input type="radio" name="concluido" id="concluido1" value="Sim" required> Sim
        </label>
        <label class="radio-inline">
          <input type="radio" name="concluido" id="concluido2" value="Não"> Não
        </label>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <input type="submit" value="Salvar" class="btn btn-primary" />
      <input type="reset" value="Limpar" class="btn btn-primary" />
    </div>
  </div>
</form>


<hr>
<h4>Lista de O.S abertas</h4>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="parametro">Centro Custo:</label>
        <?php
        $sql = "SELECT * from os WHERE concluido = 'Não' order by centroCusto asc";
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
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table style="width: 1300px; text-align: left;">
        <tr>
          <th>Centro de Custo</th>
          <th>Filial</th>
          <th>Data solicitação</th>
          <th style="width: 180px;">Solicitante</th>
          <th>Matricula</th>
          <th style="width: 125px;">Telefone</th>
          <th>Numero O.S</th>
          <th>Tipo Servico</th>
          <th style="width: 300px;">Descrição</th>
          <th style="width: 88px;">Ação</th>
        </tr>
        <?php
        if ($parametro) {
        try{
          $stmt = $conexao->prepare("SELECT * FROM os, pessoa, filial WHERE os.solicitante = pessoa.idPessoa AND pessoa.filialPessoa = filial.idFilial AND os.concluido = 'Não' AND centroCusto like '$parametro' order by dataSolicitacao desc");
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
              ."</td><td><center><a href=\"?act=upd&idOs=".$rs->idOs."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
              ."&nbsp;&nbsp;"
              ."<a href=\"?act=del&idOs=".$rs->idOs."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
              echo "</tr>";
            }
          }else {
            echo "Erro: Não foi possível recuperar os dados do banco de dados";
          }
        }catch (PDOException $erro) {
          echo "Erro: ".$erro->getMessage();
        }
      }else{
        try{
          $stmt = $conexao->prepare("SELECT * FROM os, pessoa, filial WHERE os.solicitante = pessoa.idPessoa AND pessoa.filialPessoa = filial.idFilial AND os.concluido = 'Não' order by dataSolicitacao desc");
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
              ."</td><td><center><a href=\"?act=upd&idOs=".$rs->idOs."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
              ."&nbsp;&nbsp;"
              ."<a href=\"?act=del&idOs=".$rs->idOs."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
              echo "</tr>";
            }
          }else {
            echo "Erro: Não foi possível recuperar os dados do banco de dados";
          }
        }catch (PDOException $erro) {
          echo "Erro: ".$erro->getMessage();
        }
      }?>
    </table>
  </div>
</div>
</div>
<hr>
<h4>Lista de O.S encerradas</h4>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
  <div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="parametro2">Centro Custo:</label>
        <?php
        $sql = "SELECT * from os WHERE concluido = 'Sim' order by centroCusto asc";
        $stm = $conexao->prepare($sql);
        $stm->execute();
        $oss = $stm->fetchAll(PDO::FETCH_OBJ);
        ?>
        <select class="form-control" name="parametro2" id="parametro2" required>
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
<div class="row">
  <div class="col-md-12">
    <div class="table-responsive">
      <table style="width: 100%; text-align: left;">
       <tr>
        <th style="width: 120px;">Centro de Custo</th>
        <th>Filial</th>
        <th>Data solicitação</th>
        <th>Solicitante</th>
        <th>Matricula</th>
        <th style="width: 130px;">Telefone</th>
        <th>Numero O.S</th>
        <th>Tipo Servico</th>
        <th>Descrição</th>
        <th>Data Manutenção</th>
        <th style="width: 100px;">Ação</th>
      </tr>
      <?php
      if ($parametro2) {
        try{
          $stmt = $conexao->prepare("SELECT * FROM os, pessoa, filial WHERE os.solicitante = pessoa.idPessoa AND pessoa.filialPessoa = filial.idFilial AND os.concluido = 'Sim' AND centroCusto like '$parametro2'");
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
              ."</td><td><center><a href=\"?act=upd&idOs=".$rs->idOs."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
              ."&nbsp;&nbsp;"
              ."<a href=\"?act=del&idOs=".$rs->idOs."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
              echo "</tr>";
            }
          }else {
            echo "Erro: Não foi possível recuperar os dados do banco de dados";
          }
        }catch (PDOException $erro) {
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
              ."</td><td><center><a href=\"?act=upd&idOs=".$rs->idOs."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
              ."&nbsp;&nbsp;"
              ."<a href=\"?act=del&idOs=".$rs->idOs."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
              echo "</tr>";
            }
          }else {
            echo "Erro: Não foi possível recuperar os dados do banco de dados";
          }
        }catch (PDOException $erro) {
          echo "Erro: ".$erro->getMessage();
        }
      }
      ?>
    </table>
  </div>
</div>
</div>
</div>
<br><br><br>