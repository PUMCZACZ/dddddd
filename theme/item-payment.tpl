<!-- INCLUDE theme_header.tpl -->
<main class="item-payment item-add row">
  <div class="col-10 offset-1">
    <h4 class="mt-4"><strong>{TITLE}</strong></h4>
    <hr />
    <h6 class="my-4">Wypromuj swoje ogłoszenie i zyskaj więcej wyświetleń!</h6>
    <form method="post" class="card mt-3">
      <div class="card-header">
        <span class="title">{_LANG_515}</span>
      </div>
      <div class="card-body p-0">
        <div class="form-inline p-3">
          Czas emisji:
          <select name="time" id="item_time" class="form-control ml-2" onChange="promoPrice(this.value);updateAddPrice(this.value);" <!-- IF ACTIVE == 0 -->required<!-- ELSE -->disabled<!-- ENDIF -->>
            <!-- BEGIN item_time -->
            <option value="{item_time.NAME}" data-price="{item_time.PRICE}"<!-- IF TIME == item_time.NAME --> selected<!-- ENDIF -->>{item_time.NAME} {_LANG_489}<!-- IF USER_MEMBER == '' --> ({item_time.PRICE} {CURRENCY})<!-- ENDIF --></option>
            <!-- END item_time -->
          </select>
        </div>
        <hr />
        <ul class="row promo-list list-unstyled my-5" id="promo-list">
          <li class="col-md-3 col-12 text-center px-2">
            <input type="checkbox" class="promo" name="promo_bold" value="1"<!-- IF PROMO_BOLD == 1 --> checked<!-- ENDIF --> onChange="updateAddPrice(this.name);" id="promo-b" />
            <label for="promo-b" class="box p-3 align-top">
              <p class="icon"><i class="fas fa-bold"></i></p>
              <h6 class="my-3"><strong>{_LANG_516}</strong></h6>
              <div class="info mt-4 mb-0">
                <p>{_LANG_517}</p>
                <big class="d-block my-3">
                  {_LANG_518}
                  <!-- BEGIN promo_bold -->
                  <span data-value="{promo_bold.EXTRA}" data-price="{promo_bold.VALUE_FROM}" class="<!-- IF TIME == promo_bold.EXTRA -->active d-inline<!-- ELSE -->d-none<!-- ENDIF -->">{promo_bold.VALUE_FROM}</span>
                  <!-- END promo_bold -->
                  {CURRENCY} {_LANG_519}
                </big>
                <div class="select">wybierz opcję</div>
              </div>
            </label>
          </li>
          <li class="col-md-3 col-12 text-center px-2">
            <input type="checkbox" class="promo" name="promo_backlight" value="1"<!-- IF PROMO_BACKLIGHT == 1 --> checked<!-- ENDIF --> onChange="updateAddPrice(this.name);" id="promo-bck" />
            <label for="promo-bck" class="box p-3 align-top">
              <p class="icon"><i class="fas fa-highlighter"></i></p>
              <h6 class="my-3"><strong>{_LANG_520}</strong></h6>
              <div class="info mt-4 mb-0">
                <p>{_LANG_521}</p>
                <big class="d-block my-3">
                  {_LANG_518}
                  <!-- BEGIN promo_backlight -->
                  <span data-value="{promo_backlight.EXTRA}" data-price="{promo_backlight.VALUE_FROM}" class="<!-- IF TIME == promo_backlight.EXTRA -->active d-inline<!-- ELSE -->d-none<!-- ENDIF -->">{promo_backlight.VALUE_FROM}</span>
                  <!-- END promo_backlight -->
                  {CURRENCY} {_LANG_519}
                </big>
                <div class="select">wybierz opcję</div>
              </div>
            </label>
          </li>
          <li class="col-md-3 col-12 text-center px-2">
            <input type="checkbox" class="promo" name="promo_distinction" value="1"<!-- IF PROMO_DISTINCTION == 1 --> checked<!-- ENDIF --> onChange="updateAddPrice(this.name);" id="promo-d" />
            <label for="promo-d" class="box p-3 align-top">
              <p class="icon"><i class="fas fa-star"></i></p>
              <h6 class="my-3"><strong>{_LANG_522}</strong></h6>
              <div class="info mt-4 mb-0">
                <p>{_LANG_523}</p>
                <big class="d-block my-3">
                  {_LANG_518}
                  <!-- BEGIN promo_distinction -->
                  <span data-value="{promo_distinction.EXTRA}" data-price="{promo_distinction.VALUE_FROM}" class="<!-- IF TIME == promo_distinction.EXTRA -->active d-inline<!-- ELSE -->d-none<!-- ENDIF -->">{promo_distinction.VALUE_FROM}</span>
                  <!-- END promo_distinction -->
                  {CURRENCY} {_LANG_519}
                </big>
                <div class="select">wybierz opcję</div>
              </div>
            </label>
          </li>
          <li class="col-md-3 col-12 text-center px-2">
            <input type="checkbox" class="promo" name="promo_mainpage" value="1"<!-- IF PROMO_MAINPAGE == 1 --> checked<!-- ENDIF --> onChange="updateAddPrice(this.name);" id="promo-mp" />
            <label for="promo-mp" class="box p-3 align-top">
              <p class="icon"><i class="fas fa-home"></i></p>
              <h6 class="my-3"><strong>{_LANG_524}</strong></h6>
              <div class="info mt-4 mb-0">
                <p>{_LANG_525}</p>
                <big class="d-block my-3">
                  {_LANG_518}
                  <!-- BEGIN promo_mainpage -->
                  <span data-value="{promo_mainpage.EXTRA}" data-price="{promo_mainpage.VALUE_FROM}" class="<!-- IF TIME == promo_mainpage.EXTRA -->active d-inline<!-- ELSE -->d-none<!-- ENDIF -->">{promo_mainpage.VALUE_FROM}</span>
                  <!-- END promo_mainpage -->
                  {CURRENCY} {_LANG_519}
                </big>
                <div class="select">wybierz opcję</div>
              </div>
            </label>
          </li>
        </ul>
        <hr />
        <div class="text-right pt-3 pb-4 px-4">
          Do zapłaty: <big style="font-weight:bold;"><span id="pay_sum">{PAY_SUM}</span> {CURRENCY}</big>
        </div>
      </div>
      <div class="card-footer text-right">
        <input type="hidden" name="id" value="{ID}" />
        <a href="funcs.php?name=user" class="btn btn-outline-primary px-5 mr-3">{_LANG_563}</a>
        <button type="submit" name="pay" value="1" class="btn btn-primary px-5">{_LANG_562}</button>
      </div>
    </form>
  </div>
</main>
<!-- INCLUDE theme_footer.tpl -->
