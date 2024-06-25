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

class transakcje {

	public function __construct() {

		global $prefix, $db;

		$this->prefix = $prefix;
		$this->db = $db;
	}

	function zapiszWiadomosc() {

		global $mainConfig, $emailer, $mainClass;

		$this->db->query("INSERT INTO ".$this->prefix."_users_spory VALUES (
																NULL,
																".$_POST['spor_id'].",
																".$_POST['aukcja_id'].",
																0,
																0,
																'".htmlspecialchars($_POST['tekst'])."',
																".time().",
																'".$_POST['aktywny']."'
		)");

		//kończenie sporu i wysyłanie wiadomości
		if ($_POST['aktywny'] == 'n') {

			$this->db->query("UPDATE ".$this->prefix."_users_spory SET aktywny='n' WHERE spor_id=".$_POST['spor_id']);

			//dane aukcji
			$aukcjaDane = $this->db->query("SELECT id, tytul FROM ".$this->prefix."_przedmioty WHERE id=".$_POST['aukcja_id'])->fetch_array(MYSQLI_ASSOC);

			//id użytkowników
			$odbiorcaDane = $this->db->query("SELECT nadawca, odbiorca FROM ".$this->prefix."_users_spory WHERE spor_id=".$_POST['spor_id']." AND nadawca!=0")->fetch_array(MYSQLI_ASSOC);

			$emailNadawca = $this->db->query("SELECT adres_email FROM ".$this->prefix."_users WHERE user_id=".$odbiorcaDane['nadawca']." LIMIT 1")->fetch_array(MYSQLI_ASSOC);
			$emailOdbiorca = $this->db->query("SELECT adres_email FROM ".$this->prefix."_users WHERE user_id=".$odbiorcaDane['odbiorca']." LIMIT 1")->fetch_array(MYSQLI_ASSOC);

			$emailer->assign_vars(array(
									'SITEURL' => $mainConfig['siteurl'],
									'LOGO' => $mainConfig['siteurl'].'/theme/images/logo.png',
									'SITENAME' => $mainConfig['sitename'],
	
									//dane ogłoszenia
									'ID' => $aukcjaDane['id'],
									'TYTUL' => $aukcjaDane['tytul'],
									'TRESC' => htmlspecialchars($_POST['tekst']),
									'LINK_WYSLIJ_ODPOWIEDZ' => $mainConfig['siteurl'].'/funcs.php?name=konto&amp;file=spory&amp;op=lista&amp;auk_id='.$aukcjaDane['id'].'&amp;strona='.$odbiorcaDane['nadawca']
			));

			$subject = $mainConfig['sitename'].': Zakończenie sporu odnośnie aukcji: '.$aukcjaDane['tytul'];
			$emailer->email_sender($emailNadawca['adres_email'], 'email_spor_zakonczenie.php', $subject);

			$emailer->assign_vars(array(
									'SITEURL' => $mainConfig['siteurl'],
									'LOGO' => $mainConfig['siteurl'].'/theme/images/logo.png',
									'SITENAME' => $mainConfig['sitename'],
	
									//dane ogłoszenia
									'ID' => $aukcjaDane['id'],
									'TYTUL' => $aukcjaDane['tytul'],
									'TRESC' => htmlspecialchars($_POST['tekst']),
									'LINK_WYSLIJ_ODPOWIEDZ' => $mainConfig['siteurl'].'/funcs.php?name=konto&amp;file=spory&amp;op=lista&amp;auk_id='.$aukcjaDane['id'].'&amp;strona='.$odbiorcaDane['odbiorca']
			));

			$subject = $mainConfig['sitename'].': Zakończenie sporu odnośnie aukcji: '.$aukcjaDane['tytul'];
			$emailer->email_sender($emailOdbiorca['adres_email'], 'email_spor_zakonczenie.php', $subject);
			

		//wysyłanie wiadomości
		} else {

			//dane aukcji
			$aukcjaDane = $this->db->query("SELECT id, tytul FROM ".$this->prefix."_przedmioty WHERE id=".$_POST['aukcja_id'])->fetch_array(MYSQLI_ASSOC);

			//id użytkowników
			$odbiorcaDane = $this->db->query("SELECT nadawca, odbiorca FROM ".$this->prefix."_users_spory WHERE spor_id=".$_POST['spor_id']." AND nadawca!=0")->fetch_array(MYSQLI_ASSOC);

			$emailNadawca = $this->db->query("SELECT adres_email FROM ".$this->prefix."_users WHERE user_id=".$odbiorcaDane['nadawca']." LIMIT 1")->fetch_array(MYSQLI_ASSOC);
			$emailOdbiorca = $this->db->query("SELECT adres_email FROM ".$this->prefix."_users WHERE user_id=".$odbiorcaDane['odbiorca']." LIMIT 1")->fetch_array(MYSQLI_ASSOC);

			$emailer->assign_vars(array(
									'SITEURL' => $mainConfig['siteurl'],
									'LOGO' => $mainConfig['siteurl'].'/theme/images/logo.png',
									'SITENAME' => $mainConfig['sitename'],
	
									//dane ogłoszenia
									'ID' => $aukcjaDane['id'],
									'TYTUL' => $aukcjaDane['tytul'],
									'TRESC' => htmlspecialchars($_POST['tekst']),
									'LINK_WYSLIJ_ODPOWIEDZ' => $mainConfig['siteurl'].'/funcs.php?name=konto&amp;file=spory&amp;op=lista&amp;auk_id='.$aukcjaDane['id'].'&amp;strona='.$odbiorcaDane['nadawca']
			));

			$subject = $mainConfig['sitename'].': Spór odnośnie aukcji: '.$aukcjaDane['tytul'];
			$emailer->email_sender($emailNadawca['adres_email'], 'email_spor.php', $subject);

			$emailer->assign_vars(array(
									'SITEURL' => $mainConfig['siteurl'],
									'LOGO' => $mainConfig['siteurl'].'/theme/images/logo.png',
									'SITENAME' => $mainConfig['sitename'],
	
									//dane ogłoszenia
									'ID' => $aukcjaDane['id'],
									'TYTUL' => $aukcjaDane['tytul'],
									'TRESC' => htmlspecialchars($_POST['tekst']),
									'LINK_WYSLIJ_ODPOWIEDZ' => $mainConfig['siteurl'].'/funcs.php?name=konto&amp;file=spory&amp;op=lista&amp;auk_id='.$aukcjaDane['id'].'&amp;strona='.$odbiorcaDane['odbiorca']
			));

			$subject = $mainConfig['sitename'].': Spór odnośnie aukcji: '.$aukcjaDane['tytul'];
			$emailer->email_sender($emailOdbiorca['adres_email'], 'email_spor.php', $subject);

		}

		header("Location: admin.php?op=transakcje_spory&zobacz=".$_POST['spor_id']."&info=Wiadomość+została+zapisana");
		exit;

	}

}

?>