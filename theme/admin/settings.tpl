  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'settings' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=settings">Serwis</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'settings-items' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=settings-items">Ogłoszenia</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'settings-member' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=settings-member">Abonament</a>
      </li>
			<li class="nav-item">
        <a class="nav-link<!-- IF OP == 'settings-prices' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=settings-prices">Płatności</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'settings-mail' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=settings-mail">Poczta</a>
      </li>
			<li class="nav-item">
				<a class="nav-link<!-- IF OP == 'settings-session' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=settings-session">Sesje</a>
			</li>
    </ul>
  </div>
  <div class="card-body">
		<!-- IF OP == 'settings' -->
		<h3>Ustawienia serwisu</h3>
    <!-- ELSEIF OP == 'settings-items' -->
		<h3>Ustawienia ogłoszeń</h3>
    <!-- ELSEIF OP == 'settings-member' -->
		<h3>Ustawienia abonamentu</h3>
		<!-- ELSEIF OP == 'settings-mail' -->
		<h3>Ustawienia poczty</h3>
		<!-- ELSEIF OP == 'settings-session' -->
		<h3>Ustawienia sesji</h3>
		<!-- ELSEIF OP == 'settings-prices' -->
		<h3>Ustawienia płatności</h3>
		<!-- ENDIF -->
		<form method="post" enctype="multipart/form-data">
		<table class="table table-striped">

			<!-- IF OP == 'settings' -->
			<tr>
				<th style="width:20%;">Nazwa strony:</th>
				<td style="width:80%;"><input type="text" name="sitename" value="{SITENAME}" class="form-control"></td>
			</tr>
			<tr>
				<th>Adres strony:</th>
				<td><input type="text" name="siteurl" value="{SITEURL}" class="form-control"></td>
			</tr>
			<tr>
				<td colspan="2"><hr color="#999" size="1" /></td>
			</tr>
			<tr>
				<th>Informacja kontaktowa</th>
				<td><textarea name="contact" class="form-control" rows="4">{CONTACT}</textarea></td>
			</tr>
			<tr>
				<th>Adres e-mail</th>
				<td><input name="contact_email" class="form-control" value="{CONTACT_EMAIL}" /></td>
			</tr>
			<tr>
				<td colspan="2"><hr color="#999" size="1" /></td>
			</tr>
			<tr>
				<th>Słowa kluczowe</th>
				<td><input name="meta_keywords" class="form-control" value="{META_KEYWORDS}" /></td>
			</tr>
			<tr>
				<th>Opis strony</th>
				<td><textarea name="meta_desc" class="form-control" rows="4">{META_DESC}</textarea></td>
			</tr>
			<tr>
				<td colspan="2"><hr color="#999" size="1" /></td>
			</tr>
      <tr>
				<th>Moduł multijęzykowy</th>
				<td><input name="multilang" type="checkbox" value="1"<!-- IF MULTILANG --> checked<!-- ENDIF --> /></td>
			</tr>
      <tr>
				<td colspan="2"><hr color="#999" size="1" /></td>
			</tr>
			<tr>
				<th>Aktywna strona przerwy technicznej</th>
				<td>
					<input type="radio" name="site_break" value="1"<!-- IF SITE_BREAK == 1--> checked<!-- ENDIF --> /> Tak<br />
					<input type="radio" name="site_break" value="0"<!-- IF SITE_BREAK == 0 --> checked<!-- ENDIF --> /> Nie
				</td>
			</tr>
			<tr>
				<td colspan="2"><hr color="#999" size="1" /></td>
			</tr>
      <tr>
        <th>Moduł bazy firm</th>
        <td>
          <input type="radio" name="module_companies" value="1"<!-- IF MODULE_COMPANIES == 1--> checked<!-- ENDIF --> /> Tak<br />
          <input type="radio" name="module_companies" value="0"<!-- IF MODULE_COMPANIES == 0 --> checked<!-- ENDIF --> /> Nie
        </td>
      </tr>
      <tr>
        <td colspan="2"><hr color="#999" size="1" /></td>
      </tr>
			<tr>
				<th>reCaptcha</th>
				<td>
					<input type="text" name="g-recaptcha-sitekey" value="{G_RECAPTCHA_SITEKEY}" placeholder="sitekey" class="form-control" /><br />
					<input type="text" name="g-recaptcha-secret" value="{G_RECAPTCHA_SECRET}" placeholder="secret" class="form-control" /><br />
					<font class="tiny">Kody można wygenerować na stronie <a target="_blank" href="https://www.google.com/recaptcha/admin">https://www.google.com/recaptcha/admin</a></font>
				</td>
			</tr>
			<tr>
				<td colspan="2"><hr color="#999" size="1" /></td>
			</tr>
			<tr>
				<th>Google Analitics</th>
				<td>
					<textarea name="google_analitics" class="form-control" rows="3">{GOOGLE_ANALITICS}</textarea>
					<font class="tiny">Preferowanym systemem statystyk strony jest <a target="_blank" href="https://www.google.com/analytics/">Google Analitics</a></font>
				</td>
			</tr>
      <tr>
				<td colspan="2"><hr color="#999" size="1" /></td>
			</tr>
      <tr>
        <th>Fanpage Facebook</th>
        <td><input type="text" name="site_fb_link" value="{SITE_FB_LINK}" class="form-control" /></td>
      </tr>
      <tr>
        <th>Fanpage Twitter</th>
        <td><input type="text" name="site_tw_link" value="{SITE_TW_LINK}" class="form-control" /></td>
      </tr>
      <tr>
        <th>Fanpage Instagram</th>
        <td><input type="text" name="site_in_link" value="{SITE_IN_LINK}" class="form-control" /></td>
      </tr>
      <tr>
				<td colspan="2"><hr color="#999" size="1" /></td>
			</tr>
      <tr>
				<th>Logowanie przez Facebook</th>
				<td>
					<input type="radio" name="fb_login" value="1"<!-- IF FB_LOGIN == 1--> checked<!-- ENDIF --> /> Tak
					<input type="radio" name="fb_login" value="0"<!-- IF FB_LOGIN == 0 --> checked<!-- ENDIF --> /> Nie
          <small class="ml-3">(<a target="_blank" href="https://developers.facebook.com/docs/facebook-login/web/"><small>Dokumentacja Facebook</small></a>)</small>
				</td>
			</tr>
      <tr>
        <th>Facebook APP ID</th>
        <td><input type="text" name="fb_appid" value="{FB_APPID}" class="form-control" /></td>
      </tr>
      <tr>
        <th>Facebook Secret</th>
        <td><input type="text" name="fb_secret" value="{FB_SECRET}" class="form-control" /></td>
      </tr>
      <tr>
				<th>Logowanie przez Google</th>
				<td>
					<input type="radio" name="google_login" value="1"<!-- IF GOOGLE_LOGIN == 1--> checked<!-- ENDIF --> /> Tak
					<input type="radio" name="google_login" value="0"<!-- IF GOOGLE_LOGIN == 0 --> checked<!-- ENDIF --> /> Nie
          <small class="ml-3">(<a target="_blank" href="https://developers.google.com/identity/sign-in/web/sign-in#before_you_begin"><small>Dokumentacja Google</small></a>)</small>
				</td>
			</tr>
      <tr>
        <th>Google Client ID</th>
        <td><input type="text" name="google_login_id" value="{GOOGLE_LOGIN_ID}" class="form-control" /></td>
      </tr>
      <tr>
        <th>Google Client Secret</th>
        <td><input type="text" name="google_login_secret" value="{GOOGLE_LOGIN_SECRET}" class="form-control" /></td>
      </tr>
      <tr>
				<td colspan="2"><hr color="#999" size="1" /></td>
			</tr>
      <tr>
        <th>Logo główne</th>
        <td class="form-inline">
          <span>
            <input type="file" name="logo" class="form-control" />
            <small class="form-text text-muted">Dopuszczalny format - PNG</spall>
          </span>
          <img class="ml-2" style="max-width:200px;" src="theme/img/logo.png" />
        </td>
      </tr>
      <tr>
        <th>Logo Facebook</th>
        <td class="form-inline">
          <span>
            <input type="file" name="logo_fb" class="form-control" />
            <small class="form-text text-muted">Dopuszczalny format - PNG</spall>
          </span>
          <img class="ml-2" style="max-width:200px;" src="theme/img/logo_fb.png" />
        </td>
      </tr>
      <tr>
        <th>Tło strony głównej</th>
        <td class="form-inline">
          <span>
            <input type="file" name="mp_bg" class="form-control" />
            <small class="form-text text-muted">Dopuszczalny format - PNG</spall>
          </span>
          <img class="ml-2" style="max-width:200px;" src="theme/img/mp-bg.jpg" />
        </td>
      </tr>
			<!-- ENDIF -->

			<!-- IF OP == 'settings-mail' -->
      <tr>
				<th style="width:20%;">Metoda wysyłki emaili</th>
				<td>
          <select name="email_type" class="form-control">
            <option value="0"<!-- IF EMAIL_TYPE == 0 --> selected<!-- ENDIF -->> Zwykła (funkcja mail())</option>
            <option value="1"<!-- IF EMAIL_TYPE == 1 --> selected<!-- ENDIF -->> PHP (klasa phpMailer)</option>
          </select>
				</td>
			</tr>
			<tr>
				<th style="width:20%;">Host poczty</th>
				<td>
					<input type="text" name="email_host" value="{EMAIL_HOST}" class="form-control" /><br />
					<font class="tiny">Np. <em>poczta.wp.pl</em></font>
				</td>
			</tr>
			<tr>
				<th>Port poczty</th>
				<td>
					<input type="number" name="email_port" value="{EMAIL_PORT}" class="form-control" /><br />
					<font class="tiny">Np. <em>567</em></font>
				</td>
			</tr>
			<tr>
				<th>Użytkownik poczty</th>
				<td><input type="text" name="email_user" value="{EMAIL_USER}" class="form-control" /></td>
			</tr>
			<tr>
				<th>Hasło poczty</th>
				<td><input type="password" name="email_pass" value="{EMAIL_PASS}" class="form-control" /></td>
			</tr>
			<tr>
				<th>Adres email</th>
				<td><input type="text" name="email_email" value="{EMAIL_EMAIL}" class="form-control" /></td>
			</tr>
			<tr>
				<th>Nazwa nadawcy</th>
				<td>
					<input type="text" name="email_name" value="{EMAIL_NAME}" class="form-control" /><br />
					<font class="tiny">Np. <em>Serwis ogłoszeniowy</em></font>
				</td>
			</tr>
			<!-- ENDIF -->
			<!-- IF OP == 'settings-session' -->
			<tr>
				<td colspan="2" class="alert alert-warning">
					<strong>UWAGA!</strong> Ustawienie zbyt krótkiego czasu sesji może spowodować problemy z uwierzytelnianiem! Preferowany, minimalny czas sesji to <strong>180s</strong>.
				</td>
			</tr>
			<tr>
				<th style="width:20%;">Czas sesji administratorów</th>
				<td>
					<div class="input-group" style="width:120px">
						<input type="number" name="session_admin" value="{SESSION_ADMIN}" min="10" class="form-control" />
            <div class="input-group-prepend">
              <div class="input-group-text">s.</div>
            </div>
					</div>
				</td>
			</tr>
			<tr>
				<th>Czas sesji użytkowników</th>
				<td>
					<div class="input-group" style="width:120px">
						<input type="number" name="session_user" value="{SESSION_USER}" min="10" class="form-control" />
            <div class="input-group-prepend">
              <div class="input-group-text">s.</div>
            </div>
					</div>
				</td>
			</tr>
			<!-- ENDIF -->
			<!-- IF OP == 'settings-prices' -->
			<tr>
				<th>Oznaczenie jednostki</th>
				<td>
					<div class="input-group" style="width:280px">
						<input type="text" name="currency" value="{CURRENCY}" class="form-control" />
					</div>
				</td>
			</tr>
      <tr><td colspan="2"><hr /></td></tr>
      <tr>
				<th>Przelewy24 ID</th>
				<td>
					<div class="input-group" style="width:280px">
						<input type="text" name="p24_id" value="{P24_ID}" class="form-control" />
					</div>
				</td>
			</tr>
      <tr>
				<th>Przelewy24 CRC</th>
				<td>
					<div class="input-group" style="width:280px">
						<input type="text" name="p24_crc" value="{P24_CRC}" class="form-control" />
					</div>
				</td>
			</tr>
      <tr>
				<th>Przelewy24 Waluta</th>
				<td>
					<div class="input-group" style="width:280px">
						<input type="text" name="p24_currency" value="{P24_CURRENCY}" class="form-control" />
					</div>
				</td>
			</tr>
      <tr>
				<th>Przelewy24 Tryb</th>
				<td>
					<input type="radio" name="p24_tryb" value="live"<!-- IF P24_TRYB == 'live' --> checked<!-- ENDIF --> id="p24_tryb_live">
          <label for="p24_tryb_live">Live</label>
          <input type="radio" name="p24_tryb" value="sandbox"<!-- IF P24_TRYB == 'sandbox' --> checked<!-- ENDIF --> id="p24_tryb_sandbox">
          <label for="p24_tryb_sandbox">Sandbox</label>
				</td>
			</tr>
      <tr>
        <td colspan="2"><hr /></td>
      </tr>
      <tr>
        <th>Płatności SMS</th>
        <td>
          <input type="radio" name="sms_pay" value="1" id="sms_pay_1"<!-- IF SMS_PAY == 1 --> checked<!-- ENDIF --> /> <label for="sms_pay_1">Tak</label>
          <input type="radio" name="sms_pay" value="0" id="sms_pay_0"<!-- IF SMS_PAY == 0 --> checked<!-- ENDIF --> /> <label for="sms_pay_0">Nie</label>
        </td>
      <tr>
        <td colspan="2"><hr /></td>
      </tr>
      <tr>
        <th>Użytkownik PayPal:</th>
        <td>
          <div class="input-group" style="width:280px">
            <input type="text" name="paypal_username" value="{PAYPAL_USERNAME}" class="form-control" />
          </div>
        </td>
      </tr>
      <tr>
        <th>Hasło PayPal:</th>
        <td>
          <div class="input-group" style="width:280px">
            <input type="text" name="paypal_password" value="{PAYPAL_PASSWORD}" class="form-control" /></td>
          </div>
        </td>
      </tr>
      <tr>
        <th>PayPal API Key:</th>
        <td>
          <div class="input-group" style="width:280px">
            <input type="text" name="paypal_api_key" value="{PAYPAL_API_KEY}" class="form-control" /></td>
          </div>
        </td>
      </tr>
      <tr>
        <th>Waluta PayPal:</th>
        <td>
          <div class="input-group" style="width:280px">
            <input type="text" name="paypal_waluta" value="{PAYPAL_WALUTA}" class="form-control" /></td>
          </div>
        </td>
      </tr>
      <tr>
        <th>Tryb PayPal:</th>
        <td>
          <div class="input-group" style="width:280px">
            <label><input type="radio" name="paypal_tryb" value="sandbox"<!-- IF PAYPAL_TRYB == 'sandbox' --> checked<!-- ENDIF --> /> sandbox</label>
            <label><input type="radio" name="paypal_tryb" value="live"<!-- IF PAYPAL_TRYB == 'live' --> checked<!-- ENDIF --> /> live</label>
          </div>
        </td>
      </tr>
      <tr>
        <td colspan="2"><hr /></td>
      </tr>
      <tr>
				<th>Fakturownia ID</th>
				<td>
					<div class="input-group" style="width:280px">
						<input type="text" name="fakturownia_id" value="{FAKTUROWNIA_ID}" class="form-control" />
					</div>
				</td>
			</tr>
      <tr>
				<th>Fakturownia Token</th>
				<td>
					<div class="input-group" style="width:280px">
						<input type="text" name="fakturownia_token" value="{FAKTUROWNIA_TOKEN}" class="form-control" />
					</div>
				</td>
			</tr>
      <!-- ENDIF -->
      <!-- IF OP == 'settings-items' -->
      <tr>
        <th>Podbijanie</th>
        <td><input type="checkbox" name="items_bids" value="1"<!-- IF ITEMS_BIDS == 1 --> checked<!-- ENDIF --> /></td>
      </tr>
      <tr>
        <th>Wyróżnianie</th>
        <td><input type="checkbox" name="items_distinction" value="1"<!-- IF ITEMS_DISTINCTION == 1 --> checked<!-- ENDIF --> /></td>
      </tr>
      <tr>
        <th>Dodawanie tylko dla abonentów</th>
        <td><input type="checkbox" name="item_member" value="1"<!-- IF ITEM_MEMBER == 1 --> checked<!-- ENDIF --> /></td>
      </tr>
      <tr>
        <th>Dodawanie tylko zalogowanych</th>
        <td><input type="checkbox" name="item_login" value="1"<!-- IF ITEM_LOGIN == 1 --> checked<!-- ENDIF --> /></td>
      </tr>
      <tr>
        <th>Otrzymywanie wiadomości tylko dla abonentów</th>
        <td><input type="checkbox" name="member_items_message" value="1"<!-- IF MEMBER_ITEMS_MESSAGE == 1 --> checked<!-- ENDIF --> /></td>
      </tr>
      <tr>
        <th>Maksymalna ilość zdjęć w ogłoszeniu</th>
        <td><input type="number" name="item_photos" value="{ITEM_PHOTOS}" class="form-control" style="max-width:80px;" /></td>
      </tr>
			<!-- ENDIF -->
      <!-- IF OP == 'settings-member' -->
      <tr>
        <th>Powiadomienie o wygasaniu</th>
        <td>
          <div class="col-auto">
            <div class="input-group">
              <input type="number" name="member_reminder" value="{MEMBER_REMINDER}" class="form-control w-auto">
              <div class="input-group-append">
                <span class="input-group-text">dni przed zakonczeniem</span>
              </div>
            </div>
          </div>
        </td>
      </tr>
      <tr>
        <th>Ogłoszenie widoczne po wygaśnięciu</th>
        <td>
          <div class="col-auto">
            <div class="input-group">
              <input type="number" name="member_items_visible" value="{MEMBER_ITEMS_VISIBLE}" class="form-control">
              <div class="input-group-append">
                <span class="input-group-text">dni po zakończeniu</span>
              </div>
            </div>
          </div>
        </td>
      </tr>
			<!-- ENDIF -->
      <!-- IF OP == 'settings-users' -->

			<!-- ENDIF -->
			<tr>
				<td colspan="8" class="text-right">
					<input type="submit" class="btn btn-primary" name="save" value="Zapisz zmiany">
				</td>
			</tr>
		</table>
		</form>
	</div>
