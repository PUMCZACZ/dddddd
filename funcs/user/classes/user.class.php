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

class user extends main {

	var $userinfo;

	const AVATAR_DIR = 'uploaded/users/avatars';
	const FOLDER_PROFILE_IMAGES = 'uploaded/users/profiles';

	public function __construct() {

		global $db, $classMain;

		$this->db = $db;
		$this->classMain = $classMain;
    parent::getConfig();
		$this->is_user();
	}

	public function infoMsg($var)
	{
	 	$infoMsg = array(
		'USER_STATUS_0' => $this->classMain->_LANG['USER_STATUS_0'],
		'USER_STATUS_1' => $this->classMain->_LANG['USER_STATUS_1'],
		'USER_STATUS_2' => $this->classMain->_LANG['USER_STATUS_2'],
		'USER_STATUS_3' => $this->classMain->_LANG['USER_STATUS_3'],
		'CHANGES_SAVED' => $this->classMain->_LANG['CHANGES_SAVED'],
		'WATCH_DELETED_ITEM' => $this->classMain->_LANG['WATCH_DELETED_ITEM'],
		'WATCH_DELETED_USER' => $this->classMain->_LANG['WATCH_DELETED_USER'],
		'MEMBER_NAME_EMPTY' => $this->classMain->_LANG['MEMBER_NAME_EMPTY'],
		'PROFILE_PHOTO_DELETED' => $this->classMain->_LANG['PROFILE_PHOTO_DELETED'],
		'USER_UPDATED' => $this->classMain->_LANG['USER_UPDATED'],
		'USER_UPDATED_VERYFI' => $this->classMain->_LANG['USER_UPDATED_VERYFI'],
		'PASS_NO_INFO' => $this->classMain->_LANG['PASS_NO_INFO'],
		'PASS_CHNG_TITLE' => $this->classMain->_LANG['PASS_CHNG_TITLE'],
		'PASS_CHNG_INFO' => $this->classMain->_LANG['PASS_CHNG_INFO'],
		'PASS_CHNG_OK' => $this->classMain->_LANG['PASS_CHNG_OK']
		);
		return $infoMsg[$var];
	}

	public function errorMsg($var)
	{
		$errorMsg = array(
		'EMPTY_LOGIN' => $this->classMain->_LANG['EMPTY_LOGIN'],
		'EMPTY_PWD' => $this->classMain->_LANG['EMPTY_PWD'],
		'LOGIN_BLOCK' => $this->classMain->_LANG['LOGIN_BLOCK'],
		'LOGIN_ERROR' => $this->classMain->_LANG['LOGIN_ERROR'],
		'STATUS_0' => $this->classMain->_LANG['STATUS_0'],
		'STATUS_2' => $this->classMain->_LANG['STATUS_2'],
		'STATUS_3' => $this->classMain->_LANG['STATUS_3'],
		'PLEASELOGIN' => $this->classMain->_LANG['PLEASELOGIN'],
		'FRIENDS_DELETE' => $this->classMain->_LANG['FRIENDS_DELETE'],
		'PWD_INCORRECT' => $this->classMain->_LANG['PWD_INCORRECT'],
		'PWD_NEW_INCORRECT' => $this->classMain->_LANG['PWD_NEW_INCORRECT'],
		'CHARGE_PROMO_ADDED' => $this->classMain->_LANG['CHARGE_PROMO_ADDED'],
		'NO_ENOUGH_MONEY' => $this->classMain->_LANG['NO_ENOUGH_MONEY'],
		'PASS_CHNG_ERROR' => $this->classMain->_LANG['PASS_CHNG_ERROR'],
		'PASS_CHNG_PASS' => $this->classMain->_LANG['PASS_CHNG_PASS'],
		'PASS_CHNG_UPDATE_ERROR' => $this->classMain->_LANG['PASS_CHNG_UPDATE_ERROR'],
		'EMPTY_UTYPE_DATA' => $this->classMain->_LANG['EMPTY_UTYPE_DATA']
		);
		return $errorMsg[$var];
	}

	public function messagesCount()
	{
		$row = $this->db->query("SELECT COUNT(id) AS count FROM ".DB_PREFIX."_users_messages WHERE recipient_id=".$this->userinfo->user_id." AND readed=0")->fetch(PDO::FETCH_OBJ);
		return $row->count;
	}

	public function getUsername($user_id, $url=true, $icons=true)
	{
		if (empty($user_id)) return;
		$query = "SELECT user_id, username FROM ".DB_PREFIX."_users WHERE user_id=".$user_id." LIMIT 1";
		$row = $this->db->query($query)->fetch(PDO::FETCH_OBJ);
		if (empty($row)) return;
		$dataTPL = $row->username;
		return $dataTPL;
	}

	public function createAccount($email)
	{
		$row = $this->db->query("SELECT user_id FROM ".DB_PREFIX."_users WHERE user_email='".$this->formatSQL($email)."' LIMIT 1")->fetch(PDO::FETCH_OBJ);

		if ($row->user_id) return $row->user_id;
		else
		{
			require_once 'funcs/user/classes/register.class.php';
			$classRegister = new register;

			$_SESSION['dane']['user_email'] = $email;
			try {
				$classRegister->saveUser();
			} catch (Exception $e) {
				return $e->getCode();
			}
		}
	}

	public function memberInfo($type)
	{
		$row = $this->db->query("SELECT um.date_end, m.name, m.id FROM ".DB_PREFIX."_users_member um
															LEFT JOIN ".DB_PREFIX."_member_periods mp ON (mp.id=um.m_id)
															LEFT JOIN ".DB_PREFIX."_member m ON (m.id=mp.m_id)
															WHERE um.user_id=".$this->userinfo->user_id." AND um.date_end>".time()." AND type=0 ORDER BY date_end DESC LIMIT 1")->fetch(PDO::FETCH_OBJ);
		switch($type)
		{
			case 'id':
				if ($row) return $row->id;;
			break;
			case 'name':
				if ($row) return $row->name; else return $this->infoMsg('MEMBER_NAME_EMPTY');
			break;
			case 'time':
				if ($row) return date('d-m-Y', $row->date_end);
			break;
			case 'time_time':
				if ($row) return $row->date_end;
			break;
			case 'time-to-end':
				if ($row) return round(($row->date_end-time())/86400);
			break;
		}
	}

	public function watchListUsers()
	{
		$result = $this->db->query("SELECT uw.x_id, u.user_id, u.username, u.country FROM ".DB_PREFIX."_users_watch uw LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=uw.x_id) WHERE uw.user_id=".$this->userinfo->user_id." AND uw.type='user' ORDER BY uw.id DESC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->count_items = $this->countUserItems($row->user_id);
			$this->classMain->dataTPLarrayList('uw', $row);
		}
	}
	private function countUserItems($user_id)
	{
		$row = $this->db->query("SELECT COUNT(id) AS count FROM ".DB_PREFIX."_items WHERE user_id=".$user_id." AND active=1 AND save_only=0")->fetch(PDO::FETCH_OBJ);
		return $row->count;
	}
	public function itemsWatchCount()
	{
		$row = $this->db->query("SELECT x_id FROM ".DB_PREFIX."_users_watch WHERE user_id=".$this->userinfo->user_id." AND type='item' GROUP BY x_id");
		return $row->rowCount();
	}
	public function watchDelete($op=flase,$i_id, $type)
	{
		$this->db->query("DELETE FROM ".DB_PREFIX."_users_watch WHERE user_id=".$this->userinfo->user_id." AND type='".$type."' AND x_id=".$this->formatSQL($i_id, 'int'));
		switch($type)
		{
			case 'item': $msg = 'WATCH_DELETED_ITEM'; break;
			case 'user': $msg = 'WATCH_DELETED_USER'; break;
		}
		if ($op) $op = '?op='.$op;
		$this->redirect('user/watching'.$op, 'info', $this->infoMsg[$msg]);
	}
	public function watchCatsID()
	{
		$catsID = array();
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_watch WHERE user_id=".$this->userinfo->user_id." AND type='cat'");
		while ($row = $result->fetch(PDO::FETCH_OBJ)) $catsID[] = $row->x_id;
		return $catsID;
	}

	public function is_member($user_id=false)
	{
		$user_id = ($user_id) ? $user_id : $this->userinfo->user_id;
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_member WHERE user_id=".$user_id." AND date_end>".time()." ORDER BY date_end DESC LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row) return true;
	}

	private function checkVeryfi($postData)
	{
		$userinfo = (array)$this->userinfo;
		$return = 'veryfi';
		$inputsArray = array(
			'user_email',
			'company_name',
			'nip',
			'regon',
			'city',
			'post_code',
			'street',
			'country'
		);
		foreach ($inputsArray as $key => $value)
		{
			if ($userinfo[$value] != $postData[$value])
			{
				$return = 0;
				break;
			}
		}
		return $return;
	}

	public function updateUser($admin=false)
	{
		global $classRegister;

		$user_id = ($admin) ? $this->formatSQL($_POST['user_id'], 'int') : $this->userinfo->user_id;

		if ($admin)
		{
			if ($_POST['veryfi_status'] == 1 && $_POST['veryfi']) $veryfiTime = strtotime($_POST['veryfi']);
			elseif ($_POST['veryfi_status'] == 1 && empty($_POST['veryfi'])) $veryfiTime = time();
			elseif ($_POST['veryfi_status'] == '0') $veryfiTime = 0;
			$adminQuery .= ", username='".main::formatSQL($_POST['username'])."'";
			$adminQuery .= ", status=".main::formatSQL($_POST['status'], 'int');
			$adminQuery .= ", veryfi='".strtotime(main::formatSQL($_POST['veryfi']))."'";

			if ($_POST['new_pass'] && $_POST['new_pass2']) $adminQuery .= ", user_pass='".crypt($this->formatSQL($_POST['new_pass']))."'";

			$this->db->query("UPDATE ".DB_PREFIX."_users_veryfi SET status=".$this->formatSQL($_POST['veryfi_status'], 'int')." WHERE user_id=".$user_id." LIMIT 1");
		}
		else
		{
			$veryfiStatus = $this->checkVeryfi($_POST);
			#$veryfi = ", veryfi=".$veryfiStatus;
			#if ($veryfiStatus == 0) $veryfiInfo = '<br />'.$this->infoMsg('USER_UPDATED_VERYFI');
		}

		$query = "UPDATE ".DB_PREFIX."_users SET
			user_email='".$this->formatSQL($_POST['user_email'])."',
			company_name='".$this->formatSQL($_POST['company_name'])."',
			nip='".$this->formatSQL($_POST['nip'])."',
			regon='".$this->formatSQL($_POST['regon'])."',
			city='".$this->formatSQL($_POST['city'])."',
			post_code='".$this->formatSQL($_POST['post_code'])."',
			street='".$this->formatSQL($_POST['street'])."',
			region='".$this->formatSQL($_POST['region'])."',
			show_address='".$this->formatSQL($_POST['show_address'], 'int')."',
			phone='".$this->formatSQL($_POST['phone'])."',
			show_phone='".$this->formatSQL($_POST['show_phone'], 'int')."',
			website='".$this->formatSQL($_POST['website'])."',
			show_website='".$this->formatSQL($_POST['show_website'], 'int')."',
			country='".$this->formatSQL($_POST['country'])."',
			social_fb='".$this->formatSQL($_POST['social_fb'])."',
			social_insta='".$this->formatSQL($_POST['social_insta'])."'
			".$adminQuery."
			".$veryfi."
			WHERE user_id=".$user_id." LIMIT 1
		";

		$this->db->query($query);

		$this->saveLangsData($_POST, 'company_desc', 'user_id', $user_id, 'users');

		$avatar = $classRegister->saveAvatar($_FILES['avatar'], self::AVATAR_DIR.'/'.$user_id);

		if ($avatar) $classRegister->updateAvatarInfo($user_id, $avatar);

		if (!$admin)
		{
			$classRegister->savePhones($_POST, true);
			$classRegister->saveWebSites($_POST, true);
			$classRegister->saveCat($_POST, true);
		}
		throw new Exception($this->infoMsg('USER_UPDATED').$veryfiInfo);
	}



	public function logout()
	{
		$r_adres_email = $cookie[1];

		unset($_SESSION['crm'][$_SESSION['crm']['log_in_token']]['log_in']);
		unset($_SESSION['crm'][$_SESSION['crm']['log_in_token']]['log_in_time']);
		unset($_SESSION['crm']['log_in_token']);

		$this->db->query("DELETE FROM ".DB_PREFIX."_session WHERE uname='$r_adres_email'");

		$user = false;
	}

	public function deleteAccount()
	{
		$this->db->query("UPDATE ".DB_PREFIX."_users SET status=3 WHERE user_id=".$this->userinfo->user_id." LIMIT 1");
		$this->db->query("UPDATE ".DB_PREFIX."_items SET active=0 WHERE user_id=".$this->userinfo->user_id);
		$this->logout();
	}

	public function userStatus($statusID)
	{
		$statusList = array(
			0 => $this->infoMsg('USER_STATUS_0'),
			1 => $this->infoMsg('USER_STATUS_1'),
			2 => $this->infoMsg('USER_STATUS_2'),
			3 => $this->infoMsg('USER_STATUS_3')
		);
		return $statusList[$statusID];
	}

	public function setLoginUsername()
	{
		if(isset($_POST['username'])) $this->loginUsername = $this->formatSQL($_POST['username']);
		else throw new Exception($this->errorMsg('EMPTY_LOGIN'));
	}
	public function setLoginPwd()
	{
		if (isset($_POST['user_pwd'])) $this->loginPwd = $this->formatSQL($_POST['user_pwd']);
		else throw new Exception($this->errorMsg('EMPTY_PWD'));
	}
	public function setLoginInfo()
	{
		if (filter_var($this->getLoginUsername(), FILTER_VALIDATE_EMAIL)) $sql = "SELECT username, user_pass, user_id, status FROM ".DB_PREFIX."_users WHERE user_email='".$this->getLoginUsername()."' LIMIT 1";
		else $sql = "SELECT username, user_pass, user_id, status FROM ".DB_PREFIX."_users WHERE username='".$this->getLoginUsername()."' LIMIT 1";

		$result = $this->db->query($sql);
		$result = $result->fetch(PDO::FETCH_OBJ);
		if(empty($result)) throw new Exception($this->errorMsg('PWD_INCORRECT'));
		else $this->loginInfo = $result;
	}
	public function setLoginRedirect()
	{
		$forward = (isset($_SESSION['redirect']) && $_SESSION['redirect'] == 1 && !empty($_SESSION['redirect_url'])) ? $_SESSION['redirect_url'] : false;

		#$this->loginRedirect = (!empty($forward) && self::check_url($forward)) ? $forward : 'funcs.php?name=user&file=items_list';
		$this->loginRedirect = 'funcs.php?name=user&file=items_list';
		unset($_SESSION['redirect']);
		unset($_SESSION['redirect_url']);
	}
	public function getLoginInfo()
	{
		return $this->loginInfo;
	}
	public function getLoginRedirect()
	{
		return $this->loginRedirect;
	}
	public function getLoginUsername()
	{
		return $this->loginUsername;
	}
	public function getLoginPwd()
	{
		return $this->loginPwd;
	}
	public function checkPass($passNormal, $passHash)
	{
		if (crypt($passNormal, $passHash) == $passHash) return true;
		#if (password_verify($passNormal, $passHash)) return true;
		else {
			$this->saveLoginSession(0);
			throw new Exception($this->errorMsg('PWD_INCORRECT'));
		}
	}
	public function checkLoginStatus()
	{
		switch($this->loginInfo->status)
		{
			//unactive
			case 0:
				throw new Exception($this->errorMsg('STATUS_0'));
			break;

			//suspended
			case 2:
				throw new Exception($this->errorMsg('STATUS_2'));
			break;

			//delete
			case 3:
				throw new Exception($this->errorMsg('STATUS_3'));
			break;
		}
	}
	public function is_user()
	{
		if (!isset($_SESSION['crm']['log_in_token']) || !isset($_SESSION['crm'][$_SESSION['crm']['log_in_token']]['log_in'])) return $userSave = 0;

		//sprawdzanie czasu sesji
		if ($this->userSessionMaxTime() == false) return $userSave = 0;

		static $userSave;
		if (isset($userSave)) return $userSave;
		$this->userSessionDecode();

		if (isset($this->userID) && isset($this->userPwd))
		{
			$sql = "SELECT u.* FROM ".DB_PREFIX."_users u
			WHERE u.user_id=".$this->userID." LIMIT 1";

			$result = $this->db->query($sql);
			$row = $result->fetch(PDO::FETCH_OBJ);

			if ($row && ($row->user_pass == $this->userPwd) && (isset($_SESSION['crm']['log_in_token']) && $_SESSION['crm']['log_in_token'] == $this->userToken))
			{
				$_SESSION['crm'][$_SESSION['crm']['log_in_token']]['log_in_time'] = time();
				return $this->userinfo = $row;
			}
		}
		return $userSave = 0;
	}

	protected function userSessionMaxTime()
	{
		$maxTime = $this->mainConfig->session_user;
		if (!isset($_SESSION['crm'][$_SESSION['crm']['log_in_token']]['log_in_time']) || $_SESSION['crm'][$_SESSION['crm']['log_in_token']]['log_in_time']+$maxTime < time())
		{
			unset($_SESSION['crm']['log_in']);
			unset($_SESSION['crm']['log_in_time']);
			unset($_SESSION['crm']['log_in_token']);
			return false;
		}
		else return true;
	}

	protected function userSessionDecode()
	{
		if (isset($_SESSION['crm'][$_SESSION['crm']['log_in_token']]['log_in']))
		{
			$user = base64_decode($_SESSION['crm'][$_SESSION['crm']['log_in_token']]['log_in']);
			$user = addslashes($user);
			$user = explode("#", $user);
		}
		else return false;

		$this->userID = intval($user[0]);
		$this->userPwd = $user[1];
		$this->userToken = $user[2];
	}

	public function sessionLoginCheck()
	{
		$loginLimit = 3; //limit błędnych logowań
		$loginTime = 15; //czas blokady

		#$this->db->query("UPDATE ".DB_PREFIX."_session_login SET status=1 WHERE session_id='".session_id()."' AND time<".(time()-60*$loginTime));

		$row = $this->db->query("SELECT COUNT(id) AS count, time FROM ".DB_PREFIX."_session_login WHERE session_id='".session_id()."' AND status=0")->fetch(PDO::FETCH_OBJ);
		if (!$row) return;
		$endTime = $row->time+60*$loginTime;

		#if ($row->count > $loginLimit-1 && $endTime > time())
		if ($row->count > $loginLimit-1)
		{
			$this->classMain->recaptcha();
			$this->recaptcha = true;
			#$minut = round(($endTime-time())/60, 0);
			#$minutSlowo = ($minut == 1) ? 'minuta' : ($minut > 1 && $minut < 4) ? 'minuty' : 'minut';
			#throw new Exception(sprintf($this->errorMsg('LOGIN_BLOCK'), $minut, $minutSlowo));
		}
	}

	public function saveLoginSession($login=0)
	{
		#$this->db->query("DELETE FROM ".DB_PREFIX."_session_login WHERE session_id='".session_id()."' AND status=0");
		$this->db->query("INSERT INTO ".DB_PREFIX."_session_login VALUES (NULL, '".session_id()."', ".time().", '".$_SERVER['REMOTE_ADDR']."', ".$login.", 0)");
	}

	public function saveFile($plik, $nazwa_docelowa=false, $folder='uploaded', $format=false, $x=false, $y=false)
	{
		//lista akcetpwoacnych formatów
		if ($format == false)
		{
			$format = array();
			$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_default_mime");
			while ($row = $result->fetch(PDO::FETCH_OBJ)) $format[] = $row->mime;
		}

		require_once("inc/classes/class.upload.php");
		$handle = new Verot\Upload\Upload($plik);

		if ($handle->uploaded)
		{
			if (in_array($handle->file_src_mime, $format) || ($x && $y && ($handle->image_src_x <= $x && $handle->image_src_y <= $y)))
			{
				if ($nazwa_docelowa) $handle->file_src_name_body	= $nazwa_docelowa;

				$handle->Process($folder);

				//ustalanie podstawy nazw zdjcęcia
				$nazwa = ($nazwa_docelowa) ? $nazwa_docelowa.'.'.$handle->file_dst_name_ext : $handle->file_src_name;

				$handle->Clean();
				return $nazwa;
			} else return;
		} else return;
	}

	public function fbLogin($email)
	{
		$row = $this->db->query("SELECT user_id, username, user_pass FROM ".DB_PREFIX."_users WHERE user_email='".$email."' LIMIT 1")->fetch(PDO::FETCH_OBJ);

		if (empty($row->user_id)) $this->redirect('user?op=newUserFB');

		$this->loginUser($row->user_id, $row->username, $row->user_pass);

		$this->redirect('user');
	}

	public function loginUser($user_id, $username, $user_password)
	{
		//check recaptcha if necessary
		if ($this->recaptcha) $this->checkReCaptcha();

		$_SESSION['crm']['log_in_token'] = hash('ripemd160', crypt(uniqid()));
		$_SESSION['crm'][$_SESSION['crm']['log_in_token']]['log_in'] = base64_encode($user_id.'#'.$user_password.'#'.$_SESSION['crm']['log_in_token']);
		$_SESSION['crm'][$_SESSION['crm']['log_in_token']]['log_in_time'] = time();

		#ini_set('session.cookie_httponly', 1);

		$uname = $_SERVER['REMOTE_ADDR'];
		$this->db->query("DELETE FROM ".DB_PREFIX."_session WHERE uname='".$uname."' AND guest=1");
		$this->db->query("DELETE FROM ".DB_PREFIX."_session_login WHERE session_id='".session_id()."'");
		$this->db->query("UPDATE ".DB_PREFIX."_users SET ip_last='".$uname."', date_login=".time()." WHERE user_id='".$user_id."' LIMIT 1");

		//zapis logowania
		$this->db->query("INSERT INTO ".DB_PREFIX."_users_login_logs VALUES (NULL, ".$user_id.", ".time().", '".$_SERVER['REMOTE_ADDR']."')");

		$this->saveLoginSession(1);
	}

	private function fbCheckKeys()
	{
		if (empty($this->mainConfig->fb_appid) || empty($this->mainConfig->fb_secret)) return false; else return true;
	}

	public function googleLoginLink()
	{
		if (empty($this->mainConfig->google_login_id)) return;

		require_once self::FUNCS_DIR.'/user/'.self::INCLUDE_FOLDER_CLASSES.'/google/vendor/autoload.php';

		// init configuration
		$clientID = $this->mainConfig->google_login_id; //308719574631-7hf4rfbl0mi6hhm11nhakh0c0if1q87k.apps.googleusercontent.com
		$clientSecret = $this->mainConfig->google_login_secret; //J_T0-YRJQZk4Wk_3vm9vqJCH
		$redirectUri = $this->mainConfig->siteurl.'/user/register';

		// create Client Request to access Google API
		$client = new Google_Client();
		$client->setApplicationName('Login to '.$this->mainConfig->sitename);
		$client->setClientId($clientID);
		$client->setClientSecret($clientSecret);
		$client->setRedirectUri($redirectUri);
		#$client->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/plus.me");
		$client->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me");
		//$client->addScope("email");
		//$client->addScope("profile");
		//$client->setScopes(array('https://www.googleapis.com/auth/plus.login','https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me'));

		// authenticate code from Google OAuth Flow
		if (isset($_GET['code']))
		{

		  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
		  $client->setAccessToken($token['access_token']);

		  // get profile info
		  $google_oauth = new Google_Service_Oauth2($client);
		  $google_account_info = $google_oauth->userinfo->get();

		  $_SESSION['dane']['user_email'] =  $google_account_info->email;
		  $_SESSION['dane']['u_name'] =  $google_account_info->name;

			$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_users WHERE user_email='".$_SESSION['dane']['user_email']."' LIMIT 1")->fetch(PDO::FETCH_OBJ);

			if ($row)
			{
				$this->loginUser($row->user_id, $row->username, $row->user_pass);
				main::redirect($this->mainConfig->siteurl.'/user');
			}
			else main::redirect($this->mainConfig->siteurl.'/user/register');
		}
		else return $client->createAuthUrl();
	}

	public function fbLoginLink()
	{
		if ($this->fbCheckKeys() == false) return;

		require_once self::FUNCS_DIR.'/user/'.self::INCLUDE_FOLDER_CLASSES.'/Facebook/autoload.php';

		$fb = new Facebook\Facebook([
			'app_id' => $this->mainConfig->fb_appid,
			'app_secret' => $this->mainConfig->fb_secret,
			'default_graph_version' => 'v2.4',
		]);

		$helper = $fb->getRedirectLoginHelper();

		$permissions = ['email']; // optional
		try {
			if (isset($_SESSION['facebook_access_token'])) $accessToken = $_SESSION['facebook_access_token'];
			else $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			self::redirect('user');
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			self::redirect('user');
		}
	}
	public function mailsUnreaded()
	{
		$row = $this->db->query("SELECT id AS count FROM ".DB_PREFIX."_users_mails WHERE recipient=".$this->userinfo->user_id." AND status=0 GROUP BY sender");
		return $row->rowCount();
	}
	public function userPic($user_id)
	{
		$row = $this->db->query("SELECT up.*
			FROM ".DB_PREFIX."_users_photos up
			LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=up.user_id)
			WHERE up.user_id=".$user_id." AND up.main=1 ORDER BY up.id ASC LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row)
		{
			return $row->dir.'/'.$row->photo;
		}
		else return false;
	}
	protected function userPicID($user_id)
	{
		$row = $this->db->query("SELECT up.*, u.gender, ua.id AS access
			FROM ".DB_PREFIX."_users_photos up
			LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=up.user_id)
			LEFT JOIN ".DB_PREFIX."_users_access ua ON (ua.p_id=up.user_id AND ua.user_id=".intval($this->userinfo->user_id).")
			WHERE up.user_id=".$user_id." AND up.main=1 AND up.status=1 ORDER BY up.id ASC LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row)
		{
			if ($row->secret == 1 && $row->user_id != $this->userinfo->user_id && !$row->access) return false;
			else return $row->id;
		}
		else return false;
	}
	public function checkIsUser()
	{
		if (!$this->is_user()) self::redirect('user', 'error', $this->errorMsg('PLEASELOGIN'));
	}

	public function getUserTPLdata($user_id=false)
	{
		$dataTPL = array();
		if ($user_id)
		{
			$user_id = $this->formatSQL($user_id, 'int');
			$userData = $this->db->query("SELECT * FROM ".DB_PREFIX."_users WHERE user_id=".$user_id." LIMIT 1")->fetch(PDO::FETCH_ASSOC);
		}
		else if ($this->is_user())
		{
			$userData = (array) $this->userinfo;
		}

		if ($userData)
		{
			$userData['avatar'] = $this->userAvatar($userData['user_id']);
			if (!$user_id) unset($userData['user_pass']);
			$userDataKeys = array_keys($userData);
			foreach ($userDataKeys as $key => $value) $dataTPL[$value] = $userData[$value];
			$dataTPL['subdomain_url'] = self::getSubdomainUrl($dataTPL['subdomain']);
			$dataTPL['company_desc'] = main::setLangVar('company_desc', $dataTPL);

			return $dataTPL;
		}
	}
	private function getSubdomainUrl($name)
	{
		$siteUrl = $this->mainConfig->siteurl;
		$httpType = (preg_match("/http:/i", $siteUrl)) ? 'http' : 'https';

		$siteUrl = str_replace(array('http://www.', 'http://', 'https://www', 'https://'), '', $siteUrl);
		return $httpType.'://'.$name.'.'.$siteUrl;
	}
	public function userAvatar($user_id)
	{
		$row = $this->db->query("SELECT user_id, avatar FROM ".DB_PREFIX."_users WHERE user_id=".$user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row->avatar && file_exists(self::AVATAR_DIR.'/'.$row->user_id.'/'.$row->avatar)) return $this->mainConfig->siteurl.'/'.self::AVATAR_DIR.'/'.$user_id.'/'.$row->avatar;
	}
	protected function setUsersListQuery($query=false)
	{
		if (empty($query)) $this->userListQuery = "SELECT u.*, uc.name AS name2, uc.age AS age2
																								FROM ".DB_PREFIX."_users u
																								LEFT JOIN ".DB_PREFIX."_users_couple uc ON (uc.user_id=u.user_id)
																								WHERE u.complete=1 AND status=1 AND u.user_id!=".$this->userinfo->user_id;
		else $this->userListQuery = $query;
	}
	public function getUsersList($listName='users', $orderby = 'id DESC', $limit=20, $showInfo=true, $query=false)
	{
		$breakPoint = ($this->is_mobile()) ? 3 : 5;
		if (!isset($this->userListQuery)) $this->setUsersListQuery($query);
		$no = 1;
		$result = $this->db->query($this->userListQuery." ORDER BY ".$orderby." LIMIT ".$limit);
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->no = $no;
			$row->break = ($no%$breakPoint==0);
			$row->pic = $this->userPic($row->user_id);
			#$row->age = $this->getUserAge($row->birth_date);
			$row->online = $this->getUserOnLine($row->user_id);
			$row->href = $this->getUserHref($row->user_id, $row->username);
			$row->show_info = ($showInfo);
			$this->classMain->dataTPLarrayList($listName, $row);
			$no++;
		}
	}
	private function formatGetData()
	{
		$this->getData = array();
		foreach($_GET as $key => $value)
		{
			if (!is_array($value)) $this->getData[$key] = $this->formatSQL($value);
			else $this->getData[$key] = $value;
		}
	}
	protected function getUserHref($user_id, $username)
	{
		return 'funcs.php?name=profile&amp;id='.$user_id;
	}
	public function updatePwd()
	{
		try {
			$this->chng_pwd();
			$this->redirect(false, 'info', $this->infoMsg('CHANGES_SAVED'));
		} catch (Exception $e) {
			$this->redirect(false, 'error', $e->getMessage());
		}
	}
	public function updateUtype()
	{
		try {
			$this->chng_utype();
			$this->redirect(false, 'info', $this->infoMsg('CHANGES_SAVED'));
		} catch (Exception $e) {
			$this->redirect(false, 'error', $e->getMessage());
		}
	}
	private function chng_utype()
	{
		if (empty($_POST['company_name']) || empty($_POST['nip'])) throw new Exception($this->errorMsg('EMPTY_UTYPE_DATA'));
		else
		{
			$companyName = main::formatSQL($_POST['company_name']);
			$this->db->query("UPDATE ".DB_PREFIX."_users SET
				u_type='business',
				company_name='".$companyName."',
				nip='".main::formatSQL($_POST['nip'])."',
				subdomain = '".main::convertString(mb_strtolower($companyName))."'
			WHERE user_id=".$this->userinfo->user_id." LIMIT 1");
		}
	}

	private function chng_pwd()
	{
		if($this->checkPass($_POST['user-pass-now'], $this->userinfo->user_pass))
		{
			if ($_POST['user-pass-new'] == $_POST['user-pass-new2'])
			{
				require_once 'funcs/user/classes/register.class.php';
				$classRegister = new register;
				$newPass = $classRegister->hashPass($this->formatSQL($_POST['user-pass-new']));
				$this->db->query("UPDATE ".DB_PREFIX."_users SET user_pass='".$newPass."' WHERE user_id=".$this->userinfo->user_id." LIMIT 1");
				$this->loginUser($this->userinfo->user_id, $this->userinfo->username, $newPass);
			} else throw new Exception($this->errorMsg('PWD_NEW_INCORRECT'));
		}
		else throw new Exception($this->errorMsg('PWD_INCORRECT'));
	}
	public function finishRegister()
	{
		require_once 'funcs/user/classes/register.class.php';
		$classRegister = new register;
		$classRegister->finishRegister();
	}
	protected function username($user_id)
	{
		$row = $this->db->query("SELECT u.username
															FROM ".DB_PREFIX."_users u
															WHERE u.user_id=".$user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		return $row->username;
	}
	public function getWebitesTPL($user_id)
	{
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_websites WHERE user_id=".$this->formatSQL($user_id, 'int')." ORDER BY id ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ)) $this->classMain->dataTPLarrayList('websites', $row);
	}
	public function profileVisits($type=false)
	{
		switch($type)
		{
			case 'month':
				$queryLimit = " LIMIT 30";
			break;
			default:
				$queryLimit = false;
			break;
		}
		$row = $this->db->query("SELECT SUM(visits) AS sum FROM ".DB_PREFIX."_users_visits WHERE user_id=".$this->userinfo->user_id." ORDER BY id DESC".$queryLimit)->fetch(PDO::FETCH_OBJ);
		return $row->sum;
	}
	private function setProfilePhotosFolder($user_id)
	{
		$this->profilePhotosFolder = $this->mainConfig->siteurl.'/'.self::FOLDER_PROFILE_IMAGES.$user_id;
	}
	public function addProfilePhoto($files)
	{
		$this->setProfilePhotosFolder($this->userinfo->user_id);

		foreach ($files['name'] as $key => $value) {
			$file['name'] = $value;
			$file['type'] = $files['type'][$key];
			$file['tmp_name'] = $files['tmp_name'][$key];
			$file['error'] = $files['error'][$key];
			$file['size'] = $files['size'][$key];
			$photo = $this->savePhoto($file, self::FOLDER_PROFILE_IMAGES.$this->userinfo->user_id);
			if ($photo) $this->db->query("INSERT INTO ".DB_PREFIX."_users_photos VALUES (NULL, ".$this->userinfo->user_id.", '".$photo."', '".$_SERVER['REMOTE_ADDR']."', ".time().")");
		}

		$this->redirect('user/profile');
	}
	private function savePhoto($file, $folder)
	{
		require_once("inc/classes/class.upload.php");

		$handle = new Upload($file, $folder);

		$nazwa_zdjecia = uniqid();

		if ($handle->uploaded)
		{
			if (
				$handle->file_src_mime == 'image/jpeg' ||
				$handle->file_src_mime == 'image/gif' ||
				$handle->file_src_mime == 'image/png'
				)
			{
				$handle->image_resize             = true;
				$handle->image_ratio_fill         = true;
				$handle->image_background_color   = '#FFFFFF';
				$handle->image_x                  = 700;
				$handle->image_y                  = 500;
				$handle->file_src_name_body	= $nazwa_zdjecia;

				//ustalanie podstawy nazw zdjcęcia
				$nazwaZdjecia = $nazwa_zdjecia.'.'.$handle->image_src_type;

				if ($handle->Process($folder))
				#throw new Exception($handle->error);
				$handle->Clean();
			}
		} #else throw new Exception($handle->error);
		return $nazwaZdjecia;
	}
	public function profilePhotos($user_id)
	{
		$this->setProfilePhotosFolder($user_id);
		$no = 1;
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_photos WHERE user_id=".$user_id." ORDER BY id ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->no = $no;
			$row->image = $this->profilePhotosFolder.'/'.$row->photo;
			$this->classMain->dataTPLarrayList('up', $row);
			$no++;
		}
	}
	public function deleteProfilePhoto($id, $admin_user_id=false)
	{
		$user_id = ($admin_user_id) ? $this->formatSQL($admin_user_id, 'int') : $this->userinfo->user_id;
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_photos WHERE id=".$this->formatSQL($id, 'int')." AND user_id=".$user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row)
		{
			$this->setProfilePhotosFolder($row->user_id);
			$image = $this->profilePhotosFolder.'/'.$row->photo;
			if ($row->photo && file_exists($image)) unlink($image);
			$this->db->query("DELETE FROM ".DB_PREFIX."_users_photos WHERE id=".$row->id." LIMIT 1");
		}
		if (!$admin_user_id) $this->redirect('user/profile', 'info', $this->infoMsg('PROFILE_PHOTO_DELETED'));
	}
	public function paymentsList($user_id=false)
	{
		if (empty($user_id)) $user_id = $this->userinfo->user_id;
		$result = $this->db->query("SELECT ui.*, p.suma FROM ".DB_PREFIX."_users_invoices ui LEFT JOIN ".DB_PREFIX."_payments p ON (p.id=ui.p_id) WHERE ui.user_id=".$user_id." ORDER BY ui.date DESC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->date = date('d-m-Y', $row->date);
			$this->classMain->dataTPLarrayList('i', $row);
		}
	}
	public function balanceList($user_id=false)
	{
		if (empty($user_id)) $user_id = $this->userinfo->user_id;
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_balance WHERE user_id=".$user_id." ORDER BY date DESC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->type_name = $this->classMain->optName($row->type);
			$row->date = date('d-m-Y H:i:s', $row->date);
			$this->classMain->dataTPLarrayList('ub', $row);
		}
	}
	public function getInvoice($id)
	{
		$queryWhere = ($this->classMain->is_admin()) ? false : " AND ui.user_id=".$this->userinfo->user_id;
		$query = "SELECT ui.*, p.suma
			FROM ".DB_PREFIX."_users_invoices ui
			LEFT JOIN ".DB_PREFIX."_payments p ON (p.id=ui.p_id)
			WHERE 1".$queryWhere." AND ui.id=".$this->formatSQL($id, 'int')."
			LIMIT 1";
		$row = $this->db->query($query)->fetch(PDO::FETCH_OBJ);
		if ($row->invoice_id) header('Location: https://'.$this->mainConfig->fakturownia_id.'.fakturownia.pl/invoices/'.$row->invoice_id.'.pdf?api_token='.$this->mainConfig->fakturownia_token);
		#$this->redirect('user/payments');
	}
	public function getUserBallance($user_id=false)
	{
		if ($user_id === false) $user_id = $this->userinfo->user_id;
		$user_id = main::formatSQL($user_id, 'int');
		$row = $this->db->query("SELECT SUM(amount) AS amount FROM ".DB_PREFIX."_users_balance WHERE user_id=".$user_id." GROUP BY user_id")->fetch(PDO::FETCH_OBJ);
		return ($row->amount) ? $row->amount : 0;
	}
}

class Bcrypt {

	private $rounds;

	public function __construct($rounds = 12) {
		if(CRYPT_BLOWFISH != 1) {
			throw new Exception("bcrypt not supported in this installation. See http://php.net/crypt");
		}
		$this->rounds = $rounds;
	}

	public function hash($input) {
		$hash = crypt($input, $this->getSalt());

		if(strlen($hash) > 13)
			return $hash;

		return false;
	}

	public function verify($input, $existingHash) {
		$hash = crypt($input, $existingHash);

		return $hash === $existingHash;
	}

	private function getSalt() {
		$salt = sprintf('$2a$%02d$', $this->rounds);

		$bytes = $this->getRandomBytes(16);

		$salt .= $this->encodeBytes($bytes);

		return $salt;
	}

	private $randomState;

	private function getRandomBytes($count) {
		$bytes = '';

		if(function_exists('openssl_random_pseudo_bytes') && (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN')) { // OpenSSL is slow on Windows
			$bytes = openssl_random_pseudo_bytes($count);
		}

		if($bytes === '' && is_readable('/dev/urandom') && ($hRand = @fopen('/dev/urandom', 'rb')) !== FALSE) {
			$bytes = fread($hRand, $count);
			fclose($hRand);
		}

		if(strlen($bytes) < $count) {
			$bytes = '';

			if($this->randomState === null) {
				$this->randomState = microtime();
				if(function_exists('getmypid')) {
					$this->randomState .= getmypid();
				}
			}

			for($i = 0; $i < $count; $i += 16) {
				$this->randomState = md5(microtime() . $this->randomState);

				if (PHP_VERSION >= '5') {
					$bytes .= md5($this->randomState, true);
				} else {
					$bytes .= pack('H*', md5($this->randomState));
				}
			}

			$bytes = substr($bytes, 0, $count);
		}

		return $bytes;
	}

	private function encodeBytes($input) {
		// The following is code from the PHP Password Hashing Framework
		$itoa64 = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

		$output = '';
		$i = 0;
		do {
			$c1 = ord($input[$i++]);
			$output .= $itoa64[$c1 >> 2];
			$c1 = ($c1 & 0x03) << 4;
			if ($i >= 16) {
				$output .= $itoa64[$c1];
				break;
			}

			$c2 = ord($input[$i++]);
			$c1 |= $c2 >> 4;
			$output .= $itoa64[$c1];
			$c1 = ($c2 & 0x0f) << 2;

			$c2 = ord($input[$i++]);
			$c1 |= $c2 >> 6;
			$output .= $itoa64[$c1];
			$output .= $itoa64[$c2 & 0x3f];
		} while (1);

		return $output;
	}
}

?>
