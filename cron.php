<?php

/****************************************************************/
/*	UWAGA! SKRYPT NIE JEST DARMOWY.								*/
/*	DALSZE ROZPOWSZECHNIANIE BEZ ZGODY 							*/
/*	FIRMY JMLNET JEST ZABRONIONE.								*/
/****************************************************************/
/****************************************************************/
/*	PRODUCENT OPROGRAMOWANIA	JMLnet							*/
/*	NAZWA SKRYPTU:				SKRYPT AUKCYJNY	PRO				*/
/*	WERSJA:						1.31							*/
/*	KONTAKT:					INFO@JMLNET.PL					*/
/****************************************************************/
/* Copyright (c) JMLnet. Wszelkie prawa zastrzeone.				*/
/****************************************************************/

include dirname(__FILE__).'/inc/functions_main.php';
include dirname(__FILE__).'/inc/classes/class.cron.php';
$classCron = new cron;

//wysylanie przypomnienia o wygasaniu abonamentu
$classCron->memberReminder();

//sprawdzanie aktywnosci abonamentu
$classCron->memberCheck();

//end items
$classCron->endItems();

//przedluzanie ogloszen po zakonczeniu abonamentu
?>
