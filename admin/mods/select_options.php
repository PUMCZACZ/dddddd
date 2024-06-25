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

$langMain = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE def=1 LIMIT 1")->fetch(PDO::FETCH_OBJ);

switch($_GET['op'])
{
	case 'tax-values':

		if ($_POST['save'])
		{
			foreach ($_POST['country'] as $key => $value)
			{
				$row = $db->query("SELECT * FROM ".DB_PREFIX."_tax WHERE country=".$classMain->formatSQL($value, 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);
				if ($row) $db->query("UPDATE ".DB_PREFIX."_tax SET value='".$classMain->formatSQL($_POST['tax'][$value])."' WHERE country=".$classMain->formatSQL($value, 'int')." LIMIT 1");
				else $db->query("INSERT INTO ".DB_PREFIX."_tax VALUES (NULL, ".$classMain->formatSQL($value, 'int').", '".$classMain->formatSQL($_POST['tax'][$value])."')");
			}
			$classMain->redirect(ADMIN_FILE.'.php?op='.$_GET['op'].'&info=Zmiany+zostały+zapisane.');
		}

		$result = $db->query("SELECT t.*, so.id AS c_id, so.* FROM ".DB_PREFIX."_select_options so LEFT JOIN ".DB_PREFIX."_tax t ON (t.country=so.id) WHERE so.name_tech='kraj' ORDER BY t.value ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->name = $classMain->setLangVar('name', $row);
			$classMain->dataTPLarrayList('t', $row);
		}
	break;
	case 'select-options':

		function techNames($name)
		{
			global $classMain;

			$arrayTypes = array(
							'kraj' => 'Kraj',
							'jezyk' => 'Język',
							'waluta' => 'Waluta',
							'item_time' => 'Czas wyświetlania',
							'item_offer_type' => 'Rodzaje cen w ofercie',
							'item_type' => 'Rodzaj oferty',
							'unit' => 'Jednostka miary',
							'region' => 'Region',
							'contact_type' => 'Typ kontaktu'
			);
			foreach ($arrayTypes as $key => $value)
			{
				$dataTPL['name_tech'] = $key;
				$dataTPL['name'] = $value;
				$classMain->dataTPLarrayList($name, $dataTPL);
			}
		}

	//tpl array options
	$dataTPL = array();

			if ($_POST['save'])
			{
				//new opt
				if ($_POST['opt'])
				{
					//explode list
					$opts = explode("\r\n", $_POST['opt']);
					$def = ($_POST['def'] == 1) ? 1 : 0;

					for ($i=0; $i < count($opts); $i++)
					{
						$db->query("INSERT INTO ".DB_PREFIX."_select_options (
												name_tech,
												name_".$langMain->name_def.",
												def
											) VALUES (
												'".$_POST['name_tech']."',
												'".$opts[$i]."',
												".$def."
										)");
					}
				}
			}

			//save changes
			if (is_array($_POST['edit_opt']))
			{
				$query = array();
				for ($i=0; $i <count($_POST['edit_opt']); $i++)
				{
					$id = $classMain->formatSQL($_POST['edit_opt_id'][$i], 'int');
					$query[] = "UPDATE ".DB_PREFIX."_select_options SET
											name_tech='".$_POST['edit_opt_name_tech'][$i]."',
											name_".$langMain->name_def."='".$_POST['edit_opt'][$i]."',
											def=".$classMain->formatSQL($_POST['edit_def'][$id], 'int')."
											WHERE id=".$id." LIMIT 1";
				}
				$query = implode(';', $query);
				$db->query($query);
			}

			//usuwanie opcji
			if (is_array($_POST['delete_opt']))
			{
				$i = 0;
				while ($i <= count($_POST['edit_opt_id']))
				{
					if (!empty($_POST['delete_opt'][$i])) $db->query("DELETE FROM ".DB_PREFIX."_select_options WHERE id='".$_POST['delete_opt'][$i]."' LIMIT 1");
					$i++;
				}
			}

			if ($_POST['name_filter'])
			{
				$dataTPL['name_filter'] = $_POST['name_filter'];
				$where = " WHERE name_tech='".$_POST['name_filter']."'";
			}

			$result = $db->query("SELECT * FROM ".DB_PREFIX."_select_options".$where." ORDER BY name_tech ASC");
			while ($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				$row['name'] = $classMain->setLangVar('name', $row);
				$classMain->dataTPLarrayList('ow', $row, false);
				techNames('ow.nt');
			}
			techNames('nt');
	break;
}

$classMain->dataTPLarray($dataTPL, false);

$adminClass->OpenTableAdmin();
$classMain->tpl('select_options.tpl');
$adminClass->CloseTableAdmin();
