	<div class="card-body">
		<h3>Treści serwisu</h3>
		<form method="post">
			<table class="table table-striped">
				<tr>
					<th>ID</th>
					<th>Nazwa</th>
					<th class="text-center">Pozycja</th>
					<th class="text-center">Widoczne w nagłówku</th>
					<th class="text-center">Widoczne w stopce</th>
					<th class="text-center">Aktywna</th>
					<th></th>
				</tr>
				<!-- BEGIN p -->
				<tr>
					<td class="text-center">{p.ID}</td>
					<td><!-- IF p.TITLE -->{p.TITLE}<!-- ELSE --><em class="text-secondary">Rezerwa</em><!-- ENDIF --></td>
					<td class="text-center">
						<input type="number" name="position[{p.ID}]" class="form-control text-center" value="{p.POSITION}" />
					</td>
					<td class="text-center">
						<input type="checkbox" name="show_header[{p.ID}]" value="1"<!-- IF p.SHOW_HEADER == 1 --> checked<!-- ENDIF --> />
					</td>
					<td class="text-center">
						<input type="checkbox" name="show_footer[{p.ID}]" value="1"<!-- IF p.SHOW_FOOTER == 1 --> checked<!-- ENDIF --> />
						<input type="hidden" name="c_id[]" value="{p.ID}" />
					</td>
					<td class="text-center">
						<input type="checkbox" name="active[{p.ID}]" value="1"<!-- IF p.ACTIVE == 1 --> checked<!-- ENDIF --> />
					</td>
					<td class="text-center">
						<a class="btn btn-primary" href="{ADMIN_FILE}?op=pages&amp;edit={p.ID}#edit">Edytuj</a>
						<!-- IF p.ID > 3 --><a class="btn btn-danger" href="{ADMIN_FILE}?op=pages&amp;delete={p.ID}" onclick="return confirm('Napewno usunąć pozycję?');">Usuń</a><!-- ENDIF -->
					</td>
				</tr>
				<!-- END p -->
				<tr>
					<td colspan="7" class="text-right">
						<button type="submit" name="save" value="1" class="btn btn-primary">Zapisz zmiany</button>
					</td>
			</table>
		</form>
		<hr />
		<form method="post">
			<a name="edycja"></a>
			<table class="table table-striped">
				<!-- BEGIN langs -->
				<tr>
					<td>
						<strong id="edit">Tytuł {langs.NAME}</strong><br />
						<input type="text" name="title_{langs.NAME_DEF}" value="{langs.TITLE}" class="form-control" />
					</td>
				</tr>
				<!-- END langs -->
				<!-- BEGIN langs -->
				<tr>
					<td>
						<strong>Treść {langs.NAME}:</strong><br />
						<textarea name="text_{langs.NAME_DEF}" class="form-control text_{langs.NAME_DEF}" rows="10">{langs.TEXT}</textarea>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Meta opis {langs.NAME}:</strong><br />
						<input type="text" name="meta_desc_{langs.NAME_DEF}" value="{langs.META_DESC}" class="form-control" />
					</td>
				</tr>
				<tr>
					<td>
						<strong>Meta słowa kluczowe {langs.NAME}:</strong><br />
						<input type="text" name="meta_keywords_{langs.NAME_DEF}" value="{langs.META_KEYWORDS}" class="form-control" />
					</td>
				</tr>
				<!-- END langs -->
				<tr>
					<td>
						<input type="submit" name="save" class="btn btn-primary" value="Zapisz" />
						<!-- IF ID -->
						<input type="hidden" name="id" value="{ID}" />
						<!-- ENDIF -->
					</td>
				</tr>
			</table>
		</form>
	</div>

	<script>
    $(function(){
      <!-- BEGIN langs -->
      $('.text_{langs.NAME_DEF}').froalaEditor({
        enter: $.FroalaEditor.ENTER_P,
        placeholderText: null,
        height: 300,
        imageUploadURL: '{ADMIN_FILE}?op=pages-upload-image',
        imageUploadMethod: 'POST',
        imageMaxSize: 100 * 1024 * 1024,
        imageAllowedTypes: ['jpeg', 'jpg', 'png', 'gif'],
        imagePaste: true
      })
      <!-- END langs -->
    });
  </script>
