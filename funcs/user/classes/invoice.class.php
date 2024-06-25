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

class invoice extends user
{
	public function __construct()
	{
		global $db, $classMain;

		$this->db = $db;
		$this->classMain = $classMain;
	}

	function dataStartKoniec()
	{
		$poprzedniMiesiac = (date("n") == 1) ? 12 : date("n")-1;
		#$poprzedniMiesiac = (date("n") == 1) ? 12 : date("n");
		$rok = ($poprzedniMiesiac == 12) ? date("Y")-1 : date("Y");

		$dniMiesiaca = date("t", strtotime("01-".$poprzedniMiesiac."-".$rok));

		return array('start' => strtotime("01-".$poprzedniMiesiac."-".$rok), 'koniec' => strtotime($dniMiesiaca."-".$poprzedniMiesiac."-".$rok)+86399);

	}

	function sumowanieOplat($user_id)
	{
		$data = $this->dataStartKoniec();

		$query = "SELECT SUM(kwota) AS suma FROM ".DB_PREFIX."_users_saldo
												WHERE
												(nazwa_operacji IN (
													'Wystawienie przedmiotu',
													'Prowizja od sprzedaży',
													'Opcje promowania',
													'Aktywacja abonamentu firmowego',
													'Aktualizacja przedmiotu',
													'Pogrubienie',
													'Podświetlenie',
													'Wyróżnienie',
													'Strona główna'
												))
												AND user_id=".$user_id." AND data_operacji BETWEEN ".$data['start']." AND ".$data['koniec']."
												GROUP BY user_id";

		$row = $this->db->query($query)->fetch_array(MYSQLI_ASSOC);

		return round($row['suma'], 2);

	}

	function pobieranieID($user_id, $kwota)
	{
		$query = "INSERT INTO ".DB_PREFIX."_users_invoices VALUES (
																NULL,
																".$user_id.",
																'',
																0,
																'".$kwota."',
																0,
																'',
																".time()."
															)";
		$this->db->query($query);

		return $this->db->lastInsertId();

	}

	private function invoiceNumber()
	{
		$dateStart = strtotime('01-'.date('m-Y'));
		$row = $this->db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users_invoices WHERE date>=".$dateStart)->fetch(PDO::FETCH_OBJ);
		return $row->count+1;
	}

	function wystawFakture($userinfo, $kwota)
	{
		if (empty($kwota)) return;

		require_once(dirname(__FILE__).'/../../../inc/classes/tcpdf/config/lang/eng.php');
		require_once(dirname(__FILE__).'/../../../inc/classes/tcpdf/tcpdf.php');

		if (empty($userinfo->company_name) || empty($userinfo->street) || empty($userinfo->post_code) || empty($userinfo->city) || empty($userinfo->nip)) return;

		//ustalanie daty
		/*$startKoniec = $this->dataStartKoniec();
		$koniec = $startKoniec['koniec'];
		$koniecD = date('d', $koniec);
		$koniecM = date('m', $koniec);
		$koniecY = date('Y', $koniec);*/
		$koniecD = date('d', time());
		$koniecM = date('m', time());
		$koniecY = date('Y', time());

		//pobieranie ID faktury
		$fakturyNumer = $this->invoiceNumber();#$this->classMain->mainConfig->invoice_number+1;
		$fakturyNumer = ($fakturyNumer < 10) ? '0'.$fakturyNumer : $fakturyNumer;
		$nrFaktury = $this->classMain->mainConfig->invoice_prefix.'/'.$koniecY.'/'.$koniecM.'/'.$fakturyNumer;
		$idFaktury = $this->pobieranieID($userinfo->user_id, $kwota);

		//ustalanie kwot
		$podatek = 23;
		$dzilnik = 1.23;
		$brutto = $kwota;
		$netto = round($brutto/$dzilnik, 2);
		$kwotaPodatku = round($brutto-$netto, 2);

		#$grosze = number_format(round($brutto), 2, '.', '');
		$grosze = explode('.', $brutto);
		$grosze = $grosze[1];
		$grosze = ($grosze == '100') ? '00' : $grosze;

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$pdf->SetMargins(7, 10, 7);
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$pdf->setLanguageArray($l);
		$pdf->setFontSubsetting(true);
		$pdf->SetFont('dejavusans', '', 10);
		$pdf->AddPage();
		$pdf->SetTextColor(0, 0, 0);

		$utf8text = '
			<style type="text/css">
			table {
				border:none;
				width:100%;
			}
			table.lista {
				border:1px solid #000000;
				font-size:8pt;
			}
			table.lista td {
				border:1px solid #000000;
			}
			</style>
			<p>
			<table style="margin-top:20px;">
				<tr>
					<td style="width:30%;">
						<img src="'.dirname(__FILE__).'/../../../theme/img/logo.png" />
					</td>
					<td style="width:70%; text-align:right;">
						Miejsce wystawienia: '.$this->classMain->mainConfig->invoice_city.'<br />
						Data wystawienia: '.$koniecD.'-'.$koniecM.'-'.$koniecY.'
					</td>
				</tr>
			</table>
			</p>
			<h1 style="text-align:center;">FAKTURA VAT '.$nrFaktury.'</h1>
			<p>
			<table>
				<tr>
					<td style="width:50%;">
						<u>SPRZEDAWCA:</u><br />
						<strong>'.$this->classMain->mainConfig->invoice_name.'</strong><br />
						'.nl2br($this->classMain->mainConfig->invoice_address).'<br />
						'.$this->classMain->mainConfig->invoice_city.'<br />
						NIP '.$this->classMain->mainConfig->invoice_nip.'<br />
						'.$this->classMain->mainConfig->invoice_bank.'
					</td>
					<td style="width:50%;">
						<u>NABYWCA:</u><br />
						<strong>'.$userinfo->company_name.'</strong><br />
						'.$userinfo->street.'<br />
						'.$userinfo->post_code.' '.$userinfo->city.'<br />
						NIP '.$userinfo->nip.'
					</td>
				</tr>
			</table>
			</p>
			<p>
			<table class="lista" cellpadding="7">
				<tr style="background-color:#E1E1E1">
					<td style="text-align:center; width:5%;">LP</td>
					<td style="background:#E1E1E1; width:25%;">Nazwa towaru</td>
					<td style="text-align:center; width:8%;">Ilość</td>
					<td style="text-align:center;">cena jedn. bez podatku</td>
					<td style="text-align:center;">wartość bez podatku</td>
					<td style="text-align:center;">stawka VAT (%)</td>
					<td style="text-align:center;">podatek VAT</td>
					<td style="text-align:center;">wartość z podatkiem</td>
				</tr>
				<tr>
					<td style="text-align:center;">1</td>
					<td>'.$this->classMain->mainConfig->invoice_title.'</td>
					<td style="text-align:center;">1.00</td>
					<td style="text-align:right;">'.number_format($netto, 2, '.', '').' '.$this->classMain->mainConfig->currency.'</td>
					<td style="text-align:right;">'.number_format($netto, 2, '.', '').' '.$this->classMain->mainConfig->currency.'</td>
					<td style="text-align:center;">'.$podatek.'</td>
					<td style="text-align:right;">'.number_format($kwotaPodatku, 2, '.', '').' '.$this->classMain->mainConfig->currency.'</td>
					<td style="text-align:right;">'.number_format($brutto, 2, '.', '').' '.$this->classMain->mainConfig->currency.'</td>
				</tr>
				<tr>
					<td colspan="8">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="4" style="text-align:right;">RAZEM:</td>
					<td style="text-align:right;">'.number_format($netto, 2, '.', '').' '.$this->classMain->mainConfig->currency.'</td>
					<td style="text-align:center;">x</td>
					<td style="text-align:right;">'.number_format($kwotaPodatku, 2, '.', '').' '.$this->classMain->mainConfig->currency.'</td>
					<td style="text-align:right;">'.number_format($brutto, 2, '.', '').' '.$this->classMain->mainConfig->currency.'</td>
				</tr>
				<tr>
					<td colspan="8" style="text-align:right;">
						słownie: '.$this->convert($brutto).' '.$this->pluralize($brutto, 'złoty', 'złote', 'złotych').' '.$grosze.'/100 '.$this->pluralize($grosze, 'grosz', 'grosze', 'groszy').'
					</td>
				</tr>
				<tr>
					<td colspan="8" style="text-align:right;">Zapłacono: '.number_format($brutto, 2, '.', '').' '.$this->classMain->mainConfig->currency.'</td>
				</tr>
			</table>
			</p>
			<p>&nbsp;</p>
			<p style="font-size:8pt; text-align:center;">
				Podstawą do wystawienia faktury VAT bez podpisu osoby uprawnionej do odbioru jest par. 9 ust. 1, z wyjątkami o których mowa w par.11 ust.1 Rozporz. Ministra Finansów z 25 maja 2005r.(DZ.U.z 2005r., Nr 95, poz.798 i Nr 102, poz.860). Niniejsza faktura nie jest fakturą elektroniczną w rozumieniu Rozporządzenia Ministra Finansów z dnia 14 lipca 2005 r. w sprawie sposobu i warunków wystawiania oraz przesyłania faktur w formie elektronicznej (...) (Dz.U. 133 poz. 1119)
			</p>';


		#$numerFaktury = $fakturyNumer.'-'.$koniecM.'-'.$koniecY.'-K';
		$numerFaktury = str_replace('/', '-', $nrFaktury);
		$this->db->query("UPDATE ".DB_PREFIX."_config SET invoice_number=invoice_number+1 LIMIT 1");
		$this->db->query("UPDATE ".DB_PREFIX."_users_invoices SET invoice='".$numerFaktury."' WHERE id=".$idFaktury." LIMIT 1");

		$pdf->writeHTML($utf8text, true, false, true, false, '');
		$pdf->Output(dirname(__FILE__).'/../../../uploaded/invoices/'.$numerFaktury.'.pdf', 'F');

		$this->wyslijWiadomosc($idFaktury, $numerFaktury, $userinfo->user_email, $brutto, 'email_invoice.tpl');
		$this->classMain->mainConfig->invoice_number++;
	}

	function wyslijWiadomosc($idFaktury, $numerFaktury, $adres_email, $brutto, $plikTPL)
	{
		$adresZalacznika = 'uploaded/invoices/'.$numerFaktury.'.pdf';
		$nazwaZalacznika = $numerFaktury.'.pdf';

		$this->classMain->sendEmail(
			$this->classMain->mainConfig->sitename.': Faktura wygenerowana',
			array(
				'SITEURL' => $this->classMain->mainConfig->siteurl,
				'LOGO' => $this->classMain->mainConfig->siteurl.'/theme/img/logo.png',
				'SITENAME' => $this->classMain->mainConfig->sitename,
				'SUMA' => number_format($brutto, 2, '.', ''),
				'NAZWA_FIRMY' => $this->classMain->mainConfig->invoice_name,
				'ADRES' => nl2br($this->classMain->mainConfig->invoice_city)
			),
			$plikTPL,
			$adres_email,
			false,
			false,
			$adresZalacznika,
			$nazwaZalacznika
		);
	}

	//funcje do ustalania liczb słownie
	static  function convert($number) {

		// check if number is negative
		$negative = false;
		if($number < 0) {
			$negative = true;
			$number = abs ($number); // turn to positive
		}
		if($number == 0) { // if zero return zero
			return 'zero';
		}
		$i = -1; // our numberMap key
		$result = '';
		while($number >= 1) {
			$token = $number % 1000; // get 3 digits
			$number = ($number - $token) / 1000; // cut the number
			if($i >= 0) { // if numberMap key is greater than equal thousands
				list($first, $second, $third) = self::$numberMap[$i]; // get plural values from numberMap
				$pluralize = self::pluralize($token, $first, $second, $third); // pluralize
			} else {
				$pluralize = '';
			}
			if($token != 0) { // for zero we don't write anything to output
				$hundredsOf = self::hundredsOf($token) . ' '; // convert 3 digit token
				$result = $hundredsOf . $pluralize . ' ' . $result ; // add to output string
			}
			$i++;
		}
		return trim ($negative ? 'minus ' . $result : $result);
	}

	static  function pluralize($number, $first, $second, $third) {

		$number = abs ($number); // get absolute value, for negative numbers algoritm is the same
		if($number > 20) { // if number is greater than 20
			$number %= 10; // get the last digit
			if($number == 1) { // for 21, 31, 41, ... result is the same as for 0
				$number--;
			}
		}
		if($number == 1) { // 1 - first case
			return $first;
		} else if($number >= 2 && $number <= 4) { // 2,3,4 - second case
			return $second;
		} else { // 0,6,7,8,9 - third case
			return $third;
		}
	}

	protected static  $numberMap = array (
		array ('tysiąc', 'tysiące', 'tysięcy'),
		array ('milion', 'miliony', 'milionów'),
		array ('miliard', 'miliardy', 'miliardów'),
		array ('bilion', 'biliony', 'bilionów'),
		array ('biliard', 'biliardy', 'biliardów'),
		array ('trylion', 'tryliony', 'trylionów'),
		array ('tryliard', 'tryliardy', 'tryliardów')
	);

	protected static  $ones = array (
		'jeden', 'dwa', 'trzy',
		'cztery', 'pięć', 'sześć',
		'siedem', 'osiem', 'dziewięć'
	);

	protected static  $tens = array (
		'dziesięć', 'dwadzieścia', 'trzydzieści',
		'czterdzieści', 'pięćdziesiąt', 'sześćdziesiąt',
		'siedemdziesiąt', 'osiemdziesiąt', 'dziewięćdziesiąt'
	);

	protected static  $specialTens = array (
		'jedenaście', 'dwanaście', 'trzynaście',
		'czternaście', 'piętnaście', 'szesnaście',
		'siedemnaście', 'osiemnaście', 'dziewiętnaście'
	);

	protected static  $hundreds = array (
		'sto', 'dwieście', 'trzysta',
		'czterysta', 'pięćset', 'sześćset',
		'siedemset', 'osiemset', 'dziewięćset'
	);

	protected static  function hundredsOf($number) {
		$ones = $number % 10;
		$tens = (($number % 100) - $ones);
		$hundreds = ($number - $tens - $ones) / 100;
		$tens /= 10;

		$result = '';
		if($hundreds != 0) {
			$result .= self::$hundreds[$hundreds - 1] . ' ';
		}
		if($tens == 1 && $ones != 0) {
			$result .= self::$specialTens[$ones - 1] . ' ';
		} else {
			if($tens != 0) {
				$result .= self::$tens[$tens - 1] . ' ';
			}
			if($ones != 0) {
				$result .= self::$ones[$ones - 1] . ' ';
			}
		}

		return trim ($result);

	}
}

?>
