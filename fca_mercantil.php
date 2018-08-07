<hr>
<h3>Mercantil</h3>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label for="fatoMercantil">Fato</label>
			<textarea class="form-control" name="fatoMercantil" rows="3" required ><?php if (isset($fatoMercantil) && $fatoMercantil != null || $fatoMercantil != "") {echo ($fatoMercantil); }?></textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="causaMercantil">Causa</label>
			<textarea class="form-control" name="causaMercantil" rows="3" required ><?php if (isset($causaMercantil) && $causaMercantil != null || $causaMercantil != "") {echo ($causaMercantil); }?></textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="acaoMercantil">Ação</label>
			<textarea class="form-control" name="acaoMercantil" rows="3" required ><?php if (isset($acaoMercantil) && $acaoMercantil != null || $acaoMercantil != "") {echo ($acaoMercantil); }?> </textarea> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label for="respMercantil">Responsável</label>
			<select class="form-control" name="respMercantil" required>
				<option value="<?=$respMercantil?>"><?=$respMercantil?></option>
				<option value="Gerente">Gerente</option>
				<option value="Vendedor Lider">Vendedor Lider</option>
				<option value="CAL">CAL</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="prazoMercantil">Prazo</label>
			<input type="date" class="form-control" name="prazoMercantil" required <?php if (isset($prazoMercantil) && $prazoMercantil != null || $prazoMercantil != "") {echo "value=\"{$prazoMercantil}\""; }?> />
		</div>
	</div>
</div>	