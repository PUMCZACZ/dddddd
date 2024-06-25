<?php

class p24sms extends payment
{
  const USER_AGENT = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";

  const URL = "https://secure.przelewy24.pl/smsver.php";

  public function checkSMS($id, $sms)
  {
    $sms = $this->formatSQL($sms);
    try {
      $this->smsInfo = $this->smsCheck($id);
      $this->getSMSinfo($id);
    } catch (Exception $e) {
      $this->redirect(false, $e->getMessage());
    }
  }
  private function getSMSinfo($id)
  {
    $id = $this->formatSQL($id, 'int');
    $this->smsInfo->price = $this->smsInfo->price*100;

    $P = array();
    $P[] = "p24_id_sprzedawcy=".$this->mainConfig->p24_id; //merchant id
    $P[] = "p24_kwota=".$this->smsInfo->price;//sms price
    $P[] = "p24_sms=".$this->smsInfo->text;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST,1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,join("&",$P));
    curl_setopt($ch, CURLOPT_URL,self::URL);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_USERAGENT, self::USER_AGENT);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    $result = curl_exec ($ch);

    /*if ($result == "OK") return true;
    else throw new Exception($result);*/
    print_r($result);
    exit;
  }
}
