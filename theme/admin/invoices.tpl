<div class="card-body">
	<h3>Lista wystawionych faktur</h3>
	<!-- IF .f -->
	<form method="post">
		<div class="form-group form-inline">
			<input type="date" name="date-from" class="form-control mr-2" />
			<input type="date" name="date-to" class="form-control mr-2" />
			<button type="submit" name="search" value="1" class="btn btn-primary">Szukaj</button>
		</div>
		<table class="table table-striped table-bordered">
			<tr>
				<th class="text-center"><input type="checkbox" name"select" value="select" id="chkbox" onclick="do_this();" /></th>
				<th class="text-center">ID</th>
				<th class="text-center">Data wystawienia</th>
				<th class="text-center">Numer</th>
				<th class="text-center">Użytkownik</th>
				<th class="text-center">Kwota</th>
				<th class="text-center">Waluta</th>
			</tr>
			<!-- BEGIN f -->
			<tr>
				<th class="text-center"><input type="checkbox" name="id[]" value="{f.ID}" /></th>
				<td class="text-center">{f.ID}</td>
				<td class="text-center">{f.DATE}</td>
				<td class="text-center"><a target="_blank" href="uploaded/invoices/{f.INVOICE}.pdf">{f.INVOICE}</a></td>
				<td class="text-center">{f.USERNAME} ({f.USER_ID})</td>
				<td class="text-center">{f.PRICE}</td>
				<td class="text-center">{CURRENCY}</td>
			</tr>
			<!-- END f -->
		</table>
		<div class="form-group text-right">
			<!-- IF INVOICE_SYSTEM === 0 --><button type="submit" name="zip" value="1" class="btn btn-warning">Generuj ZIP</button><!-- ENDIF -->
			<button type="submit" name="epp" value="1" class="btn btn-info">Generuj EPP</button>
			<button type="submit" name="delete" value="1" class="btn btn-danger" onclick="return confirm('Usunąć wybrane faktury?');">Usuń</button>
		</div>
	</form>
	<!-- ELSE -->
	<div class="alert alert-warning">Brak faktur do wyświetlenia</div>
	<!-- ENDIF -->
</div>
<script>
function do_this(){
	var checkboxes = document.getElementsByName('id[]');
	var button = document.getElementById('chkbox');
	if(button.value == 'select'){
		for (var i in checkboxes){
			checkboxes[i].checked = 'FALSE';
		}
		button.value = 'deselect'
	}else{
		for (var i in checkboxes){
			checkboxes[i].checked = '';
		}
		button.value = 'select';
	}
}
$(document).ready(function(){
	$("form").submit(function(){
		if ($('input[name="id[]"]:checkbox').filter(':checked').length < 1){
			alert("Zaznacz przynajmniej jedną pozycję.");
			return false;
		}
	});
});
</script>
