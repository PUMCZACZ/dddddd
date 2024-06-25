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

#$classUser->checkIsUser();

require_once 'funcs/user/classes/przelewy24.class.php';
require_once 'funcs/user/classes/payment.class.php';
require_once 'funcs/user/classes/member.class.php';
$classMember = new member();
$classPayment = new payment;

//sms pay
if ($_POST['sms-code-check']) $classPayment->smsCodeCheck($_POST['sms-code']);

if (empty($_SESSION['payment']['user_id']) || empty($_SESSION['payment']['sum']) || empty($_SESSION['payment']['func'])) $_BREAK = true;

$ballance = $classUser->getUserBallance();

//zapisywanie danych po wyborze operatora
if ($_POST['submitRedirect'] == 1)
{
	$submitRedirect = true;
	$_SESSION['payment']['operator'] = $classPayment->formatSQL($_POST['operator']);
}

$payHash = md5(session_id().date("YmdHis"));


$user_id = $classPayment->userinfo->user_id;
$user_email = $classPayment->userinfo->user_email;

//rodzaje platnosci
switch($_SESSION['payment']['func']['func'])
{
	case 'order_payment':
		$paySum = $_SESSION['payment']['sum'];
		$payOpis = $classMain->_LANG['_LANG_796'].' #'.$_SESSION['payment']['func']['o_id'];
		$extraInfo = $_SESSION['payment']['func']['o_id'];
		$operator_user = true;
		$operator_p24 = $_SESSION['payment']['pay_operators']['przelewy24'];
		$operator_pp = $_SESSION['payment']['pay_operators']['paypal'];
		$redirectFile = 'items_orders';
	break;
	
	case 'member':
		$payOpis = $classMain->_LANG['_LANG_333'].' '.$_SESSION['payment']['func']['name'];
		$paySum = $_SESSION['payment']['sum'];
		$extraInfo = $_SESSION['payment']['func']['id'];
		$free = ($classMember->checkFree($extraInfo) || $classPayment->checkPromoCode($paySum, $classPayment->userinfo->user_id) === 0);
		$redirectFile = 'member';
	break;

	case 'add_item':
		$payOpis = $classMain->_LANG['_LANG_333'].' '.$_SESSION['payment']['func']['name'];
		$paySum = $_SESSION['payment']['sum'];
		$extraInfo = serialize($_SESSION['payment']['func']);
		$redirectFile = 'items_list';
		$userinfo = $classPayment->getUserInfo($_SESSION['payment']['func']['id']);
		$user_id = $userinfo->user_id;
		$user_email = $userinfo->user_email;
	break;

	case 'amount':
		$payOpis = $_SESSION['payment']['func']['name'].'';
		$paySum = $_SESSION['payment']['sum'];
		$extraInfo = serialize($_SESSION['payment']['func']);
		$redirectFile = 'payments';
	break;
}

//zapis platnosci do DB
if ($submitRedirect == true || $paySum == 0 || $ballance >= $paySum)
{
	$paySumPromo = $classPayment->checkPromoCode($paySum, $user_id, $submitRedirect);
	$paySum = (isset($paySumPromo)) ? $paySumPromo : $paySum;

	if ($_SESSION['payment']['operator'] == 'p24')
	{
		$p24_amount = str_replace(array(',', ' '), array('.', ''), $paySum);
		$p24_amount = number_format($p24_amount, 2, '.', '');
		$p24_amount = str_replace('.', '', $p24_amount);
	}

	$query = "INSERT INTO ".DB_PREFIX."_payments VALUES (
													NULL,
													".$user_id.",
													'".$payHash."',
													".$paySum.",
													'".$_SESSION['payment']['func']['func']."',
													'".$_SESSION['payment']['operator']."',
													".time().",
													0,
													'".$extraInfo."',
													''
	)";
	$db->query($query);

	#if (($_SESSION['payment']['func']['func'] == 'member' && $classMember->checkFree($extraInfo) == true) || $_SESSION['payment']['func']['func'] == 'add_item')
	if (($_SESSION['payment']['func']['func'] == 'member' && $classMember->checkFree($extraInfo) == true) || $paySum == 0 || $ballance >= $paySum && $_SESSION['payment']['func']['func'] != 'amount')
	{
		$result = $classPayment->savePayment($payHash);
		if ($ballance >= $paySum) $classPayment->updateUserBanalce($user_id, -$paySum, 295, $_SESSION['payment']['func']['id']);
		$classMain->saveRedirect();
		unset($_SESSION['add']);
		$classMain->redirect('funcs.php?name=user&file='.$redirectFile, 'info', $classMain->_LANG['_LANG_804']);
	}

}

$operators = explode('#', $classMain->mainConfig->payment_operators);

$smsInfo = $classPayment->smsCheck($_SESSION['payment']['func']['id']);

$dataTPL = array(

						'SMS_TEXT' => $smsInfo->text,
						'SMS_NUMBER' => $smsInfo->number,
						'SMS_PRICE' => $smsInfo->price,
						'SMS_PRICE_TAX' => number_format($smsInfo->price+($smsInfo->price*($smsInfo->tax/100)), 2),

						'MEMBER_NAME' => $_SESSION['payment']['func']['name'],
						'MEMBER_TIME' => $_SESSION['payment']['func']['time'],
						'MEMBER_TIME_NAME' => $_SESSION['payment']['func']['time_name'],

						'FREE' => $free,

						'EMAIL' => $user_email,
						'FUNC' => $payOpis,
						'FUNC_FUNC' => $_SESSION['payment']['func']['func'],
						'SUM' => $paySum,
						'SUM_PROMO' => $classPayment->checkPromoCode($paySum, $user_id),

						'OPERATOR' => $_SESSION['payment']['operator'],
						'OPERATOR_D' => (($operator_user && $operator_dp) || ($operator_user == false && in_array('d', $operators))),
						'OPERATOR_PP' => (($operator_user && $operator_pp) || ($operator_user == false && in_array('pp', $operators))),
						'OPERATOR_P24' => (($operator_user && $operator_p24) || ($operator_user == false && in_array('p24', $operators))),
						'OPERATOR_BP' => (($operator_user && $operator_bp) || ($operator_user == false && in_array('bp', $operators))),
						'OPERATOR_BT' => (($operator_user && $operator_bt) || ($operator_user == false && in_array('bt', $operators))),
						'OPERATOR_SMS' => ($operator_user == false && $classMain->mainConfig->sms_pay == 1 && $smsInfo->id),

						'CONTROL' => $payHash,

						'DOTPAY_ID' => $classPayment->mainConfig->dotpay_id,
						'DOTPAY_WALUTA' => $classPayment->mainConfig->dotpay_currency,

						'P24_AMOUNT' => $p24_amount,
						'P24_ID' => $classMain->mainConfig->p24_id,
						'P24_CRC' => $classMain->mainConfig->p24_crc,
						'P24_SIGN' => md5($payHash.'|'.$classMain->mainConfig->p24_id.'|'.$p24_amount.'|'.$classMain->mainConfig->p24_currency.'|'.$classMain->mainConfig->p24_crc),
						'P24_ACTION' => ($classMain->mainConfig->p24_tryb == 'sandbox') ? 'https://sandbox.przelewy24.pl/trnDirect' : 'https://secure.przelewy24.pl/trnDirect',
						'P24_WALUTA' => $classMain->mainConfig->p24_currency,
						'P24_URL_STATUS' => $classMain->mainConfig->siteurl.'/payment_przelewy24.php',
						'P24_SESSION_ID' => $payHash,
						'P24_VERSION' => P24_VERSION,

						'PAYMENT_BANK_TRANSFER' => nl2br($classMain->mainConfig->payment_bank_transfer),

						'USER_ID' => $user_id,
						'USERNAME' => $classUser->userinfo->username,

						'URLC' => $classPayment->mainConfig->siteurl.'/payment_dotpay.php',
						'URL' => $classPayment->mainConfig->siteurl.'/funcs.php?name=user&paymentInfo=2',

						'LOGO' => $classPayment->mainConfig->siteurl.'/theme/img/logo.png',

						'PLATNOSCI' => true,
						'SUBMIT_REDIRECT' => $submitRedirect,
						'SITENAME' => $classPayment->mainConfig->sitename,
);

if ($_BREAK == true) $_GET['error'] = 'Błąd przetwarzania Twojego zapytania.';

$classMain->dataTPLarray($dataTPL);
$classMain->tpl('user-payment.tpl');
?>
