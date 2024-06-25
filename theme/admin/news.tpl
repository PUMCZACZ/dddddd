  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'news-list' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=news-list">Lista aktualności</a></li>
      </li>
			<li class="nav-item">
        <a class="nav-link<!-- IF OP == 'news' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=news">Dodaj aktualności</a></li>
      </li>
    </ul>
  </div>
  <div class="card-body">

<!-- IF OP == 'news' || OP == 'news-edit' -->

<h4><!-- IF OP == 'news-edit' -->Edycja artykułu<!-- ELSE -->Dodaj nowy artykuł<!-- ENDIF --></h4>

<form method="post" action="{ADMIN_FILE}?op=<!-- IF OP == 'news-edit' -->news-save<!-- ELSE -->news-add<!-- ENDIF -->" enctype="multipart/form-data">
	<table class="table table-striped">
		<tr>
			<th>Tytuł</th>
			<td>
        <!-- BEGIN langs -->
        <div class="form-group">
          {langs.NAME}: <input type="text" name="title_{langs.NAME_DEF}" value="{langs.TITLE}" class="form-control" />
        </div>
        <!-- END langs -->
			</td>
		</tr>
		<tr>
			<th>Zdjęcie</th>
			<td>
				<!-- IF PHOTO -->
				<img border="0" src="{PHOTO}" align="middle"> <a class="btn btn-danger btn-xs" href="{ADMIN_FILE}?op=news-photo-delete&amp;id={ID}">usuń</a>
				<!-- ELSE -->
				<input type="file" name="photo" id="photo" />
				<!-- ENDIF -->
			</td>
		</tr>
		<tr>
			<th>Tekst wstępny</th>
			<td>
        <!-- BEGIN langs -->
        <div class="form-group">
          {langs.NAME}: <textarea name="text_intro_{langs.NAME_DEF}" class="form-control" rows="3">{langs.TEXT_INTRO}</textarea>
        </div>
        <!-- END langs -->
			</td>
		</tr>
		<tr>
			<th>Tekst artykulu</th>
			<td>
        <!-- BEGIN langs -->
        <div class="form-group">
          {langs.NAME}: <textarea name="text_{langs.NAME_DEF}" class="form-control" rows="10">{langs.TEXT}</textarea>
        </div>
        <!-- END langs -->
			</td>
		</tr>
    <tr>
			<th>Meta opis</th>
			<td>
        <input type="text" name="meta_desc" value="{META_DESC}" class="form-control" />
			</td>
		</tr>
    <tr>
			<th>Meta słowa kluczowe</th>
			<td>
        <input type="text" name="meta_keywords" value="{META_KEYWORDS}" class="form-control" />
			</td>
		</tr>
		<tr>
			<td colspan="2" class="text-right">
				<!-- IF OP == 'news-edit' -->
				<input type="hidden" name="id" value="{ID}" />
				<input type="submit" value="Zapisz zmiany" class="btn btn-primary" />
				<!-- ELSE -->
				<input type="submit" value="Dodaj nowy artykuł" class="btn btn-primary" />
				<!-- ENDIF -->
			</td>
		</tr>
	</table>
</form>

<script>
<!-- BEGIN langs -->
CKEDITOR.replace('text_intro_{langs.NAME_DEF}');
CKEDITOR.replace('text_{langs.NAME_DEF}');
<!-- END langs -->
</script>

<!-- ELSEIF OP == 'news-list' -->

<h4>Lista artykułów</h4>
<!-- IF .a -->
<table class="table table-striped">
	<tr>
		<th class="text-center">Zdjęcie</th>
		<th>Tytuł</th>
		<th class="text-center">Data dodania</th>
		<th></th>
		<th></th>
	</tr>
	<!-- BEGIN a -->
	<tr>
		<td class="text-center"><!-- IF a.PHOTO --><img src="{a.PHOTO}" /><!-- ELSE --><em>Brak</em><!-- ENDIF -->
		<td>
			<h5>{a.TITLE}</h5>
			<div class="text-truncate d-block" style="width:550px">{a.TEXT_INTRO}</div>
		</td>
		<td class="text-center">{a.DATE}</td>
		<td class="text-center">
			<a class="btn btn-primary" href="{ADMIN_FILE}?op=news-edit&amp;id={a.ID}">Edytuj</a>
		</td>
		<td class="text-center">
			<a class="btn btn-danger" href="{ADMIN_FILE}?op=news-delete&amp;id={a.ID}" onclick="return confirm('Na pewno usunąć pozycję?');">Usuń</a>
		</td>
	</tr>
	<!-- END a -->
</table>
<!-- ELSE -->
<div class="alert alert-warning">Brak aktualności</div>
<!-- ENDIF -->

<!-- ENDIF -->

</div>
