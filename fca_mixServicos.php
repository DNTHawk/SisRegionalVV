<hr>
<h3>Mix Servicos</h3>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label for="fatoMixServico">Fato</label>
			<textarea class="form-control" name="fatoMixServico" rows="3" required ><?php if (isset($fatoMixServico) && $fatoMixServico != null || $fatoMixServico != "") {echo ($fatoMixServico); }?></textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="causaMixServico">Causa</label>
			<textarea class="form-control" name="causaMixServico" rows="3" required> <?php if (isset($causaMixServico) && $causaMixServico != null || $causaMixServico != "") {echo ($causaMixServico); }?></textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="acaoMixServico">Ação</label>
			<textarea class="form-control" name="acaoMixServico" rows="3" required><?php if (isset($acaoMixServico) && $acaoMixServico != null || $acaoMixServico != "") {echo ($acaoMixServico); }?> </textarea> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label for="respMixServico">Responsável</label>
			<select class="form-control" name="respMixServico" required>
				<option value="<?=$respMixServico?>"><?=$respMixServico?></option>
				<option value="Gerente">Gerente</option>
				<option value="Vendedor Lider">Vendedor Lider</option>
				<option value="CAL">CAL</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="prazoMixServico">Prazo</label>
			<input type="date" class="form-control" name="prazoMixServico" required <?php if (isset($prazoMixServico) && $prazoMixServico != null || $prazoMixServico != "") {echo "value=\"{$prazoMixServico}\""; }?> />
		</div>
	</div>
</div>	