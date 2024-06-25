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

if (!defined('MODULE_FILE')) die ("Dostep bezpośredni zabroniony...");

if (!$classUser->is_user()) $classMain->redirect('funcs.php?name=user');

include 'funcs/items/classes/items.class.php';
$itemsClass = new items;

//photo - add
if ($_FILES['photo']['tmp_name'][0]) $itemsClass->addPhoto($_FILES['photo']);

#if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['save'] == 1)
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$_SESSION['add'] = $_POST;
	try {
		$itemsClass->itemUpdate();
	} catch (Exception $e) {
		$classMain->redirect('funcs.php?name=user&file=items_list', 'info', $e->getMessage());
	}
}

//photo - delete
$itemsClass->deletePic();

//file - delete
$itemsClass->deleteFile();

/*$_SESSION['add'] = $db->query("SELECT i.*, u.*
										FROM ".DB_PREFIX."_items i
										LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
										WHERE i.id=".$classMain->formatSQL($_GET['id'], 'int')." AND i.user_id=".$classUser->userinfo->user_id." LIMIT 1")->fetch(PDO::FETCH_ASSOC);*/
$_SESSION['add'] = $db->query("SELECT i.*, u.user_email
										FROM ".DB_PREFIX."_items i
										LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
										WHERE i.id=".$classMain->formatSQL($_GET['id'], 'int')." AND i.user_id=".$classUser->userinfo->user_id." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

$_SESSION['add']['title'] = $_SESSION['add']['title_pl'];
$_SESSION['add']['cats_id'] = ($_SESSION['add']['cat_id']) ? explode('.', $_SESSION['add']['cat_id']) : false;
$_SESSION['add']['cat_id'] = $itemsClass->getCatID($_SESSION['add']['cat_id']);
$_SESSION['add']['daterange'] = $itemsClass->getDateRange($_SESSION['add']['start'], $_SESSION['add']['end']);
$_SESSION['add']['langs'] = $itemsClass->getItemLangs($_SESSION['add']['langs']);
$_SESSION['add']['description'] = $classMain->setLangVar('description', $_SESSION['add']);
$_SESSION['add']['item_file'] = (file_exists('uploaded/items/' . $_SESSION['add']['dir'] . '/' . $_SESSION['add']['id'] . '/' . $_SESSION['add']['file'])) ? 'uploaded/items/' . $_SESSION['add']['dir'] . '/' . $_SESSION['add']['id'] . '/' . $_SESSION['add']['file'] : false;

$classMain->langsList('langs_title', 'title', $_SESSION['add']);
$classMain->langsList('langs_desc', 'description', $_SESSION['add']);
$classMain->langsList('langs_langs', 'langs', $_SESSION['add']);
$classMain->langsList('langs_keywords', 'keywords', $_SESSION['add']);

$itemsClass->catsList($_SESSION['add']['cats_id'], false, $_SESSION['add']['cats_id']);
$itemsClass->phonesList();
$itemsClass->optList('unit');
$itemsClass->optList('region');
$itemsClass->optList('waluta');
$itemsClass->optList('kraj');
$itemsClass->optList('item_type');
$itemsClass->getImagesTPL($_SESSION['add']['id'], true, $_SESSION['add']['dir']);

$itemsClass->promoPrices('promo_bold', $_SESSION['add']['item_time']);
$itemsClass->promoPrices('promo_backlight', $_SESSION['add']['item_time']);
$itemsClass->promoPrices('promo_distinction', $_SESSION['add']['item_time']);
$itemsClass->promoPrices('promo_mainpage', $_SESSION['add']['item_time']);

$_SESSION['add']['editor'] = true;
$_SESSION['add']['edit'] = true;
$dataTPL = $_SESSION['add'];
$dataTPL['date_now'] = date('d/m/Y');
$dataTPL['item-edit'] = true;
$classMain->dataTPLarray($dataTPL);

$classMain->tpl('item-add.tpl');
?>
