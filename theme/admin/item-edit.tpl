<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
<link rel="stylesheet" type="text/css" href="theme/css/jquery.selectBoxIt.css" />
<link rel="stylesheet" href="theme/css/swiper.css">

<main class="item-add p-3">
  <form method="post" enctype="multipart/form-data">
    <h5>Podstawowe informacje o ofercie</h5>
    <hr />
    <div class="row form-group">
      <div class="col-4">
        <label>Wprowadź tytuł oferty do wybranego języka</label>
        <div class="input-group">
          <!-- BEGIN langs_title -->
          <input type="text" name="title_{langs_title.NAME_DEF}" value="{langs_title.TITLE}" class="lang-title form-control" id="{langs_title.NAME_DEF}"<!-- IF langs_title.NO > 1 --> style="display:none;"<!-- ENDIF --> />
          <!-- END langs_title -->
          <select id="lang-title">
            <!-- BEGIN langs_title -->
            <option value="{langs_title.NAME_DEF}" class="q1" data-iconurl="theme/img/lang-{langs_title.NAME_DEF}.png"></option>
            <!-- END langs_title -->
          </select>
        </div>
      </div>
      <div class="col-4">
        <label>Wybierz kategorię</label>
        <select name="cat_id" class="form-control">
          <option value="">-- wybierz --</option>
          <!-- BEGIN c -->
          <!-- IF .c.u -->
          <optgroup label="{c.NAME}">
            <!-- BEGIN u -->
            <option value="{u.ID}"<!-- IF CAT_ID == u.ID --> selected<!-- ENDIF -->>{u.NAME}</option>
            <!-- END u -->
          </optgroup>
          <!-- ELSE -->
          <option value="{c.ID}"<!-- IF CAT_ID == c.ID --> selected<!-- ENDIF -->>{c.NAME}</option>
          <!-- ENDIF -->
          <!-- END c -->
        </select>
      </div>
    </div>

    <div class="form-group pb-5">
      <div class="row mb-2">
        <div class="col-3">
          <label>Dodaj zdjęcia do ogłoszenia</label>
          <input type="file" id="files" name="photo[]" class="form-control" onchange="updatepicture();this.form.submit()" multiple />
        </div>
      </div>
      <label>Dodane zdjęcia:</label>
      <ul class="row list-inline photos">
        <!-- BEGIN p -->
        <li class="list-inline-item col-2 text-center">
          <img class="mw-100" src="{p.PHOTO_SMALL}" />
          <a href="{ADMIN_FILE}?op=item-edit&amp;id={ID}&amp;del-pic={p.PHOTO_NAME}"><em class="fa fa-trash text-danger"></em></a>
        </li>
        <!-- END p -->
      </ul>
    </div>
    <hr />
    <div class="row form-group py-5">
      <div class="col-2">
        <label>Podaj cenę</label>
        <input type="number" name="price" step="any" value="{PRICE}" class="form-control" />
      </div>
      <div class="col-2">
        <label>Wybierz walutę</label>
        <select name="item_currency" class="form-control">
          <!-- BEGIN waluta -->
          <option value="{waluta.NAME}<!-- IF ITEM_CURRENCY == waluta.NAME --> selected<!-- ENDIF -->">{waluta.NAME}</option>
          <!-- END waluta -->
        </select>
      </div>
    </div>

    <h5>Dostępność</h5>
    <hr />
    <div class="row form-group pb-5">
      <div class="col-3">
        <label>Opublikuj ofertę</label>
        <div class="input-group">
          <input class="form-control text-center" type="text" name="daterange" value="{DATERANGE}" readonly />
          <div class="input-group-prepend">
            <span class="input-group-text"><em class="fa fa-calendar"></em></span>
          </div>
        </div>
      </div>
      <div class="col-6 mt-5">
        <label class="mt-1">Chcę tylko zapisać ofertę, bez publikowania na ten moment <input type="checkbox" name="save_only" value="1"<!-- IF SAVE_ONLY || USER_MEMBER == '' --> checked<!-- ENDIF --><!-- IF USER_MEMBER == '' --> readonly disabled<!-- ENDIF --> />
      </div>
    </div>

    <h5>Opis ogłoszenia</h5>
    <hr />
    <!-- BEGIN langs_langs -->
    <input type="hidden" name="langs[]" value="{langs_langs.NAME_DEF}">
    <!-- END langs_langs -->
    <div class="form-group pb-5">
      <!-- BEGIN langs_desc -->
      <div class="lang-desc" id="desc_{langs_desc.NAME_DEF}"<!-- IF langs_desc.NO > 1 --> style="display:none;"<!-- ENDIF -->>
        <label>Dodaj opis swojego ogłoszenia dla języka: {langs_desc.NAME}</label>
        <textarea name="description_{langs_desc.NAME_DEF}" class="item-desc form-control" rows="20" placeholder="{langs_desc.NAME}">{langs_desc.DESCRIPTION}</textarea>
      </div>
      <!-- END langs_desc -->
    </div>
    <div class="form-group">
        <div class="row">
          <div class="col-12">
            <ul class="row promo-list list-unstyled my-md-5" id="promo-list">
              <li class="col-lg-3 col-md-6 col-12 text-center">
                <input type="checkbox" class="promo" name="promo_bold" value="1"<!-- IF PROMO_BOLD == 1 --> checked<!-- ENDIF --> onChange="updateAddPrice(this.name);" id="promo-b" />
                <label for="promo-b" class="d-block">
                  <h6 class="my-3"><strong>{NAME_PROMO_BOLD}</strong></h6>
                  <div class="info mt-4 mb-0">
                    <p>{TEXT_PROMO_BOLD}</p>
                  </div>
                </label>
              </li>
              <li class="col-lg-3 col-md-6 col-12 text-center">
                <input type="checkbox" class="promo" name="promo_backlight" value="1"<!-- IF PROMO_BACKLIGHT == 1 --> checked<!-- ENDIF --> onChange="updateAddPrice(this.name);" id="promo-bck" />
                <label for="promo-bck" class="d-block">
                  <h6 class="my-3"><strong>{NAME_PROMO_BACKLIGHT}</strong></h6>
                  <div class="info mt-4 mb-0">
                    <p>{TEXT_PROMO_BACKLIGHT}</p>
                  </div>
                </label>
              </li>
              <li class="col-lg-3 col-md-6 col-12 text-center">
                <input type="checkbox" class="promo" name="promo_distinction" value="1"<!-- IF PROMO_DISTINCTION == 1 --> checked<!-- ENDIF --> onChange="updateAddPrice(this.name);" id="promo-d" />
                <label for="promo-d" class="d-block">
                  <h6 class="my-3"><strong>{NAME_PROMO_DISTINCTION}</strong></h6>
                  <div class="info mt-4 mb-0">
                    <p>{TEXT_PROMO_DISTINCTION}</p>
                  </div>
                </label>
              </li>
              <li class="col-lg-3 col-md-6 col-12 text-center">
                <input type="checkbox" class="promo" name="promo_mainpage" value="1"<!-- IF PROMO_MAINPAGE == 1 --> checked<!-- ENDIF --> onChange="updateAddPrice(this.name);" id="promo-mp" />
                <label for="promo-mp" class="d-block">
                  <h6 class="my-3"><strong>{NAME_PROMO_MAINPAGE}</strong></h6>
                  <div class="info mt-4 mb-0">
                    <p>{TEXT_PROMO_MAINPAGE}</p>
                  </div>
                </label>
              </li>
            </ul>
          </div>
        </div>
    </div>
    <div class="form-group mt-5">
      <input type="hidden" name="id" value="{ID}" />
      <input type="hidden" name="edit" value="1" />
      <button type="submit" name="delete" value="1" class="btn btn-danger px-5" onclick="return confirm('Jesteś pewien, że chcesz usunąć ogłoszenie?');">Usuń</button>
      <button type="submit" name="save" value="1" class="btn btn-success px-5 float-right">Zapisz zmiany</button>
    </div>
  </form>
</main>

<span id="loading"></span>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>

<script src="//cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('description_pl', {
    height: '350px',
  });
  CKEDITOR.replace('description_en', {
    height: '350px',
  });
  CKEDITOR.replace('description_ru', {
    height: '350px',
  });
</script>
<script src="theme/js/items_add.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="http://gregfranko.com/jquery.selectBoxIt.js/js/jquery.selectBoxIt.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<script type="text/javascript">
  $(function() {
    $('input[name="daterange"]').daterangepicker({
      "minDate": "07/03/2018",
      "locale": {
        "format": "DD/MM/YYYY",
        "separator": " - ",
        "applyLabel": "Zastosuj",
        "cancelLabel": "Anuluj",
        "fromLabel": "Od",
        "toLabel": "Do",
        "customRangeLabel": "Własne",
        "weekLabel": "T",
        "daysOfWeek": [
          "Ni",
          "Po",
          "Wt",
          "Śr",
          "Cz",
          "Pi",
          "So"
        ],
        "monthNames": [
          "Styczeń",
          "Luty",
          "Marzec",
          "Kwiecień",
          "Maj",
          "Czerwiec",
          "Lipiec",
          "Sierpień",
          "Wrzesień",
          "Październik",
          "Listopad",
          "Grudzień"
        ],
        "firstDay": 1,
      }
    }
  )});
  $(function() {
    $('#lang-title').change(function(){
      $('.lang-title').hide();
      $('#' + $(this).val()).show();
    });
    $('#lang-desc').change(function(){
      $('.lang-desc').hide();
      $('#desc_' + $(this).val()).show();
    });
    $('#lang-keywords').change(function(){
      $('.lang-keywords').hide();
      $('#keywords_' + $(this).val()).show();
    });
    var selectBox = $("#lang-title").selectBoxIt();
  });
  function updatepicture() {
    var file_location = document.getElementById('loading');
    file_location.innerHTML='<span><p>Ładowanie zdjęcia...</p></span>';
  }
  </script>
