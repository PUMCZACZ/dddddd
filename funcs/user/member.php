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

if (!$classUser->is_user())
{
  $classMain->saveRedirect();
  $classMain->redirect('funcs.php?name=user&file=register', 'info', 'Aby dodać ogłoszenie na stronie, załóż konto użytkownika i następnie kup wybrany pakiet ogłoszeniowy');
}

require_once 'funcs/user/classes/member.class.php';
$classMember = new member();

$op = $classMain->getOP();

$dataTPL = array();
$dataTPL['op'] = $op;

switch($op)
{
  case 'payment':
    if (isset($_POST['payment']) && $_POST['payment'] == 1)
    {
      try {
        $classMember->addSalary();
      } catch (Exception $e) {
        $classMain->redirect($classMain->mainConfig->siteurl . '/funcs.php?name=user&file=membe&op=payment', 'info', $e->getMessage());
      }
    }

    $dataTPL['user-wallet-price'] = number_format(($dataTPL['user-wallet']*$classMain->mainConfig->price_credit), 2, ',', '');
    $dataTPL['payment-block'] = ($dataTPL['user-wallet']<$classMain->mainConfig->payment_salary_min);

    $classMember->salaryList('pay_w', 0);
    $classMember->salaryList('pay', 1);

  break;

  default:

    if ($_POST['promo-code'] == 1 && isset($_POST['code']) && !empty($_POST['code']))
    {
      try {
        $classMember->savePromoCode($_POST['code']);
      } catch (Exception $e) {
        $classMain->redirect($classMain->mainConfig->siteurl . '/funcs.php?name=user&file=member', 'info', $e->getMessage());
      }
    }

    if ($_POST['buy'] == 1 && isset($_POST['mp_id']) && !empty($_POST['mp_id']))
    {
      try {
        $classMember->makePayment('member');
      } catch (Exception $e) {
        $classMain->redirect($classMain->mainConfig->siteurl . '/funcs.php?name=user&file=member', 'info', $e->getMessage());
      }
    }

    $dataTPL['m_id'] = $classUser->memberInfo('id');
    $dataTPL['promo-code-show'] = ($_GET['promo-code-show'] == 1);
    $classMember->memberList();
    $classMember->memberList(1, 'me');
    $classMember->promoCodesList();

    $classMember->activeMember();

  break;
}

$classMain->dataTPLarray($dataTPL);
$classMain->tpl('user-member.tpl');

?>
