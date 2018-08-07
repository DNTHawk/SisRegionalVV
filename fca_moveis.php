<hr>
<h3>Móveis</h3>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label for="fatoMoveis">Fato</label>
			<textarea class="form-control" name="fatoMoveis" rows="3" required ><?php if (isset($fatoMoveis) && $fatoMoveis != null || $fatoMoveis != "") {echo ($fatoMoveis); }?></textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="causaMoveis">Causa</label>
			<textarea class="form-control" name="causaMoveis" rows="3" required > <?php if (isset($causaMoveis) && $causaMoveis != null || $causaMoveis != "") {echo ($causaMoveis); }?></textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="acaoMoveis">Ação</label>
			<textarea class="form-control" name="acaoMoveis" rows="3" required > <?php if (isset($acaoMoveis) && $acaoMoveis != null || $acaoMoveis != "") {echo ($acaoMoveis); }?></textarea> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label for="respMoveis">Responsável</label>
			<select class="form-control" name="respMoveis" required>
				<option value="<?=$respMoveis?>"><?=$respMoveis?></option>
				<option value="Gerente">Gerente</option>
				<option value="Vendedor Lider">Vendedor Lider</option>
				<option value="CAL">CAL</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="prazoMoveis">Prazo</label>
			<input type="date" class="form-control" name="prazoMoveis" required <?php if (isset($prazoMoveis) && $prazoMoveis != null || $prazoMoveis != "") {echo "value=\"{$prazoMoveis}\""; }?> />
		</div>
	</div>
</div>	