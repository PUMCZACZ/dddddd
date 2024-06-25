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

include_once dirname(__FILE__).'/inc/functions_main.php';

$_POST['email'] = $classMain->formatSQL($_POST['email']);
$_POST['t_status'] = $classMain->formatSQL($_POST['t_status']);

if (!filter_var($classMain->formatSQL($_POST['email']), FILTER_VALIDATE_EMAIL))
{
	echo 'FAILD1';
	exit;
}

$hash = $classMain->formatSQL($_POST['control']);

//tworzenie PINu dla transakcji
$tPIN = $mainConfig['dotpay_pin'].':'.$mainConfig['dotpay_id'].':'.$classMain->formatSQL($_POST['control']).':'.$classMain->formatSQL($_POST['t_id']).':'.$classMain->formatSQL($_POST['amount']).':'.$_POST['email'].':::::'.$_POST['t_status'];

$tPINmd5 = md5($tPIN);

#if ($tPINmd5 != $_POST['md5']) {echo 'FAILD2'; exit;}

include dirname(__FILE__).'/funcs/user/classes/payment.class.php';
$classPayment = new payment;

switch ($_POST['operation_status']) {

	//wykonana
	case 'completed':

		$result = $classPayment->savePayment($hash);

	break;

	//nowa
	case 1:
	//odmowa
	case 3:
	//anulowana
	case 4:
	//reklamacja
	case 5:
	break;
}
if ($result) echo 'OK'; else echo 'FAILD'
?>
