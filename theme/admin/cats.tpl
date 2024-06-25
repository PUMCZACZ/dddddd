<div class="card-header">
	<ul class="nav nav-pills card-header-pills">
		<li class="nav-item">
			<a class="nav-link<!-- IF OP == 'cats' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=cats">Kategorie</a>
		</li>
		<li class="nav-item">
			<a class="nav-link<!-- IF OP == 'cats-profiles' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=cats-profiles">Kategorie Firmowe</a>
		</li>
		<li class="nav-item">
			<a class="nav-link<!-- IF OP == 'items-filters' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=items-filters">Filtry</a>
		</li>
	</ul>
</div>
<div class="card-body">

<form method="post" action="" enctype="multipart/form-data">
	<a class="btn btn-outline-secondary float-right" href="{ADMIN_FILE}?op={OP}&amp;update_ip=1">Aktualizuj IP</a>
<h3 class="my-3">Lista kategorii<!-- IF OP == 'cats-profiles' --> firmowych<!-- ENDIF --><!-- IF CAT_NAME --> '{CAT_NAME}'<!-- ENDIF --></h3>
<!-- IF LEVEL_1 -->
<a class="my-2" href="{ADMIN_FILE}?op={OP}&amp;cat_id={CAT_UP_ID}&amp;level={LEVEL_1}">Wróć do '{CAT_UP_NAME}'</a>
<hr />
<!-- ENDIF -->
<table class="table table-striped">
	<tr>
		<th>Poziom</th>
		<th>Nazwa</th>
		<th class="text-center">Pozycja</th>
		<th class="text-center">Meta opis</th>
		<th class="text-center">Meta słowa kluczowe</th>
		<th class="text-center">Usuń</th>
		<th></th>
		<th></th>
	</tr>
	<!-- BEGIN cats -->
	<tr>
		<td class="text-center">
			<a class="p-2 btn btn-secondary" href="{ADMIN_FILE}?op={OP}&amp;cat_id={cats.ID}&amp;level={cats.LEVEL_1}"><em class="fa fa-plus"></em></a>
		</td>
		<td class="">
			<div class="input-group">
				<input type="text" name="name[]" value="{cats.NAME}" class="form-control" />
				<!-- IF OP == 'cats' -->
				<div class="input-group-prepend">
    			<span class="input-group-text">({cats.COUNTER})</span>
				</div>
				<!-- ENDIF -->
			</div>
		</td>
		<td class="text-center">
			<input type="text" name="position[]" value="{cats.POSITION}" class="form-control mini_text text-center" style="margin:0 auto" />
			<input type="hidden" name="id[]" value="{cats.ID}" />
		</td>
		<td class="text-center">
			<input type="text" name="meta_desc[]" value="{cats.META_DESC}" class="form-control text-center" style="margin:0 auto" />
		</td>
		<td class="text-center">
			<input type="text" name="meta_keywords[]" value="{cats.META_KEYWORDS}" class="form-control text-center" style="margin:0 auto" />
		</td>
		<td class="text-center">
			<input type="checkbox" name="delete[]" value="{cats.ID}"<!-- IF cats.DISABLED --> disabled<!-- ENDIF --> />
		</td>
		<td class="text-center">
			<a href="funcs.php?name=items&amp;file=list&amp;id={cats.ID}<!-- IF OP == 'cats-profiles' -->&amp;type=companies<!-- ENDIF -->" target="_blank" class="btn btn-info btn-sm">
				<em class="fa fa-search"></em> Podgląd
			</a>
		</td>
	</tr>
	<!-- END cats -->
	<tr>
		<td colspan="8"><input type="submit" class="btn btn-primary" name="save" value="Zapisz zmiany" /></td>
	</tr>
</table>
<br />
<h3>Dodawanie nowej kategorii</h3>
<table class="table table-striped">
	<tr>
		<td colspan="4">
			<strong>Nazwa</strong>:<br />
			<input type="text" name="new_name" class="form-control" style="max-width:280px;" />
			<input type="hidden" name="left_id" value="{CAT_ID}" />
			<input type="hidden" name="level" value="{LEVEL}" />
		</td>
	</tr>
	<tr>
		<td colspan="4"><strong>Szybkie dodawanie kategorii</strong>:</td>
	</tr>
	<tr>
		<td colspan="4">
			<textarea name="cats" rows="7" placeholder="każda nazwa musi byc w nowej linijce" class="form-control" style="max-width:280px;"></textarea><br />
			<font class="tiny">każda nazwa musi byc w nowej linijce</font>
		</td>
	</tr>
	<tr>
		<td colspan="4"><input type="submit" class="btn btn-primary" name="save" value="Zapisz zmiany" /></td>
	</tr>
</table>
</form>

</div>
