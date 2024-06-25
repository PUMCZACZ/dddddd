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

class contact extends user {

	const ATT_FOLDER = 'uploaded/contact_att';

	protected $txt = array(
	);

	public function errorMsg($var)
	{
		$errorMsg = array(
		'EMAIL_ERROR' => 'Nieprawidłowy adres e-mail',
		'CONTACT_TITLE' => 'Kontakt',
		'MESSAGE_SEND' => 'Wiadomość została wysłana'
		);
		return $errorMsg[$var];
	}

	public function __construct() {

		global $db, $classMain;

		$this->db = $db;
		$this->classMain = $classMain;
    parent::getConfig();
		parent::is_user();
	}
	private function setEmail()
	{
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $this->email = $this->formatSQL($_POST['email']);
		else throw new Exception($this->errorMsg('EMAIL_ERROR'));
	}
	private function setMessage()
	{
		$this->message = $this->formatSQL($_POST['message']);
	}
	private function setAttachment()
	{
		if ($_FILES['attachment']['tmp_name'])
		{
			$filename = $this->saveFile($_FILES['attachment'], false, self::ATT_FOLDER);
			if ($filename)
			{
				$this->filename = str_replace(' ', '_', $filename);
				$this->file_href = dirname(__FILE__).'/../../../'.self::ATT_FOLDER.'/'.$filename;
			}
		}
	}
	public function sendMessage()
	{
		$this->setEmail();
		$this->setMessage();
		$this->setAttachment();

		$data = array();
		$data['sitename'] = $this->mainConfig->sitename;
		$data['username'] = $this->userinfo->username;
		$data['user_id'] = $this->userinfo->user_id;
		$data['name'] = $this->userinfo->name;
		$data['message'] = nl2br($this->message);
		$data['email'] = $this->email;

		$data['imie'] = main::formatSQL($_POST['imie']);
		$data['nazwisko'] = main::formatSQL($_POST['nazwisko']);
		$data['kim_jestes'] = main::formatSQL($_POST['kim_jestes']);
		$data['nazwa_firmy'] = main::formatSQL($_POST['nazwa_firmy']);
		$data['nr_telefonu'] = main::formatSQL($_POST['nr_telefonu']);

		$subject = $this->mainConfig->sitename.': '.$this->errorMsg('CONTACT_TITLE');

		self::sendEmail($subject, $data, 'email_contact.php', $this->mainConfig->contact_email, $this->email, false, $this->file_href, $this->filename);
		throw new Exception($this->errorMsg('MESSAGE_SEND'));
	}
}

?>
