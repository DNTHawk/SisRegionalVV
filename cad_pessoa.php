<?php
error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php'; 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPessoa = (isset($_POST["idPessoa"]) && $_POST["idPessoa"] != null) ? $_POST["idPessoa"] : "";
    $matricula = (isset($_POST["matricula"]) && $_POST["matricula"] != null) ? $_POST["matricula"] : "";
    $filialPessoa = (isset($_POST["filialPessoa"]) && $_POST["filialPessoa"] != null) ? $_POST["filialPessoa"] : "";
    $funcaoPessoa = (isset($_POST["funcaoPessoa"]) && $_POST["funcaoPessoa"] != null) ? $_POST["funcaoPessoa"] : "";
    $nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
    $cpf = (isset($_POST["cpf"]) && $_POST["cpf"] != null) ? $_POST["cpf"] : "";
    $email = (isset($_POST["email"]) && $_POST["email"] != null) ? $_POST["email"] : "";
    $numCelular = (isset($_POST["numCelular"]) && $_POST["numCelular"] != null) ? $_POST["numCelular"] : "";
    $passwordHash = 'NULL';
    $perguntaSeguranca = 'NULL';
    $respPerguntaSeguranca = 'NULL';
    $dataContratacao = (isset($_POST["dataContratacao"]) && $_POST["dataContratacao"] != null) ? $_POST["dataContratacao"] : "";
    $dataInicioLoja = (isset($_POST["dataInicioLoja"]) && $_POST["dataInicioLoja"] != null) ? $_POST["dataInicioLoja"] : "";
    $dataInicioFuncao = (isset($_POST["dataInicioFuncao"]) && $_POST["dataInicioFuncao"] != null) ? $_POST["dataInicioFuncao"] : "";

} else if (!isset($idPessoa)) {
    $idPessoa = (isset($_GET["idPessoa"]) && $_GET["idPessoa"] != null) ? $_GET["idPessoa"] : "";
}

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $matricula != "") {
    try {
        if ($idPessoa != "") {
            $stmt = $conexao->prepare("UPDATE pessoa  SET matricula=?, filialPessoa=?, funcaoPessoa=?, nome=?, cpf=?, email=?, numCelular=?, passwordHash=?, perguntaSeguranca=?, respPerguntaSeguranca=?, dataContratacao=?, dataInicioLoja=?, dataInicioFuncao=? WHERE idPessoa = ?");
            $stmt->bindParam(14, $idPessoa);
        } else {
            $stmt = $conexao->prepare("INSERT INTO pessoa (matricula, filialPessoa, funcaoPessoa, nome, cpf, email, numCelular, passwordHash, perguntaSeguranca, respPerguntaSeguranca, dataContratacao, dataInicioLoja, dataInicioFuncao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        }
        $stmt->bindParam(1, $matricula);
        $stmt->bindParam(2, $filialPessoa);
        $stmt->bindParam(3, $funcaoPessoa);
        $stmt->bindParam(4, $nome);
        $stmt->bindParam(5, $cpf);
        $stmt->bindParam(6, $email);
        $stmt->bindParam(7, $numCelular);
        $stmt->bindParam(8, $passwordHash);
        $stmt->bindParam(9, $perguntaSeguranca);
        $stmt->bindParam(10, $respPerguntaSeguranca);
        $stmt->bindParam(11, $dataContratacao);
        $stmt->bindParam(12, $dataInicioLoja);
        $stmt->bindParam(13, $dataInicioFuncao);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo"<script language='javascript' type='text/javascript'>alert('Dados cadastrados com sucesso!');window.location.href='cad_pessoa.php';</script>";
                $idPessoa = null;
                $matricula = null;
                $filialPessoa = null;
                $funcaoPessoa = null;
                $nome = null;
                $cpf = null;
                $email = null;
                $numCelular = null;
                $passwordHash = null;
                $perguntaSeguranca = null;
                $respPerguntaSeguranca = null;
                $dataContratacao = null;
                $dataInicioLoja = null;
                $dataInicioFuncao = null;
                
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

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idPessoa != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM pessoa, filial, funcao WHERE pessoa.funcaoPessoa = funcao.idFuncao AND pessoa.filialPessoa = filial.idFilial AND idPessoa = ?");
        $stmt->bindParam(1, $idPessoa, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idPessoa = $rs->idPessoa;
            $matricula = $rs->matricula;
            $filialPessoa = $rs->filialPessoa  ;
            $funcaoPessoa = $rs->funcaoPessoa;
            $nome = $rs->nome;
            $cpf = $rs->cpf;
            $email = $rs->email;
            $numCelular = $rs->numCelular;
            $passwordHash = $rs->passwordHash;
            $filial = $rs->filial;
            $nomeFuncao = $rs->nomeFuncao;
            $perguntaSeguranca = $rs->perguntaSeguranca;
            $respPerguntaSeguranca = $rs->respPerguntaSeguranca;
            $dataContratacao = $rs->dataContratacao;
            $dataInicioLoja = $rs->dataInicioLoja;
            $dataInicioFuncao = $rs->dataInicioFuncao;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}else{
    $matricula = null;
    $filialPessoa = null;
    $funcaoPessoa = null;
    $nome = null;
    $cpf = null;
    $email = null;
    $numCelular = null;
    $passwordHash = null;
    $perguntaSeguranca = null;
    $respPerguntaSeguranca = null;
    $dataContratacao = null;
    $dataInicioLoja = null;
    $dataInicioFuncao = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idPessoa != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM pessoa WHERE idPessoa = ?");
        $stmt->bindParam(1, $idPessoa, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo"<script language='javascript' type='text/javascript'>alert('Registro excluido com sucesso!');window.location.href='cad_pessoa.php';</script>";
            $idPessoa = null;
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
                <h3>Cadastro de Usuarios</h3>
            </div>
        </div>
        <form action="?act=save" method="POST" name="form1">
            <div class="row">
                <input type="hidden" name="idPessoa" <?php
                if (isset($idPessoa) && $idPessoa != null || $idPessoa != "") {
                    echo "value=\"{$idPessoa}\"";
                }
                ?> />
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="matricula">Matricula:</label>
                        <input type="text" name="matricula" class="form-control" required <?php
                        if (isset($matricula) && $matricula != null || $matricula != "") { echo "value=\"{$matricula}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" class="form-control" required <?php
                        if (isset($nome) && $nome != null || $nome != "") { echo "value=\"{$nome}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="funcaoPessoa">Função:</label>
                            <?php
                                $sql = "SELECT * from funcao order by nomeFuncao asc";
                                $stm = $conexao->prepare($sql);
                                $stm->execute();
                                $funcoes = $stm->fetchAll(PDO::FETCH_OBJ);
                            ?>
                        <select class="form-control" name="funcaoPessoa" id="funcaoPessoa" required>
                        <?php 
                            if (isset($funcaoPessoa) && $funcaoPessoa != null || $funcaoPessoa != ""){?> <option value="<?=$funcaoPessoa?>"><?=$nomeFuncao?></option> <?php
                            }else{
                            ?><option value="">Função:</option><?php
                            }
                        ?>
                        <?php foreach($funcoes as $funcao):?>
                            <option value=<?=$funcao->idFuncao?>><?=$funcao->nomeFuncao?></option>
                        <?php endforeach;?>
                        </select>
                        <span class='msg-erro msg-status'></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="filialPessoa">Filial:</label>
                            <?php
                                $sql = "SELECT * from filial order by filial asc";
                                $stm = $conexao->prepare($sql);
                                $stm->execute();
                                $filiais = $stm->fetchAll(PDO::FETCH_OBJ);
                            ?>
                        <select class="form-control" name="filialPessoa" id="filialPessoa" required>
                        <?php 
                            if (isset($filialPessoa) && $filialPessoa != null || $filialPessoa != ""){?> <option value="<?=$filialPessoa?>"><?=$filial?></option> <?php
                            }else{
                                ?><option value="">Filial:</option><?php
                            }
                        ?>
                        <?php foreach($filiais as $filial):?>
                            <option value=<?=$filial->idFilial?>><?=$filial->filial?></option>
                        <?php endforeach;?>
                        </select>
                        <span class='msg-erro msg-status'></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" name="cpf" class="form-control" onKeyPress="MascaraCPF(form1.cpf);" maxlength="14" required  <?php
                        if (isset($cpf) && $cpf != null || $cpf != "") { echo "value=\"{$cpf}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="text" name="email" class="form-control" required <?php
                        if (isset($email) && $email != null || $email != "") { echo "value=\"{$email}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="numCelular">Numero Celular:</label>
                        <input type="text" name="numCelular" class="form-control cel-sp-mask" placeholder="Ex.: (00) 00000-0000" maxlength="14" autocomplete="off" required <?php
                        if (isset($numCelular) && $numCelular != null || $numCelular != "") { echo "value=\"{$numCelular}\"";} ?> />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="dataContratacao">Data Contratação</label>
                        <input type="date" name="dataContratacao" class="form-control" required <?php
                        if (isset($dataContratacao) && $dataContratacao != null || $dataContratacao != "") { echo "value=\"{$dataContratacao}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="dataInicioLoja">Data Inicio na Loja</label>
                        <input type="date" name="dataInicioLoja" class="form-control" required <?php
                        if (isset($dataInicioLoja) && $dataInicioLoja != null || $dataInicioLoja != "") { echo "value=\"{$dataInicioLoja}\"";} ?> />
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="dataInicioFuncao">Data Inicio na Função</label>
                        <input type="date" name="dataInicioFuncao" class="form-control" required <?php
                        if (isset($dataInicioFuncao) && $dataInicioFuncao != null || $dataInicioFuncao != "") { echo "value=\"{$dataInicioFuncao}\"";} ?> />
                    </div>
                </div>
            </div>
            <input type="hidden" name="passwordHash" value="NULL">
            <div class="row">
                <div class="col-md-12">
                    <input type="submit" value="Salvar" class="btn btn-primary" />
                    <input type="reset" value="Limpar" class="btn btn-primary" />
                </div>
            </div>
        </form>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table style="width: 1400px" class="table table-bordered">
                        <tr>
                            <th>Matricula</th>
                            <th>Nome</th>
                            <th>Função</th>
                            <th>Filial</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Numero Celular</th>
                            <th>Data Contratação</th>
                            <th>Data Inicio na Loja</th>
                            <th>Data Inicio na Função</th>
                            <th>Ações</th>
                        </tr>
                        <?php 
                        try{
                            $stmt = $conexao->prepare("SELECT * FROM pessoa, funcao, filial WHERE pessoa.filialPessoa = filial.idFilial and pessoa.funcaoPessoa = funcao.idFuncao order by filial");
                            if ($stmt->execute()) {
                                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                    echo "<tr>";
                                    echo "<td>".$rs->matricula
                                    ."</td><td>".$rs->nome
                                    ."</td><td>".$rs->nomeFuncao
                                    ."</td><td>".$rs->filial
                                    ."</td><td>".$rs->cpf
                                    ."</td><td>".$rs->email
                                    ."</td><td>".$rs->numCelular
                                    ."</td><td>".$rs->dataContratacao
                                    ."</td><td>".$rs->dataInicioLoja
                                    ."</td><td>".$rs->dataInicioFuncao
                                    ."</td><td><center><a href=\"?act=upd&idPessoa=".$rs->idPessoa."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                    ."&nbsp;"
                                    ."<a href=\"?act=del&idPessoa=".$rs->idPessoa."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
</div>
<?php }
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
    include_once("menu_regional_car.php");
    include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '6') { 
    include_once("menu_consultorTreinamento.php");
    include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '7') { 
    include_once("menu_consultorTreinamentoRegional.php");
    include_once("naoPermissao.php");
} else{}

include_once("rodape.php");
?>

</div>