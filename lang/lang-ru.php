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
'_LANG_115' => 'Наблюдаемые',
'_LANG_116' => 'Дай объявление',
'_LANG_117' => 'дни',
'_LANG_118' => 'подробности',
'_LANG_119' => 'Ищи',
'_LANG_120' => 'Поисковая система с подробной информацией',
'_LANG_121' => 'Покажи все',
'_LANG_122' => 'Посмотри, как работает наш сайт',
'_LANG_123' => 'Не упустите лучших предложений',
'_LANG_124' => 'Назад',
'_LANG_125' => 'Далее',
'_LANG_126' => 'Вы ищите что-нибудь конкретное?',
'_LANG_127' => 'Добавь объявление и найди поставщика!',
'_LANG_128' => 'Ищи поставщика',
'_LANG_129' => 'Акционные предложения',
'_LANG_130' => 'Отраслевые новости',
'_LANG_131' => 'Вернись к списку',
'_LANG_132' => 'Новости',
'_LANG_133' => 'Технический перерыв',
'_LANG_134' => 'Технический перерыв',
'_LANG_135' => 'Обновление системы. Попробуйте позднее.',
'_LANG_136' => 'Приносим извинения за доставленные неудобства.',
'_LANG_137' => 'Назад',
'_LANG_138' => 'Далее',
'_LANG_139' => 'меню аккаунта',
'_LANG_140' => 'Главная Страница',
'_LANG_149' => 'Главная страница',
'_LANG_150' => 'Новости',
'_LANG_151' => 'Помощь',
'_LANG_152' => '&copy; Все права защищены',
'_LANG_153' => 'Контакт',
'_LANG_154' => 'Присоединись к продавцам',
'_LANG_155' => 'email@email.com',
'_LANG_156' => 'Статьи размещенные на сайте, защищены авторскими правами.',
'_LANG_157' => 'Копирование и использование без письменного согласия редакции воспрещено.',
'_LANG_158' => 'Copyright © 2018 JMLnet Все права защищены.',
'_LANG_159' => 'OnLine заказы',
'_LANG_160' => 'Ищи',
'_LANG_161' => 'мой аккаунт',
'_LANG_162' => 'Вход в систему',
'_LANG_163' => 'Создай бесплатный аккаунт',
'_LANG_164' => 'Дай объявление',
'_LANG_165' => 'Имя',
'_LANG_166' => 'Имя ...',
'_LANG_167' => 'Местность',
'_LANG_168' => 'Сохранить',
'_LANG_169' => 'Имя продавца',
'_LANG_170' => 'Продавец: проверенный',
'_LANG_171' => 'Описание объявления доступно на языке:',
'_LANG_172' => 'Идет проверка',
'_LANG_173' => 'Недействующий',
'_LANG_174' => 'Неопубликованный',
'_LANG_175' => 'Имя продавца',
'_LANG_176' => 'Продавец: проверенный',
'_LANG_177' => 'Описание объявления доступно на языке:',
'_LANG_178' => 'Дата выствления:',
'_LANG_180' => 'Количество посещений:',
'_LANG_181' => 'Посмотри',
'_LANG_182' => 'Удалите',
'_LANG_183' => 'Корректировка',
'_LANG_184' => 'Публикуй',
'_LANG_185' => 'Скрытый',
'_LANG_186' => 'Добавь выделить',
'_LANG_187' => 'Обнови объявлениe',
'_LANG_188' => 'Закончите наблюдение',
'_LANG_189' => 'Сообщение',
'_LANG_190' => 'Наблюдай',
'_LANG_191' => 'Посмотри',
'_LANG_192' => 'Продавец: проверенный',
'_LANG_193' => 'Отправь сообщение',
'_LANG_195' => 'Объявление:',
'_LANG_196' => 'Продавец:',
'_LANG_197' => 'Адрес электронной почты:',
'_LANG_198' => 'Имя/Название компании',
'_LANG_199' => 'Содержание сообщения::',
'_LANG_200' => 'Отправь',
'_LANG_201' => 'Прочтите все…',
'_LANG_202' => 'мойAmberContact',
'_LANG_203' => 'Вы авторизировались как:',
'_LANG_204' => 'Выйдите из системы',
'_LANG_205' => 'Ваш тарифный план:',
'_LANG_206' => 'Измените',
'_LANG_207' => 'Пакет заканчивается',
'_LANG_208' => 'Подтвердите свою компанию и получи статус:',
'_LANG_209' => 'Проверенный продавец',
'_LANG_210' => 'Непроверенный продавец',
'_LANG_211' => 'Подтвердите',
'_LANG_212' => 'Управление аккаунтом',
'_LANG_213' => 'Мои данные',
'_LANG_214' => 'Мои объявления',
'_LANG_215' => 'Дай объявление',
'_LANG_216' => 'Абонементы',
'_LANG_217' => 'Платежи/счет-фактура',
'_LANG_218' => 'Наблюдаемые',
'_LANG_219' => 'Моя визитка',
'_LANG_220' => 'Шаг',
'_LANG_221' => 'Основные данные',
'_LANG_222' => 'Выберите название Вашего аккаунта',
'_LANG_224' => 'Укажите адрес электронной почты',
'_LANG_225' => 'Укажите пароль',
'_LANG_0' => 'Отправь',
'_LANG_1' => 'Отправь',
'_LANG_2' => 'Объявление:',
'_LANG_3' => 'Отправь сообщение продавцу',
'_LANG_4' => 'О продавце:',
'_LANG_5' => 'Имя продавца:',
'_LANG_6' => 'Посмотри все предложения продавца',
'_LANG_7' => 'Наблюдай объявления этого продавца',
'_LANG_8' => 'Проверенный продавец',
'_LANG_9' => '(как проверить свои данные)',
'_LANG_10' => 'На сайте от:',
'_LANG_11' => 'NIP:',
'_LANG_12' => 'КПП:',
'_LANG_13' => 'Полное название продавца:',
'_LANG_14' => 'Контакт',
'_LANG_15' => 'Телефон',
'_LANG_16' => 'Адрес электронной почты:',
'_LANG_17' => 'Только для авторизированных',
'_LANG_18' => 'Интернет-сайт продавца',
'_LANG_19' => 'Только для авторизированных',
'_LANG_20' => 'Локализация',
'_LANG_21' => 'ул.',
'_LANG_22' => 'Название продавца:',
'_LANG_23' => 'Опубликовано',
'_LANG_24' => 'Заявите о нарушениях',
'_LANG_25' => 'Наблюдай:',
'_LANG_26' => 'Наблюдай',
'_LANG_27' => 'Предлагаемое количество:',
'_LANG_28' => 'Единица:',
'_LANG_29' => 'Цена:',
'_LANG_30' => 'Вы можете поменять язык',
'_LANG_31' => 'Мультимедия',
'_LANG_32' => 'Фотографии',
'_LANG_33' => 'Социальные сети',
'_LANG_34' => 'Предложения продавца',
'_LANG_35' => 'Заявление о нарушениях',
'_LANG_37' => 'Пользователь:',
'_LANG_38' => 'Объявление:',
'_LANG_39' => 'Причина заявления:',
'_LANG_40' => 'Отправь',
'_LANG_41' => 'Отправь сообщение',
'_LANG_43' => 'Объявление:',
'_LANG_44' => 'Продавец:',
'_LANG_45' => 'Адрес электронной почты:',
'_LANG_46' => 'Имя/Название компании',
'_LANG_47' => 'Содержание сообщения::',
'_LANG_48' => 'Отправь',
'_LANG_49' => 'Шаг',
'_LANG_50' => 'Основная иформация о предложении',
'_LANG_51' => 'Введите заголовок предложения в избранный язык',
'_LANG_53' => 'Выберите категорию',
'_LANG_54' => '-- выбери --',
'_LANG_57' => 'Добавь фотографии в объявление',
'_LANG_58' => 'Добавь фотографии:',
'_LANG_59' => 'Укажите цену',
'_LANG_60' => 'Выберите валюту',
'_LANG_61' => 'Укажите предлагаемое количество за указанную цену',
'_LANG_62' => 'Выберите единицу измерения',
'_LANG_63' => 'Шаг',
'_LANG_64' => 'Доступность',
'_LANG_65' => 'Опубликуй предложение',
'_LANG_66' => 'Срок действия Вашей подписки заканчивается:',
'_LANG_67' => 'У Вас нет действующей подписки',
'_LANG_68' => 'Вы можете также записать предложение, без его публикации. Ваше предложение будет сохранено, но не будет отображаться на сайте. Вы сможете вернуться к нему с уровня своего личного кабинета.',
'_LANG_69' => 'Я хочу сохранить объявление, но не давать в данный момент.',
'_LANG_71' => 'Шаг',
'_LANG_72' => 'Описание объявления',
'_LANG_73' => 'Описание объявления на языке:',
'_LANG_74' => 'Выберите языки для Вашего объявления:',
'_LANG_77' => 'Добавь описание своего объявления для языка:',
'_LANG_78' => 'Шаг',
'_LANG_79' => 'Добавь ключевые слова для своего объявления',
'_LANG_80' => 'Что такое ключевые слова?',
'_LANG_81' => 'Ключевые слова для языка:',
'_LANG_82' => 'Добавь ключевые слова',
'_LANG_84' => 'Шаг',
'_LANG_85' => 'Видеоматериалы',
'_LANG_86' => 'URL YouTube',
'_LANG_87' => 'Добавь +',
'_LANG_90' => 'Сохрани изменения',
'_LANG_91' => 'Сохранить',
'_LANG_92' => 'Категория',
'_LANG_95' => 'Страна',
'_LANG_97' => 'Продавец: проверенный',
'_LANG_98' => 'все',
'_LANG_99' => 'проверенный',
'_LANG_100' => 'неподтвержденный',
'_LANG_101' => 'Язык объявления',
'_LANG_102' => 'Самые новые',
'_LANG_103' => 'Самые старые',
'_LANG_104' => 'Самые дорогие',
'_LANG_105' => 'Самые дешевые',
'_LANG_107' => 'Нет объявлений',
'_LANG_108' => 'Просмотрите другую категорию',
'_LANG_109' => 'мойAmberContact',
'_LANG_110' => 'Вход в систему',
'_LANG_111' => 'Создай бесплатный аккаунт',
'_LANG_112' => 'международный сайт В2В',
'_LANG_113' => 'для отрасли',
'_LANG_114' => 'янтарной и ювелирной',
'_LANG_226' => 'Подтвердите новый пароль',
'_LANG_227' => 'Выберите логотип для Вашего профиля',
'_LANG_228' => 'Измените пароль',
'_LANG_229' => 'Укажите название компании',
'_LANG_230' => 'ИНН',
'_LANG_231' => 'КПП',
'_LANG_232' => 'Город',
'_LANG_233' => 'Почтовый индекс',
'_LANG_234' => 'Улица и номер',
'_LANG_237' => 'Выберите страну',
'_LANG_239' => 'Шаг',
'_LANG_240' => 'Контактные данные',
'_LANG_241' => 'Телефон',
'_LANG_242' => 'Добавь +',
'_LANG_245' => 'Сохраненные номера:',
'_LANG_246' => 'Контакт для:',
'_LANG_250' => 'Адрес интернет-сайта',
'_LANG_251' => 'Добавь +',
'_LANG_254' => 'Сохраненные адреса:',
'_LANG_255' => 'Шаг',
'_LANG_256' => 'Информация о компании',
'_LANG_257' => 'Информация о компании на языках:',
'_LANG_258' => 'Добавь информацию о своей компании',
'_LANG_260' => 'Социальные сети',
'_LANG_261' => 'Facebook',
'_LANG_262' => 'Instagram',
'_LANG_264' => 'регламентом',
'_LANG_266' => 'политикой конфиденциальности',
'_LANG_267' => 'Сохрани изменения',
'_LANG_268' => 'Удалите аккаунт',
'_LANG_269' => 'Изменение пароля',
'_LANG_271' => 'Актуальный пароль',
'_LANG_272' => 'Новый пароль',
'_LANG_273' => 'Подтвердите новый пароль',
'_LANG_274' => 'Сохранить',
'_LANG_275' => 'Логин:',
'_LANG_276' => 'Пароль:',
'_LANG_277' => 'Вход в систему',
'_LANG_278' => 'Забыл пароль',
'_LANG_279' => 'Выберите свой пакет и пользуйтесь полным потенциалом нашего сайта!',
'_LANG_280' => 'У меня уже есть подписка и я хочу ее продлить',
'_LANG_281' => 'У меня уже есть подписка, но я хочу ее поменять на другой пакет',
'_LANG_282' => 'Пакет',
'_LANG_283' => 'бесплатный!',
'_LANG_284' => 'Период:',
'_LANG_285' => 'Измените',
'_LANG_286' => 'Выберите период',
'_LANG_287' => 'месяцев',
'_LANG_293' => 'Заказываю',
'_LANG_294' => 'Другие пакеты',
'_LANG_295' => 'Вид пакета',
'_LANG_296' => 'Количество',
'_LANG_297' => 'Время',
'_LANG_298' => 'Цена',
'_LANG_301' => 'бесплатный!',
'_LANG_302' => 'Заказываю',
'_LANG_303' => 'Продление срока подписки',
'_LANG_305' => 'месяцев',
'_LANG_307' => 'Заказываю',
'_LANG_308' => 'Изменение подписки',
'_LANG_310' => 'Пакет',
'_LANG_311' => 'месяцев',
'_LANG_313' => 'Заказываю',
'_LANG_314' => 'Восстановление пароля',
'_LANG_315' => 'Впишите Ваш новый пароль в ячейку ',
'_LANG_316' => 'Новый пароль',
'_LANG_317' => ' и подтвердите, записывая их повторно в ячейке ',
'_LANG_318' => 'Подтвердите новый пароль',
'_LANG_319' => ', подтвердите операцию, нажимая клавишу ',
'_LANG_320' => 'Измените пароль',
'_LANG_322' => 'Новый пароль:',
'_LANG_323' => 'Укажите повторно новый пароль:',
'_LANG_324' => 'Измените пароль',
'_LANG_325' => 'Впишите адрес Вашей электронной почты и нажмите ',
'_LANG_326' => 'Восстанови пароль',
'_LANG_328' => 'Адрес электронной почты',
'_LANG_329' => 'Восстанови пароль',
'_LANG_330' => 'Идет перенаправление на платеж',
'_LANG_331' => 'Подтверждение заказа',
'_LANG_332' => 'Вид:',
'_LANG_333' => 'Покупка пакета:',
'_LANG_334' => 'Сумма:',
'_LANG_339' => 'Заказываю',
'_LANG_340' => 'Номер счета-фактуры',
'_LANG_341' => 'Сумма',
'_LANG_342' => 'Дата выставления',
'_LANG_343' => 'Скачай',
'_LANG_344' => 'Нет выставленных счетов-фактур',
'_LANG_345' => 'Просмотр визитки',
'_LANG_346' => 'Количество посещений:',
'_LANG_347' => 'Сумма:',
'_LANG_348' => 'Последние 30 дней:',
'_LANG_349' => 'Добавь логотип компании',
'_LANG_350' => 'Добавь фотографии:',
'_LANG_351' => 'Установки профиля',
'_LANG_408' => 'Удалите аккаунт',
'_LANG_409' => 'Сохрани изменения',
'_LANG_410' => 'Корректировка данных',
'_LANG_412' => 'Актуальный пароль:',
'_LANG_413' => 'Новый пароль:',
'_LANG_414' => 'Укажите повторно новый пароль:',
'_LANG_415' => 'Сохрани изменения',
'_LANG_416' => 'Удаление аккаунта',
'_LANG_418' => 'Ты уверен/а, что хочешь удалить свой аккаунт?',
'_LANG_419' => 'Нет',
'_LANG_420' => 'Да',
'_LANG_421' => 'Подтверждение пользователя',
'_LANG_422' => 'Ваш аккаунт прошел успешно подтверждение.',
'_LANG_423' => 'Ваше заявление ожидает на подтверждение.',
'_LANG_424' => 'Для получения статуса \'подтвержденный\' необходимо передать регистрационные документы компании.',
'_LANG_425' => 'Приложения:',
'_LANG_426' => 'Замечания:',
'_LANG_427' => 'Отправь',
'_LANG_428' => 'Объявления',
'_LANG_429' => 'Продавцы',
'_LANG_430' => 'Категории',
'_LANG_431' => 'Предложения продавца',
'_LANG_433' => 'Страна:',
'_LANG_434' => 'количество объявлений:',
'_LANG_435' => 'Объявления продавца',
'_LANG_436' => 'Визитка продавца',
'_LANG_437' => 'Закончите наблюдение',
'_LANG_440' => 'Удалите из наблюдаемых',
'_LANG_441' => 'Наблюдай',
'_LANG_443' => 'Удалите из наблюдаемых',
'_LANG_444' => 'Наблюдай',
'_LANG_445' => 'Выберите наблюдаемого продавца',
'_LANG_446' => '--выбери--',
'_LANG_448' => 'Закончите наблюдение',
'_LANG_449' => 'Здесь впишите нужную фразу',
'_LANG_450' => 'Адрес электронной почты:',
'_LANG_451' => 'Имя пользователя:',
'_LANG_452' => '(ID:)',
'_LANG_453' => 'Имя:',
'_LANG_454' => 'Сообщение:',
'_LANG_457' => 'Сообщение к объявлению',
'_LANG_458' => 'Сообщение:',
'_LANG_459' => ' но у вас нет действующей подписки. Просим обновить подписку для разблокировки сообщений.',
'_LANG_461' => 'Ссылка для активизации нового пароля',
'_LANG_462' => 'Ссылка для активизации нового пароля для аккаунта',
'_LANG_463' => 'По этой ссылке Вы сможете поменять пароль на сайте.',
'_LANG_464' => 'Приветствуем на сайте',
'_LANG_465' => 'Для окончания процесса регистрации необходимо перейти по нижеуказанной ссылке в течении ближайших 24 часов и активизировать новый аккаунт, в противном случае данные будут автоматически удалены из системы и вам придется повторно пройти процесс регистрации:',
'_LANG_466' => 'Полезная информация:',
'_LANG_467' => 'Если Вы нуждаетесь в помощи или у Вас есть какие-либо сомнения, ответьте на данное сообщение.',
'_LANG_468' => 'Здравствуй!',
'_LANG_469' => 'Ваш аккаунт на сайте был',
'_LANG_471' => 'Аккаунт был заблокирован из-за нарушения правил пользования сервисом.',
'_LANG_472' => 'Полезная информация:',
'_LANG_473' => 'Если Вы нуждаетесь в помощи или у Вас есть какие-либо сомнения, ответьте на данное сообщение.',
'_LANG_474' => 'Вы получили сообщение на свое объявление, которое размещено на сайте',
'_LANG_475' => 'Я заявляю, что я ознакомился с',
'_LANG_476' => 'Показывай неавторизированным пользователям',
'_LANG_477' => 'Не показывать неавторизированным пользователям',
'_LANG_478' => 'Показывай неавторизированным пользователям',
'_LANG_479' => 'Не показывать неавторизированным пользователям адресные данные в Твоих объявлениях.',
'_LANG_480' => 'Пользователь/Компания',
'_LANG_481' => 'количество объявлений',
'_LANG_482' => 'количество фотографий для объявления',
'_LANG_483' => 'Количество обновлений',
'_LANG_484' => 'Количество выделений',
'_LANG_485' => 'Объявления',
'_LANG_486' => 'Обновления',
'_LANG_487' => 'Выделения',
'_LANG_488' => 'Главная страница',
'_LANG_489' => 'дни',
'_LANG_490' => 'недель',
'_LANG_491' => 'Осталось',
'_LANG_492' => 'объявление',
'_LANG_493' => 'обновление',
'_LANG_494' => 'выделениe',
'_LANG_495' => 'Дата',
'_LANG_496' => 'Вид подписки',
'_LANG_497' => 'Дата активизации/окончания',
'_LANG_498' => 'Ваши действующие активные подписки',
'_LANG_499' => 'Описания',
'_LANG_500' => 'Спасибо за отправку заявки. Наш сервис позаботится об этом как можно скорее. ',
'_LANG_501' => 'Введите код скидки',
'_LANG_502' => 'Рекламный код',
'_LANG_503' => 'Если у вас есть код скидки, введите его в поле ниже, чтобы добавить скидку на покупку.',
'_LANG_504' => 'Код',
'_LANG_505' => 'Сохранить код',
'_LANG_506' => 'Сохраненные коды',
'_LANG_507' => 'Скидка',
'_LANG_508' => 'Дата истечения срока действия',
'_LANG_509' => 'Used',
'_LANG_510' => 'База данных бизнеса',
'_LANG_511' => 'Справка',
'_LANG_512' => 'Договорная',
'_LANG_513' => 'Найти подрядчика в вашем регионе.',
'_LANG_514' => 'Вы ищете подрядчика для своего заказа?',
'_LANG_515' => 'Продвижение',
'_LANG_516' => 'Bold',
'_LANG_517' => 'Мы поместим заголовок вашего предложения в списке объявлений.',
'_LANG_518' => 'Цена',
'_LANG_519' => '(сумма не включает возможные скидки) и не возвращается.',
'_LANG_520' => 'Подсветка',
'_LANG_521' => 'Мы выделим ваше предложение в списке объявлений.',
'_LANG_522' => 'Различие',
'_LANG_523' => 'Ваше предложение будет показано в начале списка элементов.',
'_LANG_524' => 'Домашняя страница',
'_LANG_525' => 'Мы покажем ваше предложение на главной странице сайта',
'_LANG_526' => 'Обычная учетная запись',
'_LANG_527' => 'Учетная запись компании',
'_LANG_528' => 'Рекламодатель',
'_LANG_529' => 'Показать',
'_LANG_530' => 'Предложения',
'_LANG_531' => 'hours',
'_LANG_532' => 'мин.',
'_LANG_533' => 'Закончено',
'_LANG_534' => 'Ниже минуты',
'_LANG_535' => 'days',
'_LANG_536' => 'день',
'_LANG_537' => 'Время до конца',
'_LANG_538' => 'Подтверждение подачи предложения',
'_LANG_539' => 'Подтверждение подачи предложения в заказе - сведения о предложении приведены ниже.',
'_LANG_540' => 'Имя',
'_LANG_541' => 'Предложение',
'_LANG_542' => 'Дата представления предложения',
'_LANG_543' => 'Завершение заказа',
'_LANG_544' => 'Служба поддержки пользователей',
'_LANG_545' => 'Определяться',
'_LANG_546' => 'Просмотр заказов',
'_LANG_547' => 'Вы подрядчик?',
'_LANG_548' => 'Проверить заказы, доступные в вашей отрасли',
'_LANG_549' => 'Просмотр заказов',

'USER_STATUS_0' => 'Неподтвержденный',
'USER_STATUS_1' => 'Активный',
'USER_STATUS_2' => 'Приостановленный',
'USER_STATUS_3' => 'Удален',
'CHANGES_SAVED' => 'Изменения сохранены.',
'WATCH_DELETED_ITEM' => 'Объявление удалено из списка наблюдаемых.',
'WATCH_DELETED_USER' => 'Пользователь был удален из списка наблюдаемых.',
'MEMBER_NAME_EMPTY' => 'Отсутствует',
'PROFILE_PHOTO_DELETED' => 'Фотография удалена.',
'USER_UPDATED' => 'Изменения сохранены.',
'USER_UPDATED_VERYFI' => 'Ваш аккаунт требует повторного подтверждения',
'PASS_NO_INFO' => 'Информация о данном пользователе отсутствует',
'PASS_CHNG_TITLE' => 'Изменение пароля',
'PASS_CHNG_INFO' => 'Просим получить электронное сообщение со ссылкой для изменения пароля.',
'PASS_CHNG_OK' => 'Пароль был изменен, можете войти в свой аккаунт',
'EMPTY_LOGIN' => 'Просим откорректировать логин пользователя',
'EMPTY_PWD' => 'Просим откорректировать пароль',
'LOGIN_BLOCK' => 'Вход в систему заблокирован. Вы сможете войти в систему через<strong>%d</strong> %s минут.',
'LOGIN_ERROR' => 'Неправильный логин или пароль.',
'STATUS_0' => 'Твой аккаунт не активизирован. Для активизации выберите ссылку в полученном электронном сообщении.',
'STATUS_2' => 'Ваш аккаунт заблокирован.',
'STATUS_3' => 'Ваш аккаунт удален.',
'PLEASELOGIN' => 'Зайдите в систему или зарегистрируйтесь.',
'FRIENDS_DELETE' => 'Пользователи удалены из списка Ваших знакомых.',
'PWD_INCORRECT' => 'Неправильный логин или пароль пользователя',
'PWD_NEW_INCORRECT' => 'Указанные пароли не идентичные',
'CHARGE_PROMO_ADDED' => 'Продвижение профиля',
'NO_ENOUGH_MONEY' => 'У Вас нет достаточного количества кредитов',
'PASS_CHNG_ERROR' => 'Извините, нет информации о данном пользователе или неправильный токен.',
'PASS_CHNG_PASS' => 'Указанные пароли разные.',
'PASS_CHNG_UPDATE_ERROR' => 'Нельзя актуализировать информацию пользователя. Просьба связаться с администратором сайта.',
'DATA_REQUIRED' => 'Просим откорректировать данные: (название компании, адрес, ИНН, КПП)',
'VARYFI_SAVED' => 'Заявление было передано для подтверждения нашим администратором.',
'MONTH_1' => 'месяц',
'MONTH_2' => 'месяцы',
'MONTH_5' => 'месяцев',
'PAYMENT_SAVE' => 'Выбранный пакет активизирован',
'REGISTER_END' => 'Аккаунт для нового пользователя создан. <br />Мы отправили Вам сообщение со ссылкой для активизации Вашего аккаунта.',
'EMAILACTIVATETITLE' => 'Активизация аккаунта нового пользователя',
'ACTIVATE_EMPTY_DATA' => 'В базе нет такого пользователя или аккаунт уже активизирован.',
'USER_CHECK_EMAIL' => 'Указанный адрес уже зарегистрирован на нашем сайте',
'USER_CHECK_EMAIL2' => 'Указанный адрес электронной почты неправильный',
'USER_CHECK_NAME' => 'Данный логин пользователя уже существует.',
'USERNAME_FREE' => 'Это название доступно',
'EMAIL_ERROR' => 'Неправильный адрес электронной почты',
'CONTACT_TITLE' => 'Контакт',
'MESSAGE_SEND' => 'Сообщение отправлено',
'REPORT_SEND' => 'Благодарим за заявку',
'MSG_SEND' => 'Сообщение отправлено',
'MSG_SUBJECT' => 'Сообщение по теме объявления',
'ITEM_ADD' => 'Объявление добавлено.',
'ITEM_UPDATE' => 'Изменения сохранены..',
'WATCH_ADDED_ITEM' => 'Объявление добавлено к наблюдаемым',
'WATCH_ADDED_USER' => 'Пользователь был добавлен в список наблюдаемых',
'ITEM_DELETED' => 'Объявление удалено',
'ITEM_SHOW' => 'Объявление скрыто',
'ITEM_HIDE' => 'Объявление опубликовано',
'ITEM_UNACTIVE' => 'Объявление недействительно',
'ITEM_DISTINCTION' => 'Объявление было выделено',
'ITEM_BIDS' => 'Объявление было обновленo',
'PROFILE_EMPTY' => 'Профиль не найден.',
'MEMBER_EMPTY' => 'Ваш подписка не дает права совершить данную операцию. Приобретите расширенную подписку.',
'PERMISSION_LOGIN' => 'Чтобы добавить объявление, необходимо авторизироваться.',
'PERMISSION_MEMBER' => 'Чтобы добавить объявление, необходимо иметь действующую подписку',
'ADD_EMPTY_CAT' => 'Выберите категорию',
'ADD_EMPTY_LANGS' => 'Просим выбрать язык объявления',
'ADD_EMPTY_TITLE' => 'Просим откорректировать заголовок',
'ADD_EMPTY_DESC' => 'Просим откорректировать описание',
'ADD_EMPTY_PRICE' => 'Пожалуйста, заполните цену',
'ADD_EMPTY_QTY' => 'Пожалуйста, заполните количество',
'WATCH_USER_USER' => 'Вы не можете добавить Ваше объявление или свой профиль к наблюдаемым',
'MUST_LOGIN' => 'Зайдите в систему',
'ERROR_CAPTCHA' => 'Просим правильно откорректировать reCaptche',
'ADD_USER_DATA' => 'Пожалуйста, заполните необходимые данные (название компании, номер НДС, адрес, город и почтовый индекс).'
);
