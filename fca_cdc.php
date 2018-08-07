<hr>
<h3>CDC</h3>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label for="fatoCdc">Fato</label>
			<textarea class="form-control" name="fatoCdc" rows="3" required> <?php if (isset($fatoCdc) && $fatoCdc != null || $fatoCdc != "") {echo ($fatoCdc); }?></textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="causaCdc">Causa</label>
			<textarea class="form-control" name="causaCdc" rows="3" required><?php if (isset($causaCdc) && $causaCdc != null || $causaCdc != "") {echo ($causaCdc); }?></textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="acaoCdc">Ação</label>
			<textarea class="form-control" name="acaoCdc" rows="3" required ><?php if (isset($acaoCdc) && $acaoCdc != null || $acaoCdc != "") {echo ($acaoCdc); }?></textarea> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label for="respCdc">Responsável</label>
			<select class="form-control" name="respCdc" required>
				<option value="<?=$respCdc?>"><?=$respCdc?></option>
				<option value="Gerente">Gerente</option>
				<option value="Vendedor Lider">Vendedor Lider</option>
				<option value="CAL">CAL</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="prazoCdc">Prazo</label>
			<input type="date" class="form-control" name="prazoCdc" required <?php if (isset($prazoCdc) && $prazoCdc != null || $prazoCdc != "") {echo "value=\"{$prazoCdc}\""; }?> />
		</div>
	</div>
</div>	