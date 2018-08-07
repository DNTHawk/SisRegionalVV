<?php

function abrirBanco(){
    $conexao = new mysqli("localhost", "id3133150_regional513", "dnt19101996", "id3133150_regional513");
    return $conexao;
}

function selectAllOs(){
    $banco = abrirBanco();
    $sql = "SELECT * FROM os, pessoa, filial WHERE os.solicitante = pessoa.idPessoa AND pessoa.filialPessoa = filial.idFilial order by dataSolicitacao desc ";
    $resultado = $banco->query($sql);
    $banco->close();
    while ($row = mysqli_fetch_array($resultado)) {
        $grupo[] = $row;
    }
    return $grupo;
}

function formatoData($data){
    $array = explode("-", $data);
    $novaData = $array[2]."/".$array["1"]."/".$array[0];
    return $novaData;
}

$grupo = selectAllOs();

$arqexcel = "<meta charset='UTF-8'>";

$arqexcel .= "<table border='1'>
            <thead>
                <tr>
                   	  <th>Centro de Custo</th>
			          <th>Filial</th>
			          <th>Data solicitação</th>
			          <th>Solicitante</th>
			          <th>Matricula</th>
			          <th>Telefone</th>
			          <th>Numero O.S</th>
			          <th>Tipo Servico</th>
			          <th>Descrição</th>
			          <th>Data Manutenção</th>
                </tr>
            </thead>
            <tbody>";
                
                    foreach ($grupo as $os) { 
           $arqexcel .="        <tr>
                    <td>{$os["centroCusto"]}</td>
                    <td>{$os["filial"]}</td>
                    <td>".formatoData($os["dataSolicitacao"])."</td>
                    <td>{$os["nome"]}</td>
                    <td>{$os["matricula"]}</td>
                    <td>{$os["numCorporativo"]}</td>
                    <td>{$os["numeroOs"]}</td>
                    <td>{$os["tipoServico"]}</td>
                    <td>{$os["descricao"]}</td>
                    <td>".formatoData($os["dataManutencao"])."</td>
                    </tr>";
                  }
                
          $arqexcel .="  </tbody>
        </table>";
          
          header("Content-Type: application/xls");
          header("Content-Disposition:attachment; filename = relatorioOs.xls");
          echo $arqexcel;


?>
