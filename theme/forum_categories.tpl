<!-- INCLUDE theme_header.tpl -->
<div class="container" id="forum">
	<h3 class="title">Forum</h3>
	<!-- IF EMPTY -->
	<div class="alert alert-warning">Forum w trakcie moderacji</div>
	<!-- ELSE -->
	<table class="table table-striped box-main">
		<thead>
			<tr>
				<th>Kategoria</th>
				<th class="text-center">Postów</th>
				<th class="text-center">Tematów</th>
			</tr>
		</thead>
		<tbody>
			<!-- BEGIN categories -->
			<tr>
				<td>
					<a href="{SITEURL}/forum/topics?cat_id={categories.ID}">{categories.NAME}</a>
				</td>
				<td class="text-center">{categories.POSTS}</td>
				<td class="text-center">{categories.TOPICS}</td>
			</tr>
			<!-- END categories -->
		</tbody>
	</table>
	<!-- ENDIF -->
</div>
<!-- INCLUDE theme_footer.tpl -->
