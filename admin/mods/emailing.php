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

if (!defined('ADMIN_FILE')) die ("Access Denied");

require_once 'admin/mods/classes/emailing.class.php';
$classEmailing = new emailing;

define('SITE_EDITOR', true);

switch($_GET['op']) {

	case 'emailing-themes':

		if ($_POST['add'])
		{
			$db->query("INSERT INTO ".DB_PREFIX."_emailing_themes VALUES (NULL, '".$classMain->formatSQL($_POST['name'])."', '".addslashes($_POST['content'])."')");
			$classMain->redirect(ADMIN_FILE.'.php?op='.$_GET['op'].'&info=Szablon+został+zapisany.');
		}

		if ($_POST['save'])
		{
			$db->query("UPDATE ".DB_PREFIX."_emailing_themes SET name='".$classMain->formatSQL($_POST['name'])."', content='".addslashes($_POST['content'])."' WHERE id=".$classMain->formatSQL($_POST['id'], 'int')." LIMIT 1");
			$classMain->redirect(ADMIN_FILE.'.php?op='.$_GET['op'].'&info=Szablon+został+zaktualizowany.');
		}

		if ($_GET['delete'])
		{
			$db->query("DELETE FROM ".DB_PREFIX."_emailing_themes WHERE id=".$classMain->formatSQL($_GET['delete'], 'int')." LIMIT 1");
			$classMain->redirect(ADMIN_FILE.'.php?op='.$_GET['op'].'&info=Szablon+został+usunięty.');
		}

		if ($_GET['edit'])
		{
			$row = $db->query("SELECT * FROM ".DB_PREFIX."_emailing_themes WHERE id=".$classMain->formatSQL($_GET['edit'], 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);
			$row->edit = true;
			$classMain->dataTPLarray($row);
		}

		$result = $db->query("SELECT * FROM ".DB_PREFIX."_emailing_themes ORDER BY name ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$classMain->dataTPLarrayList('et', $row);
		}
	break;

	case 'emailing':

		if ($_POST['save-file']) $classEmailing->saveToFile();

		if ($_POST['send'])
		{
			$classEmailing->saveEmailing();
			$classMain->redirect(ADMIN_FILE.'.php?op=emailing&info=Mailing+został+przekazany+do+wysyłki');
		}

		$classMain->langsList();
		$classEmailing->memberList();

		if ($_GET['theme'])
		{
			$row = $db->query("SELECT * FROM ".DB_PREFIX."_emailing_themes WHERE id=".$classMain->formatSQL($_GET['theme'], 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);
			if ($row->content) $_POST['message'] = $row->content;
		}

		$dataTPL = array(
					'MESSAGE' => (isset($_POST['message'])) ? $_POST['message'] : false,
		);

	break;

	case 'emailing-planning':
	case 'emailing-sended':

		if (isset($_POST['delete']))
		{
			$classEmailing->delete($_POST['id']);
			$classMain->redirect(ADMIN_FILE.'.php?op='.$_GET['op'].'&info=Mailingi+zostały+usunięte');
		}

		$sendTime = ($_GET['op'] == 'emailing-sended') ? '>0' : '=0';

		$result = $db->query("SELECT * FROM ".DB_PREFIX."_emailing WHERE send_time_unix".$sendTime." ORDER BY send_time_unix ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->send_time = str_replace('T', ' ', $row->send_time);
			$row->date = date('d-m-Y H:i', $row->date);
			$classMain->dataTPLarrayList('e', $row);
		}
	break;

	case 'emailing-edit':
		if ($_POST['save'])
		{
			$classEmailing->saveChanges($_POST);
			$classMain->redirect(ADMIN_FILE.'.php?op=emailing-edit&id='.$_POST['id'].'&info=Zmiany+zostały+zapisane.');
		}
		$classMain->langsList();
		$classEmailing->memberList();
		$classEmailing->dataTPL($_GET['id']);
	break;

	case 'emailing_obcy':

		if (isset($_POST['reklama']) && $_POST['reklama'] == 1) {

			$tytul = $_POST['tytul'];
			$wiadomosc = stripslashes($_POST['wiadomosc']);

			switch($_POST['odbiorca']) {
				case 'szablon':
					$db->query("INSERT INTO ".$prefix."_emailing_reklama VALUES (NULL, '".$tytul."', '".$wiadomosc."')");
					$_GET['info'] = 'Wiadomość została zapisana jako szablon.';
				break;

				case 'oferta':

					$db->query("INSERT INTO ".$prefix."_emailing_reklama VALUES (NULL, '".$tytul."', '".$wiadomosc."')");

					$adresy = array();
					$result = $db->query("SELECT * FROM ".$prefix."_emailing WHERE reklama_wyslana='n'");
					while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
						//zapis wysyłki reklamy
						$db->query("UPDATE ".$prefix."_emailing SET reklama_wyslana='y' WHERE id=".$row['id']);

						//zapis adresu do tablicy
						$adresy[] = $row['email'];
					}

					//wysyłanie wiadomości
					$emailer = new email_class();
					$emailer->assign_vars(array(
											'WIADOMOSC' => $wiadomosc,
					));

					$emailer->email_sender($adresy, 'email_emailing_oferta.php', $tytul);

				break;

				case 'all':

					$adresy = array();
					$result = $db->query("SELECT * FROM ".$prefix."_emailing");
					while ($row = $result->fetch_array(MYSQLI_ASSOC)) {

						//zapis wysyłki reklamy
						$db->query("UPDATE ".$prefix."_emailing SET reklama_wyslana='y' WHERE id=".$row['id']);

						//zapis adresu do tablicy
						$adresy[] = $row['email'];
					}

					//wysyłanie wiadomości
					$emailer = new email_class();
					$emailer->assign_vars(array(
											'WIADOMOSC' => $wiadomosc,
					));

					$emailer->email_sender($adresy, 'email_emailing_oferta.php', $tytul);

				break;
			}

		}

	break;

	case 'emailing_oferta':

		if (isset($_POST['zapytanie_ofertowe']) && $_POST['zapytanie_ofertowe'] == 1) {

			$listaAdresow = explode("\r\n", $_POST['lista_adresow']);
			$iloscWejsciowa = count($listaAdresow);

			if (isset($_POST['filtr']) && $_POST['filtr'] == 1) {

				//usuwanie powielonych adresów
				$listaAdresow = array_unique($listaAdresow);

				$filtrowanaListaAdresow = $listaAdresow;

				for ($i=0; $i < count($listaAdresow); $i++) {

					//filtrowanie dla adresow w bazie danych i poprawnej budowy adresu
					$row = $db->query("SELECT * FROM ".$prefix."_emailing WHERE email='".$listaAdresow[$i]."' LIMIT 1")->fetch_array(MYSQLI_ASSOC);
					if (!empty($row['id']) || !filter_var($listaAdresow[$i], FILTER_VALIDATE_EMAIL) || empty($listaAdresow[$i])) unset($filtrowanaListaAdresow[$i]);

				}

				sort($filtrowanaListaAdresow);

				$iloscWyjsciowa = count($filtrowanaListaAdresow);
				$iloscUsunietychAdresow = $iloscWejsciowa-$iloscWyjsciowa;
			}

			$filtrowanaListaAdresow = (is_array($filtrowanaListaAdresow)) ? $filtrowanaListaAdresow : $listaAdresow;

			//ilość wysłanych wiadomości
			$iloscAdresow = (isset($iloscUsunietychAdresow)) ? $iloscWyjsciowa : $iloscWejsciowa;

			//formatowanie informacji
			$tytul = $_POST['tytul'];
			$wiadomosc = stripslashes($_POST['wiadomosc']);

			$opcja = ($_POST['opcja'] == 1) ? 0 : $_POST['szablon'];

			for ($i=0; $i < count($filtrowanaListaAdresow); $i++) {

				$db->query("INSERT INTO ".$prefix."_emailing VALUES (NULL, '".$filtrowanaListaAdresow[$i]."', ".$opcja.", 'n', 'n')");
				$idWpisu = $db->insert_id;

				//budowanie linku
				$link = $mainConfig['siteurl'].'/funcs.php?name=emailing&amp;id='.$idWpisu;

				$link = '<a href="'.$link.'">'.$link.'</a>';

				//podmiana linku w treści wiadomości
				$formatowanaWiadomosc = false;
				$formatowanaWiadomosc = str_replace('{LINK}', $link, $wiadomosc);

				//wysyłanie wiadomości
				$emailer = new email_class();
				$emailer->assign_vars(array(
										'WIADOMOSC' => $formatowanaWiadomosc,
				));

				$emailer->email_sender($filtrowanaListaAdresow[$i], 'email_emailing_oferta.php', $tytul);
			}

			$_GET['info'] = (isset($iloscUsunietychAdresow)) ? 'Ilość usuniętych adresów przez filtr: <strong>'.$iloscUsunietychAdresow.'</strong><br />' : '';
			$_GET['info'] = 'Ilość wysłanych wiadomości: <strong>'.$iloscAdresow.'</strong><br />';
			$_GET['info'] .= 'Wiadomości z zapytaniem o przesłanie oferty zostały wysłane.';

		}

		//lista szablonów
		$result = $db->query("SELECT * FROM ".$prefix."_emailing_reklama");
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$template->assign_block_vars('szablony', array(
														'ID' => $row['id'],
														'TEMAT' => $row['temat']
			));
		}

		$dataTPL = array(
					//zmienne
					'LINK' => '{LINK}',

					'LISTA_ADRESOW' => $_POST['lista_adresow'],
					'TYTUL' => (isset($_POST['tytul'])) ? $_POST['tytul'] : '',
					'WIADOMOSC' => (isset($_POST['wiadomosc'])) ? $_POST['wiadomosc'] : '',
		);


	break;

	case 'emailing_adresy':

		if (isset($_POST['zapisz']) && $_POST['zapisz'] == 1) {

			for ($i=0; $i < count($_POST['id']); $i++) {
				$db->query("UPDATE ".$prefix."_emailing SET
														potwierdzenie='".$_POST['potwierdzenie'][$_POST['id'][$i]]."',
														reklama_wyslana='".$_POST['reklama_wyslana'][$_POST['id'][$i]]."'
														WHERE id=".$_POST['id'][$i]);
			}

			for ($i=0; $i < count($_POST['usun']); $i++) {
				$db->query("DELETE FROM ".$prefix."_emailing WHERE id=".$_POST['usun'][$i]);
			}

			$_GET['info'] = 'Zmiany zostały zapisane';
		}

		$result = $db->query("SELECT * FROM ".$prefix."_emailing ORDER BY id ASC");
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
			$template->assign_block_vars('adresy', array(
												'ID' => $row['id'],
												'EMAIL' => $row['email'],

												'POTWIERDZENIE_N' => ($row['potwierdzenie'] == 'n') ? ' checked' : false,
												'POTWIERDZENIE_Y' => ($row['potwierdzenie'] == 'y') ? ' checked' : false,

												'REKLAMA_WYSLANA_N' => ($row['reklama_wyslana'] == 'n') ? ' checked' : false,
												'REKLAMA_WYSLANA_Y' => ($row['reklama_wyslana'] == 'y') ? ' checked' : false,
			));
		}

	break;
}

$dataTPL['op'] = $op;
$classMain->dataTPLarray($dataTPL);
$adminClass->OpenTableAdmin();
$classMain->tpl('emailing.tpl');
$adminClass->CloseTableAdmin();
?>
