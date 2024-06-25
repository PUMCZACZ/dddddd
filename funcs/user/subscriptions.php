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

//ochrona zalogowanych
if (!$classUser->is_user()) $classMain->redirect('funcs.php?name=user');

if ($_GET['del'])
{
	$getDel = $classMain->formatSQL($_GET['del'], 'int');
	$row = $db->query("SELECT * FROM ".DB_PREFIX."_subscription WHERE id=".$getDel." AND email='".$classUser->userinfo->user_email."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
	if ($row)
	{
		$db->query("DELETE FROM ".DB_PREFIX."_subscription WHERE id=".$row->id." LIMIT 1");
		$classMain->redirect(false, 'info', 'Subskrypcja została usunięta.');
	} else $classMain->redirect(false, 'error', 'Subskrypcja nie została znaleziona.');
}

$result = $db->query("SELECT s.*, k.name_pl FROM ".DB_PREFIX."_subscription s LEFT JOIN ".DB_PREFIX."_cats k ON (k.id=s.cat_id) WHERE s.email='".$classUser->userinfo->user_email."' ORDER BY k.position ASC");
while ($row = $result->fetch(PDO::FETCH_OBJ))
{
	$row->name = $classMain->setLangVar('name', $row);
	$classMain->dataTPLarrayList('s', $row);
}

$classMain->dataTPLarray(array('SUBSKRYPCJA' => true));

$classMain->tpl('user-subscription.tpl');

?>
