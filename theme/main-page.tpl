<!-- INCLUDE theme_header.tpl -->

<!-- IF ADV_1 --><div class="adv-show">{ADV_1}</div><!-- ENDIF -->

</main>

<div class="main-page mp-banner pt-5">
  <!-- IF .sm -->
  <div class="d-block main-banner mb-5">
    <div id="carouselMain" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <!-- BEGIN sm -->
        <div class="carousel-item<!-- IF sm.NO == 1 --> active<!-- ENDIF -->">
          <!-- IF sm.ADRES --><a target="_blank" href="{sm.ADRES}"><!-- ENDIF --><img class="w-100" src="{sm.OBRAZ}" /><!-- IF sm.ADRES --></a><!-- ENDIF -->
        </div>
        <!-- END sm -->
      </div>
    </div>
  </div>
  <!-- ENDIF -->
  <div class="container search-main py-xl-4 mt-xl-4 py-0 my-0">
    <div class="pt-md-5 pb-0 mt-md-5 my-0">
      <div class="pt-lg-5 mt-0 mt-lg-5 mb-0 search-offer shadow">
        <div class="row">
          <div class="col-xl-8 col-12 text-center mx-auto">
            <h1 class="font-weight-bold" style="color:black;">Medtalento - portal rekrutacyjny dla branży medycznej </h1>
            <p class="my-4 h4">Odkryj najlepsze ofery pracy w branży transportowej</p>
          </div>
        </div>
        <!-- IF MAIN-PAGE -->
        <form method="get" action="funcs.php" class="search-bar p-lg-4 p-2">
          <input type="hidden" name="name" value="items" />
          <input type="hidden" name="file" value="list" />
          <div class="query-input">
            <div class="row">
              <div class="col-lg-4 col-12 my-auto ml-auto">
                <div class="input-group mb-2 mb-lg-0 border bg-white p-1" style="border-radius: 16px">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-0"><i class="fas fa-lg fa-search"></i></span>
                  </div>
                  <input class="form-control border-0 p-4 p-lg-3" type="text" name="string" value="{STRING}" placeholder="{_LANG_160}" />
                </div>
              </div>
              <div class="col-lg-4 col-12 my-auto">
                <div class="input-group mb-4 mb-lg-0 border bg-white p-1" style="border-radius: 16px">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-0"><i class="fas fa-lg fa-map-marker-alt"></i></span>
                  </div>
                  <input class="form-control border-0 p-4 p-lg-3" type="text" name="city" value="{CITY}" placeholder="Miasto lub kod pocztowy" />
                </div>
              </div>
              <div class="col-12 col-lg-4 my-auto d-flex">
                <!--col-auto my-auto mr-auto d-flex-->
                <button type="submit" name="search-button" value="1" class="btn btn-primary h-100 w-100" style="border-radius: 16px">Znajdź oferty pracy</button>
              </div>
            </div>
          </div>
      </div>
      <input type="hidden" name="search" value="1" />
      </form>
      <!-- ENDIF -->
    </div>
  </div>
</div>

<section class="space-content space-x" style="margin-top: 12rem">
  <div class="d-flex flex-column flex-md-row position-relative align-items-center py-5 mx-lg-5">
    <div class="order-1 order-md-0 img-card-content card-content card left shadow">
      <h4 class="h5 font-weight-bold">Rekrutujesz i poszukujesz kandydatów do pracy?</h4>
      <p class="recruitment-text my-4 my-sm-2 my-lg-4 font-weight-medium">
        Zarejestruj się, aby publikować oferty pracy dla kierowców zawodowych. Dodaj ogłoszenie z opcją publikacji na 30, 60 lub 90 dni i przyciągnij najlepsze talenty do swojego zespołu!
      </p>
      <a class="btn btn-primary mt-3 text-white w-100" href="{SITEURL}/funcs.php?name=items&amp;file=add&amp;new=1" role="button">Dodaj nową ofertę pracy</a>
    </div>
    <div class="order-0 order-md-1 img-card-content right shadow">
      <img class="card-img" style="min-height: 280px"src="{SITEURL}/theme/img/poziom.png" alt="tirjobs recruitment image">
    </div>
  </div>
</section>

<section class="container-fluid py-5 my-5 space-x">
  <h2 class="text-center mt-0 mb-3 font-weight-bold">{_LANG_590}</h2>
  <p class="text-center">Szeroki wybór kategorii pracy dla każdego specjalisty medycznego!</p>
    <div class="mp-cats-list row">
      <!-- BEGIN c -->
      <a href="{c.LINK}" class="col-md-4 col-12 my-3">
        <div class="p-3 shadow">
          <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1" style="font-size:18px; font-weight:500;">{c.NAME}</h5>
          </div>
          <small>({c.COUNTER} ofert pracy)</small>
        </div>
      </a>
      <!-- END c -->
    </div>
    <p class="text-center mb-0 mt-5"><a class="btn btn-primary" href="{SITEURL}/funcs.php?name=items&amp;file=list">Zobacz wszystkie</a></p>
  </div>
</section>



<section class="space-content space-x">
  <div class="d-flex flex-column flex-md-row position-relative align-items-center py-5 mx-lg-5">
    <div class="order-1 order-md-0 img-card-content left shadow">
      <img class="card-img" style="min-height: 280px" src="{SITEURL}/theme/img/mainpage-medtalento-2.png" alt="tirjobs recruitment image">
    </div>
    <div class="order-0 order-md-1 img-card-content card-content card right shadow">
      <h4 class="h5 font-weight-bold">Szukasz pracy w służbie zdrowia i farmacji?</h4>
      <p class="recruitment-text my-4 my-sm-2 my-lg-4 font-weight-medium">
        Znajdź swoją wymarzoną pracę przeglądając setki ogłoszeń. Aplikuj, dziel się swoim CV i daj się znaleźć pracodawcom. Wszystko to za darmo, na zawsze, dla każdego!
      </p>
      <a class="btn btn-primary mt-3 text-white w-100"href="{SITEURL}/funcs.php?name=items&amp;file=list" role="button">Przeglądaj oferty pracy</a>
    </div>
  </div>
</section>

<!-- IF .s -->
<div class="d-lg-block d-none main-banner py-5 my-5 space-x">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <!-- BEGIN s -->
        <div class="carousel-item<!-- IF s.NO == 1 --> active<!-- ENDIF -->">
          <!-- IF s.ADRES --><a target="_blank" href="{s.ADRES}" style="width:100%"><!-- ENDIF --><img class="mw-100" src="{s.OBRAZ}" /><!-- IF s.ADRES --></a><!-- ENDIF -->
        </div>
        <!-- END s -->
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">{_LANG_124}</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">{_LANG_125}</span>
      </a>
    </div>
</div>
<!-- ENDIF -->

<!-- IF ADV_5 --><div class="adv-show">{ADV_5}</div><!-- ENDIF -->

<div class="container-fluid my-5 py-5 space-x">
  <section class="promo-ads">
    <h1 class="mt-5 mb-3 font-weight-bold text-center">{_LANG_566}</h1>
    <p class="text-center">Znajdziesz tu najświeższe oferty pracy w branży medycznej, aktualizowane na bieżąco!</p>
    <div class="pt-0">
      <!-- INCLUDE tpl_items_list.tpl -->
    </div>
    <p class="text-center mb-0 mt-5"><a class="btn btn-primary-light border font-weight-bold" href="{SITEURL}/funcs.php?name=items&amp;file=list">Zobacz wszystkie oferty</a></p>
  </section>
  <!--<p class="text-center mt-5"><a class="btn btn-main" href="wszystie-category-0.html">Więcej ogłoszeń</a></p>-->
</div>

<main class="container">
  <section class="my-5 py-5">
    <h1 class="mb-3 font-weight-bold text-center">Jak To Działa?</h1>
    <p class="text-center">Prosto i skutecznie rekrutuj lub znajdź pracę w branży transportowej!</p>
    <div class="row">
      <div class="col-lg-10 col-12 mx-auto">
        <div class="row text-center font-weight-bold mt-5">
          <div class="col">
            <img style="border: 2px solid #CCC; border-radius: .8em;" src="{SITEURL}/theme/img/icon_1.png">
            <p class="mt-4">Zarejestruj się na tirjob.pl ustalając login i hasło</p>
          </div>
          <div class="col">
            <img style="border: 2px solid #CCC; border-radius: .8em;" src="{SITEURL}/theme/img/icon_2.png">
            <p class="mt-4">Jako kandydat szukający pracy, aplikuj na ogłoszenia</p>
          </div>
          <div class="col">
            <img style="border: 2px solid #CCC; border-radius: .8em;" src="{SITEURL}/theme/img/icon_3.png">
            <p class="mt-4">Jako rekruter konfiguruj i publikuj dowolne oferty pracy</p>
          </div>
          <div class="col">
            <img style="border: 2px solid #CCC; border-radius: .8em;" src="{SITEURL}/theme/img/icon_4.png">
            <p class="mt-4">To wszystko! Zacznij korzystać z nowoczesnej rekrutacji</p>
          </div>
        </div>
      </div>
  </section>
</main>

<section class="container-fluid container-md my-5 py-5 px-3 px-lg-5">
  <h2 class="mb-5 font-weight-bold text-center">Pakiety Cenowe</h2>
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

  <div class="my-5">
    <!-- INCLUDE tpl_user_members_list.tpl -->
  </div>

  <div>
    <h2 class="font-weight-bold text-center">
      Dodatkowe Usługi Reklamy i Promowania Ogłoszeń
    </h2>
    <p class="text-center">
      Skutecznie promuj swoje ogłoszenia z naszym wsparciem!
    </p>
    <div class="row">
      <div class="col-12 mx-auto p-4">
        <div class="row p-2 nav-package-price ">
          <div class="col-auto ml-auto">
            <button value="ad-campaign" class="btn btn-primary py-1 px-3 rounded-pill toggle-services" style="border-radius: 2.5em;">Kampanie reklamowe</button>
          </div>
          <div class="col-auto">
            <button value="limited-promotion" class="btn py-1 px-3 rounded-pill toggle-services" style="border-radius: 2.5em;">Organiczna Promocja</button>
          </div>
          <div class="col-auto">
            <button value="email-marketing" class="btn py-1 px-3 rounded-pill toggle-services" style="border-radius: 2.5em;">Email Marketing</button>
          </div>
          <div class="col-auto mr-auto">
            <button value="post-industry" class="btn py-1 px-3 rounded-pill toggle-services" style="border-radius: 2.5em;">Post w grupie branżowej</button>
          </div>
        </div>
        <div>
          <!-- INCLUDE tpl_additional_services.tpl -->
        </div>
      </div>
    </div>
  </div>

  <div class="my-5">
    <h2 class="font-weight-bold text-center">
      Top 30 pracodawców
    </h2>
    <p class="text-center">
      Odkryj najlepszych pracodawców, którzy tworzą wyjątkowe miejsca pracy!
    </p>
    <div class="companies-grid">

      <!-- BEGIN p -->
      <div>
        <div class="d-flex flex-column align-items-center rounded shadow" style="height: 100%">
          <img class="companies-img" src="{p.PHOTO}">
          <div class="companies-card-content">
            <h5 class="mt-2 mb-4 font-weight-bold">{p.COMPANY_NAME}</h5>
            <div class="d-flex align-items-end">
              <a href="{p.HREF}" class="btn btn-primary px-4 py-2">Dowiedź się więcej</a>
            </div>
          </div>
        </div>
      </div>
      <!-- END p -->
    </div>
    <p class="text-center mb-0 mt-5"><a class="btn btn-primary-light" href="{SITEURL}/firmy.html">Zobacz pełna listę</a></p>
  </div>

  <div class="my-5">
    <h2 class="font-weight-bold text-center">
      Nasze Media Społecznościowe
    </h2>
    <p class="font-weight-bold text-center">
      Śledź nas i bądź częścią społeczności!
    </p>
    <div class="row my-5 grid-socials">
      <div class="mb-5 mb-md-0">
        <div class="rounded-lg shadow p-3 p-lg-5">
          <div class="d-flex flex-column flex-sm-row">
            <div class="d-flex flex-column mr-sm-5 mb-4 mb-sm-0 align-items-center socials-img">
              <svg class="w-100 h-100" width="242" height="242" viewBox="0 0 242 242" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M141.083 136.376H166.187L176.229 96.2095H141.083V76.1261C141.083 65.7832 141.083 56.0428 161.167 56.0428H176.229V22.3028C172.956 21.871 160.594 20.897 147.54 20.897C120.277 20.897 100.917 37.536 100.917 68.0928V96.2095H70.7916V136.376H100.917V221.73H141.083V136.376Z" fill="#1877F2"/>
              </svg>
            </div>
            <div class="d-flex flex-column">
              <div>
                <h3>Zostań naszym fanem na Facebooku</h3>
              </div>
              <div class="mb-3">
                Zaprasza grupa:"Lekarze i Pielęgniarki - Oferty Pracy, Polska i Zagranica", dołącz, aby nawiązać cenne kontakty,
                uzyskać wsparcie od kolegów z branży i być na bieżąco  z możliwościami rozwoju zawodowego. Grupa to społeczność zawodowa,
                która dzieli się wiedzą i doświadczeniem.
              </div>
              <div>
                <a href="#" class="btn btn-primary btn-social-media">Dołącz do grupy na Facebook</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="">
        <div class="rounded-lg shadow p-3 p-lg-5">
          <div class="d-flex flex-column flex-sm-row">
            <div class="d-flex flex-column order-1 order-sm-0">
              <div>
                <h3>Odwiedź naszą stronę na LinkedIn</h3>
              </div>
              <div class="mb-3">
                Zapraszamy na stronę firmową Medtalento na LinkedIn! Odkryj możliwości rozwoju zawodowego i najnowsze oferty pracy
                w branży medycznej.To idealne miejsce dla specjalistów medycznych oraz rekruterów, żeby nawiązywać kontakty zawodowe
                i aplikować o pracę.
              </div>
              <div>
                <a href="#" class="btn btn-primary btn-social-media">Dołącz do strony na Linkedin</a>
              </div>
            </div>
            <div class="d-flex flex-column ml-sm-5 mb-4 mb-sm-0 align-items-center socials-img order-0 order-sm-1">
              <svg class="img-socials" width="192" height="182" viewBox="0 0 192 182" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M40.1935 21.0221C40.1909 26.3485 38.0724 31.4557 34.3042 35.2202C30.5359 38.9847 25.4266 41.098 20.1002 41.0954C14.7737 41.0927 9.6665 38.9742 5.90203 35.206C2.13756 31.4378 0.0241948 26.3284 0.026858 21.002C0.0295212 15.6756 2.14799 10.5684 5.91623 6.80388C9.68447 3.03941 14.7938 0.92605 20.1202 0.928713C25.4467 0.931377 30.5539 3.04985 34.3184 6.81809C38.0828 10.5863 40.1962 15.6957 40.1935 21.0221ZM40.796 55.9671H0.629357V181.689H40.796V55.9671ZM104.259 55.9671H64.2935V181.689H103.858V115.715C103.858 78.9625 151.756 75.5483 151.756 115.715V181.689H191.421V102.058C191.421 40.1012 120.527 42.4108 103.858 72.8371L104.259 55.9671Z" fill="#0A66C2"/>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- IF ADV_4 --><div class="adv-show">{ADV_4}</div><!-- ENDIF -->

<main class="container main-container">
  <section class="news card-deck">
    <h2 class="text-center w-100">Najnowsze artykuły</h2>
    <p class="text-center mt-2 mb-5" style="opacity:0.7;">
      Kilka razy w tygodniu publikowane są treści związane z nowymi trendami w rekrutacji zawodów medycznych, zasadami budowania marki osobistej i poradami rekrutacyjnymi dla osób pracujących w sektorze służby zdrowia.
    </p>
    <!-- INCLUDE tpl_news_list.tpl -->
  </section>
  <p class="text-center mb-0 mt-5"><a class="btn btn-primary" href="{SITEURL}/funcs.php?name=news">Odkryj więcej</a></p>
</main>

<!-- INCLUDE theme_footer.tpl -->
