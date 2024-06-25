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

class member extends user {

	public function txt($var)
	{
		$txt = array(
		'MONTH_1' => $this->classMain->_LANG['MONTH_1'],
		'MONTH_2' => $this->classMain->_LANG['MONTH_2'],
		'MONTH_5' => $this->classMain->_LANG['MONTH_5'],
		);
		return $txt[$var];
	}
	public function infoMsg($var)
	{
		$infoMsg = array(
			'PAYMENT_SAVE' => $this->classMain->_LANG['PAYMENT_SAVE'],
			'ADD_USER_DATA' => $this->classMain->_LANG['ADD_USER_DATA'],
			'PROMO_CODE_SAVED' => $this->classMain->_LANG['PROMO_CODE_SAVED']
		);
		return $infoMsg[$var];
	}
	public function errorMsg($var)
	{
		$msg = array(
			'PROMO_CODE_USED' => $this->classMain->_LANG['PROMO_CODE_USED'],
			'PROMO_CODE_EMPTY' => $this->classMain->_LANG['PROMO_CODE_EMPTY']
		);
		return $msg[$var];
	}

	public function __construct() {

		global $db, $classMain;

		$this->db = $db;
		$this->classMain = $classMain;
    parent::getConfig();
		parent::is_user();
	}

	public function promoCodesList()
	{
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_promo_codes WHERE user_id=".$this->userinfo->user_id." ORDER BY date_end ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->date_end = date('d-m-Y', $row->date_end);
			$row->date_used = ($row->date_used) ? date('d-m-Y', $row->date_used) : false;
			$this->classMain->dataTPLarrayList('pc', $row);
		}
	}

	public function activeMember()
	{
		$query = "SELECT
				um.id, um.time, um.date, um.date_end,
				m.name, m.extra_ads, m.extra_photos, m.extra_bids, m.extra_distinction, m.extra_main_page,
				mp.time_type
			FROM ".DB_PREFIX."_users_member um
				LEFT JOIN ".DB_PREFIX."_member_periods mp ON (mp.id=um.m_id)
				LEFT JOIN ".DB_PREFIX."_member m ON (m.id=mp.m_id)
			WHERE um.user_id=".$this->formatSQL($this->userinfo->user_id, 'int')." AND um.date_end>".time()."
			GROUP BY um.id
			ORDER BY m.type DESC, um.id DESC";
		$result = $this->db->query($query);
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$rowItems = $this->db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users_member_data WHERE um_id=".$row->id." AND type='ads'")->fetch(PDO::FETCH_OBJ);
			$rowBids = $this->db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users_member_data WHERE um_id=".$row->id." AND type='bids'")->fetch(PDO::FETCH_OBJ);
			$rowDistictions = $this->db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users_member_data WHERE um_id=".$row->id." AND type='distinction'")->fetch(PDO::FETCH_OBJ);
			$rowMainPage = $this->db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users_member_data WHERE um_id=".$row->id." AND type='main-page'")->fetch(PDO::FETCH_OBJ);

			$row->items = $rowItems->count;
			$row->bids = $rowBids->count;
			$row->distinctions = $rowDistictions->count;
			$row->main_pages = $rowMainPage->count;
			$row->date = date('d-m-Y', $row->date);
			$row->date_end = date('d-m-Y', $row->date_end);
			$this->classMain->dataTPLarrayList('um', $row);

			$result2 = $this->db->query("SELECT i.title_".$this->classMain->defLang.", umd.type, umd.date FROM ".DB_PREFIX."_users_member_data umd
																LEFT JOIN ".DB_PREFIX."_items i ON (i.id=umd.i_id)
																WHERE umd.um_id=".$row->id." ORDER BY umd.date DESC");
			while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
			{
				$row2->date = date('d-m-Y', $row2->date);
				$row2->title = $this->setLangVar('title', $row2);
				$this->classMain->dataTPLarrayList('um.umd', $row2);
			}
		}
	}

	public function userMember($user_id, $type)
	{
		$row = $this->db->query("SELECT um.date_end, m.name FROM ".DB_PREFIX."_users_member um
															LEFT JOIN ".DB_PREFIX."_member_periods mp ON (mp.id=um.m_id)
															LEFT JOIN ".DB_PREFIX."_member m ON (m.id=mp.m_id)
															WHERE um.user_id=".$this->formatSQL($user_id, 'int')." ORDER BY um.id DESC LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row)
		{
			switch($type)
			{
				case 'name':
					return $row->name;
				break;
				case 'time':
					return ($row->date_end) ? date('d-m-Y', $row->date_end) : false;
				break;
			}
		}
	}

	public function checkFree($mp_id)
	{
		$row = $this->db->query("SELECT m.* FROM ".DB_PREFIX."_member_periods mp
											RIGHT JOIN ".DB_PREFIX."_member m ON (m.id=mp.m_id)
											WHERE mp.id=".$this->classMain->formatSQL($mp_id, 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		return ($row->free == 1 || ($row->free == 1 && $row->free_end > time()) || $this->freePeriod($mp_id));
	}

	public function memberList($type=0, $tplName='m', $admin=false)
	{
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_member WHERE type=".$this->formatSQL($type, 'int')." AND (active=1 OR (active=1 AND active_end>".time().")) ORDER BY id ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->free = ($row->free == 1 || ($row->free == 1 && $row->free_end > time()));
			$this->classMain->dataTPLarrayList($tplName, $row);
			$mpNo = 1;
			$result2 = $this->db->query("SELECT * FROM ".DB_PREFIX."_member_periods WHERE m_id=".$row->id." ORDER BY time ASC");
			while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
			{
				$row2->time_name = $this->getTimeName($row2->time);
				$row2->no = $mpNo;
				if ($admin == false) $row2->free = $this->freePeriod($row2->id);
				$this->classMain->dataTPLarrayList($tplName.'.mp', $row2);
				$mpNo++;
			}
		}
	}
	private function freePeriod($id)
	{
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_member_periods WHERE id=".$id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row && $row->free_once == 1)
		{
			$rowUser = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_member WHERE m_id=".$row->id." AND user_id=".$this->userinfo->user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
			if ($rowUser) return false; else return true;
		}

	}
	private function getTimeName($time)
	{
		switch(true)
		{
			case $time == 1: $return = $this->txt('MONTH_1'); break;
			case $time > 1 && $time < 5: $return = $this->txt('MONTH_2'); break;
			case $time >= 5: $return = $this->txt('MONTH_5'); break;
		}
		return $return;
	}
	private function setPaymentOP($op)
	{
		$this->paymentOP = $op;
	}
	private function setPaymentInfo()
	{
		switch($this->paymentOP)
		{
			case 'member':
				$query = "SELECT m.name, m.type, mp.*
				FROM ".DB_PREFIX."_member m
				RIGHT JOIN ".DB_PREFIX."_member_periods mp ON (mp.m_id=m.id)
				WHERE mp.id=".$this->formatSQL($_POST['mp_id'], 'int')." LIMIT 1";
			break;
		}
		$this->paymentInfo = $this->db->query($query)->fetch(PDO::FETCH_OBJ);
		$this->paymentInfo->name = ($this->paymentInfo->type == 1) ? $this->setLangVar('f_product_id', $this->paymentInfo) : $this->paymentInfo->name;
	}
	private function setPaymentFuncs()
	{
		$this->paymentFuncs = array(
			'func' => $this->paymentOP,
			'id' => $this->paymentInfo->id,
			'name' => $this->paymentInfo->name,
			'time' => $this->paymentInfo->time,
			'time_name' => $this->getTimeName($this->paymentInfo->time)
		);
	}
	private function checkUserData($user_id)
	{
		$row = $this->db->query("SELECT company_name, nip, city, street, post_code FROM ".DB_PREFIX."_users WHERE user_id=".$user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row->country == 1) unset($row->nip);
		foreach ($row as $key => $value)
		{
			if (!$value) $this->redirect('user', 'error', $this->infoMsg('ADD_USER_DATA'));
		}
	}
	public function makePayment($op)
	{
		include_once 'funcs/user/classes/payment.class.php';
		$classPayment = new payment;

		#$this->checkUserData($this->userinfo->user_id);
		$this->setPaymentOP($op);
		$this->setPaymentInfo();
		$this->setPaymentFuncs();
		$classPayment->setPayment($this->userinfo->user_id, $this->paymentInfo->price, $this->paymentFuncs);
	}
	public function historyList()
	{
		$result = $this->db->query("SELECT um.*, m.name
			FROM ".DB_PREFIX."_users_member um
			LEFT JOIN ".DB_PREFIX."_member m ON (m.id=um.m_id) WHERE um.user_id=".$this->userinfo->user_id." ORDER BY um.date DESC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->date = date('d-m-Y H:i:s', $row->date);
			$this->classMain->dataTPLarrayList('m', $row);
		}
	}
	private function setBankAccount()
	{
		$this->bankAccount = $this->formatSQL($_POST['bank_account']);
	}
	private function setSalaryName()
	{
		$this->salaryName = $this->formatSQL($_POST['bank_account_name']);
	}
	private function setSalaryValue()
	{
		$this->salaryValue = -$this->userWallet();
	}
	private function setSalaryPrice()
	{
		$this->salaryPrice = $this->salaryValue*$this->mainConfig->price_credit;
	}
	private function saveSalary()
	{
		$this->db->query("INSERT INTO ".DB_PREFIX."_payments_salary VALUES (
			NULL,
			".$this->userinfo->user_id.",
			'".($this->salaryValue*-1)."',
			'".($this->salaryPrice*-1)."',
			'".$this->mainConig->price_credit."',
			'".$this->bankAccount."',
			'".$this->salaryName."',
			".time().",
			'".$_SERVER['REMOTE_ADDR']."',
			0
		)");
		$this->db->query("INSERT INTO ".DB_PREFIX."_users_wallet VALUES (
			NULL,
			".$this->userinfo->user_id.",
			'".$this->txt('SALARY_CREDITS')."',
			'".$this->salaryValue."',
			0,
			".time().",
			'".$_SERVER['REMOTE_ADDR']."'
		)");
	}
	public function addSalary()
	{
		$this->setBankAccount();
		$this->setSalaryName();
		$this->setSalaryValue();
		$this->setSalaryPrice();
		$this->saveSalary();
		throw new Exception($this->errorMsg['SALARY_ADDED']);
	}
	public function salaryList($tplName='pay', $status=1)
	{
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_payments_salary WHERE user_id=".$this->userinfo->user_id." AND status=".$status." ORDER BY date DESC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->date = date('d-m-Y', $row->date);
			$this->classMain->dataTPLarrayList($tplName, $row);
		}
	}

	private function checkPromoCode()
	{
		if (empty($this->code)) throw new Exception($this->errorMsg('PROMO_CODE_EMPTY'));

		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_promo_codes WHERE code='".$this->code."' LIMIT 1")->fetch(PDO::FETCH_OBJ);

		if ($row->user_id || $row->date_used || $row->date_end < time()) throw new Exception($this->errorMsg('PROMO_CODE_USED'));
	}
	public function savePromoCode($code)
	{
		$this->code = $this->formatSQL($code);
		$this->checkPromoCode();

		$this->db->query("UPDATE ".DB_PREFIX."_promo_codes SET user_id=".$this->userinfo->user_id." WHERE code='".$this->code."' LIMIT 1");

		$this->redirect('funcs.php?name=user&file=member', 'info', $this->infoMsg('PROMO_CODE_SAVED'));
	}
}

?>
