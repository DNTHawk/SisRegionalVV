
<?php
error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php'; 

$parametro = filter_input(INPUT_POST, "parametro");

$data = date('Y/m/d');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idFeedback = (isset($_POST["idFeedback"]) && $_POST["idFeedback"] != null) ? $_POST["idFeedback"] : "";
    $dataFeedback = $data;
    $quemFeedback = (isset($_POST["quemFeedback"]) && $_POST["quemFeedback"] != null) ? $_POST["quemFeedback"] : "";
    $feedback = (isset($_POST["feedback"]) && $_POST["feedback"] != null) ? $_POST["feedback"] : "";
    
} else if (!isset($idFeedback)) {
    $idFeedback = (isset($_GET["idFeedback"]) && $_GET["idFeedback"] != null) ? $_GET["idFeedback"] : "";
}

try {
    $conexao = db_connect();
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conexao->exec("set names utf8");
} catch (PDOException $erro) {
    echo "Erro na conexão:".$erro->getMessage();
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "save" && $dataFeedback != "") {
    try {
        if ($idFeedback != "") {
            $stmt = $conexao->prepare("UPDATE feedback  SET dataFeedback=?, quemFeedback=?, feedback=? WHERE idFeedback = ?");
            $stmt->bindParam(4, $idFeedback);
        } else {
            $stmt = $conexao->prepare("INSERT INTO feedback (dataFeedback, quemFeedback, feedback) VALUES (?, ?, ?)");
        }
        $stmt->bindParam(1, $dataFeedback);
        $stmt->bindParam(2, $quemFeedback);
        $stmt->bindParam(3, $feedback);
        

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo"<script language='javascript' type='text/javascript'>alert('Feedback cadastrado com sucesso!');window.location.href='feedback.php';</script>";
                $idFeedback = null;
                $dataFeedback = null;
                $quemFeedback = null;
                $feedback = null;
            } else {
                echo"<script language='javascript' type='text/javascript'>alert('Erro ao lançar Feedback!');window.location.href='feedback.php';</script>";
            }
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "upd" && $idFeedback != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM feedback WHERE idFeedback = ?");
        $stmt->bindParam(1, $idFeedback, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $idFeedback = $rs->idFeedback;
            $dataFeedback = $rs->dataFeedback;
            $quemFeedback = $rs->quemFeedback;
            $feedback = $rs->feedback;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: ".$erro->getMessage();
    }
}else{
    $dataFeedback = null;
    $quemFeedback = null;
    $feedback = null;
}

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "del" && $idFeedback != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM feedback WHERE idFeedback = ?");
        $stmt->bindParam(1, $idFeedback, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo"<script language='javascript' type='text/javascript'>alert('Feedback excluido com sucesso!');window.location.href='feedback.php';</script>";
            $idFeedback = null;
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
    include_once("naoPermissao.php");
}
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
    ?> 
    <div class="container">
    	<div class="row">
    		<div class="col-md-12">
    			<h3>FeedBack</h3>
    		</div>
    	</div>
    	<form action="?act=save" method="POST" name="form1">
    		<input type="hidden" name="idFeedback" <?php if (isset($idFeedback) && $idFeedback != null || $idFeedback != "") { echo "value=\"{$idFeedback}\""; }?> />
    		<div class="row">
    			<div class="col-md-3">
                    <div class="form-group">
                        <label for="quemFeedback">Quem:</label>
                            <?php
                                $sql = "SELECT * from pessoa WHERE funcaoPessoa = '2' order by matricula asc";
                                $stm = $conexao->prepare($sql);
                                $stm->execute();
                                $pessoas = $stm->fetchAll(PDO::FETCH_OBJ);
                            ?>
                        <select class="form-control" name="quemFeedback" id="quemFeedback" required>
                        	<?php 
                        		if (isset($feedback) && $feedback != null || $feedback != ""){?> <option value="<?=$quemFeedback?>"><?=$quemFeedback?></option> <?php
                        		}else{
                        			?><option value="">Recebeu Feedback</option><?php
                        		}
                        	?>
                            <option value="Geral">Geral</option>
                            <?php foreach($pessoas as $pessoa):?>
                                <option value=<?=$pessoa->nome?>><?=$pessoa->nome?></option>
                            <?php endforeach;?>
                        </select>
                        <span class='msg-erro msg-status'></span>
                    </div>
                </div>
    		</div>
    		<div class="row">
    			<div class="col-md-6">
    				<div class="form-group">
    					<label for="feedback">Feedback:</label>
						<textarea class="form-control" name="feedback" rows="3" required><?php if (isset($feedback) && $feedback != null || $feedback != "") {echo ($feedback); }?> </textarea> 
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
    	<h4>Feedback's</h4>
    	<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" >
    		<div class="row">
    			<div class="col-md-3">
                    <div class="form-group">
                        <label for="parametro">Quem:</label>
                            <?php
                                $sql = "SELECT DISTINCT quemFeedback from feedback order by quemFeedback asc";
                                $stm = $conexao->prepare($sql);
                                $stm->execute();
                                $pessoas = $stm->fetchAll(PDO::FETCH_OBJ);
                            ?>
                        <select class="form-control" name="parametro" id="parametro" required>
                        	<option>Todos</option>
                            <?php foreach($pessoas as $pessoa):?>
                                <option value=<?=$pessoa->quemFeedback?>><?=$pessoa->quemFeedback?></option>
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
    				<table style="width: 100%">
    					<tr>
    						<th style="width: 20%">Recebeu Feedback</th>
    						<th style="width: 15%">Data</th>
    						<th style="width: 55%">Feedback</th>
    						<th style="width: 10%">Ação</th>
    					</tr>
    					<?php
    						if ($parametro) {
    							try{
                            		$stmt = $conexao->prepare("SELECT * FROM feedback WHERE quemFeedback like '$parametro' order by dataFeedback");
                            		if ($stmt->execute()) {
                                		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                			$array_data = explode('-', $rs->dataFeedback);
											$data_formatada_feedback = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
                                    		echo "<tr>";
                                        		echo "<td>".$rs->quemFeedback
                                           			."</td><td>".$data_formatada_feedback
                                            		."</td><td>".$rs->feedback
                                            		."</td><td><center><a href=\"?act=upd&idFeedback=".$rs->idFeedback."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                    				."&nbsp;"
                                    				."<a href=\"?act=del&idFeedback=".$rs->idFeedback."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
                            		$stmt = $conexao->prepare("SELECT * FROM feedback order by feedback.dataFeedback");
                            		if ($stmt->execute()) {
                                		while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                			$array_data = explode('-', $rs->dataFeedback);
											$data_formatada_feedback = $array_data[2] . '/' . $array_data[1] . '/' . $array_data[0];
                                    		echo "<tr>";
                                        		echo "<td>".$rs->quemFeedback
                                           			."</td><td>".$data_formatada_feedback
                                            		."</td><td>".$rs->feedback
                                            		."</td><td><center><a href=\"?act=upd&idFeedback=".$rs->idFeedback."\" class='btn btn-warning btn-sm'><span class='glyphicon glyphicon-pencil'></span></a>"
                                    				."&nbsp;"
                                    				."<a href=\"?act=del&idFeedback=".$rs->idFeedback."\" class='btn btn-warning btn-sm' ><span class='glyphicon glyphicon-remove'></a></center></td>";
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
    <br><br><br><br>

    <?php
}
else if ($_SESSION['user_funcao'] == '5') { 
    include_once("menu_regional.php");
    include_once("naoPermissao.php");
} 
else if ($_SESSION['user_funcao'] == '6') { 
    include_once("menu_consultorTreinamento.php");
    include_once("naoPermissao.php");
}
else if ($_SESSION['user_funcao'] == '7') { 
    include_once("menu_consultorTreinamentoRegional.php");
    include_once("naoPermissao.php");
}
else{}

include_once("rodape.php");
?>
</div>