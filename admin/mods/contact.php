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

if ($_POST['add']) $db->query("INSERT INTO ".$prefix."_contact VALUES (NULL, '".formatSQL($_POST['type'])."', '".formatSQL($_POST['email'])."')");

if ($_POST['save'])
{
	for ($i=0; $i < count($_POST['id']); $i++) $db->query("UPDATE ".$prefix."_contact SET type='".formatSQL($_POST['type'][$i])."', email='".formatSQL($_POST['email'][$i])."' WHERE id=".intval($_POST['id'][$i])." LIMIT 1");
}

if ($_GET['del']) $db->query("DELETE FROM ".$prefix."_contact WHERE id=".intval($_GET['del'])." LIMIT 1");

//contact list
$result = $db->query("SELECT * FROM ".$prefix."_contact ORDER BY id ASC");
while ($row = $result->fetch_array(MYSQLI_ASSOC)) $mainClass->dataTPLarrayList('c', $row);

$adminClass->OpenTableAdmin();
$template->set_filenames(array(
						'body' => 'contact.tpl'
));
$template->display('body');
$adminClass->CloseTableAdmin();
?>
