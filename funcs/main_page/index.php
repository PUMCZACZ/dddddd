<?php

if (!defined('MODULE_FILE')) die ("Dostep bezpośredni zabroniony...");

global $classMain, $classUser;

include_once 'funcs/main_page/classes/class.mainpage.php';
include_once 'funcs/items/classes/items.class.php';
include_once 'funcs/news/classes/news.class.php';
$classMainPage = new mainPage;
$classItems = new items;
$classNews = new news;

#$classMain->sendEmail('test', array(), 'email_register.tpl', 'tablet8260@gmail.com');

$classMainPage->siteBreak();
$classMainPage->subdomainCheck();

if (isset($_GET['watch-item']))
{
	try {
		$classItems->addWatch($_GET['watch-item'], 'item');
	} catch (Exception $e) {
		$classMain->redirect(false, 'info', $e->getMessage());
	}
}

//send message
if ($_POST['send-msg'])
{
	try{
		$classItems->sendMsg();
	} catch (Exception $e) {
		$classMain->redirect(false, 'error', $e->getMessage());
	}
}

$classNews->newsList(9);

$classItems->catsList(false, 23, false, true);

$classMainPage->slider('s', 0);
$classMainPage->slider('sm', 1);

$sqlPromo = "SELECT i.*, u.company_name, u.u_type, u.veryfi AS u_veryfi
								FROM ".DB_PREFIX."_items i
								LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
								WHERE 1 AND i.promo_mainpage=1 AND i.active=1 GROUP BY i.id";

$sql = "SELECT i.*, u.company_name, u.u_type, u.veryfi AS u_veryfi
								FROM ".DB_PREFIX."_items i
								JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
								WHERE 1 AND i.active=1 GROUP BY i.id";

$classItems->itemsList('i_p', $classMain->mainConfig->mp_promo_limit, $sqlPromo, 'RAND()');
$classItems->itemsList('i', 6, $sql, 'RAND()');
$classItems->profileList('p', 30, false, 'RAND()');

if (!$classUser->is_user()) $classMain->recaptcha();

$dataTPL = array();
$dataTPL['main-page'] = true;
$dataTPL['items_count'] = $classMain->mainConfig->items_count;
$classMain->dataTPLarray($dataTPL);

$classMain->tpl('main-page.tpl');
?>
