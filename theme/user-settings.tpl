<!-- INCLUDE template_open.tpl -->
<section class="user-settings">
  <form method="post" class="mx-4 pb-2">
    <h1 class="section-name mt-0">Ustawienia profilu</h1>
    <div class="row form-group">
      <div class="col-6">Nazwa użytkownika</div>
      <div class="col-6">
        {USER_USERNAME}
      </div>
    </div>
    <div class="row form-group">
      <div class="col-6">Adres e-mail</div>
      <div class="col-6">
        <input type="email" name="user_email" value="{USER_USER_EMAIL}" class="form-control" />
      </div>
    </div>
    <div class="row form-group">
      <div class="col-6">Hasło</div>
      <div class="col-6">
        <a href="#" data-toggle="modal" data-target="#edit-pass">Zmień hasło</a>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-6">Członkostwo</div>
      <div class="col-6">
        <!-- IF USER_PREMIUM --><span class="text-success"><em class="fa fa-check"></em> Aktywne</span><!-- ELSE --><span class="text-danger"><em class="fa fa-ban"></em> Nieaktywne</span><!-- ENDIF -->
      </div>
    </div>
    <div class="row form-group">
      <div class="col-6">Kredyty</div>
      <div class="col-6">
        <strong>{USER_WALLET}{CURRENCY}</strong>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-6">Status profilu</div>
      <div class="col-6">
        <!-- IF USER_STATUS == 1 --><span class="text-success"><em class="fa fa-check"></em>Aktywny</span><!-- ELSE --><span class="text-danger"><em class="fa fa-ban"></em> Nieaktywny</span><!-- ENDIF -->
      </div>
    </div>
    <div class="row form-group">
      <div class="col-6">Kto może komentować moje zdjęcia?</div>
      <div class="col-6">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="photos_comment" value="m"<!-- IF USER_PHOTOS_COMMENT == 'm' --> checked<!-- ENDIF --> /> Mężczyźni
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="photos_comment" value="k"<!-- IF USER_PHOTOS_COMMENT == 'k' --> checked<!-- ENDIF --> /> Kobiety
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="photos_comment" value="p"<!-- IF USER_PHOTOS_COMMENT == 'p' --> checked<!-- ENDIF --> /> Pary
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="photos_comment" value=""<!-- IF USER_PHOTOS_COMMENT == '' --> checked<!-- ENDIF --> /> Wszyscy
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="photos_comment" value="n"<!-- IF USER_PHOTOS_COMMENT == 'n' --> checked<!-- ENDIF --> /> Nikt
          </label>
        </div>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-6">Kto może polubić moje zdjęcia?</div>
      <div class="col-6">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="photos_like" value="m"<!-- IF USER_PHOTOS_LIKE == 'm' --> checked<!-- ENDIF --> /> Mężczyźni
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="photos_like" value="k"<!-- IF USER_PHOTOS_LIKE == 'k' --> checked<!-- ENDIF --> /> Kobiety
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="photos_like" value="p"<!-- IF USER_PHOTOS_LIKE == 'p' --> checked<!-- ENDIF --> /> Pary
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="photos_like" value=""<!-- IF USER_PHOTOS_LIKE == '' --> checked<!-- ENDIF --> /> Wszyscy
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="photos_like" value="n"<!-- IF USER_PHOTOS_LIKE == 'n' --> checked<!-- ENDIF --> /> Nikt
          </label>
        </div>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-6">Zablokować wiadomości od:</div>
      <div class="col-6">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="messages_block" value="m"<!-- IF USER_MESSAGES_BLOCK == 'm' --> checked<!-- ENDIF --> /> Mężczyzn
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="messages_block" value="k"<!-- IF USER_MESSAGES_BLOCK == 'k' --> checked<!-- ENDIF --> /> Kobiet
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="messages_block" value="p"<!-- IF USER_MESSAGES_BLOCK == 'p' --> checked<!-- ENDIF --> /> Par
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="messages_block" value="all"<!-- IF USER_MESSAGES_BLOCK == 'all' --> checked<!-- ENDIF --> /> Wszystkich
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="messages_block" value=""<!-- IF USER_MESSAGES_BLOCK == '' --> checked<!-- ENDIF --> /> Brak
          </label>
        </div>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-6">Zablokować oglądanie profilu przez:</div>
      <div class="col-6">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="profile_show_block" value="m"<!-- IF USER_PROFILE_SHOW_BLOCK == 'm' --> checked<!-- ENDIF --> /> Mężczyzn
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="profile_show_block" value="k"<!-- IF USER_PROFILE_SHOW_BLOCK == 'k' --> checked<!-- ENDIF --> /> Kobiet
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="profile_show_block" value="p"<!-- IF USER_PROFILE_SHOW_BLOCK == 'p' --> checked<!-- ENDIF --> /> Par
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="profile_show_block" value="all"<!-- IF USER_PROFILE_SHOW_BLOCK == 'all' --> checked<!-- ENDIF --> /> Wszystkich
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="profile_show_block" value=""<!-- IF USER_PROFILE_SHOW_BLOCK == '' --> checked<!-- ENDIF --> /> Brak
          </label>
        </div>
      </div>
    </div>
    <!--
    <h3 class="section-name border-none mt-4">Powiadomienia na stronie</h3>
    <div class="row mb-2">
      <div class="col-6">Otrzymuj powiadomienia</div>
      <div class="col-6">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="notify" value="1"<!-- IF USER_NOTIFY == 1 --> checked<!-- ENDIF --> /> Tak
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="notify" value="0"<!-- IF USER_NOTIFY == 0 --> checked<!-- ENDIF --> /> Nie
          </label>
        </div>
      </div>
    </div>
    <h3 class="section-name border-none mt-4">Powiadomienia na telefon</h3>
    <div class="row mb-2">
      <div class="col-6">Numer telefonu</div>
      <div class="col-6">
        <input type="text" name="phone" value="{USER_PHONE}" class="form-control" />
      </div>
    </div>
    -->
    <h3 class="section-name border-none mt-4">Powiadomienia na e-mail</h3>
    <div class="row mb-2">
      <div class="col-6">Przypomnienia o wygaśnięciu członkostwa</div>
      <div class="col-6">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="member_remind" value="1"<!-- IF USER_MEMBER_REMIND == 1 --> checked<!-- ENDIF --> /> Tak
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="member_remind" value="0"<!-- IF USER_MEMBER_REMIND == 0 --> checked<!-- ENDIF --> /> Nie
          </label>
        </div>
      </div>
    </div>
    <div class="row mb-2">
      <div class="col-6">Oferty specjalne</div>
      <div class="col-6">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="notify_special_offer" value="1"<!-- IF USER_NOTIFY_SPECIAL_OFFER == 1 --> checked<!-- ENDIF --> /> Tak
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="notify_special_offer" value="0"<!-- IF USER_NOTIFY_SPECIAL_OFFER == 0 --> checked<!-- ENDIF --> /> Nie
          </label>
        </div>
      </div>
    </div>
    <div class="row mb-2">
      <div class="col-6">Otrzymałeś nową wiadomość</div>
      <div class="col-6">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="notify_message" value="1"<!-- IF USER_NOTIFY_MESSAGE == 1 --> checked<!-- ENDIF --> /> Tak
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="notify_message" value="0"<!-- IF USER_NOTIFY_MESSAGE == 0 --> checked<!-- ENDIF --> /> Nie
          </label>
        </div>
      </div>
    </div>
    <div class="row mb-2">
      <div class="col-6">Kto oglądał mój profil</div>
      <div class="col-6">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="notify_watch" value="1"<!-- IF USER_NOTIFY_WATCH == 1 --> checked<!-- ENDIF --> /> Tak
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="notify_watch" value="0"<!-- IF USER_NOTIFY_WATCH == 0 --> checked<!-- ENDIF --> /> Nie
          </label>
        </div>
      </div>
    </div>
    <div class="row mb-2">
      <div class="col-6">Gdy wybrany użytkownik się zaloguje</div>
      <div class="col-6">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="notify_login" value="1"<!-- IF USER_NOTIFY_LOGIN == 1 --> checked<!-- ENDIF --> /> Tak
          </label>
          <label class="form-check-label">
            <input class="form-check-input" type="radio" name="notify_login" value="0"<!-- IF USER_NOTIFY_LOGIN == 0 --> checked<!-- ENDIF --> /> Nie
          </label>
        </div>
      </div>
    </div>
    <div class="form-group row">
      <div class="col-6">
        <button type="button" data-toggle="modal" data-target="#delete-account" class="btn btn-danger">Usuń konto</button>
      </div>
      <div class="col-6 text-right">
        <button type="submit" name="op" value="update" class="btn btn-secondary">Zapisz zmiany</button>
      </div>
  </form>
</section>

<div class="modal fade" id="edit-pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title text-uppercase" id="exampleModalLabel"><strong>Edycja danych</strong></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <label class="col-5">Obecne hasło: </label>
          <div class="col-7 input-group">
            <span class="input-group-addon"><em class="fa fa-lock"></em></span>
            <input type="password" name="user-pass-now" class="form-control" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-5">Nowe hasło:</label>
          <div class="col-7 input-group">
            <span class="input-group-addon"><em class="fa fa-lock"></em></span>
            <input type="password" name="user-pass-new" class="form-control" required>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-5">Powtórz nowe hasło:</label>
          <div class="col-7 input-group">
            <span class="input-group-addon"><em class="fa fa-lock"></em></span>
            <input type="password" name="user-pass-new2" class="form-control" required>
          </div>
        </div>
        <div class="form-group text-right">
          <button type="submit" class="btn btn-brimary">Zapisz zmiany</button>
          <input type="hidden" name="op" value="chng-pwd" />
        </div>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="delete-account" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title text-uppercase" id="exampleModalLabel"><strong>Usunięcie konta</strong></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Czy jesteś pewna/y, że chcesz usunąć swoje konto w serwisie?</p>
        <div class="form-group row">
          <div class="col-6 text-center"><button type="button" class="btn btn-secondary" data-dismiss="modal">Nie</button></div>
          <div class="col-6 text-center"><button type="submit" name="op" value="delete-account" class="btn btn-danger">Tak</button></div>
      </div>
    </form>
  </div>
</div>
<!-- INCLUDE template_close.tpl -->
