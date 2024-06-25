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

class register extends user {

	const BIRTH_SEPARATOR = '-';
	const MIN_AGE = 18;
	const AVATAR_DIR = 'uploaded/users/avatars/';

	public function __construct() {

		global $db, $classMain;

		$this->db = $db;
		$this->classMain = $classMain;
    parent::getConfig();
		parent::is_user();
	}

	public function infoMsg($var)
	{
		$infoMsg = array(
		'REGISTER_END' => $this->classMain->_LANG['REGISTER_END']
		);
		return $infoMsg[$var];
	}

	public function errorMsg($var)
	{
		$errorMsg = array(
		'EMAILACTIVATETITLE' => $this->classMain->_LANG['EMAILACTIVATETITLE'],
		'ACTIVATE_EMPTY_DATA' => $this->classMain->_LANG['ACTIVATE_EMPTY_DATA'],
		'USER_CHECK_EMAIL' => $this->classMain->_LANG['USER_CHECK_EMAIL'],
		'USER_CHECK_EMAIL2' => $this->classMain->_LANG['USER_CHECK_EMAIL2'],
		'USER_CHECK_NAME' => $this->classMain->_LANG['USER_CHECK_NAME'],
		'USERNAME_FREE' => $this->classMain->_LANG['USERNAME_FREE'],
		);
		return $errorMsg[$var];
	}

	public function catsList($id=0, $limit=false, $activeArray=false)
	{
		if ($limit) $queryLimit = ' LIMIT '.main::formatSQL($limit, 'int');

		if (is_array($id) && is_array($activeArray))
		{
			foreach ($activeArray as $key => $value)
			{
				$this->classMain->dataTPLarrayList('sc', array());
				$result = $this->db->query("SELECT c2.*
																		FROM ".DB_PREFIX."_cats c1
																		LEFT JOIN ".DB_PREFIX."_cats c2 ON (c2.left_id=c1.left_id)
																		WHERE c1.id=".$this->formatSQL($value, 'int')."
																		ORDER BY c2.position ASC");
				while ($row = $result->fetch(PDO::FETCH_OBJ))
				{
					$row->name = $this->classMain->setLangVar('name', $row);
					$row->active = ($row->id == $id || (is_array($activeArray) && in_array($row->id, $activeArray))) ? true : false;
					$this->classMain->dataTPLarrayList('sc.c', $row, false);
				}
			}
		}
		else
		{
			$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE id=".$this->formatSQL($id, 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);

			if ($row->level > 0) $query = ($row->last == 1) ? " left_id=".$row->left_id : " left_id=".$row->id;
			else $query = "left_id=0";

			$dataTPL = array();
			$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE ".$query." ORDER BY position ASC".$queryLimit);
			while ($row = $result->fetch(PDO::FETCH_OBJ))
			{
				$row->name = $this->classMain->setLangVar('name', $row);
				$row->active = ($row->id == $id || (is_array($activeArray) && in_array($row->id, $activeArray))) ? true : false;
				$this->classMain->dataTPLarrayList('c', $row, false);

				$result2 = $this->db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE left_id='".$row->id."' ORDER BY position ASC");
				while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
				{
					$row2->name = $this->classMain->setLangVar('name', $row2);
					$row2->active = ($row2->id == $id || (is_array($activeArray) && in_array($row2->id, $activeArray))) ? true : false;
					$this->classMain->dataTPLarrayList('c.u', $row2, false);
				}
			}
		}
	}

	public function phonesList($edit=false, $user_id=false)
	{
		if (empty($user_id)) $user_id = $this->userinfo->user_id;
		switch($edit)
		{
			case true:
				$no = 0;
				$dataTPL = array();
				$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_phones WHERE user_id=".$user_id." ORDER BY id ASC");
				while ($row = $result->fetch(PDO::FETCH_OBJ))
				{
					$phoneLangArray = explode(',', $row->langs);
					$dataTPL['nrs'] = $no;
					$dataTPL['nr'] = $row->number;
					$dataTPL['id'] = $row->id;
					$result2 = $this->db->query("SELECT * FROM ".DB_PREFIX."_config_langs");
					while ($row2 = $result2->fetch(PDO::FETCH_OBJ)) $dataTPL['nr_'.$row2->name_def] = (in_array($row2->name_def, $phoneLangArray)) ? 'on' : false;
					$this->classMain->dataTPLarrayList('phones', $dataTPL);
					$no++;
				}
			break;

			default:
				if (is_array($_SESSION['dane']['nrs']))
				{
					$dataTPL = array();
					foreach ($_SESSION['dane']['nrs'] as $key => $value)
					{
						$dataTPL['nrs'] = $value;
						$dataTPL['nr'] = $_SESSION['dane']['nr'][$key];
						$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_config_langs");
						while ($row = $result->fetch(PDO::FETCH_OBJ)) $dataTPL['nr_'.$row->name_def] = $_SESSION['dane']['nr_'.$row->name_def][$key];
						$this->classMain->dataTPLarrayList('phones', $dataTPL);
					}
				}
			break;
		}
	}
	public function websitesList($edit=false, $user_id=false)
	{
		if (empty($user_id)) $user_id = $this->userinfo->user_id;
		switch ($edit)
		{
			case true:
				$no = 0;
				$dataTPL = array();
				$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_websites WHERE user_id=".$user_id." ORDER BY id ASC");
				while ($row = $result->fetch(PDO::FETCH_OBJ))
				{
					$dataTPL['addrs'] = $no;
					$dataTPL['addr'] = $row->website;
					$dataTPL['id'] = $row->id;
					$this->classMain->dataTPLarrayList('websites', $dataTPL);
					$no++;
				}
			break;
			default:
				if (is_array($_SESSION['dane']['addrs']))
				{
					$dataTPL = array();
					foreach ($_SESSION['dane']['addrs'] as $key => $value)
					{
						$dataTPL['addrs'] = $value;
						$dataTPL['addr'] = $_SESSION['dane']['addr'][$key];
						$this->classMain->dataTPLarrayList('websites', $dataTPL);
					}
				}
			break;
		}
	}
	public function userCatsList($edit=false, $user_id=false)
	{
		if (empty($user_id)) $user_id = $this->userinfo->user_id;
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_cats WHERE user_id=".$user_id." ORDER BY id ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$this->classMain->dataTPLarrayList('uc', $row);
			if ($row->cat_ip)
			{
				$catArray = explode('.', $row->cat_ip);
				foreach ($catArray as $key => $value)
				{
					$this->classMain->dataTPLarrayList('uc.c', array('id' => $value));
					$left_id = ($value == 0) ? 0 : "(SELECT left_id FROM ".DB_PREFIX."_cats_profiles WHERE id=".$this->formatSQL($value, 'int')." LIMIT 1)";
					$result2 = $this->db->query("SELECT * FROM ".DB_PREFIX."_cats_profiles WHERE left_id=".$left_id);
					while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
					{
						$row2->selected = ($row2->id == $value);
						$row2->name = $this->setLangVar('name', $row2);
						$this->classMain->dataTPLarrayList('uc.c.cats', $row2);
					}
				}
			}
			else
			{
				$this->classMain->dataTPLarrayList('uc.c', array());
				$result2 = $this->db->query("SELECT * FROM ".DB_PREFIX."_cats_profiles WHERE left_id=0 ORDER BY position ASC");
				while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
				{
					$row2->name = $this->setLangVar('name', $row2);
					$this->classMain->dataTPLarrayList('uc.c.cats', $row2);
				}
			}
		}
	}

	public function checkUsername($username)
	{
		$username = $this->formatSQL($username);
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_users WHERE username='".$username."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row) echo '<span class="text-danger">'.$this->errorMsg('USER_CHECK_NAME').' <em class="fa fa-ban"></em></span>';
		else echo '<span class="text-success">'.$this->errorMsg('USERNAME_FREE').' <em class="fa fa-check"></em></span>';
		exit;
	}

	public function userCheck()
	{
		$dane = $_SESSION['dane'];

		//sprawdzanie danych dla SESJI
		$tablicaKluczy = array_keys($_SESSION['dane']);
		for ($i=0; $i < count($tablicaKluczy); $i++) if (!is_array($_SESSION['dane'][$tablicaKluczy[$i]])) $_SESSION['dane'][$tablicaKluczy[$i]] = htmlspecialchars(strip_tags($_SESSION['dane'][$tablicaKluczy[$i]]));

		#if (empty($dane['regulamin'])) $stop = 'Rejestracja wymaga akceptacji regulaminu';
		if ($this->db->query("SELECT user_email FROM ".DB_PREFIX."_users WHERE user_email='".$dane['user_email']."' LIMIT 1")->rowCount()) throw new Exception($this->errorMsg('USER_CHECK_EMAIL'));
		if ($this->db->query("SELECT username FROM ".DB_PREFIX."_users WHERE username='".$dane['username']."' LIMIT 1")->rowCount()) throw new Exception($this->errorMsg('USER_CHECK_NAME'));
		if (empty($dane['user_email']) || !filter_var($dane['user_email'], FILTER_VALIDATE_EMAIL)) throw new Exception($this->errorMsg('USER_CHECK_EMAIL2'));
	}

	//posolenie hasła
	public function hashPass($haslo) {

		/*$options = array(
			'cost' => 13,
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
		);
		return password_hash($haslo, PASSWORD_BCRYPT, $options);*/
		return crypt($haslo);

	}

	private function createPass()
	{
		$password = false;
		$charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		for($i = 0; $i < 8; $i++)
		{
			$random_int = mt_rand();
			$password .= $charset[$random_int % strlen($charset)];
		}
		return $password;
	}

	private function genCheckSum()
	{
		return md5(uniqid());
	}
	private function setUserPass()
	{
		if (empty($_SESSION['dane']['user_pass'])) $this->user_pass = $this->createPass();
		$_SESSION['dane']['user_pass'] = ($this->user_pass) ? $this->user_pass : $_SESSION['dane']['user_pass'];
		$_SESSION['dane']['user_pass'] = $this->hashPass($_SESSION['dane']['user_pass']);
	}
	public function setUserData()
	{
		$this->setUserAvatar();
		foreach ($_SESSION['dane'] as $key => $value) if (!is_array($_SESSION['dane'][$key])) $_SESSION['dane'][$key] = $this->formatSQL($value);
	}
	private function setUserType()
	{
		$this->u_type = ($_SESSION['dane']['type'] == 'business') ? 'business' : 'standard';
	}
	public function saveUser()
	{
		$check_num = self::genCheckSum();
		self::setUserPass();
		self::setUserType();
		#self::setUserAvatar();

		$query = "INSERT INTO ".DB_PREFIX."_users (
																type,
																u_type,
																check_num,
																username,
																user_pass,
																user_email,
																user_email_main,
																ip_last,
																date_reg,
																date_login,

																company_name,
																nip,
																regon,
																city,
																post_code,
																street,
																show_address,
																phone,
																show_phone,
																website,
																show_website,
																region,
																country,

																lang,
																subdomain
															)VALUES (
																1,
																'".$this->u_type."',
																'".$check_num."',
																'".$_SESSION['dane']['username']."',
																'".$_SESSION['dane']['user_pass']."',
																'".$_SESSION['dane']['user_email']."',
																'".$_SESSION['dane']['user_email']."',
																'".$this->formatSQL($_SERVER['REMOTE_ADDR'])."',
																".time().",
																'',

																'".$_SESSION['dane']['company_name']."',
																'".$_SESSION['dane']['nip']."',
																'".$_SESSION['dane']['regon']."',
																'".$_SESSION['dane']['city']."',
																'".$_SESSION['dane']['post_code']."',
																'".$_SESSION['dane']['street']."',
																".intval($_SESSION['dane']['show_address']).",
																'".$_SESSION['dane']['phone']."',
																".intval($_SESSION['dane']['show_phone']).",
																'".$_SESSION['dane']['website']."',
																".intval($_SESSION['dane']['show_website']).",
																'".$_SESSION['dane']['region']."',
																'".$_SESSION['dane']['country']."',

																'".$this->defLang."',
																'".main::convertString(mb_strtolower($_SESSION['dane']['company_name']))."'
		)";
		$this->db->query($query);

		//tworzenie linka aktywacyjnego
		$this->user_id = $this->db->lastInsertId();

		$this->updateAvatarInfo($this->user_id, $_SESSION['avatar']['filename'], $_SESSION['avatar']['dir']);

		$this->savePhones($_SESSION['dane']);
		$this->saveWebSites($_SESSION['dane']);
		$this->saveCat($_SESSION['dane']);
		$this->saveLangsData($_SESSION['dane'], 'company_desc', 'user_id', $this->user_id, 'users');

		//email aktywacyjny
		$this->emailActivate($this->user_id);

		//logowanie użytkownika
		#$this->loginUser($user_id, $this->getUserEmail(), $this->getUserPass());

		unset($_SESSION['dane']);
		unset($_SESSION['avatar']);

		#return $this->user_id;
		throw new Exception($this->infoMsg('REGISTER_END'), $this->user_id);

	}
	public function savePhones($data, $edit=false)
	{
		if ($edit == true)
		{
			$this->db->query("DELETE FROM ".DB_PREFIX."_users_phones WHERE user_id=".$this->formatSQL($this->userinfo->user_id, 'int'));
			$this->user_id = $this->userinfo->user_id;
		}

		$numbersArray = $data['nrs'];

		if (is_array($numbersArray))
		{
			foreach ($numbersArray as $key => $value)
			{
				$number = $data['nr'][$key];

				$langs = array();
				$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_config_langs");
				while ($row = $result->fetch(PDO::FETCH_OBJ))
				{
					if ($data['nr_'.$row->name_def][$key] == 'on') $langs[] = $row->name_def;
				}
				$this->db->query("INSERT INTO ".DB_PREFIX."_users_phones VALUES (NULL, ".$this->user_id.", '".$number."', '".implode(',', $langs)."')");
			}
		}
	}
	public function saveWebSites($data, $edit=false)
	{
		if ($edit == true)
		{
			$this->db->query("DELETE FROM ".DB_PREFIX."_users_websites WHERE user_id=".$this->userinfo->user_id);
			$this->user_id = $this->userinfo->user_id;
		}
		if (is_array($data['addr']))
		{
			foreach ($data['addr'] as $key => $value)
			{
				$this->db->query("INSERT INTO ".DB_PREFIX."_users_websites VALUES (NULL, ".$this->user_id.", '".$value."')");
			}
		}
	}
	public function saveCat($data, $edit=false)
	{
		/*$this->db->query("
			DELETE FROM ".DB_PREFIX."_users_cats WHERE user_id=".$this->userinfo->user_id.";
			INSERT INTO ".DB_PREFIX."_users_cats (user_id) VALUES (".$this->userinfo->user_id.");
			INSERT INTO ".DB_PREFIX."_users_cats (user_id) VALUES (".$this->userinfo->user_id.");
			INSERT INTO ".DB_PREFIX."_users_cats (user_id) VALUES (".$this->userinfo->user_id.");
		");*/

		if ($edit == true)
		{
			if (is_array($data['cat_id']))
			{
				foreach ($data['cat_id'] as $key => $value)
				{
					if (is_array($value))
					{
						$cat_id = $this->formatSQL(end($value), 'int');
						$row = $this->db->query("SELECT id, ip FROM ".DB_PREFIX."_cats_profiles WHERE id=".$cat_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
						$query = "UPDATE ".DB_PREFIX."_users_cats SET
							cat_id='".$row->id."',
							cat_ip='".$row->ip."'
							WHERE id=".$this->formatSQL($key, 'int')." AND user_id=".$this->userinfo->user_id."
						";
						$this->db->query($query);
					}
				}
			}
		}
		else
		{
			$this->db->query("
				INSERT INTO ".DB_PREFIX."_users_cats (user_id) VALUES (".$this->user_id.");
				INSERT INTO ".DB_PREFIX."_users_cats (user_id) VALUES (".$this->user_id.");
				INSERT INTO ".DB_PREFIX."_users_cats (user_id) VALUES (".$this->user_id.");
			");
		}
	}

	private function setUserAvatar()
	{
		if (empty($_SESSION['avatar']['dir'])) $_SESSION['avatar']['dir'] = self::AVATAR_DIR.uniqid();
		if ($_FILES['avatar']['tmp_name']) $_SESSION['avatar']['filename'] = $this->saveAvatar($_FILES['avatar'], $_SESSION['avatar']['dir']);
	}
	public function saveAvatar($file, $dir)
	{
		if (!empty($file) && $file['error'] != 4)
		{
			$name = md5(uniqid());
			#$dir = $dir;
			$format = array(
				'image/png',
				'image/gif',
				'image/jpeg'
			);
			$x = 300;
			$y = 300;
			$filename = $this->saveFile($file, $name, $dir, $format, $x, $y);
			if ($filename)
			{
				#$this->db->query("UPDATE ".DB_PREFIX."_users SET avatar='".$filename."' WHERE user_id=".$user_id." LIMIT 1");
				return $filename;
			}
		}
	}
	public function updateAvatarInfo($user_id, $filename, $dir=false)
	{
		if ($filename && $user_id)
		{
			$query = "UPDATE ".DB_PREFIX."_users SET avatar='".$filename."' WHERE user_id=".$user_id." LIMIT 1";
			$this->db->query($query);
		}

		if ($dir) rename($dir, self::AVATAR_DIR.$user_id);
	}

	public function emailActivate($user_id)
	{
		$row = $this->db->query("SELECT user_id, username, user_email, check_num FROM ".DB_PREFIX."_users WHERE user_id=".intval($user_id)." LIMIT 1")->fetch(PDO::FETCH_OBJ);

		$data = array();
		$data['sitename'] = $this->mainConfig->sitename;
		$data['href'] = $this->mainConfig->siteurl.'/funcs.php?name=user&amp;file=register&amp;op=activate&amp;id='.$row->user_id.'&amp;check_num='.$row->check_num;
		$data['message'] = nl2br($this->mainConfig->user_register_message);
		$data['year'] = date("Y");
		$data['user_email'] = $row->user_email;
		$data['username'] = $row->username;
		$data['user_pass'] = $this->user_pass;
		$subject = $this->errorMsg('EMAILACTIVATETITLE');
		$this->sendEmail($subject, $data, 'email_register.tpl', $row->user_email);
	}

	private function fbCheckKeys()
	{
		if (!isset($this->mainConfig->fb_appid) || !isset($this->mainConfig->fb_secret)) return false;
	}

	public function fbLoginLink()
	{
		if ($this->fbCheckKeys() == false) return;

		require_once $this->FUNCS_DIR.'/user/'.$this->INCLUDE_FOLDER_CLASSES.'/Facebook/autoload.php';

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
			$this->redirect('funcs.php?name=konto');
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			$this->redirect('funcs.php?name=konto');
		}

		if (isset($accessToken))
		{
			if (isset($_SESSION['facebook_access_token'])) $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			else
			{
				$_SESSION['facebook_access_token'] = (string) $accessToken;
				$oAuth2Client = $fb->getOAuth2Client();
				$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
				$_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
				$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
			}
			if (isset($_GET['code'])) $this->redirect('funcs.php?name=konto&f=l');

			try {
				$profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
				$profile = $profile_request->getGraphNode()->asArray();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				session_destroy();
				$this->redirect('funcs.php?name=konto');
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				$this->redirect('funcs.php?name=konto', 'error', 'Wystąpiły+problemy+z+połączeniem+z+FaceBookiem.+Prosimy+o+logowanie+bezpośrednie.');
			}
			if (!$this->is_user() && $profile['email']) $kontoClass->zalogujFB($profile['email']);
		}
		return $helper->getLoginUrl($this->mainConfig->siteurl.'/funcs.php?name=konto&f=l', $permissions);
	}

	public function clearSession()
	{
		if (isset($_GET['new']) && $_GET['new'] == 1) unset($_SESSION['dane']);
	}
	private function setUserID()
	{
		$this->userID = intval($this->formatSQL($_GET['id']));
	}
	private function setCheckNum()
	{
		$this->checkNum = $this->formatSQL($_GET['check_num']);
	}
	private function getUserID()
	{
		return $this->userID;
	}
	private function getCheckNum()
	{
		return $this->checkNum;
	}
	private function getUserData()
	{
		$sql = "SELECT user_id FROM ".DB_PREFIX."_users WHERE user_id=".$this->getUserID()." AND check_num='".$this->getCheckNum()."' AND status=0 LIMIT 1";
		$result = $this->db->query($sql);

		if ($result) $this->userData = $result->fetch(PDO::FETCH_OBJ);
		else throw new Exeption($this->errorMsg('ACTIVATE_EMPTY_DATA'));
	}
	private function updateActivationStatus()
	{
		$this->db->query("
			UPDATE ".DB_PREFIX."_items SET active=1, save_only=0 WHERE user_id=".$this->userData->user_id.";
			UPDATE ".DB_PREFIX."_users SET status=1 WHERE user_id=".$this->userData->user_id." LIMIT 1
		");
	}
	public function activateUser()
	{
		$this->setUserID();
		$this->setCheckNum();
		$this->getUserData();
		$this->updateActivationStatus();
	}
	public function saveSession()
	{
		$_SESSION['dane'] = $_POST;
	}
	public function birthDateList()
	{
		global $classMain;
		//days
		$dataTPL = array();
		for ($i=1; $i <= 31; $i++) {
			$dataTPL['no'] = $i;
			$dataTPL['selected'] = ($_SESSION['dane']['birth_date_day'] == $i);
			$classMain->dataTPLarrayList('bdd', $dataTPL);
		}
		//months
		$dataTPL = array();
		for ($i=1; $i <= 12; $i++) {
			$dataTPL['no'] = $i;
			$dataTPL['selected'] = ($_SESSION['dane']['birth_date_month'] == $i);
			$classMain->dataTPLarrayList('bdm', $dataTPL);
		}
		//years
		$dataTPL = array();
		for ($i=date('Y'); $i >= date('Y')-100; $i--) {
			$dataTPL['no'] = $i;
			$dataTPL['selected'] = ($_SESSION['dane']['birth_date_year'] == $i);
			$classMain->dataTPLarrayList('bdy', $dataTPL);
		}
	}
	private function setCity()
	{
		$this->city = $this->formatSQL($_POST['city']);
	}
	private function setName($gender=false)
	{
		switch($gender)
		{
			case 'p':
				$this->name = $this->formatSQL($_POST['name_user']);
				$this->name2 = $this->formatSQL($_POST['name_user2']);
			break;
			default:
				$this->name = $this->formatSQL($_POST['name_user']);
			break;
		}
	}
	private function saveFinishInfo()
	{
		$this->db->query("UPDATE ".DB_PREFIX."_users SET name='".$this->name."', city='".$this->city."' WHERE user_id=".$this->userinfo->user_id." LIMIT 1");
		if ($this->userinfo->gender == 'p') $this->db->query("UPDATE ".DB_PREFIX."_users_couple SET name='".$this->name2."' WHERE user_id=".$this->userinfo->user_id." LIMIT 1");
	}
	private function checkCompleteInfo()
	{
		$complete = 0;
		$complete = ($this->name) ? 1 : 0;
		$complete = ($this->city) ? 1 : 0;
		if ($this->userinfo->gender == 'p' && $this->name2) $complete = 1;
		elseif ($this->userinfo->gender == 'p' && empty($this->name2)) $complete = 0;
		$this->db->query("UPDATE ".DB_PREFIX."_users SET complete=1 WHERE user_id=".$this->userinfo->user_id." LIMIT 1");
	}
	public function finishRegister()
	{
		$this->setName($this->userinfo->gender);
		$this->setCity();
		$this->checkCompleteInfo();
		$this->saveFinishInfo();
	}
}

?>
