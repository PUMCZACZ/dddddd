  </main>
  <div class="push"></div>
</main>
<footer class="mt-5 py-5">
  <div class="container pt-5">
    <div class="py-5 mt-5 text-center">
      <h3 class="font-weight-bold">Zapisz się do newslettera</h3>
      <p class="mt-4">
        <h4 class="m-0">UZYSKAJ 40% ZNIŻKI</h4>
        Otrzymuj na bieżąco kody obniżające ceny publikowanych ogłoszeń
      </p>
      <form class="row" method="post" action="{SITEURL}/funcs.php?name=subscription">
        <div class="col-auto mx-auto">
          <div class="input-group">
            <input type="email" name="email" placeholder="Adres e-mail" class="form-control border-content" required="required" style="height: unset !important">
            <div class="input-group-append">
              <button type="submit" class="btn btn-main-blue border-content">Zapisz się</button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="row py-5">
      <div class="col-lg-3 col-6">
        <address class="font-weight-bold mb-3">
          Zadzwoń do nas<br>
          Tel: 501-42-00-42
        </address>
        help@medtalento.pl
        <p class="mt-3">
          <a href="https://www.linkedin.com/company/medtalento-pl" class="" target="_blank"><i class="fab fa-lg fa-linkedin"></i></a>
          <a href="https://www.facebook.com/pl.medtalento" class="ml-3" target="_blank"><i class="fab fa-lg fa-facebook"></i></a>
        </p>
      </div>
      <div class="col-lg-3 col-6">
        <h6 class="font-weight-bold mb-3">Dla kandydatów</h6>
        <ul class="list list-unstyled">
          <li><a href="{SITEURL}/firmy.html">Wszyscy pracodawcy</a></li>
          <li><a href="{SITEURL}/funcs.php?name=items&amp;file=list">Przeglądaj ogłoszenia</a></li>
          <li><a href="{SITEURL}/funcs.php?name=user">Panel użytkownika</a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-6">
        <h6 class="font-weight-bold mb-3">Dla pracodawców</h6>
        <ul class="list list-unstyled">
          <li><a href="{SITEURL}/funcs.php?name=user">Panel zarządzania</a></li>
          <li><a href="{CONTENT_HREF_7}">{CONTENT_NAME_7}</a></li>
          <li><a href="{SITEURL}/funcs.php?name=items&amp;file=add&amp;new=1">Dodaj ogłoszenie</a></li>
        </ul>
      </div>
      <div class="col-lg-3 col-6">
        <h6 class="font-weight-bold mb-3">Pomoc</h6>
        <ul class="list list-unstyled">
          <!-- BEGIN cf -->
          <li><a href="{cf.HREF}">{cf.NAME}</a></li>
          <!-- END cf -->
          <li><a href="{SITEURL}/funcs.php?name=contact">Kontakt</a></li>
        </ul>
      </div>
    </div>
    <div class="copyright mt-3 pt-4 border-top">
      Copyright © Medtalento.pl Wszelkie prawa zastrzeżone.
    </div>
  </div>
</footer>

<!-- IF CONTENT_ACTIVE_3 && PRIVACY_ACCEPTED == '' -->
<div class="modal fade" id="privacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h4>{CONTENT_NAME_3}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>{CONTENT_TEXT_3}</p>
      </div>
      <div class="modal-footer">
        <a onclick="javascript:WHClosePrivacyWindow(); $('#privacy').modal('hide');" href="#" class="btn btn-outline-primary mx-auto">Przejdź do serwisu</a>
      </div>
    </form>
  </div>
</div>
<!-- ENDIF -->

<!-- IF COOKIES_ACCEPTED == '' -->
<div id="cookies-msg">
  Używamy plików cookies na naszej stronie internetowej, aby zapewnić Ci najbardziej odpowiednie wrażenia, zapamiętując Twoje preferencje. Klikając „Rozumiem”, wyrażasz zgodę na używanie plików cookies. Jeśli nie wyrażasz zgody, ustawienia dotyczące plików cookies możesz zmienić w swojej przeglądarce. Więcej informacji dostępnych jest tutaj: <a class="text-primary" href="https://medtalento.pl/Polityka-Prywatnosci-i-Cookies-t2.html"><b>Polityka Prywatności i Cookies</b></a>
  <a onclick="javascript:WHCloseCookiesWindow();" href="#" id="accept-cookies-checkbox" name="accept-cookies" class="btn btn-primary btn-sm ml-3">Rozumiem</a>
</div>
<!-- ENDIF -->

<a href="#" class="to-top-arrow hidden-xs"></a>

<!-- INCLUDE tpl_javascript.tpl -->

  </body>
</html>
