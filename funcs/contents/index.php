<?php

if (!defined('MODULE_FILE')) die ("Dostep bezpośredni zabroniony...");

global $classMain;

$dataTPL = $db->query("SELECT * FROM ".DB_PREFIX."_contents WHERE id=".$classMain->formatSQL($_GET['id'], 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);

$dataTPL->contents = true;
$dataTPL->text = nl2br(htmlspecialchars_decode($classMain->setLangVar('text', $dataTPL)));
$dataTPL->title = $classMain->setLangVar('title', $dataTPL);
$dataTPL->meta_desc = $classMain->setLangVar('meta_desc', $dataTPL);
$dataTPL->meta_keywords = $classMain->setLangVar('meta_keywords', $dataTPL);
$classMain->dataTPLarray($dataTPL, false);

$classMain->tpl('contents.tpl');
?>
