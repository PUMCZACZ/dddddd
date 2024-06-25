<!-- INCLUDE tpl_user_open.tpl -->

<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#auctionAdd">
  Dodaj nową aukcję
</button>

<table class="table table-striped">
  <thead>
    <tr>
      <th>Nazwa</th>
      <th>Ilość licytacji</th>
      <th>Data rozpoczęcia</th>
      <th>Data zakończenia</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <!-- BEGIN auctions -->
    <tr class="align-middle">
      <td class="align-middle">{auctions.NAME}</td>
      <td class="align-middle text-center"><a class="text-primary" href="{SITEURL}/user/items_list?auc_id={auctions.ID}&amp;search=1&amp;end=1">{auctions.COUNT}<i class="fas fa-search ml-2"></i></a></td>
      <td class="align-middle">{auctions.DATE_START}</td>
      <td class="align-middle">{auctions.DATE_END}</td>
      <td class="text-center align-middle">
        <a data-toggle="tooltip" data-placement="top" title="Lista licytacji" href="{SITEURL}/user/items_list?auc_id={auctions.ID}&amp;search=1&amp;end=1" class="text-primary"><i class="fas fa-list"></i></a>
        <a href="#" data-toggle="modal" data-target="#auctionEdit{auctions.ID}" class="text-primary mx-3 edit-button"><i data-toggle="tooltip" data-placement="top" title="Edytuj" class="fas fa-pen"></i></a>
        <a data-toggle="tooltip" data-placement="top" title="Usuń" href="{SITEURL}/user/items_auctions?delete={auctions.ID}" onclick="return confirm('Na pewno usunąć aukcję?');" class="text-danger"><i class="fas fa-trash"></i></a>
      </td>
    </td>
    <!-- END auctions -->
  </tbody>
</table>

<div class="modal fade" id="auctionAdd" tabindex="-1" aria-labelledby="auctionAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="auctionAddLabel">Dodaj aukcję</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row form-group">
          <div class="col-lg-6 col-12">
            <label>Nazwa aukcji <span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="auction_name" value="{AUCTION_NAME}" class="form-control" maxlength="50" required />
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-6 col-12">
            <label>Miejscowość <span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="auction_location[city]" value="{AUCTION_LOCATION_CITY}" class="form-control" required />
          </div>
          <div class="col-lg-6 col-12">
            <label>Adres <span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="auction_location[address]" value="{AUCTION_LOCATION_ADDRESS}" class="form-control" required />
          </div>
          <div class="col-lg-6 col-12">
            <label>Kraj <span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="auction_location[country]" value="{AUCTION_LOCATION_COUNTRY}" class="form-control" required />
          </div>
          <div class="col-lg-6 col-12">
            <label>Telefon <span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="auction_location[phone]" value="{AUCTION_LOCATION_PHONE}" class="form-control" required />
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-4 col-12">
            <label>Data rozpoczęcia <span class="font-weight-bold text-danger">*</span></label>
            <input type="datetime-local" name="auction_date_start" value="{AUCTION_DATE_START}" min="{AUCTION_DATE_MIN}" class="form-control" required />
          </div>
          <div class="col-lg-4 col-12">
            <label>Data zakończenia <span class="font-weight-bold text-danger">*</span></label>
            <input type="datetime-local" name="auction_date_end" value="{AUCTION_DATE_END}" min="{AUCTION_DATE_MIN}" class="form-control" required />
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-9 col-12" id="date-view-block">
            <label>Dni oglądania <span class="font-weight-bold text-danger">*</span></label>
            <div class="row mb-2 date-view-inputs">
              <div class="col-5"><input type="date" name="auction_dates[view_date][]" value="{AUCTION_DATES_VIEW_DATE}" class="form-control" required /></div>
              <div class="col px-0">
                od <input type="time" name="auction_dates[view_time_start][]" value="{AUCTION_DATES_VIEW_TIME_START}" class="form-control d-inline" style="width:120px" required />
                do <input type="time" name="auction_dates[view_time_end][]" value="{AUCTION_DATES_VIEW_TIME_END}" class="form-control d-inline" style="width:120px" required />
              </div>
              <div class="col-1 px-0 date-view-add"><button type="button" name="date-view-add" value="1" class="btn btn-link text-primary"><i class="fas fa-plus"></i></button></div>
              <div class="col-1 px-0 date-view-delete"><button type="button" name="date-view-delete" value="1" class="btn btn-link text-danger"><i class="fas fa-times"></i></button></div>
            </div>
          </div>
          <div class="col-lg-9 col-12" id="date-pickup-block">
            <label>Dni odbioru <span class="font-weight-bold text-danger">*</span></label>
            <div class="row mb-2 date-pickup-inputs">
              <div class="col-5"><input type="date" name="auction_dates[pickup_date][]" value="{AUCTION_DATES_PICKUP_DATE}" class="form-control" required /></div>
              <div class="col px-0">
                od <input type="time" name="auction_dates[pickup_time_start][]" value="{AUCTION_DATES_PICKUP_TIME_START}" class="form-control d-inline" style="width:120px" required />
                do <input type="time" name="auction_dates[pickup_time_end][]" value="{AUCTION_DATES_PICKUP_TIME_END}" class="form-control d-inline" style="width:120px" required />
              </div>
              <div class="col-1 px-0 date-pickup-add"><button type="button" name="date-pickup-add" value="1" class="btn btn-link text-primary"><i class="fas fa-plus"></i></button></div>
              <div class="col-1 px-0 date-pickup-delete"><button type="button" name="date-pickup-delete" value="1" class="btn btn-link text-danger"><i class="fas fa-times"></i></button></div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="auction-add" value="1" class="btn btn-primary">Dodaj aukcję</button>
      </div>
    </form>
  </div>
</div>

<!-- BEGIN auctions -->
<div class="modal fade" id="auctionEdit{auctions.ID}" tabindex="-1" aria-labelledby="auctionEdit{auctions.ID}Label" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="post" class="modal-content" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="auctionEdit{auctions.ID}Label">Edycja aukcji</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row form-group">
          <div class="col-lg-6 col-12">
            <label>Nazwa aukcji <span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="auction_name" value="{auctions.NAME}" class="form-control" maxlength="50" required />
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-6 col-12">
            <label>Miejscowość <span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="auction_location[city]" value="{auctions.LOCATION_CITY}" class="form-control" required />
          </div>
          <div class="col-lg-6 col-12">
            <label>Adres <span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="auction_location[address]" value="{auctions.LOCATION_ADDRESS}" class="form-control" required />
          </div>
          <div class="col-lg-6 col-12">
            <label>Kraj <span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="auction_location[country]" value="{auctions.LOCATION_COUNTRY}" class="form-control" required />
          </div>
          <div class="col-lg-6 col-12">
            <label>Telefon <span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="auction_location[phone]" value="{auctions.LOCATION_PHONE}" class="form-control" required />
          </div>
        </div>
        <div class="row form-group">
          <div class="col-lg-4 col-12">
            <label>Data rozpoczęcia <span class="font-weight-bold text-danger">*</span></label>
            <input type="datetime-local" name="auction_date_start" value="{auctions.DATE_INPUT_START}" class="form-control" required />
          </div>
          <div class="col-lg-4 col-12">
            <label>Data zakończenia <span class="font-weight-bold text-danger">*</span></label>
            <input type="datetime-local" name="auction_date_end" value="{auctions.DATE_INPUT_END}" class="form-control" required />
          </div>
        </div>
        <div class="row form-group">
          <label class="col-12">Dni oglądania <span class="font-weight-bold text-danger">*</span></label>
          <!-- BEGIN dates_view -->
          <div class="col-lg-8 col-12" id="date-view-block">
            <div class="row mb-2 date-view-inputs">
              <div class="col-5"><input type="date" name="auction_dates[view_date][]" value="{dates_view.VIEW_DATE}" class="form-control" required /></div>
              <div class="col-6 px-0">
                od <input type="time" name="auction_dates[view_time_start][]" value="{dates_view.VIEW_TIME_START}" class="form-control d-inline" style="width:90px" required />
                do <input type="time" name="auction_dates[view_time_end][]" value="{dates_view.VIEW_TIME_END}" class="form-control d-inline" style="width:90px" required />
              </div>
              <div class="col-1 px-0 date-view-add"<!-- IF dates_view.NO > 1 --> style="display:none;"<!-- ENDIF -->><button type="button" name="date-view-add" value="1" class="btn btn-link text-primary"><i class="fas fa-plus"></i></button></div>
              <div class="col-1 px-0 date-view-delete<!-- IF dates_view.NO == 1 --> d-none<!-- ENDIF -->"><button type="button" name="date-view-delete" value="1" class="btn btn-link text-danger"><i class="fas fa-times"></i></button></div>
            </div>
          </div>
          <!-- END dates_view -->

          <label class="col-12">Dni odbioru <span class="font-weight-bold text-danger">*</span></label>
          <!-- BEGIN dates_pickup -->
          <div class="col-lg-8 col-12" id="date-pickup-block">
            <div class="row mb-2 date-pickup-inputs">
              <div class="col-5"><input type="date" name="auction_dates[pickup_date][]" value="{dates_pickup.PICKUP_DATE}" class="form-control" required /></div>
              <div class="col-6 px-0">
                od <input type="time" name="auction_dates[pickup_time_start][]" value="{dates_pickup.PICKUP_TIME_START}" class="form-control d-inline" style="width:90px" required />
                do <input type="time" name="auction_dates[pickup_time_end][]" value="{dates_pickup.PICKUP_TIME_END}" class="form-control d-inline" style="width:90px" required />
              </div>
              <div class="col-1 px-0 date-pickup-add"<!-- IF dates_pickup.NO > 1 --> style="display:none;"<!-- ENDIF -->><button type="button" name="date-pickup-add" value="1" class="btn btn-link text-primary"><i class="fas fa-plus"></i></button></div>
              <div class="col-1 px-0 date-pickup-delete<!-- IF dates_pickup.NO == 1 --> d-none<!-- ENDIF -->"><button type="button" name="date-pickup-delete" value="1" class="btn btn-link text-danger"><i class="fas fa-times"></i></button></div>
            </div>
          </div>
          <!-- END dates_pickup -->

        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="id" value="{auctions.ID}" />
        <button type="submit" name="auction-edit" value="1" class="btn btn-primary">Zapisz zmiany</button>
      </div>
    </form>
  </div>
</div>
<!-- END auctions -->

<!-- INCLUDE tpl_user_close.tpl -->
