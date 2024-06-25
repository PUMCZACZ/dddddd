<div class="row">
  <ul class="col-12 nav nav-pills nav-module mt-4 mb-4 border-bottom">
    <li class="nav-item">
      <a class="nav-link<!-- IF FUNC_FILE == 'items_sale' --> active<!-- ENDIF -->" href="{SITEURL}/user/items_sale">{_LANG_637}<span class="badge badge-light border ml-2">{STATS_ITEMS_SALE}</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link<!-- IF FUNC_FILE == 'items_list' && STATUS == 'active' --> active<!-- ENDIF -->" href="{SITEURL}/user/items_list?status=active">{_LANG_591}<span class="badge badge-light border ml-2">{STATS_ITEMS_ACTIVE}</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link<!-- IF FUNC_FILE == 'items_list' && STATUS == 'save_only' --> active<!-- ENDIF -->" href="{SITEURL}/user/items_list?status=save_only">{_LANG_592}<span class="badge badge-light border ml-2">{STATS_ITEMS_SAVE_ONLY}</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link<!-- IF FUNC_FILE == 'items_list' && STATUS == 'end' --> active<!-- ENDIF -->" href="{SITEURL}/user/items_list?status=end">{_LANG_593}<span class="badge badge-light border ml-2">{STATS_ITEMS_END}</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link<!-- IF FUNC_FILE == 'items_list' && STATUS == '' --> active<!-- ENDIF -->" href="{SITEURL}/user/items_list">{_LANG_590}<span class="badge badge-light border ml-2">{STATS_ITEMS}</span></a>
    </li>
    <li class="nav-item">
      <a class="nav-link<!-- IF FUNC_FILE == 'import' --> active<!-- ENDIF -->" href="{SITEURL}/user/import">{_LANG_718}<span class="badge badge-light border ml-2">{STATS_ITEMS_IMPORT}</span></a>
    </li>
  </ul>
</div>
