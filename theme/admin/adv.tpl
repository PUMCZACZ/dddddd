  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'adv' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=adv">Reklamy</a>
      </li>
			<li class="nav-item">
        <a class="nav-link<!-- IF OP == 'adv-positions' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=adv-positions">Pozycje reklam</a>
      </li>
    </ul>
  </div>
  <div class="card-body text-left">

		<h3>Reklama</h3>

		<!-- IF OP == 'adv' -->

		<table class="table table-striped">
			<tr>
				<th>Nazwa</th>
				<th class="text-center">Aktywny</th>
				<th>Pozycja</th>
				<th></th>
			</tr>
			<!-- BEGIN a -->
			<tr>
				<td>{a.NAME}</td>
				<td class="text-center">
					<!-- IF a.ACTIVE -->
					<a style="padding-left:5px; padding-right:5px;" title="Deaktywuj" href="{ADMIN_FILE}?op=adv&amp;func=chan-act&amp;act=0&amp;id={a.ID}"><em class="fa fa-circle"></em></a>
					<!-- ELSE -->
					<a style="padding-left:5px; padding-right:5px;" title="Aktywuj" href="{ADMIN_FILE}?op=adv&amp;func=chan-act&amp;act=1&amp;id={a.ID}"><em class="fa fa-circle-o"></em></a>
					<!-- ENDIF -->
				</td>
				<td>{a.POZYCJA}</td>
				<td class="text-center">
					<a class="btn btn-default" href="{ADMIN_FILE}?op=adv&amp;edit={a.ID}#edit">Edytuj</a>
					<a class="btn btn-default" href="{ADMIN_FILE}?op=adv&amp;func=del-com&amp;id={a.ID}">Usuń</a>
				</td>
			</tr>
			<!-- END a -->
		</table>

		<hr />

		<h4 id="edit" class="mb-3"><!-- IF EDIT -->Edycja bannera<!-- ELSE -->Dodaj nowy banner<!-- ENDIF --></h4>
		<form method="post">
			<input type="hidden" name="func" value="add-new">
			<table class="table table-striped">
				<tr>
					<th>Nazwa bannera:</th>
					<td>
						<input type="text" name="name" class="form-control" value="{NAME}" />
					</td>
				</tr>
				<!-- IF EDIT -->
				<tr>
					<th>Podgląd bannera:</th>
					<td>
						{CONTENT}
					</td>
				</tr>
				<!-- ENDIF -->
				<tr>
					<th>Kod bannera:</th>
					<td>
						<textarea name="content" class="form-control" rows="4">{CONTENT}</textarea>
					</td>
				</tr>
				<tr>
					<th>System wyświetlania:</th>
					<td>
						<div class="form-inline">
							<div class="form-group mr-2">
								<div class="input-group" style="width:250px;">
									<span class="input-group-addon">
										<label><input type="radio" name="system" value="c" class="mr-1"<!-- IF SYSTEM == 'c' || SYSTEM == '' --> checked<!-- ENDIF --> /> Czasowy:</label>
									</span>
									<input type="number" name="system_value_c" value="{SYSTEM_VALUE}" class="form-control text-center" />
									<span class="input-group-addon">dni</span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group" style="width:290px;">
									<span class="input-group-addon"><label><input type="radio" name="system" value="i" class="mr-1"<!-- IF SYSTEM == 'i' --> checked<!-- ENDIF --> />Ilościowy:</label></span>
									<input type="number" name="system_value_i" value="{SYSTEM_VALUE}" class="form-control text-center" />
									<span class="input-group-addon">wyświetleń</span>
								</div>
							</div>
					</td>
				</tr>
				<!-- IF EDIT -->
				<tr>
					<th>Statystyki:</th>
					<td>
						<!-- IF SYSTEM_VALUE == 'c' -->Ilość wyświetleń<!-- ELSE -->Czas wyświetlania<!-- ENDIF -->: <strong>{STATS_VALUE} <!-- IF SYSTEM_VALUE == 'c' -->wyświetleń<!-- ELSE -->dni<!-- ENDIF --></strong>
					</td>
				</tr>
				<!-- ENDIF -->
				<tr>
					<th>Aktywny:</th>
					<td>
						<input type="checkbox" value="1" name="active"<!-- IF ACTIVE == 1 --> checked<!-- ENDIF --> />
					</td>
				</tr>
				<tr>
					<th>Pozycja reklamy:</th>
					<td>
						<select class="form-control" name="position">
							<option value="">-- wybierz pozycję --</option>
							<!-- BEGIN ap -->
							<option value="{ap.ID}"<!-- IF POSITION == ap.ID --> selected<!-- ENDIF -->>{ap.NAME}</option>
							<!-- END ap -->
						</select>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="text-right">
						<!-- IF EDIT --><input type="hidden" name="edit" value="1" /><!-- ENDIF -->
						<input type="submit" value="<!-- IF EDIT -->Zapisz zmiany<!-- ELSE -->Dodaj reklamę<!-- ENDIF -->" class="btn btn-primary" />
					</td>
				</tr>
			</table>
		</form>

		<!-- ENDIF -->

		<!-- IF OP == 'adv-positions' -->

		<h4 class="mb-3">Pozycje Reklam</h4>

		<!-- IF FUNC == 'edit' -->
		<form method="post" action="{ADMIN_FILE}?op=adv-positions&amp;func=save-edit&amp;id={ID}">
			<table class="table table-striped">
				<tr>
					<td><input type="text" name="name" value="{NAME}" class="form-control" /></td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="id" value="{ID}" />
						<input type="submit" value="Zapisz" class="btn btn-primary" />
					</td>
				</tr>
			</table>
		</form>
		<!-- ENDIF -->

		<table class="table table-striped">
			<!-- BEGIN p -->
			<tr>
				<td>
					<div style="float:left; width:50%;">{p.NAME} (id: <strong>{p.ID}</strong>)</div>
					<div style="float:right; width:50%; text-align:right;">
						<a class="btn btn-primary" href="{ADMIN_FILE}?op=adv-positions&amp;func=edit&amp;id={p.ID}">Edytuj</a>
						<a class="btn btn-danger" href="{ADMIN_FILE}?op=adv-positions&amp;func=del&amp;id={p.ID}">Usuń</a>
				</td>
			</tr>
			<!-- END p -->
		</table>

		<h4>Nowa pozycja</h4>
		<form method="post" action="{ADMIN_FILE}?op=adv-positions&amp;func=<!-- IF ID -->save-edit&amp;id={ID}<!-- ELSE -->save-new<!-- ENDIF -->">
			<table class="table table-striped">
				<tr>
					<td>Nazwa pozycji: <input type="text" name="name" value="{NAME}" class="form-control" /></td>
				</tr>
				<tr>
					<td><input type="submit" value="<!-- IF ID -->Zapisz zmiany<!-- ELSE -->Dodaj pozycję<!-- ENDIF -->" class="btn btn-primary" /></td>
				</tr>
			</table>
		</form>

		<!-- ENDIF -->
	</div>
