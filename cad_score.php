<?php
error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php';

$paramentroCargo = filter_input(INPUT_POST, "paramentroCargo");

$matricula = $_SESSION['user_matricula'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idScore = (isset($_POST["idScore"]) && $_POST["idScore"] != null) ? $_POST["idScore"] : "";
    $idPessoa = (isset($_POST["idPessoa"]) && $_POST["idPessoa"] != null) ? $_POST["idPessoa"] : "";
    $scoreTotal = (isset($_POST["scoreTotal"]) && $_POST["scoreTotal"] != null) ? $_POST["scoreTotal"] : "";
    $notaResultado = (isset($_POST["notaResultado"]) && $_POST["notaResultado"] != null) ? $_POST["notaResultado"] : "";
    $notaGNegocio = (isset($_POST["notaGNegocio"]) && $_POST["notaGNegocio"] != null) ? $_POST["notaGNegocio"] : "";
    $notaGGente = (isset($_POST["notaGGente"]) && $_POST["notaGGente"] != null) ? $_POST["notaGGente"] : "";
    $notaGCliente = (isset($_POST["notaGCliente"]) && $_POST["notaGCliente"] != null) ? $_POST["notaGCliente"] : "";
    $notaGOperacional = (isset($_POST["notaGOperacional"]) && $_POST["notaGOperacional"] != null) ? $_POST["notaGOperacional"] : "";
    $quartilRegional = (isset($_POST["quartilRegional"]) && $_POST["quartilRegional"] != null) ? $_POST["quartilRegional"] : "";
    $quartilDiretoria = (isset($_POST["quartilDiretoria"]) && $_POST["quartilDiretoria"] != null) ? $_POST["quartilDiretoria"] : "";

} else if (!isset($idScore)) {
    $idScore = (isset($_GET["idScore"]) && $_GET["idScore"] != null) ? $_GET["idScore"] : "";
}

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $idPessoa != "") {
    try {
        if ($idScore != "") {
            $stmt = $conexao->prepare("UPDATE score  SET idPessoa=?, scoreTotal=?, notaResultado=?, notaGNegocio=?, notaGGente=?, notaGCliente=?, notaGOperacional=?, quartilRegional=?, quartilDiretoria=? WHERE idScore = ?");
            $stmt->bindParam(10, $idScore);
        } else {
            $stmt = $conexao->prepare("INSERT INTO score (idPessoa, scoreTotal, notaResultado, notaGNegocio, notaGGente, notaGCliente, notaGOperacional, quartilRegional, quartilDiretoria) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $idPessoa);
        $stmt->bindParam(2, $scoreTotal);
        $stmt->bindParam(3, $notaResultado);
        $stmt->bindParam(4, $notaGNegocio);
        $stmt->bindParam(5, $notaGGente);
        $stmt->bindParam(6, $notaGCliente);
        $stmt->bindParam(7, $notaGOperacional);
        $stmt->bindParam(8, $quartilRegional);
        $stmt->bindParam(9, $quartilDiretoria);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo"<script language='javascript' type='text/javascript'>alert('Dados cadastrados com sucesso!');window.location.href='cad_score.php';</script>";
                $idScore = null;
                $idPessoa = null;
                $scoreTotal = null;
                $notaResultado = null;
                $notaGNegocio = null;
                $notaGGente = null;
                $notaGCliente = null;
                $notaGOperacional = null;
                $quartilRegional = null;
                $quartilDiretoria = null;
                
            } else {
                echo "<script>alert('Erro ao efetivar o cadastro!')</script>";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idScore != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM score WHERE idScore = ?");
        $stmt->bindParam(1, $idScore, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idScore = $rs->idScore;
            $idPessoa = $rs->idPessoa;
            $scoreTotal = $rs->scoreTotal  ;
            $notaResultado = $rs->notaResultado;
            $notaGNegocio = $rs->notaGNegocio;
            $notaGGente = $rs->notaGGente;
            $notaGCliente = $rs->notaGCliente;
            $notaGOperacional = $rs->notaGOperacional;
            $quartilRegional = $rs->quartilRegional;
            $quartilDiretoria = $rs->quartilDiretoria;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}else{
    $idPessoa = null;
    $scoreTotal = null;
    $notaResultado = null;
    $notaGNegocio = null;
    $notaGGente = null;
    $notaGCliente = null;
    $notaGOperacional = null;
    $quartilRegional = null;
    $quartilDiretoria = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idScore != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM score WHERE idScore = ?");
        $stmt->bindParam(1, $idScore, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo"<script language='javascript' type='text/javascript'>alert('Registro excluido com sucesso!');window.location.href='cad_score.php';</script>";
            $idScore = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

?>
<div class="carregando" id="carregando"></div>
<div class="corpo" id="corpo">
<?php

if ($_SESSION['user_funcao'] == '1'){
    include_once("menu_administrador.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Cadastro Score</h3>
            </div>
        </div>
        <form action="?act=save" method="POST" name="form1">
            <div class="row">
                <input type="hidden" name="idScore" <?php
                if (isset($idScore) && $idScore != null || $idScore != "") {
                    echo "value=\"{$idScore}\"";
                }
                ?> />
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="idPessoa">Nome:</label>
                        <?php
                        $sql = "SELECT * from pessoa order by nome asc";
                        $stm = $conexao->prepare($sql);
                        $stm->execute();
                        $pessoas = $stm->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <select class="form-control" name="idPessoa" id="idPessoa" required>
                            <?php 
                            if (isset($idPessoa) && $idPessoa != null || $idPessoa != ""){?> <option value="<?=$idPessoa?>"><?=$nome?></option> <?php
                        }else{
                           ?><option value="">Nome</option><?php
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
                        <label for="notaResultado">Nota Resultado:</label>
                        <input type="text" name="notaResultado" class="form-control" required <?php
                        if (isset($notaResultado) && $notaResultado != null || $notaResultado != "") { echo "value=\"{$notaResultado}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="notaGNegocio">Nota Gestão de Negócios:</label>
                        <input type="text" name="notaGNegocio" class="form-control" required <?php
                        if (isset($notaGNegocio) && $notaGNegocio != null || $notaGNegocio != "") { echo "value=\"{$notaGNegocio}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="notaGGente">Nota Gestão de Gente:</label>
                        <input type="text" name="notaGGente" class="form-control" required <?php
                        if (isset($notaGGente) && $notaGGente != null || $notaGGente != "") { echo "value=\"{$notaGGente}\"";} ?> />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="notaGCliente">Nota Gestão de Clientes:</label>
                        <input type="text" name="notaGCliente" class="form-control" required <?php
                        if (isset($notaGCliente) && $notaGCliente != null || $notaGCliente != "") { echo "value=\"{$notaGCliente}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="notaGOperacional">Nota Gestão Operacional (AQO):</label>
                        <input type="text" name="notaGOperacional" class="form-control" required <?php
                        if (isset($notaGOperacional) && $notaGOperacional != null || $notaGOperacional != "") { echo "value=\"{$notaGOperacional}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="scoreTotal">Score Total:</label>
                        <input type="text" name="scoreTotal" class="form-control" required <?php
                        if (isset($scoreTotal) && $scoreTotal != null || $scoreTotal != "") { echo "value=\"{$scoreTotal}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="quartilRegional">Quartil Regional:</label>
                        <input type="text" name="quartilRegional" class="form-control" required <?php
                        if (isset($quartilRegional) && $quartilRegional != null || $quartilRegional != "") { echo "value=\"{$quartilRegional}\"";} ?> />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="quartilDiretoria">Quartil Diretoria:</label>
                        <input type="text" name="quartilDiretoria" class="form-control" required <?php
                        if (isset($quartilDiretoria) && $quartilDiretoria != null || $quartilDiretoria != "") { echo "value=\"{$quartilDiretoria}\"";} ?> />
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
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="paramentroCargo">Cargo:</label>
                    <select class="form-control" name="paramentroCargo" id="paramentroCargo" required="">
                        <option value="">Selecione o Cargo</option>
                        <option value="3">CAL</option>
                        <option value="2">Gerente Loja</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <input style="margin-top: 25px;" type="submit" class="btn btn-primary" value="Filtrar">
            </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 600px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Quartil Regional</th>
                            <th>Quartil Diretoria</th>
                            <th style="width: 100px; ">Ações</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                            try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and funcao.idFuncao = '$paramentroCargo' order by scoreTotal asc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria
                                        ."</td><td style='text-align: center'><center><a href=\"?act=upd&idScore=".$rs->idScore."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idScore=".$rs->idScore."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by scoreTotal asc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria
                                        ."</td><td style='text-align: center'><center><a href=\"?act=upd&idScore=".$rs->idScore."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idScore=".$rs->idScore."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 1000px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Resultado</th>
                            <th>Gestão de Negócios</th>
                            <th>Gestão de Gente</th>
                            <th>Gestão de Clientes</th>
                            <th>Gestão de Operacional (AQO)</th>
                            <th>Score Total</th>
                            <th style="width: 100px">Ações</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                             try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by scoreTotal asc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal
                                        ."</td><td><center><a href=\"?act=upd&idScore=".$rs->idScore."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idScore=".$rs->idScore."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by scoreTotal asc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal
                                        ."</td><td><center><a href=\"?act=upd&idScore=".$rs->idScore."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idScore=".$rs->idScore."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                <br><br><br>
            </div>
        </div>
    </div>
<?php }
else if ($_SESSION['user_funcao'] == '2') { 
    include_once("menu_gerente.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Restultado Score</h3>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 600px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Quartil Regional</th>
                            <th>Quartil Diretoria</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                            try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.matricula = '$matricula' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria;
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.matricula = '$matricula' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria;
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
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 1000px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Resultado</th>
                            <th>Gestão de Negócios</th>
                            <th>Gestão de Gente</th>
                            <th>Gestão de Clientes</th>
                            <th>Gestão de Operacional (AQO)</th>
                            <th>Score Total</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                             try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.matricula = '$matricula' and funcao.idFuncao = '$paramentroCargo' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal;
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.matricula = '$matricula' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal;
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
                <p style="color: red"><b>RESULTADO ACUMULADO DO 1˚, 2˚, 3˚ E 4˚ TRIMESTRE DE 2017.</b></p>
                <p style="color: red"><b>SCORE DA REGIONAL E MEDIDO A NIVEL REGIONAL.</b></p>
                <p style="color: red"><b>SCORE DA DIRETORIA E MEDIDO A NIVEL DIRETORIA.</b></p>
            </div>
        </div>
        <br>
        <div class="row hidden-xs">
            <div class="col-md-12">
                <img src="img/scoreGer.png">
            </div>
        </div>
        <div class="row visible-xs">
            <div class="col-md-12">
                <img style="width: 90%; margin-left: 5%;" src="img/scoreGer.png">
            </div>
        </div>
        <br><br><br>
    </div>
    <?php
}
else if ($_SESSION['user_funcao'] == '3') { 
    include_once("menu_cal.php");
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Restultado Score</h3>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 600px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Quartil Regional</th>
                            <th>Quartil Diretoria</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                            try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.matricula = '$matricula' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria;
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.matricula = '$matricula' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria;
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
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 1000px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Resultado</th>
                            <th>Gestão de Negócios</th>
                            <th>Gestão de Gente</th>
                            <th>Gestão de Clientes</th>
                            <th>Gestão de Operacional (AQO)</th>
                            <th>Score Total</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                             try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.matricula = '$matricula' and funcao.idFuncao = '$paramentroCargo' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal;
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and pessoa.matricula = '$matricula' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal;
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
                <p style="color: red"><b>RESULTADO ACUMULADO DO 1˚, 2˚, 3˚ E 4˚ TRIMESTRE DE 2017.</b></p>
                <p style="color: red"><b>SCORE DA REGIONAL E MEDIDO A NIVEL REGIONAL.</b></p>
                <p style="color: red"><b>SCORE DA DIRETORIA E MEDIDO A NIVEL DIRETORIA.</b></p>
            </div>
        </div>
        <br>
        <div class="row hidden-xs">
            <div class="col-md-12">
                <img src="img/score.png">
            </div>
        </div>
        <div class="row visible-xs">
            <div class="col-md-12">
                <img style="width: 90%; margin-left: 5%;" src="img/score.png">
            </div>
        </div>
        <br><br><br>
    </div>
    <?php
}
else if ($_SESSION['user_funcao'] == '4') { 
    include_once("menu_regional.php");
    ?>
    <div class="container">
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="paramentroCargo">Cargo:</label>
                    <select class="form-control" name="paramentroCargo" id="paramentroCargo" required="">
                        <option value="">Selecione o Cargo</option>
                        <option value="3">CAL</option>
                        <option value="2">Gerente Loja</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <input style="margin-top: 25px;" type="submit" class="btn btn-primary" value="Filtrar">
            </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 600px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Quartil Regional</th>
                            <th>Quartil Diretoria</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                            try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and funcao.idFuncao = '$paramentroCargo' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria;
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria;
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
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 1000px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Resultado</th>
                            <th>Gestão de Negócios</th>
                            <th>Gestão de Gente</th>
                            <th>Gestão de Clientes</th>
                            <th>Gestão de Operacional (AQO)</th>
                            <th>Score Total</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                             try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and funcao.idFuncao = '$paramentroCargo' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal;
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal;
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
                <br><br><br>
            </div>
        </div>
    </div>
    <?php
}
else if ($_SESSION['user_funcao'] == '5') { 
    include_once("menu_car.php");
    ?>
    <div class="container">
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="paramentroCargo">Cargo:</label>
                    <select class="form-control" name="paramentroCargo" id="paramentroCargo" required="">
                        <option value="">Selecione o Cargo</option>
                        <option value="3">CAL</option>
                        <option value="2">Gerente Loja</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <input style="margin-top: 25px;" type="submit" class="btn btn-primary" value="Filtrar">
            </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 600px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Quartil Regional</th>
                            <th>Quartil Diretoria</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                            try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and funcao.idFuncao = '$paramentroCargo' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria;
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria;
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
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 1000px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Resultado</th>
                            <th>Gestão de Negócios</th>
                            <th>Gestão de Gente</th>
                            <th>Gestão de Clientes</th>
                            <th>Gestão de Operacional (AQO)</th>
                            <th>Score Total</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                             try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and funcao.idFuncao = '$paramentroCargo' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal;
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal;
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
                <br><br><br>
            </div>
        </div>
    </div>
    <?php
}
else if ($_SESSION['user_funcao'] == '6') { 
    include_once("menu_consultorTreinamento.php");
    ?>
    <div class="container">
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="paramentroCargo">Cargo:</label>
                    <select class="form-control" name="paramentroCargo" id="paramentroCargo" required="">
                        <option value="">Selecione o Cargo</option>
                        <option value="3">CAL</option>
                        <option value="2">Gerente Loja</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <input style="margin-top: 25px;" type="submit" class="btn btn-primary" value="Filtrar">
            </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 600px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Quartil Regional</th>
                            <th>Quartil Diretoria</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                            try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and funcao.idFuncao = '$paramentroCargo' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria;
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria;
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
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 1000px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Resultado</th>
                            <th>Gestão de Negócios</th>
                            <th>Gestão de Gente</th>
                            <th>Gestão de Clientes</th>
                            <th>Gestão de Operacional (AQO)</th>
                            <th>Score Total</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                             try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and funcao.idFuncao = '$paramentroCargo' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal;
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal;
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
                <br><br><br>
            </div>
        </div>
    </div>
    <?php
}
else if ($_SESSION['user_funcao'] == '7') { 
    include_once("menu_consultorTreinamentoRegional.php");
    ?>
    <div class="container">
        <div class="row">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="paramentroCargo">Cargo:</label>
                    <select class="form-control" name="paramentroCargo" id="paramentroCargo" required="">
                        <option value="">Selecione o Cargo</option>
                        <option value="3">CAL</option>
                        <option value="2">Gerente Loja</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <input style="margin-top: 25px;" type="submit" class="btn btn-primary" value="Filtrar">
            </div>
            </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 600px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Quartil Regional</th>
                            <th>Quartil Diretoria</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                            try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and funcao.idFuncao = '$paramentroCargo' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria;
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->quartilRegional
                                        ."</td><td style='text-align: center'>".$rs->quartilDiretoria;
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
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 1000px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th style="width: 180px">Nome</th>
                            <th>Funcão</th>
                            <th>Resultado</th>
                            <th>Gestão de Negócios</th>
                            <th>Gestão de Gente</th>
                            <th>Gestão de Clientes</th>
                            <th>Gestão de Operacional (AQO)</th>
                            <th>Score Total</th>
                        </tr>
                        <?php
                        if ($paramentroCargo) {
                             try{
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao and funcao.idFuncao = '$paramentroCargo' order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal;
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
                                $stmt = $conexao->prepare("SELECT * FROM pessoa, score, funcao WHERE score.idPessoa = pessoa.idPessoa and pessoa.funcaoPessoa = funcao.idFuncao order by scoreTotal desc");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        echo "<tr>";
                                        echo "<td>".$rs->matricula
                                        ."</td><td>".$rs->nome
                                        ."</td><td>".$rs->nomeFuncao
                                        ."</td><td style='text-align: center'>".$rs->notaResultado
                                        ."</td><td style='text-align: center'>".$rs->notaGNegocio
                                        ."</td><td style='text-align: center'>".$rs->notaGGente
                                        ."</td><td style='text-align: center'>".$rs->notaGCliente
                                        ."</td><td style='text-align: center'>".$rs->notaGOperacional
                                        ."</td><td style='text-align: center'>".$rs->scoreTotal;
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
                <br><br><br>
            </div>
        </div>
    </div>
    <?php
} else{}

include_once("rodape.php");
?>
</div>