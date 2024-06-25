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

class firmy {

	public function __construct() {

		global $prefix, $db;

		$this->prefix = $prefix;
		$this->db = $db;
	}


	public function usunFirmy()
	{
		for ($i=0; $i < count($_POST['usun']); $i++)
		{
			$row = $this->db->query("SELECT logo, user_id, id FROM ".$this->prefix."_firmy WHERE id=".intval(formatSQL($_POST['usun'][$i]))." LIMIT 1")->fetch_array(MYSQLI_ASSOC);

			if (!empty($row['logo']))
			{
				$mini = glob("uploaded_firmy/mini_".$row['logo']."*");
				$logo = glob("uploaded_firmy/logo_".$row['logo']."*");
				if (file_exists($mini[0])) unlink($mini[0]);
				if (file_exists($logo[0])) unlink($logo[0]);
			}
			$this->db->query("UPDATE ".$this->prefix."_users SET wizytowka='n' WHERE user_id=".$row['user_id']." LIMIT 1");
			$this->db->query("DELETE FROM ".$this->prefix."_firmy WHERE id=".$row['id']." LIMIT 1");
		}
	}

	public function deaktywujFirme() {

		if (intval($_GET['deaktywuj']) == 1) {
			$this->db->query("UPDATE ".$this->prefix."_firmy SET aktywna=0 WHERE id='".intval($_GET['id'])."'");
		} elseif (intval($_GET['deaktywuj']) == 2) {
			$this->db->query("UPDATE ".$this->prefix."_firmy SET aktywna=1 WHERE id='".intval($_GET['id'])."'");
		}

	}

	public function usunZdjecie() {

		$row = @mysql_fetch_array($this->db->query("SELECT logo FROM ".$this->prefix."_firmy WHERE id='".intval($_GET['id'])."'"));

		$this->db->query("UPDATE ".$this->prefix."_firmy SET logo='' WHERE id='".intval($_GET['id'])."'");

		if (!empty($row['logo'])) {
			$zdjecie_logo = glob('uploaded_firmy/logo_'.$row['logo'].'.*');
			$zdjecie_mini = glob('uploaded_firmy/mini_'.$row['logo'].'.*');
			if (file_exists($zdjecie_logo[0])) unlink($zdjecie_logo[0]);
			if (file_exists($zdjecie_mini[0])) unlink($zdjecie_mini[0]);
		}
	}

	public function zapiszKategorie() {

		$_GET['poziom'] = (empty($_GET['poziom'])) ? 1 : $_GET['poziom'];
		$_GET['cat_id'] = (empty($_GET['cat_id'])) ? 0 : $_GET['cat_id'];

		//dodawanie pojedynczej kategorii
		if ($_POST['nowa_kategoria']) {

			//pobieranie ostatniego numeru pozycji
			$max_pozycja = @mysql_fetch_array($this->db->query("SELECT MAX(pozycja) FROM ".$this->prefix."_firmy_kategorie WHERE poziom=".$_GET['poziom']." AND lewa_id=".$_GET['cat_id']));

			$poziom = ($_POST['poziom']) ? $_POST['poziom'] : 1;
			$_POST['lewa_id'] = (empty($_POST['lewa_id'])) ? 0 : $_POST['lewa_id'];

			$this->db->query("INSERT INTO ".$this->prefix."_firmy_kategorie VALUES (
																		NULL,
																		'".$_POST['nowa_kategoria']."',
																		'".$_POST['lewa_id']."',
																		'".$poziom."',
																		'".($max_pozycja['MAX(pozycja)']+1)."',
																		'n',
																		''
			)");
		}

		//dodawanie wielu kategorii
		if ($_POST['kategorie']) {

			$kategorie = explode("\r\n", $_POST['kategorie']);

			for ($i=0; $i<count($kategorie); $i++) {

				$_POST['lewa_id'] = (empty($_POST['lewa_id'])) ? 0 : $_POST['lewa_id'];

				//pobieranie ostatniego numeru pozycji
				$max_pozycja = @mysql_fetch_array($this->db->query("SELECT MAX(pozycja) FROM ".$this->prefix."_firmy_kategorie WHERE poziom='".$_GET['poziom']."' AND lewa_id='".$_GET['cat_id']."'"));

				$this->db->query("INSERT INTO ".$this->prefix."_firmy_kategorie VALUES (
																			NULL,
																			'".$kategorie[$i]."',
																			'".$_POST['lewa_id']."',
																			'".$_POST['poziom']."',
																			'".($max_pozycja['MAX(pozycja)']+1)."',
																			'n',
																			''
				)");;

			}
		}

		//zapisywanie zmin w kategoriach
		for ($i=0; $i < count($_POST['kategoria']); $i++) {
			$this->db->query("UPDATE ".$this->prefix."_firmy_kategorie SET nazwa='".$_POST['kategoria'][$i]."', pozycja='".$_POST['pozycja'][$i]."' WHERE id='".$_POST['id'][$i]."'");
		}

		//usuwanie kategorii
		for ($i=0; $i < count($_POST['usun']); $i++) {
			$this->db->query("DELETE FROM ".$this->prefix."_firmy_kategorie WHERE id='".$_POST['usun'][$i]."'");
		}
	}

}

?>
