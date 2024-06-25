<?php

/****************************************************************/
/*		    UWAGA! SKRYPT NIE JEST DARMOWY.		*/
/*	          DALSZE ROZPOWSZECHNIANIE BEZ ZGODY 		*/
/*		  FIRMY JMLNET JEST ZABRONIONE.			*/
/****************************************************************/
/****************************************************************/
/*	PRODUCENT OPROGRAMOWANIA	JMLnet		     	*/
/*	NAZWA SKRYPTU:			SKRYPT RANDKOWY 1.0   	*/
/*	WERSJA:				1.01		    	*/
/*	KONTAKT:			INFO@JMLNET.PL		*/
/****************************************************************/
/* Copyright (c) 2010 JMLnet. Wszelkie prawa zastrzeżone.	*/
/****************************************************************/

if (!defined('MODULE_FILE')) die ("Dostep bezpośredni zabroniony...");

$classUser->checkIsUser();

//usuwanie zaznaczonych wiadomości
if (isset($_POST['usun']))
{
	for ($i=0; $i < count($_POST['id']); $i++) $db->query("DELETE FROM ".DB_PREFIX."_users_messages WHERE i_id=".$classMain->formatSQL($_POST['id'][$i]), 'int');
	$classMain->redirect('user/messages', 'info', 'Wiadomości zostały skasowane');
}

//otrzymane
if (isset($_GET['i_id'])) $where = " AND um.i_id=".$classMain->formatSQL($_GET['i_id'], 'int');
$query = "SELECT um.*, us.username AS sender, i.title_".$classMain->defLang." FROM ".DB_PREFIX."_users_messages um
					LEFT JOIN ".DB_PREFIX."_items i ON (i.id=um.i_id)
					LEFT JOIN ".DB_PREFIX."_users us ON (us.user_id=um.sender_id)
					WHERE (um.recipient_id=".$classUser->userinfo->user_id." OR um.sender_id=".$classUser->userinfo->user_id.")".$where."
					AND i.id IS NOT NULL
					GROUP BY um.sender_id, um.i_id
					ORDER BY um.date DESC";

$result = $db->query($query);
while ($row = $result->fetch(PDO::FETCH_OBJ))
{
	//tekst ostatniej wiadomości
	$tytul = $db->query("SELECT msg FROM ".DB_PREFIX."_users_messages WHERE (recipient_id=".$classUser->userinfo->user_id." AND sender_id=".$row->sender_id.") OR (sender_id=".$classUser->userinfo->user_id." AND recipient_id=".$row->sender_id.") ORDER BY date DESC LIMIT 1")->fetch(PDO::FETCH_OBJ);

	//szukanie nieprzeczytanej wiadomości
	$unreaded = $db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users_messages WHERE recipient_id=".$classUser->userinfo->user_id." AND sender_id=".$row->sender_id." AND i_id=".$row->i_id." AND readed=0 LIMIT 1")->fetch(PDO::FETCH_OBJ);
	$row->sender_id = ($row->sender_id == $classUser->userinfo->user_id) ? $row->recipient_id : $row->sender_id;
	#$row->sender = $row->sender_id;
	$row->data = date("Y-m-d H:i", $row->date);
	$row->unreaded = ($unreaded->count > 0);
	$row->title = $classMain->setLangVar('title', $row);

	$classMain->dataTPLarrayList('m', $row);
}

$dataTPL = array(
	'MAIL_BOX_COUNT' => $db->query("SELECT * FROM ".DB_PREFIX."_users_messages WHERE recipient_id=".$classUser->userinfo->user_id)->rowCount(),
	'MAIL_BOX' => true,
	'MAIL_BOX_UNREADED' => $db->query("SELECT * FROM ".DB_PREFIX."_users_messages WHERE recipient_id=".$classUser->userinfo->user_id." AND readed=0")->rowCount(),
);

$classMain->dataTPLarray($dataTPL);

$classMain->tpl('user-messages.tpl');
?>
