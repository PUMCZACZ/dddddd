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

if ($_FILES['photo']['tmp_name']) $classUser->addProfilePhoto($_FILES['photo']);
if ($_GET['delete-photo']) $classUser->deleteProfilePhoto($_GET['delete-photo']);

$op = $classMain->getOP();

$classUser->profilePhotos($classUser->userinfo->user_id);

$dataTPL = new stdClass();
$dataTPL->op = $op;
$dataTPL->visits_all = $classUser->profileVisits();
$dataTPL->visits_month = $classUser->profileVisits('month');
$dataTPL->user_id = $classUser->userinfo->user_id;
$classMain->dataTPLarray($dataTPL);

$classMain->tpl('user-profile.tpl');
?>
