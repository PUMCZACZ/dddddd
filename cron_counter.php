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

require_once dirname(__FILE__).'/inc/functions_main.php';

function lista_id_kategorii($id=0) {

	global $db, $prefix;

	$row = $db->query("SELECT ip, last FROM ".DB_PREFIX."_cats WHERE id=".intval(formatSQL($id))." LIMIT 1")->fetch(PDO::FETCH_OBJ);

	return ($row['last'] == 1) ? $row['ip'] : $row['ip'].'.%';
}

$suma = 0;
$result = $db->query("SELECT * FROM ".DB_PREFIX."_cats");
while ($row = $result->fetch(PDO::FETCH_OBJ))
{
	#$ip = lista_id_kategorii($row['id']);
	$ip = ($row->last == 1) ? $row->ip : $row->ip.'.%';
	$liczba = $db->query("SELECT COUNT(*) AS suma FROM ".DB_PREFIX."_items WHERE cat_id LIKE CONCAT ('".$ip."') AND active=1 AND end>".time())->fetch(PDO::FETCH_OBJ);
	$db->query("UPDATE ".DB_PREFIX."_cats SET counter=".intval($liczba->suma)." WHERE id=".$row->id." LIMIT 1");

	$suma = $suma+$liczba->suma;
}

$db->query("UPDATE ".DB_PREFIX."_config SET items_count=".intval($suma)." WHERE 1");
?>
