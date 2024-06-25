<!-- INCLUDE theme_header.tpl -->
<div class="container" id="forum">
	<h3>Forum - dodaj nowy temat</h3>
	<form method="post">
		<table class="table table-striped">
			<tr class="top">
				<th colspan="2">Dodawanie nowego tematu</th>
			</tr>
			<tr>
				<td class="nazwa">Temat:</td>
				<td class="pole"><input type="text" name="topic" maxlength="150" value="{TOPIC}" required="required" class="form-control" /></td>
			</tr>
			<tr>
				<td class="nazwa">Treść:</td>
				<td class="pole">
					<textarea id="content" name="content" required="required" class="form-control" rows="4">{CONTENT}</textarea>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" value="Wyślij >>" class="btn btn-main" />
					<input type="hidden" name="save" value="1" />
				</td>
			</tr>
		</table>
	</form>
</div>
<script>
	CKEDITOR.replace( 'content', {
		allowedContent: true,
		toolbar :
			[
				['Bold', 'Italic', '-', 'Link', 'Unlink', '-', 'Image', '-', 'TextColor']
			]
	});
</script>
<!-- INCLUDE theme_footer.tpl -->
