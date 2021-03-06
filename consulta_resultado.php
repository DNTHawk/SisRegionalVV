<div class="container">
    <h3><?php echo ($mesAtual); ?></h3>
    <br>
    <h4>Vendas Mercantil</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Filial</th>
                        <th>Meta Mercantil</th>
                        <th>Real. Mercantil</th>
                        <th>Ating. Mercantil</th>
                        <th>Ações</th>
                    </tr>
                    <?php 
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mes = '$mesAtual' AND filial.filial = '$filial' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>".$rs->filial
                                ."</td><td>".$rs->metaVendaMercantil
                                ."</td><td>".$rs->realVendaMercantil
                                ."</td><td>".$rs->vendaMercantil
                                ."</td><td><center><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
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
            </div>
        </div>
    </div>
    <br>
    <h4>Vendas Moveis</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Filial</th>
                        <th>Meta Moveis</th>
                        <th>Real. Moveis</th>
                        <th>Ating. Moveis</th>
                        <th>Ações</th>
                    </tr>
                    <?php 
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mes = '$mesAtual' AND filial.filial = '$filial' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>".$rs->filial
                                ."</td><td>".$rs->metaVendaMoveis
                                ."</td><td>".$rs->realVendaMoveis
                                ."</td><td>".$rs->vendaMoveis
                                ."</td><td><center><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
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
            </div>
        </div>
    </div>
    <br>
    <h4>CDC</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Filial</th>
                        <th>Meta CDC</th>
                        <th>Real. CDC</th>
                        <th>Ating. CDC</th>
                        <th>Ações</th>
                    </tr>
                    <?php 
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mes = '$mesAtual' AND filial.filial = '$filial' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>".$rs->filial
                                ."</td><td>".$rs->metaCdc
                                ."</td><td>".$rs->realCdc
                                ."</td><td>".$rs->cdc
                                ."</td><td><center><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
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
            </div>
        </div>
    </div>
    <br>
    <h4>Eficiencia</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Filial</th>
                        <th>Meta Eficiencia</th>
                        <th>Real. Eficiencia</th>
                        <th>Ating. Eficiencia</th>
                        <th>Ações</th>
                    </tr>
                    <?php 
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mes = '$mesAtual' AND filial.filial = '$filial' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>".$rs->filial
                                ."</td><td>".$rs->metaEficiencia
                                ."</td><td>".$rs->realEficiencia
                                ."</td><td>".$rs->eficiencia
                                ."</td><td><center><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
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
            </div>
        </div>
    </div>
    <br>
    <h4>Mix Serviços</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Filial</th>
                        <th>Meta Familia 1</th>
                        <th>Real. Familia 1</th>
                        <th>Ating. Familia 1</th>
                        <th>Meta Familia 2</th>
                        <th>Real. Familia 2</th>
                        <th>Ating. Familia 2</th>
                        <th>Meta Familia 3</th>
                        <th>Real. Familia 3</th>
                        <th>Ating. Familia 3</th>
                        <th>Meta Serviços</th>
                        <th>Real. Serviços</th>
                        <th>Ating. Serviços</th>
                        <th>Ações</th>
                    </tr>
                    <?php 
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mes = '$mesAtual' AND filial.filial = '$filial' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>".$rs->filial
                                ."</td><td>".$rs->metaFamilia1
                                ."</td><td>".$rs->realFamilia1
                                ."</td><td>".$rs->familia1
                                ."</td><td>".$rs->metaFamilia2
                                ."</td><td>".$rs->realFamilia2
                                ."</td><td>".$rs->familia2
                                ."</td><td>".$rs->metaFamilia3
                                ."</td><td>".$rs->realFamilia3
                                ."</td><td>".$rs->familia3
                                ."</td><td>".$rs->metaMixServico
                                ."</td><td>".$rs->realMixServico
                                ."</td><td>".$rs->mixServico
                                ."</td><td><center><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
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
            </div>
        </div>
    </div>
    <br>
    <h4>Planos / Cartões</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Filial</th>
                        <th>Meta Planos</th>
                        <th>Real. Planos</th>
                        <th>Ating. Planos</th>
                        <th>Meta Cartões</th>
                        <th>Real. Cartões</th>
                        <th>Ating. Cartões</th>
                        <th>Ações</th>
                    </tr>
                    <?php 
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mes = '$mesAtual' AND filial.filial = '$filial' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>".$rs->filial
                                ."</td><td>".$rs->metaPlanos
                                ."</td><td>".$rs->realPlanos
                                ."</td><td>".$rs->planos
                                ."</td><td>".$rs->metaCartoes
                                ."</td><td>".$rs->realCartoes
                                ."</td><td>".$rs->Cartões
                                ."</td><td><center><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
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
            </div>
        </div>
    </div>
    <br>
    <h4>Desconto</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Filial</th>
                        <th>Meta Desconto</th>
                        <th>Real. Desconto</th>
                        <th>Ating. Desconto</th>
                        <th>Ações</th>
                    </tr>
                    <?php 
                    try{
                        $stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mes = '$mesAtual' AND filial.filial = '$filial' order by filial.filial");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                echo "<tr>";
                                echo "<td>".$rs->filial
                                ."</td><td>".$rs->metaDesconto
                                ."</td><td>".$rs->realDesconto
                                ."</td><td>".$rs->desconto
                                ."</td><td><center><a href=\"?act=upd&idResultado=".$rs->idResultado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                ."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
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
            </div>
        </div>
    </div>
</div>