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

class emailing extends main {

	protected $infoMsg = array(
	);

	protected $errorMsg = array(
	);

	public function __construct()
	{
		global $db, $classMain;

		$this->db = $db;
		$this->classMain = $classMain;
	}

	public function saveChanges($data)
	{
		$this->db->query("UPDATE ".DB_PREFIX."_emailing SET
			title='".$this->formatSQL($_POST['title'])."',
			lang='".$this->formatSQL($_POST['lang'])."',
			member_active='".$this->formatSQL($_POST['member_active'], 'int')."',
			member_id='".$this->formatSQL($_POST['member_id'], 'int')."',
			member_end_from='".$this->formatSQL($_POST['member_end_from'])."',
			member_end_to='".$this->formatSQL($_POST['member_end_to'])."',
			send_time_type='".$this->formatSQL($_POST['send_time_type'])."',
			send_time='".$this->formatSQL($_POST['send_time'])."',
			send_time_unix='".strtotime($this->formatSQL($_POST['send_time']))."',
			message='".$_POST['message']."',
		WHERE id=".$this->formatSQL($_POST['id'], 'int')." LIMIT 1");
	}

	public function dataTPL($id)
	{
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_emailing WHERE id=".$this->formatSQL($id, 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		$this->classMain->dataTPLarray($row);
	}

	public function delete($idArray)
	{
		foreach ($idArray as $key => $value) $this->db->query("DELETE FROM ".DB_PREFIX."_emailing WHERE id=".$this->formatSQL($value, 'int')." LIMIT 1");
	}

	public function memberList()
	{
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_member WHERE type=0 ORDER BY id ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ)) $this->classMain->dataTPLarrayList('m', $row);
	}
	public function saveEmailing()
	{
		$this->db->query("INSERT INTO ".DB_PREFIX."_emailing VALUES (
			NULL,
			'".$this->formatSQL($_POST['title'])."',
			'".$this->formatSQL($_POST['lang'])."',
			'".$this->formatSQL($_POST['member_active'], 'int')."',
			'".$this->formatSQL($_POST['member_id'], 'int')."',
			'".$this->formatSQL($_POST['member_end_from'])."',
			'".$this->formatSQL($_POST['member_end_to'])."',
			'".$this->formatSQL($_POST['send_time_type'])."',
			'".$this->formatSQL($_POST['send_time'])."',
			'".strtotime($this->formatSQL($_POST['send_time']))."',
			'".$_POST['message']."',
			".time()."
		)");
	}
	private function setQuery($data)
	{
		if (is_array($data)) $data = (object)$data;
		$query = array();

		//member active
		if ($data->member_active)
		{
			if ($data->member_active == 1) $query[] = 'um.date_end>'.time();//active
			if ($data->member_active == 2) $query[] = 'um.date_end<'.time();//unactive
			if ($data->member_active == 3) $query[] = "um.date_end=''";//never active
		}

		//member id
		if ($data->member_id) $query[] = 'm.id='.$data->member_id;

		//user lang
		#if ($data->lang) $query[] = "u.lang='".$data->lang."'";

		//member date
		if ($data->member_end_from && $data->member_end_to) $query[] = 'um.date_end BETWEEN '.strtotime($data->member_end_from).' AND '.strtotime($data->member_end_to);
		if ($data->member_end_from && empty($data->member_end_to)) $query[] = 'um.date_end>'.strtotime($data->member_end_from);
		if (empty($data->member_end_from) && $data->member_end_to) $query[] = 'um.date_end<'.strtotime($data->member_end_to);

		//user register date
		if ($data->member_reg_date_from && $data->member_reg_date_to) $query[] = 'u.date_reg BETWEEN '.strtotime($data->member_reg_date_from).' AND '.strtotime($data->member_reg_date_to);
		if ($data->member_reg_date_from && empty($data->member_reg_date_to)) $query[] = 'u.date_reg>'.strtotime($data->member_reg_date_from);
		if (empty($data->member_reg_date_from) && $data->member_reg_date_to) $query[] = 'u.date_reg<'.strtotime($data->member_reg_date_to);

		if ($data->items_active) $queryHaving = ($data->items_active == 1) ? ' HAVING i_num>0' : ' HAVING i_num=0';

		$query = (!empty($query)) ? 'AND '.implode(' AND ', $query) : false;

		$this->query = "SELECT u.user_email, u.company_name, u.username, COUNT(i.id) AS i_num
										FROM ".DB_PREFIX."_users u
										LEFT JOIN ".DB_PREFIX."_users_member um ON (um.user_id=u.user_id)
										LEFT JOIN ".DB_PREFIX."_member_periods mp ON (mp.id=um.m_id)
										LEFT JOIN ".DB_PREFIX."_member m ON (m.id=mp.m_id)
										LEFT JOIN ".DB_PREFIX."_items i ON (i.user_id=u.user_id)
										WHERE 1 ".$query." GROUP BY u.user_id".$queryHaving;
										#echo $this->query;
										#exit;
	}
	public function sendEmailing()
	{
		$timeNow = date('Y-m-d\TH:i');

		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_emailing WHERE send_time='' OR send_time='".$timeNow."'");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$dataTPL = array();
			$dataTPL['message'] = $row->message;

			$this->setQuery($row);

			$usersEmails = array();

			$result2 = $this->db->query($this->query);
			while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
			{
				$dataTPL['message'] = $this->createMessage($dataTPL['message'], $row2);
				#$usersEmails[] = $row2['user_email'];
				$this->classMain->sendEmail($row->title, $dataTPL, 'email_emailing.php', $row2['user_email']);
			}
			#$this->classMain->sendEmail($row->title, $dataTPL, 'email_emailing.php', $usersEmails);
			$this->db->query("UPDATE ".DB_PREFIX."_emailing SET send_time='".$timeNow."', send_time_unix=".time()." WHERE id=".$row->id." LIMIT 1");
		}
	}
	private function createMessage($message, $userData)
	{
		$userData = (array)$userData;
		$vars = array(
			'USERNAME' => 'username',
			'USER_EMAIL' => 'user_email',
			'COMPANY_NAME' => 'company_name'
		);
		foreach ($vars as $key => $value)
		{
			$message = str_replace('{'.$key.'}', $userData[$value], $message);
		}
		return $message;
	}
	public function saveToFile()
	{
		$this->setQuery($_POST);

		$string = '';
		$result = $this->db->query($this->query);
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$string .= $row->user_email."\r\n";
		}
		$my_file = 'emails.txt';
		$handle = fopen($my_file, 'w');
		fwrite($handle, $string);
		fclose($handle);

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="'.basename($my_file).'"');
    header('Content-Length: ' . filesize($my_file));
    readfile($my_file);
    exit;
	}
}

?>
