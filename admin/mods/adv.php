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

header('X-XSS-Protection:0');

if (!defined('ADMIN_FILE')) die ("Access Denied");

$dataTPL = array();

switch($op)
{
	case 'adv':

		switch($_GET['func'])
		{
			//active/deactive
			case 'chan-act': $db->query("UPDATE ".DB_PREFIX."_adv set active=".$classMain->formatSQL($_GET['act'], 'int')." WHERE id=".$classMain->formatSQL($_GET['id'], 'int')." LIMIT 1"); break;
			//delete
			case 'del-com': $db->query("DELETE FROM ".DB_PREFIX."_adv WHERE id=".$classMain->formatSQL($_GET['id'], 'int')." LIMIT 1"); break;
		}

		//add new
		if ($_POST['func'] == "add-new")
		{
			//value
			switch($_POST['system'])
			{
				case 'c': $systemValue = $_POST['system_value_c']; break;
				case 'i': $systemValue = $_POST['system_value_i']; break;
			}

			$query = "INSERT INTO ".DB_PREFIX."_adv VALUES (
														NULL,
														'".$_POST['name']."',
														'".addslashes($_POST['content'])."',
														".intval($_POST['active']).",
														".$_POST['position'].",
														'".$_POST['system']."',
														'".$systemValue."',
														".time().",
														0
			)";

			if ($db->query($query)) $classMain->redirect(ADMIN_FILE.'.php?op=adv&info=Nowy+banner+został+dodany');
			else $classMain->redirect(ADMIN_FILE.'.php?op=adv&error=Banner+nie+został+dodany');
		}

		$dataTPL['edit'] = (isset($_GET['edit']) && is_numeric($_GET['edit'])) ? $classMain->formatSQL($_GET['edit'], 'int') : false;

		//edit
		if ($dataTPL['edit'])
		{
			$dataTPL = $db->query("SELECT * FROM ".DB_PREFIX."_adv WHERE id=".$dataTPL['edit']." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

			if ($_POST['edit'])
			{
				$_POST['system_value'] = ($_POST['system'] == 'c') ? $_POST['system_value_c'] : $_POST['system_value_i'];
				$db->query("UPDATE ".DB_PREFIX."_adv SET
																					name='".$classMain->formatSQL($_POST['name'])."',
																					content='".$classMain->formatSQL($_POST['content'])."',
																					active=".$classMain->formatSQL($_POST['active'], 'int').",
																					position='".$classMain->formatSQL($_POST['position'], 'int')."',
																					system='".$classMain->formatSQL($_POST['system'])."',
																					system_value='".$classMain->formatSQL($_POST['system_value'])."'
																					WHERE id=".$classMain->formatSQL($dataTPL['id'], 'int')." LIMIT 1");
				$classMain->redirect(ADMIN_FILE.'.php?op=adv&info=Zmiany+zostały+zapisane');
			}

			$dataTPL['content'] = htmlspecialchars_decode($dataTPL['content']);
			$dataTPL['stats_value'] = ($dataTPL['system_value'] == 'c') ? number_format($dataTPL['views'], 0, '.', ' ') : round((time()-$dataTPL['date'])/86400);
			$dataTPL['edit'] = true;
		}

		//adv
		$result = $db->query("SELECT r.*, p.name AS pozycja
													FROM ".DB_PREFIX."_adv r
													LEFT JOIN ".DB_PREFIX."_adv_positions p ON (p.id=r.position)
													ORDER BY p.name, r.name ASC");
		while($row = $result->fetch(PDO::FETCH_ASSOC)) $classMain->dataTPLarrayList('a', $row);

		//positions
		$result = $db->query("SELECT * FROM ".DB_PREFIX."_adv_positions ORDER BY name ASC");
		while($row = $result->fetch(PDO::FETCH_ASSOC)) $classMain->dataTPLarrayList('ap', $row);

	break;

	case 'adv-positions':

		$dataTPL['func'] = $classMain->formatSQL($_GET['func']);

		if ($dataTPL['func'] == 'save-edit')
		{
			$result = $db->query("UPDATE ".DB_PREFIX."_adv_positions SET name='".$_POST['name']."' WHERE id='".$_GET['id']."'");
			$classMain->redirect(ADMIN_FILE.'.php?op=adv&info=Zmiany+zostały+zapisane');
		}
		elseif ($dataTPL['func'] == 'edit')
		{
    	$poz = $db->query("SELECT * FROM ".DB_PREFIX."_adv_positions WHERE id=".intval($classMain->formatSQL($_GET['id']))." LIMIT 1")->fetch(PDO::FETCH_ASSOC);
			$dataTPL = $poz;
		}
		elseif ($dataTPL['func'] == 'save-new')
		{
			$result = $db->query("INSERT INTO ".DB_PREFIX."_adv_positions VALUES (
																				NULL,
																				'".$_POST['name']."'
			)");
			$classMain->redirect(ADMIN_FILE.'.php?op=adv&info=Zmiany+zostały+zapisane');
		}
		elseif ($dataTPL['func'] == 'del')
		{
	    	$db->query("DELETE FROM ".DB_PREFIX."_adv_positions WHERE id=".intval($classMain->formatSQL($_GET['id']))." LIMIT 1");
    		$db->query("DELETE FROM reklama WHERE position=".intval($classMain->formatSQL($_GET['id'])));
    		$classMain->redirect(ADMIN_FILE.'.php?op=adv&info=Pozycja+została+usunięta');
		}

		//positions
		$result = $db->query("SELECT * FROM ".DB_PREFIX."_adv_positions ORDER BY name ASC");
  	while($row = $result->fetch(PDO::FETCH_ASSOC)) $classMain->dataTPLarrayList('p', $row);

	break;
}

$dataTPL['op'] = $op;
$classMain->dataTPLarray($dataTPL, false);

$adminClass->OpenTableAdmin();
$classMain->tpl('adv.tpl');
$adminClass->CloseTableAdmin();
?>
