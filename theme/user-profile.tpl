<!-- INCLUDE tpl_user_open.tpl -->
<div class="user-profile">
  <div class="row">
    <div class="col-12">
      <div class="row">
        <div class="col-md-2 col-12 text-nowrap">
          <a target="_blank" href="funcs.php?name=items&amp;file=profile&amp;id={USER_ID}" class="font-weight-bold btn btn-outline-success btn-block"><i class="fas fa-search"></i> {_LANG_345}</a>
        </div>
        <div class="col-md-4 col-12 mt-md-0 mt-2">
          <b>{_LANG_346}</b> {_LANG_347} <b>{VISITS_ALL}</b> / {_LANG_348} <b>{VISITS_MONTH}</b>
        </div>
      </div>
      <hr />
    </div>
  </div>
  <hr />
  <div class="row mt-0">
    <form method="post" enctype="multipart/form-data" class="col-md-4 col-12">
      {_LANG_349}
      <input type="file" name="photo[]" class="form-control" onchange="updatepicture();this.form.submit()" multiple />
    </form>
  </div>
  <p class="mx-0 mt-3 mb-1">{_LANG_350}</p>
  <div class="row">
    <!-- BEGIN up -->
    <div class="col-md-2 col-12 text-center">
      <img class="mw-100" src="{up.IMAGE}" />
      <a href="funcs.php?name=user&amp;file=profile&amp;delete-photo={up.ID}"><em class="fa fa-trash text-danger"></em></a>
    </div>
    <!-- END up -->
  </div>
</div>
<span id="loading"></span>
<!-- INCLUDE tpl_user_close.tpl -->
