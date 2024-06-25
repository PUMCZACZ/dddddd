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

if (!defined('ADMIN_FILE')) die ("Access Denied");

$settings = $db->query("SELECT * FROM ".DB_PREFIX."_config LIMIT 1")->fetch(PDO::FETCH_OBJ);

$classMain->dataTPLarray($settings);

switch ($op)
{
	case 'settings-member':
		if (isset($_POST['save']))
		{
			$db->query("UPDATE ".DB_PREFIX."_config SET
												member_reminder=".$classMain->formatSQL($_POST['member_reminder'], 'int').",
												member_items_visible=".$classMain->formatSQL($_POST['member_items_visible'], 'int')."
												LIMIT 1
			");

			$classMain->redirect(ADMIN_FILE.'.php?op=settings-member&info=Ustawienia+zostały+zaktualizowane');
		}
	break;
	case 'settings-items':
		if (isset($_POST['save']))
		{
			$db->query("UPDATE ".DB_PREFIX."_config SET
												items_bids=".$classMain->formatSQL($_POST['items_bids'], 'int').",
												items_distinction=".$classMain->formatSQL($_POST['items_distinction'], 'int').",
												item_member=".$classMain->formatSQL($_POST['item_member'], 'int').",
												item_login=".$classMain->formatSQL($_POST['item_login'], 'int').",
												member_items_message=".$classMain->formatSQL($_POST['member_items_message'], 'int').",
												item_photos=".$classMain->formatSQL($_POST['item_photos'], 'int')."
												LIMIT 1
			");

			$classMain->redirect(ADMIN_FILE.'.php?op=settings-items&info=Ustawienia+zostały+zaktualizowane');
		}
	break;
	case 'settings-users':
		if (isset($_POST['save']))
		{
			$db->query("UPDATE ".DB_PREFIX."_config SET
												access_delete='".$_POST['access_delete']."'
			");

			$classMain->redirect(ADMIN_FILE.'.php?op=settings-users&info=Ustawienia+zostały+zaktualizowane');
		}
	break;
	case 'settings-prices':
		if (isset($_POST['save']))
		{
			$db->query("UPDATE ".DB_PREFIX."_config SET
												p24_id='".$_POST['p24_id']."',
												p24_crc='".$_POST['p24_crc']."',
												p24_currency='".$_POST['p24_currency']."',
												p24_tryb='".$_POST['p24_tryb']."',
												paypal_username='".$_POST['paypal_username']."',
												paypal_password='".$_POST['paypal_password']."',
												paypal_waluta='".$_POST['paypal_waluta']."',
												paypal_api_key='".$_POST['paypal_api_key']."',
												paypal_tryb='".$_POST['paypal_tryb']."',
												currency='".$_POST['currency']."',
												fakturownia_id='".$_POST['fakturownia_id']."',
												fakturownia_did='".$_POST['fakturownia_did']."',
												fakturownia_token='".$_POST['fakturownia_token']."',
												sms_pay='".$_POST['sms_pay']."'
			");

			$classMain->redirect(ADMIN_FILE.'.php?op=settings-prices&info=Ustawienia+zostały+zaktualizowane');
		}
	break;
	case 'settings-session':
		if (isset($_POST['save']))
		{
			$db->query("UPDATE ".DB_PREFIX."_config SET
												session_user='".$_POST['session_user']."',
												session_admin='".$_POST['session_admin']."'
			");

			$classMain->redirect(ADMIN_FILE.'.php?op=settings-session&info=Ustawienia+zostały+zaktualizowane');
		}
	break;

	case 'settings-mail':
		if (isset($_POST['save']))
		{
			$db->query("UPDATE ".DB_PREFIX."_config SET
												email_type='".$_POST['email_type']."',
												email_host='".$_POST['email_host']."',
												email_port='".$_POST['email_port']."',
												email_user='".$_POST['email_user']."',
												email_pass='".$_POST['email_pass']."',
												email_email='".$_POST['email_email']."',
												email_name='".$_POST['email_name']."'
			");

			$classMain->redirect(ADMIN_FILE.'.php?op=settings-mail&info=Ustawienia+zostały+zaktualizowane');
		}
	break;

	case "settings":

		if (!empty($_FILES['logo']['tmp_name'])) $classMain->saveFile($_FILES['logo'], 'logo', 'theme/img');
		if (!empty($_FILES['logo_fb']['tmp_name'])) $classMain->saveFile($_FILES['logo_fb'], 'logo_fb', 'theme/img');
		if (!empty($_FILES['mp_bg']['tmp_name'])) $classMain->saveFile($_FILES['mp_bg'], 'mp-bg', 'theme/img');

		if (isset($_POST['save']))
		{
			$query = "UPDATE ".DB_PREFIX."_config SET
												sitename='".$_POST['sitename']."',
												siteurl='".$_POST['siteurl']."',
												contact='".$_POST['contact']."',
												contact_email='".$_POST['contact_email']."',
												meta_keywords='".$_POST['meta_keywords']."',
												meta_desc='".$_POST['meta_desc']."',
												g_recaptcha_sitekey='".$_POST['g-recaptcha-sitekey']."',
												g_recaptcha_secret='".$_POST['g-recaptcha-secret']."',
												google_analitics='".addslashes($_POST['google_analitics'])."',
												site_break=".intval($_POST['site_break']).",
												site_fb_link='".$classMain->formatSQL($_POST['site_fb_link'])."',
												site_tw_link='".$classMain->formatSQL($_POST['site_tw_link'])."',
												site_in_link='".$classMain->formatSQL($_POST['site_in_link'])."',
												multilang=".$classMain->formatSQL($_POST['multilang'], 'int').",
												fb_login=".main::formatSQL($_POST['fb_login'], 'int').",
												fb_appid='".main::formatSQL($_POST['fb_appid'])."',
												fb_secret='".main::formatSQL($_POST['fb_secret'])."',
												google_login=".main::formatSQL($_POST['google_login'], 'int').",
												google_login_id='".main::formatSQL($_POST['google_login_id'])."',
												google_login_secret='".main::formatSQL($_POST['google_login_secret'])."',
												module_companies=".$classMain->formatSQL($_POST['module_companies'], 'int')."
			";
			$db->query($query);
			$classMain->redirect(ADMIN_FILE.'.php?op=settings&info=Ustawienia+zostały+zaktualizowane');
		}
	break;
}

$dataTPL['op'] = $op;
$classMain->dataTPLarray($dataTPL);
$adminClass->OpenTableAdmin();
$classMain->tpl('settings.tpl');
$adminClass->CloseTableAdmin();
?>
