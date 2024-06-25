<!-- IF FUNC == 'add' || FUNC == 'edit' -->
<script type="text/javascript" src="theme/js/jquery.livequery.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		//$('#loader').hide();
		$('.parent').livequery('change', function() {
			$(this).nextAll('.parent').remove();
			$(this).nextAll('label').remove();
			$(this).parent().append('<img src="theme/img/loader.gif" style="float:left; margin-top:7px;" id="loader" alt="" />');
			var _this=this;
			$.post('funcs.php?name=items&file=add', {
				parent_id: $(this).val(),
			}, function(response){
				setTimeout(function(){$('#loader').remove();$(_this).parent().append(response);},400);
			});
			return false;
		});
	});
</script>
<style>
.parent{ padding:3px; width:150px; float:left; margin-right:12px;}
</style>
<!-- ENDIF -->

<div class="card-header">
	<ul class="nav nav-pills card-header-pills">
		<li class="nav-item">
			<a class="nav-link<!-- IF OP == 'items-filters' && FUNC == '' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=items-filters">Filtry</a>
		</li>
		<li class="nav-item">
			<a class="nav-link<!-- IF OP == 'items-filters' && (FUNC == 'add' || FUNC == 'edit') --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=items-filters&amp;func=add">Dodaj filtr</a>
		</li>
	</ul>
</div>
<div class="card-body">
	<h3>
		<!-- IF FUNC == 'add' -->Dodawanie filtrów<!-- ENDIF -->
		<!-- IF FUNC == 'edit' -->Edycja filtrów<!-- ENDIF -->
		<!-- IF FUNC == '' -->Lista filtrów<!-- ENDIF -->
	</h3>
</div>

<!-- IF FUNC == 'add' || FUNC == 'edit' -->
<form method="post">
<table class="table table-striped">
	<tr>
		<th>Kategoria</th>
		<td class="form-inline">
			<!-- BEGIN cl -->
			<select name="cat_id[]" class="form-control parent" required>
				<option value="0">-- wszystkie --</option>
				<!-- BEGIN c -->
				<option value="{c.ID}"<!-- IF c.SELECTED --> selected<!-- ENDIF -->>{c.NAME}</option>
				<!-- END c -->
			</select>
			<!-- END cl -->
		</td>
	</tr>
	<tr>
		<th>Nazwa</th>
		<td><input type="text" name="name" class="form-control" value="{NAME}" /></td>
	</tr>
	<tr>
		<th>Oznaczenie</th>
		<td class="form-inline">
			Lewe: <input type="text" name="mark_l" value="{MARK_L}" class="form-control mx-1" maxlength="4" />
			Prawe: <input type="text" name="mark_r" value="{MARK_R}" class="form-control mx-1" maxlength="4" />
		</td>
	</tr>
	<tr>
		<th>Typ pola</th>
		<td class="form-inline">
			<select name="type" class="form-control mx-1" id="type">
				<option value="t"<!-- IF TYPE == 't' --> selected<!-- ENDIF -->>Text</option>
				<option value="ch"<!-- IF TYPE == 'ch' --> selected<!-- ENDIF -->>Checkbox</option>
				<option value="s"<!-- IF TYPE == 's' --> selected<!-- ENDIF -->>Select</option>
				<option value="ft"<!-- IF TYPE == 'ft' --> selected<!-- ENDIF -->>Od - do</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>
			<strong>Lista parametrów</strong><br />
			<font class="tiny">
				(* nie dotyczy przy wuborze pola typu 'Text')<br />
				(* każdy parametr w nowym wierszu)
			</font>
		</td>
		<td>
			<!-- IF FUNC == 'edit' -->
			<!-- BEGIN filters -->
			<p class="form-inline">
				<input type="text" name="old_filters[{filters.ID}]" class="form-control mr-3" id="textListActive" value="{filters.PARAMETER}"<!-- IF TYPE == 't' || TYPE == 'ft' --> disabled<!-- ENDIF --> />
				<input type="checkbox" name="delete-param[]" value="{filters.ID}" /> usuń
			</p>
			<!-- END filters -->
			<!-- ENDIF -->
			<p class="form-inline"><textarea name="filters" id="textList" class="form-control" rows="8" disabled placeholder="Nowe filtry"></textarea></p>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<input type="submit" name="save" value="Zapisz >>" class="btn btn-primary" />
			<!-- IF FUNC == 'edit' -->
			<input type="hidden" name="f_id" value="{F_ID}" />
			<!-- ENDIF -->
		</td>
	</tr>
</table>
<script>
document.getElementById('type').addEventListener('change', function() {
  if (this.value == 'ch' || this.value == 's') {
    document.getElementById('textList').disabled = false;
  } else {
    document.getElementById('textList').disabled = true;
  }
});
</script>
</form>

<!-- ELSE -->

<form method="post" class="mx-3">
	<table class="table table-striped table-hover">
		<tr>
			<th style="width:30px; text-align:center;">ID</th>
			<th>Nazwa</th>
			<th>Kategoria</th>
			<th>Typ</th>
			<th class="text-center">Pozycja</th>
			<th class="text-center">Wymagany</th>
			<th style="width:100px;"></td>
			<th style="width:100px; text-align:center;">Usuń</th>
		</tr>
		<!-- BEGIN filters -->
		<tr>
			<td style="text-align:center;">{filters.F_ID}</td>
			<td>{filters.NAME}</td>
			<td><!-- IF filters.CAT_NAME -->{filters.CAT_NAME}<!-- ELSE -->Wszystkie<!-- ENDIF --></td>
			<td class="text-center">
				<!-- IF filters.TYPE == 't' -->Tekst
				<!-- ELSEIF filters.TYPE == 'ch' -->Checkbox
				<!-- ELSEIF filters.TYPE == 's' -->Select
				<!-- ELSEIF filters.TYPE == 'ft' -->Od-do<!-- ENDIF -->
			</td>
			<td class="text-center">
				<input type="number" name="position[{filters.F_ID}]" class="form-control text-center" value="{filters.POSITION}" style="width:80px; display:inline;" />
				<input type="hidden" name="f_id[]" value="{filters.F_ID}" />
			</td>
			<td class="text-center">
				<input type="checkbox" name="required[{filters.F_ID}]" value="1"<!-- IF filters.REQUIRED == 1 --> checked<!-- ENDIF --> />
			</td>
			<td style="text-align:center;"><a href="{ADMIN_FILE}?op=items-filters&amp;func=edit&amp;f_id={filters.F_ID}">Edycja</a></td>
			<td style="text-align:center;"><input type="checkbox" name="delete[]" value="{filters.F_ID}" /></td>
		</tr>
		<!-- END filters -->
		<tr>
			<td colspan="8" class="text-right"><input type="submit" name="update" value="Zapisz >>" class="btn btn-primary" /></td>
		</tr>
	</table>
	<div class="text-center">
		<ul class="pagination">
			{PAGER}
		</ul>
	</div>
</form>
<!-- ENDIF -->
