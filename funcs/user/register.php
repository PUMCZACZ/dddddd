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

require_once 'funcs/user/classes/user.class.php';
require_once 'funcs/user/classes/register.class.php';
$classRegister = new register;

if ($_GET['check-available'] == 1) $classRegister->checkUsername($_POST['username']);

$op = $classMain->getOP();

switch($op)
{
	default:

		$classRegister->clearSession();

		$classMain->optList('kraj');
		$classMain->optList('region');
		$classMain->langsList('desc_langs', 'company_desc', $_SESSION['dane']);

		$classRegister->phonesList();
		$classRegister->websitesList();

		$classMain->recaptcha();

		$dataTPL = array();
		$dataTPL = $_SESSION['dane'];
		$dataTPL['company_desc'] = $classMain->setLangVar('company_desc', $_SESSION['dane']);
		$dataTPL['avatar_dir'] = $_SESSION['avatar']['dir'];
		$dataTPL['avatar_filename'] = $_SESSION['avatar']['filename'];
		$dataTPL['REJESTRACJA'] = true;

		$classMain->dataTPLarray($dataTPL);
		$classMain->tpl('user-register.tpl');

	break;

	case 'finish':

		$classRegister->saveSession();

		$classRegister->setUserData();

		//check recaptach
		try {
			#$classMain->checkReCaptcha();
			$classRegister->userCheck();
		} catch (Exception $e) {
			$classMain->redirect('funcs.php?name=user&file=register#1', 'error', $e->getMessage());
		}
		//save user
		try {
			$classRegister->saveUser();
		} catch (Exception $e) {
			$classMain->redirect('index.php', 'info', $e->getMessage());
		}

	break;

	case 'activate':

		if ($classRegister->is_user()) $classMain->redirect('funcs.php?name=user#user');

		try {
			$classRegister->activateUser();
		} catch (Exception $e) {
			$classMain->redirect('funcs.php?name=user', 'error', $e->getMessage());
		}
		$classMain->redirect('funcs.php?name=user', 'info', $classMain->_LANG['_LANG_588']);

	break;

}

?>
