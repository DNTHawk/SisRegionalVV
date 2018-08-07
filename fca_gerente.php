<?php 

$parametroRegLoja = $filial;

?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h3><?php 
			echo ($mesAtual);
			?>/<?php echo ($anoAtual); ?> 
		</h3>
	</div>
</div>
<div style="margin-top: 20px;" class="row">
	<div class="col-md-6">
		<div class="table-responsive">
			<table style="text-align: right;" class="fcaTable">
				<tr>
					<th>Indicador</th>
					<th>Resultado</th>
					<th>FCA</th>
					<th>Meta</th>
					<th>Ralizado</th>
				</tr>
				<?php 
				try{
					$stmt = $conexao->prepare("SELECT * FROM resultados, filial WHERE resultados.resultadoFilial = filial.idFilial AND resultados.mesAno = '$mesAnoAtual' AND filial.filial = '$parametroRegLoja' order by filial.filial");
					if ($stmt->execute()) {
						while ($rs1 = $stmt->fetch(PDO::FETCH_OBJ)) {
							$idResultado = $rs1->idResultado;
							$resultadoFilial = $rs1->resultadoFilial;
							$mes = $rs1->mes;
							$ano = $rs1->ano;
							$metaLb = $rs1->metaLb;
							$realLb = $rs1->realLb;
							$lb = $rs1->lb;
							$metaVendaMercantil = $rs1->metaVendaMercantil;
							$realVendaMercantil = $rs1->realVendaMercantil;
							$mercantil = $rs1->vendaMercantil;
							$metaVendaMoveis = $rs1->metaVendaMoveis;
							$realVendaMoveis = $rs1->realVendaMoveis;
							$moveis = $rs1->vendaMoveis;
							$metaEficiencia = $rs1->metaEficiencia;
							$realEficiencia = $rs1->realEficiencia;
							$eficiencia = $rs1->eficiencia;
							$metaCdc = $rs1->metaCdc;
							$realCdc = $rs1->realCdc;
							$cdc = $rs1->cdc;
							$metaFamilia1 = $rs1->metaFamilia1;
							$realFamilia1 = $rs1->realFamilia1;
							$familia1 = $rs1->familia1;
							$metaFamilia2 = $rs1->metaFamilia2;
							$realFamilia2 = $rs1->realFamilia2;
							$familia2 = $rs1->familia2;
							$metaFamilia3 = $rs1->metaFamilia3;
							$realFamilia3 = $rs1->realFamilia3;
							$familia3 = $rs1->familia3;
							$metaMixServico = $rs1->metaMixServico;
							$realMixServico = $rs1->realMixServico;
							$mixServico = $rs1->mixServico;
							$metaPlanos = $rs1->metaPlanos;
							$realPlanos = $rs1->realPlanos;
							$planos = $rs1->planos;
							$metaCartoes = $rs1->metaCartoes;
							$realCartoes = $rs1->realCartoes;
							$cartoes = $rs1->cartoes;
							$metaDesconto = $rs1->metaDesconto;
							$realDesconto = $rs1->realDesconto;
							$desconto = $rs1->desconto;
							$mesAno = $rs1->mesAno;
						}
					} else {
						echo "Erro: Não foi possível recuperar os dados do banco de dados";
					}
				} catch (PDOException $erro) {
					echo "Erro: ".$erro->getMessage();
				}
				?>
				<tr>
					<th>Venda Mercantil</th>
					<td><?php echo number_format($mercantil, 1, ',', ''); ?>%</td>
					<td><?php 
					if ($mercantil < $valor1) { 
						$fcaMercantil = 1;
						?>
						<div id="link-mercantil" class="fca fca_vermelho"></div> <?php
					}else if (($mercantil > $valor1) && ($mercantil < $valor2)) {
						$fcaMercantil = 0;
						?><div d="link-mercantil" class="fca fca_amarelo"></div> <?php
					}else if (($mercantil > $valor2) && ($mercantil < $valor3)) {
						$fcaMercantil = 0;
						?><div class="fca fca_verde"></div><?php
					}else if ($mercantil > $valor3) {
						$fcaMercantil = 1;
						?><div d="link-mercantil" class="fca fca_azul"></div><?php
					}
					?></td>
					<td>R$ <?php echo number_format($metaVendaMercantil, 0, ',', '.'); ?></td>
					<td>R$ <?php echo number_format($realVendaMercantil, 0, ',', '.');; ?></td>
				</tr>
				<tr>
					<th>Venda Móveis</th>
					<td><?php echo number_format($moveis, 1, ',', ''); ?>%</td>
					<td><?php 
					if ($moveis < $valor1) { 
						$fcaMoveis = 1;
						?>
						<div id="link-moveis" class="fca fca_vermelho"></div> <?php
					}else if (($moveis > $valor1) && ($moveis < $valor2)) {
						$fcaMoveis = 0;
						?><div d="link-moveis" class="fca fca_amarelo"></div> <?php
					}else if (($moveis > $valor2) && ($moveis < $valor3)) {
						$fcaMoveis = 0;
						?><div class="fca fca_verde"></div><?php
					}else if ($moveis > $valor3) {
						$fcaMoveis = 1;
						?><div d="link-moveis" class="fca fca_azul"></div><?php
					}
					?></td>
					<td>R$ <?php echo number_format($metaVendaMoveis, 0, ',', '.'); ?></td>
					<td>R$ <?php echo number_format($realVendaMoveis, 0, ',', '.');; ?></td>
				</tr>
				<tr>
					<th>Desconto</th>
					<td><?php echo number_format($desconto, 1, ',', ''); ?>%</td>
					<td><?php 
					if ($desconto > $valor5) { 
						$fcaDesconto = 1;
						?>
						<div id="link-desconto" class="fca fca_vermelho"></div> <?php
					}else if (($desconto > $valor2) && ($desconto < $valor5)) {
						$fcaDesconto = 0;
						?><div d="link-desconto" class="fca fca_amarelo"></div> <?php
					}else if ($desconto < $valor2) {
						$fcaDesconto = 0;
						?><div d="link-desconto" class="fca fca_verde"></div><?php
					}
					?></td>
					<td><?php echo number_format($metaDesconto, 1, ',', ''); ?>%</td>
					<td><?php echo number_format($realDesconto, 1, ',', ''); ?>%</td>
				</tr>
				<tr>
					<th>Eficiência</th>
					<td><?php echo number_format($eficiencia, 1, ',', ''); ?>%</td>
					<td><?php 
					if ($eficiencia < $valor1) { 
						$fcaEficiencia = 1;
						?>
						<div id="link-eficiencia" class="fca fca_vermelho"></div> <?php
					}else if (($eficiencia > $valor1) && ($eficiencia < $valor2)) {
						$fcaEficiencia = 0;
						?><div d="link-eficiencia" class="fca fca_amarelo"></div> <?php
					}else if (($eficiencia > $valor2) && ($eficiencia < $valor3)) {
						$fcaEficiencia = 0;
						?><div class="fca fca_verde"></div><?php
					}else if ($eficiencia > $valor3) {
						$fcaEficiencia = 1;
						?><div d="link-eficiencia" class="fca fca_azul"></div><?php
					}
					?></td>
					<td><?php echo number_format($metaEficiencia, 1, ',', ''); ?>%</td>
					<td><?php echo number_format($realEficiencia, 1, ',', ''); ?>%</td>
				</tr>
				<tr>
					<th>CDC</th>
					<td><?php echo number_format($cdc, 1, ',', ''); ?>%</td>
					<td><?php 
					if ($cdc < $valor1) { 
						$fcaCdc = 1;
						?>
						<div id="link-cdc" class="fca fca_vermelho"></div> <?php
					}else if (($cdc > $valor1) && ($cdc < $valor2)) {
						$fcaCdc = 0;
						?><div d="link-cdc" class="fca fca_amarelo"></div> <?php
					}else if (($cdc > $valor2) && ($cdc < $valor3)) {
						$fcaCdc = 0;
						?><div class="fca fca_verde"></div><?php
					}else if ($cdc > $valor3) {
						$fcaCdc = 1;
						?><div d="link-cdc" class="fca fca_azul"></div><?php
					}
					?></td>
					<td><?php echo number_format($metaCdc, 1, ',', ''); ?>%</td>
					<td><?php echo number_format($realCdc, 1, ',', ''); ?>%</td>
				</tr>
				<tr>
					<th>Mix Serviços</th>
					<td><?php echo number_format($mixServico, 1, ',', ''); ?>%</td>
					<td><?php 
					if ($mixServico < $valor1) { 
						$fcaMixServico = 1;
						?>
						<div id="link-mixServico" class="fca fca_vermelho"></div> <?php
					}else if (($mixServico > $valor1) && ($mixServico < $valor2)) {
						$fcaMixServico = 0;
						?><div d="link-mixServico" class="fca fca_amarelo"></div> <?php
					}else if (($mixServico > $valor2) && ($mixServico < $valor3)) {
						$fcaMixServico = 0;
						?><div class="fca fca_verde"></div><?php
					}else if ($mixServico > $valor3) {
						$fcaMixServico = 1;
						?><div d="link-mixServico" class="fca fca_azul"></div><?php
					}
					?></td>
					<td>R$ <?php echo number_format($metaMixServico, 0, ',', '.'); ?></td>
					<td>R$ <?php echo number_format($realMixServico, 0, ',', '.'); ?></td>
				</tr>
				<tr>
					<th>Planos Mobile</th>
					<td><?php echo number_format($planos, 1, ',', ''); ?>%</td>
					<td><?php 
					if ($planos < $valor1) { 
						$fcaPlanos = 1;
						?>
						<div id="link-planos" class="fca fca_vermelho"></div> <?php
					}else if (($planos > $valor1) && ($planos < $valor2)) {
						$fcaPlanos = 0;
						?><div d="link-planos" class="fca fca_amarelo"></div> <?php
					}else if (($planos > $valor2) && ($planos < $valor3)) {
						$fcaPlanos = 0;
						?><div class="fca fca_verde"></div><?php
					}else if ($planos > $valor3) {
						$fcaPlanos = 1;
						?><div d="link-planos" class="fca fca_azul"></div><?php
					}
					?></td>
					<td>R$ <?php echo number_format($metaPlanos, 0, ',', '.'); ?></td>
					<td>R$ <?php echo number_format($realPlanos, 0, ',', '.'); ?></td>
				</tr>
				<tr>
					<th>Cartões</th>
					<td><?php echo number_format($cartoes, 1, ',', ''); ?>%</td>
					<td><?php 
					if ($cartoes < $valor1) { 
						$fcaCartoes = 1;
						?>
						<div id="link-cartoes" class="fca fca_vermelho"></div> <?php
					}else if (($cartoes > $valor1) && ($cartoes < $valor2)) {
						$fcaCartoes = 0;
						?><div d="link-cartoes" class="fca fca_amarelo"></div> <?php
					}else if (($cartoes > $valor2) && ($cartoes < $valor3)) {
						$fcaCartoes = 0;
						?><div class="fca fca_verde"></div><?php
					}else if ($cartoes > $valor3) {
						$fcaCartoes = 1;
						?><div d="link-cartoes" class="fca fca_azul"></div><?php
					}
					?></td>
					<td><?php echo number_format($metaCartoes, 0, ',', '.'); ?> Un.</td>
					<td><?php echo number_format($realCartoes, 0, ',', '.'); ?> Un.</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<form action="?act=save" method="POST" name="form1">
	<input type="hidden" name="idFca" <?php if (isset($idFca) && $idFca != null || $idFca != "") {echo "value=\"{$idFca}\""; }?> />
	
	<?php if ($fcaMercantil == '1'): ?>
		<div class="row">
			<div class="col-md-12">
				<?php 
				include_once("fca_mercantil.php");
				$salvar = 1;
				?>
			</div>
		</div>
	<?php endif ?>
	<?php if ($fcaMoveis == '1'): ?>
		<div class="row">
			<div class="col-md-12">
				<?php 
				include_once("fca_moveis.php");
				$salvar = 1;
				?>
			</div>
		</div>
	<?php endif ?>
	<?php if ($fcaDesconto == '1'): ?>
		<div class="row">
			<div class="col-md-12">
				<?php 
				include_once("fca_desconto.php");
				$salvar = 1;
				?>
			</div>
		</div>
	<?php endif ?>
	<?php if ($fcaEficiencia == '1'): ?>
		<div class="row">
			<div class="col-md-12">
				<?php 
				include_once("fca_eficiencia.php");
				$salvar = 1;
				?>
			</div>	
		</div>
	<?php endif ?>
	<?php if ($fcaCdc == '1'): ?>
		<div class="row">
			<div class="col-md-12">
				<?php 
				include_once("fca_cdc.php");
				$salvar = 1;
				?>
			</div>
		</div>
	<?php endif ?>
	<?php if ($fcaMixServico == '1'): ?>
		<div class="row">
			<div class="col-md-12">
				<?php 
				include_once("fca_mixServicos.php");
				$salvar = 1;
				?>
			</div>
		</div>
	<?php endif ?>
	<?php if ($fcaPlanos == '1'): ?>
		<div class="row">
			<div class="col-md-12">
				<?php 
				include_once("fca_planos.php");
				$salvar = 1;
				?>
			</div>
		</div>
	<?php endif ?>
	<?php if ($fcaCartoes == '1'): ?>
		<div class="row">
			<div class="col-md-12">
				<?php 
				include_once("fca_cartoes.php");
				$salvar = 1;
				?>
			</div>
		</div>
	<?php endif ?>
	
	<?php if ($salvar == '1'): ?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<input type="submit" value="Salvar" class="btn btn-primary" />
					<input type="reset" value="Limpar" class="btn btn-primary"/>
				</div>
			</div>
		</div>
	<?php endif ?>
	
</form>
<hr>

</div>