<link rel="stylesheet" type="text/css" href="{SSL_URL}theme/includes/datepicker/css/bootstrap-datepicker.min.css" />

<h3>Operacje</h3>

<form method="get" class="form-inline well">
	<input type="hidden" name="op" value="operacje" />
	<div class="form-group">
		Szukaj użytkownika: <input type="text" name="uzytkownik" value="{GET_UZYTKOWNIK}" class="form-control" placeholder="ID użytkownika lub nazwa" /> <input type="submit" class="btn btn-primary" value="Szukaj" /><br />
	</div>
	<div class="form-group">
		<label>Okres</label>
		<div class="input-group date" data-provide="datepicker">
				<input type="text" name="okres_od" value="{GET_OKRES_OD}" class="form-control" placeholder="Od">
				<div class="input-group-addon">
						<span class="glyphicon glyphicon-th"></span>
				</div>
		</div>
		<div class="input-group date" data-provide="datepicker">
				<input type="text" name="okres_do" value="{GET_OKRES_DO}" class="form-control" placeholder="Do">
				<div class="input-group-addon">
						<span class="glyphicon glyphicon-th"></span>
				</div>
		</div>
	</div>
</form>

<table class="table table-striped">
	<tr>
		<th class="text-center">Nr</td>
		<th>Nazwa</td>
		<th class="text-center">Użytkownik</td>
		<th class="text-center">Aukcja</td>
		<th class="text-center">Kwota</td>
		<th class="text-center">Data</td>
	</tr>
	<form method="post" action="">
	<!-- BEGIN o -->
	<tr>
		<td class="text-center">{o.ID}</td>
		<td>{o.NAZWA_OPERACJI}</td>
		<td>{o.USERNAME} ({o.USER_ID})</td>
		<td><!-- IF o.TYTUL --><a href="funcs.php?name=przedmioty&amp;id={o.OGL_ID}">{o.TYTUL}</a><!-- ELSE -->-<!-- ENDIF --></td>
		<td class="text-right">{o.KWOTA} {WALUTA}</td>
		<td class="text-center">{o.DATA_OPERACJI}</td>
	</tr>
	<!-- END o -->
	<tr>
		<td colspan="4" class="text-right">Suma strony:</td>
		<td class="text-right">{SUMA}</td>
		<td></td>
	</form>
</table>
<!-- IF ILOSC_STRON > 1 -->
<ul class="pagination">
	<!-- BEGIN s -->
	<li><a href="{ADMIN_FILE}?op=operacje&amp;p={s.I}">{s.I_1}</a></li>
	<!-- END s -->
</ul>
<!-- ENDIF -->

<script type="text/javascript" src="{SSL_URL}theme/includes/datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="{SSL_URL}theme/includes/datepicker/locales/bootstrap-datepicker.pl.min.js"></script>
<script>
$(document).ready(function(){
     $.fn.datepicker.defaults.language = 'pl';
});

$(document).ready(function(){
     $('.datepicker').datepicker({
			 autoclose: true,
			 todayHighlight: true,
			 format: "mm/dd/yyyy"
		 });
});
</script>
