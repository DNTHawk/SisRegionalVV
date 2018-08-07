<hr>
<h3>Planos</h3>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label for="fatoPlanos">Fato</label>
			<textarea class="form-control" name="fatoPlanos" rows="3" required> <?php if (isset($fatoPlanos) && $fatoPlanos != null || $fatoPlanos != "") {echo ($fatoPlanos); }?> </textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="causaPlanos">Causa</label>
			<textarea class="form-control" name="causaPlanos" rows="3" required><?php if (isset($causaPlanos) && $causaPlanos != null || $causaPlanos != "") {echo ($causaPlanos); }?></textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="acaoPlanos">Ação</label>
			<textarea class="form-control" name="acaoPlanos" rows="3" required> <?php if (isset($acaoPlanos) && $acaoPlanos != null || $acaoPlanos != "") {echo ($acaoPlanos); }?></textarea> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label for="respPlanos">Responsável</label>
			<select class="form-control" name="respPlanos" required>
				<option value="<?=$respPlanos?>"><?=$respPlanos?></option>
				<option value="Gerente">Gerente</option>
				<option value="Vendedor Lider">Vendedor Lider</option>
				<option value="CAL">CAL</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="prazoPlanos">Prazo</label>
			<input type="date" class="form-control" name="prazoPlanos" required <?php if (isset($prazoPlanos) && $prazoPlanos != null || $prazoPlanos != "") {echo "value=\"{$prazoPlanos}\""; }?> />
		</div>
	</div>
</div>	