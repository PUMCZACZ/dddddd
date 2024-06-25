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

if (!defined('MODULE_FILE')) die ("Dostep bezpośredni zabroniony...");

if (!$classUser->is_user()) $classMain->redirect('funcs.php?name=user');

include 'funcs/items/classes/items.class.php';
$itemsClass = new items;

$op = $classMain->getOP();
$dataTPL = new stdClass();

switch ($op)
{
  case 'cats':

    if ($_GET['delete-cat']) $classUser->watchDelete($op, $_GET['delete-cat'], 'cat');

    if (isset($_GET['add-cat']))
    {
    	try {
    		$itemsClass->addWatch($_GET['add-cat'], 'cat');
    	} catch (Exception $e) {
    		$classMain->redirect('funcs.php?name=user&file=watching&op=cats', 'info', $e->getMessage());
    	}
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $db->query("UPDATE ".DB_PREFIX."_users SET watching_notifi_cats=".$classMain->formatSQL($_POST['watching_notifi_cats'], 'int')." WHERE user_id=".$classUser->userinfo->user_id." LIMIT 1");
      $classMain->redirect('funcs.php?name=user&file=watching&op=cats');
    }

    $dataTPL->watching_notifi_cats = $classUser->userinfo->watching_notifi_cats;

    $itemsClass->catsList(false, false, $classUser->watchCatsID());

  break;

  case 'users-cats':
    $classUser->watchListUsers();

    if (isset($_POST['delete-user'])) $classUser->watchDelete($op, $_POST['user_id'], 'user');

    if ($_POST['user_id'])
    {
      $user_id = $classMain->formatSQL($_POST['user_id'], 'int');
      $sql = "SELECT i.*, u.username, u.veryfi
                    FROM ".DB_PREFIX."_users_watch uiw
                    INNER JOIN ".DB_PREFIX."_items i ON (i.user_id=uiw.x_id)
                    LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
                    WHERE 1 AND uiw.user_id=".$classUser->userinfo->user_id." AND uiw.type='user' AND uiw.x_id=".$user_id;
      $itemsClass->itemsList('i', false, $sql);
      $dataTPL->user_id = $user_id;
    }

  break;

  case 'users':
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      $db->query("UPDATE ".DB_PREFIX."_users SET watching_notifi_users=".$classMain->formatSQL($_POST['watching_notifi_users'], 'int')." WHERE user_id=".$classUser->userinfo->user_id." LIMIT 1");
      $classMain->redirect('funcs.php?name=user&file=watching&op=users');
    }
    if (isset($_GET['delete'])) $classUser->watchDelete($op, $_GET['delete'], 'user');

    $dataTPL->watching_notifi_users = $classUser->userinfo->watching_notifi_users;

    $classUser->watchListUsers();
  break;

  default:
    if (isset($_GET['delete'])) $classUser->watchDelete('ads', $_GET['delete'], 'item');

    $sql = "SELECT i.*, u.username, u.veryfi
                  FROM ".DB_PREFIX."_users_watch uiw
                  INNER JOIN ".DB_PREFIX."_items i ON (i.id=uiw.x_id)
                  LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
                  WHERE 1 AND uiw.type='item' AND uiw.user_id=".$classUser->userinfo->user_id." GROUP BY uiw.x_id";

    $itemsClass->itemsList('i', false, $sql);
  break;
}

$dataTPL->op = $op;
$classMain->dataTPLarray($dataTPL);

$classMain->tpl('user-watching.tpl');
?>
