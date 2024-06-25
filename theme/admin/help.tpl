<h2>Pomoc</h2>
<div class="alert alert-info">Hierarchia: <strong>Dział</strong> <em class="fa fa-angle-double-right"></em> <strong>Kategoria</strong> <em class="fa fa-angle-double-right"></em> <strong>Zagadnienie</strong></div>
<form method="post">
	<table class="table table-striped">
		<tr>
			<th colspan="3">Dodaj dział</th>
		</tr>
		<tr>
			<td colspan="3">
				Nazwa:<br />
				<input type="text" name="nazwa_dzial" class="form-control" />
				<input type="hidden" name="rodzaj_dzial" value="dzial" />
			</td>
		</tr>
		<tr>
			<td colspan="3"><input type="submit" name="zapisz" value="Zapisz" class="btn btn-primary" /></td>
		</tr>
	</table>
	<table class="table table-striped">
		<tr>
			<td colspan="3"><b>Dodaj kategorię</th>
		</tr>
		<tr>
			<td style="width:250px;">
				Nazwa:<br />
				<input type="text" name="nazwa_kategoria" class="form-control" />
			</td>
			<td>
				Dział:<br />
				<select name="dzial_kategoria">
					<!-- BEGIN c -->
					<option value="{c.ID}">{c.NAZWA}</option>
					<!-- END c -->
				</select>
				<input type="hidden" name="rodzaj_kategoria" value="kategoria" />
			</td>
		</tr>
		<tr>
			<td colspan="3"><input type="submit" name="zapisz" value="Zapisz" class="btn btn-primary" /></td>
		</tr>
	</table>
</form>
<form method="post">
	<table class="table table-striped">
		<tr>
			<th colspan="2">
				<a name="edycja"></a><!-- IF EDYTUJ -->Edytuj zagadnienie pomocy<!-- ELSE -->Nowe zagadnienie pomocy<!-- ENDIF -->
			</th>
		</tr>
		<tr>
			<td>
				Tytuł:<br />
				<input type="text" name="temat" class="form-control" value="{TEMAT}" />
			</td>
			<td>
				Kategoria:<br />
				<select name="cat_id">
					<!-- BEGIN c -->
					<option value="{c.ID}"<!-- IF CAT_ID == c.ID --> selected<!-- ENDIF -->>{c.NAZWA}</option>
					<!-- END c -->
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				Treść:<br />
				<textarea name="tekst">{TEKST}</textarea>
				<script>
					CKEDITOR.replace( 'tekst', {
						fullPage: false,
						allowedContent: true
					});
				</script>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<!-- IF EDYTUJ -->
				<input type="hidden" name="id" value="{ID}" />
				<input type="submit" name="zapisz_zmiany_pomoc" value="Zapisz zmiany" class="btn btn-primary" />
				<!-- ELSE -->
				<input type="submit" name="dodaj" value="Dodaj" class="btn btn-primary" />
				<!-- ENDIF -->
			</td>
		</tr>
	</table>
</form>

<h4>Działy</h4>
<form method="post">
	<table class="table table-striped">
		<tr>
			<th>Nazwa</th>
			<th class="text-center">Usuń</th>
		</tr>
		<!-- BEGIN cd -->
		<tr>
			<td><input type="text" name="nazwa_dzial[]" value="{cd.NAZWA}" class="form-control" /></td>
			<td align="center">
				<input type="checkbox" name="usun_dzial[]" value="{cd.ID}"<!-- IF cd.DISABLED --> disabled<!-- ENDIF --> />
				<input type="hidden" name="id_dzial[]" value="{cd.ID}" />
			</td>
		</tr>
		<!-- END cd -->
		<tr>
			<td colspan="2"><input type="submit" name="zapisz_zmiany" value="Zapisz zmiany" class="btn btn-primary" /></td>
		</tr>
	</table>

	<h4>Kategorie</h4>
	<table class="table table-striped">
		<tr>
			<th>Nazwa</th>
			<th>Dział</th>
			<th class="text-center">Usuń</th>
		</tr>
		<!-- BEGIN c -->
		<tr>
			<td><input type="text" name="nazwa_kategoria[]" value="{c.NAZWA}" class="form-control" /></td>
			<td>
				<select name="cat_id[]" class="form-control">
					<!-- BEGIN cd -->
					<option value="{cd.ID}"<!-- IF c.CAT_ID == cd.ID --> selected<!-- ENDIF -->>{cd.NAZWA}</option>
					<!-- END cd -->
				</select>
			</td>
			<td class="text-center">
				<input type="checkbox" name="usun_kategoria[]" value="{c.ID}" />
				<input type="hidden" name="id_kategoria[]" value="{c.ID}" />
			</td>
		</tr>
		<!-- END c -->
		<tr>
			<td colspan="3"><input type="submit" name="zapisz_zmiany" value="Zapisz zmiany" class="btn btn-primary" /></td>
		</tr>
	</table>

	<h4>Zagadnienia pomocy</h4>
	<table class="table table-striped">
		<tr>
			<th>Tytuł</th>
			<th>Dział</th>
			<th>Kategoria</th>
			<th class="text-center">Usuń</th>
			<td></td>
		</tr>
		<!-- BEGIN p -->
		<tr>
			<td>{p.TEMAT}</td>
			<td>{p.DZIAL_NAZWA}</td>
			<td>{p.KATEGORIA_NAZWA}</td>
			<td class="text-center"><input type="checkbox" name="usun[]" value="{p.ID}" /></td>
			<td><a href="{ADMIN_FILE}?op=pomoc&amp;edytuj={p.ID}#edycja">Edytuj</a></td>
		</tr>
		<!-- END p -->
		<tr>
			<td colspan="5"><input type="submit" name="usun_pomoc" value="Usuń zaznaczone pozycji" class="btn btn-primary" /></td>
		</tr>
	</table>
</form>
