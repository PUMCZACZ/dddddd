<!-- INCLUDE theme_header.tpl -->
<section class="items-basket container my-3">

  <h3 class="border-bottom pb-3 mb-3">{_LANG_744}</h3>

  <form method="post" id="basketForm" class="p-relative" onsubmit="$('#loadingForm').css('display', 'block'); $('#basketForm').submit();">
    <div id="loadingForm"></div>
    <!-- IF .b -->
    <table class="table table-striped table-bordered accordion bg-white">
      <tr>
        <th class="text-center"><input type="checkbox" name="chkbox" id="chkbox" value="select" onClick="do_this()" checked /></th>
        <th>{_LANG_745}</th>
        <th class="text-center">{_LANG_746}</th>
        <th></th>
      </tr>
      <!-- BEGIN b -->
      <tr>
        <td class="text-center align-middle"><input type="checkbox" name="id[]" value="{b.USER_ID}" checked /></td>
        <td class="w-50 align-middle">{b.USERNAME}</td>
        <td class="w-25 text-center align-middle">
          {b.COUNT}
        </td>
        <td class="w-25 align-middle">
        </td>
      </tr>
      <tr class="collapse show" id="details{b.USER_ID}">
        <td colspan="4" class="bg-light">
          <div class="row">
            <table class="col-10 offset-1 table table-striped table-bordered table-items table-hover bg-white">
              <tr>
                <th class="text-center"></th>
                <th class="w-50">{_LANG_747}</th>
                <th class="text-center">{_LANG_748}</th>
                <th class="text-center">{_LANG_749}</th>
                <th class="text-center">{_LANG_750}</th>
                <th class="text-center"></th>
              </tr>
              <!-- BEGIN i -->
              <!-- IF i.SUMMARY -->
              <tr>
                <td colspan="6" class="text-right font-weight-bold"><big>{i.PRICE_SUM} {i.ITEM_CURRENCY}</big></td>
              </tr>
              <!-- ELSE -->
              <tr>
                <td class="text-center align-middle"><input type="checkbox" name="i_id_chk[]" value="{i.ID}" checked /></td>
                <td class="align-middle">
                  <img src="{i.PHOTO}" class="border rounded mr-2" style="width:80px;" />
                  <a target="_blank" href="{i.HREF}">{i.TITLE}</a>
                </td>
                <td class="text-center align-middle">{i.PRICE} {i.ITEM_CURRENCY}</td>
                <td class="align-middle text-center" style="width:15%;">
                  <input class="form-control text-center" type="number" step="{i.QTY_STEP}" min="{i.QTY_MIN}" name="qty[{i.ID}]" value="{i.QTY_BASKET}" />
                  <small class="form-text text-muted">{_LANG_751} <b>{i.QTY_MIN}</b> {i.UNIT}</small>
                  <input type="hidden" name="i_id[]" value="{i.ID}" />
                </td>
                <td class="text-right align-middle">{i.PRICE_SUM} {i.ITEM_CURRENCY}</td>
                <td class="text-center align-middle"><button type="submit" name="delete-items" value="{i.ID}" class="btn btn-sm btn-outline-danger" title="{_LANG_752}"><i class="fas fa-trash"></i></button></td>
              </tr>
              <!-- ENDIF -->
              <!-- END i -->
              <tr>
                <td colspan="6">
                  <div class="row">
                    <div class="col">

                    </div>
                    <div class="col text-right">
                      <button type="submit" name="update-items" value="1" class="btn btn-sm btn-outline-success m-2"><i class="fas fa-refresh mr-2"></i>{_LANG_753}</button>
                    </div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </td>
      </tr>
      <!-- END b -->
      <tr>
        <td colspan="3"></td>
        <td>
          <button class="btn btn-primary btn-block" type="submit" name="send-order" value="{b.USER_ID}">{_LANG_754} <i class="fas fa-angle-right ml-2"></i></button>
        </td>
    </table>
    <div class="border-top border-bottom py-3 my-2">
      <div class="row">
        <div class="col-6">
          <button type="submit" name="delete-users" value="1" class="btn btn-danger"><i class="fas fa-trash mr-2"></i> {_LANG_755}</button>
        </div>
        <div class="col-6 text-right">
        </div>
      </div>
    </div>
    <input type="hidden" name="op" value="summary" />
  </form>

  <!-- ELSE -->
  <h4 class="text-center text-secondary">{_LANG_756}</h4>
  <h5 class="text-center text-secondary">{_LANG_757} <a href="{SITEURL}/items/categories">{_LANG_758}</a></h5>
  <!-- ENDIF -->

</section>
<!-- INCLUDE theme_footer.tpl -->
