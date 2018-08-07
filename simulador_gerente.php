<?php
session_start();

require_once 'conexao.php';

require 'verifica_sessao.php';

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
				<h2>Simulador Score / Gerente Loja</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form action="int_simulador_gerente.php" method="POST">
					<div class="row">
						<div class="col-md-12">
							<h3>Resultados</h3>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResVendaPedido">Venda Mercantil</label>
								<div class="input-group">
									<input type="text" name="ResVendaPedido" class="form-control" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="ResEficiencia">Eficiência de Serviços</label>
								<div class="input-group">
									<input type="text" name="ResEficiencia" class="form-control" placeholder="000.0" required> 
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResCDC">Participação de CDC</label>
								<div class="input-group">
									<input type="text" name="ResCDC" class="form-control" placeholder="000.0" required> 
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResLucroBruto">Lucro Bruto</label>
								<div class="input-group">
									<input type="text" name="ResLucroBruto" class="form-control" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResDespesas">Despesas</label>
								<div class="input-group">
									<input type="text" name="ResDespesas" class="form-control" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h3>Gestão do Negócio</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResAvaliacaoMovve">Avaliação MOVVE</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResAvaliacaoMovve" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h3>Gestão de Gente</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResTunover">Turnover</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResTunover" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResPCD">PCD</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResPCD" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResENPS">E-NPS</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResENPS" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="ResProdutividadeVendedor">Produtividade Vendedor</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResProdutividadeVendedor" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h3>Gestão de Clientes</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResNPS">NPS</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResNPS" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h3>Gestão Operacional (AQO)</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResIQV">IQV</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResIQV" placeholder="0.0" required>
									<span class="input-group-addon">p</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResForaLinha">Fora de Linha</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResForaLinha" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResGiroLento">Giro Lento</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResGiroLento" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResPerdaInventario">Perda de Inventário</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResPerdaInventario" placeholder="000.0" required="">
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input type="submit" value="Simular" class="btn btn-primary" />
							<input type="reset" value="Limpar" class="btn btn-primary" />
						</div>
					</div>
				</form>
			</div>
		</div>
		
	</div>

	<br><br><br>

	<?php
}
else if ($_SESSION['user_funcao'] == '2') { 
	include_once("menu_gerente.php");
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h2>Simulador Score / Gerente Loja</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<form action="int_simulador_gerente.php" method="POST">
					<div class="row">
						<div class="col-md-12">
							<h3>Resultados</h3>
						</div>
					</div>	
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResVendaPedido">Venda Mercantil</label>
								<div class="input-group">
									<input type="text" name="ResVendaPedido" class="form-control" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="ResEficiencia">Eficiência de Serviços</label>
								<div class="input-group">
									<input type="text" name="ResEficiencia" class="form-control" placeholder="000.0" required> 
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResCDC">Participação de CDC</label>
								<div class="input-group">
									<input type="text" name="ResCDC" class="form-control" placeholder="000.0" required> 
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResLucroBruto">Lucro Bruto</label>
								<div class="input-group">
									<input type="text" name="ResLucroBruto" class="form-control" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResDespesas">Despesas</label>
								<div class="input-group">
									<input type="text" name="ResDespesas" class="form-control" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h3>Gestão do Negócio</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResAvaliacaoMovve">Avaliação MOVVE</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResAvaliacaoMovve" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h3>Gestão de Gente</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResTunover">Turnover</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResTunover" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResPCD">PCD</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResPCD" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResENPS">E-NPS</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResENPS" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="ResProdutividadeVendedor">Produtividade Vendedor</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResProdutividadeVendedor" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h3>Gestão de Clientes</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResNPS">NPS</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResNPS" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<h3>Gestão Operacional (AQO)</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResIQV">IQV</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResIQV" placeholder="0.0" required>
									<span class="input-group-addon">p.p</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResForaLinha">Fora de Linha</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResForaLinha" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResGiroLento">Giro Lento</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResGiroLento" placeholder="000.0" required>
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="ResPerdaInventario">Perda de Inventário</label>
								<div class="input-group">
									<input type="text" class="form-control" name="ResPerdaInventario" placeholder="000.0" required="">
									<span class="input-group-addon">%</span>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<input type="submit" value="Simular" class="btn btn-primary" />
							<input type="reset" value="Limpar" class="btn btn-primary" />
						</div>
					</div>
				</form>
			</div>
		</div>
		
	</div>

	<br><br><br>

	<?php
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
	include_once("menu_car.php");
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
