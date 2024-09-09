<!-- INCLUDE tpl_head.tpl -->
<header class="main-header py-3 px-lg-4 px-0 bg-white shadow position-sticky" style="top:0;">
  <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg navbar-main px-2">
      <div class="ml-2 mr-lg-1 mr-xl-5">
        <a href="{SITEURL}">
          <img src="{SITEURL}/theme/img/logo-medtalento.png" alt="medtalento logo"/>
        </a>
      </div>
      <button class="navbar-toggler px-3 py-2 mr-2" type="button" data-toggle="collapse" data-target="#navbar-main"
              aria-controls="navbar-main" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse justify-content-lg-end" id="navbar-main">
        <ul class="navbar-nav form-inline my-2 my-md-0">
          <li class="nav-item mt-lg-2 mx-lg-0 mx-xl-2">
            <a class=" nav-link<!-- IF FUNC_NAME == '' --> on<!-- ENDIF -->" href="{SITEURL}">{_LANG_488}</a>
          </li>
          <li class="nav-item mt-lg-2 mx-lg-0 mx-xl-2">
            <a class="nav-link<!-- IF FUNC_NAME == 'items' && TYPE == '' --> on<!-- ENDIF -->"
               href="{SITEURL}/funcs.php?name=items&amp;file=list">{_LANG_546}</a>
          </li>
          <!-- IF MODULE_COMPANIES -->
          <li class="nav-item mt-lg-2 mx-lg-0 mx-xl-2">
            <a class="nav-link<!-- IF FUNC_NAME == 'items' && TYPE == 'c' --> on<!-- ENDIF -->"
               href="{SITEURL}/funcs.php?name=items&amp;file=list&amp;id=0&amp;type=companies">{_LANG_510}</a>
          </li>
          <!-- ENDIF -->
          <li class="nav-item mt-lg-2 mx-lg-0 mx-xl-2">
            <a class=" nav-link<!-- IF FUNC_NAME == 'price' --> on<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=price">Cennik</a>
          </li>
          <li class="nav-item mt-lg-2 mx-lg-0 mx-xl-2">
            <a class="nav-link<!-- IF FUNC_NAME == 'news' --> on<!-- ENDIF -->" href="{SITEURL}/funcs.php?name=news">{_LANG_130}</a>
          </li>
          <!-- BEGIN ch -->
          <li class="nav-item mt-lg-2 mx-lg-0 mx-xl-2">
            <a class="nav-link" href="{ch.HREF}">{ch.NAME}</a>
          </li>
          <!-- END ch -->

          <li class="nav-item my-2 my-lg-0 mobile-w-lg-100 pr-3 pr-lg-0">
            <a href="{SITEURL}/funcs.php?name=user" class="btn btn-primary-light  mx-0 mx-xl-2 px-2 px-lg-0 px-xl-3 w-100"><!-- IF IS_USER -->Moje
              konto<!-- ELSE --> Zaloguj / Zarejestruj<!-- ENDIF --></a>
          </li>

          <li class="nav-item my-2 my-lg-0 mobile-w-lg-100 pr-3 pr-lg-0">
            <a href="{SITEURL}/funcs.php?name=items&amp;file=add&amp;new=1" class="btn btn-primary mx-0 mx-xl-2 px-2 px-lg-0 px-xl-3 w-100 ">Dodaj
              ogłoszenie</a>
          </li>

          <li class="nav-item my-2 my-lg-0 mobile-w-lg-100 pr-3 pr-lg-0">
            <!-- IF IS_USER --><a href="{SITEURL}/funcs.php?name=user&amp;op=logout"
                                  class="btn btn-primary-light mx-lg-2 mx-0 px-lg-3 px-2 w-100">Wyloguj</a><!-- ENDIF -->
          </li>
        </ul>
      </div>
    </nav>
  </div>
</header>

<main class="container main-container">
  <!-- IF INFO -->
  <div class="alert alert-info">{INFO}</div>
  <!-- ENDIF -->
  <!-- IF ERROR -->
  <div class="alert alert-danger">{ERROR}</div>
  <!-- ENDIF -->
