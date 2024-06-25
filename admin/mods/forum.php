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

$op = formatSQL($_GET['op']);

switch($op)
{
	case "forum":

		//dodawanie pojedynczej kategorii
		if ($_POST['zapisz_kategorie'])
		{
			$query = "INSERT INTO ".$prefix."_forum_categories VALUES (NULL, '".formatSQL($_POST['nowa_kategoria'])."')";
			$db->query($query);
			$ERROR = 'Zmiany zostały zapisane';
		}

		if ($_POST['zapisz'])
		{
			//zapisywanie zmin w kategoriach
			for ($i=0; $i <count($_POST['id']); $i++)
			{
				//tabela kategorii
				$db->query("UPDATE ".$prefix."_forum_categories SET name='".formatSQL($_POST['name'][$i])."' WHERE id=".intval(formatSQL($_POST['id'][$i])));
			}

			//usuwanie kategorii
			for ($i=0; $i <count($_POST['usun']); $i++)
			{
				//tabela kategorii
				$db->query("DELETE FROM ".$prefix."_forum_categories WHERE id=".intval(formatSQL($_POST['usun'][$i]))." LIMIT 1");
			}
		}

		//categories list
		$result = $db->query("SELECT * FROM ".$prefix."_forum_categories ORDER BY id ASC");
		while ($row = $result->fetch_array(MYSQLI_ASSOC)) $mainClass->dataTPLarrayList('fc', $row);

	break;
}

$adminClass->OpenTableAdmin();
$template->set_filenames(array(
						'body' => 'forum.tpl'
));
$template->display('body');
$adminClass->CloseTableAdmin();
?>
