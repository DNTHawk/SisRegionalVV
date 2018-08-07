    <div class="container">
        <div class="row">
            <div class="col-md-1">
                <h3>Gerentes</h3>
            </div>
            <div style="margin-top: 20px; margin-left: 20px; font-size: 20px;" class="col-md-1 hidden-xs">
                <a href="relatorio_gerente.php" data-toggle="tooltip" data-placement="left" title="Imprimir"><span style="color: #000" class="glyphicon glyphicon-print"></span></a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 1100px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th>Nome</th>
                            <th>Função</th>
                            <th>Filial</th>
                            <th>Email</th>
                            <th>Ramal Filial</th>
                            <th>Número Celular</th>
                            <th>Corporativo</th>
                        </tr>
                        <?php 
                        try{
                            $stmt = $conexao->prepare("SELECT * FROM pessoa, funcao, filial WHERE pessoa.filialPessoa = filial.idFilial and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.funcaoPessoa = '2' order by filial.filial");
                            if ($stmt->execute()) {
                                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    echo "<tr>";
                                    echo "<td>".$rs->matricula
                                    ."</td><td>".$rs->nome
                                    ."</td><td>".$rs->nomeFuncao
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
                </div>
                <br><br><br>
            </div>
        </div>
    </div>