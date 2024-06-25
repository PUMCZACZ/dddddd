<div class="card-header">
	<ul class="nav nav-pills card-header-pills">
		<li class="nav-item"><a class="nav-link<!-- IF OP == 'emailing' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=emailing">Emailing do użytkowników</a></li>
		<li class="nav-item"><a class="nav-link<!-- IF OP == 'emailing-planning' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=emailing-planning">Zaplanowany emailing</a></li>
		<li class="nav-item"><a class="nav-link<!-- IF OP == 'emailing-sended' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=emailing-sended">Wysłany emailing</a></li>
		<li class="nav-item"><a class="nav-link<!-- IF OP == 'emailing-themes' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=emailing-themes">Szablony</a></li>
	</ul>
</div>
<div class="card-body">

	<!-- IF OP == 'emailing' -->
	<h3>Emailing do użytkowników</h3>
	<!-- ELSEIF OP == 'emailing-planning' -->
	<h3>Zaplanowany emailing</h3>
	<!-- ELSEIF OP == 'emailing-sended' -->
	<h3>Wysłany emailing</h3>
	<!-- ELSEIF OP == 'emailing-themes' -->
	<h3>Szablony</h3>
	<!-- ENDIF -->

	<!-- IF OP == 'emailing-themes' -->
	<table class="table table-striped">
		<!-- BEGIN et -->
		<tr>
			<td>{et.NAME}</td>
			<td class="text-right">
				<a class="btn btn-secondary" href="{ADMIN_FILE}?op=emailing&amp;theme={et.ID}">Użyj</a>
				<a class="btn btn-primary" href="{ADMIN_FILE}?op=emailing-themes&amp;edit={et.ID}">Edytuj</a>
				<a class="btn btn-danger" href="{ADMIN_FILE}?op=emailing-themes&amp;delete={et.ID}" onclick="return confirm('Usuną pozycję?');">Usuń</a>
			</td>
		</tr>
		<!-- END et -->
	</table>
	<h4><!-- IF EDIT -->Edycja szablonu<!-- ELSE -->Nowy szablon<!-- ENDIF --></h4>
	<form method="post">
		<table class="table table-striped">
			<tr>
				<td>Nazwa: <input type="text" name="name" value="{NAME}" class="form-control" /></td>
			</tr>
			<tr>
				<td>Szablon: <textarea name="content" class="form-control">{CONTENT}</textarea></td>
			</tr>
			<tr>
				<td class="text-right">
					<!-- IF EDIT -->
					<input type="hidden" name="id" value="{ID}" />
					<button type="submit" name="save" value="1" class="btn btn-primary">Zapisz</button>
					<!-- ELSE -->
					<button type="submit" name="add" value="1" class="btn btn-primary">Dodaj</button>
					<!-- ENDIF -->
				</td>
			</tr>
		</table>
	</form>
	<script src="//cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
	<script>
	  CKEDITOR.replace('content', {
	    height: '350px',
	  });
	</script>
	<!-- ELSEIF OP == 'emailing' || OP == 'emailing-edit' -->
	<form method="post" action="{ADMIN_FILE}?op=emailing">
	<table class="table table-striped">
		<tr>
			<td>
				<strong>Tytuł wiadomości</strong><br />
				<input type="text" name="title" value="{TITLE}" class="form-control" required />
			</td>
		</tr>
		<tr>
			<td>
				<strong>Język użytkownika</strong></br />
				<select name="lang" class="form-control">
					<!-- BEGIN langs -->
					<option value="{langs.NAME_DEF}"<!-- IF LANG == langs.NAME_DEF --> selected<!-- ENDIF -->>{langs.NAME}</option>
					<!-- END langs -->
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Abonament</strong><br />
				<div class="row">
					<div class="col-2">
						Aktywny<br />
						<select name="member_active" class="form-control">
							<option value="">-- wybierz</option>
							<option value="1"<!-- IF MEMBER_ACTIVE == 1 --> selected<!-- ENDIF -->>Tak</option>
							<option value="2"<!-- IF MEMBER_ACTIVE == 2 --> selected<!-- ENDIF -->>Nie</option>
							<option value="3"<!-- IF MEMBER_ACTIVE == 3 --> selected<!-- ENDIF -->>Nigdy nieaktywny</option>
						</select>
					</div>
					<div class="col-3">
						Pakiet<br />
						<select name="member_id" class="form-control">
							<option value="">-- wybierz</option>
							<!-- BEGIN m -->
							<option value="{m.ID}"<!-- IF MEMBER_ID == m.ID --> selected<!-- ENDIF -->>{m.NAME}</option>
							<!-- END m -->
						</select>
					</div>
					<div class="col-3">
						Wygasły<br />
						<div class="form-inline">
							<div class="form-group">
								<label>od</label>
								<input type="date" name="member_end_from" value="{MEMBER_END_FROM}" class="form-control" />
								<label>do</label>
								<input type="date" name="member_end_to" value="{MEMBER_END_TO}" class="form-control" />
							</div>
						</div>
					</div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Ogłoszenia aktywne</strong><br />
				<div class="form-inline">
					<select name="items_active" class="form-control">
						<option value="">-- wybierz --</option>
						<option value="1">z aktywnymi ogłoszeniami</option>
						<option value="2">bez aktywnych ogłoszeń</option>
					</select>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Data Logowania</strong><br />
				<div class="row">
					<div class="col-4">
						<div class="form-inline">
							<div class="form-group">
								<label>od</label>
								<input type="date" name="member_login_date_from" value="{MEMBER_LOGIN_DATE_FROM}" class="form-control" />
								<label>do</label>
								<input type="date" name="member_login_date_to" value="{MEMBER_LOGIN_DATE_TO}" class="form-control" />
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Data Rejestracji</strong><br />
				<div class="row">
					<div class="col-4">
						<div class="form-inline">
							<div class="form-group">
								<label>od</label>
								<input type="date" name="member_reg_date_from" value="{MEMBER_REG_DATE_FROM}" class="form-control" />
								<label>do</label>
								<input type="date" name="member_reg_date_to" value="{MEMBER_REG_DATE_TO}" class="form-control" />
							</div>
						</div>
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<strong>Data wysyłki:</strong><br />
				<div class="form-inline">
					<div class="form-group">
						<label class="mr-2"><input type="radio" name="send_time_type" value="1"<!-- IF SEND_TIME_TYPE == 1 || SEND_TIME_TYPE == '' --> checked<!-- ENDIF --> /> Teraz</label>
						<label class="mr-2"><input type="radio" name="send_time_type" value="2"<!-- IF SEND_TIME_TYPE == 2 --> checked<!-- ENDIF --> /> Inny termin:</label>
						<input type="datetime-local" name="send_time" value="{SEND_TIME}" placeholder="RRRR-MM-DD GG:MM" class="form-control" />
					</div>
				</div>
			</td>
		</tr>
		<tr>
			<td>
				<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#help">Instrukcja zmiennych</button>
				<strong>Treść</strong><br />
				<textarea style="height:300px;" name="message" required>{MESSAGE}</textarea>
				<script>
					CKEDITOR.replace('message');
				</script>
			</td>
		</tr>
		<tr>
			<td>
				<div class="form-inline">
					<!-- IF OP == 'emailing-edit' -->
					<input type="submit" name="save" class="btn btn-primary" value="Zapisz zmiany" />
					<input type="hidden" name="id" value="{ID}" />
					<!-- ELSE -->
					<input type="submit" name="send" class="btn btn-primary" value="Wyślij wiadomość" />
					<!-- ENDIF -->
					<input type="submit" name="save-file" class="ml-2 btn btn-success" value="Zapisz adresy email do pliku" />
					<!--
					<span class="px-2">lub</span>
					<input type="submit" name="test" value="Wyślij wiadomość testową" class="btn btn-warning" />
					<span class="px-2">na adres</span><input type="email" name="test_email" class="form-control" />
					-->
				</div>
			</td>
		</tr>
	</table>
	</form>

	<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Instrukcja zmiennych</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p>Zmienne należy umieścić w nawiasach { }</p>
					<p>
						USERNAME - nazwa użytkownika,<br />
						USER_EMAIL - e-mail użytkownika<br />
						COMPANY_NAME - nazwa firmy<br />
					</p>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- ELSEIF OP == 'emailing-planning' || OP == 'emailing-sended' -->

	<form method="post">
	<table class="table table-striped">
		<tr>
			<th class="text-center"></th>
			<th class="text-center">ID</th>
			<th>Tytuł</th>
			<th>Język</th>
			<th>Abonament</th>
			<th>Wysyłka</th>
			<th>Data dodania</th>
			<th class="text-center"></th>
		</tr>
		<!-- BEGIN e -->
		<tr>
			<td class="text-center"><input type="checkbox" name="id[]" value="{e.ID}" /></td>
			<td class="text-center">{e.ID}</td>
			<td>{e.TITLE}</td>
			<td>{e.LANG}</td>
			<td>
				Aktywny: <!-- IF e.MEMBER_ACTIVE == 1 -->Tak<!-- ELSE -->Nie<!-- ENDIF --><br />
				Pakiet: {e.MEMBER_ID}
			</td>
			<td>{e.SEND_TIME}</td>
			<td>{e.DATE}</td>
			<td class="text-center"><a href="{ADMIN_FILE}?op=emailing-edit&amp;id={e.ID}">Edytuj</a></td>
		</tr>
		<!-- END e -->
		<tr>
			<td colspan="8" class="text-right"><button type="submit" name="delete" value="1" class="btn btn-danger" onclick="return confirm('Usunąć wybrane pozycje?');"><em class="fa fa-trash"></em> Usuń</button></td>
		</tr>
	</table>
	</form>
	<!-- ENDIF -->
</div>
