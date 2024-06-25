<?php

/****************************************************************/
/*	UWAGA! SKRYPT NIE JEST DARMOWY.								*/
/*	DALSZE ROZPOWSZECHNIANIE BEZ ZGODY 							*/
/*	FIRMY JMLNET JEST ZABRONIONE.								*/
/****************************************************************/
/****************************************************************/
/*	PRODUCENT OPROGRAMOWANIA	JMLnet							*/
/*	NAZWA SKRYPTU:				SKRYPT AUKCYJNY					*/
/*	WERSJA:						1.01							*/
/*	KONTAKT:					INFO@JMLNET.PL					*/
/****************************************************************/
/* Copyright (c) JMLnet. Wszelkie prawa zastrzeone.				*/
/****************************************************************/

if (!defined('MODULE_FILE')) die ("<b>Dostp bezpośredni zabroniony</b><br />You can't access this file directly...");

require 'funcs/items/classes/items.class.php';
$itemsClass = new items;

if ($_POST['pay'])
{
  $itemsClass->payForAdd($_POST['id'], $_POST['time'], $_POST['promo_bold'], $_POST['promo_backlight'], $_POST['promo_distinction'], $_POST['promo_mainpage']);
}

$itemsClass->paymentInfo();
$itemsClass->optList('item_time', false, 'items-price');

$classMain->tpl('item-payment.tpl');
?>
