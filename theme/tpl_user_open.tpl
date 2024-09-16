<!-- INCLUDE theme_header.tpl -->
</main>
<div class="container-account py-3">
  <main class="container">
    <!-- IF U_TYPE='business' -->
    <h1>Panel użytkownika firmowego</h1>
    <!-- ELSE -->
    <h1>Panel użytkownika indywidualnego</h1>
    <!-- ENDIF -->
    <ul class="nav justify-content-center py-3">
      <li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == '' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user">{_LANG_213}</a></li>
      <li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'items_list' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&amp;file=items_list">{_LANG_214}</a></li>
      <!-- IF USER_MOD_MSG --><li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'messages' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&amp;file=messages">{_LANG_572}</a></li><!-- ENDIF -->
      <li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'watching' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&amp;file=watching">{_LANG_218}</a></li>
      <li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'member' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&amp;file=member">{_LANG_216}</a></li>
      <li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'payments' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&amp;file=payments">{_LANG_217}</a></li>
      <li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'subscriptions' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&file=subscriptions">Subskrypcje</a></li>
    </ul>
  </main>
</div>
<main class="container">
  <section class="user-account">
    <ul class="nav mt-4 pb-1 mb-3 py-4 shadow" style="border-radius: 12px">
      <div class="col-12 col-md-8">
        <li class="nav-item col-12 px-2 mb-3">
          <div class="d-flex justify-content-between">
            <span class="label">{_LANG_205}</span>
            <div>
              <span class="text-uppercase font-weight-bold">{MEMBER_NAME}</span>
              <a class="text-primary ml-2" href="{SITEURL}/funcs.php?name=user&amp;file=member"><small>{_LANG_206}</small></a><br />
            </div>
          </div>
        </li>
        <!-- IF MEMBER_TIME -->
        <li class="nav-item col-12 px-2 mb-3">
          <div class="d-flex justify-content-between">
            <span class="label">{_LANG_207}</span>
            <div class="d-flex flex-column">
              <div class="font-weight-bold">
                {MEMBER_TIME}
              </div>
              <div class="font-weight-bold">
                {_LANG_491} {MEMBER_TO_END} {_LANG_489}
              </div>
            </div>
          </div>
        </li>
        <!-- ENDIF -->
        <li class="veryfi nav-item col-12 px-2 mb-3">
          <div class="d-flex justify-content-between">
            <div class="mr-3">
              <span class="label">{_LANG_208}</span> <br />
            </div>
            <div style="text-align: end">
              <!-- IF USER_VERYFI -->
              <strong class="text-amber"><i class="fas fa-user-check"></i> {_LANG_209}</strong>
              <!-- ELSE -->
              <strong>{_LANG_210}</strong> <a class="text-primary ml-2" href="{SITEURL}/funcs.php?name=user&amp;file=veryfi"><small>{_LANG_211}</small></a>
              <!-- ENDIF -->
            </div>
          </div>
        </li>
      </div>
      <div class="col-12 col-lg-4">
        <div class="d-flex justify-content-end">
          <!-- IF USER_EDIT && U_TYPE == 'standard' --><button type="button" class="btn btn-primary w-100" data-toggle="modal" data-target="#chngUtype">Przekształć na konto firmowe</button><!-- ENDIF -->
        </div>
      </div>
    </ul>

    <div class="row">
      <div class="col-9 mt-3">
        <h4 class="mt-3 mb-4 account-title">
          <!-- IF FUNC_FILE == 'items_list' -->{_LANG_214}<!-- ENDIF -->
          <!-- IF FUNC_FILE == 'member' -->{_LANG_216}<!-- ENDIF -->
          <!-- IF FUNC_FILE == 'payments' -->{_LANG_217}<!-- ENDIF -->
          <!-- IF FUNC_FILE == 'watching' -->{_LANG_218}<!-- ENDIF -->
          <!-- IF FUNC_FILE == 'profile' -->{_LANG_219}<!-- ENDIF -->
          <!-- IF FUNC_FILE == 'messages' -->{_LANG_572}<!-- ENDIF -->
        </h4>
      </div>
      <!-- IF FUNC_FILE == 'items_list' -->
      <form method="get" class="col-3 mt-3">
        <input type="hidden" name="name" value="user" />
        <input type="hidden" name="file" value="items_list" />
        <select name="status" class="form-control float-right mt-2" onchange="this.form.submit();">
          <option value=""<!-- IF STATUS == '' --> selected<!-- ENDIF -->>wszystkie</option>
          <option value="active"<!-- IF STATUS == 'active' --> selected<!-- ENDIF -->>aktywne</option>
          <option value="save_only"<!-- IF STATUS == 'save_only' --> selected<!-- ENDIF -->>nieopublikowane</option>
          <option value="end"<!-- IF STATUS == 'end' --> selected<!-- ENDIF -->>zakończone</option>
        </select>
      </form>
      <!-- ENDIF -->
    </div>
    <div class="col-12"></div>
