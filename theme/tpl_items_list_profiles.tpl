<div class="items" id="list">
  <div class="items-list<!-- IF CAROUSEL_PROFILES == '' --> row<!-- ENDIF -->">

    <!-- IF CAROUSEL_PROFILES -->
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
    <!-- ENDIF -->

    <!-- BEGIN p -->

    <!-- IF CAROUSEL_PROFILES && p.CAROUSEL_BOX_START --><div class="carousel-item<!-- IF p.CAROUSEL_BOX_ACTIVE --> active<!-- ENDIF -->"><div class="row"><!-- ENDIF -->

    <div class="item-box <!-- IF VIEW-MODE == 'tiles' -->col-xl-3 col-lg-4 col-md-6 col-12<!-- ELSE -->col-12<!-- ENDIF -->">
      <div class="row item bg-white<!-- IF FUNC_FILE == 'items_list' || FUNC_FILE == 'watching' --> item-user<!-- ENDIF --><!-- IF VIEW-MODE == 'tiles' --> item-tiles<!-- ENDIF --><!-- IF p.PROMO_DISTINCTION --> distinction<!-- ENDIF --><!-- IF p.PROMO_BACKLIGHT --> backlight<!-- ENDIF -->">
        <!-- IF p.PROMO_DISTINCTION --><div class="corner-ribbon">{_LANG_522}</div><!-- ENDIF -->
        <!-- IF VIEW-MODE == 'tiles' -->
        <h2 class="col-12 mt-0 mb-2 text-truncate<!-- IF p.PROMO_BOLD --> bold<!-- ENDIF -->">{p.TITLE}</h2>
        <!-- ENDIF -->
        <div class="mt-2 mb-4 img <!-- IF FUNC_FILE == 'items_list' -->col-xl-3 col-lg-3 col-3 d-md-inline d-none<!-- ELSE --><!-- IF VIEW-MODE == 'tiles' -->col-12 p-0<!-- ELSE -->col-md-2 col-3<!-- ENDIF --><!-- ENDIF -->" style="height:180px;">
          <a title="{p.TITLE}" href="{p.HREF}"><img style="width:250px;" class="d-block mw-100 mx-auto" alt="{p.TITLE}" src="{p.PHOTO}" /></a>
        </div>
        <div class="<!-- IF FUNC_FILE == 'categories' || FUNC_FILE == 'profile' || MAIN-PAGE --><!-- IF VIEW-MODE == 'tiles' -->col-12<!-- ELSE -->col-md-10 col-9<!-- ENDIF --><!-- ELSE -->col-md-9 col-12<!-- ENDIF -->">

            <!-- IF  LIST_TYPE == '' && VIEW-MODE == '' --><span class="float-right badge badge-<!-- IF p.TYPE == 270 -->success<!-- ELSEIF p.TYPE == 271 -->danger<!-- ENDIF --> d-inline-block text-uppercase p-2">{p.TYPE_NAME}</span><!-- ENDIF -->

          <!-- IF LIST_TYPE == '' && VIEW-MODE == 'tiles' -->


          <!-- ELSE -->

          <!-- IF FUNC_FILE == 'items_list' -->
          <!-- IF p.VERYFI == 0 --><span class="badge badge-warning text-uppercase mb-0">{_LANG_172}</span><!-- ENDIF -->
          <!-- IF p.ACTIVE == 0 --><span class="badge badge-danger text-uppercase mb-0">{_LANG_173}</span><!-- ENDIF -->
          <!-- IF p.VERYFI == 1 && p.SAVE_ONLY == 1 --><span class="badge badge-secondary text-uppercase mb-0">{_LANG_174}</span><!-- ENDIF -->
          <!-- ENDIF -->

          <!-- ENDIF -->

          <!-- IF VIEW-MODE == '' -->
          <h2 class="mt-0 mb-3<!-- IF p.PROMO_BOLD --> bold<!-- ENDIF -->">
            <a title="{p.TITLE}" href="{p.HREF}">{p.TITLE}</a>
          </h2>
          <!-- IF FUNC_FILE != 'items_list' --><p>Użytkownik: <a href="{p.USER_PROFILE_HREF}">{p.USERNAME}</a></p><!-- ENDIF -->
          <!-- ENDIF -->

          <!-- IF VIEW-MODE == '' -->

          <!-- IF FUNC_FILE != 'items_list' -->
          <p class="my-3 d-md-block d-none">
            {p.DESCRIPTION}
          </p>
          <!-- ENDIF -->

          <!-- ENDIF -->
          <!-- IF LIST_TYPE == '' -->
          <div class="row">
            <!-- IF VIEW-MODE == '' && (FUNC_FILE == 'categories' || FUNC_FILE == 'profile') && IS_USER && p.COMPANY_NAME -->
            <div class="col-lg-4 col-md-6 user">
              <small>{_LANG_169}:</small>
              <a href="{p.USER_PROFILE_HREF}">{p.COMPANY_NAME}</a>
              <!-- IF p.U_VERYFI -->
              <span class="veryfi text-amber mt-1">{_LANG_170}</span>
              <!-- ENDIF -->
            </div>
            <!-- ENDIF -->
          </div>
          <!-- ENDIF -->
          <!-- IF FUNC_FILE == 'items_list' || FUNC_FILE == 'watching' -->
          <div class="mt-3">
            <small>
              {_LANG_178} {p.DATE}
              <strong class="mx-4">&bull;</strong>
              {_LANG_180} {p.VIEWS}
            </small>
          </div>
          <!-- ENDIF -->
          <a title="{p.TITLE}" href="{p.HREF}" class="btn btn-main btn-block d-block mt-5">Zobacz</a>
        </div>
        <!-- IF FUNC_FILE == 'items_list' || FUNC_FILE == 'watching' -->
        <div class="col-md-1 col-12 options dropdown text-center">
            <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="dd{p.ID}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Opcje</a>
            <div class="dropdown-menu" aria-labelledby="dd{p.ID}">
              <!-- IF FUNC_FILE == 'items_list' -->
              <!-- IF p.ACTIVE == 0  --><a class="dropdown-item" href="{SITEURL}/user/items_list?op=show&amp;id={p.ID}">{_LANG_184}</a><!-- ENDIF -->
              <!-- IF p.SAVE_ONLY == 0 && p.ACTIVE == 1 --><a class="dropdown-item" href="{SITEURL}/user/items_list?op=hide&amp;id={p.ID}">{_LANG_185}</a><!-- ENDIF -->
              <a class="dropdown-item" href="{SITEURL}/user/item_edit?id={p.ID}">{_LANG_183}</a>
              <hr />
              <!-- ENDIF -->
              <!-- IF p.VERYFI == 1 -->
              <!-- IF p.ACTIVE -->
              <!-- IF ITEMS_DISTINCTION && p.DISTINCTION == 0 --><a class="dropdown-item" href="{SITEURL}/user/items_list?op=distinction&amp;id={p.ID}">{_LANG_186}</a><!-- ENDIF -->
              <!-- IF ITEMS_BIDS --><a class="dropdown-item" href="{SITEURL}/user/items_list?op=bids&amp;id={p.ID}">{_LANG_187}</a><!-- ENDIF -->
              <hr />
              <!-- ENDIF -->
              <a class="dropdown-item" href="{SITEURL}/user/items_list?op=delete&amp;id={p.ID}" onclick="return confirm('Jesteś pewien, że chcesz usunąć ogłoszenie?');">{_LANG_182}</a>
              <!-- ENDIF -->
              <!-- IF FUNC_FILE == 'watching' -->
              <a class="dropdown-item" href="{SITEURL}/user/watching?delete={p.ID}" class="mt-5">{_LANG_188}</a>
              <!-- ENDIF -->
            </div>
          </div>
        <!-- ENDIF -->
        <!-- IF VIEW-MODE == 'tiles' && MAIN-PAGE == '' -->
        <!-- ENDIF -->
      </div>
    </div>

    <!-- IF CAROUSEL_PROFILES && p.CAROUSEL_BOX_END --></div></div><!-- ENDIF -->

    <!-- END i -->

    <!-- IF CAROUSEL_PROFILES -->
      </div>
    </div>
    <!-- ENDIF -->

  </div>
</div>
