  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'user' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=user">Użytkownicy</a>
      </li>
    </ul>
  </div>
  <div class="card-body">

<!-- IF OP == 'user' -->
<h3>Użytkownicy</h3>
<form method="post" action="{ADMIN_FILE}?op=user">
<table class="table table-striped table-hover">
	<tr>
		<th>Wyszukiwanie użytkownika:</th>
		<td>
			<select name="search-type" class="form-control">
				<option value="username"<!-- IF SEARCH-TYPE == 'username' --> selected<!-- ENDIF -->>Nazwa użytkownika</option>
				<option value="user_id"<!-- IF SEARCH-TYPE == 'user_id' --> selected<!-- ENDIF -->>ID użytkownika</option>
				<option value="user_email"<!-- IF SEARCH-TYPE == 'user_email' --> selected<!-- ENDIF -->>Adres email</option>
				<option value="name"<!-- IF SEARCH-TYPE == 'name' --> selected<!-- ENDIF -->>Imię</option>
				<option value="city"<!-- IF SEARCH-TYPE == 'city' --> selected<!-- ENDIF -->>Miejscowość</option>
			</select>
		</td>
		<td>
			<input type="text" name="query" value="{QUERY}" class="form-control" />
		</td>
		<td>
			<input type="submit" name="search" value="Szukaj" class="btn btn-primary" />
		</td>
	</tr>
</table>
</form>
<hr />

<div class="btn-group btn-group-toggle mb-3">
  <a href="admin-panel.php?op=user" class="btn btn-light<!-- IF STATUS === false && ONLINE == '' --> active<!-- ENDIF -->">Wszyscy ({STATS_ALL})</a>
  <a href="admin-panel.php?op=user&amp;search=1&amp;status=1" class="btn btn-success<!-- IF STATUS === 1 --> active<!-- ENDIF -->">Aktywni ({STATS_ACTIVE})</a>
  <a href="admin-panel.php?op=user&amp;search=1&amp;status=0" class="btn btn-info<!-- IF STATUS === 0 --> active<!-- ENDIF -->">Niepotwierdzeni ({STATS_UNACTIVE})</a>
  <a href="admin-panel.php?op=user&amp;search=1&amp;status=2" class="btn btn-warning<!-- IF STATUS === 2 --> active<!-- ENDIF -->">Zawieszeni ({STATS_SUSPENDED})</a>
  <a href="admin-panel.php?op=user&amp;search=1&amp;status=3" class="btn btn-danger<!-- IF STATUS === 3 --> active<!-- ENDIF -->">Usunięci ({STATS_DELETED})</a>
  <a href="admin-panel.php?op=user&amp;search=1&amp;veryfi=1" class="btn btn-info<!-- IF VERYFI === 1 --> active<!-- ENDIF -->">Zweryfikowani ({STATS_VERYFI})</a>
  <a href="admin-panel.php?op=user&amp;search=1&amp;veryfi=0" class="btn btn-primary<!-- IF VERYFI === 0 --> active<!-- ENDIF -->">Niezweryfikowani ({STATS_UNVERYFI})</a>
  <a href="admin-panel.php?op=user&amp;search=1&amp;veryfi_waiting=1" class="btn btn-dark<!-- IF VERYFI_WAITING --> active<!-- ENDIF -->">Oczekujący na weryfikację ({STATS_UNVERYFI_WAITING})</a>
</div>

<!-- IF .usr -->
<form method="POST">
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th scope="col" class="text-center">ID</th>
			<th scope="col">Użytkownik</th>
			<th scope="col">Status</th>
			<th scope="col">Informacje</th>
      <th scope="col" class="text-center">Zweryfikowany</th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>
	<!-- BEGIN usr -->
	<tr  class="<!-- IF usr.STATUS == 3 -->table-danger<!-- ELSEIF usr.STATUS == 0 -->table-info<!-- ELSEIF usr.STATUS == 2 -->table-warning<!-- ENDIF -->">
		<td scope="row" class="text-center">
			{usr.USER_ID}
			<input type="hidden" name="update_user_id[]" value="{usr.USER_ID}">
		</td>
		<td>
			<!-- IF usr.USERNAME -->{usr.USERNAME}<!-- ELSE -->{usr.USER_EMAIL}<!-- ENDIF --><!-- IF usr.STATUS == 3 --> <span class="badge badge-danger">Konto usunięte</span><!-- ENDIF -->
			<div class="tiny text-nowrap">{usr.NAME}<!-- IF usr.GENDER == 'p' --> &amp; {usr.NAME2}<!-- ENDIF --></div>
      <span class="badge badge-<!-- IF usr.U_TYPE == 'business' -->info<!-- ELSE -->light<!-- ENDIF --> text-uppercase">konto <!-- IF usr.U_TYPE == 'business' -->firmowe<!-- ELSE -->zwykłe<!-- ENDIF --></span>
		</td>
		<td class="text-<!-- IF usr.STATUS == 0 -->info<!-- ELSEIF usr.STATUS == 1 -->success<!-- ELSEIF usr.STATUS == 2 -->warning<!-- ELSEIF usr.STATUS == 3 -->danger<!-- ENDIF -->">
      <em class="fa fa-<!-- IF usr.STATUS == 0 -->envelope-o<!-- ELSEIF usr.STATUS == 1 -->check-circle<!-- ELSEIF usr.STATUS == 2 -->exclamation-triangle<!-- ELSEIF usr.STATUS == 3 -->ban<!-- ENDIF -->"></em>
      {usr.STATUS_TXT}
    </td>
		<td>
			Ostatnie logowanie: {usr.DATE_LOGIN}<br />
			Abonament: <!-- IF usr.PREMIUM --><span class="text-success">Tak ({usr.MEMBER_NAME}, {usr.MEMBER_TIME})</span><!-- ELSE -->Brak<!-- ENDIF -->
		</td>
    <td class="text-center">
      <!-- IF usr.VERYFI -->
      <span class="text-success"><em class="fa fa-check"></em> Tak ({usr.VERYFI})</span>
      <!-- ELSE -->
      <span class="text-danger"><em class="fa fa-ban"></em> Nie</span><br />
      <span class="text-uppercase"><small>Wniosek:</small></span>
      <!-- IF usr.APP_STATUS == '0' -->
      <span class="badge badge-info text-uppercase">Oczekuje</span>
      <!-- ELSEIF usr.APP_STATUS == '2' -->
      <span class="badge badge-warning text-uppercase">Odrzucony</span>
      <!-- ELSE -->
      <span class="badge badge-secondary text-uppercase">Brak</span>
      <!-- ENDIF -->
      <!-- ENDIF -->
    </td>
		<td style="text-align:center;"><a target="_edituser" href="{ADMIN_FILE}?op=user-edit&amp;id={usr.USER_ID}">Edytuj</a></td>
	</tr>
	<!-- END usr -->
</tbody>
</table>
<!-- IF PAGINATION -->
<nav aria-label="Page navigation example" class="text-center">
  <ul class="pagination justify-content-center">
    {PAGINATION}
  </ul>
</nav>
<!-- ENDIF -->
</form>

<!-- ELSE -->
<div id="error_box">Brak użytkowników spełniającyh twoje kryteria</div>
<!-- ENDIF -->

<!-- ELSEIF OP == 'user-edit' -->
<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link<!-- IF TAB == '' || TAB == 'user' --> active<!-- ENDIF -->" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true">Dane użytkownika</a>
  </li>
  <li class="nav-item">
    <a target="_blank" href="{ADMIN_FILE}?op=items&amp;search-type=username&amp;query={USERNAME}&amp;search=1" class="nav-link">Ogłoszenia</a>
  </li>
  <li class="nav-item">
    <a class="nav-link<!-- IF TAB == 'photos' --> active<!-- ENDIF -->" id="photos-tab" data-toggle="tab" href="#photos" role="tab" aria-controls="photos" aria-selected="false">Zdjęcia</a>
  </li>
  <li class="nav-item">
    <a class="nav-link<!-- IF TAB == 'member' --> active<!-- ENDIF -->" id="member-tab" data-toggle="tab" href="#member" role="tab" aria-controls="photos" aria-selected="false">Abonament</a>
  </li>
  <li class="nav-item">
    <a class="nav-link<!-- IF TAB == 'invoices' --> active<!-- ENDIF -->" id="invoices-tab" data-toggle="tab" href="#invoices" role="tab" aria-controls="invoices" aria-selected="false">Faktury</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade <!-- IF TAB == '' || TAB == 'user' -->show active<!-- ENDIF -->" id="user" role="tabpanel" aria-labelledby="user-tab">
		<form method="post">
			<h3>Edycja użytkownika '{USERNAME}' - {COMPANY_NAME}</h3>
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<table class="table table-striped table-hover mt-3">
						<tr>
							<th>ID</th>
							<td>
								{USER_ID}
								<a class="btn btn-warning btn-sm float-right" href="{ADMIN_FILE}?op=user-edit&amp;id={USER_ID}&amp;log-in-user=1"><em class="fa fa-unlock-alt"></em> Zaloguj na konto użytkownika</a>
							</th>
						</tr>
						<tr>
							<th class="text-nowrap">Nazwa użytkownika</th>
							<td class="form-inline"><input type="text" name="username" value="{USERNAME}" class="form-control" /></td>
						</tr>
						<tr>
							<th>Imię</th>
							<td class="form-inline">
								<input type="text" name="u_name" value="{NAME}" class="form-control mr-3" />
							</td>
						</tr>
						<tr>
							<th>Adres e-mail</th>
							<td class="form-inline">
								<input type="text" name="user_email" value="{USER_EMAIL}" class="form-control" />
							</td>
						</tr>
            <tr>
							<th>Aktywacyjny adres e-mail</th>
							<td class="form-inline">
								<input type="text" value="{USER_EMAIL_MAIN}" disabled class="form-control" />
							</td>
						</tr>
            <tr>
							<th>Nazwa firmy</th>
							<td class="form-inline"><input type="text" name="company_name" value="{COMPANY_NAME}" class="form-control" /></td>
						</tr>
            <tr>
							<th>NIP</th>
							<td class="form-inline"><input type="text" name="nip" value="{NIP}" class="form-control" /></td>
						</tr>
            <tr>
							<th>REGON</th>
							<td class="form-inline"><input type="text" name="regon" value="{REGON}" class="form-control" /></td>
						</tr>
						<tr>
							<th>Miejscowość</th>
							<td class="form-inline"><input type="text" name="city" value="{CITY}" class="form-control" /></td>
						</tr>
            <tr>
							<th>Kod pocztowy</th>
							<td class="form-inline"><input type="text" name="post_code" value="{POST_CODE}" class="form-control" /></td>
						</tr>
            <tr>
							<th>Adres</th>
							<td class="form-inline"><input type="text" name="street" value="{STREET}" class="form-control" /></td>
						</tr>
            <tr>
							<th>Kraj</th>
							<td class="form-inline"><input type="text" name="country" value="{COUNTRY}" class="form-control" /></td>
						</tr>
            <!-- BEGIN desc_langs -->
						<tr>
							<th>Opis {desc_langs.NAME}</th>
							<td><textarea name="company_desc_{desc_langs.NAME_DEF}" class="form-control" rows="5">{desc_langs.COMPANY_DESC}</textarea></td>
						</tr>
            <!-- END desc_langs -->
            <tr>
              <th>Telefon</th>
              <td>
                <input type="text" name="phone" value="{PHONE}" class="form-control">
              </td>
            </tr>
            <tr>
              <th>Strona WWW</th>
              <td>
                <input type="url" name="website" value="{WEBSITE}" class="form-control">
              </td>
            </tr>
            <tr>
							<th>Media społecznościowe</th>
							<td>
                <div class="form-group">
                  <input type="text" name="social_fb" value="{SOCIAL_FB}" class="form-control" />
                </div>
                <div class="form-group">
                  <input type="text" name="social_insta" value="{SOCIAL_INSTA}" class="form-control" />
                </div>
              </td>
						</tr>
					</table>
				</div>
				<div class="col-md-6 col-xs-12">
					<table class="table table-striped table-hover mt-3 mb-5">
            <tr>
							<th class="text-nowrap">Weryfikacja</th>
							<td>
                <div class="form-group">
                  <label>Data weryfikacji</label>
                  <input type="text" name="veryfi" value="{VERYFI}" class="form-control" placeholder="DD-MM-RRRR" maxlength="10" />
                </div>
                <!-- IF .veryfi_app -->
                <div class="form-group">
                  <label>Status:</label>
                  <div class="input-group">
                    <label class="mr-2"><input type="radio" name="veryfi_status" value="1"<!-- IF VERYFI_STATUS == '1' --> checked<!-- ENDIF --> /> Zweryfikowany</label>
                    <label class="mr-2"><input type="radio" name="veryfi_status" value="0"<!-- IF VERYFI_STATUS == '0' --> checked<!-- ENDIF --> /> Niezweryfikowany</label>
                    <label><input type="radio" name="veryfi_status" value="2"<!-- IF VERYFI_STATUS == '2' --> checked<!-- ENDIF --> /> Odrzucony</label>
                  </div>
                </div>
                <div class="form-group">
                  <label>Otrzymane pliki:</label>
                  <ul class="list list-unstyled">
                    <!-- BEGIN veryfi_app -->
                    <li><a target="_blank" href="{veryfi_app.HREF}">{veryfi_app.NAME}</a></li>
                    <!-- END veryfi_app -->
                  </ul>
                  <!-- ENDIF -->
                </div>
                <!-- IF VERYFI_COMMENT -->
                <div class="form-group">
                  <label>Komentarz:</label>
                  <p>{VERYFI_COMMENT}</p>
                </div>
                <!-- ENDIF -->
              </th>
						</tr>
            <tr>
              <th>Avatar</th>
              <td>
                <!-- IF AVATAR -->
                <img class="w-50 mw-100" src="{AVATAR}" />
                <button type="submit" name="delete-avatar" value="1" class="btn btn-danger"><em class="fa fa-trash"></em></button>
                <!-- ELSE -->
                <!-- ENDIF -->
              </td>
            </tr>
						<tr>
							<th class="text-nowrap">Data ostatniego logowania</th>
							<td>{DATE_LOGIN}</th>
						</tr>
						<tr>
							<th class="text-nowrap">Ostatnie IP</th>
							<td>{IP_LAST}</th>
						</tr>
						<tr>
							<th class="text-nowrap">Data rejestracji</th>
							<td>{DATE_REG}</th>
						</tr>
						<tr>
							<th class="text-nowrap">Premium</th>
							<td><!-- IF PREMIUM --><span class="text-success">Tak ({MEMBER_NAME}, {MEMBER_TIME})</span><!-- ELSE -->Brak<!-- ENDIF --></th>
						</tr>
						<tr>
							<th>Status</th>
							<td>
								<select name="status" class="form-control">
									<option value="0"<!-- IF STATUS == 0 --> selected<!-- ENDIF -->>Konto niepotwierdzone</option>
									<option value="1"<!-- IF STATUS == 1 --> selected<!-- ENDIF -->>Konto aktywne</option>
									<option value="2"<!-- IF STATUS == 2 --> selected<!-- ENDIF -->>Konto zawieszone</option>
								</select>
							</td>
						</tr>
            <!--
						<tr>
							<th>Nowe hasło</th>
							<td><input type="password" name="new_pass" class="form-control" /></td>
						</tr>
						<tr>
							<th>Potwierdź nowe hasło</th>
							<td><input type="password" name="new_pass2" class="form-control" /></td>
						</tr> -->
					</table>
					<hr />
					<table class="table table-striped table-hover mt-5">
						<tr class="table-danger">
							<th>Usuń konto</th>
							<td><input type="checkbox" name="delete" value="{USER_ID}" onclick="return confirm('Na pewno usunąć użytkownika?');" /></th>
						</tr>
					</table>
				</div>
			</div>
			<div class="form-group text-right">
				<button type="submit" name="save-changes" value="1" class="btn btn-primary">Zapisz zmiany</button>
				<input type="hidden" name="user_id" value="{USER_ID}" />
			</div>
		</form>
	</div>
	<div class="tab-pane fade<!-- IF TAB == 'photos' --> show active<!-- ENDIF -->" id="photos" role="tabpanel" aria-labelledby="photos-tab">
		<form method="post">
		<h3>Zdjęcia użytkownika '{USERNAME}'</h3>
			<ul class="list list-inline">
				<!-- BEGIN up -->
				<li class="list-inline-item text-center align-top pb-3" style="width:19%">
					<img class="w-100" src="{up.IMAGE}" /><br />
          <a class="btn btn-danger mt-2" href="{ADMIN_FILE}?op=user-edit&amp;id={USER_ID}&amp;delete-photo={up.ID}"><em class="fa fa-trash"></em></a>
				</li>
				<!-- END up -->
			</ul>
			<div class="form-group text-right">
				<button type="submit" name="photos-delete" value="1" class="btn btn-danger">Usuń zdjęcia</button>
			</div>
		</form>
	</div>
  <div class="tab-pane fade<!-- IF TAB == 'member' --> show active<!-- ENDIF -->" id="member" role="tabpanel" aria-labelledby="photos-tab">
		<form method="post">
      <h3>Abonament użytkownika</h3>
			<table class="table table-striped">
        <tr>
          <th></th>
          <th>Pakiet</th>
          <th>Czas trwania</th>
          <th>Cena</th>
          <th>Data aktywacji</th>
          <th>Data zakończenia</th>
          <th></th>
        </tr>
        <!-- BEGIN um -->
        <tr>
          <td><input type="checkbox" name="id[]" value="{um.ID}" /></td>
          <td>{um.NAME}</td>
          <td>{um.TIME} dni</td>
          <td>{um.PRICE} {CURRENCY}</td>
          <td>{um.DATE}</td>
          <td>{um.DATE_END}</td>
          <td class="text-center">
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#member-{um.ID}">$ Zmień cenę</button>
            <button type="submit" name="invoice-create" value="{um.ID}" class="btn btn-success"><i class="fa fa-file-o"></i> Wystaw fakturę</button>
          </td>
        </tr>
        <!-- END  um -->
      </table>
      <p class="text-right"><button type="submit" name="delete-member" value="1" class="btn btn-danger">Usuń</button></p>
      <hr />
      <h5>Aktywacja abonamentu dla użytkownika</h5>
      <div class="form-group">
        <div class="form-inline">
          <select name="m_id" class="form-control mr-2">
            <option value="">-- wybierz --</option>
            <!-- BEGIN m -->
            <optgroup label="{m.NAME}">
              <!-- BEGIN mp -->
              <option value="{mp.ID}">{mp.TIME} miesięcy</option>
              <!-- END mp -->
            </optgroup>
            <!-- END m -->
          </select>
          <button type="submit" name="activate" value="1" class="btn btn-primary">Aktywuj</button>
        </div>
      </div>
		</form>
	</div>

  <!-- BEGIN um -->
  <div class="modal fade" id="member-{um.ID}" tabindex="-1" role="dialog" aria-labelledby="modal-{um.ID}" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="post" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edycja ceny dla pozycji '{um.NAME} - {um.TIME} dni'</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input class="form-control" type="number" step="any" name="member-price[{um.ID}]" value="{um.PRICE}" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="member-price-save" value="1" class="btn btn-primary">Zapisz zmiany</button>
        </div>
      </form>
    </div>
  </div>
  <!-- END um -->

  <div class="tab-pane fade<!-- IF TAB == 'invoices' --> show active<!-- ENDIF -->" id="invoices" role="tabpanel" aria-labelledby="invoices-tab">
		<form method="post">
      <h3>Faktury użytkownika</h3>
			<table class="table table-striped">
        <tr>
          <th></th>
          <th>Numer faktury</th>
          <th>Cena</th>
          <th>Data wystawienia</th>
          <th></th>
        </tr>
        <!-- BEGIN i -->
        <tr>
    			<td class="align-middle">{i.INVOICE}</td>
    			<td class="text-right align-middle">{i.PRICE} {CURRENCY}</td>
    			<td class="text-center align-middle">{i.DATE}</td>
    			<td class="text-center align-middle"><a class="btn btn-primary" href="funcs.php?name=user&amp;file=payments&amp;dwnl={i.ID}">Pobierz</a></td>
    		</tr>
        <!-- END  i -->
      </table>
		</form>
	</div>
</div>
<!-- ENDIF -->
<!-- IF OP == 'user-photos' -->
<h3>Zdjęcia do weryfikacji</h3>
<form method="post">
<table class="table table-striped table-hover">
	<tr>
		<th>Nr</th>
		<th>Zdjęcie</th>
		<th>Dane</th>
		<th class="text-center">Zatwierdź</th>
		<th class="text-center">Usuń</th>
	</tr>
	<!-- BEGIN p -->
	<tr>
		<td class="text-center">{p.NO}</td>
		<td class="text-center" style="width:19%"><img class="w-50" src="{p.PIC_SRC}" /></td>
		<td>
			{p.USERNAME} (ID: {p.USER_ID})<br />
			Data dodania: {p.DATE}
		</td>
		<td class="text-center table-success align-middle">
			<label style="background:#FFF; padding:20px; border-radius:30px;"><input type="radio" name="action[{p.ID}]" value="approve" /></label>
		</td>
		<td class="text-center table-danger align-middle">
			<label style="background:#FFF; padding:20px; border-radius:30px;"><input type="radio" name="action[{p.ID}]" value="delete" /></label>
			<input type="hidden" name="p_id[]" value="{p.ID}" />
		</td>
	</tr>
	<!-- END p -->
	<tr>
		<td colspan="5" class="text-right"><button type="submit" name="save" value="1" class="btn btn-primary">Zapisz</button></td>
	</tr>
</table>
<!-- ENDIF -->

</div>

<script type="text/javascript">
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
</script>
