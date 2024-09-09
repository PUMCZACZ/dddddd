<?php

//if (!defined('MODULE_FILE')) die ("<b>Dostp bezpośredni zabroniony</b><br />You can't access this file directly...");

require 'funcs/items/classes/items.class.php';
$itemsClass = new items;

$getID = $classMain->formatSQL($_GET['id'], 'int');

$itemsClass->catsList($getID);

$rowCat = $db->query("SELECT * FROM ".DB_PREFIX."_users WHERE id=".$getID." LIMIT 1")->fetch(PDO::FETCH_OBJ);

$dataTPL['company'] = $rowCat;

$classMain->dataTPLarray($dataTPL);

$classMain->tpl('company.tpl');