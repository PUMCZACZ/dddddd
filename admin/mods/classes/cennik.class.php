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

class cennik {

	public function __construct() {

		global $prefix, $db;

		$this->prefix = $prefix;
		$this->db = $db;
	}

	public function zapiszAbonament() {

		$subdomena_cena = (empty($_POST[n_subdomena_cena])) ? 0 : str_replace(',', '.', $_POST[n_subdomena_cena]);
		$pogrubienie = (empty($_POST[n_pogrubienie])) ? 0 : $_POST[n_pogrubienie];
		$podswietlenie = (empty($_POST[n_podswietlenie])) ? 0 : $_POST[n_podswietlenie];
		$wyroznienie = (empty($_POST[n_wyroznienie])) ? 0 : $_POST[n_wyroznienie];
		$strona_glowna = (empty($_POST[n_strona_glowna])) ? 0 : $_POST[n_strona_glowna];

		$this->db->query("INSERT INTO ".$this->prefix."_config_abonamenty VALUES (
																			NULL,
																			".$_POST[n_okres].",
																			".str_replace(',', '.', $_POST[n_cena]).",
																			".$pogrubienie.",
																			".$podswietlenie.",
																			".$wyroznienie.",
																			".$strona_glowna.",
																			'".$_POST[n_subdomena]."',
																			".$subdomena_cena."
		)");

		header('Location: admin.php?op=cennikAbonamenty&info=Nowa+pozycja+została+zapisana');
		exit;

	}

	public function zapiszZmianyAbonament() {

		//usuwanie
		for ($i=0; $i < count($_POST['usun']); $i++) {
			$this->db->query("DELETE FROM ".$this->prefix."_config_abonamenty WHERE id=".intval($_POST['usun'][$i]));
		}

		//zapisywanie zmian
		for ($i=0; $i < count($_POST['id']); $i++) {

			$cena = (empty($_POST[cena][$i])) ? 0 : str_replace(',', '.', $_POST[cena][$i]);
			$subdomena_cena = (empty($_POST[subdomena_cena][$i])) ? 0 : str_replace(',', '.', $_POST[subdomena_cena][$i]);
			$pogrubienie = (empty($_POST[pogrubienie][$i])) ? 0 : $_POST[pogrubienie][$i];
			$podswietlenie = (empty($_POST[podswietlenie][$i])) ? 0 : $_POST[podswietlenie][$i];
			$wyroznienie = (empty($_POST[wyroznienie][$i])) ? 0 : $_POST[wyroznienie][$i];
			$strona_glowna = (empty($_POST[strona_glowna][$i])) ? 0 : $_POST[strona_glowna][$i];

			$this->db->query("UPDATE ".$this->prefix."_config_abonamenty SET
																okres=".$_POST['okres'][$i].",
																cena=".$cena.",
																pogrubienie=".$pogrubienie.",
																podswietlenie=".$podswietlenie.",
																wyroznienie=".$wyroznienie.",
																strona_glowna=".$strona_glowna.",
																subdomena='".$_POST['subdomena'][$_POST['id'][$i]]."',
																subdomena_cena=".$subdomena_cena."
																WHERE id=".$_POST['id'][$i]
			);

		}

		header('Location: admin.php?op=cennikAbonamenty&info=Zmiany+zostały+zapisane');
		exit;

	}

	function zapiszCeny($dane, $typ) {

		//dodawanie pozycji
		if (isset($dane[dodaj_od]))
		{
			if (is_array($dane[dodaj_od]))
			{
				$this->dodajCene($dane[dodaj_od][0], $dane[dodaj_do][0], $dane[dodaj_wartosc][0], $dane[dodaj_system][0], $dane[rodzaj][0], $typ, 0, $extra);
				$this->dodajCene($dane[dodaj_od][1], $dane[dodaj_do][1], $dane[dodaj_wartosc][1], $dane[dodaj_system][1], $dane[rodzaj][1], $typ, 0, $extra);
			}
			else $this->dodajCene($dane[dodaj_od], $dane[dodaj_do], $dane[dodaj_wartosc], $dane[dodaj_system], $dane[rodzaj], $typ, $dane[kategoria], $extra);
		}

		//aktualizacja pozycji
		if (is_array($dane[id][0]))
		{
			for ($i=0; $i < count($dane[id]); $i++)
			{
				for ($no=0; $no < count($dane[id][$i]); $no++)
				{
					$this->zapiszZmianyCeny(
										$dane[od][$i][$no],
										$dane['do'][$i][$no],
										$dane[wartosc][$i][$no],
										$dane['system'][$i][$no],
										$dane[rodzaj][$i],
										$dane[id][$i][$no],
										$dane[kategoria],
										$dane['extra'][$i][$no]
					);
				}
			}
		}
		else
		{
			for ($no=0; $no < count($dane[id]); $no++)
			{
				$this->zapiszZmianyCeny(
									$dane[od][$no],
									$dane['do'][$no],
									$dane[wartosc][$no],
									$dane['system'][$no],
									$dane[rodzaj],
									$dane[id][$no],
									$dane[kategoria],
									$dane['extra'][$no]
				);
			}
		}

		//usuwanie pozycji
		if (is_array($dane['usun']))
		{
			sort($dane['usun']);
			for ($no=0; $no < count($dane['usun']); $no++)
			{
				if (is_array($dane['usun'][$no])) for ($a=0; $a < count($dane['usun'][$no]); $a++) $this->usunCene($dane['usun'][$no][$a]);
				else $this->usunCene($dane['usun'][$no]);
			}
		}

		$edytuj = (!empty($_GET[edytuj])) ? '&edytuj='.$_GET[edytuj] : '';
		$rodzaj = (!empty($_GET[rodzaj])) ? '&rodzaj='.$_GET[rodzaj] : '';
		$cat_id = (isset($_GET[cat_id])) ? '&cat_id='.$_GET[cat_id] : '';

		header("Location: admin.php?op=".$_GET[op].$edytuj.$rodzaj.$cat_id.'&info=Zmiany+zostały+zapisane');
		exit;

	}

	function zapiszZmianyCeny($cenaOd, $cenaDo, $wartosc, $system, $rodzaj, $id, $kategoria, $extra=false)
	{
		if (!empty($kategoria) && $kategoria != 0)
		{
			$kategoria = end($kategoria);
			$kategorie = $kategoria.','.listaBackKategorii($kategoria).','.listaIdKategorii($kategoria);
			$kategorie = '|'.str_replace(',', '|', $kategorie);
		}
		else
		{
			$kategoria = 0;
			$kategorie = 0;
		}

		$query = "UPDATE ".$this->prefix."_cennik SET
											od=".formatSQL($cenaOd, numeric).",
											do=".formatSQL($cenaDo, numeric).",
											wartosc=".formatSQL($wartosc, numeric).",
											rodzaj='".formatSQL($rodzaj)."',
											system='".formatSQL($system)."',
											cat_id='".$kategoria."',
											kategorie='".$kategorie."',
											extra='".$extra."'
											WHERE id=".formatSQL($id);

		$this->db->query($query);
	}

	function dodajCene($cenaOd, $cenaDo, $wartosc, $system, $rodzaj, $typ, $kategoria, $extra=false)
	{
		if (!empty($kategoria) && $kategoria != 0)
		{
			$kategoria = end($kategoria);
			$kategorie = $kategoria.','.listaBackKategorii($kategoria).','.listaIdKategorii($kategoria);
			$kategorie = '|'.str_replace(',', '|', $kategorie);
		}
		else
		{
			$kategoria = 0;
			$kategorie = 0;
		}

		$query = "INSERT INTO ".$this->prefix."_cennik VALUES (
															NULL,
															".formatSQL($cenaOd, numeric).",
															".formatSQL($cenaDo, numeric).",
															".formatSQL($wartosc, numeric).",
															'".formatSQL($rodzaj)."',
															'".formatSQL($system)."',
															'".formatSQL($typ)."',
															'".$kategoria."',
															'".$kategorie."',
															'".$extra."'
		)";

		$this->db->query($query);
	}

	function usunCene($id) {
		$this->db->query("DELETE FROM ".$this->prefix."_cennik WHERE id=".formatSQL($id));
	}

	public function listaOpcjiDodatkowych($nazwa)
	{
		global $template, $mainClass;

		$result = $this->db->query("SELECT id, wartosc, cat_id FROM ".$this->prefix."_cennik WHERE rodzaj='".$nazwa."' ORDER BY cat_id ASC");
		while ($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			$mainClass->dataTPLarrayList($nazwa, $row);

			$result2 = $this->db->query("SELECT * FROM ".$this->prefix."_opcje_wyboru WHERE nazwa='czas_wyswietlania' ORDER BY id ASC");
			while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) $mainClass->dataTPLarrayList($nazwa.'.czas', $row2);

		}

	}

	function zapiszOpcjeDodatkowe($dane) {

		for ($i=0; $i < count($_POST['id']); $i++) {
			$this->db->query("UPDATE ".$this->prefix."_cennik SET
																wartosc='".formatSQL($_POST['wartosc'][$_POST['id'][$i]], numeric)."',
																cat_id=".formatSQL($_POST['czas'][$_POST['id'][$i]], numeric)."
																WHERE id=".$_POST['id'][$i]);
		}

		switch($_POST['rodzaj']) {
			case 'pogrubienie':
				$pogrubienieOpis = formatSQL($dane[pogrubienie_opis]);

				$query = "UPDATE ".$this->prefix."_config SET pogrubienie_opis='".$pogrubienieOpis."'";
				$this->db->query($query);
			break;
			case 'podswietlenie':
				$podswietlenieOpis = formatSQL($dane[podswietlenie_opis]);

				$query = "UPDATE ".$this->prefix."_config SET podswietlenie_opis='".$podswietlenieOpis."'";
				$this->db->query($query);
			break;
			case 'wyroznienie':
				$wyroznienieOpis = formatSQL($dane[wyroznienie_opis]);

				$query = "UPDATE ".$this->prefix."_config SET wyroznienie_opis='".$wyroznienieOpis."'";
				$this->db->query($query);
			break;
			case 'strona_glowna':
				$strona_glownaOpis = formatSQL($dane[strona_glowna_opis]);

				$query = "UPDATE ".$this->prefix."_config SET strona_glowna_opis='".$strona_glownaOpis."'";
				$this->db->query($query);
			break;
		}

		//zapis nowej pozycji
		if (!empty($_POST['dodaj_cena']) && !empty($_POST['dodaj_czas'])) {
			$this->db->query("INSERT INTO ".$this->prefix."_cennik VALUES (
																		NULL,
																		0,
																		0,
																		".formatSQL($_POST['dodaj_cena'], numeric).",
																		'".$_POST['rodzaj']."',
																		'',
																		'inne',
																		'".formatSQL($_POST['dodaj_czas'], numeric)."',
																		'',
																		''
			)");
		}

		header("Location: admin.php?op=cennikOpcjeDodatkowe&info=Zmiany+zostały+zapisane.");
		exit;

	}

	public function zapiszUstawieniaOplat($nazwa, $wartosc) {

		$this->db->query("UPDATE ".$this->prefix."_config SET ".$nazwa."='".formatSQL($wartosc)."'");

	}

}

?>
