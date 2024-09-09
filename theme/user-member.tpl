<!-- INCLUDE tpl_user_open.tpl -->
<section class="user-member mt-0">

  <!-- IF USER_MEMBER && CONTENT_TEXT_19 --><p class="my-0">{CONTENT_TEXT_19}</p><!-- ENDIF -->

  <div class="row mt-5">
    <div class="col-12">
      <h2 class="mb-5 font-weight-bold text-center">Pakiety Cenowe</h2>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-xl-8 col-12 mx-auto text-center">
          <div class="p-2" style="border: 2px solid #CCC; border-radius: 2.5em;">
            <div class="row nav-package-price">
              <div class="col my-auto">
                <button class="btn btn-primary toggle-price" value="package-adv" style="border-radius: 2.5em;">Pakiety ogłoszeń</button>
              </div>
              <div class="col my-auto">
                <button type="button" value="single-ad" class="btn  toggle-price" style="border-radius: 2.5em;">Pojedyncze ogłoszenia</button>
              </div>
              <div class="col my-auto">
                <button class="btn toggle-price" value="free-package" style="border-radius: 2.5em;">Pakiet darmowy</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="my-5">
      <!-- INCLUDE tpl_user_members_list.tpl -->
    </div>
    <!--
    <div class="col-lg-4 col my-3">
      <form method="post" class="border text-center p-4" style="border-radius:10px;">
        <h5>Pakiet Start</h5>
        <h2>59 zł z VAT za 1 ogłoszenie</h2>
        <p class="my-3 text-secondary"><i class="fas fa-lg fa-shopping-basket"></i></p>
        <ul class="list list-unstyled text-left" style="font-size:0.9em;">
          <li class="my-3">1 ogłoszenie publikowane przez 6 miesięcy.</li>
          <li class="my-3">Ważność pakietu przez 30 dni od daty zakupu</li>
          <li class="my-3">Umieszczenie w zestawieniu ofert na Facebooku</li>
        </ul>
        <p><button name="buy" value="1" class="btn btn-block btn-primary-light">Kup pakiet</button></p>
        <input type="hidden" name="mp_id" value="2">
      </form>
    </div>
    <div class="col-lg-4 col my-3">
      <form method="post" class="border text-center p-4" style="border-radius:10px;">
        <h5>Pakiet Standard</h5>
        <h2>129 PLN z VAT za 3 ogłoszenia</h2>
        <p class="my-3 text-secondary"><i class="fas fa-lg fa-shopping-basket"></i></p>
        <ul class="list list-unstyled text-left" style="font-size:0.9em;">
          <li class="my-3">3 ogłoszenia publikowane przez 6 miesięcy.</li>
          <li class="my-3">Cena 1 ogłoszenia w pakiecie 43 zł z VAT</li>
          <li class="my-3">Ważność pakietu przez 30 dni od daty zakupu</li>
          <li class="my-3">Umieszczenie w zestawieniu ofert na Facebooku</li>
        </ul>
        <p><button name="buy" value="1" class="btn btn-block btn-primary-light">Kup pakiet</button></p>
        <input type="hidden" name="mp_id" value="29">
      </form>
    </div>
    <div class="col-lg-4 col my-3">
      <form method="post" class="border text-center p-4" style="border-radius:10px;">
        <h5>Pakiet Plus</h5>
        <h2>195 PLN z VAT za 5 ogłoszeń</h2>
        <p class="my-3 text-secondary"><i class="fas fa-lg fa-shopping-basket"></i></p>
        <ul class="list list-unstyled text-left" style="font-size:0.9em;">
          <li class="my-3">5 ogłoszeń publikowanych przez 6 miesięcy.</li>
          <li class="my-3">Cena 1 ogłoszenia w pakiecie 39 zł z VAT</li>
          <li class="my-3">Ważność pakietu przez 6 miesięcy od daty zakupu</li>
          <li class="my-3">Umieszczenie w zestawieniu ofert na Facebooku</li>
        </ul>
        <p><button name="buy" value="1" class="btn btn-block btn-primary-light">Kup pakiet</button></p>
        <input type="hidden" name="mp_id" value="30">
      </form>
    </div>
    <div class="col-lg-4 col my-3">
      <form method="post" class="border text-center p-4" style="border-radius:10px;">
        <h5>Pakiet Smart</h5>
        <h2>299 PLN z VAT za 10 ogłoszeń</h2>
        <p class="my-3 text-secondary"><i class="fas fa-lg fa-shopping-basket"></i></p>
        <ul class="list list-unstyled text-left" style="font-size:0.9em;">
          <li class="my-3">10 ogłoszeń publikowanych przez 6 miesięcy.</li>
          <li class="my-3">Cena 1 ogłoszenia w pakiecie 30 zł z VAT</li>
          <li class="my-3">Ważność pakietu przez 6 miesięcy od daty zakupu</li>
          <li class="my-3">Umieszczenie w zestawieniu ofert na Facebooku</li>
        </ul>
        <p><button name="buy" value="1" class="btn btn-block btn-primary-light">Kup pakiet</button></p>
        <input type="hidden" name="mp_id" value="31">
      </form>
    </div>
    <div class="col-lg-4 col my-3">
      <form method="post" class="border text-center p-4" style="border-radius:10px;">
        <h5>Pakiet Prime</h5>
        <h2>359 PLN z VAT za 15 ogłoszeń</h2>
        <p class="my-3 text-secondary"><i class="fas fa-lg fa-shopping-basket"></i></p>
        <ul class="list list-unstyled text-left" style="font-size:0.9em;">
          <li class="my-3">15 ogłoszeń publikowanych przez 6 miesięcy</li>
          <li class="my-3">Cena 1 ogłoszenia w pakiecie 24 zł z VAT</li>
          <li class="my-3">Ważność pakietu przez 6 miesięcy od daty zakupu</li>
          <li class="my-3">Umieszczenie w zestawieniu ofert na Facebooku</li>
        </ul>
        <p><button name="buy" value="1" class="btn btn-block btn-primary-light">Kup pakiet</button></p>
        <input type="hidden" name="mp_id" value="32">
      </form>
    </div>
    <div class="col-lg-4 col my-3">
      <form method="post" class="border text-center p-4" style="border-radius:10px;">
        <h5>Pakiet Extra</h5>
        <h2>499 PLN z VAT bez limitu ogłoszeń</h2>
        <p class="my-3 text-secondary"><i class="fas fa-lg fa-shopping-basket"></i></p>
        <ul class="list list-unstyled text-left" style="font-size:0.9em;">
          <li class="my-3">Dodawaj tyle ofert pracy, ile chcesz!</li>
          <li class="my-3">Każde ogłoszenie publikowane przez 6 miesięcy</li>
          <li class="my-3">Pakiet ważny 90 dni od zakupu</li>
          <li class="my-3">Umieszczenie w zestawieniu ofert na Facebooku</li>
        </ul>
        <p><button name="buy" value="1" class="btn btn-block btn-primary-light">Kup pakiet</button></p>
        <input type="hidden" name="mp_id" value="33">
      </form>
    </div> !-->
  </div>

  <!-- IF USER_MEMBER -->

  <!--
  <p class="my-4">
    <a class="btn btn-success" href="#" data-toggle="modal" data-target="#extend">{_LANG_280} <i class="ml-2 fas fa-angle-double-right"></i></a>
    <a class="btn btn-success" href="#" data-toggle="modal" data-target="#change">{_LANG_281} <i class="ml-2 fas fa-angle-double-right"></i></a>
    <a class="btn btn-info" href="#" data-toggle="modal" data-target="#packages">{_LANG_294} <i class="ml-2 fas fa-angle-double-right"></i></a>
  </p>
-->

  <div class="col-12 col-md-6 my-5" aria-labelledby="promo-code">
    <form method="post">
      <div class="">
        <h5 class="modal-title" id="exampleModalLabel">{_LANG_502}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span>&times;</span>
        </button>
      </div>
      <div>
        <p>{_LANG_503}</p>
        <p class="text-center"><input type="text" name="code" class="form-control" placeholder="{_LANG_504}" minlength="13" required/>
      </div>
      <div class="">
        <button type="submit" name="promo-code" value="1" class="btn btn-primary">{_LANG_505}</button>
      </div>
    </form>
  </div>

  <!-- IF .pc -->
  <div class="col-12 col-md-6 overflow-table" aria-labelledby="pc" >
    <form method="post" >
      <div class="">
        <h5 class="" id="exampleModalLabel">{_LANG_506}</h5>
      </div>
      <table class="table table-striped">
        <tr>
          <th>{_LANG_504}</th>
          <th>{_LANG_507}</th>
          <th>{_LANG_508}</th>
          <th>{_LANG_509}</th>
        </tr>
        <!-- BEGIN pc -->
        <tr>
          <td>{pc.CODE}</td>
          <td>{pc.DISCOUNT}%</td>
          <td>{pc.DATE_END}</td>
          <td><!-- IF pc.DATE_USED -->Tak <small>({pc.DATE_USED})</small><!-- ELSE -->Nie<!-- ENDIF --></td>
        </tr>
        <!-- END pc -->
      </table>
    </form>
  </div>
  <!-- ENDIF -->

  <h3 class="text-center my-5"><strong>{_LANG_498}</strong></h3>

  <!-- BEGIN um -->
  <div class="overflow-table">
    <table class="table table-striped overflow-table">
      <tr>
        <th colspan="2">
          <!-- IF um.NAME -->{_LANG_496}<!-- ELSE -->{_LANG_295}<!-- ENDIF -->: <!-- IF um.NAME -->{um.NAME}<!-- ELSE --><!-- IF um.EXTRA_ADS -->{_LANG_485}<!-- ELSEIF um.EXTRA_BIDS -->{_LANG_486}<!-- ELSEIF um.EXTRA_DISTINCTION -->{_LANG_487}<!-- ELSEIF um.EXTRA_MAIN_PAGE -->{_LANG_488}<!-- ENDIF --><!-- ENDIF -->
        </th>
        <th colspan="2" class="text-right">{_LANG_497}: {um.DATE} / {um.DATE_END}</th>
      </tr>
      <tr>
        <td colspan="4">
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3 text-center">{_LANG_485}: <strong>{um.ITEMS}/{um.EXTRA_ADS}</strong> <small>(wykorzystano/dostępne)</small></div>
            <div class="col-12 col-sm-6 col-md-3 text-center">{_LANG_486}: <strong>{um.BIDS}/{um.EXTRA_BIDS}</strong> <small>(wykorzystano/dostępne)</small></div>
            <div class="col-12 col-sm-6 col-md-3 text-center">{_LANG_487}: <strong>{um.DISTINCTIONS}/{um.EXTRA_DISTINCTION}</strong> <small>(wykorzystano/dostępne)</small></div>
            <div class="col-12 col-sm-6 col-md-3 text-center">{_LANG_488}: <strong>{um.MAIN_PAGES}/{um.EXTRA_MAIN_PAGE}</strong> <small>(wykorzystano/dostępne)</small></div>
          </div>
        </td>
      </tr>
      <!-- IF .um.umd -->
      <tr>
        <th></th>
        <th>{_LANG_2}</th>
        <th>{_LANG_295}</th>
        <th>{_LANG_495}</th>
      </tr>
      <!-- BEGIN umd -->
      <tr>
        <td></td>
        <td>{umd.TITLE}</td>
        <td><!-- IF umd.TYPE == 'ads' -->{_LANG_492}<!-- ELSEIF umd.TYPE == 'distinction' -->{_LANG_494}<!-- ELSEIF umd.TYPE == 'bids' -->{_LANG_493}<!-- ENDIF --></td>
        <td>{umd.DATE}</td>
      </tr>
      <!-- END umd -->
      <!-- ENDIF -->
    </table>
  </div>

  <hr />
  <!-- END um -->

  <!-- IF CONTENT_TEXT_20 --><p class="my-5">{CONTENT_TEXT_20}</p><!-- ENDIF -->

  <!-- ELSE -->

  <!-- IF CONTENT_TEXT_17 --><p class="my-5">{CONTENT_TEXT_17}</p><!-- ENDIF -->

  <p class="mb-5">
    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#promo-code"><small>{_LANG_501} <em class="fa fa-chevron-right"></em></small></a>
    <!-- IF .pc -->
    <a class="btn btn-secondary ml-3" href="#" data-toggle="modal" data-target="#pc"><small>{_LANG_506} <em class="fa fa-chevron-right"></em></small></a>
    <!-- ENDIF -->
  </p>

  <!-- IF .me -->
  <form method="post" class="row mb-5">
    <div class="col-lg-6 offset-lg-3 col-12">
      <h4 class="pt-0 mt-3 mb-3">{_LANG_294}</h4>
      <table class="others table table-striped">
        <tr>
          <th>{_LANG_295}</th>
          <th class="text-center">{_LANG_296}</th>
          <th class="text-center">{_LANG_297}</th>
          <th class="text-center">{_LANG_298}</th>
          <th></th>
        </tr>
        <!-- BEGIN me -->
        <!-- BEGIN mp -->
        <tr>
          <td>
            <!-- IF me.EXTRA_ADS -->{_LANG_485}<!-- ELSEIF me.EXTRA_BIDS -->{_LANG_486}<!-- ELSEIF me.EXTRA_DISTINCTION -->{_LANG_487}<!-- ELSEIF me.EXTRA_MAIN_PAGE -->{_LANG_488}<!-- ENDIF -->
          </td>
          <td class="text-center">
            <!-- IF me.EXTRA_ADS -->{me.EXTRA_ADS}<!-- ELSEIF me.EXTRA_BIDS -->{me.EXTRA_BIDS}<!-- ELSEIF me.EXTRA_DISTINCTION -->{me.EXTRA_DISTINCTION}<!-- ELSEIF me.EXTRA_MAIN_PAGE -->{me.EXTRA_MAIN_PAGE}<!-- ENDIF -->
          </td>
          <td class="text-center">
            {mp.TIME} <!-- IF mp.TIME_TYPE == 'd' -->{_LANG_489}<!-- ELSEIF mp.TIME_TYPE == 'w' -->{_LANG_490}<!-- ELSEIF mp.TIME_TYPE == 'm' --> {_LANG_287}<!-- ENDIF -->
          </td>
          <td class="text-right"><!-- IF me.FREE -->0<!-- ELSE -->{mp.PRICE}<!-- ENDIF --> {CURRENCY}</td>
          <td class="text-center submit">
            <!-- IF me.FREE --><span class="badge badge-danger p-2 free">{_LANG_283}</span><!-- ENDIF -->
            <button type="submit" name="mp_id" value="{mp.ID}" class="btn btn-primary">{_LANG_293}</button>
          </td>
        </tr>
        <!-- END mp -->
        <!-- END me -->
      </table>
    </div>
    <input type="hidden" name="buy" value="1" />
  </form>
  <!-- ENDIF -->

  <!-- IF CONTENT_TEXT_18 --><p class="my-5">{CONTENT_TEXT_18}</p><!-- ENDIF -->

  <!-- ENDIF -->

</section>

<div class="modal fade" id="packages" tabindex="-1" role="dialog" aria-labelledby="extend" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{_LANG_294}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="others table table-striped">
          <tr>
            <th>{_LANG_295}</th>
            <th class="text-center">{_LANG_296}</th>
            <th class="text-center">{_LANG_297}</th>
            <th class="text-center">{_LANG_298}</th>
            <th></th>
          </tr>
          <!-- BEGIN me -->
          <!-- BEGIN mp -->
          <tr>
            <td>
              <!-- IF me.EXTRA_ADS -->{_LANG_485}<!-- ELSEIF me.EXTRA_BIDS -->{_LANG_486}<!-- ELSEIF me.EXTRA_DISTINCTION -->{_LANG_487}<!-- ELSEIF me.EXTRA_MAIN_PAGE -->{_LANG_488}<!-- ENDIF -->
            </td>
            <td class="text-center">
              <!-- IF me.EXTRA_ADS -->{me.EXTRA_ADS}<!-- ELSEIF me.EXTRA_BIDS -->{me.EXTRA_BIDS}<!-- ELSEIF me.EXTRA_DISTINCTION -->{me.EXTRA_DISTINCTION}<!-- ELSEIF me.EXTRA_MAIN_PAGE -->{me.EXTRA_MAIN_PAGE}<!-- ENDIF -->
            </td>
            <td class="text-center">
              {mp.TIME} <!-- IF mp.TIME_TYPE == 'd' -->{_LANG_489}<!-- ELSEIF mp.TIME_TYPE == 'w' -->{_LANG_490}<!-- ELSEIF mp.TIME_TYPE == 'm' --> {_LANG_287}<!-- ENDIF -->
            </td>
            <td class="text-right"><!-- IF me.FREE -->0<!-- ELSE -->{mp.PRICE}<!-- ENDIF --> {CURRENCY}</td>
            <td class="text-center submit">
              <!-- IF me.FREE --><span class="badge badge-danger p-2 free">{_LANG_283}</span><!-- ENDIF -->
              <button type="submit" name="mp_id" value="{mp.ID}" class="btn btn-primary">{_LANG_293}</button>
            </td>
          </tr>
          <!-- END mp -->
          <!-- END me -->
        </table>
      </div>
      <input type="hidden" name="buy" value="1" />
    </form>
  </div>
</div>

<div class="modal fade" id="extend" tabindex="-1" role="dialog" aria-labelledby="extend" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{_LANG_303}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- BEGIN m -->
        <!-- IF m.ID == M_ID -->

        <table class="table table-striped table-hover">
          <!-- BEGIN mp -->
          <tr>
            <td>
              <span>{mp.TIME} {_LANG_287}</span>
            </td>
            <td class="text-right">
              <strong><!-- IF m.FREE -->0<!-- ELSE -->{mp.PRICE}<!-- ENDIF --> {CURRENCY}</strong>
            </td>
            <td class="text-center">
              <input type="radio" name="mp_id" class="mp_id" value="{mp.ID}" data-show=".m{m.ID}_{mp.ID}"<!-- IF mp.NO == 1 --> checked<!-- ENDIF --> />
            </td>
          </tr>
          <!-- END mp -->
        </table>
        <!-- ENDIF -->
        <!-- END m -->
      </div>
      <div class="modal-footer">
        <button type="submit" name="buy" value="1" class="btn btn-primary">{_LANG_293}</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="change" tabindex="-1" role="dialog" aria-labelledby="change" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{_LANG_308}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- BEGIN m -->
        <!-- IF m.ID > M_ID -->
        <h3>{_LANG_282} {m.NAME}</h3>
        <table class="table table-striped table-hover">
          <!-- BEGIN mp -->
          <tr>
            <td>
              <span>{mp.TIME} {_LANG_287}</span>
            </td>
            <td class="text-right">
              <strong><!-- IF m.FREE -->0<!-- ELSE -->{mp.PRICE}<!-- ENDIF --> {CURRENCY}</strong>
            </td>
            <td class="text-center">
              <input type="radio" name="mp_id" class="mp_id" value="{mp.ID}" data-show=".m{m.ID}_{mp.ID}"<!-- IF mp.NO == 1 --> checked<!-- ENDIF --> />
            </td>
          </tr>
          <!-- END mp -->
        </table>
        <!-- ENDIF -->
        <!-- END m -->
      </div>
      <div class="modal-footer">
        <button type="submit" name="buy" value="1" class="btn btn-primary">{_LANG_293}</button>
      </div>
    </form>
  </div>
</div>



<!-- INCLUDE tpl_user_close.tpl -->
