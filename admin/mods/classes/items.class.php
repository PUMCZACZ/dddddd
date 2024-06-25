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

class adminItems extends main
{
	const FOLDER_IMAGES = 'uploaded/items/';

	public function __construct()
	{
		global $admin_file, $db, $classMain;

		$this->db = $db;
		$this->admin_file = $admin_file;
		$this->classMain = $classMain;

	}

	public function updateStatus($active, $veryfi, $id)
	{
		foreach ($id as $key => $value)
		{
			$i_active = ($active[$value] == 1) ? 1 : 0;
			$i_veryfi = ($veryfi[$value] == 1) ? 1 : 0;
			$row = $this->db->query("SELECT id, time FROM ".DB_PREFIX."_items WHERE id=".$value." LIMIT 1")->fetch(PDO::FETCH_OBJ);
			$this->db->query("UPDATE ".DB_PREFIX."_items SET active=".$i_active.", veryfi=".$i_veryfi.", start=".time().", end=".(time()+($row->time*86400))." WHERE id=".$value." LIMIT 1");
		}
	}

	public function itemsStats()
	{
		$rowAll = $this->db->query("SELECT COUNT(id) AS count FROM ".DB_PREFIX."_items")->fetch(PDO::FETCH_OBJ);
		$rowVeryfi = $this->db->query("SELECT COUNT(id) AS count FROM ".DB_PREFIX."_items WHERE veryfi=1")->fetch(PDO::FETCH_OBJ);
		$rowUnveryfi = $this->db->query("SELECT COUNT(id) AS count FROM ".DB_PREFIX."_items WHERE veryfi=0")->fetch(PDO::FETCH_OBJ);
		$rowUnactive = $this->db->query("SELECT COUNT(id) AS count FROM ".DB_PREFIX."_items WHERE active=0")->fetch(PDO::FETCH_OBJ);
		$rowActive = $this->db->query("SELECT COUNT(id) AS count FROM ".DB_PREFIX."_items WHERE active=1")->fetch(PDO::FETCH_OBJ);
		$this->classMain->dataTPLarray(array(
			'STATS_ITEMS_ALL' => $rowAll->count,
			'STATS_ITEMS_VERYFI' => $rowVeryfi->count,
			'STATS_ITEMS_ACTIVE' => $rowActive->count,
			'STATS_ITEMS_UNACTIVE' => $rowUnactive->count,
			'STATS_ITEMS_UNVERYFI' => $rowUnveryfi->count
		));
	}

	public function zakonczPrzedmiot($id)
	{
		$this->db->query("UPDATE ".DB_PREFIX."_przedmioty SET koniec=".time().", odnowienie='n' WHERE id=".intval($id)." LIMIT 1");
	}

	public function delete()
	{
		foreach ($_POST['i_id'] as $key => $value)
		{
			$this->deleteItem($value);
		}
	}

	public function veryfi()
	{
		foreach ($_POST['id'] as $key => $value)
		{
			$this->db->query("UPDATE ".DB_PREFIX."_items SET veryfi=1 WHERE id=".$value." LIMIT 1");
		}
	}

	private function deleteItem($id)
	{
		$result = $this->db->query("SELECT i_id, photo FROM ".DB_PREFIX."_items_photos WHERE i_id=".$id);
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$imgUrl = self::FOLDER_IMAGES.$row->i_id.'/'.$photo;
			$imgUrlSmall = self::FOLDER_IMAGES.$row->i_id.'/small_'.$photo;
			if (file_exists($imgUrl)) unlink($imgUrl);
			if (file_exists($imgUrlSmall)) unlink($imgUrlSmall);
		}
		$this->db->query("DELETE FROM ".DB_PREFIX."_items_photos WHERE i_id=".$id);
		$this->db->query("DELETE FROM ".DB_PREFIX."_items WHERE id=".$id." LIMIT 1");

		if ($_POST['delete-reason'] && $_POST['delete-subject'])
		{
			$row = $this->db->query("SELECT i.*, u.user_email FROM ".DB_PREFIX."_items i LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id) WHERE i.id=".$id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
			$dataTPL['message'] = $this->classMain->formatSQL($_POST['delete-reason']);
			$this->classMain->sendEmail($this->classMain->formatSQL($_POST['delete-subject']), $dataTPL, 'email_emailing.php', $row->user_email);
		}
	}

	function szukaj($fraza)
	{
		$fraza = formatSQL($fraza);
		$query = false;

		//fraza
		$query = ' AND (';
		if (is_numeric($fraza)) $query .= "id=".intval($fraza);
		elseif (preg_match("/@/i", $fraza))
		{
			$row = $this->db->query("SELECT user_id FROM ".DB_PREFIX."_users WHERE adres_email='".$fraza."' LIMIT 1")->fetch_array(MYSQLI_ASSOC);
			$query .= (!empty($row['user_id'])) ? "user_id=".$row['user_id']." OR " : '';
		}
		else
		{
			$row = $this->db->query("SELECT user_id FROM ".DB_PREFIX."_users WHERE username='".$fraza."' LIMIT 1")->fetch_array(MYSQLI_ASSOC);
			$query .= (!empty($row['user_id'])) ? "user_id=".$row['user_id']." OR " : '';
			$query .= "tytul LIKE '%".$fraza."%'";
		}
		$query .= ')';
		return $query;
	}
}

?>
