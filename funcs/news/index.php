<?php

/****************************************************************/
/*	UWAGA! SKRYPT NIE JEST DARMOWY.								*/
/*	DALSZE ROZPOWSZECHNIANIE BEZ ZGODY 							*/
/*	FIRMY JMLNET JEST ZABRONIONE.								*/
/****************************************************************/
/****************************************************************/
/*	PRODUCENT OPROGRAMOWANIA	JMLnet							*/
/*	NAZWA SKRYPTU:				SKRYPT AUKCYJNY					*/
/*	WERSJA:						1.01							*/
/*	KONTAKT:					INFO@JMLNET.PL					*/
/****************************************************************/
/* Copyright (c) JMLnet. Wszelkie prawa zastrzeone.				*/
/****************************************************************/

if (!defined('MODULE_FILE')) die ("<b>Dostp bezporedni zabroniony</b><br />You can't access this file directly...");

require_once 'funcs/news/classes/news.class.php';
$classNews = new news;

//dane artykulu
if(!empty($_GET['id'])) $classNews->getArticle($_GET['id']);
else $classNews->newsList();

$dataTPL = array();
$dataTPL['news'] = true;
$dataTPL['pager'] = $pag;

$classMain->dataTPLarray($dataTPL, false);

$classMain->tpl('news.tpl');

?>
