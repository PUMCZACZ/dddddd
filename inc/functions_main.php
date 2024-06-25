<?php

ini_set('display_errors', 1);
ini_set("session.cookie_lifetime", 86400);
ini_set("session.gc_maxlifetime", 86400);

#error_reporting(E_ALL);
error_reporting(E_ALL^E_NOTICE);

header("Content-Type: text/html; charset=utf8");

date_default_timezone_set('Europe/Warsaw');

session_set_cookie_params(86400, '/', '', false);
session_start();
#session_regenerate_id();

define('INCLUDE_FOLDER', 'inc');

include_once dirname(__FILE__) . '/config.php';
include_once dirname(__FILE__) . '/db_connect.php';
include_once dirname(__FILE__) . '/classes/class.main.php';
include_once dirname(__FILE__) . '/classes/class.mdules.php';
$classMain = new main;
$classModules = new modules;

include_once dirname(__FILE__) . '/../funcs/user/classes/user.class.php';
$classUser = new user;

$classMain->getConfig();
$classMain->setTemaplate();
$classMain->contentsLinks();
/*require_once 'inc/template.php';
require_once 'inc/classes/class.tpl.email.php';
$template = new template();
$emailer = new email_class();
$template->set_template();*/

//zabezpieczenie pliku functions_main.php
if (stristr(htmlentities($_SERVER['PHP_SELF']), "functions_main.php"))
{
    header("Location: index.php");
    exit;
}

//pożądkowanie adresu
if (preg_match('/funcs.php/i', $_SERVER['REQUEST_URI'])) {
	if (empty($_GET['name']) || !is_string($_GET['name'])) $error = true;
	if (isset($_GET['file']) && (empty($_GET['file']) || !is_string($_GET['file']))) $error = true;
	if (isset($_GET['id']) && !is_numeric($_GET['id'])) $error = true;
	try{
    if (isset($error) && $error == true) throw new Exception('Wystąpił błąd przetwarzania Twojego zapytania');
  } catch (Exception $e) {
    echo $e->getMessage();
    exit;
  }
}

?>
