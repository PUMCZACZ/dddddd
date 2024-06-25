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

class cron extends main {

	public function __construct()
	{
		global $db, $classMain, $classUser;

		$this->db = $db;
		$this->classMain = $classMain;
		$this->classUser = $classUser;
		parent::getConfig();
		$this->classMain->langs();
	}

	public function memberReminder()
	{
		$this->classMain->langs();

		$dateBeforeFrom = time()-($this->mainConfig->member_reminder*86400);
		$dateBeforeFrom = strtotime(date('d-m-Y', $dateBeforeFrom));
		$dateBeforeTo = $dateBeforeFrom+86399;

		$query = "SELECT u.user_id, u.user_email, um1.* FROM ".DB_PREFIX."_users u
		          LEFT JOIN ".DB_PREFIX."_users_member um1 ON (um1.user_id=u.user_id)
		          INNER JOIN
		          (
		            SELECT max(date_end) max_date_end, user_id
		            FROM ".DB_PREFIX."_users_member
		            WHERE date_end BETWEEN ".$dateBeforeFrom." AND ".$dateBeforeTo." AND reminder=0
		            GROUP BY user_id
		          ) um2
		          ON um1.user_id=um2.user_id
		          AND um1.date_end=um2.max_date_end
		          ORDER BY um1.date_end DESC";

		$result = $this->db->query($query);
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
		  #echo 'PRZYPOMNIENIE: '.$row->user_email.' (ID: '.$row->user_id.') - '.date('d-m-Y', $row->date_end).'<br />';
		  $data = array();
		  $data['sitename'] = $this->mainConfig->sitename;
		  $data['user_email'] = $row-user_email;
		  $data['username'] = $row->username;
		  $subject = $this->classMain->_LANG['EMAIL_REMINDER_TITLE'];
		  $this->classMain->sendEmail($subject, $data, 'email_reminder.tpl', $row->user_email);
			$this->db->query("UPDATE ".DB_PREFIX."_users_member SET reminder=1 WHERE user_id=".$row->user_id);
		}
	}

	public function memberCheck()
	{
		$dateMax = time()-$this->mainConfig->member_items_visible*86400;
		$query = "SELECT u.user_id, u.user_email, um1.* FROM ".DB_PREFIX."_users u
		          LEFT JOIN ".DB_PREFIX."_users_member um1 ON (um1.user_id=u.user_id)
		          INNER JOIN
		          (
		            SELECT max(date_end) max_date_end, user_id
		            FROM ".DB_PREFIX."_users_member
		            WHERE date_end<".$dateMax."
		            GROUP BY user_id
		          ) um2
		          ON um1.user_id=um2.user_id
		          AND um1.date_end=um2.max_date_end
		          ORDER BY um1.date_end DESC";
		$result = $this->db->query($query);
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
		  $this->db->query("UPDATE ".DB_PREFIX."_items SET active=0 WHERE user_id=".$row->user_id);
		}
	}

	public function endItems($mode='all')
	{
		switch ($mode)
		{
			case 'all':
			default:
				$result = $this->db->query("SELECT i.*, u.user_email
					FROM ".DB_PREFIX."_items i
					LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
					WHERE active=1 AND end<=".time()
				);
				while ($row = $result->fetch(PDO::FETCH_OBJ))
				{
					$subject = $this->classMain->_LANG['EMAIL_ITEM_UNACTIVE'].' '.self::setLangVar('title', $row);
					$this->classMain->sendEmail($subject, $row, 'email_item_reminder.tpl', $row->user_email);
				}
				$this->db->query("UPDATE ".DB_PREFIX."_items SET active=0 WHERE end<=".time());
			break;
		}
	}

}

?>
