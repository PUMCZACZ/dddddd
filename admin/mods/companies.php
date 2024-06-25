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

session_start();

require 'admin/mods/classes/firmy.class.php';
$firmyClass = new firmy;

switch($op)
{
	case 'firm':

		//usuwanie firm
		if (is_array($_POST['usun']))
		{
			$firmyClass->usunFirmy();
			$mainClass->redirect($admin_file.'.php?op=firm&info=Firmy+zostały+usunięte.');
		}

		//dezaktywacja firmy
		if (intval($_GET['deaktywuj']))
		{
			$firmyClass->deaktywujFirme();
			$mainClass->redirect($admin_file.'.php?op=firm');
		}

		$i=1;
		$result = $db->query("SELECT * FROM ".$prefix."_firmy ORDER BY id DESC");
		while ($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			$row['i'] = $i;
			$mainClass->dataTPLarrayList('f', $row);
			$i++;
		}

		$template->assign_vars(array(
								'OP' => $op
		));

		$adminClass->OpenTableAdmin();
		$template->set_filenames(array(
					'body' => 'firmy.tpl'
				));
		$template->display('body');
		$adminClass->CloseTableAdmin();

	break;

	case "firm-edit":

		//zapisywanie zmian
		if ($_POST['zapisz'])
		{
			require 'funcs/firmy/firmy.class.php';
			$zapiszZmiany = new firma();

			if ($_FILES['logo']['name']) $logo = $zapiszZmiany->zapiszLogo($_FILES['logo']);

			$zapiszZmiany->updateFirmy($_POST, $logo);

			$ERROR = 'Wizytówka została zaktualizowana!';
		}

		//usuwanie loga
		if ($_GET['usun_zdjecie'])
		{
			$firmyClass->usunZdjecie();
			$mainClass->redirect($admin_file.'.php?op=firm-edit&id='.intval($_GET['id']).'#logo');
		}

		$firma = $db->query("SELECT * FROM ".$prefix."_firmy WHERE id='".intval($_GET['id'])."'")->fetch_array(MYSQLI_ASSOC);

		//lista kategorii
		$kategorie = explode("|", $firma['kategorie']);
		$TPL_lista_kategorii = '';
		$i = 1;
		$result = $db->query("SELECT * FROM ".$prefix."_firmy_kategorie WHERE poziom='1' ORDER BY pozycja ASC");
		while ($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			$TPL_lista_kategorii .= '<div class="kategoria_glowna">'.$row['nazwa'].'</div>';

			$no = 1;
			$result2 = $db->query("SELECT * FROM ".$prefix."_firmy_kategorie WHERE lewa_id='".$row['id']."' ORDER BY pozycja ASC");
			while ($row2 = $result2->fetch_array(MYSQLI_ASSOC))
			{
				$checked = ($kategorie[$i] == $row2['id']) ? ' checked' : '';

				if ($kategorie[$i] == $row2['id']) $i++;

				$TPL_lista_kategorii .= '<div class="kategoria">';
				$TPL_lista_kategorii .= '<label for="'.$row2['id'].'">';
				$TPL_lista_kategorii .= '<input type="checkbox" name="kategorie[]" value="'.$row2['id'].'" id="'.$row2['id'].'"'.$checked.' />'.$row2['nazwa'];
				$TPL_lista_kategorii .= '</label>';
				$TPL_lista_kategorii .= '</div>';

				if ($no == 3)
				{
    			$TPL_lista_kategorii .= '<div id="clear"></div>';
    			$no = 0;
	  		}
				$no++;
			}
			$TPL_lista_kategorii .= '<div id="clear"></div>';
		}

		//lista województw
		$mainClass->lista_opcji('region', $firma['wojewodztwo']);

		$logo = 'uploaded_firmy/mini_'.$firma['logo'];
		$logo = (file_exists($logo)) ? $logo : false;

		$template->assign_vars(array(
							'ID' => $firma['id'],
							'NAZWA_FIRMY' => $firma['nazwa_firmy'],
							'KATEGORIE_FIRM' => $TPL_lista_kategorii,
							'TELEFON' => $firma['telefon'],
							'TELEFON_DODATKOWY' => $firma['telefon_2'],
							'FAX' => $firma['fax'],
							'EMAIL_FIRMA' => $firma['email_firmowy'],
							'WWW' => $firma['strona_www'],
							'ULICA' => $firma['ulica'],
							'BUDYNEK' => $firma['budynek'],
							'LOKAL' => $firma['lokal'],
							'MIASTO' => $firma['miasto'],
							'KOD_POCZTOWY' => $firma['kod_pocztowy'],
							'OPIS_FIRMY' => $firma['opis_firmy'],
							'ZDJECIE' => $logo,
							'LOGO' => ($firma['logo']) ? $firma['logo'] : '',
		));

		$adminClass->OpenTableAdmin();
		$template->set_filenames(array(
					'body' => 'firm-edit.tpl'
				));
		$template->display('body');
		$adminClass->CloseTableAdmin();

	break;

	case 'firm-cats':

		if ($_POST['zapisz'])
		{
			$firmyClass->zapiszKategorie();

			$in = (!empty($_GET['cat_id'])) ? '&cat_id='.$_GET['cat_id'] : '';
			$in .= (!empty($_GET['poziom'])) ? '&poziom='.$_GET['poziom'] : '';

			$mainClass->redirect($admin_file.'.php?op=firm-cats'.$in.'&info=Zmiany+zostały+zapisane');
		}

		//pobieranie kategorii wyżej
		$catInfo = $db->query("SELECT * FROM ".$prefix."_firmy_kategorie WHERE id=".intval(formatSQL($_GET['cat_id']))." LIMIT 1")->fetch_array(MYSQLI_ASSOC);
		if ($catInfo) $catUpData = $db->query("SELECT * FROM ".$prefix."_firmy_kategorie WHERE id=".$catInfo['lewa_id']." LIMIT 1")->fetch_array(MYSQLI_ASSOC);

		$catInfo['poziom'] = ($catInfo) ? $catInfo['poziom'] : 1;
		$cat_id_DB = ($catInfo['id']) ? " AND lewa_id=".$catInfo['id'] : false;

		$catInfo['poziom1'] = $catInfo['poziom'];
		$mainClass->dataTPLarray($catInfo);
		$result = $db->query("SELECT * FROM ".$prefix."_firmy_kategorie WHERE poziom=".$catInfo['poziom']."".$cat_id_DB." ORDER BY pozycja ASC");
		while ($row = $result->fetch_array(MYSQLI_ASSOC))
		{
			//sprawdzanie czy są podkategorie
			$podkategorie = $db->query("SELECT * FROM ".$prefix."_firmy_kategorie WHERE lewa_id=".$row['id'])->num_rows;
			$disabled = ($podkategorie) ? true : false;

			$mainClass->dataTPLarrayList('fc', $row);
		}

		$template->assign_vars(array(
								'OP' => $op
		));

		$adminClass->OpenTableAdmin();
		$template->set_filenames(array(
					'body' => 'firmy.tpl'
				));
		$template->display('body');
		$adminClass->CloseTableAdmin();

	break;
}
?>
