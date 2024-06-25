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

define('IMG_DIR', 'img/news/');

//zapisywanie zdjecia
function saveImage($photo, $dir=false, $miniImg=true)
{
	require("inc/classes/class.upload.php");

	$dir = ($dir) ? $dir : IMG_DIR;

	$handle = new Verot\Upload\Upload($photo);

	$nazwa_zdjecia = uniqid(time());

	if ($handle->uploaded)
	{
	  if (($handle->file_src_mime == 'image/jpeg') ||
	  	($handle->file_src_mime == 'image/jpg') ||
		  ($handle->file_src_mime == 'image/gif') ||
		  ($handle->file_src_mime == 'image/png'))
			{

	    if ($handle->image_src_x >= $handle->image_src_y)
			{
	      $handle->image_resize             = true;
	      $handle->image_ratio_y            = true;
	      $handle->image_x                  = 500;
	      $handle->file_src_name_body	= $nazwa_zdjecia;
	    }
			else if ($handle->image_src_x <= $handle->image_src_y)
			{
	      $handle->image_resize             = true;
	      $handle->image_ratio_x            = true;
	      $handle->image_y                  = 500;
	      $handle->file_src_name_body	= $nazwa_zdjecia;
	    }
	    $handle->Process($dir);
	    $handle->processed;

			if ($miniImg)
			{
		    if ($handle->image_src_x >= $handle->image_src_y)
				{
		      $handle->image_resize            = true;
		      $handle->image_ratio_y           = true;
		      $handle->image_x                 = 268;
		      $handle->file_src_name_body      = 'mini_'.$nazwa_zdjecia;
		    }
				else if ($handle->image_src_x <= $handle->image_src_y)
				{
		      $handle->image_resize            = true;
		      $handle->image_ratio_x           = true;
		      $handle->image_y                 = 132;
		      $handle->file_src_name_body      = 'mini_'.$nazwa_zdjecia;
		    }
		    $handle->Process($dir);
		    $handle->processed;
			}
	    $handle->Clean();
	  }
	}
	return $nazwa_zdjecia;
}

switch($op)
{
	case 'news-upload-image':
		define(IMG_DIR, 'uploaded/news');
		$imgName = $classMain->saveFile($_FILES['file'], uniqid(), IMG_DIR);
		echo json_encode(array('location' => IMG_DIR.'/'.$imgName));
		exit;
	break;
	case 'news':
		$classMain->langsList();
		define("SITE_EDITOR", 1);
	break;

	case 'news-add':
		$photo = saveImage($_FILES['photo']);

		$result = $db->query("INSERT INTO ".DB_PREFIX."_news (
									photo,
									date,
									meta_desc,
									meta_keywords
								) VALUES (
									'".$photo."',
									".time().",
									'".$classMain->formatSQL($_POST['meta_desc'])."',
									'".$classMain->formatSQL($_POST['meta_keywords'])."'
								)");

		$id = $db->lastInsertId();

		$classMain->saveLangsData($_POST, 'title', 'id', $id, 'news');
		$classMain->saveLangsData($_POST, 'text_intro', 'id', $id, 'news');
		$classMain->saveLangsData($_POST, 'text', 'id', $id, 'news');

		$classMain->redirect(ADMIN_FILE.'.php?op=news-list&info=Artykuł+został+dodany');
	break;

	case 'news-list':
		$result = $db->query("SELECT * FROM ".DB_PREFIX."_news ORDER BY date DESC");
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$row['photo'] = glob("img/news/mini_".$row['photo'].".*");
			$row['photo'] = ($row['photo'][0] && file_exists($row['photo'][0])) ? $row['photo'][0] : false;
			$row['title'] = $classMain->setLangVar('title', $row);
			$row['text_intro'] = strip_tags($classMain->setLangVar('text_intro', $row));
			$row['date'] = date('d-m-Y', $row['date']);
			$classMain->dataTPLarrayList('a', $row);
		}
	break;

	case 'news-edit':
		$row = $db->query("SELECT * FROM ".DB_PREFIX."_news WHERE id=".$classMain->formatSQL($_GET['id'], 'int')." LIMIT 1")->fetch(PDO::FETCH_ASSOC);
		$row['photo'] = ($row['photo']) ? glob(IMG_DIR.'mini_'.$row['photo'].".*") : false;
		$row['photo'] = ($row['photo'][0] && file_exists($row['photo'][0])) ? $row['photo'][0] : false;

		$classMain->langsList('langs', array('title', 'text_intro', 'text'), $row);

		define("SITE_EDITOR", 1);
		$classMain->dataTPLarray($row);
	break;

	case "news-save":
		if (is_array($_FILES['photo']))
		{
			$photo = saveImage($_FILES['photo']);
			$query = " photo='".$photo."',";
		}

		$db->query("UPDATE ".DB_PREFIX."_news SET".$query." meta_desc='".$classMain->formatSQL($_POST['meta_desc'])."', meta_keywords='".$classMain->formatSQL($_POST['meta_keywords'])."' WHERE id=".$classMain->formatSQL($_POST['id'], 'int')." LIMIT 1");

		$classMain->saveLangsData($_POST, 'title', 'id', $_POST['id'], 'news');
		$classMain->saveLangsData($_POST, 'text_intro', 'id', $_POST['id'], 'news');
		$classMain->saveLangsData($_POST, 'text', 'id', $_POST['id'], 'news');

		$classMain->redirect(ADMIN_FILE.'.php?op=news-list&info=Artykuł+został+zaktualizowany#start');
	break;

	case "news-photo-delete":
		$row = $db->query("SELECT id, photo FROM ".DB_PREFIX."_news WHERE id=".$classMain->formatSQL($_GET['id'], 'int')." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

		//srednie
		$photo_srednie = glob("images/news/srednie_".$row['photo'].".*");
		//mini
		$photo_mini = glob("images/news/mini_".$row['photo'].".*");

		if (file_exists($photo_srednie[0])) unlink($photo_srednie[0]);
		if (file_exists($photo_mini[0])) unlink($photo_mini[0]);

		$result = $db->query("update " . DB_PREFIX . "_news set photo='' WHERE id=".$row['id']." LIMIT 1");

		$classMain->redirect(ADMIN_FILE.'.php?op=news-edit&id='.$row['id']);
	break;

	case 'news-delete':
		$row = $db->query("SELECT id, photo FROM ".DB_PREFIX."_news where id=".intval($classMain->formatSQL($_GET['id']))." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

		//srednie
		$photo_srednie = glob("images/news/srednie_".$row['photo'].".*");
		//mini
		$photo_mini = glob("images/news/mini_".$row['photo'].".*");

		if (file_exists($photo_srednie[0])) unlink($photo_srednie[0]);
		if (file_exists($photo_mini[0])) unlink($photo_mini[0]);

		$result = $db->query("DELETE FROM ".DB_PREFIX."_news WHERE id=".$row['id']." LIMIT 1");

		if ($result) $classMain->redirect(ADMIN_FILE.'.php?op=news-list&info=Artykuł+został+usunięty#start');
	break;
}

$classMain->dataTPLarray(array(
						'OP' => $classMain->formatSQL($_GET['op']),
));

$adminClass->OpenTableAdmin();
$classMain->tpl('news.tpl');
$adminClass->CloseTableAdmin();
?>
