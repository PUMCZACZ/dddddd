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

$op = $classMain->getOP();

switch($op)
{
  case 'show':
  case 'hide':
  case 'distinction':
  case 'bids':
    try{
      $itemsClass->updateItem($_GET['id'], $op);
    } catch (Exception $e) {
      $classMain->redirect(false, 'info', $e->getMessage());
    }
  break;

  case 'delete':
    try{
      $itemsClass->deleteItem($_GET['id'], $classUser->userinfo->user_id);
    } catch (Exception $e) {
      $classMain->redirect('funcs.php?name=user&file=items_list', 'info', $e->getMessage());
    }
  break;
}

$dataTPL = new stdClass();
$dataTPL->items_bids = $classMain->mainConfig->items_bids;
$dataTPL->items_distinction = $classMain->mainConfig->items_distinction;
$dataTPL->status = $classMain->formatSQL($_GET['status']);

$itemsClass->itemsList();

$classMain->dataTPLarray($dataTPL);

$classMain->tpl('user-items-list.tpl');
?>
