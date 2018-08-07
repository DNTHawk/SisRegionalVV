<hr>
<h3>Cartões</h3>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label for="fatoCartoes">Fato</label>
			<textarea class="form-control" name="fatoCartoes" rows="3" required><?php if (isset($fatoCartoes) && $fatoCartoes != null || $fatoCartoes != "") {echo ($fatoCartoes); }?></textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="causaCartoes">Causa</label>
			<textarea class="form-control" name="causaCartoes" rows="3" required><?php if (isset($causaCartoes) && $causaCartoes != null || $causaCartoes != "") {echo ($causaCartoes); }?></textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="acaoCartoes">Ação</label>
			<textarea class="form-control" name="acaoCartoes" rows="3" required><?php if (isset($acaoCartoes) && $acaoCartoes != null || $acaoCartoes != "") {echo ($acaoCartoes); }?> </textarea> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label for="respCartoes">Responsável</label>
			<select class="form-control" name="respCartoes" required>
				<option value="<?=$respCartoes?>"><?=$respCartoes?></option>
				<option value="Gerente">Gerente</option>
				<option value="Vendedor Lider">Vendedor Lider</option>
				<option value="CAL">CAL</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="prazoCartoes">Prazo</label>
			<input type="date" class="form-control" name="prazoCartoes" required <?php if (isset($prazoCartoes) && $prazoCartoes != null || $prazoCartoes != "") {echo "value=\"{$prazoCartoes}\""; }?> />
		</div>
	</div>
</div>	