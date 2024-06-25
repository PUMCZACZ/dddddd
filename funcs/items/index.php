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

$itemsClass->checkItemVisible();

$classMain->saveRedirect();

if ($_GET['show-info'] == 1)
{
  if ($classUser->is_user() && !$classUser->is_member()) $classMain->redirect('funcs.php?name=user&file=member');
  elseif (!$classUser->is_user()) $classMain->redirect('funcs.php?name=user');
}

if (isset($_GET['lang'])) $itemsClass->changeLang($_GET['lang'], 'items');

if ($_GET['get_file'] == 1) $itemsClass->fileDownload($_GET['id']);

if (isset($_POST['edit-offer']))
{
  try {
		$itemsClass->editOffer($classUser->userinfo->user_id, $_POST['id'], $_POST['offer_price'], $_POST['offer_price_type'], $_POST['offer_desc']);
	} catch (Exception $e) {
		$classMain->redirect('funcs.php?name=items&id='.$classMain->formatSQL($_POST['id'], 'int'), 'info', $e->getMessage());
	}
}

if (isset($_POST['addOffer']))
{
	try {
		$itemsClass->addOffer($classUser->userinfo->user_id, $_POST['id'], $_POST['offer_price'], $_POST['offer_price_type'], $_POST['offer_desc']);
	} catch (Exception $e) {
		$classMain->redirect('funcs.php?name=items&id='.$classMain->formatSQL($_GET['id'], 'int'), 'info', $e->getMessage());
	}
}

if (isset($_GET['watch']))
{
	try {
		$itemsClass->addWatch($_GET['id'], 'item');
	} catch (Exception $e) {
		$classMain->redirect('funcs.php?name=items&id='.$classMain->formatSQL($_GET['id'], 'int'), 'info', $e->getMessage());
	}
}
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
		$itemsClass->saveReport();
	} catch (Exception $e) {
		$classMain->redirect(false, 'error', $e->getMessage());
	}
}
//send message
if ($_GET['send-msg'] == 1 && !$classUser->is_user())
{
	$classMain->redirect('funcs.php?name=user', 'error', $classMain->_LANG['PLEASELOGIN']);
}
if ($_POST['send-msg'])
{
	try{
		$itemsClass->sendMsg();
	} catch (Exception $e) {
		$classMain->redirect('funcs.php?name=items&id='.$classMain->formatSQL($_GET['id'], 'int'), 'error', $e->getMessage());
	}
}

$itemsClass->getItemTPLdata($_GET['id'], true);

#if ($classUser->is_user()) $itemsClass->checkUserOffer($_GET['id']);

if (!$classUser->is_user()) $classMain->recaptcha();

$classMain->optList('item_offer_type');

$dataTPL['item_show'] = true;
$dataTPL['msg_show'] = ($_GET['send-msg'] == 1);
$classMain->dataTPLarray($dataTPL);
$classMain->tpl('item.tpl');
?>
