<section class="container my-3">
  <form method="post" class="row">
    <div class="col-xl-5 col-lg-8 col-12">
      <div class="bg-white border p-3">
        <h4 class="mb-0">Dane odbiorcy przesyłki</h4>
        <small class="text-muted">Na ten adres zostanie wysłana Twoja przesyłka.</small>
        <div class="row mt-2">
          <div class="form-group col-lg-6 col-12">
            <input type="text" name="g_name" class="form-control" placeholder="Imię" required />
          </div>
          <div class="form-group col-lg-6 col-12">
            <input type="text" name="g_surename" class="form-control" placeholder="Nazwisko" required />
          </div>
        </div>
        <div class="form-group">
          <input type="text" name="g_company_name" class="form-control" placeholder="Firma" />
        </div>
        <div class="form-group">
          <input type="text" name="g_address" class="form-control" placeholder="Adres" required />
          <small class="text-muted">Podaj nazwę ulicy wraz z numerem domu.</small>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-4 col-4"><input type="text" name="g_post_code" class="form-control text-center" placeholder="__-___" required /></div>
            <div class="col-xl-9 col-lg-9 col-md-8 col-8 pl-0"><input type="text" name="g_city" class="form-control" placeholder="Miasto" required /></div>
          </div>
        </div>
        <div class="form-group">
          <select name="g_country" class="form-control" required>
            <option value="">Kraj</option>
            <!-- BEGIN kraj -->
            <option value="{kraj.NAME}"<!-- IF kraj.DEF --> selected<!-- ENDIF -->>{kraj.NAME}</option>
            <!-- END kraj -->
          </select>
        </div>
        <div class="form-group">
          <input type="email" name="g_email" class="form-control" placeholder="E-mail" required />
          <small class="text-muted">Na ten adres wyślemy szczegóły zakupu</small>
        </div>
        <div class="form-group">
          <input type="text" name="g_phone" class="form-control" placeholder="Telefon" required />
          <small class="text-muted">Podaj numer telefonu. Ułatwi to kontakt ze sprzedającym i kurierem.</small>
        </div>
        <div class="form-group">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="g_invoice" value="1" class="custom-control-input" id="g_invoice">
            <label class="custom-control-label" for="g_invoice">Chcę otrzymać fakturę</label>
          </div>
        </div>
        <div id="invoice-data">
          <div class="form-group">
            <button type="button" name="copy-data" class="btn btn-link"><small class="text-uppercase">Skopiuj z danych do wysyłki</small></button>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-5 col-6">
                <div class="custom-control custom-radio">
                  <input type="radio" id="g_invoice_type1" name="g_invoice_type" value="company" class="custom-control-input" checked>
                  <label class="custom-control-label" for="g_invoice_type1">
                    Firma
                    <small class="d-block text-muted">Kupuję na potrzeby działalności gospodarczej</small>
                  </label>
                </div>
              </div>
              <div class="col-md-5 col-6">
                <div class="custom-control custom-radio">
                  <input type="radio" id="g_invoice_type2" name="g_invoice_type" value="private" class="custom-control-input">
                  <label class="custom-control-label" for="g_invoice_type2">
                    Osoba prywatna
                    <small class="d-block text-muted">Kupuję na potrzeby prywatne</small>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-2">
            <div class="form-group col-lg-6 col-12">
              <input type="text" name="g_inv_name" class="form-control" placeholder="Imię" />
            </div>
            <div class="form-group col-lg-6 col-12">
              <input type="text" name="g_inv_surename" class="form-control" placeholder="Nazwisko" />
            </div>
          </div>
          <div class="form-group" id="g_inv_company_name">
            <input type="text" name="g_inv_company_name" class="form-control" placeholder="Firma" />
          </div>
          <div class="form-group">
            <input type="text" name="g_inv_address" class="form-control" placeholder="Adres" />
            <small class="text-muted">Podaj nazwę ulicy wraz z numerem domu.</small>
          </div>
          <div class="form-group">
            <div class="row">
              <div class="col-xl-3 col-lg-3 col-md-4 col-4"><input type="text" name="g_inv_post_code" class="form-control text-center" placeholder="__-___" /></div>
              <div class="col-xl-9 col-lg-9 col-md-8 col-8 pl-0"><input type="text" name="g_inv_city" class="form-control" placeholder="Miasto" /></div>
            </div>
          </div>
          <div class="form-group">
            <select name="g_inv_country" class="form-control">
              <option value="">Kraj</option>
              <!-- BEGIN kraj -->
              <option value="{kraj.NAME}">{kraj.NAME}</option>
              <!-- END kraj -->
            </select>
          </div>
          <div class="form-group" id="g_inv_tax_number">
            <input type="text" name="g_inv_tax_number" class="form-control" placeholder="NIP" />
          </div>
        </div>
      </div>
      <div class="bg-white border p-3 mt-2">
        <h4 class="mb-0">Przedmioty</h4>
        <!-- BEGIN b -->
        <div id="user{b.USER_ID}">
          <div class="mt-2 mb-3">Sprzedający: {b.USERNAME}</div>
          <!-- BEGIN i -->
          <!-- IF i.SUMMARY -->
          <span class="d-none data-sum" data-sum="{i.PRICE_SUM_DATA}" data-sum-new="{i.PRICE_SUM_DATA}" data-shipping="0.00">{i.PRICE_SUM}</span>
          <!-- ELSE -->
          <div class="row">
            <div class="col-lg-2 col-4 overflow-hidden pr-0" style="max-height:60px;"><img src="{i.PHOTO}" class="mw-100"></div>
            <div class="col-lg-10 col-8">
              <a href="{i.HREF}">{i.TITLE}</a>
              <span class="float-right">{i.PRICE} {i.ITEM_CURRENCY}</span>
              <small class="d-block text-muted">{i.QTY_BASKET} x {i.PRICE} {i.ITEM_CURRENCY}</small>
              <input type="hidden" name="qty[{i.ID}]" value="{i.QTY_BASKET}" />
              <input type="hidden" name="i_id[]" value="{i.ID}" />
            </div>
          </div>
          <!-- ENDIF -->
          <!-- IF .b.i.payment -->
          <h4 class="mt-4">Sposób dostawy</h4>
          <!-- BEGIN payment -->
          <div class="row mb-2">
            <div class="col-lg-9 col-7">
              <div class="custom-control custom-radio">
                <input type="radio" name="payment[{b.USER_ID}]" value="{payment.ID}" class="custom-control-input pmt" data-user_id={b.USER_ID} data-cost="{payment.COST_DATA}" id="pmt{b.USER_ID}{payment.ID}" required>
                <input type="hidden" name="payment_cost[{payment.ID}]"  value="{payment.COST_DATA}" />
                <label class="custom-control-label" for="pmt{b.USER_ID}{payment.ID}">{payment.NAME}</label>
              </div>
            </div>
            <div class="col-lg-3 col-5 text-right">{payment.COST} {ITEM_CURRENCY}</div>
          </div>
          <!-- END payment -->
          <p class="mt-4 mb-0"><textarea name="extra_info" class="form-control" rows="3" placeholder="Wiadomość dla sprzedającego"></textarea></p>
          <!-- ENDIF -->


          <!-- END i -->
        </div>
        <input type="hidden" name="seller_id[]" value="{b.USER_ID}" />
        <!-- END b -->
      </div>
    </div>
    <div class="col-lg-4 col-12">
      <div class="bg-white border p-3 position-sticky" style="top:0;">
        <h4>Podsumowanie</h4>
        <ul class="list-unstyled">
          <li>Wartość zamówienia: <span class="float-right"><span class="sum-items">{PRICE_SUM}</span> {ITEM_CURRENCY}</span></li>
          <li>Dostawa: <span class="float-right"><span class="sum-shipping">0.00</span> {ITEM_CURRENCY}</span></li>
        </ul>
        <hr />
        <big class="d-block text-right">Do zapłaty: <span class="sum-all font-weight-bold">{PRICE_SUM}</span> {ITEM_CURRENCY}</span></big>
        <hr />
        <div class="text-right">
          <!-- INCLUDE tpl_recaptcha.tpl -->
        </div>
        <input type="hidden" name="save-order" value="1" />
        <button type="submit" name="order" value="1" class="btn btn-main mt-2 d-block ml-auto">{_LANG_562}</button>
      </div>
    </div>
  </form>
</section>
