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

class payment extends user {

	protected $txt = array(
		'WALLET_CREDITS_BUY' => 'Zakup kredytów',
		'WALLET_CREDITS_EXTRA' => 'Zakup pakietu kredytów',
		'WALLET_PREMIUM_CREDITS' => 'Zakup pakietu Premium'
	);
	protected $errorMsg = array(
	);

	public function __construct() {

		global $db, $classMain;

		$this->db = $db;
		$this->classMain = $classMain;
    parent::getConfig();
		$this->is_user();
	}

	public function smsCodeCheck($smsCode)
	{
		require_once 'funcs/user/classes/przelewy24sms.class.php';
		$classSMS = new p24sms;
		$smsInfo = $this->smsCheck($_SESSION['payment']['func']['id']);
		$classSMS->checkSMS($_SESSION['payment']['func']['id'], $smsCode);
	}

	public function smsCheck($id)
	{
		$row = $this->db->prepare("SELECT sms.* FROM ".DB_PREFIX."_member_periods mp LEFT JOIN ".DB_PREFIX."_sms sms ON (sms.id=mp.sms_id) WHERE mp.id=:id LIMIT 1");
		$row->bindValue(':id', $id, PDO::PARAM_INT);
		$row->execute();
		$row = $row->fetch(PDO::FETCH_OBJ);
		return $row;
	}

	public function getUserInfo($i_id)
	{
		$row = $this->db->query("SELECT u.user_id, u.user_email FROM ".DB_PREFIX."_items i LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id) WHERE i.id=".$i_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);

		return $row;
	}

	public function checkPromoCode($sum, $user_id=false, $submit=false)
	{
		if ($user_id == false) return;

		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_promo_codes WHERE user_id=".$user_id." AND date_used=0 LIMIT 1")->fetch(PDO::FETCH_OBJ);

		if (!$row) return;

		if ($submit) $this->db->query("UPDATE ".DB_PREFIX."_promo_codes SET date_used=".time()." WHERE id=".$row->id." LIMIT 1");

		return number_format($sum-$sum*($row->discount/100), 2);
	}

	public function createInvoice($user_id, $price, $name, $type='vat', $payment_type='transfer')
	{
		if (empty($price)) return;

		switch ($payment_type)
		{
			case 'p24':
				$payment_type = 'Przelewy24';
			break;
			case 'pp':
				$payment_type = 'paypal';
			break;
			default:
				$payment_type = $payment_type;
			break;
		}
		$buyerInfo = $this->db->query("SELECT * FROM ".DB_PREFIX."_users WHERE user_id=".$user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		/*if ($buyerInfo->country)
		{
			$taxInfo = $this->db->query("SELECT * FROM ".DB_PREFIX."_tax WHERE country=".$buyerInfo->country." LIMIT 1")->fetch(PDO::FETCH_OBJ);
			$taxValue = $taxInfo->value;
		}*/
		if (!isset($taxInfo) || empty($taxInfo->value)) $taxValue = 23;

		if ($this->classMain->mainConfig->invoice_system == 0)
		{
			include_once 'funcs/user/classes/invoice.class.php';
			$classInvoice = new invoice;
			$classInvoice->wystawFakture($buyerInfo, $price);
		}
		else
		{
			$invoiceDate = date('Y-m-d');
			$host = $this->mainConfig->fakturownia_id.'.fakturownia.pl';
			$token = $this->mainConfig->fakturownia_token;
			$json ='{
				"api_token": "'.$token.'",
				"invoice": {
						"kind":"'.$type.'",
						"number": null,
						"sell_date": "'.$invoiceDate.'",
						"issue_date": "'.$invoiceDate.'",
						"payment_to": "'.$invoiceDate.'",
						"buyer_name": "'.$buyerInfo->company_name.'",
						"buyer_email": "'.$buyerInfo->user_email.'",
						"buyer_tax_no": "'.$buyerInfo->nip.'",
						"paid":"'.number_format($price, 2, '.', '').'",
						"payment_type":"'.$payment_type.'",
						"positions":[
							{"name":"'.$name.'", "tax":'.$taxValue.', "total_price_gross":'.number_format($price, 2, '.', '').', "quantity":1}
						]
					}}';

			$c = curl_init();

			curl_setopt($c, CURLOPT_URL, 'http://'.$host.'/invoices.json');

			$head[] ='Accept: application/json';
			$head[] ='Content-Type: application/json';
			curl_setopt($c, CURLOPT_HTTPHEADER, $head);
			curl_setopt($c, CURLOPT_POSTFIELDS, $json);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);

			$result = (array)json_decode(curl_exec($c));

			if ($result['code'] == 'error' || $result['status'] == 400)
			{
				try {
					$this->fakturowniaError($result);
				} catch (\Throwable $th) {
					print_r($result);
					echo $th->getMessage();
					exit;
				}
			}
			else $this->saveInvoice($buyerInfo->user_id, $result);
		}
	}

	private function fakturowniaError($data)
	{
		$message = (array) $data['message'];
		$msgKeys = array_keys($message);
		throw new Exception(ucfirst(substr($message[$msgKeys[0]][0].$message[$msgKeys[1]][0], 2)));
	}

	private function saveInvoice($user_id, $result)
	{
		$this->db->query("INSERT INTO ".DB_PREFIX."_users_invoices VALUES (
			NULL,
			".$user_id.",
			'".$result['number']."',
			'".$result['id']."',
			'".$result['price_gross']."',
			0,
			'".strtotime($result['sell_date'])."'
		)");
	}


	public function setPayment($user_id, $sum, $funcArray, $payOperators=false)
	{
		unset($_SESSION['payment']);
		$_SESSION['payment']['user_id'] = $this->formatSQL($user_id, 'int');
		$_SESSION['payment']['sum'] = str_replace(',', '.', str_replace(' ', '', $sum));
		$_SESSION['payment']['func'] = $funcArray;
		if ($payOperators) $_SESSION['payment']['pay_operators'] = $payOperators;

		$this->redirect('funcs.php?name=user&file=payment');
	}
	private function setPaymentInfo()
	{
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_payments WHERE hash='".$this->hash."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
		$paymentInfo = array(
					'user_id' => $row->user_id,
					'func' => $row->func,
					'extra_info' => ($row->func == 'add_item') ? unserialize($row->extra_info) : $row->extra_info,
					'operator' => $row->operator,
					'amount' => $row->suma
		);
		$this->paymentInfo = (object) $paymentInfo;
		$this->paymentType = $row->func;
	}
	private function setFuncDetails()
	{
		switch($this->paymentInfo->func)
		{
			case 'add_item':
				$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_items WHERE id=".$this->formatSQL($this->paymentInfo->extra_info['id'], 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);
				$row->title = $this->setLangVar('title', $row);
			break;
			case 'member':
			default:
				$query = "SELECT m.name, mp.id, mp.time, mp.time_type, mp.price, mp.f_product_id_pl, mp.f_product_id_en, mp.f_product_id_ru FROM ".DB_PREFIX."_member m
				RIGHT JOIN ".DB_PREFIX."_member_periods mp ON (m.id=mp.m_id) WHERE mp.id=".$this->formatSQL($this->paymentInfo->extra_info, 'int')." LIMIT 1";
				$row = $this->db->query($query)->fetch(PDO::FETCH_OBJ);
				switch($row->time_type) {
					case 'd': $row->time = $row->time; break;
					case 'w': $row->time = $row->time*7; break;
					case 'm': $row->time = $row->time*30; break;
				}
			break;
		}
		$this->funcDetails = $row;
	}
	private function setUserInfo()
	{
		$this->buyerInfo = $this->db->query("SELECT * FROM ".DB_PREFIX."_users WHERE user_id=".$this->formatSQL($this->paymentInfo->user_id, 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);
	}
	private function setMemberTime()
	{
		$timeStart = ($this->buyerInfo->premium > time()) ? $this->buyerInfo->premium : time();
		switch($this->funcDetails->time_type)
		{
			case 'd':
				$premiumTime = $this->funcDetails->time*86400;
			break;
			case 'm':
				$month = 31;//days in month
				$premiumTime = $this->funcDetails->time*(86400*$month);
			break;
		}
		$this->premiumTime = $timeStart+$premiumTime;
	}
	private function setPrice()
	{
		$this->price = ($this->paymentType == 'credit') ? 0 : $this->funcDetails->price;
	}
	private function savePaymentDB()
	{
		switch($this->paymentInfo->func)
		{
			case 'add_item':
				$setQuery = array();
				/*$setQuery[] = ($this->paymentInfo->extra_info['promo']['bold']) ? 'promo_bold=1' : 'promo_bold=0';
				$setQuery[] = ($this->paymentInfo->extra_info['promo']['backlight']) ? 'promo_backlight=1' : 'promo_backlight=0';
				$setQuery[] = ($this->paymentInfo->extra_info['promo']['distinction']) ? 'promo_distinction=1' : 'promo_distinction=0';
				$setQuery[] = ($this->paymentInfo->extra_info['promo']['main_page']) ? 'promo_mainpage=1' : 'promo_mainpage=0';*/
				$setQuery[] = ($this->paymentInfo->extra_info['promo']['bold']) ? 'promo_bold=1' : false;
				$setQuery[] = ($this->paymentInfo->extra_info['promo']['backlight']) ? 'promo_backlight=1' : false;
				$setQuery[] = ($this->paymentInfo->extra_info['promo']['distinction']) ? 'promo_distinction=1' : false;
				$setQuery[] = ($this->paymentInfo->extra_info['promo']['mainpage']) ? 'promo_mainpage=1' : false;
				$setQuery = array_filter($setQuery);

				if ($this->paymentInfo->extra_info['time'])
				{
					$time = $this->formatSQL($this->paymentInfo->extra_info['time'], 'int');
					$setQuery[] = "time=".$time;
					$setQuery[] = "start=".time();
					$setQuery[] = "end=".(time()+($time*86400));
				}

				$setQuery = implode(', ', $setQuery);
				$setQuery = ($setQuery) ? ', '.$setQuery : false;

				$query = "UPDATE ".DB_PREFIX."_items SET
					active=1,
					save_only=0
					".$setQuery."
					WHERE id=".$this->formatSQL($this->paymentInfo->extra_info['id'])." AND user_id=".$this->paymentInfo->user_id." LIMIT 1";

				$this->db->query($query);
			break;
			case 'member':
				$this->setMemberTime();
				$this->setPrice();
				$this->funcDetails->price = (empty($this->funcDetails->price)) ? 0 : $this->funcDetails->price;

				$query = "INSERT INTO ".DB_PREFIX."_users_member (
					user_id,
					m_id,
					time,
					price,
					date,
					date_end,
					ip
				) VALUES (
					'".$this->paymentInfo->user_id."',
					'".$this->funcDetails->id."',
					'".$this->funcDetails->time."',
					'".$this->paymentInfo->amount."',
					".time().",
					'".(time()+(86400*$this->funcDetails->time))."',
					'".$_SERVER['REMOTE_ADDR']."'
				)";
				$this->db->query($query);
			break;
			case 'amount':
				$query = "INSERT INTO ".DB_PREFIX."_users_balance (
					user_id,
					amount,
					date,
					ip,
					type
				) VALUES (
					'".$this->paymentInfo->user_id."',
					'".$this->paymentInfo->amount."',
					".time().",
					'".$_SERVER['REMOTE_ADDR']."',
					294
				)";
				$this->db->query($query);
			break;
		}
		/*try{
			$this->createInvoice($this->paymentInfo->user_id, $this->funcDetails->price, $this->classMain->setLangVar('f_product_id', $this->funcDetails, $this->buyerInfo->lang), 'vat', $this->paymentInfo->operator);
		} catch (Exception $e) {
			return $e->getMessage();
		}*/
	}
	public function savePayment($hash)
	{
		$this->hash = $hash;
		$this->setPaymentInfo();
		$this->setFuncDetails();
		$this->setUserInfo();

		#if (empty($this->paymentInfo->id)) return;

		$this->savePaymentDB();

		$this->db->query("UPDATE ".DB_PREFIX."_payments SET paid=1 WHERE hash='".$this->hash."' LIMIT 1");

		return true;
	}
	public function updateUserBanalce($user_id, $price, $type=295, $i_id=0)
	{
		$sql = "INSERT INTO ".DB_PREFIX."_users_balance (
			user_id,
			amount,
			date,
			ip,
			type,
			i_id
		) VALUES (
			?,?,?,?,?,?
		)";
		$this->db->prepare($sql)->execute([$user_id, $price, time(), $_SERVER['REMOTE_ADDR'], $type, $i_id]);
	}
}

?>
