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

class ogloszenia {

	public function __construct() {

		global $prefix, $admin_file, $db;

		$this->prefix = $prefix;
		$this->db = $db;
		$this->admin_file = $admin_file;

	}

	public function zapiszSzablon()
	{
		if (!empty($_FILES['miniaturka']['tmp_name'])) $miniaturka = "miniaturka='".$this->zapiszMiniaturke($_FILES['miniaturka'])."',";
		$this->db->query("UPDATE ".$this->prefix."_szablony SET
															".$miniaturka."
															nazwa='".formatSQL($_POST['nazwa'])."',
															szablon='".$this->db->real_escape_string($_POST['szablon'])."'
															WHERE id=".intval(formatSQL($_POST['id']))." LIMIT 1");
	}

	public function dodajSzablon()
	{
		$this->db->query("INSERT INTO ".$this->prefix."_szablony VALUES (NULL, '".formatSQL($_POST['nazwa'])."', '".addslashes($_POST['szablon'])."', '".$this->zapiszMiniaturke($_FILES['miniaturka'])."')");
	}

	private function zapiszMiniaturke($zdjecie)
	{
		require_once 'includes/class.upload.php';

		$handle = new Upload($zdjecie);

		$nazwa_zdjecia = uniqid();

		if ($handle->uploaded)
		{
			if (($handle->file_src_mime == 'image/jpeg') or ($handle->file_src_mime == 'image/gif') or ($handle->file_src_mime == 'image/png'))
			{
				$handle->image_resize             = true;
				$handle->image_ratio_fill         = true;
				$handle->image_x                  = 120;
				$handle->image_y                  = 90;
				$handle->image_background_color   = '#FFFFFF';
				$handle->file_src_name_body	= $nazwa_zdjecia;

				$nazwaZdjecia = $nazwa_zdjecia.'.'.$handle->file_src_name_ext;

				if ($handle->Process('images/szablony/')) return $nazwaZdjecia;
			}
		}
	}

	public function zakonczPrzedmiot($id)
	{
		$this->db->query("UPDATE ".$this->prefix."_przedmioty SET koniec=".time().", odnowienie='n' WHERE id=".intval($id)." LIMIT 1");
	}

	public function weryfikuj($id)
	{
		for ($i=0; $i < count($id); $i++)
		{
			$this->db->query("UPDATE ".$this->prefix."_przedmioty SET weryfikacja=1 WHERE id=".intval($id[$i])." LIMIT 1");
		}
	}

	function wystawPonownie($tablicaID) {

		for ($i=0; $i < count($tablicaID); $i++)
		{
			$row = $this->db->query("SELECT id, start, koniec, czas FROM ".$this->prefix."_przedmioty WHERE id=".intval($tablicaID[$i])." LIMIT 1")->fetch_array(MYSQLI_ASSOC);
			$nowyStart = time();
			$nowyKoniec = $row['czas'];
			$nowyKoniec = (time()+(86400*$row['czas']));
			$this->db->query("UPDATE ".$this->prefix."_przedmioty SET start=".$nowyStart.", koniec=".$nowyKoniec.", aktywne=1 WHERE id=".$row['id']." LIMIT 1");
		}
	}

	function usunPrzedmiot($id)
	{
		//usuwanie zdjęć
		$zdjecia = glob("uploaded/".$id."/*");
		for ($a=0; $a < count($zdjecia); $a++) @unlink($zdjecia[$a]);

		$this->db->query("DELETE FROM ".$this->prefix."_przedmioty_zdjecia WHERE id_ogloszenia=".$id);

		//usuwanie wyświetleń
		$this->db->query("DELETE FROM ".$this->prefix."_przedmioty_wyswietlenia WHERE id=".$id." LIMIT 1");

		//usuwanie danych ogłoszenia
		$this->db->query("DELETE FROM ".$this->prefix."_przedmioty WHERE id=".$id." LIMIT 1");
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
			$row = $this->db->query("SELECT user_id FROM ".$this->prefix."_users WHERE adres_email='".$fraza."' LIMIT 1")->fetch_array(MYSQLI_ASSOC);
			$query .= (!empty($row['user_id'])) ? "user_id=".$row['user_id']." OR " : '';
		}
		else
		{
			$row = $this->db->query("SELECT user_id FROM ".$this->prefix."_users WHERE username='".$fraza."' LIMIT 1")->fetch_array(MYSQLI_ASSOC);
			$query .= (!empty($row['user_id'])) ? "user_id=".$row['user_id']." OR " : '';
			$query .= "tytul LIKE '%".$fraza."%'";
		}
		$query .= ')';
		return $query;
	}
}

?>
