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

if (!defined('ADMIN_FILE')) die ('Access Denied');

switch($op)
{
  case 'translate':
  case 'translate-cats':
  case 'translate-options':
  case 'translate-parms':
  case 'translate-parms-list':
    include 'admin/mods/translate.php';
  break;

  case 'items':
  case 'item-edit':
    include 'admin/mods/items.php';
  break;

  case 'items-filters':
    include 'admin/mods/items-filters.php';
  break;

  case 'calendar':
    include 'admin/mods/calendar.php';
  break;

  case 'slider':
    include 'admin/mods/slider.php';
  break;

  case 'cats':
  case 'cats-profiles':
    include 'admin/mods/cats.php';
  break;

  case 'report':
    include 'admin/mods/report.php';
  break;

  case 'payments':
  case 'payments-end':
    include 'admin/mods/payments.php';
  break;

  case 'select-options':
  case 'tax-values':
    include 'admin/mods/select_options.php';
  break;

  case 'prices-stats':
  case 'prices-members':
  case 'prices-else':
  case 'promo-codes':
  case 'prices-items-promo':
  case 'prices-sms':
  case 'prices-add-cls':
  case 'prices-add-offer':
    include 'admin/mods/prices.php';
  break;

  case 'news':
  case 'news-list':
  case 'news-add':
  case 'news-edit':
  case 'news-save':
  case 'news-photo-delete':
  case 'news-delete':
  case 'news-upload-image':
  	include 'admin/mods/news.php';
  break;

  case 'mod_authors':
  case 'modifyadmin':
  case 'UpdateAuthor':
  case 'AddAuthor':
  case 'deladmin2':
  case 'deladmin':
  case 'assignstories':
  case 'deladminconf':
    include 'admin/mods/authors.php';
  break;

  case 'backup':
  	include 'admin/mods/backup.php';
  break;

	case 'prices':
	  include 'admin/mods/prices.php';
  break;

	case 'modules':
	case 'module_status':
	case 'module_edit':
	case 'module_edit_save':
	case 'home_module':
		include 'admin/mods/modules.php';
	break;

	case 'emailing':
	case 'emailing-planning':
	case 'emailing-sended':
  case 'emailing-edit':
  case 'emailing-themes':
		include 'admin/mods/emailing.php';
	break;

  case 'ipban':
  case 'save_banned':
  case 'ipban_delete':
  case 'ipban_edit':
  case 'ipban_save':
    include 'admin/mods/ipban.php';
  break;

  case 'contact':
    include 'admin/mods/contact.php';
  break;

  case 'select_options':
    include 'admin/mods/select_options.php';
  break;

  case 'optimize':
    include 'admin/mods/optimize.php';
  break;

  case 'help':
    include 'admin/mods/help.php';
  break;

  case 'pages':
  case 'pages-upload-image':
    include 'admin/mods/pages.php';
  break;

  case 'adv':
  case 'adv-positions':
  case 'adv-edit':
    include 'admin/mods/adv.php';
  break;

	case 'settings':
	case 'settings-mail':
  case 'settings-prices':
	case 'settings-session':
  case 'settings-users':
  case 'settings-items':
  case 'settings-member':
		include 'admin/mods/settings.php';
	break;

	case 'user':
  case 'user-edit':
  case 'user-photos':
    include 'admin/mods/users.php';
  break;

  case 'operations':
    include 'admin/mods/operations.php';
  break;
}

?>
