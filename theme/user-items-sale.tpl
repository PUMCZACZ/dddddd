<!-- INCLUDE tpl_user_open.tpl -->

<!-- INCLUDE tpl_user_items_menu.tpl -->

<div class="user-items user-orders">

  <!-- IF OP == 'info' -->

  <div class="order-info row">
    <div class="col-12">
      <div class="rounded border">
        <!-- INCLUDE tpl_items_list.tpl -->
        <div class="row mx-0 pb-3 bg-light text-right">
          <div class="col-1 bg-light"></div>
          <div class="col-8">{SHIPPING_NAME}</div>
          <div class="col-3">{SHIPPING_COST} {ITEM_CURRENCY}</div>
        </div>
        <h4 class="bg-light border-top text-right m-0 p-2 pt-0">
          {_LANG_666} <big><b>{ORDER_SUM}</b></big> {ITEM_CURRENCY}
        </h4>
      </div>
      <div class="rounded border p-3 my-3">
        <h4 class="border-bottom pb-2 mb-3">{_LANG_665}</h4>
        <div class="row">
          <address class="col">
            <h6 class="text-uppercase text-secondary font-weight-bold">{_LANG_646}</h6>
            <a class="text-primary" href="{SITEURL}/items/categories?user_id={USER_ID}&amp;id=0&amp;search=1&amp;end=1">{USERNAME}</a><br />
            <!-- IF COMPANY_NAME -->{COMPANY_NAME}<br /><!-- ENDIF -->
            {NAME}
          </address>
          <address class="col">
            <h6 class="text-uppercase text-secondary font-weight-bold">{_LANG_647}</h6>
            {STREET}<br />
            {POST_CODE} {CITY}
          </address>
          <address class="col">
            <h6 class="text-uppercase text-secondary font-weight-bold">{_LANG_648}</h6>
            <!-- IF PHONE --><a class="text-primary mb-2" href="tel:{PHONE}">{PHONE}</a><br /><!-- ENDIF -->
            <a class="text-primary" href="mailto:{USER_EMAIL}">{USER_EMAIL}</a>
          </address>
          <address class="col-12">
            <h6 class="text-uppercase text-secondary font-weight-bold">{_LANG_667}</h6>
            <!-- IF MESSAGE -->{MESSAGE}<!-- ELSE --><i class="text-secondary">{_LANG_668}</i><!-- ENDIF -->
          </address>
        </div>
      </div>
      <div class="rounded border p-3 my-3">
        <h4 class="border-bottom pb-2 mb-3">Przesyłka</h4>
        <form method="post" class="row">
          <div class="col-lg-4 col-12">
            <div class="form-group">
              <label><b>Nazwa przewoźnika</b></label>
              <input type="text" name="shipping_operator_name" value="{SHIPPING_OPERATOR_NAME}" class="form-control" />
            </div>
            <div class="form-group">
              <label><b>Numer przesyłki</b></label>
              <input type="text" name="shipping_operator_number" value="{SHIPPING_OPERATOR_NUMBER}" class="form-control" />
            </div>
            <div class="text-right border-top pt-2">
              <input type="hidden" name="o_id" value="{ID}" />
              <button type="submit" name="shipping-operator-add" value="1" class="btn btn-primary">Zapisz zmiany</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- IF ITEMS_COMMENTS -->
    <form method="post" class="col-12 rounded border p-3 my-3 mx-3">
      <h4 class="border-bottom pb-2 mb-3" id="comment">{_LANG_649}</h4>
      <!-- IF COMMENT_TYPE -->
      <p class="text-<!-- IF COMMENT_TYPE == 1 -->success<!-- ELSEIF COMMENT_TYPE == 0 -->dark<!-- ELSEIF COMMENT_TYPE == -1 -->danger<!-- ENDIF -->">
        <!-- IF COMMENT_TYPE == 1 -->{_LANG_650}<!-- ELSEIF COMMENT_TYPE == 0 -->{_LANG_651}<!-- ELSEIF COMMENT_TYPE == -1 -->{_LANG_652}<!-- ENDIF -->
      </p>
      <!-- IF COMMENT --><p><q><i>{COMMENT}</i></q></p><!-- ENDIF -->
      <!--
      <div class="row">
        <div class="col-xl-6">
          <div class="form-group row mb-2">
            <div class="col-lg-7">{_LANG_654}</div>
            <div class="col-lg-5 text-right">
              <span class="ocena" id="rating-1"></span>
              <input id="rating-1-text" name="rating-1" type="hidden" />
            </div>
          </div>
          <div class="form-group row mb-2">
            <div class="col-lg-7">{_LANG_655}</div>
            <div class="col-lg-5 text-right">
              <span class="ocena" id="rating-2"></span>
              <input id="rating-2-text" name="rating-2" type="hidden" />
            </div>
          </div>
          <div class="form-group row mb-2">
            <div class="col-lg-7">{_LANG_656}</div>
            <div class="col-lg-5 text-right">
              <span class="ocena" id="rating-3"></span>
              <input id="rating-3-text" name="rating-3" type="hidden" />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-7">{_LANG_657}</div>
            <div class="col-lg-5 text-right">
              <span class="ocena" id="rating-4"></span>
              <input id="rating-4-text" name="rating-4" type="hidden" />
            </div>
          </div>
        </div>
      </div>
      -->
      <!-- ELSE -->
      <div class="row">
        <div class="col-xl-6">
          <div class="form-group">
            <div class="custom-control custom-radio d-inline">
              <input type="radio" name="type" value="1" checked id="type1" class="custom-control-input">
              <label class="custom-control-label text-success" for="type1">{_LANG_650}</label>
            </div>
            <div class="custom-control custom-radio d-inline mx-4">
              <input type="radio" name="type" value="0" id="type2" class="custom-control-input">
              <label class="custom-control-label" for="type2">{_LANG_651}</label>
            </div>
            <div class="custom-control custom-radio d-inline">
              <input type="radio" name="type" value="-1" id="type3" class="custom-control-input">
              <label class="custom-control-label text-danger" for="type3">{_LANG_652}</label>
            </div>
          </div>
          <div class="form-group">
            <textarea name="comment" class="form-control" rows="3" placeholder="{_LANG_653}"></textarea>
          </div>
          <!--
          <div class="form-group row mb-2">
            <div class="col-lg-7">{_LANG_654}</div>
            <div class="col-lg-5 text-right">
              <span class="ocena" id="rating-1"></span>
              <input id="rating-1-text" name="rating-1" type="hidden" />
            </div>
          </div>
          <div class="form-group row mb-2">
            <div class="col-lg-7">{_LANG_655}</div>
            <div class="col-lg-5 text-right">
              <span class="ocena" id="rating-2"></span>
              <input id="rating-2-text" name="rating-2" type="hidden" />
            </div>
          </div>
          <div class="form-group row mb-2">
            <div class="col-lg-7">{_LANG_656}</div>
            <div class="col-lg-5 text-right">
              <span class="ocena" id="rating-3"></span>
              <input id="rating-3-text" name="rating-3" type="hidden" />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-7">{_LANG_657}</div>
            <div class="col-lg-5 text-right">
              <span class="ocena" id="rating-4"></span>
              <input id="rating-4-text" name="rating-4" type="hidden" />
            </div>
          </div>
          -->
          <div class="text-right border-top pt-2">
            <input type="hidden" name="o_id" value="{ID}" />
            <button type="submit" name="comment-add" value="1" class="btn btn-primary"><i class="fas fa-clipboard-check mr-2"></i>{_LANG_658}</button>
          </div>
        </div>
      </div>
      <!-- ENDIF -->
    </form>
    <!-- ENDIF -->

  </div>

  <!-- ELSE -->

  <div class="row mb-3">
    <div class="col">
      <div class="custom-control custom-checkbox ml-1">
        <input type="checkbox" value="select" class="custom-control-input id-input" id="chkbox" onclick="do_this();">
        <label class="custom-control-label" for="chkbox">{_LANG_643}</label>
      </div>
    </div>
    <form method="get" class="col">
      <input type="hidden" name="name" value="user" />
      <input type="hidden" name="file" value="items_sale" />
      <!-- IF STATUS --><input type="hidden" name="status" value="{STATUS}" /><!-- ENDIF -->
      <div class="input-group">
        <input type="text" name="string" value="{STRING}" class="form-control" placeholder="{_LANG_644}" />
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit" name="search" value="1"><i class="fas fa-search"></i></button>
        </div>
      </div>
    </form>
  </div>

  <form method="post">

    <!-- IF .o -->
    <div class="row">
      <div class="col-12 p-0">
        <!-- INCLUDE tpl_user_items_sale.tpl -->
        <ul class="pagination justify-content-center">{PAGER}</ul>
      </div>
    </div>
    <div class="op-menu bg-dark p-3 text-right" style="bottom:0; margin:0 -10px 10px;">
      <!--<button type="submit" name="comment-group" value="1" class="btn btn-sm btn-light mr-2"><i class="far fa-comments mr-2"></i>{_LANG_641}</button>-->
      <button type="submit" name="delete" value="1" class="btn btn-sm btn-light"><i class="far fa-trash-alt mr-2"></i>{_LANG_182}</button>
    </div>
    <!-- ELSE -->
    <h4 class="font-weight-bold text-center text-secondary">{_LANG_663}</h4>
    <h5 class="text-center text-secondary">{_LANG_664}</h5>
    <!-- ENDIF -->

  </form>

  <!-- ENDIF -->

</div>

<div class="modal fade" id="shippingForm" tabindex="-1" aria-labelledby="shippingFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="shippingFormLabel">Nadawanie przesyłki</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- IF SHIPPING_INPOST_PRICE > USER_BALLANCE && SHIPPING_INPOST_PRICE2 > USER_BALLANCE -->
        <div class="alert alert-danger">
          Nie posiadasz wystarczającej ilości środków na swoim koncie.<br />
          Koszt jednej przesyłki to <b>od {SHIPPING_INPOST_PRICE} {CURRENCY} do {SHIPPING_INPOST_PRICE2} {CURRENCY}</b><br />
          Przejdź do <a href="{SITEURL}/user/payments"><b>płatności</b></a> i doładuj swoje konto
        </div>
        <!-- ELSE -->
        <div class="row mt-2">
          <div class="col-12"><h6><b>Rodzaj przesyłki:</b></h6></div>
          <div class="col">
            <div class="custom-control custom-radio">
              <input name="shipping_type" value="inpost_locker_standard" type="radio" class="custom-control-input" id="shipping_type1" data-price="{SHIPPING_INPOST_PRICE}" checked<!-- IF SHIPPING_INPOST_PRICE > USER_BALLANCE --> disabled<!-- ENDIF --> />
              <label class="custom-control-label" for="shipping_type1">Paczkomat ({SHIPPING_INPOST_PRICE} {CURRENCY})</label>
            </div>
          </div>
          <div class="col">
            <div class="custom-control custom-radio">
              <input name="shipping_type" value="inpost_courier_standard" type="radio" class="custom-control-input" id="shipping_type2" data-price="{SHIPPING_INPOST_PRICE2}"<!-- IF SHIPPING_INPOST_PRICE2 > USER_BALLANCE --> disabled<!-- ENDIF --> />
              <label class="custom-control-label" for="shipping_type2">Kurier ({SHIPPING_INPOST_PRICE2} {CURRENCY})</label>
            </div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col">
            <h6><b>Odbiorca:</b></h6>
            <div id="buyer-info"></div>
          </div>
          <div class="col" id="locker-map">
            <h6 class="mt-3"><b>Lokalizacja paczkomatu</b></h6>
            <div class="form-group" id="shippingPoint">
            </div>
            <div class="form-group">
              <button type="button" onclick="openModalMap(); return false;" class="btn btn-main"><i class="fas fa-map-marker-alt mr-2"></i>Pokaż mapę</button>
            </div>
          </div>
        </div>
        <input type="hidden" name="shipping_point" value="" />
        <input type="hidden" name="shipping_o_id" value="" />
        <div class="border-top pt-3 mt-3">
          <div class="alert-chose alert alert-warning">Prosimy wybrać lokalizację paczkomatu</div>
          <div class="row">
            <div class="col-5"><div class="alert alert-info py-2">Koszt przesyłki: <b><span id="shipping-price">{SHIPPING_INPOST_PRICE}</span> {CURRENCY}</b></div></div>
            <div class="col ml-auto text-right"><button type="submit" name="op" value="shipping-create" disabled class="btn btn-main"><i class="fas fa-map mr-2"></i>Generuj list przewozowy</button></div>
          </div>
        </div>
        <!-- ENDIF -->
      </div>
    </form>
  </div>
</div>

<!-- INCLUDE tpl_user_close.tpl -->
