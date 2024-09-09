<!-- INCLUDE tpl_user_open.tpl -->
<div class="user-watching">
  <ul class="nav nav-pills mb-5">
    <li class="nav-item">
      <a class="nav-link<!-- IF OP == '' || OP == 'ads' --> active<!-- ENDIF -->" href="funcs.php?name=user&amp;file=watching&amp;op=ads">{_LANG_428}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link<!-- IF OP == 'users' --> active<!-- ENDIF -->" href="funcs.php?name=user&amp;file=watching&amp;op=users">{_LANG_429}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link<!-- IF OP == 'cats' --> active<!-- ENDIF -->" href="funcs.php?name=user&amp;file=watching&amp;op=cats">{_LANG_430}</a>
    </li>
    <li class="nav-item">
      <a class="nav-link<!-- IF OP == 'users-cats' --> active<!-- ENDIF -->" href="funcs.php?name=user&amp;file=watching&amp;op=users-cats">{_LANG_431}</a>
    </li>
  </ul>

  <!-- IF OP == '' || OP == 'ads' -->
  <div class="user-items">
    <!-- IF .i -->
    <!-- INCLUDE tpl_items_list.tpl -->
    <!-- ELSE -->
    <h4 class="text-secondary text-center">{_LANG_107}</h4>
    <!-- ENDIF -->
  </div>

  <!-- ELSEIF OP == 'users' -->
  <form method="post" class="d-inline form-group bg-light p-3">
    <label><input type="checkbox" name="watching_notifi_users" value="1"<!-- IF WATCHING_NOTIFI_USERS == 1 --> checked<!-- ENDIF --> onchange="this.form.submit()" /> Powiadamiaj meilowo o nowych ogłoszeniach obserwowanych Wystawców</label>
  </form>
  <ul class="users-list list list-unstyled mt-3">
    <!-- BEGIN uw -->
    <li class="py-3">
      <h6><strong>{uw.USERNAME}</strong></h6>
      <div class="row">
        <div class="col-2">
          <strong>{_LANG_433}</strong> {uw.COUNTRY}
        </div>
        <div class="col-3">
          <strong>{_LANG_434}</strong> {uw.COUNT_ITEMS}
        </div>
        <div class="col-2">
          <a href="funcs.php?name=items&amp;file=list&amp;user_id={uw.USER_ID}&amp;search=1">{_LANG_428} wystawcy</a>
        </div>
        <div class="col-2">
          <a href="funcs.php?name=items&amp;file=profile&amp;id={uw.USER_ID}">{_LANG_436}</a>
        </div>
        <div class="offset-1 col-2">
          <a class="text-amber" href="funcs.php?name=user&amp;file=watching&amp;op=users&amp;delete={uw.X_ID}">{_LANG_437}</a>
        </div>
      </div>
    </li>
    <!-- END uw -->
  </ul>

  <!-- ELSEIF OP == 'cats' -->
  <form method="post" class="alert alert-info pt-3 pb-1">
    <label><input type="checkbox" name="watching_notifi_cats" value="1"<!-- IF WATCHING_NOTIFI_CATS == 1 --> checked<!-- ENDIF --> onchange="this.form.submit()" /> Powiadamiaj meilowo o nowych ogłoszeniach w obserwowanych kategoriach</label>
  </form>
  <hr />
  <div class="cats-list mt-3">
    <div class="row">
      <!-- BEGIN c -->
      <div class="col-6">
        <div class="category p-2 mb-2<!-- IF c.ACTIVE --> active alert alert-success<!-- ENDIF -->">
          <!-- IF c.ACTIVE --><i class="fas fa-thumbtack text-success mr-2"></i> <!-- ENDIF --><strong>{c.NAME}</strong>
          <!-- IF c.ACTIVE --><a title="{_LANG_440}" class="text-primary" href="funcs.php?name=user&amp;file=watching&amp;op=cats&amp;delete-cat={c.ID}"><i class="fas fa-trash-alt text-danger"></i></a>
          <!-- ELSE --><a title="{_LANG_441}" class="text-primary" href="funcs.php?name=user&amp;file=watching&amp;op=cats&amp;add-cat={c.ID}"><i class="fas fa-plus-circle text-blue"></i></a><!-- ENDIF -->
        </div>
        <!-- IF .c.u -->
        <ul class="list list-under p-0">
          <!-- BEGIN u -->
          <li class="d-flex justify-content-between p-2 mb-2<!-- IF u.ACTIVE --> active alert alert-success<!-- ENDIF -->">
            <!-- IF u.ACTIVE --><i class="fas fa-thumbtack text-success mr-2"></i> <!-- ENDIF -->{u.NAME}
            <!-- IF u.ACTIVE --><a title="{_LANG_440}" class="text-primary mt-1" href="funcs.php?name=user&amp;file=watching&amp;op=cats&amp;delete-cat={u.ID}"><i class="fas fa-trash-alt text-danger"></i></a>
            <!-- ELSE --><a title="{_LANG_441}" class="text-primary" href="funcs.php?name=user&amp;file=watching&amp;op=cats&amp;add-cat={u.ID}"><i class="fas fa-plus-circle text-blue"></i></a><!-- ENDIF -->
          </li>
          <!-- END u -->
        </ul>
        <!-- ENDIF -->
      </div>
      <!-- END c -->
    </ul>
  </div>

  <!-- ELSEIF OP == 'users-cats' -->
  <div class="users-cats mb-5">
    {_LANG_445}
    <form method="post" class="row">
      <div class="col-3">
        <select name="user_id" class="form-control" onchange="this.form.submit()">
          <option value="">{_LANG_446}</option>
          <!-- BEGIN uw -->
          <option value="{uw.USER_ID}"<!-- IF USER_ID == uw.USER_ID --> selected<!-- ENDIF -->>{uw.USERNAME}</option>
          <!-- END uw -->
        </select>
      </div>
      <div class="col"><button type="submit" name="delete-user" class="text-amber">{_LANG_437}</button></div>
    </form>
  </div>
  <div class="user-items">
    <!-- INCLUDE tpl_items_list.tpl -->
  </div>
  <!-- ENDIF -->
</div>
<!-- INCLUDE tpl_user_close.tpl -->
