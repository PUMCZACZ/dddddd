<!-- INCLUDE theme_header.tpl -->
<div class="container" id="forum">
	<h3>Edycja postu "{TOPIC}"</h3>
	<form method="post">
	<table class="table table-striped">
		<tr>
			<th>Temat:</th>
			<td><input type="text" name="topic" value="{EDIT_TOPIC}" class="form-control" /></td>
		</tr>
		<tr>
			<th>Wiadomość:</th>
			<td><textarea name="post" class="form-control" rows="3">{EDIT_CONTENT}</textarea></td>
		</tr>
		<tr>
			<td colspan="2" class="wyslij"><input type="submit" name="zapisz" value="Zapisz zmiany" class="btn btn-main" /></td>
		</tr>
		<!-- IF POST_ID -->
		<input type="hidden" name="post_id" value="{POST_ID}" />
		<!-- ELSE IF T_ID -->
		<input type="hidden" name="t_id" value="{T_ID}" />
		<!-- ENDIF -->
		</form>
	</table>
	<hr size="1" noshade="noshade" color="#CCCCCC" />
	<h3>{TOPIC}</h3>
	<table class="table table-striped">
		<tr class="top">
			<th style="width:20%;">Autor</th>
			<th>Wiadomość</th>
		</tr>
		<tr class="post">
			<td class="text-center">
				{AUTHOR}
				<p><small>Dodano: {DATE}</small></p>
			</td>
			<td>
				<strong>{TOPIC}</strong>
				<p>{CONTENT}</p>
			</td>
		</tr>
		<!-- BEGIN posts -->
		<tr>
			<td class="text-center">
				{posts.AUTOR}
				<p><small>Dodano: {posts.DATE}</small></p>
			</td>
			<td>
				<strong>{posts.TOPIC}</strong>
				<p>{posts.POST}</p>
			</td>
		</tr>
		<!-- END posts -->
	</table>
</div>
<script>
	CKEDITOR.replace( 'post', {
		allowedContent: true,
		toolbar :
			[
				['Bold', 'Italic', '-', 'Link', 'Unlink', '-', 'Image', '-', 'TextColor']
			]
	});
</script>
<!-- INCLUDE theme_footer.tpl -->
