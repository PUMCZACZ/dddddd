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
/* Copyright (c) JMLnet. Wszelkie prawa zastrzeżone.		*/
/****************************************************************/

if (!defined('MODULE_FILE')) die ("<b>Dostęp bezpośredni zabroniony</b><br />You can't access this file directly...");

$classUser->checkIsUser();

define('CV_UPLOAD_FOLDER', 'uploaded/items/cv');

include_once 'funcs/items/classes/items.class.php';
$classItems = new items;

$getID = $classMain->formatSQL($_GET['id'], 'int');
$getIID = $classMain->formatSQL($_GET['i_id'], 'int');

//pobieranie załącznika
if ($_GET['dwnld'])
{
	$dwnld = $classMain->formatSQL($_GET['dwnld'], 'int');
	$row = $db->query("SELECT * FROM ".DB_PREFIX."_users_messages WHERE id=".$dwnld." AND (recipient_id=".$classUser->userinfo->user_id." OR sender_id=".$classUser->userinfo->user_id.") LIMIT 1")->fetch(PDO::FETCH_OBJ);

	if ($row->att && $row->att_token)
	{
		$file = 'uploaded_users_messages/'.date('Y/m/d/', $row->data).$row->att_token;
		if (file_exists($file))
		{
			header("Content-type: ".mime_content_type($file)."");
			header("Content-Length: " . filesize($file));
			header('Content-Disposition: attachment; filename="'.$row->att.'"');
			readfile($file);
			exit;
		}
		else $classMain->redirect('funcs.php?name=user&file=messages_show&id='.$getID.'&i_id='.$getIID, 'error', 'Nie można pobrać załącznika');
	}
	else $classMain->redirect('funcs.php?name=user&file=messages_show&id='.$getID.'&i_id='.$getIID, 'error', 'Nie można pobrać załącznika');
}

//wysyłanie wiadomości
if ($_POST['odpowiedz'])
{
	$classItems->sendMsg(false, $getID);
	$classMain->redirect('funcs.php?name=user&file=messages_show&id='.$getID.'&i_id='.$getIID, 'info', 'Twoja+wiadomość+została+wysłana.');
}

//lista wiadomości
$query = "SELECT um.* FROM ".DB_PREFIX."_users_messages um
											WHERE (
												(sender_id=".$getID." AND recipient_id=".$classUser->userinfo->user_id.")
												OR (recipient_id=".$getID." AND sender_id=".$classUser->userinfo->user_id."))
												AND i_id=".$getIID."
											ORDER BY date ASC";
$result = $db->query($query);
if ($result->rowCount() === 0) $classMain->redirect('funcs.php?name=user&file=messages', 'error', 'Wybrana wiadomość nie istnieje');

while ($row = $result->fetch(PDO::FETCH_OBJ))
{
	$attachmen = CV_UPLOAD_FOLDER.'/'.$row->attachment;
	$row->sender = $classUser->getUsername($row->sender_id);
	$row->is_sender = ($row->sender_id == $classUser->userinfo->user_id);
	$row->right = ($row->sender_id != $classUser->userinfo->user_id);
	$row->msg = nl2br($row->msg);
	$row->date = date('d-m-Y H:i', $row->date);
	$row->readed = ($row->readed) ? date('d-m-Y H:i', $row->readed) : false;
	$row->attachment = ($row->attachment && file_exists($attachmen)) ? $attachmen : false;
	$classMain->dataTPLarrayList('m', $row);

	if ($row->readed == 0) $db->query("UPDATE ".DB_PREFIX."_users_messages SET readed=".time()." WHERE id=".$row->id." AND recipient_id=".$classUser->userinfo->user_id." LIMIT 1");
}

//informacja wiadomości
$query = "SELECT i.id, i.dir, i.title_".$classMain->defLang." FROM ".DB_PREFIX."_users_messages um
																			LEFT JOIN ".DB_PREFIX."_items i ON (i.id=um.i_id)
																			WHERE (
																			(sender_id=".$getID." AND recipient_id=".$classUser->userinfo->user_id.") OR
																			(recipient_id=".$getID." AND sender_id=".$classUser->userinfo->user_id.")) AND
																			i_id=".$getIID."
																			ORDER BY um.date ASC";
$row = $db->query($query)->fetch(PDO::FETCH_OBJ);
$row->title = $classMain->setLangVar('title', $row);

$dataTPL = array(
	'id' => $getID,
	'i_id' => $row->id,
	'item_url' => $classItems->itemHref($row->id, $row->title, false),
	'photo' => $classItems->getImageMain($row->id, $row->dir, 'small'),
	'title' => $row->title
);

$classMain->dataTPLarray($dataTPL);

$classMain->tpl('user-messages-show.tpl');

?>
