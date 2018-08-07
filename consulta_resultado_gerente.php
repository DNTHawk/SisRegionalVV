<div class="container">
    <h2>Resultados Filial <?php echo ($filialUser); ?></h2>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="parametroMes">Mês:</label>
                    <select class="form-control" name="parametroMes">
                        <option value="<?php echo($mesAtual) ?>">Mês Atual</option>
                        <option value="Janeiro">Janeiro</option>
                        <option value="Fevereiro">Fevereiro</option>
                        <option value="Março">Março</option>
                        <option value="Abril">Abril</option>
                        <option value="Maio">Maio</option>
                        <option value="Junho">Junho</option>
                        <option value="Julho">Julho</option>
                        <option value="Agosto">Agosto</option>
                        <option value="Setembro">Setembro</option>
                        <option value="Outubro">Outubro</option>
                        <option value="Novembro">Novembro</option>
                        <option value="Dezembro">Dezembro</option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="parametroAno">Ano:</label>
                    <select class="form-control" name="parametroAno">
                        <option value="<?php echo($anoAtual)?>">Ano Atual</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    <input style="margin-top: 25px;" type="submit" class="btn btn-primary btn-block" value="Filtrar">
                </div>
            </div>
        </div>
    </form>

    <h3><?php 
    if (($parametroMes) || ($parametroAno)) {
        echo ($parametroMes);?> / <?php echo ($parametroAno);  
    }else{
        echo ($mesAtual);?> / <?php echo ($anoAtual);
    }   
    ?> 
</h3>
<div class="row">
    <div class="col-md-12">
        <h4>Vendas Mercantil / Moveis / Desconto</h4>
    </div>
</div> 
<div class="row hidden-xs">
    <div class="col-md-12">
        <div class="table-responsive">
            <table style="text-align: right;">
                <tr>
                    <th class="mercantil">Meta Mercantil</th>
                    <th class="mercantil">Real. Mercantil</th>
                    <th class="mercantil">Ating. Mercantil</th>
                    <th class="moveis">Meta Moveis</th>
                    <th class="moveis">Real. Moveis</th>
                    <th class="moveis">Ating. Moveis</th>
                    <th class="desconto">Meta Desconto</th>
                    <th class="desconto">Real. Desconto</th>
                    <th class="desconto">Ating. Desconto</th>
                </tr>
                <?php
                if ($parametroAtual) {
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr class='tr2'>";
                                echo "<td>R$ ".number_format($rs->metaVendaMercantil, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realVendaMercantil, 0, ',', '.')
                                ."</td><td>".number_format($rs->vendaMercantil, 1, ',', '')
                                ."%</td><td>R$ ".number_format($rs->metaVendaMoveis, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realVendaMoveis, 0, ',', '.')
                                ."</td><td>".number_format($rs->vendaMoveis, 1, ',', '')
                                ."%</td><td>".number_format($rs->metaDesconto, 1, ',', '')
                                ."%</td><td>".number_format($rs->realDesconto, 1, ',', '')
                                ."%</td><td>".number_format($rs->desconto, 1, ',', '')."%</td>";
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
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr class='tr2'>";
                                echo "<td>R$ ".number_format($rs->metaVendaMercantil, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realVendaMercantil, 0, ',', '.')
                                ."</td><td>".number_format($rs->vendaMercantil, 1, ',', '')
                                ."%</td><td>R$ ".number_format($rs->metaVendaMoveis, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realVendaMoveis, 0, ',', '.')
                                ."</td><td>".number_format($rs->vendaMoveis, 1, ',', '')
                                ."%</td><td>".number_format($rs->metaDesconto, 1, ',', '')
                                ."%</td><td>".number_format($rs->realDesconto, 1, ',', '')
                                ."%</td><td>".number_format($rs->desconto, 1, ',', '')."%</td>";
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
        </div>
    </div>
</div>
<div class="row visible-xs">
    <div class="col-md-12">
        <div class="table-responsive">
            <table style="width: 1000px; text-align: right;">
                <tr>
                    <th class="mercantil">Meta Mercantil</th>
                    <th class="mercantil">Real. Mercantil</th>
                    <th class="mercantil">Ating. Mercantil</th>
                    <th class="moveis">Meta Moveis</th>
                    <th class="moveis">Real. Moveis</th>
                    <th class="moveis">Ating. Moveis</th>
                    <th class="desconto">Meta Desconto</th>
                    <th class="desconto">Real. Desconto</th>
                    <th class="desconto">Ating. Desconto</th>
                </tr>
                <?php
                if ($parametroAtual) {
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr class='tr2'>";
                                echo "<td>R$ ".number_format($rs->metaVendaMercantil, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realVendaMercantil, 0, ',', '.')
                                ."</td><td>".number_format($rs->vendaMercantil, 1, ',', '')
                                ."%</td><td>R$ ".number_format($rs->metaVendaMoveis, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realVendaMoveis, 0, ',', '.')
                                ."</td><td>".number_format($rs->vendaMoveis, 1, ',', '')
                                ."%</td><td>".number_format($rs->metaDesconto, 1, ',', '')
                                ."%</td><td>".number_format($rs->realDesconto, 1, ',', '')
                                ."%</td><td>".number_format($rs->desconto, 1, ',', '')."%</td>";
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
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr class='tr2'>";
                                echo "<td>R$ ".number_format($rs->metaVendaMercantil, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realVendaMercantil, 0, ',', '.')
                                ."</td><td>".number_format($rs->vendaMercantil, 1, ',', '')
                                ."%</td><td>R$ ".number_format($rs->metaVendaMoveis, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realVendaMoveis, 0, ',', '.')
                                ."</td><td>".number_format($rs->vendaMoveis, 1, ',', '')
                                ."%</td><td>".number_format($rs->metaDesconto, 1, ',', '')
                                ."%</td><td>".number_format($rs->realDesconto, 1, ',', '')
                                ."%</td><td>".number_format($rs->desconto, 1, ',', '')."%</td>";
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
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <h4>CDC / Eficiencia</h4>
    </div>
</div> 
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table style="width: 700px; text-align: right;" >
                <tr>
                    <th class="cdc">Meta CDC</th>
                    <th class="cdc">Real. CDC</th>
                    <th class="cdc">Ating. CDC</th>
                    <th class="eficiencia">Meta Eficiencia</th>
                    <th class="eficiencia">Real. Eficiencia</th>
                    <th class="eficiencia">Ating. Eficiencia</th>
                </tr>
                <?php 
                if ($parametroAtual) {
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>".number_format($rs->metaCdc, 1, ',', '')
                                ."%</td><td>".number_format($rs->realCdc, 1, ',', '')
                                ."%</td><td>".number_format($rs->cdc, 1, ',', '')
                                ."%</td><td>".number_format($rs->metaEficiencia, 2, ',', '')
                                ."%</td><td>".number_format($rs->realEficiencia, 2, ',', '')
                                ."%</td><td>".number_format($rs->eficiencia, 2, ',', '')."%</td>";
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
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>".number_format($rs->metaCdc, 1, ',', '')
                                ."%</td><td>".number_format($rs->realCdc, 1, ',', '')
                                ."%</td><td>".number_format($rs->cdc, 1, ',', '')
                                ."%</td><td>".number_format($rs->metaEficiencia, 2, ',', '')
                                ."%</td><td>".number_format($rs->realEficiencia, 2, ',', '')
                                ."%</td><td>".number_format($rs->eficiencia, 2, ',', '')."%</td>";
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
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <h4>Mix Serviços</h4>
    </div>
</div>
<div class="row hidden-xs">
    <div class="col-md-12">
        <div class="table-responsive">
            <table style="text-align: right; width: 130%">
                <tr>
                    <th class="familia1">Meta Familia 1</th>
                    <th class="familia1">Real. Familia 1</th>
                    <th class="familia1">Ating. Familia 1</th>
                    <th class="familia2">Meta Familia 2</th>
                    <th class="familia2">Real. Familia 2</th>
                    <th class="familia2">Ating. Familia 2</th>
                    <th class="familia3">Meta Familia 3</th>
                    <th class="familia3">Real. Familia 3</th>
                    <th class="familia3">Ating. Familia 3</th>
                    <th class="servico">Meta Serviços</th>
                    <th class="servico">Real. Serviços</th>
                    <th class="servico">Ating. Serviços</th>
                </tr>
                <?php 
                if ($parametroAtual) {
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>R$ ".number_format($rs->metaFamilia1, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realFamilia1, 0, ',', '.')
                                ."</td><td>".number_format($rs->familia1, 1, ',', '.')
                                ."%</td><td>R$ ".number_format($rs->metaFamilia2, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realFamilia2, 0, ',', '.')
                                ."</td><td>".number_format($rs->familia2, 1, ',', '.')
                                ."%</td><td>R$ ".number_format($rs->metaFamilia3, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realFamilia3, 0, ',', '.')
                                ."</td><td>".number_format($rs->familia3, 1, ',', '.')
                                ."%</td><td>R$ ".number_format($rs->metaMixServico, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realMixServico, 0, ',', '.')
                                ."</td><td>".number_format($rs->mixServico, 1, ',', '.')."%</td>";
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
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>R$ ".number_format($rs->metaFamilia1, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realFamilia1, 0, ',', '.')
                                ."</td><td>".number_format($rs->familia1, 1, ',', '.')
                                ."%</td><td>R$ ".number_format($rs->metaFamilia2, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realFamilia2, 0, ',', '.')
                                ."</td><td>".number_format($rs->familia2, 1, ',', '.')
                                ."%</td><td>R$ ".number_format($rs->metaFamilia3, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realFamilia3, 0, ',', '.')
                                ."</td><td>".number_format($rs->familia3, 1, ',', '.')
                                ."%</td><td>R$ ".number_format($rs->metaMixServico, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realMixServico, 0, ',', '.')
                                ."</td><td>".number_format($rs->mixServico, 1, ',', '.')."%</td>";
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
        </div>
    </div>
</div>
<div class="row visible-xs">
    <div class="col-md-12">
        <div class="table-responsive">
            <table style="text-align: right; width: 1100px">
                <tr>
                    <th class="familia1">Meta Familia 1</th>
                    <th class="familia1">Real. Familia 1</th>
                    <th class="familia1">Ating. Familia 1</th>
                    <th class="familia2">Meta Familia 2</th>
                    <th class="familia2">Real. Familia 2</th>
                    <th class="familia2">Ating. Familia 2</th>
                    <th class="familia3">Meta Familia 3</th>
                    <th class="familia3">Real. Familia 3</th>
                    <th class="familia3">Ating. Familia 3</th>
                    <th class="servico">Meta Serviços</th>
                    <th class="servico">Real. Serviços</th>
                    <th class="servico">Ating. Serviços</th>
                </tr>
                <?php 
                if ($parametroAtual) {
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>R$ ".number_format($rs->metaFamilia1, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realFamilia1, 0, ',', '.')
                                ."</td><td>".number_format($rs->familia1, 1, ',', '.')
                                ."%</td><td>R$ ".number_format($rs->metaFamilia2, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realFamilia2, 0, ',', '.')
                                ."</td><td>".number_format($rs->familia2, 1, ',', '.')
                                ."%</td><td>R$ ".number_format($rs->metaFamilia3, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realFamilia3, 0, ',', '.')
                                ."</td><td>".number_format($rs->familia3, 1, ',', '.')
                                ."%</td><td>R$ ".number_format($rs->metaMixServico, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realMixServico, 0, ',', '.')
                                ."</td><td>".number_format($rs->mixServico, 1, ',', '.')."%</td>";
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
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>R$ ".number_format($rs->metaFamilia1, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realFamilia1, 0, ',', '.')
                                ."</td><td>".number_format($rs->familia1, 1, ',', '.')
                                ."%</td><td>R$ ".number_format($rs->metaFamilia2, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realFamilia2, 0, ',', '.')
                                ."</td><td>".number_format($rs->familia2, 1, ',', '.')
                                ."%</td><td>R$ ".number_format($rs->metaFamilia3, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realFamilia3, 0, ',', '.')
                                ."</td><td>".number_format($rs->familia3, 1, ',', '.')
                                ."%</td><td>R$ ".number_format($rs->metaMixServico, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realMixServico, 0, ',', '.')
                                ."</td><td>".number_format($rs->mixServico, 1, ',', '.')."%</td>";
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
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <h4>Planos / Cartões</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table style="width: 700px; text-align: right;">
                <tr>
                    <th class="planos">Meta Planos</th>
                    <th class="planos">Real. Planos</th>
                    <th class="planos">Ating. Planos</th>
                    <th class="cartoes">Meta Cartões</th>
                    <th class="cartoes">Real. Cartões</th>
                    <th class="cartoes">Ating. Cartões</th>
                </tr>
                <?php 
                if ($parametroAtual) {
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>R$ ".number_format($rs->metaPlanos, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realPlanos, 0, ',', '.')
                                ."</td><td>".number_format($rs->planos, 1, ',', '.')
                                ."</td><td>".number_format($rs->metaCartoes, 0, ',', '.')
                                ." Un.</td><td>".number_format($rs->realCartoes, 0, ',', '.')
                                ." Un.</td><td>".number_format($rs->cartoes, 1, ',', '.')."%</td>";
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
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>R$ ".number_format($rs->metaPlanos, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realPlanos, 0, ',', '.')
                                ."</td><td>".number_format($rs->planos, 1, ',', '.')
                                ."</td><td>".number_format($rs->metaCartoes, 0, ',', '.')
                                ." Un.</td><td>".number_format($rs->realCartoes, 0, ',', '.')
                                ." Un.</td><td>".number_format($rs->cartoes, 1, ',', '.')."%</td>";
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
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <h4>LB</h4>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table style="width: 382px; text-align: right;">
                <tr>
                    <th class="planos">Meta LB</th>
                    <th class="planos">Real. LB</th>
                    <th class="planos">Ating. LB</th>
                </tr>
                <?php 
                if ($parametroAtual) {
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$parametroAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>R$ ".number_format($rs->metaLb, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realLb, 0, ',', '.')
                                ."</td><td>".number_format($rs->lb, 1, ',', '.')."%</td>";
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
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno like '$mesAnoAtual%' AND filial.filial = '$filialUser' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>R$ ".number_format($rs->metaLb, 0, ',', '.')
                                ."</td><td>R$ ".number_format($rs->realLb, 0, ',', '.')
                                ."</td><td>".number_format($rs->lb, 1, ',', '.')."%</td>";
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
        </div>
    </div>
</div>
</div>