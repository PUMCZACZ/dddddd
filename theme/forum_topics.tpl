<!-- INCLUDE theme_header.tpl -->
<div class="container" id="forum">
	<h3 class="title">
		<a href="{SITEURL}/forum">Forum</a> - <a href="{SITEURL}/forum/topics?cat_id={CAT_ID}">{CAT_NAME}</a>
		<a class="pull-right btn btn-main" href="{SITEURL}/forum/new_topic?cat_id={CAT_ID}">Rozpocznij nowy temat</a>
	</h3>
	<!-- IF BRAK -->
	<div class="alert alert-warning">Brak tematów na forum</div>
	<!-- ELSE -->
	<table class="table table-striped box-main">
		<thead>
			<tr>
				<th>Temat</th>
				<th class="text-center">Autor</th>
				<th class="text-center">Odpowiedzi</th>
				<th class="text-center">Ostatni post</th>
				<th class="text-center">Wyświetleń</th>
			</tr>
		</thead>
		<tbody>
			<!-- BEGIN topics -->
			<tr>
				<td>
					<a href="{SITEURL}/forum/topic?id={topics.ID}">
						<!-- IF topics.HOT --><big title="Gorący temat" class="text-danger mr-2"><i class="fab fa-hotjar"></i></big><!-- ENDIF -->
						<!-- IF topics.PRZYKLEJONY --><big title="Przyklejony" class="text-primary mr-2"><i class="far fa-sticky-note"></i></big><!-- ENDIF -->
						{topics.TOPIC}
					</a>
				</td>
				<td class="text-center">
					{topics.AUTOR}<br />
					<font class="tiny">{topics.DATE}</font>
				</td>
				<td class="text-center">{topics.POSTS}</td>
				<td class="text-center">
					<!-- IF topics.LAST -->
					{topics.LAST}<br />
					<font class="tiny">{topics.LAST_DATE}</font>
					<!-- ELSE -->
					<font class="tiny"><em>Brak</em></font>
					<!-- ENDIF -->
				</td>
				<td class="text-center">{topics.VIEWS}</td>
			</tr>
			<!-- END topics -->
		</tbody>
	</table>
	<!-- IF PAGER -->
	<div id="stronicowanie">{PAGER}</div>
	<!-- ENDIF -->
	<!-- ENDIF -->
</div>
<!-- INCLUDE theme_footer.tpl -->
