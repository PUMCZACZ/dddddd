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

class usersAdmin extends user {

	protected $infoMsg = array(
		'WALLET_UPDATE' => 'Aktualizacja salda przez administrację',
		'EMAIL_SUSPEND_TITLE' => 'Zawieszenie konta użytkownika'
	);

	protected $errorMsg = array(
		'EMAIL_VERYFICATION_SENDED' => 'Email weryfikujący został wysłany',
		'WALLETS_UPDATES' => 'Salda zostały zaktualizowane'
	);

	public function __construct()
	{
		global $db, $classMain;

		$this->db = $db;
		$this->classMain = $classMain;

	}

	public function createInvoice($um_id)
	{
		include dirname(__FILE__).'/../../../funcs/user/classes/payment.class.php';
		$classPayment = new payment;
		$paymentInfo = $this->db->query("SELECT mp.*, um.user_id, um.price, u.lang
																		FROM ".DB_PREFIX."_users_member um
																		LEFT JOIN ".DB_PREFIX."_member_periods mp ON (mp.id=um.id)
																		LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=um.user_id)
																		WHERE um.id=".$this->classMain->formatSQL($um_id, 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);

		try{
			$classPayment->createInvoice($paymentInfo->user_id, $paymentInfo->price, $this->classMain->setLangVar('f_product_id', $paymentInfo, $paymentInfo->lang), 'vat', 'transfer');
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}

	public function updateMember($prices)
	{
		foreach ($prices as $key => $value)
		{
			$this->db->query("UPDATE ".DB_PREFIX."_users_member SET price='".$value."' WHERE id=".$this->classMain->formatSQL($key, 'int')." LIMIT 1");
		}
	}

	public function veryfiApp($user_id)
	{
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_veryfi WHERE user_id=".$user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row)
		{
			$folder = 'uploaded/veryfi/'.$row->user_id;
			$files = glob($folder.'/*');
			foreach ($files as $key => $value)
			{
				$dataTPL['href'] = $value;
				$name = explode('/', $value);
				$dataTPL['name'] = end($name);
				$this->classMain->dataTPLarrayList('veryfi_app', $dataTPL);
			}
			return $row;
		}
	}

	public function saveGroupWallets($user_id, $type, $sum)
	{
		switch ($type)
		{
			case '+':
				$sign = '+';
			break;
			case '-':
				$sign = '-';
			break;
		}
		foreach ($user_id as $key => $value)
		{
			$this->db->query("INSERT INTO ".DB_PREFIX."_users_wallet VALUES (NULL, ".$value.", '".$this->infoMsg['WALLET_UPDATE']."', ".$sign.$sum.", 0, ".time().", '".$_SERVER['REMOTE_ADDR']."')");
		}
	}

	public function saveGroupOnLine($user_id, $online)
	{
		foreach ($user_id as $key => $value) $this->saveOnLine($value, $online);
	}

	public function saveOnLine($user_id, $online)
	{
		$online = ($online == 0) ? 0 : time()+($online+3600);
		$this->db->query("UPDATE ".DB_PREFIX."_users SET online=".$online." WHERE user_id=".$this->classMain->formatSQL($user_id, 'int')." LIMIT 1");
	}

	public function deleteUser($user_id)
	{
		$this->db->query("DELETE FROM ".DB_PREFIX."_items WHERE user_id=".$user_id);
		$this->db->query("DELETE FROM ".DB_PREFIX."_users_photos WHERE user_id=".$user_id);
		$this->db->query("DELETE FROM ".DB_PREFIX."_users WHERE user_id=".$user_id." LIMIT 1");

		$this->classMain->redirect(ADMIN_FILE.".php?op=user&error=Użytkownik+zostały+usunięty.");
	}

	public function emailActivate($user_id)
	{
		require_once 'funcs/user/classes/register.class.php';
		$registerClass = new register;
		$registerClass->emailActivate($user_id);
		$this->classMain->redirect(false, 'info', $this->errorMsg['EMAIL_VERYFICATION_SENDED']);
	}

	function emailSuspend($user_id)
	{
		global $mainConfig, $emailer;

		$row = $this->db->query("SELECT name, user_email FROM ".DB_PREFIX."_users WHERE user_id=".$user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);

		$this->classMain->sendEmail($this->infoMsg['EMAIL_SUSPEND_TITLE'], $row, 'email_suspend.php', $row->user_email);
	}

	function saveChanges($dane)
	{
		global $profileClass;

		require_once 'funcs/user/classes/user.class.php';
		require_once 'funcs/user/classes/register.class.php';
		$userClass = new user;
		$classRegister = new register;

		//suspend account
		if ($dane['status'] == 2) $this->emailSuspend($dane['user_id']);

		if (!empty($dane['new_pass']) && ($dane['new_pass'] == $dane['new_pass2']))
		{
			$newPass = "user_pass='".$classRegister->hashPass($this->classMain->formatSQL($dane['new_pass']))."',";
		}

		$dane['birth_date'] = str_replace('-', '.', $dane['birth_date']);

		$target = (is_array($dane['target'])) ? implode(', ', $dane['target']) : false;
		$tags = (is_array($dane['tags'])) ? implode(', ', $dane['tags']) : false;
		#$search = (is_array($_POST['search'])) ? implode(', ', $_POST['search']) : false;

		$query = "UPDATE ".DB_PREFIX."_users SET
												".$newPass."
												status='".$dane['status']."',
												username='".$dane['username']."',
												name='".$dane['u_name']."',
												user_email='".$dane['user_email']."',
												phone='".$dane['phone']."',
												city='".$dane['city']."',
												age='".$userClass->getUserAge($dane['birth_date'])."',
												birth_date='".strtotime($dane['birth_date'])."',
												description='".$dane['description']."',
												tags='".$tags."',
												relationship_status='".$dane['relationship']."',
												figure='".$dane['figure']."',
												education='".$dane['education']."',
												smoking='".$dane['smoking']."',
												alcohol='".$dane['alcohol']."',
												orientation='".$dane['orientation']."',
												growth='".$dane['growth']."',
												target='".$target."',
												support='".$dane['support']."',
												langs='".$dane['langs']."',
												bank_account='".$dane['bank_account']."',
												bank_account_name='".$dane['bank_account_name']."',
												price_photos='".$dane['price_photos']."'
												WHERE user_id=".$dane['user_id']." LIMIT 1";

		$this->db->query($query);

		if ($profileClass->profileData->gender == 'p') $profileClass->updateCouple($profileClass->profileData->user_id);

		header("Location: ".ADMIN_FILE.".php?op=user-edit&id=".$dane['user_id']."&info=Profil+został+zaktualizowany");
		exit;

	}

	public function saveWallets($tablicaID, $tablicaSalda, $stareSaldo)
	{
		if (is_array($tablicaID))
		{
			foreach ($tablicaID as $key => $value)
			{
				$saldo = $tablicaSalda[$value]-$stareSaldo[$value];
				if ($saldo != 0) $this->saveCharge($saldo, $this->infoMsg['WALLET_UPDATE'], $value);
			}
		}

		$this->classMain->redirect(false, 'error', $this->errorMsg['WALLETS_UPDATES']);
		exit;

	}

	function searchQuery($dane)
	{
		switch($_POST['search-type'])
		{
			case 'user_id':
				$query = "=".$this->formatSQL($_POST['query'], 'int');
			break;
			default:
				$query = " LIKE '%".$this->formatSQL($_POST['query'])."%'";
			break;
		}

		$query = " AND u.".$this->formatSQL($_POST['search-type']).$query;
		$query .= (!empty($_POST['city'])) ? " AND u.city='".$this->formatSQL($_POST['city'])."'" : '';

		return $query;
	}

	public function memberList($user_id)
	{
		$result = $this->db->query("SELECT um.*, m.name FROM ".DB_PREFIX."_users_member um
																LEFT JOIN ".DB_PREFIX."_member_periods mp ON (mp.id=um.m_id)
																LEFT JOIN ".DB_PREFIX."_member m ON (m.id=mp.m_id)
																WHERE um.user_id=".$user_id." ORDER BY um.date_end ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->date = date('d-m-Y', $row->date);
			$row->date_end = date('d-m-Y', $row->date_end);
			$this->classMain->dataTPLarrayList('um', $row);
		}
	}
	private function memberTime($data)
	{
		switch($data->time_type)
		{
			case 'd':
				$premiumTime = $data->time*86400;
			break;
			case 'm':
				$month = 31;//days in month
				$premiumTime = $data->time*(86400*$month);
			break;
		}
		return $premiumTime;
	}
	public function saveMember($user_id, $m_id)
	{
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_member_periods WHERE id=".$m_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		switch($row->time_type) {
			case 'd': $row->time = $row->time; break;
			case 'w': $row->time = $row->time*7; break;
			case 'm': $row->time = $row->time*30; break;
		}
		$query = "INSERT INTO ".DB_PREFIX."_users_member (
			user_id,
			m_id,
			time,
			price,
			date,
			date_end,
			ip
		) VALUES (
			'".$user_id."',
			'".$row->id."',
			'".$row->time."',
			'0',
			".time().",
			'".(time()+(86400*$row->time))."',
			'".$_SERVER['REMOTE_ADDR']."'
		)";
		$this->db->query($query);
	}
	public function deleteMember($id)
	{
		foreach ($id as $key => $value) $this->db->query("DELETE FROM ".DB_PREFIX."_users_member WHERE id=".$value." LIMIT 1");
	}
}

?>
