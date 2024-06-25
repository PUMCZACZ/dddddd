<!-- INCLUDE theme_header.tpl -->

<!-- IF ADV_1 --><div class="adv-show">{ADV_1}</div><!-- ENDIF -->

</main>

<div class="main-page mp-banner py-5 mb-5">
  <!-- IF .sm -->
  <div class="d-block main-banner">
      <div id="carouselMain" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <!-- BEGIN sm -->
          <div class="carousel-item<!-- IF sm.NO == 1 --> active<!-- ENDIF -->">
            <!-- IF sm.ADRES --><a target="_blank" href="{sm.ADRES}"><!-- ENDIF --><img src="{sm.OBRAZ}" /><!-- IF sm.ADRES --></a><!-- ENDIF -->
          </div>
          <!-- END sm -->
        </div>
      </div>
  </div>
  <!-- ENDIF -->
  <div class="container py-xl-4 my-xl-4 py-0 my-0">
    <div class="pb-xl-5 pb-0 my-xl-5 my-0">
      <div class="pt-0 pb-xl-5 pb-0 mt-0 mb-xl-5 mb-0">
        <h1 class="font-weight-bold">Wyszukiwarka</h1>
        <p class="text-white my-4">Jakiego stanowiska szukasz?</p>
        <!-- IF MAIN-PAGE -->
        <form method="get" action="funcs.php" class="search-bar bg-white rounded p-lg-4 p-2">
          <input type="hidden" name="name" value="items" />
          <input type="hidden" name="file" value="list" />
            <div class="query-input">
              <div class="row">
                <div class="col-lg col-12 my-auto">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-white border-0"><i class="fas fa-lg fa-search"></i></span>
                    </div>
                    <input class="form-control border-0" type="text" name="string" value="{STRING}" placeholder="{_LANG_160}" />
                  </div>
                </div>
                <div class="col-lg col-12 my-auto">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text bg-white border-0"><i class="fas fa-lg fa-map-marker-alt"></i></span>
                    </div>
                    <input class="form-control border-0" type="text" name="city" value="{CITY}" placeholder="Miasto lub kod pocztowy" />
                  </div>
                </div>
                <div class="col-lg-3 col-12 my-auto">
                  <button type="submit" name="search-button" value="1" class="btn btn-primary btn-block py-lg-3 py-1">{_LANG_119}</button>
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
</div>

<div class="container py-5 my-5">

  <div id="carouselExampleControls" class="carousel carousel-mp-logos slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="row">
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="row">
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
          <div class="col my-auto">
            <img class="mw-100" decoding="async" src="{SITEURL}/theme/img/blank.gif" alt="Image">
          </div>
        </div>
      </div>
    </div>
   <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </button>
  </div>
</div>

<section class="container-fluid border-top py-5 my-5">
  <div class="row pt-5">
    <div class="col-lg-5 col-12 my-auto ml-auto">
      <img class="mw-100 rounded-lg" src="{SITEURL}/theme/img/mp-box-1.jpg">
    </div>
    <div class="col my-auto mr-auto">
      <h2 class="">Rekrutujesz i poszukujesz kandydatów do pracy?</h2>
      <p class="my-4" style="opacity:0.7;">
        Kliknij niebieski link poniżej, a z łatwością założysz konto dla firmy, którą reprezentujesz. Następnie zaczniesz publikować oferty pracy i dowolnie je konfigurować. Niebawem na Twoją skrzynkę mailową zaczną napływać pierwsze CV od medycznych zawodowców, którzy zareagują na Twoje ogłoszenia.
      </p>
      <a class="btn btn-primary mt-3 text-white" href="{SITEURL}/funcs.php?name=items&amp;file=add&amp;new=1" role="button">Dodaj nową ofertę pracy</a>
    </div>
  </div>
</section>

<section class="container-fluid py-5 my-5">
  <h2 class="text-center mt-0 mb-3 font-weight-bold">{_LANG_590}</h2>
  <p class="text-center">Szeroki wybór kategorii pracy dla każdego specjalisty medycznego!</p>
    <div class="mp-cats-list row">
      <!-- BEGIN c -->
      <a href="{c.LINK}" class="col-md-4 col-12 my-3">
        <div class="border rounded p-3">
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

<section class="container-fluid py-5 my-5">
  <div class="row">
    <div class="col-lg-6 col-12 ml-auto my-auto">
      <h2 class="elementor-heading-title elementor-size-default">Szukasz pracy w służbie zdrowia i farmacji?</h2>
      <p class="my-4" style="opacity:0.7;">
        Znajdź swoją wymarzoną pracę przeglądając setki ogłoszeń. Aplikuj, dziel się swoim CV i daj się znaleźć pracodawcom. Wszystko to za darmo, na zawsze, dla każdego!
      </p>
      <a class="btn btn-primary mt-3 text-white" href="{SITEURL}/funcs.php?name=items&amp;file=list" role="button">Przeglądaj oferty pracy</a>
    </div>
    <div class="col-lg-4 col-12 mr-auto my-lg-auto mt-3">
      <img class="mw-100 rounded-lg" decoding="async" src="{SITEURL}/uploads/2022/06/photodune-UnnJiWrW-medical-staff-xxl-1024x694.jpg">
    </div>
  </div>
</section>

<!-- IF .s -->
<div class="d-lg-block d-none main-banner py-5 my-5">
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

<div class="container-fluid border-top my-5 py-5">
  <section class="promo-ads">
    <h2 class="mt-5 mb-3 font-weight-bold text-center">{_LANG_566}</h2>
    <p class="text-center">Znajdziesz tu najświeższe oferty pracy w branży medycznej, aktualizowane na bieżąco!</p>
    <div class="pt-0">
      <!-- INCLUDE tpl_items_list.tpl -->
    </div>
    <p class="text-center mb-0 mt-5"><a class="btn btn-primary" href="{SITEURL}/funcs.php?name=items&amp;file=list">Zobacz pełną listę</a></p>
  </section>
  <!--<p class="text-center mt-5"><a class="btn btn-main" href="wszystie-category-0.html">Więcej ogłoszeń</a></p>-->
</div>

<!--
<div class="container-fluid bg-light py-5 my-5">
  <div class="py-5">
    <h2 class="mb-3 font-weight-bold text-center">Opinie</h2>
    <p class="text-center mb-3">Przekonaj się, dlaczego rekruterzy i pracownicy medyczni polecają medtalento.pl!</p>
    <div class="slick-carousel">
      <div class="mx-lg-4 mx-2">
        <div class="bg-white rounded p-lg-4 p-2">
          <div class="p-lg-4 p-2">
            <div class="my-4" style="font-size:0.9em;">
              "Medtalento.pl to nieocenione narzędzie dla lekarzy, którzy poszukują pracy lub chcą rozwijać swoją karierę w medycynie. Znajduję na portalu wiele interesujących ofert, a funkcja filtrowania pozwala mi dopasować je do moich preferencji. Dodatkowo, istnieje możliwość aplikowania swoim CV. Medtalento.pl to efektywne narzędzie, które polecam każdemu lekarzowi w poszukiwaniu nowych możliwości zawodowych."
            </div>
            <div class="row mt-5">
              <div class="col">
                <h3 class="h5 mb-0">Dr. Piotr S.</h3>
                <div class="text-muted">Lekarz specjalista</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mx-lg-4 mx-2">
        <div class="bg-white rounded p-lg-4 p-2">
          <div class="p-lg-4 p-2">
            <div class="my-4" style="font-size:0.9em;">
              „Medtalento.pl to strona, której nie może zabraknąć w zestawie narzędzi każdego rekrutera w branży medycznej. Portal oferuje szeroki wybór funkcji i opcji, które ułatwiają przeglądanie i selekcję kandydatów. System powiadomień o nowych zgłoszeniach i elastyczne pakiety ogłoszeniowe pozwalają na skuteczną promocję ofert pracy. Jestem bardzo zadowolona z efektywności i profesjonalizmu tego portalu."
            </div>
            <div class="row mt-5">
              <div class="col">
                <h3 class="h5 mb-0">Marta S.</h3>
                <div class="text-muted">Recruitment Specialist</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mx-lg-4 mx-2">
        <div class="bg-white rounded p-lg-4 p-2">
          <div class="p-lg-4 p-2">
            <div class="my-4" style="font-size:0.9em;">
              "Jako lekarz poszukujący nowych wyzwań zawodowych, medtalento.pl okazał się nieocenionym narzędziem. Portal oferuje szeroki wybór ofert pracy dla różnych specjalizacji, co daje mi możliwość znalezienia idealnego miejsca dla siebie. Interfejs strony jest intuicyjny i łatwy w obsłudze, a personalizowane powiadomienia o nowych ofertach pozwoliły mi być na bieżąco. Jestem wdzięczny za tę platformę i polecam ją wszystkim lekarzom w poszukiwaniu pracy."
            </div>
            <div class="row mt-5">
              <div class="col">
                <h3 class="h5 mb-0">Dr. Anna M.</h3>
                <div class="text-muted">Lekarz rodzinny</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mx-lg-4 mx-2">
        <div class="bg-white rounded p-lg-4 p-2">
          <div class="p-lg-4 p-2">
            <div class="my-4" style="font-size:0.9em;">
              „Jako rekruter w branży medycznej, medtalento.pl jest dla mnie niezastąpionym narzędziem. Bogata baza kandydatów, łatwa w obsłudze platforma i skuteczne narzędzia pozwalają mi szybko i sprawnie znaleźć odpowiednich specjalistów. Dodatkowo, opcje promowania ofert pracy przyczyniły się do zwiększenia zainteresowania kandydatów. To wspaniałe narzędzie, które zdecydowanie ułatwia proces rekrutacji!"
            </div>
            <div class="row mt-5">
              <div class="col">
                <h3 class="h5 mb-0">Jan K.</h3>
                <div class="text-muted">HR Manager</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mx-lg-4 mx-2">
        <div class="bg-white rounded p-lg-4 p-2">
          <div class="p-lg-4 p-2">
            <div class="my-4" style="font-size:0.9em;">
              "Medtalento.pl to mój najlepszy towarzysz w poszukiwaniu pracy w sektorze medycznym. Możliwość otrzymywania powiadomień o nowych ofertach pracy sprawia, że jestem zawsze na bieżąco. Dodatkowo, interfejs strony jest przyjazny i intuicyjny, co ułatwia poruszanie się po portalu. Dzięki medtalento.pl, znalazłem wymarzoną pracę, która jest idealnym dopasowaniem do moich umiejętności i zainteresowań. Serdecznie polecam!"
            </div>
            <div class="row mt-5">
              <div class="col">
                <h3 class="h5 mb-0">Michał D.</h3>
                <div class="text-muted">Farmaceuta</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mx-lg-4 mx-2">
        <div class="bg-white rounded p-lg-4 p-2">
          <div class="p-lg-4 p-2">
            <div class="my-4" style="font-size:0.9em;">
              „Medtalento.pl jest nieocenionym partnerem w naszych poszukiwaniach pracowników medycznych. Dzięki tej platformie mieliśmy możliwość dotarcia do szerokiego grona specjalistów, którzy pasowali do naszych wymagań. Prosta i intuicyjna obsługa portalu oraz wsparcie ze strony zespołu medtalento.pl sprawiły, że rekrutacja stała się o wiele łatwiejsza i efektywniejsza. Bardzo polecamy!"
            </div>
            <div class="row mt-5">
              <div class="col">
                <h3 class="h5 mb-0">Michał K.</h3>
                <div class="text-muted">Dyrektor Personalny</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mx-lg-4 mx-2">
        <div class="bg-white rounded p-lg-4 p-2">
          <div class="p-lg-4 p-2">
            <div class="my-4" style="font-size:0.9em;">
              "Medtalento.pl to niezastąpione narzędzie dla poszukujących pracy w branży medycznej. Codziennie przeglądam nowe oferty i mam dostęp do szerokiej bazy pracodawców. Funkcja wyszukiwania pozwala mi precyzyjnie dopasować oferty do moich preferencji i umiejętności. Dzięki temu portalowi, znalezienie pracy w swojej dziedzinie stało się łatwiejsze i bardziej efektywne. Jestem bardzo zadowolona z medtalento.pl i polecam go wszystkim znajomym!"
            </div>
            <div class="row mt-5">
              <div class="col">
                <h3 class="h5 mb-0">Katarzyna S.</h3>
                <div class="text-muted">Pielęgniarka</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mx-lg-4 mx-2">
        <div class="bg-white rounded p-lg-4 p-2">
          <div class="p-lg-4 p-2">
            <div class="my-4" style="font-size:0.9em;">
              „Medtalento.pl to portal, który odmienił naszą rekrutację w branży medycznej. Dzięki bogatej bazie kandydatów i zaawansowanym narzędziom wyszukiwania, możemy szybko i skutecznie znaleźć najlepszych specjalistów. Dodatkowo, możliwość wyróżnienia i promocji ofert pracy przyciąga uwagę kandydatów, co znacznie zwiększa szanse na znalezienie odpowiednich kandydatów. Gorąco polecam medtalento.pl każdemu rekruterowi medycznemu!"
            </div>
            <div class="row mt-5">
              <div class="col">
                <h3 class="h5 mb-0">Anna P.</h3>
                <div class="text-muted">HR Specialist</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mx-lg-4 mx-2">
        <div class="bg-white rounded p-lg-4 p-2">
          <div class="p-lg-4 p-2">
            <div class="my-4" style="font-size:0.9em;">
              "Korzystanie z medtalento.pl było dla mnie pomocne w znalezieniu pracy w branży medycznej. Duża liczba ofert, łatwa nawigacja i personalizowane powiadomienia pozwoliły mi skupić się na idealnej propozycji dla mnie. Dodatkowo, możliwość załączania CV zwiększyło moje szanse na zdobycie wymarzonej posady. Polecam medtalento.pl każdemu, kto szuka pracy w służbie zdrowia!"
            </div>
            <div class="row mt-5">
              <div class="col">
                <h3 class="h5 mb-0">Marta K.</h3>
                <div class="text-muted">Technolog medyczny</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mx-lg-4 mx-2">
        <div class="bg-white rounded p-lg-4 p-2">
          <div class="p-lg-4 p-2">
            <div class="my-4" style="font-size:0.9em;">
              „Medtalento.pl to idealne rozwiązanie dla naszej firmy w poszukiwaniu wykwalifikowanych pracowników medycznych. Intuicyjna platforma, zintegrowane narzędzia rekrutacyjne i szeroka oferta promocji ofert pracy to tylko niektóre z zalet tego portalu. Dzięki medtalento.pl udało nam się dotrzeć do specjalistów, których nie bylibyśmy w stanie znaleźć w inny sposób. To niezawodne i tanie narzędzie, które polecamy każdej firmie medycznej."
            </div>
            <div class="row mt-5">
              <div class="col">
                <h3 class="h5 mb-0">Tomasz B.</h3>
                <div class="text-muted">Dyrektor Zasobów Ludzkich</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mx-lg-4 mx-2">
        <div class="bg-white rounded p-lg-4 p-2">
          <div class="p-lg-4 p-2">
            <div class="my-4" style="font-size:0.9em;">
              „Jestem lekarzem specjalistą i korzystam z medtalento.pl od niedawna. Jednak to wspaniałe narzędzie, które pomaga w znalezieniu nowych możliwości zawodowych. Znajduję na portalu wiele interesujących ofert pracy, które są zgodne z moimi preferencjami i specjalizacją. Jestem bardzo zadowolony z funkcjonalności i użyteczności tego portalu. Gorąco go polecam!"
            </div>
            <div class="row mt-5">
              <div class="col">
                <h3 class="h5 mb-0">Dr. Tomasz K.</h3>
                <div class="text-muted">Lekarz specjalista</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mx-lg-4 mx-2">
        <div class="bg-white rounded p-lg-4 p-2">
          <div class="p-lg-4 p-2">
            <div class="my-4" style="font-size:0.9em;">
              „Medtalento.pl to portal, który znacząco usprawnił nasz proces rekrutacyjny. Szybkość i precyzja wyszukiwania aplikujących kandydatów oraz możliwość filtrowania według różnych parametrów są nieocenione. Ponadto, tanie pakiety ogłoszeniowe i możliwość wyróżnienia ofert pracy pozwalają nam na skuteczne dotarcie do odpowiednich kandydatów. To zdecydowanie najlepsze narzędzie dla rekruterów medycznych!"
            </div>
            <div class="row mt-5">
              <div class="col">
                <h3 class="h5 mb-0">Aleksandra M.</h3>
                <div class="text-muted">Senior Recruiter</div>
              </div>
            </div>
          </div>
        </div>
      </div>
  	</div>
  </div>
</div>
-->

<main class="container">
  <section class="my-5 py-5">
    <h2 class="mb-3 font-weight-bold text-center">Jak To Działa?</h2>
    <p class="text-center">Prosto i skutecznie znajdź pracę w branży medycznej!</p>
    <div class="row text-center font-weight-bold mt-5">
      <div class="col">
        <a class="elementor-icon elementor-animation-" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="currentColor"><g clip-path="url(#clip0_1_9962)"><path d="M8.79037 7.44629C8.42905 7.44629 8.08939 7.58698 7.83334 7.84271C7.306 8.37036 7.3063 9.22882 7.83365 9.75616C8.08939 10.0119 8.42905 10.1526 8.79037 10.1526C9.1517 10.1526 9.49167 10.0119 9.74741 9.75616C10.2747 9.22882 10.2747 8.37036 9.7471 7.84241C9.49136 7.58698 9.1517 7.44629 8.79037 7.44629Z"></path><path d="M34.7598 13.4991L39.9957 0L26.4966 5.2359L20.3235 11.409L8.92334 0.00915531L0 8.9325L11.4001 20.3326L2.97119 28.7616L1.07422 30.6583C0.390015 31.3428 0.0128173 32.2528 0.0128173 33.2208C0.0128173 34.1888 0.390015 35.0986 1.07422 35.7834L4.21234 38.9215C4.91882 39.628 5.84686 39.9811 6.7749 39.9811C7.70294 39.9811 8.63098 39.628 9.33746 38.9215L19.6634 28.5956L31.0675 40L39.9908 31.0767L28.5867 19.6722L34.7598 13.4991ZM9.58771 32.0648L30.4538 11.1987L32.1002 12.8452L11.2341 33.7112L9.58771 32.0648ZM33.3145 10.7462L29.2496 6.68121L35.8905 4.10553L33.3145 10.7462ZM11.4157 17.0349L13.5876 14.863L11.9308 13.2062L9.75891 15.3781L3.3136 8.9325L8.92334 3.32245L18.6667 13.0658L13.0569 18.6758L11.4157 17.0349ZM27.1506 7.89551L28.797 9.54193L7.93121 30.408L6.28448 28.7616L27.1506 7.89551ZM7.68097 37.2647C7.43896 37.5067 7.11731 37.6398 6.7749 37.6398C6.4328 37.6398 6.11115 37.5067 5.86914 37.2647L2.73102 34.1266C2.48932 33.8846 2.35596 33.5629 2.35596 33.2208C2.35596 32.8787 2.48932 32.5568 2.73102 32.3151L4.62799 30.4181L9.57764 35.368L7.68097 37.2647ZM36.6776 31.0767L31.0675 36.6867L27.9318 33.551L30.1038 31.3791L28.447 29.7223L26.2753 31.8942L24.6286 30.2478L26.8005 28.0759L25.1437 26.4191L22.9718 28.591L21.3199 26.9391L26.9299 21.329L36.6776 31.0767Z"></path></g><defs><clipPath><rect width="40" height="40"></rect></clipPath></defs></svg>
        </a>
        <p>Zarejestruj się na medtalento.pl ustalając login i hasło</p>
      </div>
      <div class="col">
        <a class="elementor-icon elementor-animation-" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="currentColor"><path d="M39.4931 33.0976L34.466 29.633C33.6896 29.0979 32.6291 29.6552 32.6291 30.5979V32.8906H25.8208C25.2752 30.1761 22.8728 28.125 20 28.125C17.1272 28.125 14.7248 30.1761 14.1792 32.8906H7.10938V25.8208C9.44492 25.3513 11.2888 23.5074 11.7583 21.1719H28.2416C28.7873 23.8864 31.1896 25.9375 34.0624 25.9375C37.3363 25.9375 39.9999 23.274 39.9999 20C39.9999 17.1272 37.9488 14.7248 35.2343 14.1792V5.9375C35.2343 5.29031 34.7096 4.76562 34.0624 4.76562H25.8208C25.2752 2.05102 22.8728 0 20 0C17.0578 0 14.6098 2.15156 14.1437 4.96367L9.12961 1.50797C8.35305 0.972891 7.29273 1.53031 7.29273 2.47289V4.76562H3.59375C2.94656 4.76562 2.42188 5.29031 2.42188 5.9375C2.42188 6.58469 2.94656 7.10938 3.59375 7.10938H7.29273V9.40211C7.29273 10.352 8.35984 10.8977 9.12961 10.367L14.1437 6.91133C14.6098 9.72344 17.0578 11.875 20 11.875C22.8728 11.875 25.2752 9.82398 25.8208 7.10938H32.8906V14.1792C30.5551 14.6487 28.7112 16.4926 28.2417 18.8281H11.7583C11.2127 16.1135 8.81031 14.0625 5.9375 14.0625C2.66359 14.0625 0 16.726 0 20C0 22.8728 2.05109 25.2752 4.76562 25.8208V34.0625C4.76562 34.7097 5.29031 35.2344 5.9375 35.2344H14.1792C14.7248 37.9489 17.1272 40 20 40C22.8728 40 25.2752 37.9489 25.8208 35.2344H32.6291V37.5271C32.6291 38.477 33.6963 39.0227 34.466 38.492L39.4931 35.0274C40.1673 34.5628 40.1695 33.5637 39.4931 33.0976V33.0976ZM9.63648 7.17125V4.70375L11.4266 5.9375L9.63648 7.17125ZM20 9.53125C18.0184 9.53125 16.4062 7.91906 16.4062 5.9375C16.4062 3.95594 18.0184 2.34375 20 2.34375C21.9816 2.34375 23.5938 3.95594 23.5938 5.9375C23.5938 7.91906 21.9816 9.53125 20 9.53125V9.53125ZM34.0625 16.4062C36.0441 16.4062 37.6562 18.0184 37.6562 20C37.6562 21.9816 36.0441 23.5938 34.0625 23.5938C32.0809 23.5938 30.4688 21.9816 30.4688 20C30.4688 18.0184 32.0809 16.4062 34.0625 16.4062V16.4062ZM2.34375 20C2.34375 18.0184 3.95594 16.4062 5.9375 16.4062C7.91906 16.4062 9.53125 18.0184 9.53125 20C9.53125 21.9816 7.91906 23.5938 5.9375 23.5938C3.95594 23.5938 2.34375 21.9816 2.34375 20V20ZM20 37.6562C18.0184 37.6562 16.4062 36.0441 16.4062 34.0625C16.4062 32.0809 18.0184 30.4688 20 30.4688C21.9816 30.4688 23.5938 32.0809 23.5938 34.0625C23.5938 36.0441 21.9816 37.6562 20 37.6562ZM34.9729 35.2962V32.8288L36.763 34.0625L34.9729 35.2962Z"></path></svg>
        </a>
        <p>Jako kandydat szukający pracy, aplikuj na ogłoszenia</p>
      </div>
      <div class="col">
        <a class="elementor-icon elementor-animation-" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="currentColor"><path d="M38.8281 1.52344H1.17188C0.524687 1.52344 0 2.04812 0 2.69531V31.1328C0 31.78 0.524687 32.3047 1.17188 32.3047H12.9688V36.1328H10.0781C9.43094 36.1328 8.90625 36.6575 8.90625 37.3047C8.90625 37.9519 9.43094 38.4766 10.0781 38.4766H29.9219C30.5691 38.4766 31.0938 37.9519 31.0938 37.3047C31.0938 36.6575 30.5691 36.1328 29.9219 36.1328H27.0312V32.3047H38.8281C39.4753 32.3047 40 31.78 40 31.1328V2.69531C40 2.04812 39.4753 1.52344 38.8281 1.52344ZM37.6562 6.21094H7.03125V3.86719H37.6562V6.21094ZM2.34375 3.86719H4.6875V29.9609H2.34375V3.86719ZM24.6875 36.1328H15.3125V32.3047H24.6875V36.1328ZM7.03125 29.9609V8.55469H37.6562V29.9609H7.03125Z"></path><path d="M25.1562 12.0703C25.1562 11.4231 24.6316 10.8984 23.9844 10.8984H10.625C9.97781 10.8984 9.45312 11.4231 9.45312 12.0703C9.45312 12.7175 9.97781 13.2422 10.625 13.2422H23.9844C24.6316 13.2422 25.1562 12.7176 25.1562 12.0703Z"></path><path d="M20.834 17.9297H24.0235C24.6707 17.9297 25.1954 17.405 25.1954 16.7578C25.1954 16.1106 24.6707 15.5859 24.0235 15.5859H20.834C20.1868 15.5859 19.6621 16.1106 19.6621 16.7578C19.6621 17.405 20.1868 17.9297 20.834 17.9297Z"></path><path d="M32.2656 21.4456C32.2656 20.7984 31.7409 20.2737 31.0938 20.2737H20.8594C20.2122 20.2737 19.6875 20.7984 19.6875 21.4456C19.6875 22.0927 20.2122 22.6174 20.8594 22.6174H31.0938C31.7409 22.6174 32.2656 22.0927 32.2656 21.4456Z"></path><path d="M34.1405 24.9612H29.1523C28.5052 24.9612 27.9805 25.4859 27.9805 26.1331C27.9805 26.7802 28.5052 27.3049 29.1523 27.3049H34.1405C34.7877 27.3049 35.3123 26.7802 35.3123 26.1331C35.3123 25.4859 34.7877 24.9612 34.1405 24.9612Z"></path></svg>
        </a>
        <p>Jako rekruter konfiguruj i publikuj dowolne oferty pracy</p>
      </div>
      <div class="col">
        <a class="elementor-icon elementor-animation-" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="currentColor"><path d="M32.539 23.1259C31.1363 21.51 29.1978 20.4537 27.0798 20.1509L22.2175 19.3884V10.903C22.2175 8.88791 20.578 7.24854 18.563 7.24854H18.5083C16.4933 7.24854 14.8538 8.88791 14.8538 10.903V24.5304L9.82713 22.3761C8.81746 21.9435 7.66656 22.0459 6.7491 22.651C5.83177 23.2558 5.28418 24.2731 5.28418 25.3718V25.4177C5.28418 26.3475 5.68272 27.2353 6.3776 27.8531L14.8539 35.3904V39.0523C14.8539 39.5757 15.2779 39.9997 15.8013 39.9997C16.3246 39.9997 16.7487 39.5757 16.7487 39.0523V34.9651C16.7487 34.6945 16.633 34.4369 16.4307 34.2572L7.63662 26.4373C7.34571 26.1786 7.17897 25.8071 7.17897 25.4178V25.3719C7.17897 24.9052 7.40255 24.49 7.79212 24.2329C8.18207 23.9759 8.65198 23.934 9.08071 24.1178L15.427 26.8377C15.4853 26.8629 15.5467 26.8826 15.6105 26.8956C15.7054 26.9152 15.8011 26.9195 15.8947 26.91C15.9054 26.909 15.9157 26.907 15.9262 26.9056C15.9458 26.9029 15.9655 26.9004 15.9848 26.8966C16.0017 26.8933 16.0183 26.8887 16.0348 26.8845C16.0475 26.8812 16.0601 26.8785 16.0726 26.8748C16.0914 26.8692 16.1097 26.8624 16.1281 26.8556C16.1382 26.8519 16.1485 26.8485 16.1585 26.8444C16.1764 26.8371 16.1939 26.8288 16.2112 26.8204C16.2214 26.8155 16.2319 26.811 16.2419 26.8057C16.2574 26.7974 16.2723 26.7884 16.2874 26.7794C16.2988 26.7724 16.3106 26.7659 16.3218 26.7584C16.3345 26.7501 16.3463 26.741 16.3586 26.7321C16.3715 26.7227 16.3845 26.7136 16.397 26.7035C16.407 26.6954 16.4163 26.6865 16.426 26.6781C16.4394 26.6662 16.4531 26.6545 16.4658 26.6418C16.4744 26.6334 16.4824 26.6243 16.4906 26.6156C16.5032 26.6022 16.5159 26.589 16.5276 26.5747C16.5367 26.5639 16.5448 26.5524 16.5534 26.5413C16.5632 26.5284 16.5732 26.5159 16.5824 26.5025C16.5941 26.4854 16.6045 26.4678 16.615 26.4499C16.6201 26.4415 16.6255 26.4335 16.6303 26.4249C16.6758 26.3426 16.7096 26.2529 16.7291 26.1579C16.7422 26.0944 16.7483 26.0303 16.7483 25.9669V10.903C16.7483 9.93269 17.5377 9.14332 18.508 9.14332H18.5627C19.5331 9.14332 20.3225 9.93269 20.3225 10.903V20.0011C20.3225 20.0361 20.3248 20.0707 20.3284 20.1047C20.2784 20.6015 20.6239 21.0565 21.1231 21.1347L26.7923 22.0236C26.7969 22.0244 26.8013 22.025 26.8058 22.0257C30.2352 22.513 32.8213 25.4924 32.8213 28.9564V29.0531C32.8213 30.6561 32.4301 32.2552 31.69 33.6772L29.12 38.6147C28.8784 39.079 29.0589 39.6509 29.5228 39.8925C29.6625 39.9652 29.8121 39.9998 29.9595 39.9998C30.3015 39.9998 30.6318 39.8139 30.8006 39.4896L33.3705 34.5521C34.2508 32.8609 34.716 30.9595 34.716 29.0531V28.9564C34.7163 26.8144 33.943 24.7438 32.539 23.1259Z"></path><path d="M18.5358 4.7736C19.0591 4.7736 19.4832 4.34955 19.4832 3.82621V0.947394C19.4832 0.424054 19.0591 0 18.5358 0C18.0124 0 17.5884 0.424054 17.5884 0.947394V3.82621C17.5884 4.34955 18.0126 4.7736 18.5358 4.7736Z"></path><path d="M24.4038 12.4926C24.4038 13.0159 24.8279 13.44 25.3512 13.44H28.23C28.7534 13.44 29.1774 13.0159 29.1774 12.4926C29.1774 11.9692 28.7534 11.5452 28.23 11.5452H25.3512C24.828 11.5452 24.4038 11.9693 24.4038 12.4926Z"></path><path d="M24.6003 7.13293C24.8427 7.13293 25.0853 7.04047 25.2703 6.85554L27.306 4.8199C27.6759 4.44979 27.6759 3.85002 27.306 3.48003C26.9358 3.11017 26.3361 3.11017 25.9661 3.48003L23.9303 5.51554C23.5603 5.88566 23.5603 6.48542 23.9303 6.85541C24.1154 7.04034 24.3579 7.13293 24.6003 7.13293Z"></path><path d="M11.0558 6.85541C11.2409 7.04035 11.4834 7.13281 11.7258 7.13281C11.9682 7.13281 12.2107 7.04035 12.3958 6.85541C12.7658 6.4853 12.7658 5.88554 12.3958 5.51555L10.36 3.47991C9.98992 3.11005 9.39016 3.11005 9.02017 3.47991C8.65018 3.85003 8.65018 4.44979 9.02017 4.81978L11.0558 6.85541Z"></path><path d="M8.13782 13.44H11.0166C11.54 13.44 11.964 13.0159 11.964 12.4926C11.964 11.9692 11.54 11.5452 11.0166 11.5452H8.13782C7.61448 11.5452 7.19043 11.9692 7.19043 12.4926C7.19043 13.0159 7.61448 13.44 8.13782 13.44Z"></path></svg>
        </a>
        <p>To wszystko! Zacznij korzystać z nowoczesnej rekrutacji</p>
      </div>
    </div>
  </section>
</main>

<section class="container my-5 py-5">
  <h2 class="mb-3 font-weight-bold text-center">Pakiety Cenowe</h2>
  <p class="text-center">Oferujemy różnorodne pakiety ogłoszeń medycznych, dopasowane do Twoich potrzeb!</p>
  <p class="text-center">
    W celu dodania ogłoszenia o pracy, proszę utworzyć konto użytkownika, klikając: <a class="fw-bold text-primary" href="https://medtalento.pl/funcs.php?name=user&amp;file=register">medtalento.pl</a>
    Po rejestracji w portalu będzie można publikować dowolne ogłoszenia. W przypadku poszukiwania innej oferty lub gdy masz pytania zapraszamy do kontaktu z naszym zespołem poprzez infolinię: 501-42-00-42 lub adres e-mail: <a class="fw-bold text-primary" href="mailto:help@medtalento.pl">help@medtalento.pl</a>
  </p>
  
  <!-- INCLUDE tpl_user_members_list.tpl -->
  
  <!--<div class="row mt-5">

    <div class="col-lg-4 col my-3">
      <div class="border text-center p-4" style="border-radius:10px;">
        <h3><b>Pakiet Start</b> – 59 zł za <b>1 ogłoszenie</b></h3>
        <p class="my-3">
          1 ogłoszenie publikowane przez 60 dni.<br>
          Pakiet ważny 30 dni od daty zakupu.
        </p>
      </div>
    </div>
    <div class="col-lg-4 col my-3">
      <div class="border text-center p-4" style="border-radius:10px;">
        <h3><b>Pakiet Standard</b> – 149 zł za <b>3 ogłoszenie</b></h3>
        <p class="my-3">
          3 ogłoszenie publikowane przez 60 dni.<br>
          Pakiet ważny 30 dni od daty zakupu.
        </p>
      </div>
    </div>
    <div class="col-lg-4 col my-3">
      <div class="border text-center p-4" style="border-radius:10px;">
        <h3><b>Pakiet Plus</b> – 249 zł za <b>5 ogłoszenie</b></h3>
        <p class="my-3">
          5 ogłoszenie publikowane przez 60 dni.<br>
          Pakiet ważny 30 dni od daty zakupu.
        </p>
      </div>
    </div>
    <div class="col-lg-4 col my-3">
      <div class="border text-center p-4" style="border-radius:10px;">
        <h3><b>Pakiet Smart</b> – 499 zł za <b>10 ogłoszenie</b></h3>
        <p class="my-3">
          10 ogłoszenie publikowane przez 60 dni.<br>
          Pakiet ważny 60 dni od daty zakupu.
        </p>
      </div>
    </div>
    <div class="col-lg-4 col my-3">
      <div class="border text-center p-4" style="border-radius:10px;">
        <h3><b>Pakiet Prime</b> – 749 zł za <b>15 ogłoszenie</b></h3>
        <p class="my-3">
          15 ogłoszenie publikowane przez 60 dni.<br>
          Pakiet ważny 60 dni od daty zakupu.
        </p>
      </div>
    </div>
    <div class="col-lg-4 col my-3">
      <div class="border text-center p-4" style="border-radius:10px;">
        <h3><b>Pakiet Extra</b> – 1299 zł <b>bez limitu ogłoszeń</b></h3>
        <p class="my-3">
          Każde ogłoszenie publikowane przez 60 dni.<br>
          Pakiet ważny 60 dni od daty zakupu.
        </p>
      </div>
    </div>
  </div>-->
</section>

<div class="container-fluid bg-light py-5 my-5">
  <div class="container pt-5 pb-3">
    <h2 class="mb-3 font-weight-bold text-center">Top 30 pracodawców</h2>
    <p class="text-center mb-0 mb-4" style="opacity:0.7;"></p>
    <div class="row mt-5">
      <!-- BEGIN p -->
      <div class="col-lg-3 col-12">
        <div class="bg-white rounded shadow-sm text-center p-4">
          <div class="overflow-hidden d-flex justify-content-center align-items-center" loading="lazy">
            <div class="rounded-circle" style="width:100px; height:100px; overflow:hidden;">
              <img style="max-height:100px;" src="{p.PHOTO}">
            </div>
          </div>
          <a class="d-block w-100 text-center h5 my-3" href="{p.HREF}">{p.COMPANY_NAME}</a>
          <a class="d-block w-100 btn btn-primary-light mt-4 mb-2" href="{p.HREF}">Zobacz</a>
        </div>
      </div>
      <!-- END p -->
    </div>
    <p class="text-center mb-0 mt-5"><a class="btn btn-primary" href="{SITEURL}/firmy.html">Zobacz pełna listę</a></p>
  </div>
</div>

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
