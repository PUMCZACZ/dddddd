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

//usuwanie pozycji
if (!empty($_GET['delete']) && intval($_GET['delete']))
{
	$db->query("DELETE FROM ".DB_PREFIX."_contents WHERE id=".intval($_GET['delete'])." LIMIT 1");
	$classMain->redirect(ADMIN_FILE.'.php?op=texti&info=Pozycja+została+usunięta.');
}

switch($op)
{
	case 'pages-upload-image':
		define(IMG_DIR, 'uploaded/pages');
		$imgName = $classMain->saveFile($_FILES['file'], uniqid(), IMG_DIR);
		echo json_encode(array('link' => IMG_DIR.'/'.$imgName));
		exit;
	break;
	default:
		//zapisywanie zmian i dodawanie nowej pozycji
		if ($_POST['save'])
		{
			if (is_array($_POST['c_id']))
			{
				foreach ($_POST['c_id'] as $key => $value)
				{
					$db->query("UPDATE ".DB_PREFIX."_contents SET
						show_header=".$classMain->formatSQL($_POST['show_header'][$value], 'int').",
						show_footer=".$classMain->formatSQL($_POST['show_footer'][$value], 'int').",
						position=".$classMain->formatSQL($_POST['position'][$value], 'int').",
						active=".$classMain->formatSQL($_POST['active'][$value], 'int')."
						WHERE id=".$value." LIMIT 1");
				}
			}
			if (empty($_POST['id']) && !empty($_POST['title_'.$classMain->defLang]))
			{
				$query = "INSERT INTO ".DB_PREFIX."_contents (
					title_".$classMain->defLang.",
					text_".$classMain->defLang.",
					meta_desc_".$classMain->defLang.",
					meta_keywords_".$classMain->defLang."
				) VALUES (
					'".$_POST['title_'.$classMain->defLang]."',
					'".htmlspecialchars($_POST['text_'.$classMain->defLang])."',
					'".$classMain->formatSQL($_POST['meta_desc'])."',
					'".$classMain->formatSQL($_POST['meta_keywords'])."'
				)";
				$db->query($query);
				$insertId = $db->lastInsertId();
				$classMain->saveLangsData($_POST, 'title', 'id', $insertId, 'contents');
				$classMain->saveLangsData($_POST, 'text', 'id', $insertId, 'contents');
				$classMain->redirect(ADMIN_FILE.'.php?op=pages&info=Pozycja+została+zapisana.');
			}
			else
			{
				$db->query("UPDATE ".DB_PREFIX."_contents SET
					meta_desc='".$classMain->formatSQL($_POST['meta_desc'])."',
					meta_keywords='".$classMain->formatSQL($_POST['meta_keywords'])."',
					show_header='".$classMain->formatSQL($_POST['show_header'], 'int')."',
					show_footer='".$classMain->formatSQL($_POST['show_footer'], 'int')."',
					WHERE id=".$classMain->formatSQL($_POST['id'], 'int')." LIMIT 1");
				$classMain->saveLangsData($_POST, 'title', 'id', intval($_POST['id']), 'contents');
				$classMain->saveLangsData($_POST, 'text', 'id', intval($_POST['id']), 'contents');
				$classMain->saveLangsData($_POST, 'meta_desc', 'id', intval($_POST['id']), 'contents');
				$classMain->saveLangsData($_POST, 'meta_keywords', 'id', intval($_POST['id']), 'contents');
				$classMain->redirect(ADMIN_FILE.'.php?op=pages&info=Zmiany+zostały+zapisane.');
			}
		}

		define('SITE_EDITOR', 1);

		$result = $db->query("SELECT * FROM ".DB_PREFIX."_contents ORDER BY position ASC");
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$row['title'] = $row['title_'.$classMain->defLang];
			$classMain->dataTPLarrayList('p', $row);
		}

		if (!empty($_GET['edit']) && intval($_GET['edit'])) $row = $db->query("SELECT * FROM ".DB_PREFIX."_contents WHERE id=".intval($_GET['edit'])." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

		$classMain->langsList('langs', array('title', 'text', 'meta_desc', 'meta_keywords'), $row);

		$classMain->dataTPLarray($row, false);

		$adminClass->OpenTableAdmin();
		$classMain->tpl('pages.tpl');
		$adminClass->CloseTableAdmin();
	break;
}
?>
