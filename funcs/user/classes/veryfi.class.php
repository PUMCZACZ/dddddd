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

class veryfi extends user {

	const FILE_SEPARATOR = '#';

	public function __construct() {

		global $db, $classMain;

		$this->db = $db;
		$this->classMain = $classMain;
    parent::getConfig();
		parent::is_user();
	}

	public function errorMsg($var)
	{
		$errorMsg = array(
			'DATA_REQUIRED' => $this->classMain->_LANG['DATA_REQUIRED']
		);
		return $errorMsg[$var];
	}
	public function infoMsg($var)
	{
		$infoMsg = array(
			'VARYFI_SAVED' => $this->classMain->_LANG['VARYFI_SAVED']
		);
		return $infoMsg[$var];
	}

	public function checkUserData()
	{
		$dataRequired = array(
			'company_name',
			'city',
			'post_code',
			'street',
			'nip',
			'regon'
		);
		$userinfo = (array)$this->userinfo;
		foreach ($dataRequired as $key => $value)
		{
			if (empty($userinfo[$value]))
			{
				$this->redirect('funcs.php?name=user', 'error', $this->errorMsg('DATA_REQUIRED'));
			}
		}
	}
	public function saveApp()
	{
		foreach ($_FILES['attachment']['name'] as $key => $value)
		{
			$fileData = array();
			$fileData['name'] = $_FILES['attachment']['name'][$key];
			$fileData['type'] = $_FILES['attachment']['type'][$key];
			$fileData['size'] = $_FILES['attachment']['size'][$key];
			$fileData['tmp_name'] = $_FILES['attachment']['tmp_name'][$key];
			$fileData['error'] = $_FILES['attachment']['error'][$key];
			$filename[] = $this->saveFile($fileData, false, 'uploaded/veryfi/'.$this->userinfo->user_id);
		}
		$this->db->query("INSERT INTO ".DB_PREFIX."_users_veryfi VALUES (
			NULL,
			".$this->userinfo->user_id.",
			'".implode(self::FILE_SEPARATOR, $filename)."',
			'".$this->formatSQL($_POST['comment'])."',
			'".time()."',
			'".$_SERVER['REMOTE_ADDR']."',
			0
		)");
		throw new Exception($this->infoMsg('VARYFI_SAVED'));
	}
	public function checkVeryfiStatus()
	{
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_veryfi WHERE user_id=".$this->userinfo->user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		return ($row->status > 0 && $this->userinfo->veryfi == 1);
	}
}

?>
