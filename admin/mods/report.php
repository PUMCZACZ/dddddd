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

//save comment
if ($_POST['save-comment'])
{
	$db->query("UPDATE ".DB_PREFIX."_report SET comment='".$classMain->formatSQL($_POST['comment'])."' WHERE id=".$classMain->formatSQL($_POST['id'], 'int')." LIMIT 1");
}
//delete
if (isset($_POST['delete']) && is_array($_POST['id']))
{
	foreach ($_POST['id'] as $key => $value) $db->query("DELETE FROM ".DB_PREFIX."_report WHERE id=".$value." LIMIT 1");
}
if ($_POST['veryfi'] && is_array($_POST['id']))
{
	foreach ($_POST['id'] as $key => $value) $db->query("UPDATE ".DB_PREFIX."_report SET veryfi=1 WHERE id=".$value." LIMIT 1");
}
if ($_POST['deactive'])
{
	if (is_array($_POST['id']))
	{
		foreach ($_POST['id'] as $key => $value)
		{
			$row = $db->query("SELECT i.id, u.user_email
				FROM ".DB_PREFIX."_report r
				LEFT JOIN ".DB_PREFIX."_items i ON (i.id=r.x_id)
				LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
				WHERE r.id=".$value." AND r.type='item'
				LIMIT 1")->fetch(PDO::FETCH_OBJ);
			if ($row->id)
			{
				$db->query("UPDATE ".DB_PREFIX."_items SET active=0 WHERE id=".$row->id." LIMIT 1");

				if ($_POST['deactive-reason'] && $_POST['deactive-subject'])
				{
					$row->deactive_reason = $classMain->formatSQL($_POST['deactive-reason']);
					$classMain->sendEmail(
						$classMain->formatSQL($_POST['deactive-subject']),
						$row,
						'email_report_deactive.tpl',
						$row->user_email
					);
				}
			}
		}
	}
}

switch($_GET['orderby'])
{
	case 'veryfi':
		$orderby = 'r.veryfi ASC';
	break;
	case 'active':
		$orderby = 'i.active DESC';
	break;
	default:
	case 'date':
		$orderby = 'r.date DESC';
	break;
}

$result = $db->query("SELECT r.*, uu.username, i.active
											FROM ".DB_PREFIX."_report r
											LEFT JOIN ".DB_PREFIX."_users uu ON (uu.user_id=r.user_id)
											LEFT JOIN ".DB_PREFIX."_items i ON (i.id=r.x_id)
											ORDER BY ".$orderby);
while ($row = $result->fetch(PDO::FETCH_OBJ))
{
	if ($row->type == 'item')
	{
		$rowItem = $db->query("SELECT * FROM ".DB_PREFIX."_items WHERE id=".$row->x_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		$row->title = $classMain->setLangVar('title', $rowItem);
	}
	if ($row->type == 'user')
	{
		$rowUser = $db->query("SELECT * FROM ".DB_PREFIX."_users WHERE user_id=".$row->x_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		$row->report_username = $rowUser->username;
	}
	$row->date = date('d-m-Y H:i:s', $row->date);
	$classMain->dataTPLarrayList('r', $row);
}

$adminClass->OpenTableAdmin();
$classMain->tpl('report.tpl');
$adminClass->CloseTableAdmin();
?>
