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

if (!empty($_COOKIE['admin']))
{
	$aid = explode(':', base64_decode($_COOKIE['admin']));
	$aid = $aid[0];
}

$aid = substr("$aid", 0,25);
$row = $db->query("SELECT name, radminsuper FROM " . DB_PREFIX . "_authors WHERE aid='".$aid."' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
if (($row['radminsuper'] == 1) && ($row['name'] == 'God'))
{
	function displayadmins()
	{
		global $admin, $adminClass, $db, $classMain;

		if ($classMain->is_admin())
		{
			$result = $db->query("SELECT aid, name from " . DB_PREFIX . "_authors");
			while ($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				$row['a_id'] = $row['aid'];
				$classMain->dataTPLarrayList('a', $row);
			}

			$result = $db->query("SELECT * FROM ".DB_PREFIX."_funcs WHERE inmenu=1 ORDER BY custom_title ASC");
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) $classMain->dataTPLarrayList('f', $row);
		}
		else $classMain->redirect(ADMIN_FILE.'.php?error=Wykryto+nieautoryzaowaną+modyfikację+administratorów');
	}

	function updateadmin($chng_aid, $chng_name, $chng_email, $chng_url, $chng_radminsuper, $chng_pwd, $chng_pwd2, $chng_admlanguage, $adm_aid, $auth_modules)
	{
		global $admin, $adminClass, $db, $classMain;

		if ($classMain->is_admin())
		{
			$chng_aid = trim($chng_aid);

			if (!$chng_aid) $classMain->redirect(ADMIN_FILE.".php?op=mod_authors");

			if (!empty($chng_pwd2))
			{
				if($chng_pwd != $chng_pwd2) $classMain->redirect(ADMIN_FILE.'.php?op=modifyadmin&chng_aid='.$chng_aid.'&error=Podane+hasła+nie+pasują+do+siebie');

				$chng_pwd = crypt($chng_pwd);
				$chng_aid = strtolower(substr($chng_aid, 0,25));

				if ($chng_radminsuper == 1)
				{
					$result = $db->query("SELECT mid, admins FROM ".DB_PREFIX."_funcs");
					while ($row = $result->fetch(PDO::FETCH_ASSOC))
					{
						$admins = explode(",", $row['admins']);
						$adm = "";

						for ($a=0; $a < sizeof($admins); $a++) if ($admins[$a] != "$chng_name" AND !empty($admins[$a])) $adm .= "$admins[$a],";
					}

					$query = "UPDATE ".DB_PREFIX."_authors SET aid='".$chng_aid."', pwd='".$chng_pwd."' WHERE aid='".$adm_aid."'";
					$db->query($query);

					for ($i=0; $i < count($_POST['funcs']); $i++)
					{
						$row = $db->query("SELECT admins FROM ".DB_PREFIX."_funcs WHERE mid='".intval($_POST['funcs'][$i])."' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
						$adm = $row['admins'].$adm_aid.',';
						$db->query("UPDATE ".DB_PREFIX."_funcs SET admins='".$adm."' WHERE mid='".intval($_POST['funcs'][$i])."'");
					}

					$classMain->redirect(ADMIN_FILE.".php?op=mod_authors");
				}
				else
				{
					if ($chng_name != "God" AND $chng_radminsuper != 0) $db->query("update " . DB_PREFIX . "_authors set aid='".$chng_aid."', radminsuper='0', pwd='".$chng_pwd."' WHERE aid='".$adm_aid."'");

					$result = $db->query("SELECT mid, admins FROM ".DB_PREFIX."_funcs");
					while ($row = $result->fetch(PDO::FETCH_ASSOC))
					{
						$admins = explode(",", $row['admins']);
						$adm = "";
						for ($a=0; $a < sizeof($admins); $a++) if ($admins[$a] != "$chng_name" AND !empty($admins[$a])) $adm .= "$admins[$a],";

						$db->query("UPDATE ".DB_PREFIX."_authors SET radminsuper='$chng_radminsuper' WHERE aid='$adm_aid'");

						for ($i=0; $i < count($_POST['funcs']); $i++)
						{
							$row = $db->query("SELECT admins FROM ".DB_PREFIX."_funcs WHERE mid='".intval($_POST['funcs'][$i])."' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
							$adm = $row['admins'].$adm_aid.',';
							$db->query("UPDATE ".DB_PREFIX."_funcs SET admins='".$adm."' WHERE mid='".intval($_POST['funcs'][$i])."'");
						}
					}
					$classMain->redirect(ADMIN_FILE.".php?op=mod_authors");
				}
			}
			else
			{
				if ($chng_radminsuper == 1)
				{
					$result = $db->query("SELECT mid, admins FROM ".DB_PREFIX."_funcs");
					while ($row = $result->fetch(PDO::FETCH_ASSOC))
					{
						$admins = explode(",", $row['admins']);
						$adm = "";

						for ($a=0; $a < sizeof($admins); $a++) if ($admins[$a] != "$chng_name" AND !empty($admins[$a])) $adm .= "$admins[$a],";
					}

					$db->query("update " . DB_PREFIX . "_authors set aid='$chng_aid', radminsuper='$chng_radminsuper' WHERE aid='$adm_aid'");

					for ($i=0; $i < count($_POST['funcs']); $i++)
					{
						$row = $db->query("SELECT admins FROM ".DB_PREFIX."_funcs WHERE mid='".intval($_POST['funcs'][$i])."' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
						$adm = $row['admins'].$adm_aid.',';
						$db->query("UPDATE ".DB_PREFIX."_funcs SET admins='".$adm."' WHERE mid='".intval($_POST['funcs'][$i])."'");
					}

					$classMain->redirect(ADMIN_FILE.".php?op=mod_authors");
				}
				else
				{
					if ($chng_name != "God" AND $chng_radminsuper != 0) $db->query("update " . DB_PREFIX . "_authors set aid='$chng_aid', radminsuper='0' WHERE aid='$adm_aid'");

					$result = $db->query("SELECT mid, admins FROM ".DB_PREFIX."_funcs");
					while ($row = $result->fetch(PDO::FETCH_ASSOC))
					{
						$admins = explode(",", $row['admins']);
						$adm = "";
						for ($a=0; $a < sizeof($admins); $a++) if ($admins[$a] != "$chng_name" AND !empty($admins[$a])) $adm .= "$admins[$a],";

						$db->query("UPDATE ".DB_PREFIX."_authors SET radminsuper='$chng_radminsuper' WHERE aid='$adm_aid'");
					}

					for ($i=0; $i < count($_POST['funcs']); $i++)
					{
						$row = $db->query("SELECT admins FROM ".DB_PREFIX."_funcs WHERE mid='".intval($_POST['funcs'][$i])."' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
						$adm = $row['admins'].$adm_aid.',';
						$db->query("UPDATE ".DB_PREFIX."_funcs SET admins='".$adm."' WHERE mid='".intval($_POST['funcs'][$i])."'");
					}
					$classMain->redirect(ADMIN_FILE.'.php?op=mod_authors');
				}
			}
		}
		else $classMain->redirect(ADMIN_FILE.'.php?op=modifyadmin&chng_aid='.$chng_aid.'&error=Wykryto+nieautoryzowaną+zmianę+administracji');
	}

	switch ($op)
	{
		case "mod_authors":
			displayadmins();
		break;

		case "modifyadmin":

			if ($classMain->is_admin())
			{
				$dataTPL['adm_aid'] = $chng_aid;
				$dataTPL['adm_aid'] = trim($dataTPL['adm_aid']);
				$row = $db->query("SELECT aid, name, pwd, radminsuper from " . DB_PREFIX . "_authors where aid='$chng_aid'")->fetch(PDO::FETCH_ASSOC);
				$dataTPL['chng_aid'] = $row['aid'];
				$dataTPL['chng_pwd'] = $row['pwd'];
				$dataTPL['chng_radminsuper'] = intval($row['radminsuper']);
				$dataTPL['chng_aid'] = strtolower(substr($dataTPL['chng_aid'], 0,25));
				$dataTPL['aid'] = $dataTPL['chng_aid'];

				$result = $db->query("SELECT * FROM ".DB_PREFIX."_funcs WHERE inmenu=1 ORDER BY custom_title ASC");
				while ($row = $result->fetch(PDO::FETCH_ASSOC))
				{
					$row['checked'] = (preg_match("/".$dataTPL['adm_aid']."/i", $row['admins'])) ? true : false;
					$classMain->dataTPLarrayList('f', $row);
				}
			}
			else $classMain->redirect(ADMIN_FILE.'.php?error=Wykryto+nieautoryzaowaną+modyfikację+administratorów');

		break;

		case "UpdateAuthor":
			updateadmin($chng_aid, $chng_name, $chng_email, $chng_url, $chng_radminsuper, $chng_pwd, $chng_pwd2, $chng_admlanguage, $adm_aid, $auth_modules);
		break;

		case "AddAuthor":
			$add_aid = $classMain->formatSQL($_POST['add_aid']);
			$add_name = $classMain->formatSQL($_POST['add_name']);
			$add_pwd = crypt($_POST['add_pwd']);

			if (!($add_aid && $add_pwd)) $classMain->redirect(ADMIN_FILE.'.php?mod_authors&error=Błąd+przy+tworzeniu+administratora.');

			for ($i=0; $i < count($_POST['funcs']); $i++)
			{
				$row = $db->query("SELECT admins FROM ".DB_PREFIX."_funcs WHERE mid='".intval($_POST['funcs'][$i])."' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
				$adm = $row['admins'].$add_aid.',';
				$db->query("UPDATE ".DB_PREFIX."_funcs SET admins='".$adm."' WHERE mid='".intval($_POST['funcs'][$i])."'");
			}

			$result = $db->query("INSERT INTO " . DB_PREFIX . "_authors VALUES ('$add_aid', '$add_name', '$add_pwd', '0', '$add_radminsuper')");

			if (!$result)  $classMain->redirect(ADMIN_FILE.'.php?mod_authors&error=Błąd+przy+tworzeniu+administratora.');

			$classMain->redirect(ADMIN_FILE.'.php?op=mod_authors');
		break;

		case "deladmin":
			$dataTPL['del_aid'] = trim($del_aid);
		break;

		case "deladmin2":
			if ($classMain->is_admin())
			{
				$del_aid = substr("$del_aid", 0,25);
				$row2 = $db->query("SELECT name FROM ".DB_PREFIX."_authors WHERE aid='$del_aid'")->fetch(PDO::FETCH_ASSOC);

				$classMain->redirect(ADMIN_FILE.'.php?op=deladminconf&del_aid='.$del_aid);
			}
			else $classMain->redirect(ADMIN_FILE.'.php?error=Wykryto+nieautoryzaowaną+modyfikację+administratorów');

		break;

		case "deladminconf":
			$del_aid = trim($del_aid);
			$db->query("DELETE FROM ".DB_PREFIX."_authors WHERE aid='".$del_aid."' AND name!='God' LIMIT 1");
			$result = $db->query("SELECT mid, admins FROM ".DB_PREFIX."_funcs");
			while ($row = $result->fetch(PDO::FETCH_ASSOC))
			{
				$admins = explode(",", $row['admins']);
				$adm = "";
				for ($a=0; $a < sizeof($admins); $a++) if ($admins[$a] != "$del_aid" AND !empty($admins[$a])) $adm .= "$admins[$a],";
				$db->query("UPDATE ".DB_PREFIX."_funcs SET admins='$adm' WHERE mid='".intval($row['mid'])." LIMIT 1");
			}
			$classMain->redirect(ADMIN_FILE.'.php?op=mod_authors&info=Administrator+został+usunięty.');
		break;

	}

	$dataTPL['op'] = $op;

	$classMain->dataTPLarray($dataTPL);

	$adminClass->OpenTableAdmin();
	$classMain->tpl('authors.tpl');
	$adminClass->CloseTableAdmin();
}
else echo "Dostęp zabroniony";

?>
