<div class="modal fade" id="itemFileImport" tabindex="-1" role="dialog" aria-labelledby="importModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" enctype="multipart/form-data" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="importModal">{_LANG_694}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <label>{_LANG_695}</label>
        <div class="alert alert-info">
          {_LANG_696}<br />
          {_LANG_697}<br />
          {_LANG_698}
        </div>

        <!-- IF ITEM_PAYMENT -->
        <div class="form-group">
          <label>{_LANG_699}</label>
          <input type="file" name="import-file" class="form-control" />
        </div>
        <div class="form-group">
          <label>{_LANG_700}</label>
          <input type="url" name="import-link" class="form-control" placeholder="http://..." pattern="https?://.*" />
        </div>
        <div class="form-group">
          <label>{_LANG_707} <b class="text-danger">*</b></label>
          <select name="import-type" class="form-control" required>
            <option value="">{_LANG_54}</option>
            <option value="ceneo">Ceneo</option>
            <option value="nokaut">Nokaut</option>
            <option value="google">Google Merchant</option>
            <option value="convertiser">Convertiser</option>
            <option value="other">Inna *</option>
          </select>
          <div class="alert alert-warning alert-import mt-2 p-2"><small>Wybór tej opcji wydłuży czas importu do około 72 godzin.</small></div>
        </div>
        <div class="form-group">
          <label>Kategoria <small>(opcjonalnie)</small></label>
          <select name="cat_id[]" class="form-control parent mb-1">
            <option value="">-- wybierz --</option>
            <!-- BEGIN c -->
            <option value="{c.ID}">{c.NAME}</option>
            <!-- END c -->
          </select>
        </div>
        <!-- ELSE -->
        <div class="alert alert-warning">{_LANG_742} <a href="{SITEURL}/user/settings"><b>{_LANG_739}</b></a></div>
        <!-- ENDIF -->
      </div>
      <!-- IF ITEM_PAYMENT -->
      <div class="modal-footer">
        <input type="hidden" name="op" value="import-file" />
        <button type="submit" class="btn btn-primary">{_LANG_701}</button>
      </div>
      <!-- ENDIF -->
    </form>
  </div>
</div>
