<?php

class main {
  const FUNCS_DIR = 'funcs';
  const FUNCS_FILE = 'funcs.php';
  const FUNCS_MAIN_FILE = 'index.php';
  const INCLUDE_FOLDER = 'inc';
  const INCLUDE_FOLDER_CLASSES = 'classes';
  const CLASS_FILE_PREFIX = 'class';
  const THEME_DIR = 'theme';
  const THEME_DIR_IMG = 'theme/img';

  public function __construct()
  {
    global $db;
    $this->db = $db;
    self::defLang();
    self::getConfig();
  }

  public function errorMsg($var)
  {
    $errorMsg= array(
     'ERROR_CAPTCHA' => $this->_LANG['ERROR_CAPTCHA'],
    );
    return $errorMsg[$var];
  }

  public function dateName($time)
  {
    $month = [
      1 => 'styczeń',
      2 => 'luty',
      3 => 'marzec',
      4 => 'kwiecień',
      5 => 'maj',
      6 => 'czerwiec',
      7 => 'lipiec',
      8 => 'sierpień',
      9 => 'wrzesień',
      10 => 'październik',
      11 => 'listopad',
      12 => 'grudzień'
    ];

    return date('d', $time) . ' ' . $month[date('n', $time)] . ', ' . date('Y', $time);
  }

  public function textCut($text, $size)
  {
  	$count = strlen($text);
  	if ($count >= $size)
  	{
  		$cut = substr($text,0,$size);
  		$cuted = $cut."...";
  	}
  	else $cuted = $text;

  	return $cuted;
  }

  protected function checkURL($link)
  {
    $file = $link;
    $file_headers = @get_headers($file);
    if (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') return false; else return true;
  }

  public function langs()
  {
    global $classUser;

    $langDef = $this->db->query("SELECT name, name_def FROM ".DB_PREFIX."_config_langs WHERE def=1 LIMIT 1")->fetch(PDO::FETCH_OBJ);
    $this->lang_def = $langDef->name_def;

    if ($this->mainConfig->multilang == 1)
    {
      if (empty($_SESSION['site_lang']))
      {
        $_SESSION['site_lang'] = $langDef->name_def;
        #$this->redirect($_SERVER['REQUEST_URI']);
      }
      if (!empty($_GET['chng_lang']))
      {
        //sprawdzanie pliku językowego
        $langInfo = $this->db->query("SELECT name_def FROM ".DB_PREFIX."_config_langs WHERE name_def='".$this->formatSQL($_GET['chng_lang'])."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
        if (file_exists(dirname(__FILE__) . '/../../lang/lang-'.$langDef->name_def.'.php'))
        {
          $_SESSION['site_lang'] = $langInfo->name_def;
          #$adresDocelowy = str_replace('?chng_lang='.$langInfo->name_def, '', $_SERVER['REQUEST_URI']);
          #$adresDocelowy = str_replace('&chng_lang='.$langInfo->name_def, '', $adresDocelowy);

          //akualizacja domyślnego języka użytkonika
          if ($classUser->is_user()) $this->db->query("UPDATE ".DB_PREFIX."_users SET lang='".$langInfo->name_def."' WHERE user_id=".$classUser->userinfo->user_id." LIMIT 1");

          #$this->redirect($adresDocelowy);
        }
      }

      $adres = (preg_match("/funcs.php/i", $_SERVER['SCRIPT_NAME'])) ? 'funcs.php?'.$_SERVER['QUERY_STRING'] : false;

      $lacznik = (preg_match("/name/i", $adres)) ? '&amp;' : '?';

      $result = $this->db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE active=1 ORDER BY def DESC, name ASC");
      while ($row = $result->fetch(PDO::FETCH_OBJ))
      {
        $row->active = ($row->name_def == $_SESSION['site_lang']) ? true : false;
        #$row->href = $adres.$lacznik.'chng_lang='.$row->name_def;
        #$row->href = $this->mainConfig->siteurl.'/'.$row->name_def.'/'.$adres;
        $row->href = $this->mainConfig->siteurl.'/'.$row->name_def;
        $this->dataTPLarrayList('langs_nav', $row, false);
      }
      if (file_exists(dirname(__FILE__) . '/../../lang/lang-'.$_SESSION['site_lang'].'.php'))
      {
        $langDef = $this->db->query("SELECT name, name_def FROM ".DB_PREFIX."_config_langs WHERE name_def='".$this->formatSQL($_SESSION['site_lang'])."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
        require dirname(__FILE__) . '/../../lang/lang-'.$_SESSION['site_lang'].'.php';
      } else require dirname(__FILE__) . '/../../lang/lang-'.$langDef->name_def.'.php';
    }
    else require dirname(__FILE__) . '/../../lang/lang-'.$langDef->name_def.'.php';

    $GLOBALS['def_lang'] = $_SESSION['site_lang'];
    $_LANG['def_lang'] = $GLOBALS['def_lang'];
    $_LANG['def_lang_name'] = $langDef->name;
    $_LANG['def_lang_pic'] = $this->mainConfig->siteurl.'/'.self::THEME_DIR_IMG.'/lang-'.$langDef->name_def.'.png';
    $this->dataTPLarray($_LANG);
    $this->_LANG = $_LANG;
    return $_LANG;
  }

  public function setLangVar($name, $data, $lang=false)
  {
    $this->defLang();
    $lang = ($lang) ? $lang : $this->defLang;
    $data = (array)$data;

    return $data[$name.'_'.$lang];
  }

  public function saveLangsData($dataArray, $dataName, $dataIdName, $dataID, $tableName)
  {
    $result = $this->db->query("SELECT * FROM ".DB_PREFIX."_config_langs");
    while ($row = $result->fetch(PDO::FETCH_OBJ))
    {
      $this->db->query("UPDATE ".DB_PREFIX."_".$tableName." SET ".$dataName."_".$row->name_def."='".$dataArray[$dataName."_".$row->name_def]."' WHERE ".$dataIdName."=".$dataID." LIMIT 1");
    }
  }

  private function defLang()
  {
    if ($_SESSION['site_lang']) $row = $this->db->query("SELECT name_def FROM ".DB_PREFIX."_config_langs WHERE name_def='".$this->formatSQL($_SESSION['site_lang'])."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
    if (!$row) $row = $this->db->query("SELECT name_def FROM ".DB_PREFIX."_config_langs WHERE def=1 LIMIT 1")->fetch(PDO::FETCH_OBJ);

    $this->defLang = $row->name_def;
  }

  public function langsList($tplName='langs', $dataName=false, $arrayData=false)
  {
    if ($arrayData && !is_array($arrayData)) $arrayData = (array)$arrayData;
    $no = 1;
    if ($this->mainConfig->multilang == 0) $query = " AND def=1";
    $result = $this->db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE 1 AND active=1".$query." ORDER BY def DESC, name ASC");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
      if ($dataName && is_array($arrayData))
      {
        if (is_array($dataName)) foreach ($dataName as $key => $value) $row[$value] = $arrayData[$value.'_'.$row['name_def']];
        else
        {
          $row[$dataName] = $arrayData[$dataName.'_'.$row['name_def']];
        }
      }
      $row['checked'] = (!is_array($dataName) && is_array($arrayData[$dataName]) && in_array($row['name_def'], $arrayData[$dataName]));
      $row['no'] = $no;
      $this->dataTPLarrayList($tplName, $row);
      $no++;
    }
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
        $handle->file_overwrite = true;
        $handle->Process($folder);

        //ustalanie podstawy nazw zdjcęcia
        $nazwa = ($nazwa_docelowa) ? $nazwa_docelowa.'.'.$handle->file_dst_name_ext : $handle->file_src_name;

        $handle->Clean();
        return $nazwa;
      } else return;
    } else return;
  }

  public function advPositions()
	{
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_adv_positions");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$data['adv_'.$row->id] = $this->adv($row->id);
			$this->dataTPLarray($data, false);
		}
	}

  private function adv($position)
  {
    //get rand adv
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_adv WHERE active=1 AND position=".$position.$query." ORDER BY RAND() LIMIT 1")->fetch(PDO::FETCH_OBJ);

    if(!$row) return;

		//check views
		if (($row->system == 'i') && ($row->views == ($row->system_value-1))) $this->db->query("UPDATE ".DB_PREFIX."_adv SET active=0 WHERE id=".$row->id." LIMIT 1");
		//sprawdzanie limitu odsłon (system czasowy)
		if (($row->system == 'c') && (time()>($row->date+$row->system_value*86400))) $this->db->query("UPDATE ".DB_PREFIX."_adv SET active=0 WHERE id=".$row->id." LIMIT 1");

		//aktualizacja odsłon
		$this->db->query("UPDATE ".DB_PREFIX."_adv SET views=views+1 WHERE id=".$row->id." LIMIT 1");

		return htmlspecialchars_decode(stripslashes($row->content));
	}

  public function is_mobile()
  {
    include_once self::INCLUDE_FOLDER.'/'.self::INCLUDE_FOLDER_CLASSES.'/Mobile_Detect.php';
    $mobileDetectClass = new Mobile_Detect();
    return ($mobileDetectClass->isMobile());
  }

  public function is_admin()
  {
    static $adminSave;
  	$admin = $_COOKIE['admin'];
    if (!$admin) return 0;
    if (isset($adminSave)) return $adminSave;
    if (!is_array($admin))
    {
      $admin = base64_decode($admin);
      $admin = addslashes($admin);
      $admin = explode(':', $admin);
    }
    $aid = $admin[0];
    $pwd = $admin[1];
    $aid = substr(addslashes($aid), 0, 25);
    if (!empty($aid) && !empty($pwd))
  	{
      $sql = "SELECT pwd FROM ".DB_PREFIX."_authors WHERE aid='$aid' LIMIT 1";
      $result = $this->db->query($sql);
      $pass = $result->fetch(PDO::FETCH_OBJ);
      if ($pass->pwd == $pwd && !empty($pass->pwd)) return $adminSave = 1;
    }
    return $adminSave = 0;
  }

  public function optList($name, $selected=false, $extra=false)
  {
    global $classMain;
    $result = $this->db->query($this->optQuery($name, $selected, $extra));
    while ($row = $result->fetch(PDO::FETCH_OBJ))
    {
      $row->checked = (is_array($selected) && in_array($row->id, $selected) || ($selected == false && $row->def)) ? true : false;
      $row->name = $this->setLangVar('name', $row);
      $classMain->dataTPLarrayList($name, $row);
    }
  }
  protected function optQuery($name, $selected=false, $extra=false)
  {
    switch($extra)
    {
      case 'items-price':
        return "SELECT so.*, TRUNCATE(IFNULL(p.value, 0), 2) AS price
                FROM ".DB_PREFIX."_select_options so
                LEFT JOIN ".DB_PREFIX."_prices p ON (p.time=so.name_pl AND p.type='add_cls')
                WHERE so.name_tech='".$this->formatSQL($name)."' ORDER BY so.id ASC";
      break;
      default:
        return "SELECT * FROM ".DB_PREFIX."_select_options WHERE name_tech='".$this->formatSQL($name)."' ORDER BY id ASC";
      break;
    }
  }
  protected function optName($id)
  {
    $row = $this->db->query("SELECT * FROM ".DB_PREFIX."_select_options WHERE id=".$this->formatSQL($id, 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);
    return $this->setLangVar('name', $row);
  }

  public function check_url($url)
	{
		if (!$fp = curl_init($url)) return false;
		return true;
	}

  public static function formatSQL($string, $type='string')
  {
    #if (!isset($string)) return false;
    switch($type)
    {
      case 'int':
        return intval($string);
      break;
      default:
      case 'string':
        return addslashes(trim(htmlspecialchars($string)));
      break;
    }
  }
  public function recaptcha()
  {
    $dataTPL['recaptcha'] = true;
    $dataTPL['G_RECAPTCHA_SITEKEY'] = $this->mainConfig->g_recaptcha_sitekey;
    $this->dataTPLarray($dataTPL);
  }
  public function checkReCaptcha()
  {
    $privatekey = $this->mainConfig->g_recaptcha_secret;
    $captcha = (isset($_POST['g-recaptcha-response'])) ? $this->formatSQL($_POST['g-recaptcha-response']) : false;

    $response = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$privatekey."&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

    if ($response['success'] != 1) throw new Exception($this->errorMsg('ERROR_CAPTCHA'));
    return true;
  }
  public function getOP()
  {
    if (isset($_GET['op']) && !empty($_GET['op'])) return self::formatSQL($_GET['op']);
    else if (isset($_POST['op']) && !empty($_POST['op'])) return self::formatSQL($_POST['op']);
  }
  public function getConfig()
  {
    $row = $this->db->query("SELECT * FROM ".DB_PREFIX."_config WHERE 1 LIMIT 1")->fetch(PDO::FETCH_OBJ);
    $this->mainConfig = $row;
  }
  public function setTemaplate()
  {
    require_once dirname(__FILE__) . '/../template.php';
    $this->template = new template();
    $this->template->set_template();
  }
  public function dataTPLarray($dataArray, $format=true)
  {
    if (is_object($dataArray)) $dataArray = (array)$dataArray;
    if (is_array($dataArray))
    {
      $arrayKeys = array_keys($dataArray);
      $TPLarray = array();
      for ($i=0; $i < count($arrayKeys); $i++) $TPLarray[strtoupper($arrayKeys[$i])] = $dataArray[$arrayKeys[$i]];
      $this->template->assign_vars($TPLarray);
    }
  }

  public function dataTPLarrayList($name, $dataArray, $format=true)
  {
    if (is_object($dataArray)) $dataArray = (array)$dataArray;
    if (is_array($dataArray))
    {
      $arrayKeys = array_keys($dataArray);
      $TPLarray = array();
      for ($i=0; $i < count($arrayKeys); $i++) $TPLarray[strtoupper($arrayKeys[$i])] = $dataArray[$arrayKeys[$i]];
      $this->template->assign_block_vars($name, $TPLarray);
    }
  }

  public function sendEmail($subject, $dataArray, $tpl_file, $email, $nadawca=false, $nadawca_nazwa=false, $adresZalacznika=false, $nazwaZalacznika=false, $typZalacznika=false, $format=false)
  {
    global $classMain;

    require_once dirname(__FILE__) . '/class.tpl.email.php';
    $this->emailer = new email_class();

		if (is_object($dataArray)) $dataArray = get_object_vars($dataArray);

		if (is_array($dataArray))
		{
      $dataArray = array_merge($dataArray, array('siteurl' => $this->mainConfig->siteurl, 'sitename' => $this->mainConfig->sitename, 'currency' => $this->mainConfig->currency));
			$arrayKeys = array_keys($dataArray);

			$TPLarray = array();
			$TPLarray['rok'] = date('Y');

			for ($i=0; $i < count($arrayKeys); $i++) $TPLarray[strtoupper($arrayKeys[$i])] = ($format) ? $this->formatSQL($dataArray[$arrayKeys[$i]]) : $dataArray[$arrayKeys[$i]];
      #$TPLarray = array_merge
			$this->emailer->assign_vars($TPLarray);
		}
    $this->emailer->assign_vars($classMain->langs());
		$this->emailer->email_sender($email, $tpl_file, $subject, $nadawca, $nadawca_nazwa, $adresZalacznika, $nazwaZalacznika, $typZalacznika);
	}

  public function sendEmailNow($title, $message, $email, $senderEmail=false, $senderName=false, $attachLink=false, $attachName=false, $attachType=false)
	{
		date_default_timezone_set('Europe/Warsaw');

    if ($this->mainConfig->email_type == 0) $this->mail($title, $message, $email, $senderEmail, $senderName);
    else {
      require_once dirname(__FILE__) . '/PHPMailerAutoload.php';

    	$mail = new PHPMailer();
    	$mail->isSMTP();
    	$mail->SMTPDebug = 0;
    	$mail->Debugoutput = 'html';
    	$mail->Host = $this->mainConfig->email_host;
    	$mail->Port = $this->mainConfig->email_port;
    	$mail->SMTPAuth = true;
    	#$mail->SMTPSecure = "tls";
    	$mail->Username = $this->mainConfig->email_user;
    	$mail->Password = $this->mainConfig->email_pass;

  		$from = $this->mainConfig->email_email;
  		$fromName = $this->mainConfig->email_name;

  		$mail->setFrom($from, $fromName);
  		if (!empty($senderEmail)) $mail->addReplyTo($senderEmail, $senderName);
  		$mail->addAddress($email);
  		$mail->Subject = $title;
  		$mail->msgHTML($message);

  		//dodawanie załącznika
  		switch($attachType)
  		{
  			case 'content':
  				if ($attachType == 'content' && !empty($attachLink)) $mail->addStringAttachment($attachLink, $attachName);
    		break;
  			default:
  				if (!empty($attachLink) && !empty($attachName)) $mail->addAttachment($attachLink, $attachName);
  			break;
  		}

  		//send the message, check for errors
  		if (!$mail->send())
      {
        throw new Exception($mail->ErrorInfo);
      }
    }
	}

  private function mail($title, $message, $email, $senderEmail=false, $senderName=false)
  {
    $senderEmail = ($senderEmail) ? $senderEmail : $this->mainConfig->email_email;
    $senderName = ($senderName) ? $senderName : $this->mainConfig->email_name;

    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=utf8';

    $headers[] = 'To: <'.$email.'>';
    $headers[] = 'From: '.$senderName.' <'.$senderEmail.'>';

    mail($email, $title, $message, implode("\r\n", $headers));
  }

  public function tpl($file)
  {
    $this->template->set_filenames(array(
    		'body' => $file
    ));
    $this->template->display('body');
  }

  public function showMessage($typ)
	{
		if (isset($_SESSION['redirectInfo']) && $_SESSION['redirectInfo']['typ'] == $typ)
		{
			$info = $_SESSION['redirectInfo']['text'];
			unset($_SESSION['redirectInfo']);
			return $info;
		}
	}

	public function redirect($adres=false, $typ=false, $text=false)
	{
    if (empty($_SESSION['redirect']) && empty($_SESSION['redirect_url'])) $this->saveRedirect();

    if (empty($adres)) $adres = $_SERVER['HTTP_REFERER'];
		$link = $adres;
		if (!empty($typ) && !empty($text))
		{
			$typ = ($typ == 'info') ? 'info' : 'error';
			$text = str_replace('+', ' ', $text);

			unset($_SESSION['redirectInfo']);
			$_SESSION['redirectInfo']['typ'] = $typ;
			$_SESSION['redirectInfo']['text'] = $text;
		}
		header('Location: '.$link);
		exit;
	}

	public function saveRedirect()
	{
		$_SESSION['redirect'] = 1;
		$_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
	}

	public function deleteRedirect()
	{
		unset($_SESSION['redirect']);
		unset($_SESSION['redirect_url']);
	}
  private function contactSend()
  {
    include 'funcs/contact/classes/contact.class.php';
    $classContact = new contact;

    if ($_POST['send'])
    {
      try {
        $classContact->sendMessage();
      } catch (Exception $e) {
        $this->redirect(false, 'info', $e->getMessage());
      }
    }
  }
  private function ogMetaData()
  {
    $dataTPL['og_url'] = $this->mainConfig->siteurl.$_SERVER['REQUEST_URI'];
    $dataTPL['og_title'] = $this->mainConfig->sitename;
    $dataTPL['og_desc'] = $this->mainConfig->meta_desc;
    $dataTPL['og_image'] = $this->mainConfig->siteurl.'/theme/img/logo.png';
    $this->dataTPLarray($dataTPL);
  }
  public function getHeader()
  {
    global $classUser;

    ob_start();

    if (isset($_POST['finish-register']) && $_POST['finish-register'] == 1) $classUser->finishRegister();
    if (isset($_POST['send'])) $this->contactSend();

    //langs
    $this->langs();

    //adv
    $this->advPositions();
    //langs
    $this->langsList();
    //contents
    $this->contentsLinks();
    //og meta data
    $this->ogMetaData();
    //contents links
    $this->contentsList('header', 'ch');
    $this->contentsList('footer', 'cf');

    $dataTPL = array();
    $dataTPL['info'] = self::showMessage('info');
    $dataTPL['error'] = self::showMessage('error');
    $dataTPL['siteurl'] = $this->mainConfig->siteurl;
    $dataTPL['sitename'] = $this->mainConfig->sitename;
    $dataTPL['site_desc'] = $this->mainConfig->site_desc;
    $dataTPL['currency'] = $this->mainConfig->currency;
    $dataTPL['is_user'] = ($classUser->is_user());

    $dataTPL['user_user_id'] = ($classUser->is_user()) ? $classUser->userinfo->user_id : false;
    $dataTPL['user_username'] = ($classUser->is_user()) ? $classUser->userinfo->username : false;
    $dataTPL['user_name'] = ($classUser->is_user()) ? $classUser->userinfo->name : false;
    $dataTPL['user_city'] = ($classUser->is_user()) ? $classUser->userinfo->city : false;
    $dataTPL['user_type'] = ($classUser->is_user()) ? $classUser->userinfo->u_type : false;
    $dataTPL['user_veryfi'] = ($classUser->is_user() && $classUser->userinfo->veryfi > 0) ? true : false;
    $dataTPL['user_member'] = ($classUser->is_user() && $classUser->is_member()) ? true : false;
    $dataTPL['ballance'] = $classUser->getUserBallance();

    $dataTPL['items_watch'] = ($classUser->is_user()) ? $classUser->itemsWatchCount() : 0;
    $dataTPL['member_name'] = ($classUser->is_user()) ? $classUser->memberInfo('name') : false;
    $dataTPL['member_time'] = ($classUser->is_user()) ? $classUser->memberInfo('time') : false;
    $dataTPL['member_to_end'] = ($classUser->is_user()) ? $classUser->memberInfo('time-to-end') : false;
    $dataTPL['func_name'] = $this->formatSQL($_GET['name']);
    $dataTPL['func_file'] = $this->formatSQL($_GET['file']);
    $dataTPL['server_address'] = $_SERVER['REQUEST_URI'];
    $dataTPL['site_fb_link'] = $this->mainConfig->site_fb_link;
    $dataTPL['site_tw_link'] = $this->mainConfig->site_tw_link;
    $dataTPL['site_in_link'] = $this->mainConfig->site_in_link;
    $dataTPL['google_analitics'] = $this->mainConfig->google_analitics;
    $dataTPL['fb_appid'] = $this->mainConfig->fb_appid;
    $dataTPL['multilang'] = ($this->mainConfig->multilang == 1);
    $dataTPL['def_lang'] = $this->defLang;
    $dataTPL['cookies_accepted'] = ($_COOKIE['cookies_accepted'] == 'Y');
    $dataTPL['privacy_accepted'] = ($_COOKIE['privacy_accepted'] == 'Y');
    $dataTPL['url_canonical'] = $this->getUrlCanonical();
    $dataTPL['meta_desc'] = $this->mainConfig->meta_desc;
    $dataTPL['meta_keywords'] = $this->mainConfig->meta_keywords;
    $dataTPL['module_companies'] = $this->mainConfig->module_companies;

    $dataTPL['user_mod_msg'] = ($this->mainConfig->user_mod_msg == 1);
    $dataTPL['user_messages'] = ($classUser->is_user()) ? $classUser->messagesCount() : false;

    $this->dataTPLarray($dataTPL);
  }
  public function getFooter()
  {
    include 'inc/classes/class.rewrite.php';
    $classRewrite = new rewrite;
    $contents = ob_get_contents(); // store buffer in $contents
    ob_end_clean(); // delete output buffer and stop buffering
    echo $classRewrite->replace_for_mod_rewrite($contents); //display modified buffer to screen
    global $dbg_starttime;
  }
  private function getUrlCanonical()
  {
    return $this->mainConfig->siteurl.$_SERVER['REQUEST_URI'];
  }
  protected function date($date, $model='d-m-Y')
  {
    return date($model, $date);
  }
  private function contentsList($type='header', $listName='ch')
  {
    switch($type) {
      case 'footer':
        $queryWhere = "show_footer=1";
      break;
      case 'header':
      default:
        $queryWhere = "show_header=1";
      break;
    }
    $result = $this->db->query("SELECT * FROM ".DB_PREFIX."_contents WHERE 1 AND active=1 AND ".$queryWhere." ORDER BY position ASC");
    while ($row = $result->fetch(PDO::FETCH_OBJ))
    {
      $dataTPL['name'] = $this->setLangVar('title', $row);
      #$dataTPL['href'] = urldecode($this->convertString($this->setLangVar('title', $row)).'-t'.$row->id.'.html');
      $dataTPL['href'] = 'funcs.php?name=contents&amp;id='.$row->id;
      $this->dataTPLarrayList($listName, $dataTPL);
    }
  }
  public function contentsLinks()
  {
    $tresci = array();
    $result = $this->db->query("SELECT * FROM ".DB_PREFIX."_contents");
    while ($row = $result->fetch(PDO::FETCH_ASSOC))
    {
      $tresci['content_active_'.$row['id']] = $row['active'];
      $tresci['content_name_'.$row['id']] = $this->setLangVar('title', $row);
      $tresci['content_text_'.$row['id']] = nl2br($this->setLangVar('text', $row));
      #$tresci['content_href_'.$row['id']] = urldecode($this->convertString($this->setLangVar('title', $row)).'-t'.$row['id'].'.html');
      $tresci['content_href_'.$row['id']] = $this->mainConfig->siteurl . '/funcs.php?name=contents&amp;id='.$row['id'];
    }
    $this->dataTPLarray($tresci, false);
  }
  public function convertString($text)
  {
    $text = iconv('utf-8', 'ascii//TRANSLIT', $text);
		$win = array("ą","ć","ę","ł","ń","ó","ś","ź","ż", "Ą","Ć","Ę","Ł","Ń","Ó","Ś","Ź","Ż", " "," - ","-"," ","!","","",",","\/","\.","\+","<",">","\"","%","&",";","'",":","\(","\)","#");
		$uni = array("a","c","e","l","n","o","s","z","z", "A","C","E","L","N","O","S","Z","Z", "_","","","-","","","","","","","","","","","","","","","","","");
		for ( $i=0; $i < count($win);$i++) $win[$i]="/".$win[$i]."/";
		$text = @preg_replace($win, $uni, htmlspecialchars_decode($text, ENT_QUOTES));

		return htmlspecialchars(strip_tags($text));
	}
}
?>
