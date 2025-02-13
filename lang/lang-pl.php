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
'_LANG_169' => 'Nazwa firmy',
'_LANG_170' => 'Firma: zweryfikowana',
'_LANG_171' => 'Język:',
'_LANG_172' => 'W trakcie weryfikacji',
'_LANG_173' => 'Nieaktywne',
'_LANG_174' => 'Nieopublikowane',
'_LANG_175' => 'Nazwa firmy',
'_LANG_176' => 'Firma: zweryfikowana',
'_LANG_177' => 'Język:',
'_LANG_178' => 'Data wystawienia:',
'_LANG_180' => 'Ilość odwiedzin:',
'_LANG_181' => 'Zobacz',
'_LANG_182' => 'Usuń',
'_LANG_183' => 'Edytuj',
'_LANG_184' => 'Publikuj',
'_LANG_185' => 'Ukryj',
'_LANG_186' => 'Dodaj wyróżnienie',
'_LANG_187' => 'Podbij ogłoszenie',
'_LANG_188' => 'Przestań obserwować',
'_LANG_414' => 'Powtórz nowe hasło:',
'_LANG_415' => 'Zapisz zmiany',
'_LANG_416' => 'Usunięcie konta',
'_LANG_418' => 'Czy jesteś pewna/y, że chcesz usunąć swoje konto w serwisie?',
'_LANG_419' => 'Nie',
'_LANG_420' => 'Tak',
'_LANG_421' => 'Weryfikacja użytkownika',
'_LANG_422' => 'Twoje konto zostało zweryfikowane pozytywnie.',
'_LANG_423' => 'Twój wniosek oczekuje na weryfikację.',
'_LANG_424' => 'Aby otrzymać status \'zweryfikowany\' należy przesłać dokumenty rejestrowe firmy.',
'_LANG_425' => 'Załączniki:',
'_LANG_426' => 'Uwagi:',
'_LANG_427' => 'Wyślij',
'_LANG_428' => 'Ogłoszenia',
'_LANG_429' => 'Firmy',
'_LANG_430' => 'Kategorie',
'_LANG_431' => 'Oferty firmy',
'_LANG_433' => 'Kraj:',
'_LANG_434' => 'Ilość ogłoszeń:',
'_LANG_435' => 'Ogłoszenia firmy',
'_LANG_436' => 'Wizytówka firmy',
'_LANG_437' => 'Przestań obserwować',
'_LANG_440' => 'Usuń z obserwowanych',
'_LANG_441' => 'Obserwuj',
'_LANG_443' => 'Usuń z obserwowanych',
'_LANG_444' => 'Obserwuj',
'_LANG_445' => 'Wybierz obserwowaną firmę',
'_LANG_446' => '-- wybierz --',
'_LANG_448' => 'Przestań obserwować',
'_LANG_449' => 'Tutaj wpisz szukaną frazę',
'_LANG_450' => 'Email:',
'_LANG_451' => 'Nazwa użytkownika:',
'_LANG_452' => '(ID:)',
'_LANG_453' => 'Imię:',
'_LANG_454' => 'Wiadomość:',
'_LANG_457' => 'Wiadomość do ogłoszenia',
'_LANG_458' => 'Wiadomość:',
'_LANG_459' => ' ale nie posidają Państwo aktywnego abonamentu. Prosimy o jego odnowienie w celu odblokowania wiadomości.',
'_LANG_461' => 'Link aktywujący zmianę hasła',
'_LANG_462' => 'Link aktywujący zmianę hasła dla konta',
'_LANG_463' => 'Pod tym linkiem możesz zmienić hasło na stronie.',
'_LANG_464' => 'Witamy w serwisie',
'_LANG_465' => 'Aby zakończyć rejestrację prosimy odwiedzić poniższy link w ciągu najbliższych 24 godzin w celu aktywacji nowego konta, w przeciwnym wypadku dane zostaną automatycznie usunięte przez system i bedą Państwo musieli ponownie się zarejestrować:',
'_LANG_466' => 'Przydatne informacje:',
'_LANG_467' => 'Jeżeli potrzebujesz pomocy lub masz jakiekolwiek wątpliwości - odpowiedz na ten e-mail.',
'_LANG_468' => 'Witaj!',
'_LANG_469' => 'Twoje konto w serwisie zostało',
'_LANG_471' => 'Konto zostało zawieszone z powodu naruszenia zasad obowiązujących użytkowników korzystających z usług serwisu.',
'_LANG_472' => 'Przydatne informacje:',
'_LANG_473' => 'Jeżeli potrzebujesz pomocy lub masz jakiekolwiek wątpliwości - odpowiedz na ten e-mail.',
'_LANG_474' => 'Otrzmali Państwo wiadomość odnośnie ogłoszenia umieszczonego w serwisie',
'_LANG_475' => 'Oświadczam, że zapoznałem się z',
'_LANG_476' => 'Pokazuj niezalogowanym użytkownikom',
'_LANG_477' => 'Nie pokazuj niezalogowanym użytkownikom',
'_LANG_478' => 'Pokaż niezalogowanym użykownikom adres w ogłoszeniach',
'_LANG_479' => 'Nie pokazuj niezalogowanym użytkownikom adresu w ogłoszeniach',
'_LANG_480' => 'Użytkownik/Firma',
'_LANG_481' => 'ilość ogłoszeń',
'_LANG_482' => 'ilość zdjęć na ogłoszenie',
'_LANG_483' => 'ilość podbić',
'_LANG_484' => 'ilość wyróżnień',
'_LANG_485' => 'Ogłoszenia',
'_LANG_486' => 'Podbicia',
'_LANG_487' => 'Wyróżnienia',
'_LANG_488' => 'Strona główna',
'_LANG_489' => 'dni',
'_LANG_490' => 'tygodni',
'_LANG_491' => 'Pozostało',
'_LANG_492' => 'ogłoszenie',
'_LANG_493' => 'podbicie',
'_LANG_494' => 'wyróżnienie',
'_LANG_495' => 'Data',
'_LANG_496' => 'Rodzaj abonamentu',
'_LANG_497' => 'Data aktywacji/zakończenia',
'_LANG_498' => 'Twoje aktywne abonamenty',
'_LANG_499' => 'Opisu',
'_LANG_500' => 'Dziękujemy za przesłanie zgłoszenia. Nasza obsługa zajmie się tym w możliwie krótkim czasie.',
'REPORT_SUBJECT' => 'Potwierdzenia przyjęcia zgłoszenia',
'USER_STATUS_0' => 'Niepotwierdzony',
'USER_STATUS_1' => 'Aktywny',
'USER_STATUS_2' => 'Zawieszony',
'USER_STATUS_3' => 'Usunięty',
'CHANGES_SAVED' => 'Zmiany zostały zapisane',
'WATCH_DELETED_ITEM' => 'Ogłoszenie zostało usunięte z obserwowanych.',
'WATCH_DELETED_USER' => 'Użytkownik został usunięty z obserwowanych.',
'MEMBER_NAME_EMPTY' => 'Brak',
'PROFILE_PHOTO_DELETED' => 'Zdjęcie zostało usunięte.',
'USER_UPDATED' => 'Zmiany zostały zapisane',
'USER_UPDATED_VERYFI' => 'Twoje konto wymaga ponownej weryfikacji',
'PASS_NO_INFO' => 'Brak informacji na temat takiego użytkownika',
'PASS_CHNG_TITLE' => 'Zmiana hasła',
'PASS_CHNG_INFO' => 'Prosimy teraz odebrać pocztę e-mail z linkiem umożliwiającym zmianę hasła.',
'PASS_CHNG_OK' => 'Hasło zostało zmienione, mogą się Państwo teraz zalogować do swojego konta.',
'EMPTY_LOGIN' => 'Prosimy uzupełnić nazwę użytkownika',
'EMPTY_PWD' => 'Prosimy uzupełnić hasło',
'LOGIN_BLOCK' => 'Możliwość logowania została zabokowana. Prosimy o logowanie za <strong>%d</strong> %s.',
'LOGIN_ERROR' => 'Login lub hasło nieprawidłowe.',
'STATUS_0' => 'Twoje konto nie zostało aktywowane. Prosimy o kliknięcie w link aktywacyjny otrzymany w emailu.',
'STATUS_2' => 'Twoje konto zostało zawieszone.',
'STATUS_3' => 'Twoje konto zostało usunięte.',
'PLEASELOGIN' => 'Prosimy się zalogować lub zarejestrować.',
'FRIENDS_DELETE' => 'Użytkownicy zostali usunięci z grona Twoich znajomych.',
'_LANG_0' => 'Wyślij',
'_LANG_1' => 'Wyślij',
'_LANG_2' => 'Ogłoszenie:',
'_LANG_3' => 'Wyślij wiadomość',
'_LANG_4' => 'O firmie:',
'_LANG_5' => 'Nazwa firmy:',
'_LANG_6' => 'Zobacz wszystkie oferty',
'_LANG_7' => 'Obserwuj tą firmę',
'_LANG_8' => 'Sprzedawca zweryfikowany',
'_LANG_9' => '(jak się zweryfikować)',
'_LANG_10' => 'Na portalu od:',
'_LANG_11' => 'NIP:',
'_LANG_12' => 'REGON:',
'_LANG_13' => 'Pełna nazwa sprzedawcy:',
'_LANG_14' => 'Kontakt',
'_LANG_15' => 'Telefon',
'_LANG_16' => 'E-mail',
'_LANG_17' => 'Tylko dla zalogowanych',
'_LANG_18' => 'Strona internetowa firmy',
'_LANG_19' => 'Tylko dla zalogowanych',
'_LANG_20' => 'Lokalizacja',
'_LANG_21' => 'ul.',
'_LANG_22' => 'Nazwa wystawiającego:',
'_LANG_23' => 'Opublikowane',
'_LANG_24' => 'Zgłoś nadużycie',
'_LANG_25' => 'Obserwuj:',
'_LANG_26' => 'Obserwuj',
'_LANG_27' => 'Ilość oferowana:',
'_LANG_28' => 'Jednostka:',
'_LANG_29' => 'Wynagrodzenie:',
'_LANG_30' => 'Możesz zmienić język',
'_LANG_31' => 'Multimedia',
'_LANG_32' => 'Galeria',
'_LANG_33' => 'Media społecznościowe',
'_LANG_34' => 'Oferty firmy',
'_LANG_35' => 'Zgłoszenie nadużycia',
'_LANG_37' => 'Użytkownik:',
'_LANG_38' => 'Ogłoszenie:',
'_LANG_39' => 'Powód zgłoszenia:',
'_LANG_40' => 'Wyślij',
'_LANG_41' => 'Wyślij wiadomość',
'_LANG_43' => 'Ogłoszenie:',
'_LANG_44' => 'Użytkownik:',
'_LANG_45' => 'Adres email',
'_LANG_46' => 'Imię i nazwisko',
'_LANG_47' => 'Treść wiadomości:',
'_LANG_48' => 'Wyślij',
'_LANG_49' => 'Krok',
'_LANG_50' => 'Podstawowe informacje',
'_LANG_51' => 'Wprowadź tytuł ogłoszenia',
'_LANG_53' => 'Wybierz kategorię',
'_LANG_54' => '-- wybierz --',
'_LANG_57' => 'Dodaj zdjęcie lub PDF do ogłoszenia',
'_LANG_58' => 'Dodane materiały:',
'_LANG_59' => 'Wynagrodzenie',
'_LANG_60' => 'Wybierz walutę',
'_LANG_61' => 'Podaj oferowaną ilość w danej cenie',
'_LANG_62' => 'Wybierz jednostkę miary',
'_LANG_63' => 'Krok',
'_LANG_64' => 'Dostępność',
'_LANG_65' => 'Czas publikacji',
'_LANG_66' => 'Twój abonament wygasa:',
'_LANG_67' => 'Nie posidasz aktywnego abonamentu',
'_LANG_68' => 'Możesz także zapisać ofertę, bez jej publikacji. Twoja oferta zostanie zapisana, jednak nie będzie widoczna na portalu. Będziesz mógł do niej wrócić z poziomu swojego panelu zarządzania',
'_LANG_69' => 'Chcę tylko zapisać ofertę, bez publikowania w tym momencie',
'_LANG_71' => 'Krok',
'_LANG_72' => 'Opis ogłoszenia',
'_LANG_73' => 'Opis ogłoszenia dla języka:',
'_LANG_74' => 'Język w jakich ogłoszenie ma się wyświetlić:',
'_LANG_77' => 'Dodaj opis swojego ogłoszenia dla języka:',
'_LANG_78' => 'Krok',
'_LANG_79' => 'Dodaj słowa kluczowe do swojego ogłoszenia',
'_LANG_80' => 'Czym są słowa kluczowe?',
'_LANG_81' => 'Słowa kluczowe dla języka:',
'_LANG_82' => 'Dodaj słowa kluczowe',
'_LANG_84' => 'Krok',
'_LANG_85' => 'Materiały video',
'_LANG_86' => 'URL YouTube',
'_LANG_87' => 'Dodaj +',
'_LANG_90' => 'Zapisz zmiany',
'_LANG_91' => 'Dodaj ogłoszenie',
'_LANG_92' => 'Kategoria',
'_LANG_95' => 'Kraj',
'_LANG_97' => 'Firma',
'_LANG_98' => 'wszyscy',
'_LANG_99' => 'zweryfikowany',
'_LANG_100' => 'niezweryfikowany',
'_LANG_101' => 'Język ogł.',
'_LANG_102' => 'Od najnowszych',
'_LANG_103' => 'Od najstarszych',
'_LANG_104' => 'Wynagrodzenie malejąco',
'_LANG_105' => 'Wynagrodzenie rosnąco',
'_LANG_107' => 'Brak ogłoszeń',
'_LANG_108' => 'Przeszukaj inną kategorię',
'_LANG_109' => 'Moje Konto',
'_LANG_110' => 'Logowanie',
'_LANG_111' => 'Rejestracja',
'_LANG_112' => 'międzynarodowy portal B2B',
'_LANG_113' => 'dedykowany dla branży',
'_LANG_114' => 'bursztynniczej i jubilerskiej',
'_LANG_226' => 'Potwierdź hasło',
'_LANG_227' => 'Logo profilu',
'_LANG_228' => 'Zmień hasło',
'_LANG_229' => 'Nazwa firmy',
'_LANG_230' => 'NIP',
'_LANG_231' => 'REGON',
'_LANG_232' => 'Miasto',
'_LANG_233' => 'Kod pocztowy',
'_LANG_234' => 'Ulica i numer',
'_LANG_237' => 'Wybierz kraj',
'_LANG_239' => 'Krok',
'_LANG_240' => 'Dane kontaktowe',
'_LANG_241' => 'Telefon',
'_LANG_242' => 'Dodaj +',
'_LANG_245' => 'Zapisane numery:',
'_LANG_246' => 'Kontakt dla:',
'_LANG_250' => 'Adres strony internetowej',
'_LANG_251' => 'Dodaj +',
'_LANG_254' => 'Zapisane adresy:',
'_LANG_255' => 'Krok',
'_LANG_256' => 'Opis firmy',
'_LANG_257' => 'Opis firmy dla języka:',
'_LANG_258' => 'Dodaj opis swojej firmy',
'_LANG_260' => 'Media społecznościowe',
'_LANG_261' => 'Facebook',
'_LANG_262' => 'Instagram',
'_LANG_264' => 'regulaminem',
'_LANG_266' => 'polityką prywatności',
'_LANG_267' => 'Zapisz zmiany',
'_LANG_268' => 'Usuń konto',
'_LANG_269' => 'Zmiana hasła',
'_LANG_271' => 'Obecne hasło',
'_LANG_272' => 'Nowe hasło',
'_LANG_273' => 'Potwierdź nowe hasło',
'_LANG_274' => 'Zapisz',
'_LANG_275' => 'Login:',
'_LANG_276' => 'Hasło:',
'_LANG_277' => 'Zaloguj',
'_LANG_278' => 'Nie pamiętam hasła',
'_LANG_279' => 'Wybierz pakiet i wykorzystaj w pełni możliwości serwisu!',
'_LANG_280' => 'Mam już abonament i chciałbym go przedłużyć',
'_LANG_281' => 'Mam już abonament, ale chciałbym zmnienić na inny pakiet',
'_LANG_282' => 'Pakiet',
'_LANG_283' => 'darmowy!',
'_LANG_284' => 'Okres:',
'_LANG_285' => 'zmień',
'_LANG_286' => 'Wybierz okres',
'_LANG_287' => 'miesięcy',
'_LANG_293' => 'Zamawiam',
'_LANG_294' => 'Inne pakiety',
'_LANG_295' => 'Rodzaj pakietu',
'_LANG_296' => 'Ilość',
'_LANG_297' => 'Czas',
'_LANG_298' => 'Cena',
'_LANG_301' => 'darmowy!',
'_LANG_302' => 'Zamawiam',
'_LANG_303' => 'Przedłużenie abonamentu',
'_LANG_305' => 'miesięcy',
'_LANG_307' => 'Zamawiam',
'_LANG_308' => 'Zmiana abonamentu',
'_LANG_310' => 'Pakiet',
'_LANG_311' => 'miesięcy',
'_LANG_313' => 'Zamawiam',
'_LANG_314' => 'Odzyskiwanie hasła',
'_LANG_315' => 'Wpisz swoje nowe hasło w polu ',
'_LANG_316' => 'Nowe hasło',
'_LANG_317' => ' oraz potwierdź, wpisując je ponownie w polu ',
'_LANG_318' => 'Potwierdź nowe hasło',
'_LANG_319' => ', następnie zatwierdź operację klikając w przycisk ',
'_LANG_320' => 'Zmień hasło',
'_LANG_322' => 'Nowe hasło:',
'_LANG_323' => 'Powtórz nowe hasło:',
'_LANG_324' => 'Zmień hasło',
'_LANG_325' => 'Wpisz swój adres email a następnie kliknij ',
'_LANG_326' => 'Odzyskaj hasło',
'_LANG_328' => 'Adres e-mail',
'_LANG_329' => 'Odzyskaj hasło',
'_LANG_330' => 'Trwa przekierowywanie do płatności',
'_LANG_331' => 'Potwierdzenie zamówienia',
'_LANG_332' => 'Rodzaj:',
'_LANG_333' => 'Zakup pakietu:',
'_LANG_334' => 'Kwota:',
'_LANG_339' => 'Zamawiam',
'_LANG_340' => 'Numer faktury',
'_LANG_341' => 'Suma',
'_LANG_342' => 'Data wystawienia',
'_LANG_343' => 'Pobierz',
'_LANG_344' => 'Brak wystawionych faktur',
'_LANG_345' => 'Podgląd wizytówki',
'_LANG_346' => 'Ilość odwiedzin:',
'_LANG_347' => 'Łącznie:',
'_LANG_348' => 'Ostatnie 30 dni:',
'_LANG_349' => 'Dodaj zdjęcie firmy',
'_LANG_350' => 'Dodane zdjęcia:',
'_LANG_351' => 'Ustawienia profilu',
'_LANG_408' => 'Usuń konto',
'_LANG_409' => 'Zapisz zmiany',
'_LANG_410' => 'Edycja danych',
'_LANG_412' => 'Obecne hasło:',
'_LANG_413' => 'Nowe hasło:',
'_LANG_115' => 'Obserwowane',
'_LANG_116' => 'Dodaj ogłoszenie',
'_LANG_117' => 'dni',
'_LANG_118' => 'szczegóły',
'_LANG_119' => 'Szukaj',
'_LANG_120' => 'Wyszukiwarka szczegółowa',
'_LANG_121' => 'Pokaż wszystkie',
'_LANG_122' => 'Zobacz jak działa nasz portal',
'_LANG_123' => '',
'_LANG_124' => 'Wstecz',
'_LANG_125' => 'Dalej',
'_LANG_126' => 'Baza firm',
'_LANG_127' => 'Całkowicie darmowo!',
'_LANG_128' => 'Szukaj pracodawcy',
'_LANG_129' => 'Ogłoszenia promowane',
'_LANG_130' => 'Warto wiedzieć',
'_LANG_131' => 'Wróć do listy',
'_LANG_132' => 'Aktualności',
'_LANG_133' => 'Przerwa techniczna',
'_LANG_134' => 'Przerwa techniczna',
'_LANG_135' => 'Trwa aktualizacja serwisu. Prosimy spróbować później.',
'_LANG_136' => 'Za powstałe utrudnienia przepraszamy.',
'_LANG_137' => 'Wstecz',
'_LANG_138' => 'Dalej',
'_LANG_139' => 'menu konta',
'_LANG_140' => 'Strona Główna',
'_LANG_149' => 'Strona główna',
'_LANG_150' => 'Aktualności',
'_LANG_151' => 'Pomoc',
'_LANG_152' => '&copy; Wszelkie prawa zastrzeżone dla',
'_LANG_153' => 'Kontakt',
'_LANG_154' => 'Dołącz do firm',
'_LANG_155' => 'contact@email.com',
'_LANG_156' => 'Artykuły zamieszczone na stronie są chronione prawami autorskimi.',
'_LANG_157' => 'Kopiowanie oraz używanie bez pisemnej zgody redakcji jest zabronione.',
'_LANG_158' => 'Wszelkie prawa zastrzeżone.',
'_LANG_159' => 'OgłoszeniaOnLine',
'_LANG_160' => 'Wpisz nazwę stanowiska',
'_LANG_161' => 'Moje Konto',
'_LANG_162' => 'Zaloguj',
'_LANG_163' => 'Załóż darmowe konto',
'_LANG_164' => 'Dodaj ogłoszenie',
'_LANG_165' => 'Imię',
'_LANG_166' => 'Imię partnera',
'_LANG_167' => 'Miejscowość',
'_LANG_168' => 'Zapisz',
'_LANG_189' => 'Wiadomość',
'_LANG_190' => 'Obserwuj',
'_LANG_191' => 'Zobacz',
'_LANG_192' => 'Firma: zweryfikowana',
'_LANG_193' => 'Wyślij wiadomość',
'_LANG_195' => 'Ogłoszenie:',
'_LANG_196' => 'Firma:',
'_LANG_197' => 'Adres email',
'_LANG_198' => 'Imię / Nazwa firmy',
'_LANG_199' => 'Treść wiadomości:',
'_LANG_200' => 'Wyślij',
'_LANG_201' => 'Czytaj więcej',
'_LANG_202' => 'Moje Konto',
'_LANG_203' => 'Jesteś zalogowany jako:',
'_LANG_204' => 'Wyloguj',
'_LANG_205' => 'Twój plan taryfowy:',
'_LANG_206' => 'Zmień',
'_LANG_207' => 'Pakiet wygasa',
'_LANG_208' => 'Zweryfikuj swoją firmę i zyskaj status:',
'_LANG_209' => 'Firma zweryfikowana',
'_LANG_210' => 'Firma niezweryfikowana',
'_LANG_211' => 'Weryfikuj',
'_LANG_212' => 'Menu konta',
'_LANG_213' => 'Moje dane',
'_LANG_214' => 'Moje ogłoszenia',
'_LANG_215' => 'Dodaj ogłoszenie',
'_LANG_216' => 'Abonament',
'_LANG_217' => 'Płatności / FV',
'_LANG_218' => 'Obserwowane',
'_LANG_219' => 'Moja wizytówka',
'_LANG_220' => 'Krok',
'_LANG_221' => 'Dane podstawowe',
'_LANG_222' => 'Nazwa użytkownika',
'_LANG_224' => 'Adres e-mail',
'_LANG_225' => 'Hasło',
'_LANG_501' => 'Wprowadź kod rabatowy',
'_LANG_502' => 'Kod promocyjny',
'_LANG_503' => 'Jeżeli posiadasz kod rabatowy, prosimy o jego podanie w poniższym polu aby doliczyć ewentualny rabat do Państwa zakupów.',
'_LANG_504' => 'Kod',
'_LANG_505' => 'Zapisz kod',
'_LANG_506' => 'Zapisane kody',
'_LANG_507' => 'Rabat',
'_LANG_508' => 'Data ważności',
'_LANG_509' => 'Wykorzystany',
'_LANG_510' => 'Lista pracodawców',
'_LANG_511' => 'Pomoc',
'_LANG_512' => 'Do uzgodnienia',
'_LANG_513' => 'Znajdź firmę w Twojej okolicy.',
'_LANG_514' => 'Dodaj ogłoszenie zupełnie za darmo!',
'_LANG_515' => 'Promowanie',
'_LANG_516' => 'Pogrubienie',
'_LANG_517' => 'Pogrubimy tytuł Twojej oferty na liście ofert pracy.',
'_LANG_518' => 'Cena',
'_LANG_519' => '',
'_LANG_520' => 'Podświetlenie',
'_LANG_521' => 'Podświetlimy Twoją ofertę na liście ofert pracy.',
'_LANG_522' => 'Wyróżnienie',
'_LANG_523' => 'Twoją ofertę pokażemy na początku listy ofert pracy.',
'_LANG_524' => 'Strona Główna',
'_LANG_525' => 'Twoją ofertę pokażemy na stronie głównej serwisu.',
'_LANG_526' => 'Konto zwykłe',
'_LANG_527' => 'Konto firmowe',
'_LANG_528' => 'Ogłoszeniodawca',
'_LANG_529' => 'Pokaż',
'_LANG_530' => 'Ofert',
'_LANG_531' => 'godz.',
'_LANG_532' => 'min.',
'_LANG_533' => 'Zakończona',
'_LANG_534' => 'Poniżej minuty',
'_LANG_535' => 'dni',
'_LANG_536' => 'dzień',
'_LANG_537' => 'Dodano',
'_LANG_538' => 'Potwierdzenie złożenie oferty',
'_LANG_539' => 'Potwierdzenie złożenie oferty w zleceniu - poniżej znajdują się szczegóły dotyczące oferty.',
'_LANG_540' => 'Nazwa',
'_LANG_541' => 'Oferta',
'_LANG_542' => 'Data złożenia oferty',
'_LANG_543' => 'Zakończenie ogłoszenia',
'_LANG_544' => 'Kontakt z obsługą Użytkowników',
'_LANG_545' => 'Do uzgodnienia',
'_LANG_546' => 'Oferty pracy',
'_LANG_547' => 'Szukasz czegoś?',
'_LANG_548' => 'Przeglądaj dostępne ogłoszenia',
'_LANG_549' => 'Oferty pracy',
'_LANG_550' => 'Ładowanie zdjęcia...',
'_LANG_551' => 'Ładowanie formularza...',
'_LANG_552' => 'od',
'_LANG_553' => 'do',
'_LANG_554' => 'Wyrażam zgodę na przetwarzanie moich danych osobowych w celu udzielenia odpowiedzi, w tym przedłożenia oferty jeśli o nią pytam.',
'_LANG_555' => 'Złóż ofertę realizacji zlecenia',
'_LANG_556' => 'Aby złożyć ofertę, prosimy się',
'_LANG_557' => 'zalogować',
'_LANG_558' => 'Aby złożyć ofertę, prosimy aktywować',
'_LANG_559' => 'abonament',
'_LANG_560' => 'Kategorie działalności',
'_LANG_561' => 'Nie znaleziono strony',
'_LANG_562' => 'Zamawiam i płacę',
'_LANG_563' => 'Rezygnuję',
'_LANG_564' => 'Opłata za ogłoszenie',
'_LANG_565' => 'Start',
'_LANG_566' => 'Najnowsze ogłoszenia',
'_LANG_567' => 'Dodaj firmę',
'_LANG_568' => 'Subskrypcja',
'_LANG_569' => 'Adres e-mail',
'_LANG_570' => 'Zapisz',
'_LANG_571' => 'Nieuzupełnione pole wynagrodzenia zostanie określone jako "Do uzgodnienia"',
'_LANG_572' => 'Poczta',
'_LANG_573' => 'dni temu',
'_LANG_574' => 'dzień temu',
'_LANG_575' => 'Nie dodałeś jeszcze żadnego ogłoszenia',
'_LANG_576' => 'Dodaj ogłoszenie',
'_LANG_577' => 'Nadawca',
'_LANG_578' => 'Rodzaj umowy',
'_LANG_579' => 'Region',
'_LANG_580' => 'Alfabetycznie',
'_LANG_581' => 'Maksymalna iloś zdjęć',
'_LANG_582' => 'wybierz opcję',
'_LANG_583' => 'Oświadczam, że zapoznałem się i akceptuję',
'_LANG_584' => 'REGULAMIN',
'_LANG_585' => 'serwisu',
'_LANG_586' => 'Akceptuję przetwarzanie moich danych osobowych zgodnie z',
'_LANG_587' => 'POLITYKĄ PRYWATNOŚCI',
'_LANG_588' => 'Twoje konto zostało aktywowane.',
'_LANG_589' => 'Min 6 znaków, duże i małe litery, cyfry lub znaki specjalne',
'_LANG_590' => 'Kategorie',
'_LANG_591' => 'Oferty pracy tej firmy',
'_LANG_592' => 'CV',
'_LANG_593' => 'Przed chwilą',
'_LANG_594' => 'Inne oferty',
'_LANG_595' => 'Zdjęcie',
'_LANG_596' => 'Plik PDF',
'_LANG_597' => 'Wakaty',
'_LANG_598' => 'Nowe',
'_LANG_599' => 'Miesięcznie',
/*'_LANG_560' => 'Zobacz ofertę',
'_LANG_561' => 'Najlepsze firmy',
'_LANG_562' => 'Zatrudniaj się w najlepszych firmach',
'_LANG_563' => 'Aplikuj',
'_LANG_564' => 'Przydatne linki',
'_LANG_565' => 'Wszystkie kategorie',
'_LANG_567' => 'Wybierz swoją kategorię',
'_LANG_568' => 'Mamy',
'_LANG_569' => 'Ofert Pracy',
'_LANG_570' => 'Znajdź',
'_LANG_571' => 'pracę',
'_LANG_572' => 'pasującą do Twojego życia',
'_LANG_573' => 'Wpisz wyszukiwaną frazę i kliknij szukaj aby znaleźć idealną pracę.',
'_LANG_574' => 'Proces rekrutacji',
'_LANG_575' => 'Jak to działa',
'_LANG_576' => 'Zarejestruj',
'_LANG_577' => 'Konto',
'_LANG_578' => 'Załóż konto aby znaleźć najelpszą pracę dla Ciebie.',
'_LANG_579' => 'Aplikuj',
'_LANG_580' => 'Na Wybrane Stanowisko',
'_LANG_581' => 'Dodaj',
'_LANG_582' => 'Swoje CV',*/
'_LANG_600' => 'Sortuj',

'_LANG_797' => 'Doładowanie konta',
'_LANG_798' => 'Kwota doładowania:',
'_LANG_799' => 'Doładuj konto',
'_LANG_800' => 'Aktualny stan konta:',

'MSG_ADD_OFFER_SUBJECT_CONFIRM' => 'Potwierdzenie złożenia oferty',
'ITEM_OFFER_ADD' => 'Oferta została dodana',
'ITEM_OFFER_EDIT' => 'Oferta została zaktualizowana',
'PWD_INCORRECT' => 'Nieprawidłowy login lub hasło użytkownika',
'PWD_NEW_INCORRECT' => 'Podane hasła nie są takie same',
'CHARGE_PROMO_ADDED' => 'Promowanie profilu',
'NO_ENOUGH_MONEY' => 'Nie posiadasz wystarczającej ilości kredytów',
'PASS_CHNG_ERROR' => 'Przepraszamy, brak info na temat takiego użytkownika lub nieprawidłowy token.',
'PASS_CHNG_PASS' => 'Podane hasła różnią się od siebie.',
'PASS_CHNG_UPDATE_ERROR' => 'Nie można uaktualnić wpisu użytkownika. Prosimy skontaktować się z obsługą.',
'DATA_REQUIRED' => 'Prosimy uzupełnić niezbędne dane: (nazwa firmy, adres, nip, regon)',
'VARYFI_SAVED' => 'Wniosek został przekazany do weryfikacji przez naszą obsługę.',
'MONTH_1' => 'miesiąc',
'MONTH_2' => 'miesiące',
'MONTH_5' => 'miesięcy',
'PAYMENT_SAVE' => 'Wybrany pakiet został aktywowany',
'REGISTER_END' => 'Konto nowego użytkownika zostało utworzone<br />Wysłaliśmy do Ciebie e-mail z linkiem aktywującym Twoje konto.',
'EMAILACTIVATETITLE' => 'Aktywacja konta nowego użytkownika',
'ACTIVATE_EMPTY_DATA' => 'Brak użytkownika w bazie z takimi danymi lub konto zostało już aktywowane.',
'USER_CHECK_EMAIL' => 'Podany adres jest już zarejestrowany w naszym serwisie',
'USER_CHECK_EMAIL2' => 'Podany adres email jest niepoprawny',
'USER_CHECK_NAME' => 'Podana nazwa użytkownika jest już zarejestrowana.',
'USERNAME_FREE' => 'Ta nazwa jest dostępna',
'EMAIL_ERROR' => 'Nieprawidłowy adres e-mail',
'CONTACT_TITLE' => 'Kontakt',
'MESSAGE_SEND' => 'Wiadomość została wysłana',
'REPORT_SEND' => 'Dziękujemy za zgłoszenie',
'MSG_SEND' => 'Wiadomość została wysłana',
'MSG_SUBJECT' => 'Wiadomość odnośnie ogłoszenia',
'ITEM_ADD' => 'Ogłoszenie zostało dodane.',
'ITEM_UPDATE' => 'Zmiany zostały zapisane.',
'WATCH_ADDED_ITEM' => 'Ogłoszenie zostało dodane do obserwowanych',
'WATCH_ADDED_USER' => 'Użytkownik został dodany do obserwowanych',
'ITEM_DELETED' => 'Ogłoszenie zostało usunięte',
'ITEM_SHOW' => 'Ogłoszenie zostało ukryte',
'ITEM_HIDE' => 'Ogłoszenie zostało opublikowane',
'ITEM_UNACTIVE' => 'Ogłoszenie jest nieaktualne',
'ITEM_DISTINCTION' => 'Ogłoszenie zostało wyróżnione',
'ITEM_BIDS' => 'Ogłoszenie zostało podbite',
'PROFILE_EMPTY' => 'Nie znaleziono profilu.',
'MEMBER_EMPTY' => 'Twój abonament nie posiada możliwości wykonania tej operacji. <a href="funcs.php?name=user&amp;file=member"><strong>Wykup większy abonament</strong></a>.',
'PERMISSION_LOGIN' => 'Proszę założyć konto użytkownika, a następnie zalogować się do portalu, aby rozpocząć dodawanie ogłoszeń lub przeglądanie ofert pracy.',
'PERMISSION_MEMBER' => 'Aby dodać ogłoszenie należy posiadać aktywny abonament',
'ADD_EMPTY_CAT' => 'Prosimy wybrać kategorię',
'ADD_EMPTY_LANGS' => 'Prosimy wybrać języki ogłoszenia',
'ADD_EMPTY_TITLE' => 'Prosimy uzupełnić tytuł',
'ADD_EMPTY_DESC' => 'Prosimy uzupełnić opis',
'ADD_EMPTY_PRICE' => 'Prosimy uzupełnić cenę',
'ADD_EMPTY_QTY' => 'Prosimy uzupełnić ilość',
'WATCH_USER_USER' => 'Nie możesz dodać własnego ogłoszenia/profilu do obserwowanych',
'MUST_LOGIN' => 'Prosimy się zalogować',
'ERROR_CAPTCHA' => 'Prosimy poprawnie uzupełnić reCaptche',
'ITEM_DEACTIVE' => 'Twoje ogłoszenie zostało dezaktywowane',
'ADD_USER_DATA' => 'Prosimy uzupełnić wymagane dane (nazwa firmy, NIP, adres, miejscowość oraz kod pocztowy).',
'EMAIL_REMINDER_TITLE' => 'Przypomnienie o zbliżającym się terminie ważności abonamentu',
'EMAIL_REMINDER_TEXT' => 'Przypominamy o kończączącej się ważności Państwa abonamentu. Aby zapewnić ciągłość prezentacji Pańtwa oferty, prosimy o odnowienie abonamentu.',
'PROMO_CODE_USED' => 'Kod rabatowy został już wykorzystany lub stracił ważność',
'PROMO_CODE_EMPTY' => 'Prosimy podać kod rabatowy',
'PROMO_CODE_SAVED' => 'Kod rabatowy został zapisany',
'EMPTY_UTYPE_DATA' => 'Prosimy uzupełnić wymagane dane',
'EMAIL_ITEM_UNACTIVE' => 'Przedłuż swoje ogłoszenie:'
);
