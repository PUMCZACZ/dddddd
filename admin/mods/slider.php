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

//save changes
if ($_POST['save'])
{
	for ($i=0; $i < count($_POST['delete']); $i++)
	{
		$row = $db->query("SELECT obraz FROM ".DB_PREFIX."_slider WHERE id=".$_POST['delete'][$i])->fetch(PDO::FETCH_ASSOC);
		if ($row['obraz'] && file_exists('img/slider/'.$row['obraz'])) unlink('img/slider/'.$row['obraz']);
		$db->query("DELETE FROM ".DB_PREFIX."_slider WHERE id=".$classMain->formatSQL($_POST['delete'][$i], 'int')." LIMIT 1");
	}

	for ($i=0; $i < count($_POST['id']); $i++)
	{
		$id = $classMain->formatSQL($_POST['id'][$i], 'int');
		$aktywne = ($_POST['aktywne'][$i] == $_POST['id'][$i]) ? 1 : 0;
		$query = "UPDATE ".DB_PREFIX."_slider SET
											adres='".$_POST['adres'][$i]."',
											nazwa='".$_POST['nazwa'][$i]."',
											pozycja='".$_POST['pozycja'][$i]."',
											aktywne=".$aktywne.",
											block=".intval($_POST['block'][$id])."
											WHERE id=".$id." LIMIT 1";
		$db->query($query);
	}
}

if ($_POST['add'])
{

	//pozycja
	$maxPozycja = $db->query("SELECT MAX(pozycja) AS max FROM ".DB_PREFIX."_slider")->fetch(PDO::FETCH_ASSOC);
	$maxPozycja = $maxPozycja['max']+1;

	require_once("inc/classes/class.upload.php");
	$handle = new Upload($_FILES['nowy_obraz']);
	$nazwa_zdjecia = uniqid();

	if ($handle->uploaded) {
		$handle->file_src_name_body	= $nazwa_zdjecia;
		$handle->Process('img/slider/');

		//ustalanie podstawy nazw zdjcÄ™cia
		$nazwaZdjecia = $nazwa_zdjecia.'.'.$handle->file_dst_name_ext;
		$handle-> Clean();
	}

	$db->query("INSERT INTO ".DB_PREFIX."_slider VALUES (
													NULL,
													'".$nazwaZdjecia."',
													'".$_POST['nowy_adres']."',
													'".$_POST['nowa_nazwa']."',
													".$maxPozycja.",
													1,
													0
	)");

}

$i = 0;
$result = $db->query("SELECT * FROM ".DB_PREFIX."_slider ORDER BY block ASC, pozycja ASC");
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
	$row['i'] = $i;
	$classMain->dataTPLarrayList('s', $row);
	$i++;
}

$classMain->dataTPLarray($dataTPL);

$adminClass->OpenTableAdmin();
$classMain->tpl('slider.tpl');
$adminClass->CloseTableAdmin();
?>
