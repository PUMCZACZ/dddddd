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

include dirname(__FILE__).'/inc/functions_main.php';

$dataStop = strtotime(date('d-m-Y'));
$dataStart = $dataStop-86399;

$result = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE level=1");
while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
	//lista subskrybentów
	$subsList = false;
	$result3 = $db->query("SELECT email FROM ".DB_PREFIX."_subscription WHERE cat_id=".$row['id']." AND status=1");
	while ($row3 = $result3->fetch(PDO::FETCH_ASSOC)) $subsList[] = $row3['email'];

	if ($subsList && is_array($subsList))
	{
		//lista przedmiotów
		$itemList = false;
		$result2 = $db->query("SELECT p.* FROM ".DB_PREFIX."_items p WHERE p.active=1 AND veryfi=1 AND start BETWEEN ".$dataStart." AND ".$dataStop." AND cat_id LIKE CONCAT ('".($row['cat_id']).".%') GROUP BY p.id ");
		while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
		{
			if ($row2['id']) $itemList .= '<li><a style="display:block; padding:5px;" href="'.$classMain->mainConfig->siteurl.'/funcs.php?name=items&amp;id='.$row2['id'].'">'.$classMain->setLangVar('title', $row).'</a></li>';
		}

		//wysyłanie emaila
		if ($itemList)
		{
			$classMain->sendEmail(
				$classMain->mainConfig->sitename.': Subskrypcja',
				array(
					'SITEURL' => $classMain->mainConfig->siteurl,
					'LOGO' => $classMain->mainConfig->siteurl.'/theme/img/logo.png',
					'SITENAME' => $classMain->mainConfig->sitename,
					'UNIQ_ID' => $row3['uniq_id'],
					'CAT_NAZWA' => $classMain->setLangVar('name', $row),
					'LISTA' => $itemList
				),
				'email_subscription.tpl',
				$subsList
			);
		}
	}
}

?>
