<?php

function abrirBanco(){
    $conexao = new mysqli("localhost", "id3133150_regional513", "dnt19101996", "id3133150_regional513");
    return $conexao;
}

function selectAllRs(){
    $banco = abrirBanco();
    $sql = "SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' order by filial.filial ";
    $resultado = $banco->query($sql);
    $banco->close();
    while ($row = mysqli_fetch_array($resultado)) {
        $grupo[] = $row;
    }
    return $grupo;
}

$grupo = selectAllRs();
//var_dump($grupo)

$arqexcel = "<meta charset='UTF-8'>";

$arqexcel .= "<table border='1'>
            <thead>
                <tr>
                      <th style='border-bottom: 2px solid #FF8000; font-size: 15px;'>Mês</th> 
                      <th style='border-bottom: 2px solid #FF8000; font-size: 15px;'>Ano</th> 
			          <th style='background-color: #088A08; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Filial</th>
			          <th style='background-color: #FF8000; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Meta Mercantil</th>
			          <th style='background-color: #FF8000; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Real. Mercantil</th>
			          <th style='background-color: #FF8000; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Ating. Mercantil</th>
			          <th style='background-color: #FFFF00; color: #000; border-bottom: 2px solid #FF8000; font-size: 15px;'>Meta Móveis</th>
			          <th style='background-color: #FFFF00; color: #000; border-bottom: 2px solid #FF8000; font-size: 15px;'>Real. Móveis</th>
			          <th style='background-color: #FFFF00; color: #000; border-bottom: 2px solid #FF8000; font-size: 15px;'>Ating. Móveis</th>
			          <th style='background-color: #424242; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Meta Desconto</th>
			          <th style='background-color: #424242; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Real. Desconto</th>
                      <th style='background-color: #424242; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Ating. Desconto</th>
                      <th style='background-color: #DF013A; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Meta CDC</th>
                      <th style='background-color: #DF013A; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Real. CDC</th>
                      <th style='background-color: #DF013A; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Ating. CDC</th>
                      <th style='background-color: #0000FF; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Meta Eficiência</th>
                      <th style='background-color: #0000FF; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Real. Eficiência</th>
                      <th style='background-color: #0000FF; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Ating. Eficiência</th>
                      <th style='background-color: #6A0888; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Meta Serviço</th>
                      <th style='background-color: #6A0888; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Real. Serviço</th>
                      <th style='background-color: #6A0888; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Ating. Serviço</th>
                      <th style='background-color: #8A0808; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Meta Planos</th>
                      <th style='background-color: #8A0808; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Real. Planos</th>
                      <th style='background-color: #8A0808; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Ating. Planos</th>
                      <th style='background-color: #610B4B; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Meta Cartões</th>
                      <th style='background-color: #610B4B; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Real. Cartões</th>
                      <th style='background-color: #610B4B; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Ating. Cartões</th>
                      <th style='background-color: #8A0808; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Meta LB</th>
                      <th style='background-color: #8A0808; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Real. LB</th>
                      <th style='background-color: #8A0808; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Ating. LB</th>
                      <th style='background-color: #8A0808; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Fator Mercadoria</th>
                      <th style='background-color: #8A0808; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Fator Meio de Pagamento</th>
                      <th style='background-color: #8A0808; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>Fator Desconto</th>
                      <th style='background-color: #8A0808; color: #fff; border-bottom: 2px solid #FF8000; font-size: 15px;'>IR</th>
                </tr>
            </thead>
            <tbody>";
                
                    foreach ($grupo as $rs) { 
           $arqexcel .="        <tr>
                    <td>{$rs["mes"]}</td>
                    <td>{$rs["ano"]}</td>
                    <td>{$rs["filial"]}</td>
                    <td>R$ ".number_format($rs["metaVendaMercantil"], 0, ',', '.')."</td>
                    <td>R$ ".number_format($rs["realVendaMercantil"], 0, ',', '.')."</td>
                    <td>".number_format($rs["vendaMercantil"], 1, ',', '')."%</td>
                    <td>R$ ".number_format($rs["metaVendaMoveis"], 0, ',', '.')."</td>
                    <td>R$ ".number_format($rs["realVendaMoveis"], 0, ',', '.')."</td>
                    <td>".number_format($rs["vendaMoveis"], 1, ',', '')."%</td>
                    <td>".number_format($rs["metaDesconto"], 1, ',', '')."%</td>
                    <td>".number_format($rs["realDesconto"], 1, ',', '')."%</td>
                    <td>".number_format($rs["desconto"], 1, ',', '')."%</td>
                    <td>".number_format($rs["metaCdc"], 1, ',', '')."%</td>
                    <td>".number_format($rs["realCdc"], 1, ',', '')."%</td>
                    <td>".number_format($rs["cdc"], 1, ',', '')."%</td>
                    <td>".number_format($rs["metaEficiencia"], 1, ',', '')."%</td>
                    <td>".number_format($rs["realEficiencia"], 1, ',', '')."%</td>
                    <td>".number_format($rs["eficiencia"], 1, ',', '')."%</td>
                    <td>R$ ".number_format($rs["metaMixServico"], 0, ',', '.')."</td>
                    <td>R$ ".number_format($rs["realMixServico"], 0, ',', '.')."</td>
                    <td>".number_format($rs["mixServico"], 1, ',', '')."%</td>
                    <td>R$ ".number_format($rs["metaPlanos"], 0, ',', '.')."</td>
                    <td>R$ ".number_format($rs["realPlanos"], 0, ',', '.')."</td>
                    <td>".number_format($rs["planos"], 1, ',', '')."%</td>
                    <td>".number_format($rs["metaCartoes"], 0, ',', '.')." Un.</td>
                    <td>".number_format($rs["realCartoes"], 0, ',', '.')." Un.</td>
                    <td>".number_format($rs["cartoes"], 1, ',', '.')."%</td>
                    <td>R$ ".number_format($rs["metaLb"], 0, ',', '.')."</td>
                    <td>R$ ".number_format($rs["realLb"], 0, ',', '.')."</td>
                    <td>".number_format($rs["lb"], 1, ',', '')."%</td>
                    <td>".number_format($rs["fatorMercadoria"], 2, ',', '.')."%</td>
                    <td>".number_format($rs["fatorMeioPagamento"], 2, ',', '.')."%</td>
                    <td>-".number_format($rs["fatorDesconto"], 2, ',', '.')."%</td>
                    <td>".number_format($rs["ir"], 2, ',', '')."%</td>
                    </tr>";
                  }
                
          $arqexcel .="  </tbody>
        </table>";
          
          header("Content-Type: application/xls");
          header("Content-Disposition:attachment; filename = relatorioResultado.xls");
          echo $arqexcel;


?>
