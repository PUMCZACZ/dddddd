<!-- IF OP == 'prices-stats' -->
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<!-- ENDIF -->

  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'prices-members' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=prices-members">Abonamenty</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'prices-add-cls' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=prices-add-cls">Dodanie ogłoszenia</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'prices-add-offer' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=prices-add-offer">Dodanie CV</a>
      </li>
			<li class="nav-item">
        <a class="nav-link<!-- IF OP == 'prices-else' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=prices-else">Inne pakiety</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'prices-items-promo' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=prices-items-promo">Promocja ogłoszeń</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'promo-codes' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=promo-codes">Kody promocyjne</a>
      </li>
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'prices-stats' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=prices-stats">Statystyki</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <h3>
  		<!-- IF OP == 'prices-members' -->
  		Abonamenty
      <!-- ELSEIF OP == 'prices-add-cls' -->
  		Dodanie ogłoszenia
      <!-- ELSEIF OP == 'prices-add-offer' -->
  		Dodanie CV
  		<!-- ELSEIF OP == 'prices-else' -->
  		Inne pakiety
      <!-- ELSEIF OP == 'prices-stats' -->
  		Statystyki
      <!-- ELSEIF OP == 'promo-codes' -->
  		Kody promocyjne
      <!-- ELSEIF OP == 'promo-items-promo' -->
  		Promocja ogłoszeń
      <!-- ELSEIF OP == 'prices-sms' -->
  		Płatności SMS
  		<!-- ENDIF -->
    </h3>
		<!-- IF OP != 'prices-stats' -->
    <form method="post">
    <!-- ENDIF -->
		<table class="table table-striped<!-- IF OP == 'prices-stats' || OP == 'prices-items-promo' --> table-hover<!-- ENDIF -->">

      <!-- IF OP == 'prices-add-cls' -->
      <!-- IF ITEM_MEMBER --><tr><td colspan="5"><div class="alert alert-danger">Aktywny jest wymóg wykupienia abonamentu. Opłaty za dodanie nie będą naliczane. <a href="admin-panel.php?op=settings-items"><strong>Zmień ustawienia</strong></a></div></td></tr><!-- ENDIF -->
      <tr>
        <th>Wartość</th>
        <th>Rodzaj</th>
        <th>Czas</th>
        <th>Kategoria</th>
        <th class="text-center">Usuń</th>
      </tr>
      <!-- BEGIN p -->
      <tr>
        <td>
          <input type="number" name="value[{p.ID}]" value="{p.VALUE}" class="form-control" />
          <input type="hidden" name="id[]" value="{p.ID}" />
        </td>
        <td>
          <select name="value_type[{p.ID}]" class="form-control">
            <option value="cnst"<!-- IF p.VALUE_TYPE == 'cnst' --> selected<!-- ENDIF -->>stała ({CURRENCY})</option>
            <option value="pr"<!-- IF p.VALUE_TYPE == 'pr' --> selected<!-- ENDIF -->>%</option>
          </select>
        </td>
        <td>
          <select name="time[{p.ID}]" class="form-control">
            <!-- BEGIN item_time -->
            <option value="{item_time.NAME}"<!-- IF p.TIME == item_time.NAME --> selected<!-- ENDIF -->>{item_time.NAME} dni</option>
            <!-- END item_time -->
          </select>
        </td>
        <td>
          <!-- BEGIN c -->
          <select name="cat_id[{p.ID}][]" class="form-control parent">
            <option value="">-- wszystkie --</option>
            <!-- BEGIN cats -->
            <option value="{cats.ID}"<!-- IF c.ID == cats.ID --> selected<!-- ENDIF -->>{cats.NAME}</option>
            <!-- END cats -->
          </select>
          <!-- END c -->
        </td>
        <td class="text-center"><input type="checkbox" name="delete[]" value="{p.ID}" /></td>
      </tr>
      <!-- END p -->
      <tr>
				<th colspan="4"><h4>Nowa pozycja</h4></th>
			</tr>
      <tr>
        <th>Wartość</th>
        <th>Rodzaj</th>
        <th>Czas</th>
        <th>Kategoria</th>
        <th></th>
      </tr>
      <tr>
        <td><input type="number" name="new_value" class="form-control" /></td>
        <td>
          <select name="new_value_type" class="form-control">
            <option value="cnst">stała ({CURRENCY})</option>
            <option value="pr">%</option>
          </select>
        </td>
        <td>
          <select name="new_time" class="form-control">
            <!-- BEGIN item_time -->
            <option value="{item_time.NAME}">{item_time.NAME} dni</option>
            <!-- END item_time -->
          </select>
        </td>
        <td>
          <select name="new_cat_id[]" class="form-control parent">
            <option value="0">-- wszystkie --</option>
            <!-- BEGIN cats -->
            <option value="{cats.ID}">{cats.NAME}</option>
            <!-- END cats -->
          </select>
        </td>
        <td></td>
      </tr>
      <!-- ENDIF -->

      <!-- IF OP == 'prices-add-offer' -->
      <tr>
        <th>Wartość</th>
        <th>Kategoria</th>
        <th class="text-center">Usuń</th>
      </tr>
      <!-- BEGIN p -->
      <tr>
        <td>
          <div class="input-group">
            <input type="number" name="value[{p.ID}]" value="{p.VALUE}" class="form-control" />
            <div class="input-group-append">
              <span class="input-group-text">{CURRENCY}</span>
            </div>
          </div>
          <input type="hidden" name="id[]" value="{p.ID}" />
        </td>
        <td>
          <!-- BEGIN c -->
          <select name="cat_id[{p.ID}][]" class="form-control parent">
            <option value="">-- wszystkie --</option>
            <!-- BEGIN cats -->
            <option value="{cats.ID}"<!-- IF c.ID == cats.ID --> selected<!-- ENDIF -->>{cats.NAME}</option>
            <!-- END cats -->
          </select>
          <!-- END c -->
        </td>
        <td class="text-center"><input type="checkbox" name="delete[]" value="{p.ID}" /></td>
      </tr>
      <!-- END p -->
      <tr>
        <th colspan="4"><h4>Nowa pozycja</h4></th>
      </tr>
      <tr>
        <th>Wartość</th>
        <th>Kategoria</th>
        <th></th>
      </tr>
      <tr>
        <td>
          <div class="input-group">
            <input type="number" name="new_value" class="form-control" />
            <div class="input-group-append">
              <span class="input-group-text">{CURRENCY}</span>
            </div>
          </div>
        </td>
        <td>
          <select name="new_cat_id[]" class="form-control parent">
            <option value="0">-- wszystkie --</option>
            <!-- BEGIN cats -->
            <option value="{cats.ID}">{cats.NAME}</option>
            <!-- END cats -->
          </select>
        </td>
        <td></td>
      </tr>
      <!-- ENDIF -->

      <!-- IF OP == 'prices-sms' -->
      <tr>
        <th>Treść SMSa</th>
        <th>Numer telefonu</th>
        <th>Cena netto SMSa</th>
        <th>Wartość podatku</th>
        <th class="text-center">Usuń</th>
      </tr>
      <!-- BEGIN sms -->
      <tr>
        <td><input type="text" name="text[{sms.ID}]" class="form-control" value="{sms.TEXT}" /></td>
        <td><input type="text" name="number[{sms.ID}]" class="form-control" value="{sms.NUMBER}" /></td>
        <td>
          <div class="input-group">
            <input type="number" name="price[{sms.ID}]" class="form-control text-right" value="{sms.PRICE}" step="any" />
            <div class="input-group-prepend">
              <div class="input-group-text">{CURRENCY}</div>
            </div>
          </div>
        </td>
        <td>
          <div class="input-group">
            <input type="number" name="tax[{sms.ID}]" class="form-control text-right" value="{sms.TAX}" />
            <div class="input-group-prepend">
              <div class="input-group-text">%</div>
            </div>
          </div>
          <input type="hidden" name="id[]" value="{sms.ID}" />
        </td>
        <td class="text-center"><input type="checkbox" name="delete[]" value="{sms.ID}" /></td>
      </tr>
      <!-- END sms -->
      <tr>
				<td colspan="5"><hr color="#999" size="1" /></td>
			</tr>
			<tr>
				<th colspan="5"><h4>Nowy numer</h4></th>
			</tr>
      <tr>
        <th>Treść SMSa</th>
        <th>Numer telefonu</th>
        <th>Cena netto SMSa</th>
        <th>Wartość podatku</th>
        <th></th>
      </tr>
      <tr>
        <td><input type="text" name="new_text" class="form-control" /></td>
        <td><input type="text" name="new_number" class="form-control" /></td>
        <td>
          <div class="input-group">
            <input type="number" name="new_price" class="form-control text-right" step="any" />
            <div class="input-group-prepend">
              <div class="input-group-text">{CURRENCY}</div>
            </div>
          </div>
        </td>
        <td>
          <div class="input-group">
            <input type="number" name="new_tax" class="form-control text-right" />
            <div class="input-group-prepend">
              <div class="input-group-text">%</div>
            </div>
          </div>
        </td>
        <td></td>
      </tr>
      <!-- ENDIF -->

			<!-- IF OP == 'prices-members' -->
			<tr>
				<th>Nazwa</th>
				<th>Ogłoszenia</th>
        <th>Zdjęć w ogłoszeniu</th>
        <th>Podbić</th>
        <th>Wyróżnienia</th>
        <th class="text-center">Aktywny/data ważności</th>
        <th class="text-center">Darmowy/data ważności</th>
        <th></th>
        <th class="text-center">Usuń</th>
			</tr>
      <!-- BEGIN m -->
			<tr>
				<th><input type="text" name="name[{m.ID}]" value="{m.NAME}" class="form-control" /></th>
				<td>
          <input type="number" name="extra_ads[{m.ID}]" value="{m.EXTRA_ADS}" step="1" class="form-control" />
          <input type="hidden" name="id[]" value="{m.ID}" />
        </td>
        <td>
          <input type="number" name="extra_photos[{m.ID}]" value="{m.EXTRA_PHOTOS}" step="1" class="form-control" />
        </td>
        <td>
          <input type="number" name="extra_bids[{m.ID}]" value="{m.EXTRA_BIDS}" step="1" class="form-control" />
        </td>
        <td>
          <input type="number" name="extra_distinction[{m.ID}]" value="{m.EXTRA_DISTINCTION}" step="1" class="form-control" />
        </td>
        <td>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" name="active[{m.ID}]" value="1"<!-- IF m.ACTIVE == 1 --> checked<!-- ENDIF --> />
              </div>
            </div>
            <input type="text" name="actve_end[{m.ACTIVE_END}]" value="{m.ACTIVE_END}" class="form-control" placeholder="DD-MM-RRRR" />
          </div>
        </td>
        <td>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" name="free[{m.ID}]" value="1"<!-- IF m.FREE == 1 --> checked<!-- ENDIF --> />
              </div>
            </div>
            <input type="text" name="free_end[{m.ID}]" value="{m.FREE_END}" placeholder="DD-MM-RRRR" class="form-control" />
          </div>
        </td>
        <td class="text-center"><a href="#" data-toggle="modal" data-target="#member{m.ID}" class="btn btn-primary">Ceny</a></td>
        <td class="text-center">
          <input type="checkbox" name="delete[]" value="{m.ID}" />
        </td>
			</tr>
      <!-- END m -->
			<tr>
				<td colspan="8"><hr color="#999" size="1" /></td>
			</tr>
			<tr>
				<th colspan="8"><h4>Nowy pakiet</h4></th>
			</tr>
      <tr>
				<th>Nazwa</th>
				<th>Ogłoszenia</th>
        <th>Zdjęć w ogłoszeniu</th>
        <th>Podbić</th>
        <th>Wyróżnienia</th>
        <th class="text-center">Aktywny/data ważności</th>
        <th class="text-center">Darmowy/data ważności</th>
			</tr>
      <tr>
				<th><input type="text" name="new_name" class="form-control" /></th>
				<td>
          <input type="number" name="new_extra_ads" step="1" class="form-control" />
        </td>
        <td>
          <input type="number" name="new_extra_photos" step="1" class="form-control" />
        </td>
        <td>
          <input type="number" name="new_extra_bids" step="1" class="form-control" />
        </td>
        <td>
          <input type="number" name="new_extra_distinction" step="1" class="form-control" />
        </td>
        <td>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" name="new_active" value="1" />
              </div>
            </div>
            <input type="text" name="new_actve_end" class="form-control" placeholder="DD-MM-RRRR" />
          </div>
        </td>
        <td>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" name="new_free" value="1" />
              </div>
            </div>
            <input type="text" name="new_free_end" class="form-control" placeholder="DD-MM-RRRR" />
          </div>
        </td>
			</tr>
			<!-- ENDIF -->

      <!-- IF OP == 'prices-else' -->
			<tr class="text-center">
				<th>Ogłoszenia</th>
        <th>Podbicia</th>
        <th>Wyróżnienia</th>
        <th>Strona główna</th>
        <th>Ilość</th>
        <th class="text-center">Aktywny/data ważności</th>
        <th class="text-center">Darmowy/data ważności</th>
        <th></th>
        <th class="text-center"></th>
			</tr>
      <!-- BEGIN m -->
      <tr>
				<td class="text-center"><label class="d-block"><input type="radio" name="type[{m.ID}]" value="extra_ads"<!-- IF m.EXTRA_ADS --> checked<!-- ENDIF --> /></label></td>
        <td class="text-center"><label class="d-block"><input type="radio" name="type[{m.ID}]" value="extra_bids"<!-- IF m.EXTRA_BIDS --> checked<!-- ENDIF --> /></label></td>
        <td class="text-center"><label class="d-block"><input type="radio" name="type[{m.ID}]" value="extra_distinction"<!-- IF m.EXTRA_DISTINCTION --> checked<!-- ENDIF --> /></label></td>
        <td class="text-center"><label class="d-block"><input type="radio" name="type[{m.ID}]" value="extra_main_page"<!-- IF m.EXTRA_MAIN_PAGE --> checked<!-- ENDIF --> /></label></td>
        <td>
          <input type="number" name="qty[{m.ID}]" value="<!-- IF m.EXTRA_ADS -->{m.EXTRA_ADS}<!-- ELSEIF m.EXTRA_BIDS -->{m.EXTRA_BIDS}<!-- ELSEIF m.EXTRA_DISTINCTION -->{m.EXTRA_DISTINCTION}<!-- ELSEIF m.EXTRA_MAIN_PAGE -->{m.EXTRA_MAIN_PAGE}<!-- ENDIF -->" class="form-control" />
          <input type="hidden" name="id[]" value="{m.ID}" />
        </td>
        <td>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" name="active[{m.ID}]" value="1"<!-- IF m.ACTIVE == 1 --> checked<!-- ENDIF --> />
              </div>
            </div>
            <input type="text" name="actve_end[{m.ACTIVE_END}]" value="{m.ACTIVE_END}" class="form-control" placeholder="DD-MM-RRRR" />
          </div>
        </td>
        <td>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" name="free[{m.ID}]" value="1"<!-- IF m.FREE == 1 --> checked<!-- ENDIF --> />
              </div>
            </div>
            <input type="text" name="free_end[{m.ID}]" value="{m.FREE_END}" placeholder="DD-MM-RRRR" class="form-control" />
          </div>
        </td>
        <td class="text-center"><a href="#" data-toggle="modal" data-target="#member{m.ID}" class="btn btn-primary">Ceny</a></td>
        <td class="text-center">
          <input type="checkbox" name="delete[]" value="{m.ID}" />
        </td>
			</tr>
      <!-- END m -->
      <tr><td colspan="8"><hr /></td></tr>
      <tr>
				<td class="text-center"><label class="d-block"><input type="radio" name="new_type" value="extra_ads" /></label></td>
        <td class="text-center"><label class="d-block"><input type="radio" name="new_type" value="extra_bids" /></label></td>
        <td class="text-center"><label class="d-block"><input type="radio" name="new_type" value="extra_distinction" /></label></td>
        <td class="text-center"><label class="d-block"><input type="radio" name="new_type" value="extra_main_page" /></label></td>
        <td>
          <input type="number" name="new_qty" class="form-control" />
        </td>
        <td>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" name="new_active" value="1" />
              </div>
            </div>
            <input type="text" name="new_actve_end" class="form-control" placeholder="DD-MM-RRRR" />
          </div>
        </td>
        <td>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <input type="checkbox" name="new_free" value="1" />
              </div>
            </div>
            <input type="text" name="new_free_end" class="form-control" placeholder="DD-MM-RRRR" />
          </div>
        </td>
        <td class="text-center"></td>
        <td class="text-center"></td>
			</tr>
      <!-- ENDIF -->

      <!-- IF OP == 'promo-codes'-->
      <tr>
        <th>Kod</th>
        <th>Obiżka</th>
        <th>Użyty</th>
        <th>Data dodania</th>
        <th>Data ważności</th>
      </tr>
      <!-- BEGIN pc -->
      <tr>
        <td>{pc.CODE}</td>
        <td>{pc.DISCOUNT}%</td>
        <td><!-- IF pc.USERNAME -->{pc.USERNAME} ({pc.DATE_USED})<!-- ELSE --><span class="text-secondary"><em>Brak</em></span><!-- ENDIF --></td>
        <td>{pc.DATE_START}</td>
        <td>{pc.DATE_END}</td>
      </tr>
      <!-- END pc -->
      <tr><td colspan="8"><hr /></td></tr>
      <tr><td colspan="8"><h4>Nowa pula kodów</h4></td></tr>
      <tr>
        <td>
          <label>Ilość kodów</label>
          <input type="number" name="quantity" class="form-control" min="1" required />
        </td>
        <td>
          <label>Obniżka</label>
          <div class="input-group">
            <input type="number" name="discount" step="any" class="form-control" required />
            <div class="input-group-prepend">
              <span class="input-group-text">%</span>
            </div>
          </div>
        </td>
        <td>
          <label>Data ważności</label>
          <input type="date" name="date_end" class="form-control" required />
        </td>
      </tr>
      <!-- ENDIF -->

      <!-- IF OP == 'prices-stats' -->
      <tr>
        <th colspan="9">
          <form method="get" action="{ADMIN_FILE}">
            <input type="hidden" name="op" value="prices-stats" />
            <div class="form-inline">
              Okres: <input class="form-control text-center ml-2" type="text" name="daterange" value="{DATERANGE}" style="min-width:280px" readonly />
              <button type="submit" name="search" value="1" class="btn btn-primary ml-2">Pokaż</button>
            </div>
          </form>
        </th>
      </tr>
      <tr>
        <th>Pakiet</th>
        <th class="text-center">Okres</th>
        <th class="text-center">Cena</th>
        <th class="text-center">Nowych</th>
        <th class="text-center">Aktywnych</th>
        <th class="text-center">Wygasłych</th>
        <th class="text-center">Suma</th>
        <th></th>
      </tr>
      <!-- BEGIN m -->
      <!-- BEGIN mp -->
      <tr>
        <td><!-- IF m.NAME -->{m.NAME}<!-- ELSE --><!-- IF m.EXTRA_ADS -->Ogłoszenia<!-- ELSEIF m.EXTRA_BIDS -->Podbicia<!-- ELSEIF m.EXTRA_DISTINCTION -->Wyróżnienia<!-- ELSEIF m.EXTRA_MAIN_PAGE -->Strona główna<!-- ENDIF --><!-- ENDIF --></td>
        <td class="text-center">{mp.TIME} dni</td>
        <td class="text-right">{mp.PRICE} {CURRENCY}</td>
        <td class="text-center">{mp.COUNT_NEW}</td>
        <td class="text-center">{mp.COUNT_ACTIVE}</td>
        <td class="text-center">{mp.COUNT_ENDED}</td>
        <td class="text-right">{mp.SUM} {CURRENCY}</td>
        <td class="text-center"><a class="btn btn-primary" href="#" data-toggle="modal" data-target="#details{mp.ID}">Szczegóły</a></td>
      </tr>
      <!-- END mp -->
      <!-- END m -->
      <tr>
        <td colspan="3"></td>
        <th class="text-center">{COUNT_NEW}</th>
        <th class="text-center">{COUNT_ACTIVE}</th>
        <th class="text-center">{COUNT_ENDED}</th>
        <th class="text-right">{SUM} {CURRENCY}</th>
        <th></th>
      </tr>
      <!-- ENDIF -->

      <!-- IF OP == 'prices-items-promo' -->
      <tr>
        <th>Rodzaj</th>
        <th>Czas</th>
        <th>Cena</th>
      </th>
      <!-- BEGIN p -->
      <tr class="<!-- IF p.ITEM_PROMO_KEY == 'promo_bold' -->table-success<!-- ELSEIF p.ITEM_PROMO_KEY == 'promo_backlight' -->table-warning<!-- ELSEIF p.ITEM_PROMO_KEY == 'promo_distinction' -->table-info<!-- ENDIF -->">
        <td>{p.ITEM_PROMO_VALUE}</td>
        <td>{p.NAME} dni</td>
        <td>
          <div class="input-group">
            <input name="item_price[{p.ITEM_PROMO_KEY}][{p.NAME}]" type="number" step="any" value="{p.PRICE}" class="form-control text-right" />
            <div class="input-group-append">
              <span class="input-group-text">{CURRENCY}</span>
            </div>
          </div>
        </td>
      </td>
      <!-- END p -->
    </table>

    <h3>Ustawienia boksów</h3>
    <table class="table table-striped">
      <tr>
        <th>Nazwa</th>
        <th>Nazwa wyświetlana</th>
        <th>Tekst wyświetlany</th>
      </tr>
      <!-- BEGIN pi -->
      <tr>
        <td>{pi.NAME_MAIN}</td>
        <td><input type="text" name="promo_name[{pi.NAME}]" value="{pi.VALUE_NAME}" class="form-control" /></td>
        <td><input type="text" name="promo_text[{pi.NAME}]" value="{pi.VALUE_TEXT}" class="form-control" /></td>
      </tr>
      <!-- END pi -->

      <!-- ENDIF -->

      <!-- IF OP != 'prices-stats' -->
			<tr>
				<td colspan="8" class="text-right">
					<input type="submit" class="btn btn-primary" name="save" value="Zapisz zmiany">
				</td>
			</tr>
      <!-- ENDIF -->

		</table>
    <!-- IF OP != 'prices-stats' -->
		</form>
    <!-- ENDIF -->
	</div>

  <!-- IF OP == 'prices-stats' -->
  <!-- BEGIN mp -->
  <div class="modal fade" id="details{mp.ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Statystyki dla pakietu '{mp.NAME} {mp.TIME} dni' w okresie '{DATERANGE}'</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tr>
              <th>Użytkownik</th>
              <th>Data zakupu</th>
              <th>Data ważności</th>
              <th>Cena</th>
              <th>Metoda płatności</th>
              <th>Rodzaj</th>
            </tr>
            <!-- BEGIN um -->
            <tr>
              <td>{um.USERNAME}</td>
              <td>{um.DATE}</td>
              <td>{um.DATE_END}</td>
              <td>{um.PRICE} {CURRENCY}</td>
              <td><!-- IF um.PRICE > 0 -->Przelew online<!-- ELSE --><em>Brak</em><!-- ENDIF --></td>
              <td>
                <!-- IF um.TYPE_NEW --><div><em class="fa fa-check"></em> Nowy</div><!-- ENDIF -->
                <!-- IF um.TYPE_ACTIVE --><div><em class="fa fa-check"></em> Aktywny</div><!-- ENDIF -->
                <!-- IF um.TYPE_END --><div><em class="fa fa-check"></em> Wygasły</div><!-- ENDIF -->
              </td>
            </tr>
            <!-- END um -->
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- END mp -->
  <!-- ENDIF -->

  <!-- IF OP == 'prices-members' -->
  <!-- BEGIN m -->
  <div class="modal fade" id="member{m.ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cennik dla pakietu '{m.NAME}'</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post">
          <div class="modal-body">
            <table class="table table-striped">
              <tr>
                <th style="width:10%;">Czas</th>
                <th style="width:15%;" class="text-nowrap">Znacznik czasu</th>
                <th style="width:15%;">Cena</th>
                <th style="width:20%;">SMS</th>
                <th style="width:30%;">Nazwa produktu</th>
                <th style="width:10%;" class="text-center text-nowrap">Darmowy<br />jednorazowo</th>
                <th style="width:5%;" class="text-center">Usuń</th>
              </tr>
              <!-- BEGIN mp -->
              <tr>
                <td>
                  <input type="number" name="time[{mp.ID}]" value="{mp.TIME}" class="form-control" />
                  <input type="hidden" name="id[]" value="{mp.ID}" />
                </td>
                <td>
                  <select name="time_type[{mp.ID}]" class="form-control">
                    <option value="d"<!-- IF mp.TIME_TYPE == 'd' --> selected<!-- ENDIF -->>dzień</option>
                    <option value="w"<!-- IF mp.TIME_TYPE == 'w' --> selected<!-- ENDIF -->>tydzień</option>
                    <option value="m"<!-- IF mp.TIME_TYPE == 'm' --> selected<!-- ENDIF -->>miesiąc</option>
                  </select>
                </td>
                <td><input type="number" name="price[{mp.ID}]" value="{mp.PRICE}" class="form-control" /></td>
                <td>
                  <select name="sms_id[{mp.ID}]" class="form-control">
                    <option value="0"<!-- IF mp.SMS_ID == 0 --> selected<!-- ENDIF -->>brak</option>
                    <!-- BEGIN sms -->
                    <option value="{sms.ID}"<!-- IF mp.SMS_ID == sms.ID --> selected<!-- ENDIF -->>{sms.PRICE} {CURRENCY} ({sms.TEXT} - {sms.NUMBER})</option>
                    <!-- END sms -->
                  </select>
                </td>
                <td>
                  <!-- BEGIN lngs -->
                  <div class="form-group"><input type="text" name="f_product_id[{mp.ID}][{lngs.NAME_DEF}]" value="{lngs.F_PRODUCT_ID}" class="form-control" placeholder="{lngs.NAME}" /></div>
                  <!-- END lngs -->
                </td>
                <td><input type="checkbox" name="free_once[{mp.ID}]" value="1" class="form-control"<!-- IF mp.FREE_ONCE == 1 --> checked<!-- ENDIF --> /></td>
                <td class="text-center"><input type="checkbox" name="delete[]" value="{mp.ID}" /></td>
              </tr>
              <!-- END mp -->
              <tr><td colspan="9"><hr /></td></tr>
              <tr>
                <td>
                  <input type="number" name="new_time" class="form-control" />
                  <input type="hidden" name="m_id" value="{m.ID}" />
                </td>
                <td>
                  <select name="new_time_type" class="form-control">
                    <option value="d">dzień</option>
                    <option value="w">tydzień</option>
                    <option value="m">miesiąc</option>
                  </select>
                </td>
                <td><input type="number" step="any" name="new_price" class="form-control" /></td>
                <td>
                  <select name="new_sms_id" class="form-control">
                    <option value="0">brak</option>
                    <!-- BEGIN sms -->
                    <option value="{sms.ID}">{sms.PRICE} {CURRENCY} ({sms.TEXT} - {sms.NUMBER})</option>
                    <!-- END sms -->
                  </select>
                </td>
                <td><input type="text" name="new_f_product_id" class="form-control" /></td>
                <td><input type="checkbox" name="new_free_once" value="1" class="form-control" /></td>
                <td></td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="save-periods" value="1">Zapisz zmiany</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END m -->
  <!-- ENDIF -->

  <!-- IF OP == 'prices-else' -->
  <!-- BEGIN m -->
  <div class="modal fade" id="member{m.ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cennik dla pakietu <!-- IF m.EXTRA_ADS -->Ogłoszeń<!-- ELSEIF m.EXTRA_BIDS -->Podbić<!-- ELSEIF m.EXTRA_DISTINCTION -->Wyróżnień<!-- ELSEIF m.EXTRA_MAIN_PAGE -->Strony Głównej<!-- ENDIF --></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post">
          <div class="modal-body">
            <table class="table table-striped">
              <!-- IF .m.mp -->
              <tr>
                <th>Czas</th>
                <th>Znacznik czasu</th>
                <th>Cena</th>
                <th>SMS</th>
                <th>Nazwa produktu</th>
                <th class="text-center">Usuń</th>
              </tr>
              <!-- BEGIN mp -->
              <tr>
                <td>
                  <input type="number" name="time[{mp.ID}]" value="{mp.TIME}" class="form-control" />
                  <input type="hidden" name="id[]" value="{mp.ID}" />
                </td>
                <td>
                  <select name="time_type[{mp.ID}]" class="form-control">
                    <option value="d"<!-- IF mp.TIME_TYPE == 'd' --> selected<!-- ENDIF -->>dzień</option>
                    <option value="w"<!-- IF mp.TIME_TYPE == 'w' --> selected<!-- ENDIF -->>tydzień</option>
                    <option value="m"<!-- IF mp.TIME_TYPE == 'm' --> selected<!-- ENDIF -->>miesiąc</option>
                  </select>
                </td>
                <td>
                  <div class="input-group">
                    <input type="number" name="price[{mp.ID}]" value="{mp.PRICE}" step="any" class="form-control text-right" />
                    <div class="input-group-prepend">
                      <div class="input-group-text">{CURRENCY}</div>
                    </div>
                  </div>
                </td>
                <td>
                  <select name="sms_id[{mp.ID}]" class="form-control">
                    <option value="0"<!-- IF mp.SMS_ID == 0 --> selected<!-- ENDIF -->>brak</option>
                    <!-- BEGIN sms -->
                    <option value="{sms.ID}"<!-- IF mp.SMS_ID == sms.ID --> selected<!-- ENDIF -->>{sms.PRICE} {CURRENCY} ({sms.TEXT} - {sms.NUMBER})</option>
                    <!-- END sms -->
                  </select>
                </td>
                <td>
                  <!-- BEGIN lngs -->
                  <div class="form-group"><input type="text" name="f_product_id[{mp.ID}][{lngs.NAME_DEF}]" value="{lngs.F_PRODUCT_ID}" class="form-control" placeholder="{lngs.NAME}" /></div>
                  <!-- END lngs -->
                </td>
                <td class="text-center"><input type="checkbox" name="delete[]" value="{mp.ID}" /></td>
              </tr>
              <!-- END mp -->
              <tr><td colspan="5"><hr /></td></tr>
              <!-- ENDIF -->
              <!-- IF .m.mp == '' -->
              <tr>
                <th>Czas</th>
                <th>Znacznik czasu</th>
                <th>Cena</th>
                <th>SMS</th>
                <th>Nazwa produktu</th>
                <th class="text-center"></th>
              </tr>
              <tr>
                <td>
                  <input type="number" name="new_time" class="form-control" />
                  <input type="hidden" name="m_id" value="{m.ID}" />
                </td>
                <td>
                  <select name="new_time_type" class="form-control">
                    <option value="d">dzień</option>
                    <option value="w">tydzień</option>
                    <option value="m">miesiąc</option>
                  </select>
                </td>
                <td>
                  <div class="input-group">
                    <input type="number" name="new_price" class="form-control" />
                    <div class="input-group-prepend">
                      <div class="input-group-text">{CURRENCY}</div>
                    </div>
                  </div>
                </td>
                <td>
                  <select name="new_sms_id" class="form-control">
                    <option value="0">brak</option>
                    <!-- BEGIN sms -->
                    <option value="{sms.ID}">{sms.PRICE} {CURRENCY} ({sms.TEXT} - {sms.NUMBER})</option>
                    <!-- END sms -->
                  </select>
                </td>
                <td><input type="text" name="new_f_product_id" class="form-control" /></td>
                <td></td>
              </tr>
              <!-- ENDIF -->
            </table>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="save-periods" value="1">Zapisz zmiany</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- END m -->
  <!-- ENDIF -->

<!-- IF OP == 'prices-add-cls' -->
<script type="text/javascript" src="theme/js/jquery.livequery.js"></script>
<script>
$(document).ready(function() {
  //$('#loader').hide();
  $('.parent').livequery('change', function() {
    $(this).nextAll('.parent').remove();
    var _this=this;
    $.post("funcs.php?name=items&file=add", {
      parent_id: $(this).val(),
      name_id: this.attributes["name"].value,
      type: 'all',
    }, function(response){
      if(response!='') {
        setTimeout(function(){$('#loader').remove();$(_this).parent().append(response);},0);
      } else {
      }
    });
    return false;
  });
});
</script>
<!-- ENDIF -->

<!-- IF OP == 'prices-stats' -->
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script src="http://gregfranko.com/jquery.selectBoxIt.js/js/jquery.selectBoxIt.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <script type="text/javascript">
    $(function() {
  			$('input[name="daterange"]').daterangepicker({
  	    	"locale": {
  	        "format": "DD/MM/YYYY",
  	        "separator": " - ",
  	        "applyLabel": "Zastosuj",
  	        "cancelLabel": "Anuluj",
  	        "fromLabel": "Od",
  	        "toLabel": "Do",
  	        "customRangeLabel": "Własne",
  	        "weekLabel": "T",
  	        "daysOfWeek": [
  	            "Ni",
  	            "Po",
  	            "Wt",
  	            "Śr",
  	            "Cz",
  	            "Pi",
  	            "So"
  	        ],
  	        "monthNames": [
  	            "Styczeń",
  	            "Luty",
  	            "Marzec",
  	            "Kwiecień",
  	            "Maj",
  	            "Czerwiec",
  	            "Lipiec",
  	            "Sierpień",
  	            "Wrzesień",
  	            "Październik",
  	            "Listopad",
  	            "Grudzień"
  	        ],
  	        "firstDay": 1,
  	    	}
  			}
		)
  });
</script>
<!-- ENDIF -->
