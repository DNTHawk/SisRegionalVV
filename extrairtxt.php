<?php

error_reporting(0);

session_start();

require 'conexao.php';

require 'verifica_sessao.php'; 

try {
	$conexao = db_connect();
	$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conexao->exec("set names utf8");
} catch (PDOException $erro) {
	echo "Erro na conexão:".$erro->getMessage();
}

/*$data1 = new DateTime( '2013-12-11' );
$data2 = new DateTime( '1994-04-17' );

$intervalo = $data1->diff( $data2 );

echo "Intervalo é de {$intervalo->y} anos, {$intervalo->m} meses e {$intervalo->d} dias";*/

?>
<div class="carregando" id="carregando"></div>
<div class="corpo" id="corpo">
	<?php

	if ($_SESSION['user_funcao'] == '1'){
		include_once("menu_administrador.php");
		?>
		<div class="container">
			<ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#home">Home</a></li>
				<li><a data-toggle="tab" href="#desligamento">Desligamento</a></li>
				<li><a data-toggle="tab" href="#tranferencia">Transferencia</a></li>
				<li><a data-toggle="tab" href="#promocao">Promoção</a></li>
				<li><a data-toggle="tab" href="#merito">Mérito</a></li>
			</ul>

			<div class="tab-content">
				<div id="home" class="tab-pane fade in active">

				</div>
				<div id="desligamento" class="tab-pane fade">
					
				</div>
				<div id="tranferencia" class="tab-pane fade">
					<form method="POST" action="text.php">
						<div class="row" style="margin-top: 20px;">
							<div class="col-md-4">
								<div class="form-group">
									<label for="nomeArquivo"> Nome do Arquivo </label>
									<input type="text" name="nomeArquivo" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="nomeColaborador">Nome do Colaborador</label>
									<?php
									$sql = "SELECT * from pessoa WHERE funcaoPessoa = '2' order by matricula asc";
									$stm = $conexao->prepare($sql);
									$stm->execute();
									$pessoas = $stm->fetchAll(PDO::FETCH_OBJ);
									?>
									<select class="form-control" name="nomeColaborador" id="nomeColaborador" required>
										<option value="">Nome Colaborador</option>
										<?php foreach($pessoas as $pessoa):?>
											<option value=<?=$pessoa->idPessoa?>><?=$pessoa->nome?></option>
										<?php endforeach;?>
									</select>
									<span class='msg-erro msg-status'></span>
								</div>
							</div>
						</div>
						<input type="hidden" name="tipoMovimentacao" value="Transferencia" />
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="tempoCasa"> Tempo de Casa </label>
									<input type="text" name="tempoCasa" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="tempoLoja"> Tempo de Loja </label>
									<input type="text" name="tempoLoja" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="tempoFuncao"> Tempo na Função </label>
									<input type="text" name="tempoFuncao" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="filialDestino"> Filial de Destino </label>
									<input type="text" name="filialDestino" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="politicaTransferencia"> Política de Transferência </label>
									<input type="text" name="politicaTransferencia" class="form-control" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<label for="orcamentoTransferencia"> Orçamento de Transferência </label>
									<input type="text" name="orcamentoTransferencia" class="form-control" required placeholder="Foi aprovado pela Diretoria?">
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
					<br><br><br>
				</div>
				<div id="promocao" class="tab-pane fade">
					
				</div>
				<div id="merito" class="tab-pane fade">
					
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