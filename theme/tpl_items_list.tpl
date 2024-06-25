<div class="items" id="list">
  <div class="items-list row">
    <!-- BEGIN i -->
    <div class="item-box <!-- IF VIEW-MODE == 'tiles' -->col-lg-3 col-md-6 col-12<!-- ELSE -->col-12<!-- ENDIF -->">
      <div class="border rounded p-3 my-3 item<!-- IF FUNC_FILE == 'items_list' || FUNC_FILE == 'watching' --> item-user<!-- ENDIF --><!-- IF VIEW-MODE == 'tiles' --> item-tiles<!-- ENDIF --><!-- IF i.PROMO_DISTINCTION --> distinction<!-- ENDIF --><!-- IF i.PROMO_BACKLIGHT --> backlight<!-- ENDIF -->">
        <div class="row">
          <!-- IF i.PROMO_DISTINCTION --><div class="corner-ribbon"></div><!-- ENDIF -->
          <a title="{i.TITLE}" class="link" href="{i.HREF}">{_LANG_191}</a>
          <!-- IF VIEW-MODE == 'tiles' -->
          <h2 class="col-12 mb-2 text-truncate<!-- IF i.PROMO_BOLD --> bold<!-- ENDIF -->">{i.TITLE}</h2>
          <!-- ENDIF -->
          <div class="img p-md-4 p-0 <!-- IF FUNC_FILE == 'list' -->col-md-2 col-3<!-- ELSE --><!-- IF VIEW-MODE == 'tiles' -->col-12 p-0 pl-2<!-- ELSE -->col-md-1 col-3<!-- ENDIF --><!-- ENDIF -->">
            <img class="mw-100 border" alt="{i.TITLE}" src="{i.PHOTO}" />
          </div>
          <div class="<!-- IF FUNC_FILE == 'list' || FUNC_FILE == 'profile' || MAIN-PAGE --><!-- IF VIEW-MODE == 'tiles' -->col-12<!-- ELSE -->col-md col-9<!-- ENDIF --><!-- ELSE -->col-lg-auto col-12<!-- ENDIF -->">

            <div class="user">
              <!-- IF i.USERNAME && VIEW-MODE == 'tiles' && (FUNC_FILE == 'list' || FUNC_FILE == '') -->
              <small>{_LANG_169}</small><br />
              <a href="{i.USER_PROFILE_HREF}">{i.USERNAME}</a>
              <!-- ENDIF -->
            </div>
            <!-- IF LIST_TYPE == '' && VIEW-MODE == 'tiles' -->
            <div class="details details-tiles">
            </div>

            <!-- ELSE -->

            <!-- IF FUNC_FILE == 'items_list' -->
            <!-- IF i.ACTIVE == 0 --><span class="badge badge-danger text-uppercase mb-0">{_LANG_173}</span><!-- ENDIF -->
            <!-- ENDIF -->

            <!-- ENDIF -->

            <!-- IF VIEW-MODE == '' -->
            <h2 class="mt-4 mb-3<!-- IF i.PROMO_BOLD --> bold<!-- ENDIF -->">
              {i.TITLE}
            </h2>
            <!-- ENDIF -->

            <!-- IF VIEW-MODE == '' -->
            <div class="details" style="opacity:0.8;">
              <small><i class="far fa-clock fa-lg mr-2"></i>{i.DATE_START}</small>
            </div>
            <!-- ENDIF -->

            <!-- IF LIST_TYPE == '' -->
            <div class="row">
              <!-- IF VIEW-MODE == '' && (FUNC_FILE == 'list' || FUNC_FILE == 'profile') && IS_USER && i.COMPANY_NAME -->
              <div class="col-lg-auto col-6">
                <small>{_LANG_169}:</small>
                <a href="{i.USER_PROFILE_HREF}">{i.COMPANY_NAME}</a>
              </div>
              <!-- ENDIF -->
            </div>
            <!-- ENDIF -->
            <!-- IF FUNC_FILE == 'items_list' || FUNC_FILE == 'watching' -->
            <div class="mt-3">
              <small>
                {_LANG_178} {i.DATE}
                <strong class="mx-4">&bull;</strong>
                {_LANG_180} {i.VIEWS}
              </small>
            </div>
            <!-- ENDIF -->
          </div>

          <div class="col-auto ml-auto my-auto">
            <!-- IF FUNC_FILE != 'items_list' -->
            <span class="btn btn-primary" role="button">
              <!-- IF LIST_TYPE == 'companies' -->Zobacz ogłoszenia<!-- ELSE -->Aplikuj teraz<!-- ENDIF -->
            </span>
            <!-- ENDIF -->
          </div>

          <!-- IF FUNC_FILE == 'items_list' || FUNC_FILE == 'watching' -->
          <div class="col-md-2 col-12 options">
            <!-- IF FUNC_FILE == 'items_list' -->
            <!-- IF .i.o -->
            <a class="btn btn-primary px-0" href="#" data-toggle="modal" data-target="#offersList-{i.ID}">Lista złożonych CV</a>
            <hr />
            <!-- ENDIF -->
            <!-- IF i.ACTIVE == 0  --><a class="btn btn-dark" href="{SITEURL}/funcs.php?name=user&amp;file=items_list&amp;op=show&amp;id={i.ID}">{_LANG_184}</a><!-- ENDIF -->
            <!-- IF i.SAVE_ONLY == 0 && i.ACTIVE == 1 --><a class="btn btn-outline-dark" href="{SITEURL}/funcs.php?name=user&amp;file=items_list&amp;op=hide&amp;id={i.ID}">{_LANG_185}</a><!-- ENDIF -->
            <!-- ENDIF -->
            <a class="btn btn-outline-primary" href="{SITEURL}/funcs.php?name=user&amp;file=item_edit&amp;id={i.ID}">{_LANG_183}</a>
            <hr />
            <!-- IF i.VERYFI == 1 -->
            <!-- IF i.ACTIVE -->
            <!-- IF ITEMS_DISTINCTION && i.DISTINCTION == 0 --><a class="btn btn-success px-0" href="{SITEURL}/funcs.php?name=user&amp;file=items_list&amp;op=distinction&amp;id={i.ID}">{_LANG_186}</a><!-- ENDIF -->
            <!-- IF ITEMS_BIDS --><a class="btn btn-info px-0" href="{SITEURL}/funcs.php?name=user&amp;file=items_list&amp;op=bids&amp;id={i.ID}">{_LANG_187}</a><!-- ENDIF -->
            <hr />
            <!-- ENDIF -->
            <a class="btn btn-outline-danger" href="{SITEURL}/funcs.php?name=user&amp;file=items_list&amp;op=delete&amp;id={i.ID}" onclick="return confirm('Jesteś pewien, że chcesz usunąć ogłoszenie?');">{_LANG_182}</a>
            <!-- ENDIF -->
            <!-- IF FUNC_FILE == 'watching' -->
            <a href="{SITEURL}/funcs.php?name=user&amp;file=watching&amp;delete={i.ID}" class="mt-5">{_LANG_188}</a>
            <!-- ENDIF -->
          </div>
          <!-- ENDIF -->
          <!-- IF VIEW-MODE == 'tiles' && MAIN-PAGE == '' -->
          <!-- ENDIF -->
        </div>
      </div>
    </div>
    <!-- END i -->
  </div>
</div>
