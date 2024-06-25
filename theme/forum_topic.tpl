<!-- INCLUDE theme_header.tpl -->
<div class="container" id="forum">
	<ul class="breadcrumb">
		<li class="breadcrumb-item"><a href="{SITEURL}/forum">Forum</a></li>
		<li class="breadcrumb-item"><a href="{SITEURL}/forum/topics?cat_id={CAT_ID}">{CAT_NAME}</a></li>
		<li class="breadcrumb-item"><a href="{SITEURL}/forum/topic?id={ID}">{TOPIC}</a></li>
	</ul>
	<h3 class="title">{TOPIC}</h3>
	<table class="table table-striped box-main">
		<thead>
			<tr>
				<th style="width:15%;" class="text-center">Autor</th>
				<th style="width:85%;">Wiadomość</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-center">
					{AUTHOR}
					<p align="center"><font class="tiny">Dodano: {DATE}</font></p>
				</td>
				<td>
					<strong>{TOPIC}</strong>
					<p>{TRESC}</p>
					<!-- IF EDYTUJ -->
					<div class="float-left mt-3">
						<a class="btn btn-warning btn-sm" href="{SITEURL}/forum/edit?id={ID}&amp;t_id={ID}">Edytuj</a>
						<a class="btn btn-danger btn-sm ml-3" href="{SITEURL}/forum/topic?id={ID}&amp;delete_topic={ID}">Usuń</a>
					</div>
					<!-- ENDIF -->
					<div class="float-right mt-3">
						<!-- IF USUWANIE --><a class="btn btn-xs btn-danger btn-sm" href="{SITEURL}/forum/topic?id={ID}&amp;delete_topic={ID}">Usuń temat</a><!-- ENDIF -->
						<!-- IF ADMIN -->
						<!-- IF PRZYKLEJONY -->
						<a class="btn btn-xs btn-success btn-sm" href="{SITEURL}/forum/topic?id={ID}&amp;odklej_topic={ID}">Odklej temat</a>
						<!-- ELSE -->
						<a class="btn btn-xs btn-success btn-sm" href="{SITEURL}/forum/topic?id={ID}&amp;przyklej_topic={ID}">Przyklej temat</a>
						<!-- ENDIF -->
						<a class="btn btn-xs btn-danger btn-sm" href="{SITEURL}/forum/topic?id={ID}&amp;hot={ID}"><i class="fab fa-hotjar"></i> Gorący temat</a>
						<!-- ENDIF -->
					</div>
				</td>
			</tr>
			<!-- BEGIN posts -->
			<tr>
				<td class="text-center">
					{posts.AUTHOR}
					<p align="center"><font class="tiny">Dodano: {posts.DATE}</font></p>
				</td>
				<td>
					<strong>{posts.TOPIC}</strong>
					<p>{posts.POST}</p>
					<!-- IF EDYTUJ -->
					<div class="float-left mt-3">
						<a class="btn btn-warning btn-sm" href="{SITEURL}/forum/edit?id={ID}&amp;p_id={posts.ID}">Edytuj</a>
						<a class="btn btn-danger btn-sm ml-3" href="{SITEURL}/forum/topic?id={ID}&amp;delete_post={posts.ID}">Usuń</a>
					</div>
					<!-- ENDIF -->
					<!-- IF posts.USUWANIE -->
					<div class="float-right mt-3">
						<a class="btn btn-xs btn-danger btn-sm" href="{SITEURL}/forum/topic?id={ID}&amp;delete_post={posts.ID}">Usuń post</a>
					</div>
					<!-- ENDIF -->
				</td>
			</tr>
			<!-- END posts -->
		</tbody>
	</table>
	<!-- IF PAGER -->
	<div id="stronicowanie">{PAGER}</div>
	<!-- ENDIF -->
	<!-- IF IS_USER -->
	<h3 class="title">Dodaj odpowiedź</h3>
	<form method="post">
	<table class="table table-striped box-main">
		<tr>
			<th>Temat:</th>
			<td><input type="text" name="topic" class="form-control" value="Re: {TOPIC}" /></td>
		</tr>
		<tr>
			<th>Wiadomość:</th>
			<td class="pole"><textarea name="content" class="form-control" rows="3">{CONTENT}</textarea></td>
		</tr>
		<tr>
			<td colspan="2" class="text-right"><input type="submit" name="save" value="Wyślij odpowiedź" class="btn btn-main" /></td>
		</tr>
		<input type="hidden" name="id" value="{ID}" />
	</table>
	</form>
	<!-- ELSE -->
	<div class="alert alert-info"><a href="{LINK}"><strong>Zaloguj się</strong></a>, aby dodać odpowiedź</div>
	<!-- ENDIF -->
</div>
<!-- INCLUDE theme_footer.tpl -->
<script>
	CKEDITOR.replace( 'content', {
		allowedContent: true,
		toolbar :
			[
				['Bold', 'Italic', '-', 'Link', 'Unlink', '-', 'Image', '-', 'TextColor']
			]
	});
</script>
