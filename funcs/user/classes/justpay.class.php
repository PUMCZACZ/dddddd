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

class justpay extends user {

	const SMS_NOTIFICATION = 'sms_notification.php';
	const SMS_CREDITS_NOTIFICATION = 'sms_credits_notification.php';

	protected $txt = array(
	);

	protected $errorMsg = array(
	);

	public function __construct() {

		global $db, $classMain;

		$this->db = $db;
		$this->classMain = $classMain;
    parent::getConfig();
		parent::is_user();
	}
	private function setSmsId($smsID)
	{
		$this->smsID = $smsID;
	}
	private function setPayConfig($type=false)
	{
		switch ($type)
		{
			case 'credits':
				$this->payConfig = $this->db->query("SELECT * FROM ".DB_PREFIX."_credits_sms WHERE id=".$this->smsID." LIMIT 1")->fetch(PDO::FETCH_OBJ);
				$this->payConfig->notifiUrl = $this->mainConfig->siteurl.'/'.self::SMS_CREDITS_NOTIFICATION;
			break;
			default:
				$this->payConfig = $this->db->query("SELECT * FROM ".DB_PREFIX."_premium_sms WHERE id=".$this->smsID." LIMIT 1")->fetch(PDO::FETCH_OBJ);
				$this->payConfig->notifiUrl = $this->mainConfig->siteurl.'/'.self::SMS_NOTIFICATION;
			break;
		}
	}
	private function setXML()
	{
		$this->payXML = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
		<initSubscriptionRequest>
		<partnerName>'.$this->payConfig->justpay_partner.'</partnerName>
		<serviceName>'.$this->payConfig->justpay_service.'</serviceName>
		<successUrl>'.$this->payConfig->notifiUrl.'</successUrl>
		<failureUrl>'.$this->payConfig->notifiUrl.'</failureUrl>
		<clientIp>91.217.40.200</clientIp>
		</initSubscriptionRequest>';
	}
	private function convertXML($result)
	{
		$this->arrayData = json_decode(json_encode(simplexml_load_string($result)), true);
	}
	private function setPayAddress()
	{
		$this->setPayConfig();
		$this->setXML();

		$url = "http://mtservice.avantis.pl/mtsubscriber/rwdsubscriptions/initSubscription";

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_POST, true );
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $this->payXML );
		$result = curl_exec($ch);
		curl_close($ch);

		$this->convertXML($result);

		$this->payAddress = $this->arrayData['subscriptionPageUrl'];
	}
	private function getPayAddress($smsID)
	{
		$this->setPayAddress($smsID);
	}
	public function showPayPage($smsID)
	{
			$this->setSmsId($smsID);
			$this->setPayAddress();
			$this->redirect($this->payAddress);
	}
	public function showPaySMSPage($smsID)
	{
		if ($_POST['save-sms-code'] == 1) $this->checkSMScode($_POST['sms-code']);

		$this->setSmsId($smsID);
		$this->setPayConfig('credits');
		$this->getCreditsPayPage();
	}
	private function getCreditsPayPage()
	{
		$this->classMain->dataTPLarray($this->payConfig);
		$this->classMain->tpl('tpl_credits_pay.tpl');
	}
	private function veryfiSMScode($code)
	{
		curl -X POST --user 'mantrax:XXX' -H 'SOAPAction: PUT'  https://mps-mantrax.digitalvirgo.pl/mpsml-adapters/services/MPSLocal2 -d '
		<?xml version="1.0" encoding="UTF-8"?>
		<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/">
		<SOAP-ENV:Body>
		<ns4761:put xmlns:ns4761="http://in.local.mps.avantis.pl">
		<message xmlns:ns6613="http://domain.mps.avantis.pl" xsi:type="ns6613:SMSText">
		<id xsi:type="xsd:int">1</id><sender xsi:type="xsd:string">79908</sender>
		<sendDate  xsi:type="xsd:dateTime">2016-02-22T11:00:00</sendDate>
		<recipient xsi:type="xsd:string">48723021565</recipient>
		<directionValue xsi:type="xsd:int">2</directionValue>
		<text xsi:type="xsd:string">TEST</text>
		</message>
		<plainTextCredentials>
		<login xsi:type="xsd:string">mantrax</login>
		<password xsi:type="xsd:string">YYY</password>
		</plainTextCredentials>
		<deliveryReport xsi:type="xsd:int">0</deliveryReport>
		</ns4761:put>
		</SOAP-ENV:Body>
		</SOAP-ENV:Envelope>
	}
	private function checkSMScode($code)
	{
		$dataTPL = $this->veryfiSMScode($code);
		$this->classMain->dataTPLarray($dataTPL);
		$this->classMain->tpl('tpl_credits_pay.tpl');
		exit;
	}
}

?>
