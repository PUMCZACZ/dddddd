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

if ($_POST['zapisz'])
{
	if ($_POST['nazwa_dzial'])
	{
		$db->query("INSERT INTO ".$prefix."_pomoc_kategorie (
								rodzaj,
								nazwa
							) VALUES (
								'".$_POST['rodzaj_dzial']."',
								'".$_POST['nazwa_dzial']."'
							)");
	}

	if ($_POST['nazwa_kategoria'])
	{
		$db->query("INSERT INTO ".$prefix."_pomoc_kategorie (
								cat_id,
								rodzaj,
								nazwa
							) VALUES (
								'".$_POST['dzial_kategoria']."',
								'".$_POST['rodzaj_kategoria']."',
								'".$_POST['nazwa_kategoria']."'
							)");
	}
}

if ($_POST['zapisz_zmiany'])
{
	for ($i=0; $i < count($_POST['nazwa_dzial']); $i++)
	{
		if ($_POST['usun_dzial'][$i]) $db->query("DELETE FROM ".$prefix."_pomoc_kategorie WHERE id='".$_POST['usun_dzial'][$i]."'");
		else $db->query("UPDATE ".$prefix."_pomoc_kategorie SET nazwa='".$_POST['nazwa_dzial'][$i]."' WHERE id='".$_POST['id_dzial'][$i]."'");
	}

	for ($i=0; $i < count($_POST['nazwa_kategoria']); $i++)
	{
		if ($_POST['usun_kategoria'][$i]) $db->query("DELETE FROM ".$prefix."_pomoc_kategorie WHERE id='".$_POST['usun_kategoria'][$i]."'");
		else $db->query("UPDATE ".$prefix."_pomoc_kategorie SET nazwa='".$_POST['nazwa_kategoria'][$i]."', cat_id=".$_POST['cat_id'][$i]." WHERE id='".$_POST['id_kategoria'][$i]."'");
	}
}

if ($_POST['dodaj'])
{
	$db->query("INSERT INTO ".$prefix."_pomoc (
						cat_id,
						temat,
						tekst
					) VALUES (
						".$_POST['cat_id'].",
						'".formatSQL($_POST['temat'])."',
						'".formatSQL($_POST['tekst'])."'
					)");

}

if ($_POST['zapisz_zmiany_pomoc'])
{
	$db->query("UPDATE ".$prefix."_pomoc SET
						cat_id=".$_POST['cat_id'].",
						temat='".formatSQL($_POST['temat'])."',
						tekst='".formatSQL($_POST['tekst'])."'
					WHERE id=".$_POST['id']);

}

if ($_POST['usun_pomoc']) for ($i=0; $i < count($_POST['usun']); $i++) $db->query("DELETE FROM ".$prefix."_pomoc WHERE id='".$_POST['usun'][$i]."'");

define(SITE_EDITOR, 1);

$result = $db->query("SELECT * FROM ".$prefix."_pomoc_kategorie WHERE rodzaj='dzial' ORDER BY nazwa ASC");
while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
	$kategorie = $db->query("SELECT cat_id FROM ".$prefix."_pomoc_kategorie WHERE cat_id=".$row['id']." LIMIT 1")->num_rows;
	$row['disabled'] = ($kategorie) ? ' disabled' : '';
	$mainClass->dataTPLarrayList('cd', $row);
}

//edit help
if ($_GET['edytuj']) $dane = $db->query("SELECT * FROM ".$prefix."_pomoc WHERE id=".intval(formatSQL($_GET['edytuj']))." LIMIT 1")->fetch_array(MYSQLI_ASSOC);
$dane['tekst'] = stripslashes($dane['tekst']);
$mainClass->dataTPLarray($dane);

$result = $db->query("SELECT * FROM ".$prefix."_pomoc_kategorie WHERE rodzaj='kategoria' ORDER BY nazwa ASC");
while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
	$mainClass->dataTPLarrayList('c', $row);
	$result2 = $db->query("SELECT * FROM ".$prefix."_pomoc_kategorie WHERE rodzaj='dzial' ORDER BY nazwa ASC");
	while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) $mainClass->dataTPLarrayList('c.cd', $row2);
}

$result = $db->query("SELECT * FROM ".$prefix."_pomoc ORDER BY id DESC");
while ($row = $result->fetch_array(MYSQLI_ASSOC))
{
	$kategoria = $db->query("SELECT cat_id, nazwa FROM ".$prefix."_pomoc_kategorie WHERE id=".$row['cat_id']." LIMIT 1")->fetch_array(MYSQLI_ASSOC);
	$dzial = $db->query("SELECT nazwa FROM ".$prefix."_pomoc_kategorie WHERE id=".$kategoria['cat_id']." LIMIT 1")->fetch_array(MYSQLI_ASSOC);
	$row['kategoria_nazwa'] = $kategoria['nazwa'];
	$row['dzial_nazwa'] = $dzial['nazwa'];
	$mainClass->dataTPLarrayList('p', $row);
}

$template->assign_vars(array(
												'EDYTUJ' => (!empty($_GET['edytuj']))
));

$adminClass->OpenTableAdmin();
$template->set_filenames(array(
			'body' => 'help.tpl'
		));
$template->display('body');
$adminClass->CloseTableAdmin();
?>
