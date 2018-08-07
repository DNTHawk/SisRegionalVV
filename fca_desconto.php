<hr>
<h3>Desconto</h3>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label for="fatoDesconto">Fato</label>
			<textarea class="form-control" name="fatoDesconto" rows="3" required ><?php if (isset($fatoDesconto) && $fatoDesconto != null || $fatoDesconto != "") {echo ($fatoDesconto); }?></textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="causaDesconto">Causa</label>
			<textarea class="form-control" name="causaDesconto" rows="3" required> <?php if (isset($causaDesconto) && $causaDesconto != null || $causaDesconto != "") {echo ($causaDesconto); }?> </textarea> 
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="acaoDesconto">Ação</label>
			<textarea class="form-control" name="acaoDesconto" rows="3" required ><?php if (isset($acaoDesconto) && $acaoDesconto != null || $acaoDesconto != "") {echo ($acaoDesconto); }?></textarea> 
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-3">
		<div class="form-group">
			<label for="respDesconto">Responsável</label>
			<select class="form-control" name="respDesconto" required>
				<option value="<?=$respDesconto?>"><?=$respDesconto?></option>
				<option value="Gerente">Gerente</option>
				<option value="Vendedor Lider">Vendedor Lider</option>
				<option value="CAL">CAL</option>
			</select>
		</div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="prazoDesconto">Prazo</label>
			<input type="date" class="form-control" name="prazoDesconto" required <?php if (isset($prazoDesconto) && $prazoDesconto != null || $prazoDesconto != "") {echo "value=\"{$prazoDesconto}\""; }?> />
		</div>
	</div>
</div>	