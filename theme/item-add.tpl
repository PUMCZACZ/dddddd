<!-- INCLUDE theme_header.tpl -->
<main class="item-add row mt-5">
  <form method="post" name="form" enctype="multipart/form-data"  onsubmit="return checkPrice()" id="item-add" class="col-md-10 offset-md-1 col-12">
    <div class="">
      <div class="step">
        <span>{_LANG_50}</span>
      </div>
      <div class="">
        <div class="row form-group">
          <div class="col-lg-8 col-12 mb-2">
            <label>{_LANG_51} <span class="font-weight-bold text-danger">*</span></label>
            <div class="input-group">
              <!-- IF MULTILANG -->
              <!-- BEGIN langs_title -->
              <input type="text" name="title_{langs_title.NAME_DEF}" value="{langs_title.TITLE}" placeholder="{langs_title.NAME}" class="lang-title form-control" id="{langs_title.NAME_DEF}"<!-- IF langs_title.NO > 1 --> style="display:none;"<!-- ENDIF --> />
              <!-- END langs_title -->
              <select id="lang-title">
                <!-- BEGIN langs_title -->
                <option value="{langs_title.NAME_DEF}" class="q1" data-iconurl="{SITEURL}/theme/img/lang-{langs_title.NAME_DEF}.png"></option>
                <!-- END langs_title -->
              </select>
              <!-- ELSE -->
              <input type="text" name="title_{DEF_LANG}" value="{TITLE}" class="lang-title form-control" id="{DEF_LANG}" required />
              <!-- ENDIF -->
            </div>
          </div>
        </div>
        <div class="row from-group">
          <div class="col-lg-5 col-12">
            <label>{_LANG_53} <span class="font-weight-bold text-danger">*</span></label>
            <div class="cats-select">
              <!-- IF .sc -->
              <!-- BEGIN sc -->
              <select name="cat_id[]" class="form-control parent" required>
                <option value="" disabled selected>{_LANG_446}</option>
                <!-- BEGIN c -->
                <option value="{c.ID}"<!-- IF c.ACTIVE --> selected<!-- ENDIF -->>{c.NAME}</option>
                <!-- END c -->
              </select>
              <!-- END sc -->
              <!-- ELSE -->
              <select name="cat_id[]" class="form-control parent" required>
                <option value="" disabled selected>{_LANG_446}</option>
                <!-- BEGIN c -->
                <option value="{c.ID}"<!-- IF CAT_ID == c.ID --> selected<!-- ENDIF -->>{c.NAME}</option>
                <!-- END c -->
              </select>
              <!-- ENDIF -->
              <div class="clear"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- IF .par || .item_type -->
    <div class=" mt-3">
      <div class=" step">
        <span>Szczegóły oferty</span>
      </div>
      <div class="">
        <div class="row">
          <!-- IF .item_type -->
          <div class="col-lg-4 col-lg-6 col-12">
            <label class="d-block">{_LANG_578} <span class="font-weight-bold text-danger">*</span></label>
            <select name="type" class="form-control" required>
              <option value="">-- wybierz --</option>
              <!-- BEGIN item_type -->
              <option value="{item_type.ID}"<!-- IF item_type.ID == TYPE --> selected<!-- ENDIF -->>{item_type.NAME}</option>
              <!-- END item_type -->
            </select>
          </div>
          <!-- ENDIF -->
          <!-- BEGIN par -->
          <div class="col-lg-3 col-lg-6 col-12">
            <label class="d-block">{par.NAME}<!-- IF par.REQUIRED --> <span class="font-weight-bold text-danger">*</span><!-- ENDIF --></label>
            <!-- IF par.TYPE == 't' -->
            <input type="text" name="par_{par.F_ID}" value="{par.VALUE}" class="form-control"<!-- IF par.REQUIRED --> required<!-- ENDIF --> />
            <!-- ELSEIF par.TYPE == 'ch' -->
            <dl class="chkbox-dropdown">
              <dt>
                <a href="#" class="form-control">
                  <span class="hida font-weight-normal">-- wybierz --</span>
                  <span class="multiSel font-weight-normal"></span>
                </a>
              </dt>
              <dd>
                <div class="mutliSelect">
                  <ul class="form-control">
                    <!-- BEGIN ch -->
                    <li>
                      <label class="d-block font-weight-normal">
                        <input type="checkbox" name="par_{par.F_ID}[]" value="{ch.ID}" data-name="{ch.PARAMETER}"<!-- IF ch.CHECKED --> checked<!-- ENDIF --> /> {ch.PARAMETER}
                      </label>
                    </li>
                    <!-- END ch -->
                  </ul>
                </div>
              </dd>
            </dl>
            <!-- ELSEIF par.TYPE == 's' -->
            <select name="par_{par.F_ID}" class="form-control"<!-- IF par.REQUIRED --> required<!-- ENDIF -->>
              <option value="">-- wybierz --</option>
              <!-- BEGIN s -->
              <option value="{s.ID}"<!-- IF s.SELECTED --> selected<!-- ENDIF -->>{s.PARAMETER}</option>
              <!-- END s -->
            </select>
            <!-- ELSEIF par.TYPE == 'ft' -->
            <input type="number" step="any" name="par_{par.F_ID}[0]" value="{par.VALUE_1}" class="form-control mx-1"<!-- IF par.REQUIRED --> required<!-- ENDIF --> />
            <!-- ENDIF -->
          </div>
          <!-- END par -->
        </div>
      </div>
    </div>
    <!-- ENDIF -->
    <div class=" mt-3">
      <div class="">
        <div class="form-group">
          <!-- IF .p -->
          <label>{_LANG_58}</label>
          <ul class="row list-inline photos">
            <!-- BEGIN p -->
            <li class="list-inline-item col-2 text-center">
              <img class="mw-100" src="{p.PHOTO_SMALL}" />
              <a href="funcs.php?name=<!-- IF ITEM-EDIT -->user&amp;file=item_edit&amp;id={ID}<!-- ELSE -->items&amp;file=add<!-- ENDIF -->&amp;del-pic={p.PHOTO_NAME}"><em class="fa fa-trash text-danger"></em></a>
            </li>
            <!-- END p -->
          </ul>
          <!-- ELSE -->
          <div class="row mb-2">
            <div class="col-12 col-lg-5">
              <label>{_LANG_595}</label>
              <input type="file" id="files" name="photo[]" accept="image/*" class="form-control" onchange="updatepicture();this.form.submit()"<!-- IF PHOTO-LIMIT--> disabled<!-- ENDIF --> multiple />
            </div>
          </div>
          <!-- ENDIF -->
        </div>
        <div class="form-group mb-0">
          <div class="row mb-2">
            <!-- IF ITEM_FILE -->
            <div class="col-12">
              <label>{_LANG_596}</label>
              <div class="row">
                <div class="col-2 text-center">
                  <img class="w-50 d-block m-auto" src="theme/img/pdf-icon.png" />
                  <a href="funcs.php?name=<!-- IF ITEM-EDIT -->user&amp;file=item_edit&amp;id={ID}<!-- ELSE -->items&amp;file=add<!-- ENDIF -->&amp;del-file={ITEM_FILE}"><em class="fa fa-trash text-danger"></em></a>
                  <input type="hidden" name="item_file" value="{ITEM_FILE}" />
                </div>
              </div>
            </div>
            <!-- ELSE -->
            <div class="col-12 col-lg-5">
              <label>{_LANG_596}</label>
              <input type="file" name="item_file" accept="application/pdf" class="form-control" onchange="updatepicture();this.form.submit()"<!-- IF PHOTO-LIMIT--> disabled<!-- ENDIF --> multiple />
            </div>
            <!-- ENDIF -->
          </div>
        </div>
      </div>
    </div>
    <div class=" mt-3">
      <div class="step mb-3">
        <span>{_LANG_240}</span>
      </div>
      <div class="">
        <div class="row">
          <div class="col-12 col-lg-5 form-group">
            <label>{_LANG_328} <span class="font-weight-bold text-danger">*</span></label>
            <div class="input-group">
              <input type="email" name="user_email" value="{USER_EMAIL}" required class="form-control" />
            </div>
          </div>
          <div class="col-12 col-lg-5">
            <label>{_LANG_15} <span class="font-weight-bold text-danger">*</span></label>
            <div class="input-group">
              <input type="text" name="phone" value="{PHONE}" class="form-control" required />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class=" mt-3">
      <div class="step mb-3">
        <span>{_LANG_59}</span>
      </div>
      <div class="">
        <div class="row form-group">
          <div class="col-lg-4 col-12">
            <label>{_LANG_59} <span class="font-weight-bold text-danger">*</span></label>
            <input type="number" name="price" step="any" min="0" value="{PRICE}" class="form-control text-right" />
          </div>
          <div class="col-lg-4 col-12">
            <label>{_LANG_60} <span class="font-weight-bold text-danger">*</span></label>
            <select name="item_currency" class="form-control" required>
              <!-- BEGIN waluta -->
              <option value="{waluta.NAME}"<!-- IF (ITEM_CURRENCY && ITEM_CURRENCY == waluta.NAME) || (ITEM_CURRENCY == '' && waluta.DEF == 1) --> selected<!-- ENDIF -->>{waluta.NAME}</option>
              <!-- END waluta -->
            </select>
          </div>
          <!-- IF .unit -->
          <div class="col-lg-2 col-md-6 col-6">
            <label>{_LANG_28} <span class="font-weight-bold text-danger">*</span></label>
            <select name="unit" class="form-control" required>
              <option value="" disabled selected>{_LANG_446}</option>
              <!-- BEGIN unit -->
              <option value="{unit.ID}"<!-- IF CHECKED || UNIT == unit.ID --> selected<!-- ENDIF -->>{unit.NAME}</option>
              <!-- END unit -->
            </select>
          </div>
          <!-- ENDIF -->
          <div class="col-md-2 col-6">
          </div>
        </div>
      </div>
    </div>

    <div class=" mt-3">
      <div class="step mb-3">
        <span>{_LANG_72}</span>
      </div>
      <div class="">
        <!-- IF MULTILANG -->
        <div class="row mb-4">
          <div class="col-lg-4 col-md-12 col-12">
            <label>{_LANG_74}</label><br />
            <span class="lang-list">
              <!-- BEGIN langs_langs -->
              <label class="{langs_langs.NAME_DEF}"><input type="checkbox" name="langs[]" value="{langs_langs.NAME_DEF}"<!-- IF langs_langs.CHECKED --> checked<!-- ENDIF -->></label>
              <!-- END langs_langs -->
            </span>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3 col-md-6 col-12">
            <div class="form-group">
              <label>{_LANG_73}</label>
              <select id="lang-desc" class="form-control">
                <!-- BEGIN langs_desc -->
                <option value="{langs_desc.NAME_DEF}">{langs_desc.NAME}</option>
                <!-- END langs_desc -->
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <!-- BEGIN langs_desc -->
          <div class="lang-desc" id="desc_{langs_desc.NAME_DEF}"<!-- IF langs_desc.NO > 1 --> style="display:none;"<!-- ENDIF -->>
            <label>{_LANG_77} {langs_desc.NAME}</label>
            <textarea name="description_{langs_desc.NAME_DEF}" class="item-desc form-control" rows="10" placeholder="{langs_desc.NAME}">{langs_desc.DESCRIPTION}</textarea>
          </div>
          <!-- END langs_desc -->
        </div>
        <!-- ELSE -->
        <input type="hidden" name="langs[]" value="{DEF_LANG}" />
        <label>{_LANG_72} <span class="font-weight-bold text-danger">*</span></label>
        <textarea name="description_{DEF_LANG}" class="item-desc form-control" rows="10">{DESCRIPTION}</textarea>
        <!-- ENDIF -->
      </div>
    </div>

    <div class=" mt-3">
      <div class="step mb-3">
        <span>{_LANG_20}</span>
      </div>
      <div class="">
        <div class="row form-group">
          <!-- IF MULTILANG -->
          <div class="col-lg-3 col-12 mb-2">
            <label>{_LANG_237} <span class="font-weight-bold text-danger">*</span></label>
            <select name="country" class="form-control" required>
              <option value="">{_LANG_446}</option>
              <!-- BEGIN kraj -->
              <option value="{kraj.NAME}"<!-- IF (COUNTRY && COUNTRY == kraj.NAME) || (COUNTRY == '' && kraj.DEF == 1) --> selected<!-- ENDIF -->>{kraj.NAME}</option>
              <!-- END kraj -->
            </select>
          </div>
          <!-- ENDIF -->
          <!-- IF .region -->
          <div class="col-lg-3 col-12 mb-2">
            <label>{_LANG_579} <span class="font-weight-bold text-danger">*</span></label>
            <select name="region" class="form-control" required>
              <option value="" disabled selected>{_LANG_446}</option>
              <!-- BEGIN region -->
              <option value="{region.NAME}"<!-- IF CHECKED || REGION == region.NAME --> selected<!-- ENDIF -->>{region.NAME}</option>
              <!-- END region -->
            </select>
          </div>
          <!-- ENDIF -->
          <div class="col-lg-3 col-12 mb-2">
            <label>{_LANG_232} <span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="city" value="{CITY}" class="form-control" required />
          </div>
          <div class="col-lg-3 col-12 mb-2">
            <label>{_LANG_234}<span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="address" value="{ADDRESS}" class="form-control" />
          </div>
          <div class="col-lg-3 col-12 mb-2">
            <label>{_LANG_233} <span class="font-weight-bold text-danger">*</span></label>
            <input type="text" name="post_code" value="{POST_CODE}" class="form-control" required />
          </div>
        </div>
      </div>
    </div>

    <!-- IF ITEMS_KEYWORDS -->
    <div class=" mt-3">
      <div class="">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-12">
            <div class="form-group">
              <label>{_LANG_81}</label>
              <select id="lang-keywords" class="form-control">
                <!-- BEGIN langs_keywords -->
                <option value="{langs_keywords.NAME_DEF}">{langs_keywords.NAME}</option>
                <!-- END langs_keywords -->
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>{_LANG_82}</label>
          <!-- BEGIN langs_keywords -->
          <textarea name="keywords_{langs_keywords.NAME_DEF}" class="lang-keywords form-control" id="keywords_{langs_keywords.NAME_DEF}" rows="4" placeholder="{langs_keywords.NAME}"<!-- IF langs_keywords.NO > 1 --> style="display:none;"<!-- ENDIF -->>{langs_keywords.KEYWORDS}</textarea>
          <!-- END langs_keywords -->
        </div>
      </div>
    </div>
    <!-- ENDIF -->

    <!-- IF ITEMS_VIDEOS -->
    <div class="mt-3">
      <div class="step mb-3">
        <span>{_LANG_85}</span>
      </div>
      <div class="">
        <div class="form-group row">
          <div class="col-md-4 col-12 form-group">
            <label>{_LANG_86}</label>
            <div class="input-group">
              <input type="text" name="movie" class="form-control" />
              <button class="btn btn-success ml-2 font-weight-normal" id="next_movie" type="button">{_LANG_87}</button>
            </div>
            <div class="form-group mt-3">
              <label><input type="radio" name="movie_show" value="1"<!-- IF MOVIE_SHOW == 1 --> checked<!-- ENDIF --> /> {_LANG_476}</label><br />
              <label><input type="radio" name="movie_show" value="0"<!-- IF MOVIE_SHOW == 0 --> checked<!-- ENDIF --> /> {_LANG_477}</label>
            </div>
          </div>
          <div class="col-md-7 offset-md-1 col-12 form-group d-flex mt-4">
            <div class="ml-2 movies">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ENDIF -->

    <!-- IF ITEM-EDIT == '' -->
    <div class="mt-3">
      <div class="step mb-3">
        <span class="mb-3">Czas publikacji</span>
      </div>
        <div class="form-inline">
          <!-- BEGIN item_time -->
          <div class="col-12 col-md-4 mb-3 mb-md-0 px-2 py-0">
            <div class="card rounded p-3">
              <div class="d-flex justify-content-center align-items-center h3 font-weight-bold">
                <i class="far fa-clock mr-3"></i>
                {item_time.NAME} {_LANG_489}
              </div>
              <div>
                <p class="font-weight-bold">{item_time.PRICE} {CURRENCY}</p>
                <input type="radio" class="rounded-checkbox" name="item_time" value="{item_time.NAME}">
                Wybierz opcje
              </div>
            </div>
          </div>
          <!-- END item_time -->
          <div class="col-md-9 col-12 pt-2">
            <!-- IF ITEM_MEMBER -->
            <!-- IF USER_MEMBER -->
            {_LANG_66} <strong>{MEMBER_TIME}</strong>
            <!-- ELSE -->
            <span class="text-danger d-inline-block mt-2">{_LANG_67}</span>
            <!-- ENDIF -->
            <!-- ENDIF -->
          </div>
        </div>
      </div>
    </div>
    <!-- ENDIF -->

    <div class="mt-3">
      <div class="step">
        <span>{_LANG_515}</span>
      </div>
      <div class="mt-3">
        <div class="row">
          <div class="col-12">
            <ul class="row promo-list list-unstyled my-md-5" id="promo-list">
              <li class="col-lg-3 col-sm-6 col-12 px-2 mb-md-0 mb-3">
                <input type="checkbox" class="promo" name="promo_bold" value="1"<!-- IF PROMO_BOLD == 1 --> checked<!-- ENDIF --> onChange="updateAddPrice(this.name);" id="promo-b" />
                <label for="promo-b" class="box p-3 align-top w-100 h-100">
                  <div class="d-flex flex-row align-items-center justify-content-between">
                    <div class="d-flex flex-col flex-sm-column align-items-center align-items-sm-start">
                      <p class="icon mr-4"><i class="fas fa-bold"></i></p>
                      <h6 class="my-3"><strong>{NAME_PROMO_BOLD}</strong></h6>
                    </div>
                    <div class="mobile-show d-flex flex-column">
                      <div class="d-flex flex-column">
                        <span class="mr-2">{_LANG_518}</span>
                        <!-- BEGIN promo_bold -->
                        <span data-value="{promo_bold.EXTRA}" data-price="{promo_bold.VALUE_FROM}" class="<!-- IF promo_bold.SELECTED -->active d-inline<!-- ELSE -->d-none<!-- ENDIF -->">{promo_bold.VALUE_FROM}</span>
                        <!-- END promo_bold -->
                      </div>
                    </div>
                  </div>
                  <div class="mobile-show">
                    <p>{TEXT_PROMO_BOLD}</p>
                    <div class="select">{_LANG_582}</div>
                  </div>
                  <div class="desktop-show info mt-2 mb-0">
                    <p>{TEXT_PROMO_BOLD}</p>
                    <big class="d-block my-3">
                      {_LANG_518}
                      <!-- BEGIN promo_bold -->
                      <span data-value="{promo_bold.EXTRA}" data-price="{promo_bold.VALUE_FROM}" class="<!-- IF promo_bold.SELECTED -->active d-inline<!-- ELSE -->d-none<!-- ENDIF -->">{promo_bold.VALUE_FROM}</span>
                      <!-- END promo_bold -->
                      {CURRENCY} {_LANG_519}
                    </big>
                    <div class="select">{_LANG_582}</div>
                  </div>
                </label>
              </li>
              <li class="col-lg-3 col-sm-6 col-12 px-2 mb-md-0 mb-3">
                <input type="checkbox" class="promo" name="promo_backlight" value="1"<!-- IF PROMO_BACKLIGHT == 1 --> checked<!-- ENDIF --> onChange="updateAddPrice(this.name);" id="promo-bck" />
                <label for="promo-bck" class="box p-3 align-top w-100 h-100">
                  <div class="d-flex flex-row align-items-center justify-content-between">
                    <div class="d-flex flex-row flex-sm-column align-items-center align-items-sm-start">
                      <p class="icon mr-4"><i class="fas fa-highlighter"></i></p>
                      <h6 class="my-3"><strong>{NAME_PROMO_BACKLIGHT}</strong></h6>
                    </div>
                    <div class="mobile-show d-flex flex-column">
                      {_LANG_518}
                      <!-- BEGIN promo_backlight -->
                      <span data-value="{promo_backlight.EXTRA}" data-price="{promo_backlight.VALUE_FROM}" class="<!-- IF promo_backlight.SELECTED -->active d-inline<!-- ELSE -->d-none<!-- ENDIF -->">{promo_backlight.VALUE_FROM}</span>
                      <!-- END promo_backlight -->
                    </div>
                  </div>
                  <div class="mobile-show">
                    <p>{TEXT_PROMO_BACKLIGHT}</p>
                    <div class="select">{_LANG_582}</div>
                  </div>

                  <div class="desktop-show info mt-2 mb-0">
                    <p>{TEXT_PROMO_BACKLIGHT}</p>
                    <big class="d-block my-3">
                      <!-- BEGIN promo_backlight -->
                      <span data-value="{promo_backlight.EXTRA}" data-price="{promo_backlight.VALUE_FROM}" class="<!-- IF promo_backlight.SELECTED -->active d-inline<!-- ELSE -->d-none<!-- ENDIF -->">{promo_backlight.VALUE_FROM}</span>
                      <!-- END promo_backlight -->
                      {CURRENCY} {_LANG_519}
                    </big>
                    <div class="select">{_LANG_582}</div>
                  </div>
                </label>
              </li>
              <li class="col-lg-3 col-sm-6 col-12 px-2 mb-md-0 mb-3">
                <input type="checkbox" class="promo" name="promo_distinction" value="1"<!-- IF PROMO_DISTINCTION == 1 --> checked<!-- ENDIF --> onChange="updateAddPrice(this.name);" id="promo-d" />
                <label for="promo-d" class="box p-3 align-top w-100 h-100">
                  <div class="d-flex flex-row align-items-center justify-content-between">
                    <div class="d-flex flex-row flex-sm-column align-items-center align-items-sm-start">
                      <p class="icon mr-4"><i class="fas fa-star"></i></p>
                      <h6 class="my-3"><strong>{NAME_PROMO_DISTINCTION}</strong></h6>
                    </div>
                    <div class="mobile-show d-flex flex-column">
                      {_LANG_518}
                      <!-- BEGIN promo_distinction -->
                      <span data-value="{promo_distinction.EXTRA}" data-price="{promo_distinction.VALUE_FROM}" class="<!-- IF promo_distinction.SELECTED -->active d-inline<!-- ELSE -->d-none<!-- ENDIF -->">{promo_distinction.VALUE_FROM}</span>
                      <!-- END promo_distinction -->
                    </div>
                  </div>
                  <div class="mobile-show">
                    <p>{TEXT_PROMO_DISTINCTION}</p>
                    <div class="select">{_LANG_582}</div>
                  </div>
                  <div class="desktop-show info mt-2 mb-0">
                    <p>{TEXT_PROMO_DISTINCTION}</p>
                    <big class="d-block my-3">
                      {_LANG_518}
                      <!-- BEGIN promo_distinction -->
                      <span data-value="{promo_distinction.EXTRA}" data-price="{promo_distinction.VALUE_FROM}" class="<!-- IF promo_distinction.SELECTED -->active d-inline<!-- ELSE -->d-none<!-- ENDIF -->">{promo_distinction.VALUE_FROM}</span>
                      <!-- END promo_distinction -->
                      {CURRENCY} {_LANG_519}
                    </big>
                    <div class="select">{_LANG_582}</div>
                  </div>
                </label>
              </li>
              <li class="col-lg-3 col-sm-6 col-12 px-2 mb-md-0 mb-3">
                <input type="checkbox" class="promo" name="promo_mainpage" value="1"<!-- IF PROMO_MAINPAGE == 1 --> checked<!-- ENDIF --> onChange="updateAddPrice(this.name);" id="promo-mp" />
                <label for="promo-mp" class="box p-3 align-top w-100 h-100">
                  <div class="d-flex flex-row align-items-center justify-content-between">
                    <div class="d-flex flex-row flex-sm-column align-items-center align-items-sm-start">
                      <p class="icon"><i class="fas fa-home"></i></p>
                      <h6 class="my-3"><strong>{NAME_PROMO_MAINPAGE}</strong></h6>
                    </div>
                    <div class="mobile-show d-flex flex-column">
                      {_LANG_518}
                      <!-- BEGIN promo_mainpage -->
                      <span data-value="{promo_mainpage.EXTRA}" data-price="{promo_mainpage.VALUE_FROM}" class="<!-- IF promo_mainpage.SELECTED -->active d-inline<!-- ELSE -->d-none<!-- ENDIF -->">{promo_mainpage.VALUE_FROM}</span>
                      <!-- END promo_mainpage -->
                    </div>
                  </div>
                  <div class="mobile-show">
                    <p>{TEXT_PROMO_MAINPAGE}</p>
                    <div class="select">{_LANG_582}</div>
                  </div>
                  <div class="desktop-show info mt-2 mb-0">
                    <p>{TEXT_PROMO_MAINPAGE}</p>
                    <big class="d-block my-3">
                      {_LANG_518}
                      <!-- BEGIN promo_mainpage -->
                      <span data-value="{promo_mainpage.EXTRA}" data-price="{promo_mainpage.VALUE_FROM}" class="<!-- IF promo_mainpage.SELECTED -->active d-inline<!-- ELSE -->d-none<!-- ENDIF -->">{promo_mainpage.VALUE_FROM}</span>
                      <!-- END promo_mainpage -->
                      {CURRENCY} {_LANG_519}
                    </big>
                    <div class="select">{_LANG_582}</div>
                  </div>
                </label>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="footer">

        <div class="form-check my-2">
          <input type="checkbox" name="rules" value="1" id="rules" required<!-- IF RULES == 1 --> checked<!-- ENDIF --> />
          <label class="form-check-label font-weight-normal" for="rules">
            <strong class="text-danger">*</strong> {_LANG_583} <a target="_blank" href="{CONTENT_HREF_1}"><strong>{_LANG_584}</strong></a> {_LANG_585}.
          </label>
        </div>
        <div class="form-check mb-3">
          <input type="checkbox" name="politic" value="1" id="politic" required<!-- IF POLITIC == 1 --> checked<!-- ENDIF --> />
          <label class="form-check-label font-weight-normal" for="politic">
            <strong class="text-danger">*</strong> {_LANG_586} <a target="_blank" href="{CONTENT_HREF_2}"><strong>{_LANG_587}</strong></a>.
          </label>
        </div>

        <!-- IF IS_USER == '' -->
        <div class="mb-2"><!-- INCLUDE tpl_recaptcha.tpl --></div>
        <!-- ENDIF -->

        <!-- IF ITEM-EDIT -->
        <input type="hidden" name="edit" value="1" />
        <input type="hidden" name="id" value="{ID}" />
        <button type="submit" name="save" value="1" class="btn btn-primary border-content">{_LANG_90}</button>
        <!-- ELSE -->
        <button type="submit" name="add" value="1" class="btn btn-primary border-content"><em class="fa fa-plus mr-3"></em> {_LANG_91}</button>
        <!-- ENDIF -->

      </div>
    </div>
  </form>
</main>

<span id="loading"></span>

<!-- INCLUDE theme_footer.tpl -->
