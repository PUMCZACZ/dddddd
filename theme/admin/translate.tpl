<div class="card-header">
	<ul class="nav nav-pills card-header-pills">
		<li class="nav-item"><a class="nav-link<!-- IF OP == 'translate' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=translate">Tłumaczenie</a></li>
		<li class="nav-item"><a class="nav-link<!-- IF OP == 'translate-cats' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=translate-cats">Kategorie</a></li>
		<li class="nav-item"><a class="nav-link<!-- IF OP == 'translate-options' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=translate-options">Opcje wyboru</a></li>
	</ul>
</div>

<div class="card-body">

<!-- IF OP == 'translate' -->
<h4>Dodaj nowy język</h4>
<form method="post">
	<table class="table table-striped">
		<tr>
			<th>Nazwa</th>
			<th class="col-xs-3">Nazwa Robocza</th>
			<th class="text-center">Domyślny</th>
			<th class="text-center">Aktywny</th>
		</tr>
		<tr>
			<td><input type="text" name="name" placeholder="Nazwa" class="form-control" required /></td>
			<td>
				<input type="text" name="name_def" placeholder="Nazwa robocza" style="text-transform:lowercase;" class="form-control" required />
				<p class="help-block">Nazwa nie może zawierać znaków specjalnych, zostanie wykorzystana min. do utworzenia pliku.</p>
			</td>
			<td class="text-center">
				<input type="radio" name="domyslny" value="y" /> Tak <input type="radio" name="domyslny" value="n" checked="checked" /> Nie
			</td>
			<td class="text-center">
				<input type="radio" name="aktywny" value="1" checked="checked" /> Tak <input type="radio" name="aktywny" value="0" /> Nie
			</td>
		</tr>
		<tr>
			<td colspan="5" class="text-right"><button type="submit" name="save" value="1" class="btn btn-primary">Dodaj</button></td>
		</tr>
	</table>
</form>
<form method="post">
	<h4>Dostępne języki</h4>
	<table class="table table-striped">
		<tr>
			<th>Nazwa</th>
			<th class="col-xs-3">
				Nazwa Robocza
				<p class="help-block">Nazwa nie może zawierać znaków specjalnych, zostanie wykorzystana min. do utworzenia pliku.</p>
			</th>
			<th class="text-center">Domyślny</th>
			<th class="text-center">Aktywny</th>
			<th class="text-center">Usuń</th>
		</tr>
		<!-- BEGIN t_langs -->
		<tr>
			<td><input type="text" name="edytuj_name[{t_langs.NO}]" class="form-control" value="{t_langs.NAME}" /></td>
			<td>
				<input type="text" name="name_def[{t_langs.NO}]" value="{t_langs.NAME_DEF}" placeholder="Nazwa robocza" style="text-transform:lowercase;" class="form-control" />
			</td>
			<td class="text-center">
				<input type="radio" name="edytuj_domyslny[{t_langs.NO}]" value="1"<!-- IF t_langs.DEF == 1 --> checked<!-- ENDIF --> /> Tak
				<input type="radio" name="edytuj_domyslny[{t_langs.NO}]" value="0"<!-- IF t_langs.DEF == 0 --> checked<!-- ENDIF --> /> Nie
			</td>
			<td class="text-center">
				<input type="radio" name="edytuj_aktywny[{t_langs.NO}]" value="1"<!-- IF t_langs.ACTIVE == 1 --> checked<!-- ENDIF --> /> Tak
				<input type="radio" name="edytuj_aktywny[{t_langs.NO}]" value="0"<!-- IF t_langs.ACTIVE == 0 --> checked<!-- ENDIF --> /> Nie
			</td>
			<td class="text-center">
				<input type="checkbox" name="usun[]" value="{t_langs.ID}" />
				<input type="hidden" name="id[{t_langs.NO}]" value="{t_langs.ID}" />
			</td>
		</tr>
		<!-- END t_langs -->
		<tr>
			<td colspan="5" class="text-right"><button type="submit" name="save" value="1" class="btn btn-primary">Zapisz zmiany</button></td>
		</tr>
	</table>
</form>
<h4 id="translate">Tłumaczenie języków</h4>
<form class="form-inline well" role="form" method="get" action="{ADMIN_FILE}#translate">
		<input type="hidden" name="op" value="translate" />
		<select name="lang-file" class="form-control" style="min-width:200px" onchange="this.form.submit()">
			<option value="">-- wybierz --</option>
			<!-- BEGIN lang -->
			<option value="{lang.ID}"<!-- IF lang.ID == LANG --> selected<!-- ENDIF -->>{lang.NAME}</option>
			<!-- END lang -->
		</select>
		<select name="file" class="form-control ml-2" onchange="this.form.submit()">
			<option value="">-- wybierz --</option>
			<!-- BEGIN f -->
			<option value="{f.FILE}"<!-- IF FILE == f.FILE --> selected<!-- ENDIF -->>{f.FILE}</option>
			<!-- END f -->
		</select>
</form>

<!-- IF LANG_TRANSLATE -->
<form role="form" method="post">
	<h4>Lista fraz</h4>
	<table class="table table-striped">
		<tr>
			<th>{LANG_DEFAUL}</th>
			<th>{LANG_TRANSLATE}</th>
		</tr>
		<!-- BEGIN lt -->
		<tr>
			<td style="width:50%">{lt.NAME_DEFAULT}</td>
			<td>
				<input type="hidden" name="lang-key[]" value="{lt.ID}" />
				<input type="text" name="lang-text[]" value="{lt.NAME}" class="form-control" />
			</td>
		</tr>
		<!-- END lt -->
	</table>
	<nav aria-label="Page navigation example">
  	<ul class="pagination">
			<!-- BEGIN pag -->
    	<li class="page-item<!-- IF pag.ACTIVE --> active<!-- ENDIF -->">
				<a class="page-link" href="{ADMIN_FILE}?op=translate&amp;lang-file={pag.LANG-FILE}&amp;page={pag.PAGE}" aria-label="{pag.PAGE}">{pag.PAGE_NAME}</a>
			</li>
			<!-- END pag -->
		</ul>
	</nav>
	<div class="form-group text-right">
		<input type="hidden" name="lang_id" value="{LANG}" />
		<button type="submit" name="zapisz" value="1" class="btn btn-primary">Zapisz</button>
	</div>
</form>
<!-- ENDIF -->

<!-- ELSEIF OP == 'translate-cats' -->

<h4>Tłumaczenie kategorii</h4>
<form method="post">
	<!-- IF POZIOM -->
	<a href="{ADMIN_FILE}?op=translate-cats&amp;cat_id={CAT_ID}&amp;poziom={POZIOM_NIZEJ}"><h4>Wróć do '{NAZWA_NIZEJ}'</h4></a>
	<!-- ENDIF -->
	<table class="table table-striped">
		<tr>
			<th>Poziom</th>
			<th>Nazwa</th>
			<!-- BEGIN lang -->
			<th>{lang.NAME}</th>
			<!-- END lang -->
		</tr>
		<!-- BEGIN tcats -->
		<tr>
			<td class="text-center">
				<a href="{ADMIN_FILE}?op=translate-cats&amp;cat_id={tcats.ID}&amp;poziom={tcats.POZIOM_WYZEJ}">
					<em class="fa fa-plus"></em>
				</a>
			</td>
			<td>
				<input type="hidden" name="id[]" value="{tcats.ID}" />
				{tcats.NAZWA}
			</td>
			<!-- BEGIN langs -->
			<td>
				<input type="text" name="{langs.NAME_DEF}[{tcats.ID}]" value="{langs.VALUE}" class="form-control mb-1" placeholder="Nazwa" />
				<input type="text" name="meta_desc_{langs.NAME_DEF}[{tcats.ID}]" value="{langs.META_DESC}" class="form-control mb-1" placeholder="Meta opis" />
				<input type="text" name="meta_keywords_{langs.NAME_DEF}[{tcats.ID}]" value="{langs.META_KEYWORDS}" class="form-control" placeholder="Meta słowa kluczowe" />
			</td>
			<!-- END langs -->
		</tr>
		<!-- END tcats -->
		<tr>
				<td colspan="99" style="text-align:right;"><input type="submit" name="zapisz" value="Zapisz >>" class="btn btn-primary" /></td>
		</tr>
	</table>
</form>

<!-- ELSEIF OP == 'translate-options' -->

<form method="post" action="">
<h4>Lista opcji</h4>
<table class="table table-striped">
	<tr>
		<th style="width:33%">Nazwa</th>
		<!-- BEGIN lang -->
		<th>{lang.NAME}</th>
		<!-- END lang -->
	</tr>
	<!-- BEGIN ow -->
	<tr>
		<td style="width:210px; vertical-align:top;">
			{ow.OPCJA}
			<input type="hidden" name="id[]" value="{ow.ID}" />
		</td>
		<!-- BEGIN langs -->
		<td><input type="text" name="{langs.NAME_DEF}[{ow.ID}]" value="{langs.VALUE}" class="form-control" /></td>
		<!-- END langs -->
	</tr>
	<!-- END ow -->
	<tr>
		<td colspan="2"><input type="submit" class="btn btn-primary" name="zapisz" value="Zapisz zmiany" /></td>
	</tr>
</table>
</form>

<!-- ELSEIF OP == 'translate-parms' -->

<h3>Lista parametrów</h3>
<table class="table table-striped table-bordered">
	<tr>
		<th style="width:30px; text-align:center;">ID</th>
		<th>Nazwa</th>
		<th>Kategoria</th>
		<th>Typ</th>
		<th style="width:100px;"></td>
	</tr>
	<!-- BEGIN parametry -->
	<tr>
		<td style="text-align:center;">{parametry.PAR_ID}</td>
		<td>{parametry.NAZWA}</td>
		<td><!-- IF parametry.KATEGORIA -->{parametry.KATEGORIA}<!-- ELSE -->Wszystkie<!-- ENDIF --></td>
		<td class="text-center">
			<!-- IF parametry.TYP == 't' -->Tekst
			<!-- ELSEIF parametry.TYP == 'ch' -->Checkbox
			<!-- ELSEIF parametry.TYP == 's' -->Select
			<!-- ELSEIF parametry.TYP == 'oddo' -->Od-do<!-- ENDIF -->
		</td>
		<td style="text-align:center;"><a href="{ADMIN_FILE}?op=translate-parms-list&amp;par_id={parametry.PAR_ID}">Tłumaczenie</a></td>
	</tr>
	<!-- END parametry -->
</table>

<!-- ELSEIF OP == 'translate-parms-list' -->

<form method="post">
<h3>Tłumaczenie parametru</h3>
<table class="table table-striped">
	<tr>
		<th>Nazwa</th>
		<!-- BEGIN lang -->
		<th>{lang.NAME}</th>
		<!-- END lang -->
	</tr>
	<tr>
		<td>
			<input type="text" disabled class="form-control" value="{NAZWA}" />
			<input type="hidden" name="par_id" value="{PAR_ID}" />
		</td>
		<!-- BEGIN lang -->
		<td><input type="text" name="nazwa_{lang.NAME_DEF}" class="form-control" value="{lang.VALUE}" /></td>
		<!-- END lang -->
	</tr>
	<tr>
		<th colspan="99">
			Lista parametrów
		</th>
	</tr>
	<tr>
		<td>
			<!-- BEGIN parms -->
			<p>
				<input type="text" disabled class="form-control" value="{parms.NAZWA}" />
			</p>
			<!-- END parms -->
		</td>
		<!-- BEGIN lang -->
		<td>
			<!-- BEGIN parms -->
			<p>
				<input type="text" name="parms_{lang.NAME_DEF}[{parms.ID}]" class="form-control" value="{parms.NAZWA}" />
				<input type="hidden" name="parms_id[]" value="{parms.ID}" />
			</p>
			<!-- END parms -->
		</td>
		<!-- END lang -->
	</tr>
	<tr>
		<td colspan="2"><input type="submit" name="zapisz" value="Zapisz >>" class="przycisk" /></td>
		<input type="hidden" name="par_id" value="{PAR_ID}" />
	</tr>
</table>
</form>

<!-- ENDIF -->

</div>
