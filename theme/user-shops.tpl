<!-- INCLUDE tpl_user_open.tpl -->

<div class="user-shops">

  <button type="button" class="btn btn-main btn-sm add-shop" data-toggle="modal" data-target="#addShop"><i class="fas fa-plus"></i> {_LANG_615}</button>

  <form method="post">

    <table class="table table-striped">
      <tr>
        <th></th>
        <th>{_LANG_616}</th>
        <th>{_LANG_617}</th>
        <th class="text-center">{_LANG_618}</th>
        <th>{_LANG_619}</th>
        <th>{_LANG_620}</th>
        <th></th>
      </tr>
      <!-- BEGIN s -->
      <tr>
        <td class="text-center">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="id[]" value="{s.ID}" class="custom-control-input" id="sid{s.ID}">
            <label class="custom-control-label" for="sid{s.ID}"></label>
          </div>
        </td>
        <td class="text-center"><!-- IF s.LOGO --><img style="width:100px;" src="{s.LOGO}" /><!-- ENDIF --></td>
        <td>{s.NAME}</td>
        <td class="text-center">{s.ITEMS_COUNT}</td>
        <td class="text-truncate" style="max-width: 300px;">{s.XML}</td>
        <td class="text-center">
          <button type="button" class="promo btn btn-outline-info btn-sm px-3" data-toggle="modal" data-target="#promoShop" data-id="{s.ID}"><i class="fas fa-star"></i> {_LANG_611}</button>
          <!-- IF s.PROMO -->
          <br />
          <span class="promo" data-toggle="modal" data-target="#promoShop" data-id="{s.ID}">
            <button type="button" class="btn btn-outline-success btn-sm py-1 mt-2" style="font-size:12px;" data-toggle="tooltip" data-placement="top" title="{_LANG_622}">
              <i class="fas fa-check"></i> <!-- IF s.PROMO_TYPE == 1 -->{_LANG_621}<!-- ELSE -->{s.PROMO_END}<!-- ENDIF -->
            </button>
          </span>
          <!-- ENDIF -->
        </td>
        <td class="text-center">
          <a href="{SITEURL}/user/stats?s_id={s.ID}" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="{_LANG_612}"><i class="fas fa-chart-line"></i></a>
          <a href="{SITEURL}/items/categories?s_id={s.ID}&amp;id=0&amp;search=1&amp;end=1" target="_blank" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="{_LANG_613}"><i class="fas fa-eye"></i></a>
          <span data-toggle="modal" data-target="#editShop{s.ID}"><a href="#" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="{_LANG_614}"><i class="fas fa-edit"></i></a></span>
        </td>
      </tr>
      <!-- END s -->
    </table>
    <hr />
    <p class="text-right"><button type="submit" class="btn btn-outline-danger btn-sm" name="delete" value="1" onclick="return confirm('{_LANG_609}?')"><i class="fas fa-trash"></i> Usuń</button></p>

  </form>

</div>

<div class="modal fade" id="addShop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" class="modal-content" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dodanie nowego sklepu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nazwa sklepu<strong class="text-danger ml-1">*</strong></label>
          <input type="text" class="form-control" name="shop_name" required />
        </div>
        <div class="form-group">
          <label>Kategoria sklepu<strong class="text-danger ml-1">*</strong></label>
          <select name="cat_id" class="form-control" required>
            <option value="">{_LANG_446}</option>
            <!-- BEGIN cp -->
            <option value="{cp.ID}">{cp.NAME}</option>
            <!-- END cp -->
          </select>
        </div>
        <div class="form-group">
          <label>Opis sklepu<strong class="text-danger ml-1">*</strong></label>
          <textarea class="form-control" rows="3" name="description" required></textarea>
        </div>
        <div class="form-group">
          <label>Logo sklepu</label>
          <input type="file" class="form-control" name="logo" />
        </div>
        <div class="form-group">
          <label>Adres pliku XML<strong class="text-danger ml-1">*</strong></label>
          <input type="url" class="form-control" name="xml" required />
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="only_pics" value="1" class="custom-control-input" id="onlyPics" checked />
            <label class="custom-control-label" for="onlyPics">Importuj ogłoszenia tylko ze zdjęciami</label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Anuluj</button>
        <button type="submit" class="btn btn-primary" name="add-shop" value="1"><i class="fas fa-plus"></i> Dodaj</button>
      </div>
    </form>
  </div>
</div>

<!-- BEGIN s -->
<div class="modal fade" id="editShop{s.ID}" tabindex="-1" role="dialog" aria-labelledby="editShop{s.ID}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" class="modal-content" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edycja sklepu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nazwa sklepu<strong class="text-danger ml-1">*</strong></label>
          <input type="text" class="form-control" name="shop_name" value="{s.NAME}" required />
        </div>
        <div class="form-group">
          <label>Kategoria sklepu<strong class="text-danger ml-1">*</strong></label>
          <select name="cat_id" class="form-control" required>
            <option value="">{_LANG_446}</option>
            <!-- BEGIN c -->
            <option value="{c.ID}"<!-- IF s.CAT_ID == c.ID --> selected<!-- ENDIF -->>{c.NAME}</option>
            <!-- END c -->
          </select>
        </div>
        <div class="form-group">
          <label>Opis sklepu<strong class="text-danger ml-1">*</strong></label>
          <textarea class="form-control" rows="3" name="description" required>{s.DESCRIPTION}</textarea>
        </div>
        <div class="form-group">
          <label>Logo sklepu</label>
          <!-- IF s.LOGO --><img class="d-block" style="width:100px;" src="{s.LOGO}" /><!-- ENDIF -->
          <input type="file" class="form-control" name="logo" />
        </div>
        <div class="form-group">
          <label>Adres pliku XML<strong class="text-danger ml-1">*</strong></label>
          <input type="url" class="form-control" name="xml" value="{s.XML}" required />
          <div class="custom-control custom-checkbox">
            <input type="checkbox" name="only_pics" value="1" class="custom-control-input"<!-- IF s.ONLY_PICS --> checked<!-- ENDIF --> id="onlyPics{s.ID}">
            <label class="custom-control-label" for="onlyPics{s.ID}">Importuj ogłoszenia tylko ze zdjęciami</label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="s_id" value="{s.ID}" />
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Anuluj</button>
        <button type="submit" class="btn btn-primary" name="save-shop" value="1"><i class="fas fa-save"></i> Zapisz zmiany</button>
      </div>
    </form>
  </div>
</div>
<!-- END s -->

<div class="modal fade" id="promoShop" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Promowanie sklepu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="font-weight-bold">Czas promocji</label>
          <div class="custom-control custom-radio">
            <input type="radio" id="promoTime1" name="promoType" value="1" class="custom-control-input" checked>
            <label class="custom-control-label" for="promoTime1">Bez ograniczeń czasowych</label>
          </div>
          <div class="custom-control custom-radio">
            <input type="radio" id="promoTime2" name="promoType" value="2" class="custom-control-input">
            <label class="custom-control-label" for="promoTime2">Określony czas promocji</label>
          </div>
        </div>
        <div class="form-group dateInput">
          <label class="font-weight-bold">Data zakończenia promocji</label>
          <div class="form-inline"><input type="date" name="promoDate" class="form-control" /></div>
        </div>
        <div class="form-group promoPrice">
          <label class="d-block font-weight-bold">Koszt promocji</label>
          <span id="price1">10.00 {CURRENCY}/dziennie</span>
          <span id="price2"><span>10.00</span> {CURRENCY}</span>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="s_id" value="0" />
        <button type="submit" class="btn btn-outline-danger btn-sm mr-auto" name="delete-promo" value="1"><i class="fas fa-power-off"></i> Wyłącz prmocję</button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Anuluj</button>
        <button type="submit" class="btn btn-primary" name="promo-shop" value="1"><i class="fas fa-star"></i> Dodaj</button>
      </div>
    </form>
  </div>
</div>

<!-- INCLUDE tpl_user_close.tpl -->
