<h3>Kontakt z obsługą</h3>
<div class="col-md-6 col-xs-12">
	<form method="post" action="">
		<table class="table table-striped">
			<tr>
				<th>Rodzaj wiadomości</th>
				<th>E-mail kontaktowy</th>
				<th></th>
			</tr>
			<!-- BEGIN c -->
			<tr>
				<td><input type="text" name="rodzaj_wiadomosci[]" value="{c.TYPE}" class="form-control" /></td>
				<td class="col-md-4"><input type="text" name="adres_email[]" value="{c.EMAIL}" class="form-control" /></td>
				<td class="text-center"><a class="btn btn-danger btn-sm" href="{ADMIN_FILE}?op=kontakt&amp;del={c.ID}"><em class="fa fa-trash"></em> Usuń</a></td>
				<input type="hidden" name="id[]" value="{c.ID}" />
			</tr>
			<!-- END c -->
			<tr>
				<td colspan="3" class="text-right">
					<input type="submit" name="save" class="btn btn-primary" value="Zapisz zmiany" />
				</td>
			</tr>
		</table>
	</form>
	<h4>Dodaj nowy rodzaj wiadomości</h4>
	<form method="post">
		<table class="table table-striped">
			<tr>
				<th>Rodzaj wiadomości</th>
				<th>E-mail kontaktowy</th>
			</tr>
			<tr>
				<td><input type="text" name="rodzaj_wiadomosci" class="form-control" /></td>
				<td class="col-md-4"><input type="text" name="adres_email" class="form-control" /></td>
			</tr>
			<tr>
				<td colspan="2" class="text-right">
					<input type="submit" name="add" class="btn btn-primary" value="Dodaj" />
				</td>
			</tr>
		</table>
	</form>
</div>
