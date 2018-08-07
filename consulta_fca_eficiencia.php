<div class="row">
  <div class="col-md-12">
    <h3>Eficiência</h3>
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
           $array_data = explode('-', $rs->prazoEficiencia);
           $data_formatada_prazoEficiencia = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
           echo "<tr>";
           echo "<td>".$rs->fatoEficiencia
           ."</td><td>".$rs->causaEficiencia
           ."</td><td>".$rs->acaoEficiencia
           ."</td><td>".$rs->respEficiencia
           ."</td><td>".$data_formatada_prazoEficiencia;
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
            $array_data = explode('-', $rs->prazoEficiencia);
            $data_formatada_prazoEficiencia = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
            echo "<tr>";
            echo "<td>".$rs->fatoEficiencia
            ."</td><td>".$rs->causaEficiencia
            ."</td><td>".$rs->acaoEficiencia
            ."</td><td>".$rs->respEficiencia
            ."</td><td>".$data_formatada_prazoEficiencia;
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
           $array_data = explode('-', $rs->prazoEficiencia);
           $data_formatada_prazoEficiencia = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
           echo "<tr>";
           echo "<td>".$rs->fatoEficiencia
           ."</td><td>".$rs->causaEficiencia
           ."</td><td>".$rs->acaoEficiencia
           ."</td><td>".$rs->respEficiencia
           ."</td><td>".$data_formatada_prazoEficiencia;
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
            $array_data = explode('-', $rs->prazoEficiencia);
            $data_formatada_prazoEficiencia = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
            echo "<tr>";
            echo "<td>".$rs->fatoEficiencia
            ."</td><td>".$rs->causaEficiencia
            ."</td><td>".$rs->acaoEficiencia
            ."</td><td>".$rs->respEficiencia
            ."</td><td>".$data_formatada_prazoEficiencia;
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
