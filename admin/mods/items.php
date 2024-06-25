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

if (!defined('ADMIN_FILE')) die ("Access Denied");

require_once 'funcs/items/classes/items.class.php';
require_once 'admin/mods/classes/items.class.php';
require_once 'admin/mods/classes/users.class.php';
$itemsClass = new items;
$userClass = new user;
$adminItemsClass = new adminItems;

$op = $classMain->getOP();

switch ($op)
{
	case 'items':

		if ($_POST['save']) $adminItemsClass->updateStatus($_POST['active'], $_POST['veryfi'], $_POST['id']);

		if ($_POST['delete']) $adminItemsClass->delete();

		if ($_POST['veryfi']) $adminItemsClass->veryfi();

		//wyszukiwanie
		if ($_GET['search'] == 1 && isset($_GET['active'])) $querySearch .= ' AND i.active='.$classMain->formatSQL($_GET['active'], 'int');
		if ($_GET['search'] == 1 && isset($_GET['veryfi'])) $querySearch .= ' AND i.veryfi='.$classMain->formatSQL($_GET['veryfi'], 'int');

		if ($_GET['search'])
		{
			$query = $classMain->formatSQL($_GET['query']);
			switch($_GET['search-type'])
			{
				case 'title':
					$querySearch .= " AND i.title_pl LIKE '%".$query."%'";
				break;
				case 'id':
					$querySearch .= " AND i.id=".intval($query);
				break;
				case 'username':
					$querySearch .= " AND u.username LIKE '%".$query."%'";
				break;
				case 'user_id':
					$querySearch .= " AND u.user_id=".intval($query);
				break;
			}
		}

		$adminItemsClass->itemsStats();

		$query = "SELECT i.*, u.username FROM ".DB_PREFIX."_items i
					LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
					WHERE 1".$querySearch;

		$itemsClass->itemsList('i', false, $query);

		//stats
		$adminClass->userStats();

		$dataTPL = $_GET;
		$dataTPL['pagination'] = $pag;
		$dataTPL['status'] = (isset($_GET['status'])) ? intval($_GET['status']) : false;
		$dataTPL['veryfi'] = (isset($_GET['veryfi'])) ? intval($_GET['veryfi']) : false;

		$dataTPL['stats_all'] = $adminClass->userStats->all->count;
		$dataTPL['stats_active'] = $adminClass->userStats->active->count;
		$dataTPL['stats_suspended'] = $adminClass->userStats->suspended->count;
		$dataTPL['stats_unactive'] = $adminClass->userStats->unactive->count;
		$dataTPL['stats_deleted'] = $adminClass->userStats->deleted->count;

		$dataTPL['op'] = $op;

		$classMain->dataTPLarray($dataTPL);

		$adminClass->setTPL('items.tpl');

	break;

	case 'item-edit':

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['save'])
		{
			$_SESSION['add'] = $_POST;
			try {
				$itemsClass->itemUpdate(true);
			} catch (Exception $e) {
				$classMain->redirect(ADMIN_FILE.'.php?op=item-edit&id='.$_SESSION['add']['id'].'&info='.$e->getMessage());
			}
		}

		//photo - add
		if ($_FILES['photo']['tmp_name'][0]) $itemsClass->addPhoto($_FILES['photo'], true);
		//photo - delete
		$itemsClass->deletePic(true);

		$_SESSION['add'] = $db->query("SELECT i.*, u.*
												FROM ".DB_PREFIX."_items i
												LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
												WHERE i.id=".$classMain->formatSQL($_GET['id'], 'int')." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

		if ($_POST['delete'])
		{
			try{
				$itemsClass->deleteItem($_POST['id'], $_SESSION['add']['user_id']);
			} catch (Exception $e) {
				$classMain->redirect(ADMIN_FILE.'.php?op=items&info='.$e->getMessage());
			}
		}

		//photo - delete
		$itemsClass->deletePic(true);

		$_SESSION['add']['title'] = $_SESSION['add']['title_pl'];
		$_SESSION['add']['cat_id'] = $itemsClass->getCatID($_SESSION['add']['cat_id']);
		$_SESSION['add']['daterange'] = $itemsClass->getDateRange($_SESSION['add']['start'], $_SESSION['add']['end']);
		$_SESSION['add']['langs'] = $itemsClass->getItemLangs($_SESSION['add']['langs']);

		$classMain->langsList('langs_title', 'title', $_SESSION['add']);
		$classMain->langsList('langs_desc', 'description', $_SESSION['add']);
		$classMain->langsList('langs_langs', 'langs', $_SESSION['add']);
		$classMain->langsList('langs_keywords', 'keywords', $_SESSION['add']);

		$itemsClass->catsList();
		#$itemsClass->phonesList($_SESSION['add']['user_id']);
		$itemsClass->optList('jm');
		$itemsClass->optList('waluta');
		$itemsClass->getImagesTPL($_SESSION['add']['id'], true, $_SESSION['add']['dir']);

		$itemsClass->promoPrices('promo_bold', $_SESSION['add']['item_time']);
		$itemsClass->promoPrices('promo_backlight', $_SESSION['add']['item_time']);
		$itemsClass->promoPrices('promo_distinction', $_SESSION['add']['item_time']);
		$itemsClass->promoPrices('promo_mainpage', $_SESSION['add']['item_time']);

		$_SESSION['add']['editor'] = true;
		$_SESSION['add']['edit'] = true;
		$dataTPL = $_SESSION['add'];
		$dataTPL['item-edit'] = true;
		$classMain->dataTPLarray($dataTPL);

		$adminClass->setTPL('item-edit.tpl');

	break;
}

?>
