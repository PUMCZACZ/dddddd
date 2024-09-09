<div class="user-register-form p-0<!-- IF USER_EDIT --> col-12<!-- ELSE --> col-lg-8 offset-lg-2 col-12 shadow p-4<!-- ENDIF --> ">
  <!-- IF USER_EDIT == '' -->
  <div class="d-flex justify-content-center">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link px-4 mr-2 active <!-- IF U_TYPE == 'standard' || U_TYPE == '' -->active <!-- ENDIF -->" id="standard-tab" data-toggle="tab" href="#standard" role="tab" aria-controls="standard-tab" aria-selected="true">{_LANG_526}</a>
      </li>
      <li class="nav-item">
        <a class="nav-link px-4<!-- IF U_TYPE == 'business' -->active<!-- ENDIF -->" id="business-tab" data-toggle="tab" href="#business" role="tab" aria-controls="business-tab" aria-selected="true">{_LANG_527}</a>
      </li>
    </ul>
  </div>
  <!-- ENDIF -->
  <div class="tab-content mt-0" id="myTabContent">
    <div class="tab-pane fade <!-- IF U_TYPE == 'standard' || U_TYPE == '' --> show active<!-- ENDIF -->" id="standard" role="tabpanel" aria-labelledby="standard-tab">
      <form method="post" action="<!-- IF USER_EDIT -->funcs.php?name=user<!-- ELSE -->funcs.php?name=user&amp;file=register<!-- ENDIF -->" enctype="multipart/form-data" runat="server">
        <div class="">
          <div class="user mb-3">
            <!-- IF USER_EDIT != '' --><span class="title">{_LANG_221}</span><!-- ENDIF -->
          </div>
          <div class="">
            <div class="row">
              <div class="col-12">
                <!-- IF USER_EDIT == '' -->
                <div class="row form-group">
                  <div class="col-12">
                    <label>{_LANG_222} <span class="text-danger font-weight-bold">*</span></label>
                    <input type="text"<!-- IF USER_EDIT --> disabled<!-- ELSE --> name="username"<!-- ENDIF --> value="{USERNAME}" id="username1" class="form-control" onBlur="checkAvailability1()" required />
                  </div>
                  <div class="col-md-5 col-12">
                    <div class="d-md-block d-none"<label>&nbsp;</label><br /></div>
                  <span id="username-status1"></span>
                </div>
              </div>
              <!-- ENDIF -->
              <div class="row">
                <div class="col-md-6 col-12 form-group">
                  <label>{_LANG_224} <span class="text-danger font-weight-bold">*</span></label>
                  <input type="email" name="user_email" value="{USER_EMAIL}" class="form-control border-content" required />
                </div>
                <div class="col-12 col-md-6 form-group">
                  <div class="row">
                    <div class="col-12 col-md-9 mb-4 mb-md-0">
                      <label>{_LANG_227}</label>
                      <input type="file" name="avatar" id="avatar" class="form-control border-content"/>

                    </div>
                    <div class="col-md-3 d-md-inline d-none text-center">
                      <!-- IF USER_EDIT -->
                      <img id="avatar-preview" src="<!-- IF AVATAR -->{AVATAR}<!-- ELSE -->theme/img/avatar-def.png<!-- ENDIF -->" class="mw-100" alt="avatar" />
                      <!-- ELSE -->
                      <img id="avatar-preview" src="<!-- IF AVATAR_DIR && AVATAR_FILENAME -->{AVATAR_DIR}/{AVATAR_FILENAME}<!-- ELSE -->theme/img/avatar-def.png<!-- ENDIF -->" class="mw-100" alt="avatar" />
                      <!-- ENDIF -->
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <!-- IF USER_EDIT -->
                  <a href="#" data-toggle="modal" data-target="#chngPwd" class="text-primary">{_LANG_228}</a>
                  <!-- ENDIF -->
                </div>
                <!-- IF USER_EDIT -->
                <!-- ELSE -->
                <div class="col-12 form-group">
                  <div class="row">
                    <div class="col-md-6 col-12">
                      <label>{_LANG_225} <span class="text-danger font-weight-bold">*</span></label>
                      <input type="password" minlength="6" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="user_pass" class="form-control mb-2" data-toggle="tooltip" data-placement="top" title="{_LANG_589}" required />
                    </div>
                    <div class="col-md-6 col-12">
                      <label>{_LANG_226} <span class="text-danger font-weight-bold">*</span></label>
                      <input type="password" minlength="6" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="user_pass2" class="form-control" data-toggle="tooltip" data-placement="top" title="{_LANG_589}" required />
                    </div>
                  </div>
                  <!-- ENDIF -->
                </div>
              </div>
            </div>
            <!-- IF USER_EDIT && U_TYPE == 'standard' -->
            <!--<div class="col-md-6 col-12">
              <button type="button" class="btn btn-main btn-sm float-right" data-toggle="modal" data-target="#chngUtype">
                Przekształć na konto firmowe
              </button>
            </div> --!>
            <!-- ENDIF -->
          </div>

        </div>
    </div>
    <div class="mt-4">
      <!-- IF USER_EDIT == '' -->
      <div class="text-right">
        <label class="d-block"><input type="checkbox" name="accept1" value="1"<!-- IF ACCEPT1 --> checked<!-- ENDIF --> required /> {_LANG_475} <a target="_blank" href="Regulamin-t1.html" class="text-primary">{_LANG_264}</a></label>
        <label><input type="checkbox" name="accept2" value="1"<!-- IF ACCEPT1 --> checked<!-- ENDIF --> required /> {_LANG_475} <a target="_blank" href="Polityka-Prywatnosci-i-Cookies-t2.html" class="text-primary">{_LANG_266}</a></label>
        <div class="text-right"><!-- INCLUDE tpl_recaptcha.tpl --></div>
      </div>
      <!-- ENDIF -->

      <div class="col-12 d-flex justify-content-between p-0">
        <button type="submit" name="save" value="1" class="btn btn-primary">{_LANG_274}</button>
        <input type="hidden" name="op" value="finish" />
        <input type="hidden" name="type" value="standard" />
        <!-- IF USER_EDIT && USER_TYPE == 'standard' -->
        <div class="d-flex align-items-center">
          <button type="submit" name="delete-account" value="1"
                  class="btn p-2 text-danger mt-1 border border-danger"
                  onclick="return confirm('Jesteś pewien, że chcesz usunąć swoje konto?');">
            {_LANG_268}
          </button>
        </div>
        <!-- ENDIF -->
      </div>

    </div>
    </form>
    </div>
    <div class="tab-pane fade<!-- IF U_TYPE == 'business' --> show active<!-- ENDIF -->" id="business" role="tabpanel" aria-labelledby="business-tab">
      <form method="post" id="business" action="<!-- IF USER_EDIT -->funcs.php?name=user<!-- ELSE -->funcs.php?name=user&amp;file=register<!-- ENDIF -->" enctype="multipart/form-data" runat="server">
        <div class="">
          <div class="user my-3">
            <!-- IF USER_EDIT != '' --><span class="title">{_LANG_221}</span><!-- ENDIF -->
          </div>
          <div class="">
            <div class="row">
              <div class="col-md-6 col-12">
                <!-- IF USER_EDIT == '' -->
                <div class="row">
                  <div class="col-md-9 col-12 form-group">
                    <label>{_LANG_222} <span class="text-danger font-weight-bold">*</span></label>
                    <input type="text"<!-- IF USER_EDIT --> disabled<!-- ELSE --> name="username"<!-- ENDIF --> value="{USERNAME}" id="username2" class="form-control" onBlur="checkAvailability2()" required />
                  </div>
                  <div class="col-5">
                    <div class="d-md-block d-none"<label>&nbsp;</label><br /></div>
                  <span id="username-status2"></span>
                </div>
              </div>
              <!-- ENDIF -->
              <div class="row">
                <div class="col-md-9 col-12 form-group">
                  <label>{_LANG_224} <span class="text-danger font-weight-bold">*</span></label>
                  <input type="email" name="user_email" value="{USER_EMAIL}" class="form-control" required />
                  <!-- IF USER_EDIT --><div class="form-group"><a href="#" data-toggle="modal" data-target="#chngPwd" class="text-primary">{_LANG_228}</a></div><!-- ENDIF -->
                </div>
                <!-- IF USER_EDIT -->
                <!-- ELSE -->
                <div class="col-12 form-group">
                  <div class="row">
                    <div class="col-md-6 col-12">
                      <label>{_LANG_225} <span class="text-danger font-weight-bold">*</span></label>
                      <input type="password" minlength="6" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="user_pass" class="form-control mb-2" data-toggle="tooltip" data-placement="top" title="Min 6 znaków, duże i małe litery, cyfry lub znaki specjalne" required />
                    </div>
                    <div class="col-md-6 col-12">
                      <label>{_LANG_226} <span class="text-danger font-weight-bold">*</span></label>
                      <input type="password" minlength="6" pattern="(?=^.{6,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" name="user_pass2" class="form-control" data-toggle="tooltip" data-placement="top" title="Min 6 znaków, duże i małe litery, cyfry lub znaki specjalne" required />
                    </div>
                  </div>
                </div>
                <!-- ENDIF -->
              </div>
            </div>
            <div class="col-md-4 col-12 mb-4 mb-md-0">
              <label>{_LANG_227}</label>
              <input type="file" name="avatar" id="avatar" class="form-control" />
            </div>
            <div class="col-md-2 d-md-inline d-none text-center">
              <!-- IF USER_EDIT -->
              <img id="avatar-preview" src="<!-- IF AVATAR -->{AVATAR}<!-- ELSE -->theme/img/avatar-def.png<!-- ENDIF -->" class="mw-100" alt="avatar" />
              <!-- ELSE -->
              <img id="avatar-preview" src="<!-- IF AVATAR_DIR && AVATAR_FILENAME -->{AVATAR_DIR}/{AVATAR_FILENAME}<!-- ELSE -->theme/img/avatar-def.png<!-- ENDIF -->" class="mw-100" alt="avatar" />
              <!-- ENDIF -->
            </div>
          </div>
        </div>
        <div class="">
          <div class="row">
            <div class="col-md-4 col-12 form-group">
              <label>{_LANG_229} <span class="text-danger font-weight-bold">*</span></label>
              <input type="text" name="company_name" class="form-control" value="{COMPANY_NAME}" required />
            </div>
            <div class="col-md-4 col-12 form-group">
              <label>{_LANG_230} <span class="text-danger font-weight-bold">*</span></label>
              <input type="text" name="nip" class="form-control" value="{NIP}" required />
            </div>
            <div class="col-md-4 col-12 form-group">
              <label>{_LANG_231}</label>
              <input type="text" name="regon" class="form-control" value="{REGON}" />
            </div>
          </div>
          <div class="row">
            <!-- IF .region -->
            <div class="col-md-3 col-12 form-group">
              <label>{_LANG_579} <span class="font-weight-bold text-danger">*</span></label>
              <select name="region" class="form-control" required>
                <option value="" disabled selected>{_LANG_446}</option>
                <!-- BEGIN region -->
                <option value="{region.NAME}"<!-- IF REGION == region.NAME --> selected<!-- ENDIF -->>{region.NAME}</option>
                <!-- END region -->
              </select>
            </div>
            <!-- ENDIF -->
            <div class="col-md-4 col-12 form-group">
              <label>{_LANG_232} <span class="font-weight-bold text-danger">*</span></label>
              <input type="text" name="city" class="form-control" value="{CITY}" required />
            </div>
            <div class="col-md-4 col-12 form-group">
              <label>{_LANG_233} <span class="font-weight-bold text-danger">*</span></label>
              <input type="text" name="post_code" class="form-control" value="{POST_CODE}" required />
            </div>
            <div class="col-md-4 col-12 form-group">
              <label>{_LANG_234}</label>
              <input type="text" name="street" class="form-control" value="{STREET}" />
            </div>
          </div>
          <div class="row form-group mt-3">
            <div class="col-md-8 col-12">
              <label><input type="radio" name="show_address" value="1"<!-- IF SHOW_ADDRESS == 1 --> checked<!-- ENDIF --> /> {_LANG_478}</label><br />
              <label><input type="radio" name="show_address" value="0"<!-- IF SHOW_ADDRESS == 0 --> checked<!-- ENDIF --> /> {_LANG_479}</label>
            </div>
            <!-- IF MULTILANG -->
            <div class="col-md-4 col-12">
              <label>{_LANG_237}</label>
              <select name="country" class="form-control">
                <!-- BEGIN kraj -->
                <option value="{kraj.ID}"<!-- IF COUNTRY == kraj.ID --> selected<!-- ENDIF -->>{kraj.NAME}</option>
                <!-- END kraj -->
              </select>
            </div>
            <!-- ENDIF -->
          </div>
        </div>
    </div>
  <div class="mt-3">
    <div class="user my-3">
      <!-- IF USER_EDIT == '' -->{_LANG_220} <span class="num">2</span><!-- ENDIF -->
      <span class="title">{_LANG_240}</span>
    </div>
    <div class="row">
      <div class="col-md-5 col-12 form-group">
        <label>{_LANG_241}</label>
        <div class="input-group">
          <input type="text" name="phone" class="form-control border-content" value="{PHONE}">
        </div>
      </div>
      <div class="col-md-5 col-12 form-group">
        <label>{_LANG_250}</label>
        <div class="input-group">
          <input type="text" name="website" class="form-control border-content" value="{WEBSITE}">
        </div>
      </div>
      <!-- IF MULTILANG -->
      <div class="row">
        <div class="form-group col-12">
          <label>{_LANG_257}:</label>
          <select id="lang-desc" class="form-control border-content">
            <!-- BEGIN desc_langs -->
            <option value="{desc_langs.NAME_DEF}">{desc_langs.NAME}</option>
            <!-- END desc_langs -->
          </select>
        </div>
      </div>
      <div class="form-group">
        <label>{_LANG_258}</label>
        <!-- BEGIN desc_langs -->
        <textarea name="company_desc_{desc_langs.NAME_DEF}" class="lang-desc form-control border-content" rows="3" id="desc_{desc_langs.NAME_DEF}" placeholder="{desc_langs.NAME}"<!-- IF desc_langs.NO > 1 --> style="display:none;"<!-- ENDIF -->>{desc_langs.COMPANY_DESC}</textarea>
        <!-- END desc_langs -->
      </div>
      <!-- ELSE -->
      <div class="col-12">
        <label>{_LANG_256}</label>
        <div class="form-group">
          <textarea name="company_desc_{DEF_LANG}" class="lang-desc form-control" rows="3">{COMPANY_DESC}</textarea>
        </div>
      </div>
      <!-- ENDIF -->
    </div>
  </div>

  <!-- IF USER_EDIT && .uc -->
  <div class="mt-3">
    <div class="row gx-3">
      <div class="col-12 col-md-5 mr-md-3">
        <div class="user mb-3">
          <span class="title">{_LANG_560}</span>
        </div>
        <!-- BEGIN uc -->
        <div class="form-group cats-select">
          <!-- BEGIN c -->
          <label class="mb-2">Kategorie działalności</label>
          <select name="cat_id[{uc.ID}][]" class="form-control parent mr-2">
            <option value="">{_LANG_54}</option>
            <!-- BEGIN cats -->
            <option value="{cats.ID}"<!-- IF cats.SELECTED --> selected<!-- ENDIF -->>{cats.NAME}</option>
            <!-- END cats -->
          </select>
          <!-- END c -->
        </div>

        <!-- END uc -->
      </div>
      <div class="col-12 col-md-4 ml-md-3">
        <div class="user mb-3">
          <span class="title">{_LANG_260}</span>
        </div>
        <div class="">
          <div class="row">
            <div class="col-12 form-group">
              <label>{_LANG_261}</label>
              <input type="text" name="social_fb" value="{SOCIAL_FB}" class="form-control" />
            </div>
            <div class="col-12 form-group">
              <label>{_LANG_262}</label>
              <input type="text" name="social_insta" value="{SOCIAL_INSTA}" class="form-control" />
            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="user mb-3">
          <span class="title">Subdomena</span>
        </div>
        <div class="d-flex">
          <div class="alert alert-info mb-3 border-content">
            Nasz serwis umożliwia udostępnianie Państwa wszystkich ogłoszeń pod indywidualną subdomeną.
          </div>
        </div>
        <div class="subdomain-href">
          <label>Adres państwa strony internetowej:</label>
          <a href="{SUBDOMAIN_URL}" class="form-control subdomain-overflow" target="_blank">{SUBDOMAIN_URL}</a>
        </div>
      </div>
    </div>
  </div>
  <!-- ENDIF -->

  <div class="mt-4">
    <!-- IF USER_EDIT == '' -->
    <div class="card-body text-right">
      <label class="d-block"><input type="checkbox" name="accept1" value="1"<!-- IF ACCEPT1 --> checked<!-- ENDIF --> required /> {_LANG_475} <a target="_blank" href="Regulamin-t1.html" class="text-primary">{_LANG_264}</a></label>
      <label><input type="checkbox" name="accept2" value="1"<!-- IF ACCEPT1 --> checked<!-- ENDIF --> required /> {_LANG_475} <a target="_blank" href="Polityka-Prywatnosci-i-Cookies-t2.html" class="text-primary">{_LANG_266}</a></label>
      <div class="text-right"><!-- INCLUDE tpl_recaptcha.tpl --></div>
    </div>
    <!-- ENDIF -->

    <div class="col-12 d-flex justify-content-between px-0">
      <button type="submit" name="save" value="1" class="btn btn-primary px-4 border-content">{_LANG_274}</button>
      <input type="hidden" name="op" value="finish" />
      <input type="hidden" name="type" value="business" />
    <!-- IF USER_EDIT && USER_TYPE == 'business' -->
      <div class="d-flex align-items-center">
        <button type="submit" name="delete-account" value="1"
                class="btn p-2 text-danger mt-1 border border-danger border-content"
                onclick="return confirm('Jesteś pewien, że chcesz usunąć swoje konto?');">
          {_LANG_268}
        </button>
      </div>
    </div>
    <!-- ENDIF -->
  </div>
  </form>
  </div>
  </div>
</div>

<!-- IF USER_EDIT -->
<div class="modal fade" id="chngPwd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{_LANG_269}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>{_LANG_271}</label>
          <input type="password" name="user-pass-now" class="form-control" />
        </div>
        <div class="form-group">
          <label>{_LANG_272}</label>
          <input type="password" name="user-pass-new" class="form-control" />
        </div>
        <div class="form-group">
          <label>{_LANG_273}</label>
          <input type="password" name="user-pass-new2" class="form-control" />
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="chngPwd" value="1" />
        <button type="submit" class="btn btn-primary rounded-lg">{_LANG_274}</button>
      </div>
    </form>
  </div>
</div>
<div class="modal fade" id="chngUtype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Przekształcenie na konto firmowe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label class="font-weight-bold">Nazwa firmy <span class="text-danger">*</span></label>
          <input type="text" name="company_name" class="form-control" required />
        </div>
        <div class="form-group">
          <label class="font-weight-bold">NIP <span class="text-danger">*</span></label>
          <input type="text" name="nip" class="form-control" required />
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="chngUtype" value="1" />
        <button type="submit" class="btn btn-main">{_LANG_274}</button>
      </div>
    </form>
  </div>
</div>
<!-- ENDIF -->
