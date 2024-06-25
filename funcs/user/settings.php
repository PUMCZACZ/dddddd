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

require_once 'funcs/user/classes/user.class.php';
$classUser = new user;
$classUser->checkIsUser();

$op = $classMain->getOP();

switch($op)
{
	case 'delete-account':
		try{
			$classUser->deleteAccount();
		} catch (Exception $e) {
			$classMain->redirect('funcs.php?name=user&file=settings', 'error', $e->getMessage());
		}
		$classMain->redirect($classMain->mainConfig->siteurl, 'info', 'Twoje konto zostało usunięte z serwisu.');
	break;
	case 'chng-pwd':
		try{
			$classUser->chng_pwd();
		} catch (Exception $e) {
			$classMain->redirect('funcs.php?name=user&file=settings', 'error', $e->getMessage());
		}
		$classMain->redirect('funcs.php?name=user&file=settings', 'info', 'Zmiany zostały zapisane.');
	break;
	case 'update':
		try{
			$classUser->update();
		} catch (Exception $e) {
			$classMain->redirect('funcs.php?name=user&file=settings', 'error', $e->getMessage());
		}
		$classMain->redirect('funcs.php?name=user&file=settings', 'info', 'Zmiany zostały zapisane.');
	break;

	default:
		$dataTPL = array();

		$classMain->dataTPLarray($dataTPL);

		$classMain->dataTPLarray($classUser->getUserTPLdata());

		$classMain->tpl('user-settings.tpl');
	break;

}

?>
