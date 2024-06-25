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
$classUser = new user;
$classRegister = new register;

$op = $classMain->getOP();

switch($op)
{
	case 'logout':

		$classUser->logout();

		$classMain->redirect($classMain->mainConfig->siteurl, 'info', 'Zostałeś bezpiecznie wylogowany');

	break;

	case "login":

		try {
			$classUser->sessionLoginCheck();
			$classUser->setLoginUsername();
			$classUser->setLoginPwd();
			$classUser->setLoginInfo();
			$classUser->setLoginRedirect();
		} catch (Exception $e) {
			$classMain->redirect(false, 'error', $e->getMessage());
		}

		try{
			$classUser->checkPass($classUser->getLoginPwd(), $classUser->getLoginInfo()->user_pass);
			$classUser->checkLoginStatus();
			//token dla sesji
			$classUser->loginUser($classUser->getLoginInfo()->user_id, $classUser->getLoginInfo()->username, $classUser->getLoginInfo()->user_pass);

			$classMain->deleteRedirect();
			$classMain->redirect($classUser->getLoginRedirect());
		} catch (Exception $e) {
			$classUser->saveLoginSession(0);
			$classMain->redirect(false, 'error', $e->getMessage());
		}

	break;

	case 'pass_lost':

		if (!$classUser->is_user())
		{
			$classMain->recaptcha();
			$classMain->template->assign_vars(array(
						'TOKEN' => $classMain->formatSQL($_GET['token']),
						'ZMIEN' => (!empty($_GET['token']))
			));

			$classMain->template->set_filenames(array(
						'body' => 'user-pass-forgot.tpl'
					));
			$classMain->template->display('body');

		}
		else $classMain->redirect('funcs.php?name=user');

	break;

	case 'mailpasswd':

		require_once 'funcs/user/classes/register.class.php';
		$classRegister = new register;

		if (isset($_POST['adres_email']))
		{
			try{
				$classMain->checkReCaptcha();
			} catch (Exception $e) {
				$classMain->redirect('funcs.php?name=user&op=pass_lost', 'error', $e->getMessage());
			}
			$adres_email = $classMain->formatSQL($_POST['adres_email']);
			$sql = "SELECT user_id, username, user_email, user_pass, pass_lost_token, pass_lost_time FROM ".DB_PREFIX."_users WHERE user_email='".$adres_email."' LIMIT 1";
		}
		else
		{
			$token = $classMain->formatSQL($_POST['token']);
			$sql = "SELECT user_id, username, user_email, user_pass, pass_lost_token, pass_lost_time FROM ".DB_PREFIX."_users WHERE pass_lost_token='".$token."' LIMIT 1";
		}
		$row = $db->query($sql)->fetch(PDO::FETCH_OBJ);

		if (!$row->user_id) $classMain->redirect('funcs.php?name=user&op=pass_lost', 'error', $classUser->errorMsg('PASS_CHNG_ERROR'));
		else
		{
			//pass change
			if ($_POST['new_pass'] || $_POST['new_pass2'])
			{
				if ($_POST['new_pass'] != $_POST['new_pass2']) $classMain->redirect('funcs.php?name=user&op=pass_lost&token='.$token, 'error', $classUser->errorMsg('PASS_CHNG_PASS'));

				$host_name = $_SERVER['REMOTE_ADDR'];
				$adres_email = $row->user_email;

				$tokenTime = 3600*12;//czas w godzinach (12h)

				#if (($row['pass_lost_time']+$tokenTime) < time()) $classMain->redirect('funcs.php?name=user&op=pass_lost&token='.$token, 'error', 'Kod+potwierdzający+utracił+swoją+ważność.');

				$newpass = $classMain->formatSQL($_POST['new_pass']);
				$cryptpass = $classRegister->hashPass($newpass);
				$token = md5(uniqid());
				$query = "UPDATE ".DB_PREFIX."_users SET user_pass='".$cryptpass."', pass_lost_token='".uniqid()."' WHERE user_id=".$row->user_id." LIMIT 1";

				if (!$db->query($query)) $classMain->redirect('funcs.php?name=user&op=pass_lost', 'error', $classUser->errorMsg('PASS_CHNG_UPDATE_ERROR'));

				$classMain->redirect($classMain->mainConfig->siteurl, 'info', $classUser->infoMsg('PASS_CHNG_OK'));
			}
			else
			{
				//send veryfi email
				$sql = "SELECT user_id, user_email, user_pass FROM ".DB_PREFIX."_users WHERE user_email='".$adres_email."' LIMIT 1";
				$row = $db->query($sql)->fetch(PDO::FETCH_OBJ);

				if(empty($row->user_id)) $classMain->redirect('funcs.php?name=user&op=pass_lost', 'error', $classUser->infoMsg('PASS_NO_INFO'));
				else
				{
					$host_name = $_SERVER['REMOTE_ADDR'];
					$adres_email = $row->user_email;
					$user_password = $row->user_pass;

					//generowanie tokena
					$token = md5(uniqid());
					$db->query("UPDATE ".DB_PREFIX."_users SET pass_lost_token='".$token."', pass_lost_time=".time()." WHERE user_id=".$row->user_id." LIMIT 1");

					$dataTPL = array(
											'SITEURL' => $classMain->mainConfig->siteurl,
											'LOGO' => $classMain->mainConfig->siteurl.'/theme/images/logo.png',
											'SITENAME' => $classMain->mainConfig->sitename,

											'USERNAME' => $row->username,
											'HOST_NAME' => $host_name,
											'TOKEN' => $token,
											'ROK' => $year
					);
					$subject = $classUser->infoMsg('PASS_CHNG_TITLE');
					$classMain->sendEmail($subject, $dataTPL, 'email_pass.php', $adres_email);

					$classMain->redirect($classMain->mainConfig->siteurl, 'info', $classUser->infoMsg('PASS_CHNG_INFO'));
				}
			}
		}
	break;

	default:

		if ($classUser->is_user())
		{
			if ($_POST['delete-account'] == 1) $classUser->deleteAccount();
			if ($_POST['save'])
			{
				try {
					$classUser->updateUser();
				} catch (Exception $e) {
					$classMain->redirect('funcs.php?name=user', 'info', $e->getMessage());
				}
			}
			if ($_POST['chngPwd'] == 1) $classUser->updatePwd();
			if ($_POST['chngUtype'] == 1) $classUser->updateUtype();
			$classMain->optList('kraj');
			$classMain->langsList('desc_langs', 'company_desc', (array)$classUser->userinfo);

			$classRegister->catsList();

			$classRegister->phonesList(true);
			$classRegister->websitesList(true);
			$classRegister->userCatsList(true);

			$dataTPL = $classUser->getUserTPLdata();
			$dataTPL['user_main'] = true;
			$dataTPL['user_edit'] = true;
			$dataTPL['payment_info'] = (isset($_GET['paymentInfo']) && $_GET['paymentInfo'] == 2) ? true : false;
		}
		else
		{
			$classUser->sessionLoginCheck();
			$dataTPL['user-login'] = true;
			$dataTPL['fb-login-link'] = $classUser->fbLoginLink();
			$dataTPL['google-login-link'] = ($classMain->mainConfig->google_login == 1) ? $classUser->googleLoginLink() : false;
		}

		$classMain->dataTPLarray($dataTPL);

		$classMain->tpl(($classUser->is_user()) ? 'user-main.tpl' : 'user-login.tpl');
		exit;

	break;

}

?>
