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

require_once 'funcs/user/classes/veryfi.class.php';
$veryfiClass = new veryfi;

if ($_POST['save-veryfi'])
{
  try {
    $veryfiClass->saveApp();
  } catch (Exception $e) {
    $classMain->redirect('funcs.php?name=user&file=veryfi', 'info', $e->getMessage());
  }
}

$veryfiClass->checkUserData();

$dataTPL['status'] = $veryfiClass->checkVeryfiStatus();

$classMain->dataTPLarray($dataTPL);

$classMain->tpl('user-veryfi.tpl');
?>
