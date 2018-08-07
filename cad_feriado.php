<?php
error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php'; 

$parametro = filter_input(INPUT_POST, "parametro");

$dataHoje = date('d/m/Y');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idFeriado = (isset($_POST["idFeriado"]) && $_POST["idFeriado"] != null) ? $_POST["idFeriado"] : "";
    $nomeFeriado = (isset($_POST["nomeFeriado"]) && $_POST["nomeFeriado"] != null) ? $_POST["nomeFeriado"] : "";
    $cidadeFeriado = (isset($_POST["cidadeFeriado"]) && $_POST["cidadeFeriado"] != null) ? $_POST["cidadeFeriado"] : "";
    $dataFeriado = (isset($_POST["dataFeriado"]) && $_POST["dataFeriado"] != null) ? $_POST["dataFeriado"] : "";
} else if (!isset($idFeriado)) {
    $idFeriado = (isset($_GET["idFeriado"]) && $_GET["idFeriado"] != null) ? $_GET["idFeriado"] : "";
}

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $nomeFeriado != "") {
    try {
        if ($idFeriado != "") {
            $stmt = $conexao->prepare("UPDATE feriados  SET nomeFeriado=?, cidadeFeriado=?, dataFeriado=? WHERE idFeriado = ?");
            $stmt->bindParam(4, $idFeriado);
        } else {
            $stmt = $conexao->prepare("INSERT INTO feriados (nomeFeriado, cidadeFeriado, dataFeriado) VALUES (?, ?, ?)");
        }
        $stmt->bindParam(1, $nomeFeriado);
        $stmt->bindParam(2, $cidadeFeriado);
        $stmt->bindParam(3, $dataFeriado);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
             echo"<script language='javascript' type='text/javascript'>alert('Dados cadastrado com sucesso!');window.location.href='cad_feriado.php';</script>";
             $idFeriado = null;
             $nomeFeriado = null;
             $cidadeFeriado = null;
             $dataFeriado = null;

         } else {
            echo "Erro ao tentar efetivar cadastro";
        }
    } else {
        throw new PDOException("Erro: Não foi possível executar a declaração sql");
    }
} catch (PDOException $erro) {
    echo "Erro: ".$erro->getMessage();
}
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idFeriado != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade AND idFeriado = ?");
        $stmt->bindParam(1, $idFeriado, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idFeriado = $rs->idFeriado;
            $nomeFeriado = $rs->nomeFeriado;
            $cidadeFeriado = $rs->cidadeFeriado;
            $dataFeriado = $rs->dataFeriado;
            $nomeCidade = $rs->nomeCidade;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}else{
    $nomeFeriado = null;
    $cidadeFeriado = null;
    $dataFeriado = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idFeriado != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM feriados WHERE idFeriado = ?");
        $stmt->bindParam(1, $idFeriado, PDO::PARAM_INT);
        if ($stmt->execute()) {
         echo"<script language='javascript' type='text/javascript'>alert('Registro foi excluido com sucesso!');window.location.href='cad_feriado.php';</script>";
         $idFeriado = null;
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
                    <h3>Cadastro de Feriados</h3>
                </div>
            </div>
            <form action="?act=save" method="POST" name="form1">
                <input type="hidden" name="idFeriado" <?php
                if (isset($idFeriado) && $idFeriado != null || $idFeriado != "") {
                    echo "value=\"{$idFeriado}\"";
                }
                ?> />
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cidadeFeriado">Cidade:</label>
                            <?php
                            $sql = "SELECT * from cidade order by idCidade asc";
                            $stm = $conexao->prepare($sql);
                            $stm->execute();
                            $cidades = $stm->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="cidadeFeriado" id="cidadeFeriado" required>
                                <?php 
                                if (isset($cidade) && $cidade != null || $cidade != ""){?> <option value="<?=$nomeCidade?>"><?=$nomeCidade?></option> <?php
                            }else{
                                ?><option value="">Cidade</option><?php
                            }
                            ?>
                            <?php foreach($cidades as $cidade):?>
                                <option value=<?=$cidade->idCidade?>><?=$cidade->nomeCidade?></option>
                            <?php endforeach;?>
                        </select>
                        <span class='msg-erro msg-status'></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="dataFeriado">Data Feriado:</label>
                        <input type="date" name="dataFeriado" class="form-control" required <?php
                        if (isset($dataFeriado) && $dataFeriado != null || $dataFeriado != "") { echo "value=\"{$dataFeriado}\"";} ?> /> 
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nomeFeriado">Feriado:</label>
                        <input type="text" name="nomeFeriado" class="form-control" placeholder="Feriado" required <?php
                        if (isset($nomeFeriado) && $nomeFeriado != null || $nomeFeriado != "") { echo "value=\"{$nomeFeriado}\"";} ?> />
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
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="parametro">Cidade:</label>
                        <?php
                        $sql = "SELECT * FROM cidade order by idCidade asc";
                        $stm = $conexao->prepare($sql);
                        $stm->execute();
                        $feriados = $stm->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <select class="form-control" name="parametro" id="parametro" required>
                            <option>Todos</option>
                            <?php foreach($feriados as $feriado):?>
                                <option value=<?=$feriado->nomeCidade?>><?=$feriado->nomeCidade?></option>
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
                    <table class="table table-bordered">
                        <tr>
                            <th>Cidade</th>
                            <th>Feriado</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                        <?php
                        if($parametro){
                            try {
                                $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade AND nomeCidade like '$parametro%' order by dataFeriado");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $array_data_feriado = explode('-', $rs->dataFeriado);
                                        $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                        echo "<tr>";
                                        echo "<td>".$rs->nomeCidade
                                        ."</td><td>".$rs->nomeFeriado
                                        ."</td><td>".$data_formatada_feriado
                                        ."</td><td><center><a href=\"?act=upd&idFeriado=".$rs->idFeriado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFeriado=".$rs->idFeriado."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                }
                            }catch (PDOException $erro) {
                                echo "Erro: ".$erro->getMessage();
                            }  
                        }else {
                            try {
                                $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade order by dataFeriado");
                                if ($stmt->execute()) {
                                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                        $array_data_feriado = explode('-', $rs->dataFeriado);
                                        $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                        echo "<tr>";
                                        echo "<td>".$rs->nomeCidade
                                        ."</td><td>".$rs->nomeFeriado
                                        ."</td><td>".$data_formatada_feriado
                                        ."</td><td><center><a href=\"?act=upd&idFeriado=".$rs->idFeriado."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                        ."&nbsp;"
                                        ."<a href=\"?act=del&idFeriado=".$rs->idFeriado."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
                                        echo "</tr>";
                                    }
                                } else {
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
    <br>
    <br>
    <?php }
    else if ($_SESSION['user_funcao'] == '2' ) { 
        include_once("menu_gerente.php");
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Feriados</h3>
                </div>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="parametro">Cidade:</label>
                            <?php
                            $sql = "SELECT * FROM cidade order by idCidade asc";
                            $stm = $conexao->prepare($sql);
                            $stm->execute();
                            $feriados = $stm->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="parametro" id="parametro" required>
                                <option>Todos</option>
                                <?php foreach($feriados as $feriado):?>
                                    <option value=<?=$feriado->nomeCidade?>><?=$feriado->nomeCidade?></option>
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
                        <table class="table table-bordered">
                            <tr>
                                <th>Cidade</th>
                                <th>Feriado</th>
                                <th>Data</th>
                            </tr>
                            <?php
                            if($parametro){
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade AND nomeCidade like '$parametro%' order by dataFeriado");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            $array_data_feriado = explode('-', $rs->dataFeriado);
                                            $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                            echo "<tr>";
                                            echo "<td>".$rs->nomeCidade
                                            ."</td><td>".$rs->nomeFeriado
                                            ."</td><td>".$data_formatada_feriado;
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                }catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }  
                            }else {
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade order by dataFeriado");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            $array_data_feriado = explode('-', $rs->dataFeriado);
                                            $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                            echo "<tr>";
                                            echo "<td>".$rs->nomeCidade
                                            ."</td><td>".$rs->nomeFeriado
                                            ."</td><td>".$data_formatada_feriado;
                                            echo "</tr>";
                                        }
                                    } else {
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
        <?php
    }
    else if ($_SESSION['user_funcao'] == '3') { 
        include_once("menu_cal.php");
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Feriados</h3>
                </div>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="parametro">Cidade:</label>
                            <?php
                            $sql = "SELECT * FROM cidade order by idCidade asc";
                            $stm = $conexao->prepare($sql);
                            $stm->execute();
                            $feriados = $stm->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="parametro" id="parametro" required>
                                <option>Todos</option>
                                <?php foreach($feriados as $feriado):?>
                                    <option value=<?=$feriado->nomeCidade?>><?=$feriado->nomeCidade?></option>
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
                        <table class="table table-bordered">
                            <tr>
                                <th>Cidade</th>
                                <th>Feriado</th>
                                <th>Data</th>
                            </tr>
                            <?php
                            if($parametro){
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade AND nomeCidade like '$parametro%' order by dataFeriado");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            $array_data_feriado = explode('-', $rs->dataFeriado);
                                            $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                            echo "<tr>";
                                            echo "<td>".$rs->nomeCidade
                                            ."</td><td>".$rs->nomeFeriado
                                            ."</td><td>".$data_formatada_feriado;
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                }catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }  
                            }else {
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade order by dataFeriado");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            $array_data_feriado = explode('-', $rs->dataFeriado);
                                            $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                            echo "<tr>";
                                            echo "<td>".$rs->nomeCidade
                                            ."</td><td>".$rs->nomeFeriado
                                            ."</td><td>".$data_formatada_feriado;
                                            echo "</tr>";
                                        }
                                    } else {
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
        <?php
    }
    else if ($_SESSION['user_funcao'] == '4') { 
        include_once("menu_regional.php");
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Feriados</h3>
                </div>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="parametro">Cidade:</label>
                            <?php
                            $sql = "SELECT * FROM cidade order by idCidade asc";
                            $stm = $conexao->prepare($sql);
                            $stm->execute();
                            $feriados = $stm->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="parametro" id="parametro" required>
                                <option>Todos</option>
                                <?php foreach($feriados as $feriado):?>
                                    <option value=<?=$feriado->nomeCidade?>><?=$feriado->nomeCidade?></option>
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
                        <table class="table table-bordered">
                            <tr>
                                <th>Cidade</th>
                                <th>Feriado</th>
                                <th>Data</th>
                            </tr>
                            <?php
                            if($parametro){
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade AND nomeCidade like '$parametro%' order by dataFeriado");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            $array_data_feriado = explode('-', $rs->dataFeriado);
                                            $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                            echo "<tr>";
                                            echo "<td>".$rs->nomeCidade
                                            ."</td><td>".$rs->nomeFeriado
                                            ."</td><td>".$data_formatada_feriado;
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                }catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }  
                            }else {
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade order by dataFeriado");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            $array_data_feriado = explode('-', $rs->dataFeriado);
                                            $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                            echo "<tr>";
                                            echo "<td>".$rs->nomeCidade
                                            ."</td><td>".$rs->nomeFeriado
                                            ."</td><td>".$data_formatada_feriado;
                                            echo "</tr>";
                                        }
                                    } else {
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
        <?php
    }
    else if ($_SESSION['user_funcao'] == '5') { 
        include_once("menu_car.php");
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Feriados</h3>
                </div>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="parametro">Cidade:</label>
                            <?php
                            $sql = "SELECT * FROM cidade order by idCidade asc";
                            $stm = $conexao->prepare($sql);
                            $stm->execute();
                            $feriados = $stm->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="parametro" id="parametro" required>
                                <option>Todos</option>
                                <?php foreach($feriados as $feriado):?>
                                    <option value=<?=$feriado->nomeCidade?>><?=$feriado->nomeCidade?></option>
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
                        <table class="table table-bordered">
                            <tr>
                                <th>Cidade</th>
                                <th>Feriado</th>
                                <th>Data</th>
                            </tr>
                            <?php
                            if($parametro){
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade AND nomeCidade like '$parametro%' order by dataFeriado");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            $array_data_feriado = explode('-', $rs->dataFeriado);
                                            $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                            echo "<tr>";
                                            echo "<td>".$rs->nomeCidade
                                            ."</td><td>".$rs->nomeFeriado
                                            ."</td><td>".$data_formatada_feriado;
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                }catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }  
                            }else {
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade order by dataFeriado");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            $array_data_feriado = explode('-', $rs->dataFeriado);
                                            $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                            echo "<tr>";
                                            echo "<td>".$rs->nomeCidade
                                            ."</td><td>".$rs->nomeFeriado
                                            ."</td><td>".$data_formatada_feriado;
                                            echo "</tr>";
                                        }
                                    } else {
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
        <?php
    }
    else if ($_SESSION['user_funcao'] == '6') { 
        include_once("menu_consultorTreinamento.php");
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Feriados</h3>
                </div>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="parametro">Cidade:</label>
                            <?php
                            $sql = "SELECT * FROM cidade order by idCidade asc";
                            $stm = $conexao->prepare($sql);
                            $stm->execute();
                            $feriados = $stm->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="parametro" id="parametro" required>
                                <option>Todos</option>
                                <?php foreach($feriados as $feriado):?>
                                    <option value=<?=$feriado->nomeCidade?>><?=$feriado->nomeCidade?></option>
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
                        <table class="table table-bordered">
                            <tr>
                                <th>Cidade</th>
                                <th>Feriado</th>
                                <th>Data</th>
                            </tr>
                            <?php
                            if($parametro){
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade AND nomeCidade like '$parametro%' order by dataFeriado");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            $array_data_feriado = explode('-', $rs->dataFeriado);
                                            $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                            echo "<tr>";
                                            echo "<td>".$rs->nomeCidade
                                            ."</td><td>".$rs->nomeFeriado
                                            ."</td><td>".$data_formatada_feriado;
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                }catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }  
                            }else {
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade order by dataFeriado");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            $array_data_feriado = explode('-', $rs->dataFeriado);
                                            $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                            echo "<tr>";
                                            echo "<td>".$rs->nomeCidade
                                            ."</td><td>".$rs->nomeFeriado
                                            ."</td><td>".$data_formatada_feriado;
                                            echo "</tr>";
                                        }
                                    } else {
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
        <?php
    }
    else if ($_SESSION['user_funcao'] == '7') { 
        include_once("menu_consultorTreinamentoRegional.php");
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Feriados</h3>
                </div>
            </div>
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="parametro">Cidade:</label>
                            <?php
                            $sql = "SELECT * FROM cidade order by idCidade asc";
                            $stm = $conexao->prepare($sql);
                            $stm->execute();
                            $feriados = $stm->fetchAll(PDO::FETCH_OBJ);
                            ?>
                            <select class="form-control" name="parametro" id="parametro" required>
                                <option>Todos</option>
                                <?php foreach($feriados as $feriado):?>
                                    <option value=<?=$feriado->nomeCidade?>><?=$feriado->nomeCidade?></option>
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
                        <table class="table table-bordered">
                            <tr>
                                <th>Cidade</th>
                                <th>Feriado</th>
                                <th>Data</th>
                            </tr>
                            <?php
                            if($parametro){
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade AND nomeCidade like '$parametro%' order by dataFeriado");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            $array_data_feriado = explode('-', $rs->dataFeriado);
                                            $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                            echo "<tr>";
                                            echo "<td>".$rs->nomeCidade
                                            ."</td><td>".$rs->nomeFeriado
                                            ."</td><td>".$data_formatada_feriado;
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                                    }
                                }catch (PDOException $erro) {
                                    echo "Erro: ".$erro->getMessage();
                                }  
                            }else {
                                try {
                                    $stmt = $conexao->prepare("SELECT * FROM feriados, cidade WHERE feriados.cidadeFeriado = cidade.idCidade order by dataFeriado");
                                    if ($stmt->execute()) {
                                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                            $array_data_feriado = explode('-', $rs->dataFeriado);
                                            $data_formatada_feriado = $array_data_feriado[2] . '/' . $array_data_feriado[1] . '/' . $array_data_feriado[0];
                                            echo "<tr>";
                                            echo "<td>".$rs->nomeCidade
                                            ."</td><td>".$rs->nomeFeriado
                                            ."</td><td>".$data_formatada_feriado;
                                            echo "</tr>";
                                        }
                                    } else {
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
        <?php
    } else{}

    include_once("rodape.php");
    ?>
</div>

