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

if (!defined('MODULE_FILE')) die ("<b>Dostęp bezpośredni zabroniony</b><br />You can't access this file directly...");

include_once 'funcs/main_page/classes/class.mainpage.php';
include_once 'funcs/items/classes/items.class.php';
$classItems = new items;

$postEmail = $classMain->formatSQL($_POST['email']);
$postCatID = $classMain->formatSQL($_POST['cat_id'], 'int');

if ($_GET['uniq_id'] && $_GET['del'] == 1)
{
	$db->query("DELETE FROM ".DB_PREFIX."_subscription WHERE uniq_id='".$classMain->formatSQL($_GET['uniq_id'])."' LIMIT 1");
	$classMain->redirect('funcs.php?name=subscription', 'info', 'Twoja subskrypcja została usunięta.');
}

if ($_GET['aktywuj'])
{
	$row = $db->query("SELECT * FROM ".DB_PREFIX."_subscription WHERE uniq_id='".$classMain->formatSQL($_GET['aktywuj'])."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
	if ($row)
	{
		$db->query("UPDATE ".DB_PREFIX."_subscription SET status=1 WHERE id=".$row->id." LIMIT 1");
		$classMain->redirect('funcs.php?name=subscription', 'info', 'Subskrypcja dla Twojego adresu email została aktywowana.');
	} else $classMain->redirect('funcs.php?name=subscription', 'error', 'Nie odnaleziono subskrybenta.');
}

if ($_POST['zapisz'])
{
	if ($classMain->checkReCaptcha())
	{
		if (filter_var($postEmail, FILTER_VALIDATE_EMAIL))
		{
			//sprawdzanie duplikatu
			$row = $db->query("SELECT * FROM ".DB_PREFIX."_subscription WHERE email='".$postEmail."' AND cat_id=".$postCatID." LIMIT 1")->fetch(PDO::FETCH_OBJ);

			if ($row) $classMain->redirect('funcs.php?name=subscription', 'error', 'Jesteś już zapisany do tej kategorii');

			$uniqID = md5(uniqid());
			$db->query("INSERT INTO ".DB_PREFIX."_subscription VALUES (NULL, ".$postCatID.", '".$postEmail."', ".time().", '".$_SERVER['REMOTE_ADDR']."', '".$uniqID."', 0)");

			$catData = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE id=".$postCatID." LIMIT 1")->fetch(PDO::FETCH_OBJ);

			//confirm email
			$classMain->sendEmail(
				$classMain->mainConfig->sitename.': Supskrypcja',
				array(
					'SITEURL' => $classMain->mainConfig->siteurl,
					'LOGO' => $classMain->mainConfig->siteurl.'/theme/img/logo.png',
					'SITENAME' => $classMain->mainConfig->sitename,
					'CAT_NAZWA' => $classMain->setLangVar('name', $catData),
					'UNIQ_ID' => $uniqID
				),
				'email_subscription_start.tpl',
				$postEmail
			);

			$classMain->redirect('funcs.php?name=subscription', 'info', 'Subskrypcja dla Twojego adresu email została zapisana - prosimy odebrać e-mail z linkiem potwierdzającym.');
		}
		else $classMain->redirect('funcs.php?name=subscription', 'error', 'Nieprawdiłowy adres e-mail');
	} else $classMain->redirect('funcs.php?name=subscription', 'error', 'Prosimy potwierdzić autentyczność');
}

$classItems->catsList(false);
$classMain->recaptcha();

$dataTPL = array(
	'EMAIL' => $postEmail,
	'CAT_ID' => $postCatID
);

$classMain->dataTPLarray($dataTPL);

$classMain->tpl('subscription.tpl');
?>
