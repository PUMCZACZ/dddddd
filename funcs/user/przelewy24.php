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

if (!$classUser->is_user()) $classMain->redirect('funcs.php?name=user');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$hash = md5(session_id().date("YmdHis"));
	$p24_amount = str_replace(array(',', ' '), array('.', ''), $_POST['p24_amount']);
	$p24_amount = number_format($p24_amount, 2, '.', '');
	$p24_amount = str_replace('.', '', $p24_amount);

	$db->query("INSERT INTO ".$prefix."_payments VALUES (
													NULL,
													".$userinfo['user_id'].",
													'".$hash."',
													".$p24_amount.",
													'',
													'p24',
													".time().",
													0,
													''
	)");
}

require_once 'funcs/konto/przelewy24.class.php';

$template->assign_vars(array(
						'IMIE' => $userinfo['imie'],
						'NAZWISKO' => $userinfo['nazwisko'],
						'EMAIL' => $userinfo['adres_email'],

						'CONTROL' => base64_encode($userinfo['user_id']),

						'CONTROL_PAYPAL' => urlencode($userinfo['user_id']),
						'URLC' => $mainConfig['siteurl'].'/wplata_dotpay.php',
						'URL' => $mainConfig['siteurl'].'/funcs.php?name=konto&info=Operacja+w+trakcie+przetwarzania',

						'P24_AMOUNT' => $p24_amount,

						'P24_ID' => $mainConfig['p24_id'],
						'P24_CRC' => $mainConfig['p24_crc'],
						'P24_ACTION' => ($mainConfig['p24_tryb'] == 'sandbox') ? 'https://sandbox.przelewy24.pl/trnDirect' : 'https://secure.przelewy24.pl/trnDirect',
						'P24_WALUTA' => $mainConfig['p24_waluta'],
						'P24_URL_STATUS' => $mainConfig['siteurl'].'/wplata_przelewy24.php',
						'P24_SESSION_ID' => $hash,
						'P24_VERSION' => P24_VERSION,
));

$template->set_filenames(array(
		'body' => 'konto_przelewy24.tpl'
		));
$template->display('body');
?>
