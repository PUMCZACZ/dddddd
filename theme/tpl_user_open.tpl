<!-- INCLUDE theme_header.tpl -->
</main>
<div class="container-account">
  <main class="container">
    <h1>{_LANG_212}</h1>
    <ul class="nav nav-tabs">
      <li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == '' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user">{_LANG_213}</a></li>
      <li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'items_list' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&amp;file=items_list">{_LANG_214}</a></li>
      <!-- IF USER_MOD_MSG --><li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'messages' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&amp;file=messages">{_LANG_572}</a></li><!-- ENDIF -->
      <li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'watching' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&amp;file=watching">{_LANG_218}</a></li>
      <li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'member' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&amp;file=member">{_LANG_216}</a></li>
      <li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'payments' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&amp;file=payments">{_LANG_217}</a></li>
      <!-- IF MODULE_COMPANIES && USER_TYPE == 'business' --><li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'profile' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&amp;file=profile">{_LANG_219}</a></li><!-- ENDIF -->
      <li class="nav-item"><a class="nav-link<!-- IF FUNC_FILE == 'subscriptions' --> active<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=user&file=subscriptions">Subskrypcje</a></li>
    </ul>
  </main>
</div>
<main class="container">
<section class="user-account">

  <ul class="nav mt-4 pb-1 mb-3">
    <li class="nav-item col-md-3 col-12 px-4">
      {_LANG_205} <strong>{MEMBER_NAME}</strong> <a class="text-success ml-2" href="{SITEURL}/funcs.php?name=user&amp;file=member"><small>{_LANG_206}</small></a><br />
      <!-- IF MEMBER_TIME -->{_LANG_207}: {MEMBER_TIME} {_LANG_491} {MEMBER_TO_END} {_LANG_489}<!-- ENDIF -->
    </li>
    <li class="veryfi nav-item col-md-3 col-12 px-4">
      {_LANG_208}<br />
      <!-- IF USER_VERYFI -->
      <strong class="text-amber"><i class="fas fa-user-check"></i> {_LANG_209}</strong>
      <!-- ELSE -->
      <strong>{_LANG_210}</strong> <a class="text-success ml-2" href="{SITEURL}/funcs.php?name=user&amp;file=veryfi"><small>{_LANG_211}</small></a>
      <!-- ENDIF -->
    </li>
  </ul>
  
  <div class="row">
    <div class="col-9 mt-3">
      <h4 class="mt-3 mb-4 account-title">
        <!-- IF FUNC_FILE == '' -->{_LANG_213}<!-- ENDIF -->
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
  <div class="col-12"><hr /></div>
