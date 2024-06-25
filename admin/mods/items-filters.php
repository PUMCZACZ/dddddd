<?php

/****************************************************************/
/*	UWAGA! SKRYPT NIE JEST DARMOWY.								*/
/*	DALSZE ROZPOWSZECHNIANIE BEZ ZGODY 							*/
/*	FIRMY JMLNET JEST ZABRONIONE.								*/
/****************************************************************/
/****************************************************************/
/*	PRODUCENT OPROGRAMOWANIA	JMLnet							*/
/*	NAZWA SKRYPTU:				SKRYPT AUKCYJNY					*/
/*	WERSJA:						1.01							*/
/*	KONTAKT:					INFO@JMLNET.PL					*/
/****************************************************************/
/* Copyright (c) JMLnet. Wszelkie prawa zastrzeone.				*/
/****************************************************************/

if (!defined('ADMIN_FILE')) die ("Access Denied");

switch($op)
{
	case 'items-filters':

		switch($func)
		{
			case 'add':

				if (isset($_POST['save']))
				{
					$catID = $classMain->formatSQL(end($_POST['cat_id']), 'int');
					if (!empty($catID)) $rowCat = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE id=".$catID." LIMIT 1")->fetch(PDO::FETCH_OBJ);

					$newID = $db->query("SELECT MAX(f_id) AS f_id FROM ".DB_PREFIX."_filters")->fetch(PDO::FETCH_OBJ);
					$newPosition = $db->query("SELECT MAX(position) AS position FROM ".DB_PREFIX."_filters")->fetch(PDO::FETCH_OBJ);

					$filtersList = explode("\r\n", $_POST['filters']);
					for ($a=0; $a < count($filtersList); $a++)
					{
						$db->query("INSERT INTO ".DB_PREFIX."_filters VALUES (
																			NULL,
																			".($newID->f_id+1).",
																			'".$rowCat->ip."',
																			".$catID.",
																			'".$classMain->formatSQL($_POST['type'])."',
																			'".$classMain->formatSQL($_POST['name'])."',
																			'".$classMain->formatSQL($filtersList[$a])."',
																			'".$classMain->formatSQL($_POST['mark_l'])."',
																			'".$classMain->formatSQL($_POST['mark_r'])."',
																			".$classMain->formatSQL($newPosition->position, 'int').",
																			0
						)");
					}
					$classMain->redirect(ADMIN_FILE.'.php?op=items-filters', 'info', 'Filtr został zapisany');
				}

				$classMain->dataTPLarrayList('cl', array());
				$result = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE level=1 ORDER BY position ASC");
				while ($row = $result->fetch(PDO::FETCH_OBJ))
				{
					$row->name = $classMain->setLangVar('name', $row);
					$classMain->dataTPLarrayList('cl.c', $row);
				}

			break;

			case 'edit':

				if (isset($_POST['save']))
				{
					$catID = $classMain->formatSQL(end($_POST['cat_id']), 'int');
					if (!empty($catID)) $rowCat = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE id=".$catID." LIMIT 1")->fetch(PDO::FETCH_OBJ);

					//update
					$result = $db->query("SELECT * FROM ".DB_PREFIX."_filters WHERE f_id=".$classMain->formatSQL($_POST['f_id'], 'int')." ORDER BY id ASC");
					while ($row = $result->fetch(PDO::FETCH_OBJ))
					{
						$query = "UPDATE ".DB_PREFIX."_filters SET
															cat_ip='".$rowCat->ip."',
															cat_id_save=".$catID.",
															type='".$classMain->formatSQL($_POST['type'])."',
															name='".$classMain->formatSQL($_POST['name'])."',
															parameter='".$classMain->formatSQL($_POST['old_filters'][$row->id])."',
															mark_l='".$classMain->formatSQL($_POST['mark_l'])."',
															mark_r='".$classMain->formatSQL($_POST['mark_r'])."'
															WHERE id=".$row->id." LIMIT 1";
															echo $query;
						$db->query($query);
					}

					//dodawani nowych parametrów
					$filtersList = explode("\r\n", $_POST['filters']);
					for ($a=0; $a < count($filtersList); $a++)
					{
						if (!empty($filtersList[$a]))
						{
							$db->query("INSERT INTO ".DB_PREFIX."_filters VALUES (
																				NULL,
																				".$classMain->formatSQL($_POST['f_id'], 'int').",
																				'".$rowCat->ip."',
																				".$catID.",
																				'".$classMain->formatSQL($_POST['typ'])."',
																				'".$classMain->formatSQL($_POST['nazwa'])."',
																				'".$filtersList[$a]."',
																				'".$classMain->formatSQL($_POST['mark_l'])."',
																				'".$classMain->formatSQL($_POST['mark_r'])."',
																				".$classMain->formatSQL($_POST['position'], 'int')."
							)");
						}
					}

					//usuwanie parametrów
					for ($a=0; $a < count($_POST['delete-param']); $a++) $db->query("DELETE FROM ".DB_PREFIX."_filters WHERE id=".intval($_POST['delete-param'][$a]));

					$classMain->redirect(ADMIN_FILE.'.php?op=items-filters', 'info', 'Zmiany zostały zapisane');
				}

				$query = "SELECT * FROM ".DB_PREFIX."_filters WHERE f_id=".intval($_GET['f_id']);

				//lista parametrów
				$result = $db->query($query.' AND type!=\'t\' ORDER BY id ASC');
				while ($row = $result->fetch(PDO::FETCH_OBJ)) $classMain->dataTPLarrayList('filters', $row);

				//ogólne dane parametru
				$rowFilter = $db->query($query." LIMIT 1")->fetch(PDO::FETCH_OBJ);

				//listy kategorii
				#$kategorieNadrzedne =  listaBackKategorii($daneParametru['cat_id_save']);
				$catsList = explode('.', $rowFilter->cat_ip);

				for ($i=0; $i < count($catsList); $i++)
				{
					$classMain->dataTPLarrayList('cl', array());
					$leftID = ($i > 0) ? " AND left_id=".$catsList[$i-1] : '';
					$result = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE level=".($i+1).$leftID." ORDER BY position ASC");
					while ($row = $result->fetch(PDO::FETCH_OBJ))
					{
						$row->selected = ($catsList[$i] == $row->id);
						$row->name = $classMain->setLangVar('name', $row);
						$classMain->dataTPLarrayList('cl.c', $row);
					}

				}

				$dataTPL = (array)$rowFilter;

			break;

			default:

				//pager
				require 'admin/mods/classes/pager.class.all.php';

				//zapisywanie zmian
				if (!empty($_POST['update']))
				{
					//delete parms
					if (is_array($_POST['delete'])) for ($a=0; $a < count($_POST['delete']); $a++) $db->query("DELETE FROM ".DB_PREFIX."_filters WHERE f_id=".$_POST['delete'][$a]);
					//update position
					if (is_array($_POST['f_id']))
					{
						foreach ($_POST['f_id'] as $key => $value) $db->query("UPDATE ".DB_PREFIX."_filters SET position=".intval($_POST['position'][$value]).", required=".intval($_POST['required'][$value])." WHERE f_id=".$value);
					}
				}

				$nr = 0;
				$sql = "SELECT c.name_".$classMain->defLang." AS cat_name, f.* FROM ".DB_PREFIX."_filters f LEFT JOIN ".DB_PREFIX."_cats c ON (c.id=f.cat_id_save) GROUP BY f.f_id";
				$result = $db->query($sql);
				$row = $result->fetch(PDO::FETCH_OBJ);
				$recordsCount = $result->rowCount();//pobranie liczby rekordĂłw

				try{
					$pager = new Pager('');
					$pager->SetTotalRecords($recordsCount);
					$pager->Make(true);
					$pag = $pager->Render();
					$start = $pager->GetIndexRecordStart();
					$end = $pager->GetIndexRecordEnd();
				}
				catch (Exception $e)
				{
					echo $e->getMessage();
				}

				$result = $db->query($sql." ORDER BY cat_id_save ASC, position ASC, name ASC LIMIT ".$start.",".($end - $start + 1));
				while ($row = $result->fetch(PDO::FETCH_OBJ)) $classMain->dataTPLarrayList('filters', $row);
			break;
		}
	break;
}

$dataTPL['FUNC'] = $func;
$dataTPL['PAGER'] = $pag;

$classMain->dataTPLarray($dataTPL);
$adminClass->OpenTableAdmin();
$classMain->tpl('items-filters.tpl');
$adminClass->CloseTableAdmin();
?>
