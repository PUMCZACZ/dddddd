<h3>Slajdy na stronie głównej</h3>
<form method="post">
	<table class="table table-striped">
		<tr>
			<th>Slajd</th>
			<th>Nazwa</th>
			<th>Adres</th>
			<th class="text-center">Pozycja</th>
			<th class="text-center">Blok</th>
			<th class="text-center">Aktywny</th>
			<th class="text-center">Usuń</th>
		</tr>
		<!-- BEGIN s -->
		<tr>
			<td class="text-center"><img width="200" src="img/slider/{s.OBRAZ}" /></td>
			<td><input type="text" name="nazwa[]" value="{s.NAZWA}" class="form-control" /></td>
			<td><input type="text" name="adres[]" value="{s.ADRES}" class="form-control" /></td>
			<td class="text-center"><input type="number" name="pozycja[]" value="{s.POZYCJA}" class="form-control text-center" /></td>
			<td class="text-center">
				<input type="radio" name="block[{s.ID}]" value="1"<!-- IF s.BLOCK == 1 --> checked<!-- ENDIF --> /> Główny<br />
				<input type="radio" name="block[{s.ID}]" value="0"<!-- IF s.BLOCK == 0 --> checked<!-- ENDIF --> /> Strona Główna
			</td>
			<td class="text-center">
				<input type="checkbox" value="{s.ID}" name="aktywne[{s.I}]"<!-- IF s.AKTYWNE --> checked<!-- ENDIF --> />
			</td>
			<td class="text-center">
				<input type="checkbox" value="{s.ID}" name="delete[]" />
				<input type="hidden" name="id[]" value="{s.ID}" />
			</td>
		</tr>
		<!-- END s -->
		<tr>
			<td colspan="6" align="right"><input type="submit" name="save" value="Zapisz zmiany" class="btn btn-primary" /></td>
		</tr>
	</table>
</form>
<h4>Dodawanie nowego slajdu</h4>
<form method="post" enctype="multipart/form-data">
	<table class="table table-striped">
		<tr>
			<th>Slajd</th>
			<th>Nazwa</th>
			<th>Adres</th>
		</tr>
		<tr>
			<td>
				<input type="file" name="nowy_obraz" /><br />
				<font class="tiny">Wymagany rozmiar grafiki: 610px X 400px</font>
			</td>
			<td><input type="text" name="nowa_nazwa" class="form-control" /></td>
			<td><input type="text" name="nowy_adres" class="form-control" placeholder="http://" /></td>
		</tr>
		<tr>
			<td colspan="3" align="right"><input type="submit" name="add" value="Dodaj slajd" class="btn btn-primary" /></td>
		</tr>
	</table>
</form>
