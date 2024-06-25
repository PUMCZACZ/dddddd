<div class="items" id="list">
  <div class="items-list">

    <!-- BEGIN o -->

    <!-- IF .o.i -->
    <div class="item-box col-12 mb-4">
      <div class="row item item-user">

        <div class="col-6 mb-2 order-date">
          <!-- IF OP == 'info' -->
          {_LANG_737} {o.USERNAME_BUYER}
          <!-- ELSE -->
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="id[]" value="{o.OI_ID}" class="custom-control-input id-input" id="u-{o.USER_ID}-o-{o.O_ID}">
            <label class="custom-control-label" for="u-{o.USER_ID}-o-{o.O_ID}"></label>
            {_LANG_737} {o.USERNAME_BUYER}
          </div>
          <!-- ENDIF -->
        </div>
        <div class="col-6 mb-2 order-date">
          {i.ORDER_DATE}
        </div>

        <!-- BEGIN i -->
        <div class="img px-md-2 p-0 col-1 img-height">
          <a title="{i.TITLE}" href="{i.HREF}"><img class="mw-100" alt="{i.TITLE}" src="{i.PHOTO}" /></a>

        </div>
        <div class="col-11">

          <div class="row">
            <div class="col-7">
              <h2 class="mt-0">
                <a title="{i.TITLE}" href="{i.HREF}">{i.TITLE}  <small class="text-secondary">({i.ID})</small></a>
              </h2>
            </div>
            <div class="col text-right">
              <span class="d-block text-right">{i.QTY_ORDER} x <!-- IF i.PRICE == 0 -->{_LANG_512}<!-- ELSE -->{i.PRICE} {i.ITEM_CURRENCY}<!-- IF i.UNIT --> / {i.UNIT}<!-- ENDIF --><!-- ENDIF --></span>
              <span class="mt-2 badge badge-<!-- IF i.TYPE == 270 -->success<!-- ELSEIF i.TYPE == 271 -->danger<!-- ENDIF --> d-inline-block text-uppercase p-2">{i.TYPE_NAME}</span>
            </div>
            <div class="col text-right">
              <span class="d-block">{i.ITEM_PRICE_SUM} {i.ITEM_CURRENCY}</span>
              <span class="mt-2 badge badge-<!-- IF i.TYPE == 270 -->success<!-- ELSEIF i.TYPE == 271 -->danger<!-- ENDIF --> d-inline-block text-uppercase p-2">{i.TYPE_NAME}</span>
            </div>
          </div>

        </div>
        <!-- END i -->

          <div id="id-{i.O_ID}" class="d-none">
            <!-- IF i.COMPANY_NAME -->{i.COMPANY_NAME}<br /><!-- ENDIF -->
            <!-- IF i.NAME -->{i.NAME}<br /><!-- ENDIF -->
            {i.STREET}<br />
            {i.POST_CODE} {i.CITY}
          </div>
          <div class="col-12 border-top pt-2 mt-2">
            <div class="row">
              <div class="col">
                <a href="{SITEURL}/user/items_sale?op=info&amp;id={i.O_ID}" class="btn btn-link text-uppercase">{_LANG_640}</a>
                <a href="{SITEURL}/user/items_sale?op=info&amp;id={i.O_ID}#comment" class="btn btn-link text-uppercase">{_LANG_641}</a>
                <!-- IF SHIPPING_INPOST --><a href="#" data-toggle="modal" data-target="#shippingForm" data-id="{i.O_ID}" class="show-shipping-details btn btn-link text-uppercase"><img class="mr-2 align-middle" src="{SITEURL}/theme/img/shippment-logo-inpost.png" />Nadaj przesyłkę</a><!-- ENDIF -->
              </div>
              <div class="col">
                <h5 class="text-right mt-1">{_LANG_341} <strong class="text-success">{i.ORDER_SUM} {i.ITEM_CURRENCY}</strong></h5>
              </div>
            </div>
        </div>

      </div>
    </div>
    <!-- ENDIF -->

    <!-- END o -->

  </div>
</div>
