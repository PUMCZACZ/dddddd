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

$getID = $classMain->formatSQL($_GET['id'], 'int');

$itemsClass->catsList($getID);

$dataTPL = $_GET;

unset($_GET['view-mode']);
$url = $_SERVER['SCRIPT_NAME'] . "?" . http_build_query($_GET);

$rowCat = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE id=".$getID." LIMIT 1")->fetch(PDO::FETCH_OBJ);
$dataTPL['cat_name'] = $classMain->setLangVar('name', $rowCat);

$dataTPL['meta_desc'] = $classMain->setLangVar('meta_desc', $rowCat);
$dataTPL['meta_keywords'] = $classMain->setLangVar('meta_keywords', $rowCat);

$dataTPL['actual_link'] = $itemsClass->actualLink();
$dataTPL['type'] = ($classMain->formatSQL($_GET['type']) == 'companies') ? 'c' : false;
$dataTPL['i_type'] = $classMain->formatSQL($_GET['i_type']);
$dataTPL['address_view_mode_def'] = $url;
$dataTPL['address_view_mode_tiles'] = $url.'&amp;view-mode=tiles';
$dataTPL['list_type'] = $itemsClass->itemsType($_GET['type']);
$dataTPL['id'] = $getID;
$dataTPL['sitename_string'] = $itemsClass->catName($getID).' - '.$classMain->mainConfig->sitename;
$classMain->dataTPLarray($dataTPL);

$itemsClass->itemsFilters();

if ($dataTPL['list_type'] == 'companies') $itemsClass->profileList('i');
else $itemsClass->itemsList('i');

$classMain->optList('kraj');
$classMain->optList('jezyk');
$classMain->optList('region');
$classMain->optList('item_type');

$classMain->tpl('item-list.tpl');
?>
