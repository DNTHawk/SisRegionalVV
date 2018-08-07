<hr>
<h3>Eficiência</h3>
	<div class="row">
		<div class="col-md-4">
			<div class="form-group">
				<label for="fatoEficiencia">Fato</label>
				<textarea class="form-control" name="fatoEficiencia" rows="3" required><?php if (isset($acaoDesconto) && $acaoDesconto != null || $acaoDesconto != "") {echo ($acaoDesconto); }?></textarea> 
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="causaEficiencia">Causa</label>
				<textarea class="form-control" name="causaEficiencia" rows="3" required> <?php if (isset($causaEficiencia) && $causaEficiencia != null || $causaEficiencia != "") {echo ($causaEficiencia); }?> </textarea> 
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label for="acaoEficiencia">Ação</label>
				<textarea class="form-control" name="acaoEficiencia" rows="3" required><?php if (isset($acaoEficiencia) && $acaoEficiencia != null || $acaoEficiencia != "") {echo ($acaoEficiencia); }?></textarea> 
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
			<div class="form-group">
				<label for="respEficiencia">Responsável</label>
				<select class="form-control" name="respEficiencia" required>
					<option value="<?=$respEficiencia?>"><?=$respEficiencia?></option>
					<option value="Gerente">Gerente</option>
					<option value="Vendedor Lider">Vendedor Lider</option>
					<option value="CAL">CAL</option>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="prazoEficiencia">Prazo</label>
				<input type="date" class="form-control" name="prazoEficiencia" required <?php if (isset($prazoEficiencia) && $prazoEficiencia != null || $prazoEficiencia != "") {echo "value=\"{$prazoEficiencia}\""; }?> />
			</div>
		</div>
	</div>	