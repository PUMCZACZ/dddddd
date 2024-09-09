<!-- INCLUDE tpl_user_open.tpl -->
<h3>Moje subskrypcje</h3>
<!-- IF .s -->
<table class="table table-subscription">
	<tr>
		<th>Kategoria:</th>
		<th class="text-center">Usuń</th>
	</tr>
	<!-- BEGIN s -->
	<tr>
		<td>
			{s.NAME}
		</td>
		<td class="text-center">
			<a href="funcs.php?name=user&amp;file=subscriptions&amp;del={s.ID}" title="Usuń" data-toggle="tooltip" data-placement="right" onclick="return confirm('Na pewno usunąć subskrypcję?');">
				<em class="fa fa-trash"></em>
			</a>
		</td>
	</tr>
	<!-- END s -->
</table>
<script>
	$(function () {
	  $('[data-toggle="tooltip"]').tooltip()
	})
</script>
<!-- ELSE -->
<h4>Nie posiadasz żadnych subskrypcji</h4>
<!-- ENDIF -->
<!-- INCLUDE tpl_user_close.tpl -->
