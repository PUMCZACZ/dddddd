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

define('ADMIN_PANEL', true);

#if ($_SERVER['REMOTE_ADDR'] != '194.88.225.211') die("Dostęp zabroniony");

require 'inc/functions_main.php';

extract($_GET, EXTR_OVERWRITE);
extract($_POST, EXTR_OVERWRITE);
extract($_COOKIE, EXTR_OVERWRITE);

if (!empty($_COOKIE['admin']))
{
	$aid = explode(':', base64_decode($_COOKIE['admin']));
	$aid = $classMain->formatSQL($aid[0]);
}

if(isset($_POST['aid']))
{
	if(!empty($_POST['aid']) AND (!isset($_POST['admin']) OR empty($_POST['admin'])) AND $_POST['op']!='login')
	{
		unset($_POST['aid']);
		unset($_POST['admin']);
		die("Dostęp zabroniony");
	}
}

require("admin/admin.class.php");
$adminClass = new adminClass;

$checkurl = $_SERVER['REQUEST_URI'];
#if((stripos_clone($checkurl,'AddAuthor')) OR (stripos_clone($checkurl,'VXBkYXRlQXV0aG9y')) OR (stripos_clone($checkurl,'QWRkQXV0aG9y')) OR (stripos_clone($checkurl,'UpdateAuthor')) OR (stripos_clone($checkurl, "?admin")) OR (stripos_clone($checkurl, "&admin"))) die("Niedozwolona operacja");

if (isset($_POST['aid']) && (preg_match("/^[_\.0-9a-zA-Z-]$/i",trim($_POST['aid'])))) die("Begone");
if (isset($_POST['aid'])) { $_POST['aid'] = $classMain->formatSQL(substr($_POST['aid'], 0,25));}
if (isset($_POST['pwd'])) { $_POST['pwd'] = $classMain->formatSQL(substr($_POST['pwd'], 0,40));}
$op = (!empty($_POST['op'])) ? $classMain->formatSQL($_POST['op']) : $classMain->formatSQL($_GET['op']);

if ((isset($_POST['aid'])) && (isset($_POST['pwd'])) && (isset($op)) && ($op == "login"))
{
	if(!empty($_POST['aid']) AND !empty($_POST['pwd']))
	{
		#try{
		#	$classMain->checkReCaptcha();
	#	} catch (Exception $e) {
		#	$classMain->redirect(ADMIN_FILE.'.php', 'error', 'Weryfikacja reCaptcha negatywna.');
		#}

		require_once 'inc/nocsrf.php';
		try {
			NoCSRF::check('csrf_token', $_POST, true, 60*10, false);

			$row = $db->query("SELECT aid, pwd FROM ".DB_PREFIX."_authors WHERE aid='".$classMain->formatSQL($_POST['aid'])."'")->fetch(PDO::FETCH_ASSOC);

			if (crypt($_POST['pwd'], $row['pwd']) == $row['pwd'])
			{
				$admin = base64_encode($row['aid'].':'.$row['pwd']);
				setcookie("admin", $admin, time()+$classMain->mainConfig->session_admin, '', '', false, true);
				unset($op);
			}
		} catch (Exception $e) {
			#$result = $e->getMessage() . ' Form ignored.';
			$classMain->redirect(ADMIN_FILE.'.php', 'error', $e->getMessage());
		}
	}
}

$admintest = 0;

if(isset($admin) && !empty($admin))
{
	$admin = addslashes(base64_decode($admin));
	$admin = explode(":", $admin);
	$_POST['aid'] = $classMain->formatSQL(addslashes($admin[0]));
	$_POST['pwd'] = $classMain->formatSQL($admin[1]);
	if (empty($_POST['aid']) OR empty($_POST['pwd']))
	{
		$admintest=0;
		$alert = "<html>\n";
		$alert .= "<title>UWAGA INTRUZ!!!</title>\n";
		$alert .= "<body bgcolor=\"#FFFFFF\" text=\"#000000\">\n\n<br><br><br>\n\n";
		$alert .= "<center><img src=\"images/loading.gif\" border=\"0\"><br><br>\n";
		$alert .= "<font face=\"Verdana\" size=\"+4\"><b>Prosimy opuścić tą stronę!</b></font></center>\n";
		$alert .= "</body>\n";
		$alert .= "</html>\n";
		die($alert);
	}
	$_POST['aid'] = substr($_POST['aid'], 0,25);
	$result2 = $db->query("SELECT aid, name, pwd FROM ".DB_PREFIX."_authors WHERE aid='".$_POST['aid']."' LIMIT 1");
	if (!$result2) die("Błąd pobierania danych z bazy danych!");
	else
	{
		$row = $result2->fetch(PDO::FETCH_ASSOC);
		if($row['pwd'] == $_POST['pwd'] && !empty($row['pwd']))
		{
			$admintest = 1;
			$admin = base64_encode($row['aid'].':'.$row['pwd']);
			setcookie("admin", $admin, (time()+$classMain->mainConfig->session_admin), '', '', false, true);
		}
		$rname = $row['name'];
	}
}

if (empty($op)) $op = "adminMain";
elseif(($op=="mod_authors" OR $op=="modifyadmin" OR $op=="UpdateAuthor" OR $op=="AddAuthor" OR $op=="deladmin2" OR $op=="deladmin" OR $op=="assignstories" OR $op=="deladminconf") AND ($rname != "God")) die("Niedozwolona operacja");

$pagetitle = "- menu administracyjne";

//fitlracja monitów dla użytkowników
$getError = $classMain->showMessage('error');
$getInfo = $classMain->showMessage('info');

$classMain->dataTPLarray(array(
			'ERROR' => (!empty($getError)) ? $getError : '',
			'INFO' => (!empty($getInfo)) ? $getInfo : ''
));

if ($admintest)
{
	switch($op)
	{
		case "GraphicAdmin":
			$adminClass->GraphicAdmin();
		break;

		case "adminMain":
			$adminClass->adminMain();
		break;

		case "logout":

			setcookie("admin", false);

			echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
			echo '<meta http-equiv="refresh" content="3; URL='.ADMIN_FILE.'.php">';
			echo '<LINK REL="StyleSheet" HREF="theme/style.css" TYPE="text/css">';
			$admin = "";
			echo '<h3>Zostałeś wylogowany</h3>';
		break;

		case "login";

		unset($op);

		default:

			if (!$classMain->is_admin()) $adminClass->login();

			$rowInfoAdmin = array();
			$classMain->dataTPLarray($rowInfoAdmin);

			include 'admin/case.php';

		break;
	}
}
else
{
	switch($op)
	{
		default:
			$adminClass->login();
		break;
	}
}

?>
