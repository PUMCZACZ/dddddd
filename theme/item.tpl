<!-- INCLUDE theme_header.tpl -->

<!-- IF ADV_8 --><div class="adv-show">{ADV_8}</div><!-- ENDIF -->

<!-- IF ITEM -->
</main>
<div class="bg-light py-2 mb-3">
  <div class="container">
    <nav aria-label="breadcrumb" class="mt-3">
      <ol class="breadcrumb p-0">
        <li class="breadcrumb-item"><a href="{SITEURL}"><em class="fa fa-home"></em></a></li>
        <!-- BEGIN brdcrmbs -->
        <li class="breadcrumb-item"><a href="{brdcrmbs.HREF}">{brdcrmbs.NAME}</a></li>
        <!-- END brdcrmbs -->
      </ol>
    </nav>
  </div>
</div>
<main class="container main-container pt-4">
<!-- ENDIF -->

<section class="item-info mt-5">
  <div class="row">

    <div class="col-md-7 offset-md-1 col-12">

      <!-- IF PROFILE && AVATAR -->
      <div class="text-center"><img class="mw-100" src="{AVATAR}" /></div>
      <hr />
      <!-- ENDIF -->

      <div class="row border-bottom pb-4 gallery">
        <div class="col-md-2 col-12 bg-light px-2 py-3 border align-middle" onclick="openModal();currentSlide(1)">
          <!-- IF ITEM -->
          <!-- IF .p || IMAGE_MAIN -->
          <img class="main-pic mw-100 d-block align-middle" src="{IMAGE_MAIN}" />
          <!-- ENDIF -->
          <!-- ENDIF -->
        </div>
        <div id="myModal" class="modal item-gallery-modal">
          <span class="close cursor" onclick="closeModal()">&times;</span>
          <div class="modal-content">
            <!-- IF PHONE -->
            <span class="phone-msg">
              <em class="fa fa-phone mr-2 mb-0"></em> <span id="number2" class="text-primary align-middle" data-last="{PHONE_END}">{PHONE_START} <span class="btn btn-main align-middle btn-sm">Wyświetl numer</span><span class="phone-end"></span></span>
            </span>
            <!-- ENDIF -->
            <a href="#" class="btn btn-primary px-5 font-weight-bold text-uppercase" data-toggle="modal" data-target="#msgSendApp">Aplikuj</a>
            <h1 class="py-3 px-3">{TITLE}</h1>
            <div class="mySlides">
              <img src="{IMAGE_MAIN}" class="hover-shadow" />
            </div>
            <!-- BEGIN p -->
            <div class="mySlides">
              <img src="{p.IMAGE}" class="hover-shadow" />
            </div>
            <!-- END p -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <div class="caption-container">
              <p id="caption"></p>
            </div>
            <div class="thumbs">
              <span class="column">
                <img class="demo" src="{IMAGE_MAIN}" onclick="currentSlide(1)" alt="">
              </span>
              <!-- BEGIN p -->
              <span class="column">
                <img class="demo" src="{p.IMAGE}" onclick="currentSlide({p.NO})" alt="">
              </span>
              <!-- END p -->
            </div>
          </div>
        </div>
        <div class="col-md-10 col-12 pl-5 mt-4">
          <h1>{TITLE}</h1>
          <i class="fas fa-map-marker-alt text-primary"></i>
          <span class="text-secondary">
            <!-- IF COUNTRY -->{COUNTRY}, <!-- ENDIF -->
            <!-- IF REGION -->{REGION}, <!-- ENDIF -->
            {CITY}
            <!-- IF ADDRESS --><br />{_LANG_21} {ADDRESS}<!-- ENDIF -->
          </span>
          <!-- IF MULTILANG -->
          <div class="d-inline-block float-right">
            <strong>{_LANG_30} <!-- IF ITEM --><!-- ELSE -->{_LANG_499}<!-- ENDIF --></strong>
            <!-- BEGIN langs -->
            <a href="{ITEM_HREF}&amp;lang={langs.NAME_DEF}">{langs.NAME}</a>
            <!-- END langs -->
          </div>
          <!-- ENDIF -->
        </div>
      </div>
      <!-- IF U_VERYFI -->
      <span class="veryfi float-right text-amber mt-1">{_LANG_170}</span>
      <!-- ENDIF -->

      <!-- IF ITEM -->
      <!-- ELSE -->
      <div class="price-info row">
        <div class="col-md-2 offset-md-10 col-12 watch text-center text-nowrap">
          <a class="mt-1" href="funcs.php?name=items&amp;id={ID}&amp;watch-user=1<!-- IF FUNC_FILE == 'profile' -->&amp;file=profile<!-- ENDIF -->"><i class="far fa-address-card"></i><br />{_LANG_26}</a>
        </div>
      </div>
      <!-- ENDIF -->

      <!-- IF PROFILE && (SOCIAL_FB || SOCIAL_INSTA) -->
      <div class="float-right">
        <!-- IF SOCIAL_FB --><a target="_blank" href="{SOCIAL_FB}"><big class="fab fa-facebook text-primary mx-2" style="font-size:28px;"></big></a><!-- ENDIF -->
        <!-- IF SOCIAL_INSTA --><a target="_blank" href="{SOCIAL_INSTA}"><big class="fab fa-instagram text-danger mx-2" style="font-size:28px;"></big></a><!-- ENDIF -->
      </div>
      <!-- ENDIF -->

      <!-- IF FILE -->
      <p class="text-center mt-3">
        <a class="btn btn-primary px-5 font-weight-bold text-uppercase" href="funcs.php?name=items&amp;id={ID}&amp;get_file=1">Plik PDF</a>
      </p>
      <!-- ENDIF -->

      <div class="item-desc my-5">
        {ITEM_DESC}
      </div>
      <hr />
      <p class="text-center">
        <a href="#" class="btn btn-primary px-5 font-weight-bold text-uppercase" data-toggle="modal" data-target="#msgSendApp">Aplikuj</a>
      </p>

      <!-- IF PROFILE -->
      <!-- IF .up -->
      <div class="multimedia mt-5">
        <h6>{_LANG_32}</h6>
        <ul class="gallery list list-inline mt-2">
          <!-- BEGIN up -->
          <!-- IF up.IMAGE --><li class="list-inline-item mr-3 col-2" onclick="openModal();currentSlide({up.NO})"><img class="mw-100" src="{up.IMAGE}" /></li><!-- ENDIF -->
          <!-- END up -->
        </ul>
        <div id="myModal" class="modal item-gallery-modal">
          <span class="close cursor" onclick="closeModal()">&times;</span>
          <div class="modal-content">
            <!-- IF IS_USER && USER_ID != 1 -->
            <a class="btn btn-main send-msg px-5 d-md-block d-none" href="#" data-toggle="modal" data-target="#msgSend">{_LANG_3}</a>
            <!-- ELSEIF USER_ID != 1 -->
            <a class="btn btn-main send-msg px-5 d-md-block d-none" href="funcs.php?name=items&amp;id={ID}&amp;send-msg=1">{_LANG_3}</a>
            <!-- ENDIF -->
            <h1 class="py-0 px-3">{TITLE}</h1>
            <p class="py-0 px-3 pt-2 price d-md-block d-none">{PRICE} {ITEM_CURRENCY}<!-- IF UNIT --> / {UNIT}<!-- ENDIF --></p>
            <!-- BEGIN up -->
            <div class="mySlides">
              <img src="{up.IMAGE}" class="hover-shadow" />
            </div>
            <!-- END up -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <div class="caption-container">
              <p id="caption"></p>
            </div>
            <div class="thumbs">
              <!-- BEGIN up -->
              <span class="column">
                <img class="demo" src="{up.IMAGE}" onclick="currentSlide({up.NO})" alt="">
              </span>
              <!-- END up -->
            </div>
          </div>
        </div>
      </div>
      <!-- ENDIF -->
      <div class="multimedia mt-5">
        <h6>{_LANG_34}</h6>
        <!-- INCLUDE tpl_items_list.tpl -->
      </div>
      <!-- IF PAGER -->
      <nav aria-label="navigation" class="float-right">
        <ul class="pagination">
          {PAGER}
        </ul>
      </nav>
      <!-- ENDIF -->
      <!-- ENDIF -->

    </div>

    <div class="col-md-3">
      <!-- IF ITEM -->
      <h4 class="text-capitalize mb-4">{_LANG_118}</h4>
      <div class="card mb-3">
        <div class="card-body item-info-box">
          <div class="row">
            <div class="col-3 text-center"><i class="far fa-calendar-alt text-info"></i></div>
            <div class="col-9">
              <h5 class="m-0">{_LANG_537}</h5>
              <span class="text-secondary">{FROM_START}</span>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-3 text-center"><i class="far fa-money-bill-alt text-info"></i></div>
            <div class="col-9">
              <h5 class="m-0">{_LANG_29}</h5>
              <span class="text-secondary"><!-- IF PRICE > 0 -->{PRICE} {ITEM_CURRENCY}<!-- IF UNIT --> / {UNIT}<!-- ENDIF --><!-- ELSE -->{_LANG_512}<!-- ENDIF --></span>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-3 text-center"><i class="fas fa-map-marker-alt text-info"></i></div>
            <div class="col-9">
              <h5 class="m-0">{_LANG_20}</h5>
              <span class="text-secondary">
                <!-- IF COUNTRY -->{COUNTRY}, <!-- ENDIF -->
                <!-- IF REGION -->{REGION}, <!-- ENDIF -->
                {CITY}
                <!-- IF ADDRESS --><br />{_LANG_21} {ADDRESS}<!-- ENDIF -->
              </span>
            </div>
          </div>
          <!-- IF ACTIVE -->
          <div class="row mt-4">
            <div class="col-3 text-center"><i class="far fa-address-card text-info"></i></div>
            <div class="col-9">
              <h5 class="m-0">{_LANG_26}</h5>
              <a class="text-secondary" href="funcs.php?name=items&amp;id={ID}&amp;watch=1">{_LANG_26}</a>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-3 text-center"><i class="fa fa-user text-info"></i></div>
            <div class="col-9">
              <h5 class="m-0"><!-- IF PROFILE -->{_LANG_97}<!-- ELSE -->{_LANG_528}<!-- ENDIF --></h5>
              <a class="my-3 d-block text-info" title="{_LANG_591}" href="funcs.php?name=items&amp;file=list&amp;user_id={USER_ID}&amp;id=0&amp;search=1&amp;end=1"><!-- IF USERNAME -->{USERNAME}<!-- ELSE -->{USER_EMAIL_HIDDEN}<!-- ENDIF --> <i class="ml-1 fas fa-search"></i></a>
              <!-- IF PHONE -->
              <div class="text-secondary"><em class="fa fa-phone mr-2 mb-0"></em> <span id="number" class="text-primary align-middle" data-last="{PHONE_END}">{PHONE_START} <span class="btn btn-main align-middle btn-sm">Wyświetl numer</span><span class="phone-end"></span></span></div>
              <!-- ENDIF -->
              <!-- IF IS_USER -->
              <a class="btn btn-primary btn-sm send-msg px-4 mt-3" href="#" data-toggle="modal" data-target="#msgSend">{_LANG_3}</a>
              <!-- ELSE -->
              <a class="btn btn-primary btn-sm send-msg px-4 mt-3" href="funcs.php?name=items<!-- IF FUNC_FILE == 'profile' -->&amp;file=profile<!-- ENDIF -->&amp;id={ID}&amp;send-msg=1">{_LANG_3}</a>
              <!-- ENDIF -->
            </div>
          </div>

          <!-- IF PROFILE -->
          <!-- IF SHOW_PHONE && .phones -->
          <div class="row mt-4">
            <div class="col-3 text-center"><i class="fa fa-phone text-info"></i></div>
            <div class="col-9">
              <h5 class="m-0">{_LANG_15}</h5>
              <!-- BEGIN phones -->
              <div class="ml-4 text-secondary">{phones.NUMBER}</div>
              <!-- END phones -->
            </div>
          </div>
          <!-- ENDIF -->
          <!-- IF SHOW_WEBSITE && .websites -->
          <div class="row mt-4">
            <div class="col-3 text-center"><i class="fa fa-globe text-info"></i></div>
            <div class="col-9">
              <h5 class="m-0">{_LANG_18}</h5>
              <!-- BEGIN websites --><div class="ml-4 text-secondary">{websites.WEBSITE}</div><!-- END websites -->
            </div>
          </div>
          <!-- ENDIF -->
          <!-- ENDIF -->

          <!-- IF ITEM -->
          <hr class="my-4" />
          <p class="text-center mb-0">
            <a href="#" class="btn btn-primary px-5 font-weight-bold text-uppercase" data-toggle="modal" data-target="#msgSendApp">Aplikuj</a>
          </p>
          <!-- ENDIF -->

          <!-- ENDIF -->
        </div>
      </div>
      <!-- ENDIF -->
      <div class="map mt-5" id="map">
        <iframe width="100%" height="250" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen src="https://maps.google.com/maps?f=q&source=s_q&hl=pl&geocode=&q={COUNTRY}+{CITY}+{ADDRESS}&ie=UTF8<!-- IF USER_MEMBER -->&hq={CITY}&hnear={CITY}<!-- ENDIF -->&z=11&iwloc=A&output=embed"></iframe>
      </div>

      <div class="text-center my-3">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- ogloszenie.online - 1 -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-9060310957910876"
             data-ad-slot="3004274423"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
      </div>

    </div>

  </div>

  <!-- IF ITEM -->
  <section class="item-info">
    <div class="top-info text-right">
      <!-- IF ITEM -->ID: {ID} | {_LANG_23} {DATE} <!-- ENDIF -->| <a href="#" class="text-danger" data-toggle="modal" data-target="#abuseSend">{_LANG_24}</a>
    </div>
  </section>

  <div class="multimedia mt-5">
    <h6>{_LANG_594}</h6>
    <!-- INCLUDE tpl_items_list.tpl -->
  </div>
  <!-- IF PAGER -->
  <nav aria-label="navigation" class="float-right">
    <ul class="pagination">
      {PAGER}
    </ul>
  </nav>
  <!-- ENDIF -->
    <!-- ENDIF -->

</section>

<!-- IF ADV_9 --><div class="adv-show">{ADV_9}</div><!-- ENDIF -->

<div class="modal fade" id="abuseSend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{_LANG_35}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <!-- IF PROFILE -->
          <div class="col-2">{_LANG_37}</div>
          <div class="col-9"><!-- IF USERNAME -->{USERNAME}<!-- ELSE -->{USER_EMAIL_HIDDEN}<!-- ENDIF --></div>
          <!-- ELSE -->
          <div class="col-2">{_LANG_2}</div>
          <div class="col-9">{TITLE}</div>
          <!-- ENDIF -->
        </div>
        <div class="form-group">
          <label>{_LANG_39}</label>
          <textarea name="abuse-text" class="form-control" rows="4" required></textarea>
        </div>
        <div class="form-group">
          <label>{_LANG_165}</label>
          <input type="text" name="abuse-name" class="form-control" value="{USER_NAME}" />
        </div>
        <div class="form-group">
          <label>{_LANG_15}</label>
          <input type="text" name="abuse-phone" class="form-control" value="{USER_PHONE}" />
        </div>
        <div class="form-group">
          <label>{_LANG_45}</label>
          <input type="email" name="abuse-email" class="form-control" value="{USER_EMAIL}" required />
        </div>
        <p>Klikając „Wyślij”, zgadzam się na przetwarzanie moich danych osobowych przez medtalento.pl w celu realizacji procedury zgłaszania nadużycia.</p>
      </div>
      <div class="modal-footer">
        <!-- IF IS_USER == '' -->
        <!-- INCLUDE tpl_recaptcha.tpl -->
        <!-- ENDIF -->
        <input type="hidden" name="send-abuse" value="1" />
        <input type="hidden" name="id" value="<!-- IF PROFILE -->{USER_ID}<!-- ELSE -->{ID}<!-- ENDIF -->" />
        <button type="submit" class="btn btn-amber">{_LANG_40}</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="msgSend" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{_LANG_41}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <div class="col-md-3 col-3">{_LANG_2}</div>
          <div class="col-md-9 col-9"><strong>{TITLE}</strong></div>
          <div class="col-md-3 col-3">{_LANG_44}</div>
          <div class="col-md-9 col-9"><strong><!-- IF USERNAME -->{USERNAME}<!-- ELSE -->{USER_EMAIL_HIDDEN}<!-- ENDIF --></strong></div>
        </div>
        <!-- IF IS_USER == '' -->
        <div class="form-group row">
          <div class="col-6">
            <label>{_LANG_45}</label>
            <input type="email" name="email" class="form-control" required />
          </div>
          <div class="col-6">
            <label>{_LANG_46}</label>
            <input type="text" name="msg_name" class="form-control" required />
          </div>
        </div>
        <!-- ENDIF -->
        <div class="form-group">
          <label>{_LANG_47}</label>
          <textarea name="msg" class="form-control" rows="4" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <!-- IF IS_USER == '' -->
        <!-- INCLUDE tpl_recaptcha.tpl -->
        <!-- ENDIF -->
        <input type="hidden" name="id" value="{ID}" />
        <input type="hidden" name="send-msg" value="1" />
        <button type="submit" class="btn btn-main">{_LANG_40}</button>
      </div>
    </form>
  </div>
</div>

<div class="modal fade" id="msgSendApp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <form method="post" class="modal-content" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Aplikuj</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
          <div class="col-12 font-weight-bold">{TITLE}</div>
        </div>
        <hr />
        <!-- IF IS_USER == '' -->
        <div class="form-group row">
          <div class="col-6">
            <label>{_LANG_45}</label>
            <input type="email" name="email" class="form-control" required />
          </div>
          <div class="col-6">
            <label>{_LANG_46}</label>
            <input type="text" name="msg_name" class="form-control" required />
          </div>
        </div>
        <!-- ENDIF -->
        <div class="form-group row">
          <div class="col-md-6 col-12">
            <label>{_LANG_592}</label>
            <input type="file" name="cv" class="form-control" />
          </div>
        </div>
        <div class="form-group">
          <label>{_LANG_47}</label>
          <textarea name="msg" class="form-control" rows="4" required></textarea>
        </div>
        <div class="form-group">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" name="perm" value="1" id="perm" required />
            <label class="custom-control-label" for="perm"><small>Wyrażam zgodę na przetwarzanie moich danych osobowych dla potrzeb niezbędnych do realizacji procesu tej oraz przyszłych rekrutacji (zgodnie z ustawą z dnia 10 maja 2018 roku o ochronie danych osobowych (Dz. Ustaw z 2018, poz. 1000) oraz zgodnie z Rozporządzeniem Parlamentu Europejskiego i Rady (UE) 2016/679 z dnia 27 kwietnia 2016 r. w sprawie ochrony osób fizycznych w związku z przetwarzaniem danych osobowych i w sprawie swobodnego przepływu takich danych oraz uchylenia dyrektywy 95/46/WE (RODO)).</small></label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <!-- IF IS_USER == '' -->
        <!-- INCLUDE tpl_recaptcha.tpl -->
        <!-- ENDIF -->
        <input type="hidden" name="id" value="{ID}" />
        <input type="hidden" name="send-msg" value="1" />
        <button type="submit" class="btn btn-main">{_LANG_40}</button>
      </div>
    </form>
  </div>
</div>

<!-- INCLUDE theme_footer.tpl -->
