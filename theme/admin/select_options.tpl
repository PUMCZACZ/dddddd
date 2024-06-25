<div class="card-header">
	<ul class="nav nav-pills card-header-pills">
		<li class="nav-item">
			<a class="nav-link<!-- IF OP == 'select-options' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=select-options">Opcje wyboru</a>
		</li>
		<li class="nav-item">
			<a class="nav-link<!-- IF OP == 'tax-values' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=tax-values">Stawki podatkowe</a>
		</li>
	</ul>
</div>
<div class="card-body">
	<!-- IF OP == 'select-options' -->
	<h3>Opcje wyboru</h3>
	<!-- ELSEIF OP == 'tax-values' -->
	<h3>Stawki podatkowe</h3>
	<!-- ENDIF -->

	<!-- IF OP == 'select-options' -->
	<form method="post" >
		<table class="table table-striped">
			<tr>
				<th>
					<select name="name_filter" class="form-control" onchange="this.form.submit()">
						<option value="">Nazwa robocza</option>
						<!-- BEGIN nt -->
						<option value="{nt.NAME_TECH}"<!-- IF NAME_FILTER == nt.NAME_TECH --> selected<!-- ENDIF -->>{nt.NAME}</option>
						<!-- END nt -->
					</select>
				</th>
				<th>Wartość</th>
				<th class="text-center">Domyślna</th>
				<th>Usuń</th>
			</tr>
			<!-- BEGIN ow -->
			<tr>
				<td>
					<select name="edit_opt_name_tech[{ow.I}]" class="form-control" required>
						<!-- BEGIN nt -->
						<option value="{nt.NAME_TECH}"<!-- IF ow.NAME_TECH == nt.NAME_TECH --> selected<!-- ENDIF -->>{nt.NAME}</option>
						<!-- END nt -->
					</select>
				</td>
				<td>
					<input type="text" name="edit_opt[{ow.I}]" value="{ow.NAME}" class="form-control" />
					<input type="hidden" name="edit_opt_id[{ow.I}]" value="{ow.ID}" />
				</td>
				<td class="text-center"><input type="checkbox" name="edit_def[{ow.ID}]" value="1"<!-- IF ow.DEF == 1 --> checked<!-- ENDIF --> /></td>
				<td class="text-center">
					<input type="checkbox" name="delete_opt[{ow.I}]" value="{ow.ID}" />
				</td>
			</tr>
			<!-- END ow -->
		</table>

		<h4 class="mt-5">Dodawanie nowej opcji</h4>
		<table class="table table-striped">
			<tr>
				<th>Nazwa robocza:</th>
				<td>
					<select name="name_tech" class="form-control">
						<!-- BEGIN nt -->
						<option value="{nt.NAME_TECH}">{nt.NAME}</option>
						<!-- END nt -->
					</select>
				</td>
			</tr>
			<tr>
				<th>Opcje:</th>
				<td>
					<textarea name="opt" class="form-control" rows="10"></textarea>
					<font class="tiny">każda nazwa musi byc w nowej linijce</font>
				</td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" class="btn btn-primary" name="save" value="Zapisz zmiany" /></td>
			</tr>
		</table>
	</form>

	<!-- ELSEIF OP == 'tax-values' -->

	<form method="post">
		<table class="table table-striped">
			<tr>
				<th>Kraj</th>
				<th>Podatek</th>
			</tr>
			<!-- BEGIN t -->
			<tr>
				<td>{t.NAME}</td>
				<td>
					<div class="input-group">
						<input type="number" name="tax[{t.C_ID}]" value="{t.VALUE}" class="form-control" step="any" />
						<div class="input-group-apend">
							<span class="input-group-text">%</span>
					  </div>
					</div>
					<input type="hidden" name="country[]" value="{t.C_ID}" />
				</td>
			</tr>
			<!-- END t -->
			<tr>
				<td colspan="2"><button type="submit" name="save" value="1" class="btn btn-primary">Zapisz</button>
			</tr>
		</table>
	</form>
	<!-- ENDIF -->
