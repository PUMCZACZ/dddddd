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

class access extends user {

	public function errorMsg($var)
	{
		$errorMsg = array(
			'DEL_CONFIRM' => 'Pozycja została usunięta',
			'GRAND_CONFIRM' => 'Zezwolenie zostało przyznane'
		);
		return $errorMsg[$var];
	);

	public function __construct() {

		global $db, $classMain;

		$this->db = $db;
		$this->classMain = $classMain;
    parent::getConfig();
		parent::is_user();
	}
	public function getStats()
	{
		$asking = $this->db->query("SELECT COUNT(1) AS count FROM ".DB_PREFIX."_users_access WHERE p_id=".$this->userinfo->user_id." AND status=0 GROUP BY user_id")->fetch(PDO::FETCH_OBJ);
		$get = $this->db->query("SELECT COUNT(1) AS count FROM ".DB_PREFIX."_users_access WHERE user_id=".$this->userinfo->user_id." AND status=1 GROUP BY p_id")->fetch(PDO::FETCH_OBJ);
		$granded = $this->db->query("SELECT COUNT(1) AS count FROM ".DB_PREFIX."_users_access WHERE p_id=".$this->userinfo->user_id." AND status=1 GROUP BY p_id")->fetch(PDO::FETCH_OBJ);
		$dataTPL = array();
		$dataTPL['count_access'] = intval($asking->count);
		$dataTPL['count_access_my_access'] = intval($get->count);
		$dataTPL['count_access_user_access'] = intval($granded->count);
		$this->classMain->dataTPLarray($dataTPL);
	}
	public function accesList($type)
	{
		switch($type)
		{
			case 'asking':
				$query = "WHERE ua.p_id=".$this->userinfo->user_id." AND ua.status=0";
				$queryOn = 'u.user_id=ua.user_id';
			break;
			case 'get':
				$query = "WHERE ua.user_id=".$this->userinfo->user_id." AND ua.status=1";
				$queryOn = 'u.user_id=ua.p_id';
			break;
			case 'granded':
				$query = "WHERE ua.p_id=".$this->userinfo->user_id." AND ua.status=1";
				$queryOn = 'u.user_id=ua.user_id';
			break;
		}
		$result = $this->db->query("SELECT ua.*, u.user_id, u.name, u.gender, u.age, u.city, uc.name AS name2, uc.age AS age2
			FROM ".DB_PREFIX."_users_access ua
			INNER JOIN ".DB_PREFIX."_users u ON (".$queryOn.")
			LEFT JOIN ".DB_PREFIX."_users_couple uc ON (uc.user_id=u.user_id)
			".$query
			." GROUP BY ua.user_id"
		);
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->delete = ($row->promo == 0 || ($row->promo == 1 && $row->date<(time()-$this->mainConfig->access_delete*3600)));
			$row->user_pic = $this->userPic($row->user_id);
			$row->online = $this->getUserOnLine($row->user_id);
			$this->classMain->dataTPLarrayList('a', $row);
		}
	}
	private function getAccessDetails($id)
	{
		$this->accessDetails = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_access WHERE id=".$this->formatSQL($id)." LIMIT 1")->fetch(PDO::FETCH_OBJ);
	}
	public function grandAccess($id)
	{
		$this->getAccessDetails($id);
		$this->grand($id);
		throw new Exception($this->errorMsg('GRAND_CONFIRM'));
	}
	public function delAccess($id)
	{
		$this->delete($id);
		throw new Exception($this->errorMsg('DEL_CONFIRM'));
	}
	public function grandAccessGroup($idArray)
	{
		foreach ($idArray as $key => $value)
		{
			$this->grand($value);
		}
		throw new Exception($this->errorMsg('GRAND_CONFIRM'));
	}
	public function delAccessGroup($idArray)
	{
		if (empty($idArray)) return;

		foreach ($idArray as $key => $value)
		{
			$this->delete($value);
		}
		throw new Exception($this->errorMsg('DEL_CONFIRM'));
	}
	private function delete($id)
	{
		$this->db->query("DELETE FROM ".DB_PREFIX."_users_access WHERE id=".$this->formatSQL($id, 'int')." AND (p_id=".$this->userinfo->user_id." OR user_id=".$this->userinfo->user_id.") LIMIT 1");
		$this->db->query("DELETE FROM ".DB_PREFIX."_users_photos_access WHERE p_id=".$this->userinfo->user_id);
	}
	private function grand($id)
	{
		$this->db->query("UPDATE ".DB_PREFIX."_users_access SET status=1 WHERE p_id=".$this->userinfo->user_id." AND id=".$id." LIMIT 1");
		$this->db->query("INSERT INTO ".DB_PREFIX."_users_photos_access VALUES (
			NULL,
			".$this->accessDetails->user_id.",
			".$this->userinfo->user_id.",
			".time().",
			'".$_SERVER['REMOTE_ADDR']."'
		)");
		if ($this->accessDetails->share == 1)
		{
			$this->db->query("INSERT INTO ".DB_PREFIX."_users_photos_access VALUES (
				NULL,
				".$this->userinfo->user_id.",
				".$this->accessDetails->user_id.",
				".time().",
				'".$_SERVER['REMOTE_ADDR']."'
			)");
			$this->db->query("INSERT INTO ".DB_PREFIX."_users_access VALUES (
				NULL,
				".$this->accessDetails->user_id.",
				".$this->userinfo->user_id.",
				'',
				1,
				1,
				0,
				".time()."
			)");
		}

	}
}

?>
