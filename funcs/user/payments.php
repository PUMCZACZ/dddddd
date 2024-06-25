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

if (!defined('MODULE_FILE')) die ("<b>Dostp bezporedni zabroniony</b><br />You can't access this file directly...");

$classUser->checkIsUser();

require_once 'funcs/user/classes/payment.class.php';
$classPayment = new payment;

if ($_GET['dwnl']) $classUser->getInvoice($_GET['dwnl']);

if ($_POST['add-amount'] && $_POST['amount'])
{
  $classPayment->setPayment($classUser->userinfo->user_id, $_POST['amount'], array('name' => $classMain->_LANG['_LANG_797'], 'func' => 'amount'));
}

$classUser->balanceList();
$classUser->paymentsList();

$classMain->dataTPLarray($dataTPL);
$classMain->tpl('user-payments.tpl');
?>
