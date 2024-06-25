<h3>Forum - lista kategorii</h3>
<form method="post">
	<!-- IF .fc -->
	<table class="table table-striped">
		<tr>
			<th class="text-center">ID</th>
			<th>Nazwa</th>
			<th class="text-center">Usuń</th>
		</tr>
		<!-- BEGIN fc -->
		<tr>
			<td class="text-center">
				{fc.ID}
			</td>
			<td>
				<input type="text" name="name[]" value="{fc.NAME}" class="form-control" />
				<input type="hidden" name="id[]" value="{fc.ID}" />
			</td>
			<td class="text-center">
				<input type="checkbox" name="usun[]" value="{fc.ID}" />
			</td>
		</tr>
		<!-- END fc -->
		<tr>
			<td colspan="3" class="text-right"><input type="submit" class="btn btn-primary" name="zapisz" value="Zapisz zmiany" /></td>
		</tr>
	</table>
	<!-- ELSE -->
	<div class="alert alert-warning">Brak kategorii. Dodaj kategorie aby moduł mógł poprawnie funkcjonować</div>
	<!-- ENDIF -->
</form>
<h3>Dodawanie nowej kategorii</h3>
<form method="post">
	<table class="table table-striped">
		<tr>
			<th>Nazwa</th>
			<td><input type="text" name="nowa_kategoria" class="form-control" /></td>
		</tr>
		<tr>
			<td colspan="2" class="text-right"><input type="submit" class="btn btn-primary" name="zapisz_kategorie" value="Dodaj" /></td>
		</tr>
	</table>
</form>
