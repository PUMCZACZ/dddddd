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

class platnosci {

	public function __construct() {

		global $prefix;

		$this->prefix = $prefix;
	}

	function zapiszKategoriePlatnosci($nazwa) {
			@mysql_query("INSERT INTO ".$this->prefix."_platnosci_kanaly (
																rodzaj,
																nazwa
														) VALUES (
																'kategoria',
																'".$nazwa."'
			)");

		header("Location: admin.php?op=platnosci&error=Nowe+kategorie+zostały+dodane");
		exit;

	}

	function zapiszKanal($kat_id, $kanal_id, $nazwa) {

		@mysql_query("INSERT INTO ".$this->prefix."_platnosci_kanaly VALUES (
																	NULL,
																	'kanal',
																	'".$kat_id."',
																	'".$kanal_id."',
																	'".$nazwa."'
		)");

		header("Location: admin.php?op=platnosci&error=Nowy+kanał+płatno¶ci+został+dodany");
		exit;

	}

	function zapiszZmianyKanalow($usun, $id, $nazwa, $kanal_id, $kat_id) {

		for ($i=0; $i < count($usun); $i++) {
			@mysql_query("DELETE FROM ".$this->prefix."_platnosci_kanaly WHERE id='".$usun[$i]."'");
		}	
	
		for ($i=0; $i < count($_POST['id']); $i++) {
			@mysql_query("UPDATE ".$this->prefix."_platnosci_kanaly SET 
									nazwa='".$nazwa[$i]."', 
									kanal_id='".$kanal_id[$i]."',
									kat_id='".$kat_id[$i]."' 
								WHERE id='".$id[$i]."'");
		}

		header("Location: admin.php?op=platnosci&errorZmiany+zostały+zapisane");
		exit;

	}

	function zapiszZmianyKategorii($usun, $nazwa, $id) {

		for ($i=0; $i < count($usun); $i++) {
			@mysql_query("DELETE FROM ".$this->prefix."_platnosci_kanaly WHERE id='".$usun[$i]."'");
		}	
	
		for ($i=0; $i < count($id); $i++) {
			@mysql_query("UPDATE ".$this->prefix."_kanaly_platnosci SET 
																nazwa='".$nazwa[$i]."'
																WHERE id='".$id[$i]."'
			");
		}

		header("Location: admin.php?op=platnosci&error=Zmiany+zostały+zapisane");
		exit;

	}

	function kategorieKanalow($id=0) {

		$kategorie = '<select name="kat_id[]" size="1">';
		$result = @mysql_query("SELECT * FROM ".$this->prefix."_platnosci_kanaly WHERE rodzaj='kategoria'");
		while ($row = @mysql_fetch_array($result)) {
				$selected = ($row['id'] == $id) ? ' selected' : '';
				$kategorie .= '<option value="'.$row['id'].'"'.$selected.'>'.$row['nazwa'].'</option>';
		}
		$kategorie .= '</select>';

		return $kategorie;

	}

	function usunSMSy($usun) {

		$dane = base64_decode($usun);
		$dane = explode('|', $dane);

		$tresc_sms = $dane[0];
		$numer_sms = $dane[1];

		@mysql_query("DELETE FROM ".$this->prefix."_platnosci_sms WHERE tresc_sms='".$tresc_sms."' AND numer_sms='".$numer_sms."'");

		header("Location: admin.php?op=platnosci_sms&error=SMSy+zostały+usunięte");
		exit;

	}

	function zapiszSMSy($sms, $tresc_sms, $numer_sms, $netto, $brutto) {

		$kody = explode("\r\n", $sms);
		for ($i=0; $i < count($kody); $i++) {
			@mysql_query("INSERT INTO ".$this->prefix."_platnosci_sms VALUES (
																'".$kody[$i]."',
																'".$tresc_sms."',
																'".$numer_sms."',
																'".str_replace(",", ".", $netto)."',
																'".str_replace(",", ".", $brutto)."'
			)");
		}

		header("Location: admin.php?op=platnosci_sms&error=Nowe+SMSy+zostały+zapisane");
		exit;

	}

	function zapiszZmianySMS($stara_tresc_sms, $sms, $tresc_sms, $numer_sms, $netto, $brutto) {

		for ($i=0; $i < count($stara_tresc_sms); $i++) {
			@mysql_query("UPDATE ".$this->prefix."_platnosci_sms SET 
														sms='".$sms[$i]."', 
														tresc_sms='".$tresc_sms[$i]."', 
														numer_sms='".$numer_sms[$i]."',
														netto='".$netto[$i]."', 
														brutto='".$brutto[$i]."'
														WHERE tresc_sms='".$stara_tresc_sms[$i]."'
			");
		}

		header("Location: admin.php?op=platnosci_sms&error=Zmiany+w+SMSach+zostały+zapisane");
		exit;

	}

}

?>