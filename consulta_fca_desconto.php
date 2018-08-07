<div class="row">
  <div class="col-md-12">
    <h3>Desconto</h3>
  </div>
</div>
<div class="table-responsive hidden-xs">
  <table style="width: 100%" class="fcaTable">
    <tr>
      <th style="width: 30%">Fato</th>
      <th style="width: 30%">Causa</th>
      <th style="width: 30%">Acão</th>
      <th style="width: 20%">Responsavel</th>
      <th style="width: 20%">Prazo</th>
    </tr>
    <?php 
    if ($parametroRegLoja) {
      try {
        $stmt = $conexao->prepare("SELECT * FROM fca WHERE filialFca = '$parametroRegLoja' AND mesAno = '$parametroAtual'");
        $stmt->bindParam(1, $idFca, PDO::PARAM_INT);
        if ($stmt->execute()) {
          while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
           $array_data = explode('-', $rs->prazoDesconto);
           $data_formatada_prazoDesconto = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
           echo "<tr>";
           echo "<td>".$rs->fatoDesconto
           ."</td><td>".$rs->causaDesconto
           ."</td><td>".$rs->acaoDesconto
           ."</td><td>".$rs->respDesconto
           ."</td><td>".$data_formatada_prazoDesconto;
           echo "</tr>";
          }
        } else {
          echo "Erro: Não foi possível recuperar os dados do banco de dados";
        }
      } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
      }
    }else{
      try {
        $stmt = $conexao->prepare("SELECT * FROM fca WHERE filialFca = '$filial' AND mesAno = '$parametroAtual'");
        $stmt->bindParam(1, $idFca, PDO::PARAM_INT);
        if ($stmt->execute()) {
          while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            $array_data = explode('-', $rs->prazoDesconto);
            $data_formatada_prazoDesconto = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
            echo "<tr>";
            echo "<td>".$rs->fatoDesconto
            ."</td><td>".$rs->causaDesconto
            ."</td><td>".$rs->acaoDesconto
            ."</td><td>".$rs->respDesconto
            ."</td><td>".$data_formatada_prazoDesconto;
            echo "</tr>";
          }
        } else {
          echo "Erro: Não foi possível recuperar os dados do banco de dados";
        }
      } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
      }
    }?>
  </table>
</div>

<div class="table-responsive visible-xs">
  <table style="width: 1000px" class="fcaTable">
    <tr>
      <th style="width: 30%">Fato</th>
      <th style="width: 30%">Causa</th>
      <th style="width: 30%">Acão</th>
      <th style="width: 20%">Responsavel</th>
      <th style="width: 20%">Prazo</th>
    </tr>
    <?php 
    if ($parametroRegLoja) {
      try {
        $stmt = $conexao->prepare("SELECT * FROM fca WHERE filialFca = '$parametroRegLoja' AND mesAno = '$parametroAtual'");
        $stmt->bindParam(1, $idFca, PDO::PARAM_INT);
        if ($stmt->execute()) {
          while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
           $array_data = explode('-', $rs->prazoDesconto);
           $data_formatada_prazoDesconto = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
           echo "<tr>";
           echo "<td>".$rs->fatoDesconto
           ."</td><td>".$rs->causaDesconto
           ."</td><td>".$rs->acaoDesconto
           ."</td><td>".$rs->respDesconto
           ."</td><td>".$data_formatada_prazoDesconto;
           echo "</tr>";
          }
        } else {
          echo "Erro: Não foi possível recuperar os dados do banco de dados";
        }
      } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
      }
    }else{
      try {
        $stmt = $conexao->prepare("SELECT * FROM fca WHERE filialFca = '$filial' AND mesAno = '$parametroAtual'");
        $stmt->bindParam(1, $idFca, PDO::PARAM_INT);
        if ($stmt->execute()) {
          while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
            $array_data = explode('-', $rs->prazoDesconto);
            $data_formatada_prazoDesconto = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
            echo "<tr>";
            echo "<td>".$rs->fatoDesconto
            ."</td><td>".$rs->causaDesconto
            ."</td><td>".$rs->acaoDesconto
            ."</td><td>".$rs->respDesconto
            ."</td><td>".$data_formatada_prazoDesconto;
            echo "</tr>";
          }
        } else {
          echo "Erro: Não foi possível recuperar os dados do banco de dados";
        }
      } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
      }
    }?>
  </table>
</div>
