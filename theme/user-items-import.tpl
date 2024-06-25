<!-- INCLUDE tpl_user_open.tpl -->

<!-- INCLUDE tpl_user_items_menu.tpl -->

<!-- IF IMPORT_ERROR -->
<div class="alert alert-warning">
  {_LANG_742} <a href="{SITEURL}/user/settings"><b>{_LANG_739}</b></a>
</div>
<!-- ELSE -->

<!-- IF ALLEGRO_LIST -->

<form method="post" action="{SITEURL}/user/import?op=allegro-import">
  <table class="table table-bordered">
    <tr>
      <th class="text-center"><input type="checkbox" name="" value="select" id="chkbox" onclick="do_this();" /></th>
      <th>Zdjęcie</th>
      <th>Nazwa</th>
      <th>Cena</th>
      <th class="text-nowrap">Stan magazynowy/Sprzedane</th>
      <th class="text-center">Opcje</th>
    <!-- BEGIN a_i -->
    <tr class="">
      <th class="text-center align-middle"><input type="checkbox" name="id[]" value="{a_i.ID}" /></th>
      <td><img src="{a_i.IMAGE}" class="mw-100" style="width:150px;"></td>
      <td class="text-nowrap align-middle">{a_i.NAME} <small>({a_i.ID})</small></td>
      <td class="text-nowrap text-right align-middle">{a_i.PRICE} {a_i.PRICE_CURRENCY}</td>
      <td class="text-nowrap text-center align-middle">{a_i.QTY} / {a_i.QTY_SELL}</td>
      <td class="text-center align-middle">
        <button type="submit" name="allegro_import" value="{a_i.ID}" class="btn btn-primary btn-sm btn-block"><i class="fas fa-file-import mr-2"></i>Importuj</button>
      </td>
    </tr>
    <!-- END a_i -->
  </table>
  <div class="text-right my-4">
    <button type="submit" name="allegro_import" value="checked" class="btn btn-primary btn-sm"><i class="fas fa-file-import mr-2"></i>Importuj wybrane</button>
  </div>
</form>

<!-- ELSE -->

<!-- IF .uif -->
<form method="post">
  <table class="table table-hover mb-0">
    <thead class="thead-light">
      <tr>
        <th>{_LANG_709}</th>
        <th class="text-center">{_LANG_717}</th>
        <th class="text-center">{_LANG_710}</th>
        <th class="text-center">{_LANG_719}</th>
      </tr>
    </thead>
    <tbody>
      <!-- BEGIN uif -->
      <tr>
        <td class="row">
          <div class="col-12 text-truncate" style="max-width:700px;">
            <span class="custom-control custom-checkbox d-inline">
              <input type="checkbox" name="id[]" value="{uif.ID}" class="custom-control-input" id="i{uif.ID}">
              <label class="custom-control-label" for="i{uif.ID}"></label>
            </span>
            <!-- IF uif.FILELINK -->{uif.FILELINK}<!-- ELSE -->{uif.FILENAME}<!-- ENDIF -->
          </div>
        </td>
        <td class="text-center"><!-- IF uif.UPDATE_TIME -->{uif.UPDATE_TIME}<!-- ELSE --><i class="text-secondary">{_LANG_716}</i><!-- ENDIF --></td>
        <td class="text-center">{uif.UPDATE_ITEMS}</td>
        <td class="text-center"><!-- IF uif.ACTIVE --><big class="fas fa-check-circle text-success"></big><!-- ELSE --><big class="fas fa-ban text-warning"></big><!-- ENDIF --></td>
      </tr>
      <!-- END uif -->
    </tbody>
  </table>
  <div class="text-right border-top pt-2">
    <a href="{SITEURL}/user/categories" class="btn btn-dark float-left"><i class="fas fa-ellipsis-v mr-2"></i>{_LANG_725}</a>
    <button type="submit" name="op" value="deactive" class="btn btn-warning"><i class="fas fa-ban"></i> Deaktywuj</button>
    <button type="submit" name="op" value="active" class="btn btn-success"><i class="fas fa-check"></i> Aktywuj</button>
    <button type="submit" name="op" value="delete" class="btn btn-danger"><i class="fas fa-trash"></i> Usuń</button>
  </div>
</form>
<!-- ENDIF -->

<!-- ENDIF -->

<!-- INCLUDE tpl_user_items_import.tpl -->

<!-- ENDIF -->

<!-- INCLUDE tpl_user_close.tpl -->
