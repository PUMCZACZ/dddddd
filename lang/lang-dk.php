<?php

/****************************************************************/
/*	UWAGA! SKRYPT NIE JEST DARMOWY.								*/
/*	DALSZE ROZPOWSZECHNIANIE BEZ ZGODY 							*/
/*	FIRMY JMLNET JEST ZABRONIONE.								*/
/****************************************************************/
/****************************************************************/
/*	PRODUCENT OPROGRAMOWANIA	JMLnet							*/
/*	name SKRYPTU:				SERWIS OGLOSZEN JMLNET					*/
/*	WERSJA:						1.01							*/
/*	KONTAKT:					INFO@JMLNET.PL					*/
/****************************************************************/
/* Copyright (c) JMLnet. Wszelkie prawa zastrzeone.				*/
/****************************************************************/

$_LANG = array(
'_LANG_268' => 'Slet konto',
'_LANG_269' => 'Ændring af adgangskode',
'_LANG_271' => 'Nuværende adgangskode',
'_LANG_272' => 'Ny adgangskode',
'_LANG_273' => 'Bekræft den nye adgangskode',
'_LANG_274' => 'Gem',
'_LANG_275' => 'Brugernavn:',
'_LANG_276' => 'Adgangskode:',
'_LANG_277' => 'Log in5',
'_LANG_278' => 'Jeg kan ikke huske adgangskoden',
'_LANG_279' => 'Vælg pakken og brug hjemmesiden fuldt ud!',
'_LANG_280' => 'Jeg har allerede et abonnement, og jeg vil gerne forlænge det',
'_LANG_281' => 'Jeg har allerede et abonnement, men jeg vil gerne skifte til en anden pakke',
'_LANG_282' => 'Pakke',
'_LANG_283' => 'gratis!',
'_LANG_284' => 'Periode:',
'_LANG_285' => 'skift',
'_LANG_286' => 'Vælg en periode',
'_LANG_287' => 'måneder',
'_LANG_293' => 'Jeg ordrer',
'_LANG_294' => 'Andre pakker',
'_LANG_295' => 'Pakketype',
'_LANG_296' => 'Mængde',
'_LANG_297' => 'Tid',
'_LANG_298' => 'Pris',
'_LANG_301' => 'gratis!',
'_LANG_302' => 'Jeg ordrer',
'_LANG_303' => 'Forlængelse af abonnementet',
'_LANG_305' => 'måneder',
'_LANG_307' => 'Jeg ordrer',
'_LANG_308' => 'Ændring af abonnementet',
'_LANG_310' => 'Pakke',
'_LANG_311' => 'måneder',
'_LANG_313' => 'Jeg ordrer',
'_LANG_314' => 'Adgangskode gendannelse',
'_LANG_315' => 'Indtast din nye adgangskode i feltet',
'_LANG_316' => 'Ny adgangskode',
'_LANG_317' => 'og bekræft ved at indtaste den igen i feltet',
'_LANG_318' => 'Bekræft den nye adgangskode',
'_LANG_319' => ', og bekræft derefter ved at klikke på knappen',
'_LANG_320' => 'Skift adgangskoden',
'_LANG_322' => 'Ny adgangskode:',
'_LANG_323' => 'Gentag adgangskoden:',
'_LANG_324' => 'Skift adgangskoden',
'_LANG_325' => 'Indtast din email adresse og klik derefter på',
'_LANG_326' => 'Gendan adgangskoden',
'_LANG_328' => 'E-mail-adresse',
'_LANG_329' => 'Gendan adgangskoden',
'_LANG_330' => 'Omdirigering til betaling',
'_LANG_331' => 'Ordre bekræftelse',
'_LANG_224' => 'E-mail-adresse',
'_LANG_225' => 'Adgangskode',
'_LANG_501' => 'Indtast rabatkoden',
'_LANG_502' => 'Kampagnekode',
'_LANG_503' => 'Hvis du har en rabatkode, skal du indtaste den i feltet nedenfor for at bruge en mulig rabat på dine køb.',
'_LANG_504' => 'Kode',
'_LANG_505' => 'Gem koden',
'_LANG_506' => 'Gemte koder',
'_LANG_507' => 'Rabat',
'_LANG_508' => 'Gyldighedsdato',
'_LANG_509' => 'Brugt',
'_LANG_510' => 'Firma database',
'_LANG_511' => 'Hjælp',
'_LANG_512' => 'Gratis',
'_LANG_513' => 'Find et firma i dit område.',
'_LANG_514' => 'Tilføj annoncen helt gratis!',
'_LANG_515' => 'Promovering',
'_LANG_516' => 'Fed',
'_LANG_517' => 'Vi skriver med fed, titlen på din annonce på listen over annoncer.',
'_LANG_518' => 'Pris',
'_LANG_519' => '-',
'_LANG_520' => 'Baggrundslys',
'_LANG_521' => 'Vi vil fremhæve dit tilbud på listen over annoncer.',
'_LANG_522' => 'Fremhævning',
'_LANG_523' => 'Vi viser din annonce i starten af annonce listen.',
'_LANG_524' => 'Frontside',
'_LANG_525' => 'Din annonce bliver vist på frontsiden.',
'_LANG_526' => 'Normalkonto',
'_LANG_527' => 'Firmakonto',
'_LANG_528' => 'Annoncør',
'_LANG_529' => 'Vis',
'_LANG_530' => 'Tilbud',
'_LANG_531' => 'time.',
'_LANG_532' => 'minuttter.',
'_LANG_533' => 'Afsluttet',
'_LANG_534' => 'Under et minut',
'_LANG_535' => 'dage',
'_LANG_536' => 'dag',
'_LANG_537' => 'Tilføjet',
'_LANG_538' => 'Bekræftelse af tilbuddet',
'_LANG_539' => 'Bekræftelse af tilbud - herunder detaljerne om tilbuddet.',
'_LANG_540' => 'Navn',
'_LANG_541' => 'Tilbud',
'_LANG_542' => 'Dato for indsendelse af tilbuddet',
'_LANG_543' => 'Afslutning af annoncen',
'_LANG_544' => 'Kontakt med betjening af brugere',
'_LANG_545' => 'Gratis',
'_LANG_546' => 'Gennemse annoncer',
'_LANG_547' => 'Leder du efter noget?',
'_LANG_548' => 'Gennemse tilgængelige annoncer',
'_LANG_549' => 'Gennemse annoncer',
'_LANG_550' => 'Indlæsning af billedet ...',
'_LANG_551' => 'Indlæsning af formular ...',
'_LANG_552' => 'fra',
'_LANG_553' => 'til',
'_LANG_554' => 'Jeg giver samtykke til behandling af mine personoplysninger firmaet Witold Wilanowski, momsnummer: 5690008185 Al. Jozef Pilsudski 5A, 06-500 Mlawa, for at kunne reagere, herunder at indsende tilbud, hvis jeg beder om det. Mine personoplysninger bliver beh',
'_LANG_555' => 'Lav et tilbud for at fuldføre ordren',
'_LANG_556' => 'For at afgive tilbud, beder vi dig',
'_LANG_557' => 'logge in',
'_LANG_558' => 'For at afgive tilbud bedes du aktivere',
'_LANG_559' => 'abonnementet',
'_LANG_560' => 'Kategorier som kan tilbydes',
'_LANG_561' => 'Siden blev ikke fundet',
'_LANG_562' => 'Jeg bestiller og betaler',
'_LANG_563' => 'Jeg opgiver',
'_LANG_564' => 'Betaling for annoncen',
'_LANG_565' => 'Start',
'_LANG_566' => 'Nyeste annoncer',
'_LANG_567' => 'Tilføj et firma',
'_LANG_568' => 'Subscription',
'_LANG_569' => 'E-mail-adresse',
'_LANG_570' => 'Send',
'_LANG_571' => 'Ikke udfyld prisfelt vil blive defineret som Gratis',
'_LANG_572' => 'Post',
'_LANG_573' => 'dage siden',
'_LANG_574' => 'i går',
'_LANG_575' => 'Du har ikke tilføjet nogen annoncer endnu',
'_LANG_576' => 'Tilføj annonce',
'_LANG_577' => 'Afsender',
'_LANG_578' => 'Annoncetype',
'_LANG_581' => 'Maksimum antal billeder',
'_LANG_582' => 'Vælg denne option',
'_LANG_583' => 'Jeg erklærer at jeg har læst og accepteret',
'_LANG_584' => 'REGLER',
'_LANG_585' => '.',
'_LANG_586' => 'Jeg accepterer behandlingen af mine personoplysninger til formål og omfang i overensstemmelse med gennemførelsen af den service, der er beskrevet i',
'_LANG_587' => 'PRIVATPOLITIK',
'_LANG_588' => 'Din konto er blevet aktiveret.',
'_LANG_589' => 'Min 6 tegn, store og små bogstaver, tal eller specialtegn',
'MSG_ADD_OFFER_SUBJECT_CONFIRM' => 'Bekræftelse af tilbuddet',
'ITEM_OFFER_ADD' => 'Tilbuddet er tilføjet',
'ITEM_OFFER_EDIT' => 'Tilbuddet er blevet opdateret',
'PWD_INCORRECT' => 'Ugyldigt brugernavn eller adgangskode',
'PWD_NEW_INCORRECT' => 'De angivne adgangskoder er ikke den samme',
'CHARGE_PROMO_ADDED' => 'Profil promovering ',
'NO_ENOUGH_MONEY' => 'Du har ikke kredit nok',
'PASS_CHNG_ERROR' => 'Vi beklager, ingen oplysninger om en sådan bruger eller ugyldige tegn.',
'PASS_CHNG_PASS' => 'De angivne adgangskoder adskiller sig fra hinanden.',
'PASS_CHNG_UPDATE_ERROR' => 'Kan ikke opdateres brugerens indtastning. Kontakt venligst tjenesten.',
'DATA_REQUIRED' => 'Udfyld de nødvendige data: (Firmanavn, adresse, Momsnr. CVR)',
'VARYFI_SAVED' => 'Anmodningen er sendt til verifikation af vores tjeneste.',
'MONTH_1' => 'måned',
'MONTH_2' => 'måneder',
'MONTH_5' => 'måneder',
'PAYMENT_SAVE' => 'Den valgte pakke er blevet aktiveret',
'REGISTER_END' => 'Der er oprettet en ny brugerkonto. Vi har sendt dig en e-mail med linket, som aktiverer din konto.',
'EMAILACTIVATETITLE' => 'Konto aktivering af ny bruger',
'ACTIVATE_EMPTY_DATA' => 'Ingen bruger i databasen med det oplyste data eller kontoen er allerede blevet aktiveret.',
'USER_CHECK_EMAIL' => 'Den angivne adresse er allerede registreret på vores hjemmeside',
'_LANG_332' => 'Type:',
'_LANG_333' => 'Køb af pakke:',
'_LANG_334' => 'Beløb:',
'_LANG_339' => 'Jeg ordrer',
'_LANG_340' => 'Faktura nummer',
'_LANG_341' => 'Sum',
'_LANG_342' => 'Udstedelsesdato',
'_LANG_343' => 'Hent',
'_LANG_344' => 'Ingen fakturaer udstedt',
'_LANG_345' => 'Se visitkort',
'_LANG_346' => 'Antal besøg:',
'_LANG_347' => 'skaber forbindelse:',
'_LANG_348' => 'Sidste 30 dage:',
'_LANG_349' => 'Tilføj et firma billede',
'_LANG_350' => 'Tilføjede billeder:',
'_LANG_351' => 'Profilindstillinger',
'_LANG_408' => 'Usuń konto',
'_LANG_409' => 'Gem ændringer',
'_LANG_410' => 'Edycja danych',
'_LANG_412' => 'Nuværende adgangskode:',
'_LANG_413' => 'Nyt kodeord:',
'_LANG_115' => 'Følg',
'_LANG_116' => 'Opret annonce',
'_LANG_117' => 'dage',
'_LANG_118' => 'detaljer',
'_LANG_119' => 'Søg',
'_LANG_120' => 'Detaljeret søgemaskine',
'_LANG_121' => 'Vis alle',
'_LANG_122' => 'Se, hvordan vores side fungerer',
'_LANG_123' => '????????????',
'_LANG_124' => 'Tilbage',
'_LANG_125' => 'Videre',
'_LANG_126' => 'Database over virksomheder',
'_LANG_127' => 'Helt gratis!',
'_LANG_128' => 'Søg efter en entreprenør',
'_LANG_129' => 'Meddelelser promoveret',
'_LANG_130' => 'Aktualności',
'_LANG_131' => 'Wróć do listy',
'_LANG_132' => 'Nyheder',
'_LANG_133' => 'Teknisk pause',
'_LANG_134' => 'Teknisk pause',
'_LANG_496' => 'Abonnement type',
'_LANG_497' => 'Dato for aktivering / afslutning',
'_LANG_498' => 'Dine aktive abonnementer',
'_LANG_499' => 'Beskrivelse',
'_LANG_500' => 'Tak for det tilsendte. Vi vil tage os af det så hurtigt som muligt.',
'REPORT_SUBJECT' => 'Vi bekræfter oprettelse af annoncen',
'USER_STATUS_0' => 'Ikke bekræftet',
'USER_STATUS_1' => 'Aktiv',
'USER_STATUS_2' => 'Suspenderet',
'USER_CHECK_EMAIL2' => 'Den angivne e-mail-adresse er ikke gyldig',
'USER_CHECK_NAME' => 'Det brugernavn, du har indtastet, er allerede registreret.',
'USERNAME_FREE' => 'Dette navn er tilgængeligt',
'EMAIL_ERROR' => 'Ugyldig e-mail-adresse',
'CONTACT_TITLE' => 'Kontakt',
'MESSAGE_SEND' => 'Beskeden er blevet sendt',
'REPORT_SEND' => 'Tak for annoncen',
'MSG_SEND' => 'Beskeden er blevet sendt',
'MSG_SUBJECT' => 'Meddelelse vedrørende meddelelsen',
'ITEM_ADD' => 'Annoncen er blevet tilføjet.',
'ITEM_UPDATE' => 'Ændringerne er blevet gemt.',
'WATCH_ADDED_ITEM' => 'Annoncen er blevet tilføjet til den overvågede',
'WATCH_ADDED_USER' => 'Brugeren er blevet tilføjet til den overvågede',
'ITEM_DELETED' => 'Annoncen er blevet slettet',
'ITEM_SHOW' => 'Annoncen er blevet skjult',
'ITEM_HIDE' => 'Meddelelsen er blevet offentliggjort',
'ITEM_UNACTIVE' => 'Annoncen er ikke aktuelt',
'ITEM_DISTINCTION' => 'Meddelelsen blev fremhævet',
'ITEM_BIDS' => 'Annoncen er blevet slået',
'PROFILE_EMPTY' => 'Profilen blev ikke fundet.',
'MEMBER_EMPTY' => 'Dit abonnement har ikke mulighed for at udføre denne operation. <a href=\\\\\\\\\\\\\\\\\\\\\\\\\\\"funcs.php?name=user&amp;file=member\\\\\\\\\\\\\\\\\\\\\\\\\\\"><strong>Køb et større abonnement.</strong></a>.',
'PERMISSION_LOGIN' => 'For at tilføje en annonce skal du være logget ind.',
'PERMISSION_MEMBER' => 'For at tilføje en annonce skal du have et aktivt abonnement',
'ADD_EMPTY_CAT' => 'Vælg venligst en kategori',
'ADD_EMPTY_LANGS' => 'Vælg venligst annoncesprog',
'ADD_EMPTY_TITLE' => 'Udfyld titlen',
'ADD_EMPTY_DESC' => 'Udfyld venligst beskrivelsen',
'ADD_EMPTY_PRICE' => 'Udfyld venligst prisen',
'ADD_EMPTY_QTY' => 'Udfyld venligst mængden',
'WATCH_USER_USER' => 'Du kan ikke tilføje din egen profil / profil til din overvågningsliste',
'MUST_LOGIN' => 'Log venligst ind',
'ERROR_CAPTCHA' => 'Udfyld reCaptche korrekt',
'ITEM_DEACTIVE' => 'Din annonce er blevet deaktiveret',
'ADD_USER_DATA' => 'Udfyld venligst de ønskede data (firma navn, Momsnr., CVR, adresse, by og postnummer).',
'EMAIL_REMINDER_TITLE' => 'Påmindelse om den kommende gyldighedsperiode for abonnementet',
'EMAIL_REMINDER_TEXT' => 'Vi minder dig om det endelige gyldighed af dit abonnement. For at sikre kontinuiteten, skal du forny dit abonnement.',
'PROMO_CODE_USED' => 'Rabatkoden er allerede brugt eller udløbet',
'PROMO_CODE_EMPTY' => 'Indtast venligst rabatkoden',
'PROMO_CODE_SAVED' => 'Rabatkoden er blevet gemt',
'EMPTY_UTYPE_DATA' => 'Udfyld venligst de ønskede data',
'EMAIL_ITEM_UNACTIVE' => 'Forlæng din annonce:',
'_LANG_78' => 'Trin',
'_LANG_79' => 'Tilføj nøgleordene til din annonce',
'_LANG_80' => 'Hvad er nøgleordene?',
'_LANG_81' => 'Nøgleord for sprog:',
'_LANG_82' => 'Tilføj nøgleordene?',
'_LANG_84' => 'Trin',
'_LANG_85' => 'Videomateriale',
'_LANG_86' => 'URL YouTube',
'_LANG_87' => 'Tilføj +',
'_LANG_169' => 'Firmanavn',
'_LANG_170' => 'Virksomhed: verificeret',
'_LANG_171' => 'Sprog:',
'_LANG_172' => 'Under verifikation',
'_LANG_173' => 'Inaktiv',
'_LANG_174' => 'Upubliceret',
'_LANG_175' => 'Firmanavn',
'_LANG_176' => 'Virksomhed: verificeret',
'_LANG_177' => 'Sprog:',
'_LANG_178' => 'Udgivelsesdato:',
'_LANG_180' => 'Antal besøg:',
'_LANG_181' => 'Se',
'_LANG_182' => 'Slet',
'_LANG_183' => 'Edit',
'_LANG_184' => 'Aktiver',
'_LANG_185' => 'Skjul',
'_LANG_186' => 'Tilføj ekstra',
'_LANG_187' => 'Flyt annoncen øverst på den givne liste over annoncer',
'_LANG_188' => 'Stop med at observere',
'_LANG_414' => 'Gentag den nye adgangskode:',
'_LANG_415' => 'Gem ændringer',
'_LANG_416' => 'Konto sletning',
'_LANG_418' => 'Er du sikker på, at du vil slette din konto?',
'_LANG_419' => 'Nej',
'_LANG_420' => 'Ja',
'_LANG_421' => 'Brugerverifikation',
'_LANG_422' => 'Din konto er blevet bekræftet positivt.',
'_LANG_423' => 'Din ansøgning afventer bekræftelse.',
'_LANG_424' => 'For at modtage statusen \\\\\\\\\\\\\\\\\\\\\\\\\\\\\"verificeret\\\\\\\\\\\\\\\\\\\\\\\\\\\\\" skal du sende virksomhedens registreringsdokumenter.',
'_LANG_425' => 'Vedhæftede filer:',
'_LANG_426' => 'Bemærkninger:',
'_LANG_427' => 'Send',
'_LANG_428' => 'Annoncer',
'_LANG_429' => 'Virksomheder',
'_LANG_430' => 'Kategorier',
'_LANG_431' => 'Tilbud fra virksomheden',
'_LANG_433' => 'Land:',
'_LANG_434' => 'Antal annoncer:',
'_LANG_435' => 'Firma annoncer',
'_LANG_436' => 'Firma visitkort',
'_LANG_437' => 'Stop med at følge annoncen',
'_LANG_440' => 'Fjern annoncen fra  følge afdeling',
'_LANG_441' => 'Følg',
'_LANG_443' => 'Fjern fra favoriter',
'_LANG_444' => 'Følg',
'_LANG_445' => 'Vælg firma du vil følge',
'_LANG_446' => '-- vælg --',
'_LANG_448' => 'Stop med at følge',
'_LANG_449' => 'Indtast søgefrasen her',
'_LANG_450' => 'Email:',
'_LANG_451' => 'Brugernavn:',
'_LANG_452' => '(ID nummer:)',
'_LANG_453' => 'Fornavn:',
'_LANG_454' => 'Besked:',
'_LANG_457' => 'Besked til annoncen',
'_LANG_458' => 'Besked:',
'_LANG_459' => 'men du har ikke et aktivt abonnement. Forlad det for at fjerne blokeringen af ​​meddelelsen.',
'_LANG_461' => 'Link til aktivering af adgangskode ændring',
'_LANG_462' => 'Link til aktivering af adgangskodeændring for kontoen',
'_LANG_463' => 'Med dette link kan du ændre adgangskoden på siden.',
'_LANG_464' => 'Velkommen på hjemmesiden',
'_LANG_465' => 'For at afslutte registreringen kan du besøge linket herunder inden for 24 timer for at aktivere din nye konto, ellers vil dataene automatisk blive slettet af systemet, og du skal tilmelde dig på ny:',
'_LANG_466' => 'Nyttige oplysninger:',
'_LANG_467' => 'Hvis du har brug for hjælp eller er i tvivl - svar på denne e-mail.',
'_LANG_468' => 'Velkommen!',
'_LANG_469' => 'Din konto på hjemmeside er blevet',
'_LANG_471' => 'Kontoen er blevet suspenderet på grund af en overtrædelse af reglerne, der gælder for brugere, der bruger hjemmesidenes tjenester.',
'_LANG_472' => 'Nyttige oplysninger:',
'_LANG_473' => 'Hvis du har brug for hjælp eller er i tvivl - svar på denne e-mail.',
'_LANG_474' => 'Du er blevet informeret om din annonce på hjemmesiden',
'_LANG_475' => 'Jeg erklærer, at jeg har læst',
'_LANG_476' => 'Vis dette for ulogget brugere',
'_LANG_477' => 'Vis ikke dette for ulogget brugere',
'_LANG_478' => 'Vis adresse i annoncen til brugere, der ikke er logget ind',
'_LANG_479' => 'Vis ikke adresse i annoncer til brugere, der ikke er logget ind',
'_LANG_480' => 'Bruger / Firma',
'_LANG_481' => 'antal annoncer',
'_LANG_482' => 'Antal billeder til annoncen',
'_LANG_483' => 'antal fremrykninger',
'_LANG_484' => 'ilość wyróżnień',
'_LANG_485' => 'Annoncer',
'_LANG_486' => 'Fremrykninger',
'_LANG_487' => 'Fremhævninger',
'_LANG_488' => 'Frontside',
'_LANG_489' => 'dage',
'_LANG_490' => 'Uger',
'_LANG_491' => 'Tilbage',
'_LANG_492' => 'annonce',
'_LANG_493' => 'Fremrykning',
'_LANG_494' => 'fremhævning',
'_LANG_495' => 'Data',
'_LANG_90' => 'Gem ændringer',
'_LANG_91' => 'Opret annonce',
'_LANG_92' => 'Kategori',
'_LANG_95' => 'Land',
'_LANG_97' => 'Firma',
'_LANG_98' => 'alle',
'_LANG_99' => 'bekræfted',
'_LANG_100' => 'ubekræfted',
'_LANG_101' => 'Hoved sprog',
'_LANG_102' => 'Fra den nyeste',
'_LANG_103' => 'Fra den ældste',
'_LANG_104' => 'Fra de dyreste',
'_LANG_105' => 'Fra den billigste',
'_LANG_107' => 'Ingen annoncer',
'_LANG_108' => 'Søg i andre kategorier',
'_LANG_109' => 'Min konto',
'_LANG_110' => 'Log ind',
'_LANG_111' => 'Registrering',
'_LANG_112' => 'international B2B portal',
'_LANG_113' => 'dedikeret til branchen',
'_LANG_114' => 'rav og smykker',
'_LANG_226' => 'Bekræft adgangskode',
'_LANG_227' => 'Profil logo',
'_LANG_228' => 'Skift adgangskoden',
'_LANG_229' => 'Firmanavn',
'_LANG_230' => 'Momsnr.',
'_LANG_231' => 'CVR',
'_LANG_232' => 'By',
'_LANG_233' => 'Postnummer',
'_LANG_234' => 'Vejnavn og nummer',
'_LANG_237' => 'Vælg et land',
'_LANG_239' => 'Trin',
'_LANG_240' => 'Kontaktoplysninger',
'_LANG_241' => 'Telefon',
'_LANG_242' => 'Tilføj +',
'_LANG_245' => 'Gemte numre:',
'_LANG_246' => 'Kontakt for:',
'_LANG_250' => 'Hjemmeside adresse',
'_LANG_251' => 'Tilføj +',
'_LANG_254' => 'Gemte adresser:',
'_LANG_255' => 'Trin',
'_LANG_256' => 'Firmabeskrivelse',
'_LANG_257' => 'Firmabeskrivelse for sproget:',
'_LANG_258' => 'Tilføj en beskrivelse af dit firma',
'_LANG_260' => 'Sociale medier',
'_LANG_261' => 'Facebook',
'_LANG_262' => 'Instagram',
'_LANG_264' => 'Regler',
'_LANG_266' => 'privatpolitik',
'_LANG_267' => 'Gem ændringer',
'_LANG_135' => 'Webstedet er ved at blive opdateret. Prøv igen senere.',
'_LANG_136' => 'Vi beklager ulejligheden.',
'_LANG_137' => 'Tilbage',
'_LANG_138' => 'Videre',
'_LANG_139' => 'konto menu',
'_LANG_140' => 'Frontside',
'_LANG_149' => 'Frontside',
'_LANG_150' => 'Nyheder',
'_LANG_151' => 'Hjælp',
'_LANG_152' => '© Alle rettigheder forbeholdes',
'_LANG_153' => 'Kontakt',
'_LANG_154' => 'Vær med andre firmaer',
'_LANG_155' => 'contact@email.com',
'_LANG_156' => 'Artiklerne på webstedet er beskyttet af ophavsret.',
'_LANG_157' => 'Kopiering og brug uden skriftlig tilladelse fra redaktionen er forbudt.',
'_LANG_158' => 'Alle rettigheder forbeholdes.',
'_LANG_159' => 'AnnoncerOnLine',
'_LANG_160' => 'Søg',
'_LANG_161' => 'Min konto',
'_LANG_162' => 'Log in6',
'_LANG_163' => 'Opret en gratis konto',
'_LANG_164' => 'Opret annonce',
'_LANG_165' => 'Fornavn',
'_LANG_166' => 'Partnerens fornavn',
'_LANG_167' => 'By',
'_LANG_168' => 'Gem2',
'_LANG_189' => 'Besked',
'_LANG_190' => 'Følg',
'_LANG_191' => 'Se',
'_LANG_192' => 'Firma er blevet verificeret',
'_LANG_193' => 'Send besked',
'_LANG_195' => 'Annonce:',
'_LANG_196' => 'Firma:',
'_LANG_197' => 'E-mail-adresse',
'_LANG_198' => 'Fornavn / Firmanavn',
'_LANG_199' => 'Meddelelsens indhold:',
'_LANG_200' => 'Send',
'_LANG_201' => 'Læs mere',
'_LANG_202' => 'Min konto',
'_LANG_203' => 'Du er logget ind som:',
'_LANG_204' => 'Log ud',
'_LANG_205' => 'Din tarifplan:',
'_LANG_206' => 'Skift',
'_LANG_207' => 'Pakketen udløber',
'_LANG_208' => 'Bekræft dit firma og få status:',
'_LANG_209' => 'Firmaet er blevet verificeret',
'_LANG_210' => 'Firmaet er ikke verificeret',
'_LANG_211' => 'Bekræft',
'_LANG_212' => 'Konto menu',
'_LANG_213' => 'Mine data',
'_LANG_214' => 'Mine annoncer',
'_LANG_215' => 'Opret annonce',
'_LANG_216' => 'Abonnement',
'_LANG_217' => 'Betalinger / FV',
'_LANG_218' => 'Følg',
'_LANG_219' => 'Mit visitkort',
'_LANG_220' => 'Trin',
'_LANG_221' => 'Grundlæggende data',
'_LANG_222' => 'Navnet på brugeren',
'USER_STATUS_3' => 'Fjernet',
'CHANGES_SAVED' => 'Ændringer er blevet gemt',
'WATCH_DELETED_ITEM' => 'Annoncen er blevet fjernet fra følg',
'WATCH_DELETED_USER' => 'Brugeren er blevet fjernet fra følg',
'MEMBER_NAME_EMPTY' => 'Mangler',
'PROFILE_PHOTO_DELETED' => 'Billedet er blevet fjernet.',
'USER_UPDATED' => 'Ændringer er blevet gemt',
'USER_UPDATED_VERYFI' => 'Din konto skal bekræftes igen',
'PASS_NO_INFO' => 'Ingen oplysninger om denne bruger',
'PASS_CHNG_TITLE' => 'Ændring af adgangskode',
'PASS_CHNG_INFO' => 'Klik på linket, der giver dig mulighed for at ændre din adgangskode.',
'PASS_CHNG_OK' => 'Adgangskoden er blevet ændret, du kan nu logge ind på din konto.',
'EMPTY_LOGIN' => 'Udfyld venligst brugernavnet',
'EMPTY_PWD' => 'Udfyld venligst adgangskoden',
'LOGIN_BLOCK' => 'Log in funktionen er blevet blokeret. Log venligst ind om <strong>%d</strong> %s.',
'LOGIN_ERROR' => 'Login eller adgangskode er ikke gyldig.',
'STATUS_0' => 'Din konto er ikke blevet aktiveret. Klik venligst på aktiveringslinket, for at modtage e-mailen.',
'STATUS_2' => 'Din konto er blevet suspenderet.',
'STATUS_3' => 'Din konto er blevet slettet.',
'PLEASELOGIN' => 'Log venligst ind eller registrer dig.',
'FRIENDS_DELETE' => 'Brugere er blevet fjernet fra din vennegruppe.',
'_LANG_0' => 'Send',
'_LANG_1' => 'Send',
'_LANG_2' => 'Annonce:',
'_LANG_3' => 'Send besked',
'_LANG_4' => 'Om firmaet:',
'_LANG_5' => 'Firmanavn:',
'_LANG_6' => 'Se alle firmaets annoncer',
'_LANG_7' => 'Følg denne firma',
'_LANG_8' => 'Sælger er blevet verificeret',
'_LANG_9' => '(hvordan kan man blive verificeret)',
'_LANG_10' => 'Bruger på siden fra:',
'_LANG_11' => 'Momsnummer:',
'_LANG_12' => 'CVR:',
'_LANG_13' => 'Sælgerens fulde navn:',
'_LANG_14' => 'Kontakt',
'_LANG_15' => 'Telefon',
'_LANG_16' => 'E-mail',
'_LANG_17' => 'Kun til brugere som er logget in',
'_LANG_18' => 'Firmaets hjemmeside',
'_LANG_19' => 'Kun til brugere som er logget in',
'_LANG_20' => 'Placering',
'_LANG_21' => 'Vej',
'_LANG_22' => 'Udstederens navn:',
'_LANG_23' => 'Offentliggjort',
'_LANG_24' => 'Anmeld misbrug',
'_LANG_25' => 'Følg:',
'_LANG_26' => 'Følg',
'_LANG_27' => 'Den tilbudte mængde:',
'_LANG_28' => 'Enhed:',
'_LANG_29' => 'Pris:',
'_LANG_30' => 'Du kan ændre sproget',
'_LANG_31' => 'Multimedia',
'_LANG_32' => 'Galleri',
'_LANG_33' => 'Sociale medier',
'_LANG_34' => 'Firmaets annoncer',
'_LANG_35' => 'Rapportering af misbrug',
'_LANG_37' => 'Bruger:',
'_LANG_38' => 'Annonce:',
'_LANG_39' => 'Årsag til indsendelse:',
'_LANG_40' => 'Send',
'_LANG_41' => 'Send besked',
'_LANG_43' => 'Annonce:',
'_LANG_44' => 'Bruger:',
'_LANG_45' => 'E-mail-adresse',
'_LANG_46' => 'Fornavn / Firmanavn',
'_LANG_47' => 'Meddelelsens indhold:',
'_LANG_48' => 'Send',
'_LANG_49' => 'Trin',
'_LANG_50' => 'Grundlæggende oplysninger om annoncen',
'_LANG_51' => 'Indtast titlen på annoncen',
'_LANG_53' => 'Vælg kategori',
'_LANG_54' => '-- vælg --',
'_LANG_57' => 'Tilføj billeder til annoncen',
'_LANG_58' => 'Tilføjede billeder:',
'_LANG_59' => 'Pris',
'_LANG_60' => 'Vælg valuta',
'_LANG_61' => 'Indtast den tilbudte mængde til en given pris',
'_LANG_62' => 'Vælg måleenhed',
'_LANG_63' => 'Trin',
'_LANG_64' => 'Tilgængelighed',
'_LANG_65' => 'Annonce tid',
'_LANG_66' => 'Dit abonnement udløber:',
'_LANG_67' => 'Du har ikke et aktivt abonnement',
'_LANG_68' => 'Du kan også gemme tilbudet uden at offentliggøre det. Dit tilbud bliver gemt, men vil ikke være synligt på siden. Du kan ændre dette via dit administrationsside',
'_LANG_69' => 'Jeg vil bare gemme tilbuddet uden at offentliggøre det i øjeblikket',
'_LANG_71' => 'Trin',
'_LANG_72' => 'Annonce beskrivelse',
'_LANG_73' => 'Annonce beskrivelse til sproget:',
'_LANG_74' => 'Vælg på hvilke sprog du vil have, at annoncen skal vises:',
'_LANG_77' => 'Tilføj en beskrivelse af din annonce til sproget:',
);
