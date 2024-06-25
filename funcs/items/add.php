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

if (isset($_REQUEST['parent_id'])) $itemsClass->getChildCategories();

$itemsClass->addPermission();

if ($_GET['new'] == 1)
{
	unset($_SESSION['add']);
	unset($_SESSION['add-photo']);
	$classMain->redirect('funcs.php?name=items&file=add');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') $_SESSION['add'] = $_POST;

if ($_POST['add'] == 1)
{
	try{
		$itemsClass->checkData();
	} catch (Exception $e) {
		$classMain->redirect('funcs.php?name=items&file=add', 'error', $e->getMessage());
	}
	try{
		$itemsClass->addItem();
	} catch (Exception $e) {
		if ($classUser->is_user()) $classMain->redirect('funcs.php?name=user&file=items_list', 'info', $e->getMessage());
		else $classMain->redirect('index.php', 'info', $e->getMessage());
	}
}

//add photo
if ($_FILES['photo']['tmp_name'][0]) $itemsClass->addPhoto($_FILES['photo']);
if ($_FILES['item_file']['tmp_name']) $itemsClass->addFile($_FILES['item_file']);

//set default data
$itemsClass->setAddDefaultData();

//delete photos
$itemsClass->deletePic();

//delete files
$itemsClass->deleteFile();

$classMain->langsList('langs_title', 'title', $_SESSION['add']);
$classMain->langsList('langs_desc', 'description', $_SESSION['add']);
$classMain->langsList('langs_langs', 'langs', $_SESSION['add']);
$classMain->langsList('langs_keywords', 'keywords', $_SESSION['add']);

$itemsClass->catsList($_SESSION['add']['cat_id'], false, $_SESSION['add']['cat_id']);
$itemsClass->phonesList();
$itemsClass->filtersInputs($_SESSION['add']['cat_id']);
$itemsClass->optList('unit');
$itemsClass->optList('region');
$itemsClass->optList('waluta');
$itemsClass->optList('item_time', false, 'items-price');
$itemsClass->optList('item_type');
$itemsClass->optList('kraj');
$itemsClass->photosList($_SESSION['add-photo']['photo']);

$itemsClass->promoPrices('promo_bold', $_SESSION['add']['item_time']);
$itemsClass->promoPrices('promo_backlight', $_SESSION['add']['item_time']);
$itemsClass->promoPrices('promo_distinction', $_SESSION['add']['item_time']);
$itemsClass->promoPrices('promo_mainpage', $_SESSION['add']['item_time']);

$_SESSION['add']['date_now'] = date('d/m/Y');
$_SESSION['add']['editor'] = false;
#$_SESSION['add']['daterange'] = ($_SESSION['add']['daterange']) ? $_SESSION['add']['daterange'] : $itemsClass->setDateRange();
$_SESSION['add']['item_member'] = $classMain->mainConfig->item_member;

if ($classMain->mainConfig->multilang == 0)
{
	$_SESSION['add']['title'] = $classMain->setLangVar('title', $_SESSION['add']);
	$_SESSION['add']['description'] = $classMain->setLangVar('description', $_SESSION['add']);
}

$_SESSION['add']['item_photos'] = $classMain->mainConfig->item_photos;
$_SESSION['add']['photo-limit'] = (is_array($_SESSION['add-photo']['photo']) && count($_SESSION['add-photo']['photo']) >= $classMain->mainConfig->item_photos);
$_SESSION['add']['editor'] = true;

$classMain->dataTPLarray($_SESSION['add']);

$classMain->tpl('item-add.tpl');
?>
