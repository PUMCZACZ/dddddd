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

require_once dirname(__FILE__).'/inc/functions_main.php';
require_once dirname(__FILE__).'/funcs/user/classes/przelewy24.class.php';
require_once dirname(__FILE__).'/funcs/user/classes/payment.class.php';
$classPayment = new payment;

$msg = false;

$row = $db->query("SELECT * FROM ".DB_PREFIX."_payments WHERE hash='".$_POST['p24_session_id']."' AND paid=0 LIMIT 1")->fetch(PDO::FETCH_OBJ);

$P24 = new Przelewy24($classMain->mainConfig->p24_id, $classMain->mainConfig->p24_id, $classMain->mainConfig->p24_crc);

foreach($_POST as $k=>$v) $P24->addValue($k,$v);

$P24->addValue('p24_currency', $classMain->mainConfig->p24_waluta);
$P24->addValue('p24_amount', $row->suma);
$res = $P24->trnVerify();

if($res["error"] == 0 && $row)
{
	$db->query("UPDATE ".DB_PREFIX."_payments SET paid=1 WHERE id=".$row->id." LIMIT 1");

	$result = $classPayment->savePayment($row->hash);

	/*$query = "INSERT INTO ".$prefix."_users_saldo VALUES (
														NULL,
														0,
														".$row->user_id.",
														".($row->suma/100).",
														'Wpłata własna',
														0,
														".time().",
														'".$_SERVER['REMOTE_ADDR']."'
	)";
	$db->query($query);*/
	#$msg = $query."\n";
	#$msg .= implode('|', $_POST)."\n";
	#$msg .= implode('|', array_keys($_POST))."\n";
	#$msg = 'Transakcja została zweryfikowana poprawnie';

	echo 'error=0';
}
else
{
	echo 'error='.$res["error"];
	#$msg = 'Błędna weryfikacja transakcji';
}

file_put_contents(
	dirname(__FILE__) . '/weryfikacja.txt',
	date("H:i:s").": error:".$res["error"].'-'.$msg." SELECT * FROM ".$prefix."_payments WHERE hash='".$_POST['p24_session_id']."' AND paid=0 LIMIT 1".print_r($res)."\n\n",
	FILE_APPEND
);
exit;

?>
