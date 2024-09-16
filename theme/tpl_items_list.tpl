<div class="items" id="list">
  <div class="items-list row <!-- IF FUNC_FILE == 'items_list' -->grid-items<!-- ENDIF -->">
    <!-- BEGIN i -->
    <div class="item-box <!-- IF VIEW-MODE == 'tiles' || FUNC_FILE == '' -->col-lg-6 col-md-6 col-12<!-- ELSE -->col-12<!-- ENDIF -->">
      <div style="border-radius: 8px;" class="shadow p-3 my-3 item<!-- IF FUNC_FILE == 'items_list' || FUNC_FILE == 'watching' --> item-user<!-- ENDIF --><!-- IF VIEW-MODE == 'tiles' --> item-tiles<!-- ENDIF --><!-- IF i.PROMO_DISTINCTION --> distinction<!-- ENDIF --><!-- IF i.PROMO_BACKLIGHT --> backlight<!-- ENDIF -->">
        <div class="row">
          <!-- IF i.PROMO_DISTINCTION && POKAZ_PROMO --><div class="corner-ribbon"></div><!-- ENDIF -->
          <!-- IF VIEW == 'name=items&file=list' -->
          <a title="{i.TITLE}" class="link" href="{i.HREF}">{_LANG_191} </a>
          <!-- ELSE -->
          <a title="{i.TITLE}" class="link" href="{SITEURL}/funcs.php?name=items&amp;file=company&amp;id={i.USER_ID}">{_LANG_191}</a>
          <!-- ENDIF -->
          <!-- IF VIEW-MODE == 'tiles' -->
          <h2 class="col-12 mb-2 text-truncate<!-- IF i.PROMO_BOLD --> bold<!-- ENDIF -->">{i.TITLE}</h2>
          <!-- ENDIF -->
          <div class="img my-auto <!-- IF FUNC_FILE == 'list' -->col-3<!-- ELSE --><!-- IF VIEW-MODE == 'tiles' -->col-12 p-0 pl-2<!-- ELSE -->col-3<!-- ENDIF --><!-- ENDIF -->">
            <img class="mw-100" alt="{i.TITLE}" src="{i.PHOTO}" />
          </div>
          <div class="<!-- IF FUNC_FILE == 'list' || FUNC_FILE == 'profile' || MAIN-PAGE --><!-- IF VIEW-MODE == 'tiles' -->col-12<!-- ELSE -->col-md col-9<!-- ENDIF --><!-- ELSE -->col-lg-6 col-12<!-- ENDIF -->">

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
            <div class="details">
              <div class="my-2"><i class="fas fa-map-marker-alt fa-lg mr-2"></i>{i.CITY}, {i.COUNTRY}</div>
              <div class="my-2"><i class="far fa-clock fa-lg mr-2"></i>{i.DATE_START}</div>
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
                <span class="mx-4"></span>
                {_LANG_180} {i.VIEWS}
              </small>
            </div>
            <!-- ENDIF -->
          </div>

          <!-- IF FUNC_FILE != 'items_list' -->
          <div class="col-auto ml-auto mt-auto">
            <span class="btn btn-application" role="button">
              <!-- IF LIST_TYPE == 'companies' -->Zobacz ogłoszenia<!-- ELSE -->Aplikuj teraz  ><!-- ENDIF -->
            </span>
          </div>
          <!-- ENDIF -->

          <!-- IF FUNC_FILE == 'items_list' || FUNC_FILE == 'watching' -->
          <div class="col-lg-3 col-12 options">
            <div class="row">
              <!-- IF FUNC_FILE == 'items_list' -->
              <!-- IF .i.o -->
              <a class="btn btn-primary px-0 col-6 col-lg-12" href="#" data-toggle="modal" data-target="#offersList-{i.ID}">Lista złożonych CV</a>
              <!-- ENDIF -->

              <!-- IF i.ACTIVE == 0  -->
              <div class="col-6 col-lg-12 d-flex button-item-list">
                <svg width="11" height="10" viewBox="0 0 11 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M4.83301 5.66658H1.49967C1.31079 5.66658 1.15245 5.6027 1.02467 5.47492C0.896897 5.34714 0.833008 5.18881 0.833008 4.99992C0.833008 4.81103 0.896897 4.6527 1.02467 4.52492C1.15245 4.39714 1.31079 4.33325 1.49967 4.33325H4.83301V0.999919C4.83301 0.81103 4.8969 0.652696 5.02467 0.524919C5.15245 0.397141 5.31079 0.333252 5.49967 0.333252C5.68856 0.333252 5.8469 0.397141 5.97467 0.524919C6.10245 0.652696 6.16634 0.81103 6.16634 0.999919V4.33325H9.49967C9.68856 4.33325 9.8469 4.39714 9.97467 4.52492C10.1025 4.6527 10.1663 4.81103 10.1663 4.99992C10.1663 5.18881 10.1025 5.34714 9.97467 5.47492C9.8469 5.6027 9.68856 5.66658 9.49967 5.66658H6.16634V8.99992C6.16634 9.18881 6.10245 9.34714 5.97467 9.47492C5.8469 9.6027 5.68856 9.66658 5.49967 9.66658C5.31079 9.66658 5.15245 9.6027 5.02467 9.47492C4.8969 9.34714 4.83301 9.18881 4.83301 8.99992V5.66658Z" fill="#008A1E"/>
                </svg>
                <a class="btn green" href="{SITEURL}/funcs.php?name=user&amp;file=items_list&amp;op=show&amp;id={i.ID}">{_LANG_184}</a>
              </div>

              <!-- ENDIF -->
              <!-- IF i.SAVE_ONLY == 0 && i.ACTIVE == 1 --><a class="btn btn-outline-dark" href="{SITEURL}/funcs.php?name=user&amp;file=items_list&amp;op=hide&amp;id={i.ID}">{_LANG_185}</a><!-- ENDIF -->
              <!-- ENDIF -->
              <div class="col-6 col-lg-12 button-item-list ">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M1.33333 10.6667H2.28333L8.8 4.15L7.85 3.2L1.33333 9.71667V10.6667ZM0.666667 12C0.477778 12 0.319444 11.9361 0.191667 11.8083C0.0638889 11.6806 0 11.5222 0 11.3333V9.71667C0 9.53889 0.0333333 9.36944 0.1 9.20833C0.166667 9.04722 0.261111 8.90556 0.383333 8.78333L8.8 0.383333C8.93333 0.261111 9.08056 0.166667 9.24167 0.1C9.40278 0.0333333 9.57222 0 9.75 0C9.92778 0 10.1 0.0333333 10.2667 0.1C10.4333 0.166667 10.5778 0.266667 10.7 0.4L11.6167 1.33333C11.75 1.45556 11.8472 1.6 11.9083 1.76667C11.9694 1.93333 12 2.1 12 2.26667C12 2.44444 11.9694 2.61389 11.9083 2.775C11.8472 2.93611 11.75 3.08333 11.6167 3.21667L3.21667 11.6167C3.09444 11.7389 2.95278 11.8333 2.79167 11.9C2.63056 11.9667 2.46111 12 2.28333 12H0.666667ZM8.31667 3.68333L7.85 3.2L8.8 4.15L8.31667 3.68333Z" fill="#E7B903"/>
                </svg>
                <a class="btn yellow" href="{SITEURL}/funcs.php?name=user&amp;file=item_edit&amp;id={i.ID}">{_LANG_183}</a>
              </div>

              <!-- IF i.VERYFI == 1 -->
              <!-- IF i.ACTIVE -->

              <!-- IF ITEMS_DISTINCTION && i.DISTINCTION == 0 -->
              <div class="col-6 col-lg-12 button-item-list">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5.89968 11.2166L7.99968 9.94997L10.0997 11.2333L9.54969 8.8333L11.3997 7.2333L8.96635 7.01663L7.99968 4.74997L7.03302 6.99997L4.59968 7.21663L6.44968 8.8333L5.89968 11.2166ZM7.99968 11.5166L5.23302 13.1833C5.1108 13.2611 4.98302 13.2944 4.84968 13.2833C4.71635 13.2722 4.59968 13.2277 4.49968 13.15C4.39968 13.0722 4.32191 12.975 4.26635 12.8583C4.2108 12.7416 4.19968 12.6111 4.23302 12.4666L4.96635 9.31663L2.51635 7.19997C2.40524 7.09997 2.3358 6.98608 2.30802 6.8583C2.28024 6.73052 2.28857 6.60552 2.33302 6.4833C2.37746 6.36108 2.44413 6.26108 2.53302 6.1833C2.62191 6.10552 2.74413 6.05552 2.89968 6.0333L6.13302 5.74997L7.38302 2.7833C7.43857 2.64997 7.52468 2.54997 7.64135 2.4833C7.75802 2.41663 7.87746 2.3833 7.99968 2.3833C8.12191 2.3833 8.24135 2.41663 8.35802 2.4833C8.47469 2.54997 8.5608 2.64997 8.61635 2.7833L9.86635 5.74997L13.0997 6.0333C13.2552 6.05552 13.3775 6.10552 13.4664 6.1833C13.5552 6.26108 13.6219 6.36108 13.6664 6.4833C13.7108 6.60552 13.7191 6.73052 13.6914 6.8583C13.6636 6.98608 13.5941 7.09997 13.483 7.19997L11.033 9.31663L11.7664 12.4666C11.7997 12.6111 11.7886 12.7416 11.733 12.8583C11.6775 12.975 11.5997 13.0722 11.4997 13.15C11.3997 13.2277 11.283 13.2722 11.1497 13.2833C11.0164 13.2944 10.8886 13.2611 10.7664 13.1833L7.99968 11.5166Z" fill="#2196F3"/>
                </svg>

                <a class="btn btn-success px-0" href="{SITEURL}/funcs.php?name=user&amp;file=items_list&amp;op=distinction&amp;id={i.ID}">{_LANG_186}</a>
              </div>
              <!-- ENDIF -->

              <!-- IF ITEMS_BIDS -->
              <div class="col-6 col-lg-12 button-item-list">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M5.89968 11.2166L7.99968 9.94997L10.0997 11.2333L9.54969 8.8333L11.3997 7.2333L8.96635 7.01663L7.99968 4.74997L7.03302 6.99997L4.59968 7.21663L6.44968 8.8333L5.89968 11.2166ZM7.99968 11.5166L5.23302 13.1833C5.1108 13.2611 4.98302 13.2944 4.84968 13.2833C4.71635 13.2722 4.59968 13.2277 4.49968 13.15C4.39968 13.0722 4.32191 12.975 4.26635 12.8583C4.2108 12.7416 4.19968 12.6111 4.23302 12.4666L4.96635 9.31663L2.51635 7.19997C2.40524 7.09997 2.3358 6.98608 2.30802 6.8583C2.28024 6.73052 2.28857 6.60552 2.33302 6.4833C2.37746 6.36108 2.44413 6.26108 2.53302 6.1833C2.62191 6.10552 2.74413 6.05552 2.89968 6.0333L6.13302 5.74997L7.38302 2.7833C7.43857 2.64997 7.52468 2.54997 7.64135 2.4833C7.75802 2.41663 7.87746 2.3833 7.99968 2.3833C8.12191 2.3833 8.24135 2.41663 8.35802 2.4833C8.47469 2.54997 8.5608 2.64997 8.61635 2.7833L9.86635 5.74997L13.0997 6.0333C13.2552 6.05552 13.3775 6.10552 13.4664 6.1833C13.5552 6.26108 13.6219 6.36108 13.6664 6.4833C13.7108 6.60552 13.7191 6.73052 13.6914 6.8583C13.6636 6.98608 13.5941 7.09997 13.483 7.19997L11.033 9.31663L11.7664 12.4666C11.7997 12.6111 11.7886 12.7416 11.733 12.8583C11.6775 12.975 11.5997 13.0722 11.4997 13.15C11.3997 13.2277 11.283 13.2722 11.1497 13.2833C11.0164 13.2944 10.8886 13.2611 10.7664 13.1833L7.99968 11.5166Z" fill="#2196F3"/>
                </svg>

                <a class="btn btn-info px-0 col-6 col-lg-12 blue" href="{SITEURL}/funcs.php?name=user&amp;file=items_list&amp;op=bids&amp;id={i.ID}">{_LANG_187}</a>
              </div>
              <!-- ENDIF -->

              <!-- ENDIF -->
              <div class="col-6 col-lg-12 button-item-list">
                <a class="btn btn-outline-danger ogloszenia" href="{SITEURL}/funcs.php?name=user&amp;file=items_list&amp;op=delete&amp;id={i.ID}" onclick="return confirm('Jesteś pewien, że chcesz usunąć ogłoszenie?');">{_LANG_182}</a>
              </div>
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