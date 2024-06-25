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

function save_banned($ip1, $ip2, $ip3, $ip4, $reason)
{
	global $adminClass, $db, $classMain, $admin_file;

	if (substr($ip2, 0, 2) == 00) { $ip2 = str_replace("00", "", $ip2); }
	if (substr($ip3, 0, 2) == 00) { $ip3 = str_replace("00", "", $ip3); }
	if (substr($ip4, 0, 2) == 00) { $ip4 = str_replace("00", "", $ip4); }

	$ip = "$ip1.$ip2.$ip3.$ip4";

	//out of range
	if (empty($ip1) OR empty($ip2) OR empty($ip3) OR empty($ip4)) $classMain->redirect($admin_file.'.php?op=ipban&error=Błąd:+Adres+IP+poza+rangą');

	//only numeric
	if (!is_numeric($ip1) && !empty($ip1) OR !is_numeric($ip2) && !empty($ip2) OR !is_numeric($ip3) && !empty($ip3) OR !is_numeric($ip4) && !empty($ip4) && $ip4 != "*") $classMain->redirect($admin_file.'.php?op=ipban&error=Błąd:+Adres+IP+może+się+składać+tylko+z+cyfr');

	//out of range
	if ($ip1 > 255 OR $ip2 > 255 OR $ip3 > 255 OR $ip4 > 255 && $ip4 != "*") $classMain->redirect($admin_file.'.php?op=ipban&error=Błąd:+Adres+IP+poza+rangą');

	//start 0
	if (substr($ip1, 0, 1) == 0) $classMain->redirect($admin_file.'.php?op=ipban&error=Błąd:+Adres+IP+nie+może+rozpoczynać+się+od+\'0\'');

	//localhost
	if ($ip == "127.0.0.1") $classMain->redirect($admin_file.'.php?op=ipban&error=Błąd:+Nie+możesz+zablokować+IP+lokalnego+hosta');

	//my IP
	$my_ip = $_SERVER['REMOTE_ADDR'];
	if ($ip == $my_ip) $classMain->redirect($admin_file.'.php?op=ipban&error=Błąd:+Nie+możesz+zablokować+własnego+adresu+IP');

	$date = date("Y-m-d");
	$db->query("INSERT INTO ".DB_PREFIX."_banned_ip VALUES (NULL, '".$ip."', '".$reason."', '".$date."')");

	$classMain->redirect($admin_file.'.php?op=ipban&info=Operacja+zakończona+sukcesem!+Adres+IP+'.$ip.' został zablokowany.');
}

	function ipban_delete($id, $ok)
	{
		global $admin_file, $adminClass, $db, $classMain;

		$id = intval($id);
		$row = $db->query("SELECT * FROM ".DB_PREFIX."_banned_ip WHERE id=".$id." LIMIT 1")->fetch(PDO::FETCH_ASSOC);
		$classMain->dataTPLarray($row);

		if ($ok == 1)
		{
			$db->query("DELETE FROM ".DB_PREFIX."_banned_ip WHERE id=".$id);
			$classMain->redirect($admin_file.'.php?op=ipban&info=Adres+został+odblokowany.');
		}
	}

	function ipban_save($id, $ip1, $ip2, $ip3, $ip4, $reason)
	{
		global $adminClass, $db, $classMain, $admin_file;

		if (substr($ip2, 0, 2) == 00) { $ip2 = ereg_replace("00", "", $ip2); }
		if (substr($ip3, 0, 2) == 00) { $ip3 = ereg_replace("00", "", $ip3); }
		if (substr($ip4, 0, 2) == 00) { $ip4 = ereg_replace("00", "", $ip4); }
		$ip = "$ip1.$ip2.$ip3.$ip4";

		if ($ip1 == "" OR $ip2 == "" OR $ip3 == "" OR $ip4 == "") $classMain->redirect($admin_file.'.php?op=ipban_edit&id='.$id.'&error=Błąd:+Adres+IP+poza+rangą');

		if (!is_numeric($ip1) && !empty($ip1) OR !is_numeric($ip2) && !empty($ip2) OR !is_numeric($ip3) && !empty($ip3) OR !is_numeric($ip4) && !empty($ip4) && $ip4 != "*") $classMain->redirect($admin_file.'.php?op=ipban_edit&id='.$id.'&error=Błąd:+Adres+IP+może+się+składać+tylko+z+cyfr');

		if (substr($ip1, 0, 1) == 0) $classMain->redirect($admin_file.'.php?op=ipban_edit&id='.$id.'&&error=Błąd:+Adres+IP+nie+może+rozpoczynać+się+od+\'0\'');

		if ($ip == "127.0.0.1") $classMain->redirect($admin_file.'.php?op=ipban_edit&id='.$id.'&error=Błąd:+Nie+możesz+zablokować+IP+lokalnego+hosta');

		$my_ip = $_SERVER["REMOTE_ADDR"];
		if ($ip == $my_ip) $classMain->redirect($admin_file.'.php?op=ipban_edit&id='.$id.'&error=Błąd:+Nie+możesz+zablokować+własnego+adresu+IP');

		$id = intval($id);
		$db->query("UPDATE ".DB_PREFIX."_banned_ip SET ip_address='".$ip."', reason='".$reason."' WHERE id='".$id."'");

		$classMain->redirect($admin_file.'.php?op=ipban&info=Operacja+zakończona+sukcesem.');
	}

	switch($op)
	{
		case "ipban":
			$dataTPL['ip'] = $ip;
			$ip = explode(".", $ip);
			$dataTPL['ip_0'] = $ip[0];
			$dataTPL['ip_1'] = $ip[1];
			$dataTPL['ip_2'] = $ip[2];
			$dataTPL['ip_3'] = $ip[3];

			$result = $db->query("SELECT * from ".DB_PREFIX."_banned_ip ORDER by date DESC");
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) $classMain->dataTPLarrayList('b', $row);

		break;

		case "save_banned":
		save_banned($ip1, $ip2, $ip3, $ip4, $reason);
		break;

		case "ipban_delete":
		ipban_delete($id, $ok);
		break;

		case "ipban_edit":
			$id = intval($id);
			$row = $db->query("SELECT * from ".DB_PREFIX."_banned_ip WHERE id='".$id."' LIMIT 1")->fetch(PDO::FETCH_ASSOC);

			$classMain->dataTPLarray($row);
			$ip = explode(".", $row['ip_address']);
			$dataTPL['ip_0'] = $ip[0];
			$dataTPL['ip_1'] = $ip[1];
			$dataTPL['ip_2'] = $ip[2];
			$dataTPL['ip_3'] = $ip[3];
		break;

		case "ipban_save":
		ipban_save($id, $ip1, $ip2, $ip3, $ip4, $reason);
		break;

	}

	$dataTPL['op'] = $op;

	$classMain->dataTPLarray($dataTPL);

	$adminClass->OpenTableAdmin();
	$classMain->tpl('ipban.tpl');
	$adminClass->CloseTableAdmin();

?>
