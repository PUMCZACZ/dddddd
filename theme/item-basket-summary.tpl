<!-- INCLUDE theme_header.tpl -->

<!-- IF IS_USER -->

<section class="items-basket container my-3">

  <h3 class="border-bottom border-info pb-3 mb-5">{_LANG_760}</h3>

  <form method="post" id="basketForm" class="p-relative" onsubmit="$('#loadingForm').css('display', 'block'); $('#basketForm').submit();">
    <div id="loadingForm"></div>
    <!-- IF .b -->
    <div class="row">
      <div class="col-10 offset-1">
        <!-- BEGIN b -->
        <h4 class="border-bottom pb-3 mb-3">{_LANG_745}: <!-- IF b.COMPANY_NAME -->{b.COMPANY_NAME}<!-- ELSE -->{b.USERNAME}<!-- ENDIF --></h4>
        <table class="table table-striped table-bordered table-items table-hover bg-white" id="user{b.USER_ID}">
          <tr>
            <th class="w-50 p-2">{_LANG_747}</th>
            <th class="text-center p-2">{_LANG_748}</th>
            <th class="text-center p-2">{_LANG_749}</th>
            <th class="text-center p-2">{_LANG_750}</th>
          </tr>
          <!-- BEGIN i -->
          <!-- IF .b.i.payment -->
          <tr>
            <td colspan="3" class="text-right align-middle p-3">
              <big class="font-weight-bold">{_LANG_761}: <b class="text-danger">*</b></big>
            </td>
            <td class="p-3">
              <!-- BEGIN payment -->
              <!-- IF payment.CHECKED -->
              <div class="custom-control custom-radio">
                <input type="radio" name="payment[{b.USER_ID}]" value="{payment.ID}" class="custom-control-input pmt" data-user_id={b.USER_ID} data-cost="{payment.COST_DATA}" id="pmt{b.USER_ID}{payment.ID}" required>
                <input type="hidden" name="payment_cost[{payment.ID}]" value="{payment.COST_DATA}" />
                <label class="custom-control-label" for="pmt{b.USER_ID}{payment.ID}">{payment.NAME}  (+<span class="pmt-info">{payment.COST}</span> {i.ITEM_CURRENCY})</label>
              </div>
              <!-- ENDIF -->
              <!-- END payment -->
            </td>
          </tr>
          <!-- ENDIF -->
          <!-- IF i.SUMMARY -->
          <tr>
            <td colspan="4" class="text-right p-3">{_LANG_762}: <big class="font-weight-bold data-sum" data-sum="{i.PRICE_SUM_DATA}" data-sum-new="{i.PRICE_SUM_DATA}">{i.PRICE_SUM}</big> <big class="font-weight-bold">{i.ITEM_CURRENCY}</big></td>
          </tr>
          <!-- ELSE -->
          <tr>
            <td class="align-middle">
              <img src="{i.PHOTO}" class="border rounded mr-2" style="width:80px;" />
              <a target="_blank" href="{i.HREF}">{i.TITLE}</a>
            </td>
            <td class="text-center align-middle">{i.PRICE} {i.ITEM_CURRENCY}</td>
            <td class="align-middle text-center" style="width:15%;">
              {i.QTY_BASKET}
              <input type="hidden" name="qty[{i.ID}]" value="{i.QTY_BASKET}" />
              <input type="hidden" name="i_id[]" value="{i.ID}" />
            </td>
            <td class="text-right align-middle">{i.PRICE_SUM} {i.ITEM_CURRENCY}</td>
          </tr>
          <!-- ENDIF -->
          <!-- END i -->
        </table>
        <input type="hidden" name="seller_id[]" value="{b.USER_ID}" />
        <!-- END b -->
        <h4 class="text-right font-wieght-bold border-bottom pt-4 pb-5 mb-2">
          {_LANG_763}: <b class="sum-all">0,00</b>
        </h4>
        <div class="row">
          <div class="col text-center">
            <button class="btn btn-success" type="submit" name="save-order" value="{b.USER_ID}"><i class="fas fa-paper-plane mr-2"></i> {_LANG_764}</button>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="op" value="summary" />
  </form>

  <!-- ELSE -->
  <h4 class="text-center text-secondary">{_LANG_756}</h4>
  <h5 class="text-center text-secondary">{_LANG_757} <a href="{SITEURL}/items/categories?i_type=270&amp;search=1&amp;end=1">{_LANG_758}</a></h5>
  <!-- ENDIF -->

</section>

<!-- ELSE -->
<!-- INCLUDE item-guest-buy.tpl -->
<!-- ENDIF -->

<!-- INCLUDE theme_footer.tpl -->
