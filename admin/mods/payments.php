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

switch($op)
{
	case 'payments':
	default:
		if ($_POST['save'] == 1)
		{
			foreach ($_POST['payment'] as $key => $value) $db->query("UPDATE ".DB_PREFIX."_payments_salary SET status=1 WHERE id=".$classMain->formatSQL($value, 'int')." LIMIT 1");
		}
		$where = 'ps.status=0';
	break;
	case 'payments-end':
	default:
		$where = 'ps.status=1';
	break;
}

$result = $db->query("SELECT ps.*, u.username, u.name, u.age
											FROM ".DB_PREFIX."_payments_salary ps
											LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=ps.user_id)
											WHERE ".$where." ORDER BY ps.date ASC");
while ($row = $result->fetch(PDO::FETCH_OBJ))
{
	$row->date = date('d-m-Y H:i', $row->date);
	$classMain->dataTPLarrayList('ps', $row);
}

$dataTPL['op'] = $op;
$classMain->dataTPLarray($dataTPL);
$adminClass->OpenTableAdmin();
$classMain->tpl('payments.tpl');
$adminClass->CloseTableAdmin();
?>
