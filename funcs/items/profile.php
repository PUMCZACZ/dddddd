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

if (isset($_GET['watch-user']))
{
	try {
		$itemsClass->addWatch($_GET['id'], 'user');
	} catch (Exception $e) {
		$classMain->redirect('funcs.php?name=items&file=profile&id='.$classMain->formatSQL($_GET['id'], 'int'), 'info', $e->getMessage());
	}
}

//send abuse
if ($_POST['send-abuse'])
{
	try{
		$itemsClass->saveReport('user');
	} catch (Exception $e) {
		$classMain->redirect(false, 'error', $e->getMessage());
	}
}

//send message
if ($_GET['send-msg'] == 1 && !$classUser->is_user())
{
	$classMain->saveRedirect();
	$classMain->redirect('funcs.php?name=user', 'error', $classMain->_LANG['PLEASELOGIN']);
}
if ($_POST['send-msg'])
{
	try{
		$itemsClass->sendMsg('profile');
	} catch (Exception $e) {
		$classMain->redirect('funcs.php?name=items&file=profile&id='.$_GET['id'], 'error', $e->getMessage());
	}
}

if (isset($_GET['lang'])) $itemsClass->changeLang($_GET['lang'], 'profiles');

$user_id = $classMain->formatSQL($_GET['id'], 'int');

try{
  $itemsClass->profileDataTPL($user_id);
} catch (Exception $e) {
  $classMain->redirect($classMain->mainConfig->siteurl, 'error', $e->getMessage());
}

$classUser->profilePhotos($user_id);

$sql = "SELECT i.*, u.username, u.veryfi
                FROM ".DB_PREFIX."_items i
                LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
                WHERE 1 AND i.user_id=".$user_id." AND i.active=1 AND i.veryfi=1 AND i.save_only=0";

$itemsClass->itemsList('i', false, $sql);

$dataTPL['msg_show'] = ($_GET['send-msg'] == 1);
$classMain->dataTPLarray($dataTPL);

$classMain->tpl('item.tpl');
?>
