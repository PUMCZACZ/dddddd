<?php

/****************************************************************/
/*	UWAGA! SKRYPT NIE JEST DARMOWY.								*/
/*	DALSZE ROZPOWSZECHNIANIE BEZ ZGODY 							*/
/*	FIRMY JMLNET JEST ZABRONIONE.								*/
/****************************************************************/
/****************************************************************/
/*	PRODUCENT OPROGRAMOWANIA	JMLnet							*/
/*	name SKRYPTU:				SKRYPT AUKCYJNY	PRO				*/
/*	WERSJA:						1.31							*/
/*	KONTAKT:					INFO@JMLNET.PL					*/
/****************************************************************/
/* Copyright (c) JMLnet. Wszelkie prawa zastrzeone.				*/
/****************************************************************/

if (!defined('ADMIN_FILE')) die ("Access Denied");

$langMain = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE def=1 LIMIT 1")->fetch(PDO::FETCH_OBJ);

$blockCats = array();

$getOP = $classMain->formatSQL($_GET['op']);
$DBtable = ($getOP == 'cats-profiles') ? '_cats_profiles' : '_cats';

//zapisywanie zdjecia
function save_zdjecie($zdjecie) {

	require_once("includes/class.upload.php");

	$handle = new Upload($zdjecie);

	if ($handle->uploaded) {
		if (($handle->file_src_mime == 'image/jpeg') or
			($handle->file_src_mime == 'image/jpg') or
			($handle->file_src_mime == 'image/gif') or
			($handle->file_src_mime == 'image/png')) {

			$name_zdjecia = uniqid();

			//ustalanie podstawy nazw zdjcęcia
			$nameZdjecia = $name_zdjecia.'.'.$handle->image_src_type;

			$handle->file_src_name_body	= $name_zdjecia;
			$handle->Process('img/cats/');
			$handle->processed;

			return $nameZdjecia;
		}
	}
}

function genIPlist($id)
{
	global $db, $DBtable;

	$row = $db->query("SELECT * FROM ".DB_PREFIX.$DBtable." WHERE id=".intval($id)." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

	switch($row['level'])
	{
		case 1:
			return $id;
		break;
		default:
			$rowLeft = $db->query("SELECT * FROM ".DB_PREFIX.$DBtable." WHERE id=".intval($row['left_id'])." LIMIT 1")->fetch(PDO::FETCH_ASSOC);
			return $rowLeft['ip'].'.'.$row['id'];
		break;
	}
}

switch ($_GET['op'])
{
	default:

		//usuwanie ikony kategorii
		if (!empty($_GET['delete_icon']) && intval($_GET['delete_icon']))
		{
			$row = $db->query("SELECT pic FROM ".DB_PREFIX.$DBtable." WHERE id=".intval($_GET['delete_icon'])." LIMIT 1")->fetch(PDO::FETCH_ASSOC);
			if (file_exists("img/cats/".$row['pic']) && $row['pic']) unlink("img/cats/".$row['pic']);
			$db->query("UPDATE ".DB_PREFIX.$DBtable." SET pic='' WHERE id=".intval($_GET['delete_icon'])." LIMIT 1");

			$classMain->redirect(ADMIN_FILE.'.php?op=cats&info=Zmiany+zostały+zapisane');
		}

		if (isset($_POST['save']))
		{
			//dodawanie pojedynczej kategorii
			if (isset($_POST['new_name']) && !empty($_POST['new_name']))
			{
				//level kategorii
				$level = intval($_POST['level']);
				$level = ($level > 0) ? $level : 1;

				//pobieranie ostatniego numeru pozycji
				$max_position = $db->query("SELECT MAX(position) AS max FROM ".DB_PREFIX.$DBtable." WHERE level=".$level." AND left_id=".intval($classMain->formatSQL($_GET['cat_id']))." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

				//tabela kategorii
				$query = "INSERT INTO ".DB_PREFIX.$DBtable." (id, name_".$langMain->name_def.", left_id, ip, level, last, position, pic, counter, wrng) VALUES (
																NULL,
																'".$classMain->formatSQL($_POST['new_name'])."',
																".intval($_POST['left_id']).",
																'',
																'".$level."',
																1,
																".intval($max_position['max']+1).",
																'".$picName."',
																0,
																0
				)";
				$db->query($query);
				$insertID = $db->insert_id;

				//aktualizacja ostatniej kategorii
				$db->query("UPDATE ".DB_PREFIX.$DBtable." SET ip='".genIPlist($insertID)."' WHERE id=".$insertID." LIMIT 1");

				//aktualizacja ostatniej kategorii
				$db->query("UPDATE ".DB_PREFIX.$DBtable." SET last=0 WHERE id=".intval($_POST['left_id']));
			}

			//dodawanie wielu kategorii
			if (isset($_POST['cats']))
			{
				$cats = explode("\r\n", $_POST['cats']);

				$level = intval($_POST['level']);
				$level = ($level > 0) ? $level : 1;
				$cat_id = intval($_GET['cat_id']);
				$cat_id = ($cat_id > 0) ? $cat_id : 1;
				$left_id = intval($_POST['left_id']);

				for ($i=0; $i < count($cats); $i++)
				{
					if (!empty($cats[$i]))
					{
						//pobieranie ostatniego numeru pozycji
						$max_position = $db->query("SELECT MAX(position) FROM ".DB_PREFIX.$DBtable." WHERE level=".$level." AND left_id=".$left_id." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

						//tabela kategorii
						$query = "INSERT INTO ".DB_PREFIX.$DBtable." (id, name_".$langMain->name_def.", left_id, ip, level, last, position, pic, counter, wrng) VALUES (
																		NULL,
																		'".$classMain->formatSQL($cats[$i])."',
																		".$left_id.",
																		'',
																		'".$level."',
																		1,
																		'".intval(($max_position['MAX(position)']+1))."',
																		'',
																		0,
																		0
						)";
						$db->query($query);
						$insertID = $db->insert_id;

						//aktualizacja ostatniej kategorii
						$db->query("UPDATE ".DB_PREFIX.$DBtable." SET ip='".genIPlist($insertID)."' WHERE id=".$insertID." LIMIT 1");
					}
				}
			}

			//zapisywanie zmian w namech
			if (is_array($_POST['id']))
			{
				for ($i=0; $i < count($_POST['id']); $i++)
				{
					//ikona kategorii
					$pic = array(
								'name' => $_FILES['pic']['name'][$_POST['id'][$i]],
								'type' => $_FILES['pic']['type'][$_POST['id'][$i]],
								'tmp_name' => $_FILES['pic']['tmp_name'][$_POST['id'][$i]],
								'error' => $_FILES['pic']['error'][$_POST['id'][$i]],
								'size' => $_FILES['pic']['size'][$_POST['id'][$i]]
					);

					$picName = (!empty($pic['name'])) ? save_zdjecie($pic) : '';
					$picSave = (!empty($picName)) ? ", pic='".$picName."'" : '';

					$id = intval($classMain->formatSQL($_POST['id'][$i]));
					if (empty($_GET['level']) || $_GET['level'] == 1) $wrng = (is_array($_POST['wrng']) && in_array($id, $_POST['wrng'])) ? ', wrng=1' : ', wrng=0';

					$query = "UPDATE ".DB_PREFIX.$DBtable." SET
															name_".$langMain->name_def."='".$classMain->formatSQL($_POST['name'][$i])."',
															position=".intval($_POST['position'][$i]).",
															ip='".genIPlist($id)."',
															meta_desc_".$langMain->name_def."='".$classMain->formatSQL($_POST['meta_desc'][$i])."',
															meta_keywords_".$langMain->name_def."='".$classMain->formatSQL($_POST['meta_keywords'][$i])."'
															".$wrng."
															".$picSave."
															WHERE id=".$id." LIMIT 1";
					$db->query($query);
					//zapis +18 dla pokategorii
					if (empty($_GET['level']) || $_GET['level'] == 1)
					{
						#$listaID = listaIDkategorii($id);
						#$db->query("UPDATE ".DB_PREFIX."_cats SET ".$wrng." WHERE id IN (".$listaID.")");
					}
				}
			}

			//usuwanie kategorii
			if (is_array($_POST['delete']))
			{
				for ($i=0; $i < count($_POST['delete']); $i++)
				{
					$id = intval($classMain->formatSQL($_POST['delete'][$i]));

					$row = $db->query("SELECT id, ip FROM ".DB_PREFIX.$DBtable." WHERE id=".$id." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

					//tabela kategorii
					$db->query("DELETE FROM ".DB_PREFIX.$DBtable." WHERE id=".$row['id']." OR ip LIKE '".$row['ip'].".%' LIMIT 1");

					$db->query("DELETE
									".DB_PREFIX."_przedmioty,
									".DB_PREFIX."_przedmioty_zdjecia
									FROM
									".DB_PREFIX."_przedmioty
									LEFT JOIN ".DB_PREFIX."_przedmioty_zdjecia ON (".DB_PREFIX."_przedmioty_zdjecia.id_ogloszenia=".DB_PREFIX."_przedmioty.id)
									WHERE ".DB_PREFIX."_przedmioty.name LIKE CONCAT('".$row['ip']."')");
				}
			}
			#$classMain->redirect(ADMIN_FILE.'.php?op=cats&cat_id='.intval($_GET['cat_id']).'&level='.intval($_GET['level']).'&info=Zmiany+zostały+zapisane');
		}

		if ($_GET['update_ip'])
		{
			$result = $db->query("SELECT * FROM ".DB_PREFIX.$DBtable." ORDER BY level ASC");
			while ($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				$rowLast = $db->query("SELECT * FROM ".DB_PREFIX.$DBtable." WHERE level>".$row['level']." AND left_id=".$row['id']." LIMIT 1")->fetch(PDO::FETCH_ASSOC);
				$queryLast = (!$rowLast) ? 1 : 0;
				$db->query("UPDATE ".DB_PREFIX.$DBtable." SET
														ip='".genIPlist($row['id'])."',
														last=".$queryLast."
														WHERE id=".$row['id']." LIMIT 1");
			}
		}

		$level = ($_GET['level']) ? $_GET['level'] : 1;
		$cat_id_DB = ($_GET['cat_id']) ? " AND left_id='".$_GET['cat_id']."'" : '';

		//pobieranie kategorii wyżej
		$cat_up = $db->query("SELECT * FROM ".DB_PREFIX.$DBtable." WHERE id=".$classMain->formatSQL($_GET['cat_id'], 'int')." LIMIT 1")->fetch(PDO::FETCH_ASSOC);
		$cat_up_data = $db->query("SELECT * FROM ".DB_PREFIX.$DBtable." WHERE id=".$classMain->formatSQL($cat_up['left_id'], 'int')." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

		$dataTPL = array();
		$dataTPL['level'] = intval($_GET['level']);
		$dataTPL['cat_id'] = intval($_GET['cat_id']);

		if ($_GET['level'])
		{
			$dataTPL['cat_up_name'] = (!$cat_up_data['name']) ? 'Start' : $cat_up_data['name'];
			$dataTPL['cat_up_id'] = intval($cat_up_data['id']);
			$dataTPL['level_1'] = intval($_GET['level']-1);
			$dataTPL['cat_name'] = $classMain->setLangVar('name', $cat_up);
		}

		$result = $db->query("SELECT * FROM ".DB_PREFIX.$DBtable." WHERE level='".$level."'".$cat_id_DB." ORDER BY position ASC");
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$podcats = $db->query("SELECT * FROM ".DB_PREFIX.$DBtable." WHERE left_id=".$row['id']." LIMIT 1")->rowCount();
			$row['disabled'] = ($podcats || in_array($row['id'], $blockCats)) ? true : false;
			$row['wrng'] = ($row['wrng'] == 1) ? ' checked' : false;
			$row['level_1'] = $row['level']+1;
			$row['name'] = $classMain->setLangVar('name', $row);
			$row['meta_desc'] = $classMain->setLangVar('meta_desc', $row);
			$row['meta_keywords'] = $classMain->setLangVar('meta_keywords', $row);
			$classMain->dataTPLarrayList('cats', $row);
		}
	break;
}

$dataTPL['op'] = $getOP;
$classMain->dataTPLarray($dataTPL);

$adminClass->OpenTableAdmin();
$classMain->tpl('cats.tpl');
$adminClass->CloseTableAdmin();
?>
