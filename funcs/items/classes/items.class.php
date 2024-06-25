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

class items extends main
{
	const FOLDER_IMAGES = 'uploaded/items/';
	const IMAGES_DEFAULT = 'theme/img/item-big-pic.png';
	const CV_UPLOAD_FOLDER = 'uploaded/items/cv';

	public function __construct()
	{
		global $db, $classMain, $classUser;

		$this->db = $db;
		$this->classMain = $classMain;
		$this->classUser = $classUser;
		$this->catsDBname = ($_GET['type'] == 'companies') ? '_cats_profiles' : '_cats';
		parent::getConfig();
	}

	public function infoMsg($var)
	{
		$infoMsg = array(
		'REPORT_SEND' => $this->classMain->_LANG['REPORT_SEND'],
		'MSG_SEND' => $this->classMain->_LANG['MSG_SEND'],
		'MSG_SUBJECT' => $this->classMain->_LANG['MSG_SUBJECT'],
		'ITEM_ADD' => $this->classMain->_LANG['ITEM_ADD'],
		'ITEM_UPDATE' => $this->classMain->_LANG['ITEM_UPDATE'],
		'WATCH_ADDED_ITEM' => $this->classMain->_LANG['WATCH_ADDED_ITEM'],
		'WATCH_ADDED_USER' => $this->classMain->_LANG['WATCH_ADDED_USER'],
		'ITEM_DELETED' => $this->classMain->_LANG['ITEM_DELETED'],
		'ITEM_SHOW' => $this->classMain->_LANG['ITEM_SHOW'],
		'ITEM_HIDE' => $this->classMain->_LANG['ITEM_HIDE'],
		'ITEM_UNACTIVE' => $this->classMain->_LANG['ITEM_UNACTIVE'],
		'ITEM_DISTINCTION' => $this->classMain->_LANG['ITEM_DISTINCTION'],
		'ITEM_BIDS' => $this->classMain->_LANG['ITEM_BIDS'],
		'REPORT_SUBJECT' => $this->classMain->_LANG['REPORT_SUBJECT'],
		'ITEM_OFFER_ADD' => $this->classMain->_LANG['ITEM_OFFER_ADD'],
		'ITEM_OFFER_EDIT' => $this->classMain->_LANG['ITEM_OFFER_EDIT'],
		'MSG_ADD_OFFER_SUBJECT_CONFIRM' => $this->classMain->_LANG['MSG_ADD_OFFER_SUBJECT_CONFIRM'],
		'ITEM_ADD_USER_REG' => $this->classMain->_LANG['REGISTER_END']
		);
		return $infoMsg[$var];
	}
	public function errorMsg($var)
	{
		$errorMsg = array(
		'PROFILE_EMPTY' => $this->classMain->_LANG['PROFILE_EMPTY'],
		'MEMBER_EMPTY' => $this->classMain->_LANG['MEMBER_EMPTY'],
		'PERMISSION_LOGIN' => $this->classMain->_LANG['PERMISSION_LOGIN'],
		'PERMISSION_MEMBER' => $this->classMain->_LANG['PERMISSION_MEMBER'],
		'ADD_EMPTY_CAT' => $this->classMain->_LANG['ADD_EMPTY_CAT'],
		'ADD_EMPTY_LANGS' => $this->classMain->_LANG['ADD_EMPTY_LANGS'],
		'ADD_EMPTY_TITLE' => $this->classMain->_LANG['ADD_EMPTY_TITLE'],
		'ADD_EMPTY_DESC' => $this->classMain->_LANG['ADD_EMPTY_DESC'],
		'ADD_EMPTY_PRICE' => $this->classMain->_LANG['ADD_EMPTY_PRICE'],
		'ADD_EMPTY_QTY' => $this->classMain->_LANG['ADD_EMPTY_QTY'],
		'WATCH_USER_USER' => $this->classMain->_LANG['WATCH_USER_USER'],
		'MUST_LOGIN' => $this->classMain->_LANG['MUST_LOGIN']
		);
		return $errorMsg[$var];
	}

	public function setAddDefaultData()
	{
		if (empty($_SESSION['add']) && $this->classUser->is_user())
		{
			$row = $this->db->query("SELECT country, city, address, phone FROM ".DB_PREFIX."_items WHERE user_id=".$this->classUser->userinfo->user_id." ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_OBJ);
			$_SESSION['add'] = (array)$row;
			$_SESSION['add']['user_email'] = $this->classUser->userinfo->user_email;
		}
	}

	public function checkUserOffer($i_id)
	{
		$i_id = $this->formatSQL($i_id, 'int');
		$row = $this->db->query("SELECT offer_price, offer_price_type, offer_desc FROM ".DB_PREFIX."_items_offers WHERE user_id=".$this->classUser->userinfo->user_id." AND i_id=".$i_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);

		if ($row) $this->classMain->dataTPLarray($row);
	}

	public function itemsType($type)
	{
		$type = $this->formatSQL($type);
		switch($type) {
			case 'companies':
				return 'companies';
			break;
			default:
				return false;
			break;
		}
	}

	public function editOffer($user_id, $i_id, $offer_price=false, $offer_price_type=false, $offer_desc)
	{
		if (!$this->classUser->is_user())
		{
			$this->saveRedirect();
			$this->classMain->redirect('funcs.php?name=user', 'error', $this->errorMsg('PERMISSION_LOGIN'));
		}

		$user_id = $this->formatSQL($user_id, 'int');
		$i_id = $this->formatSQL($i_id, 'int');
		$offer_price = str_replace(array(',', ' '), array('.', ''), $this->formatSQL($offer_price));
		$offer_price_type = $this->formatSQL($offer_price_type);
		$offer_desc = $this->formatSQL($offer_desc);

		$row = $this->db->query("SELECT id FROM ".DB_PREFIX."_items_offers WHERE i_id=".$i_id." AND user_id=".$user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);

		$this->db->query("UPDATE ".DB_PREFIX."_items_offers SET
			user_id=".$user_id.",
			i_id=".$i_id.",
			offer_price='".$offer_price."',
			offer_price_type='".$offer_price_type."',
			offer_desc='".$offer_desc."'
			WHERE id=".$row->id." LIMIT 1
		");

		$this->sendOfferAddInfo(time(), $offer_price, $offer_price_type, true);

		throw new Exception($this->infoMsg('ITEM_OFFER_EDIT'));
	}

	public function addOffer($user_id, $i_id, $offer_price=false, $offer_price_type=false, $offer_desc)
	{
		$user_id = $this->formatSQL($user_id, 'int');
		$i_id = $this->formatSQL($i_id, 'int');
		$offer_price = str_replace(array(',', ' '), array('.', ''), $this->formatSQL($offer_price));
		$offer_price_type = $this->formatSQL($offer_price_type);
		$offer_desc = $this->formatSQL($offer_desc);

		$this->db->query("INSERT INTO ".DB_PREFIX."_items_offers VALUES (
			NULL,
			".$user_id.",
			".$i_id.",
			'".$offer_price."',
			'".$offer_price_type."',
			'".$offer_desc."',
			".time()."
		)");

		$this->sendOfferAddInfo(time(), $offer_price, $offer_price_type);

		throw new Exception($this->infoMsg('ITEM_OFFER_ADD'));
	}

	private function sendOfferAddInfo($addDate, $offer_price=false, $offer_price_type=false, $edit=false)
	{
		$this->setMsgItemData();
		$this->setMsgEmail();
		$this->setMsgSenderEmail();
		$this->setMsgSender();

		$this->itemData->offer = $offer_price;
		$this->itemData->offer_type = $offer_price_type;
		$this->itemData->date_offer = date('d-m-Y H:i', $addDate);
		$this->itemData->date_end = date('d-m-Y H:i', $this->itemData->end);
		$this->itemData->edit = $edit;

		$this->classMain->sendEmail(
			$this->infoMsg('MSG_ADD_OFFER_SUBJECT_CONFIRM'),
			$this->itemData,
			'email_item_offer.tpl',
			$this->msgEmail, $sender,
			$this->msgSenderName
		);
	}

	public function promoPrices($type, $selected, $onlyPrice=false)
	{
		switch($onlyPrice) {
			case true:
				$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_config_prices WHERE value_type='".$type."' AND extra='".$selected."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
				return $row->value_from;
			break;
			case false:
				$no = 1;
				$result = $this->db->query("SELECT cp.*
					FROM ".DB_PREFIX."_config_prices cp
					LEFT JOIN ".DB_PREFIX."_select_options so ON (cp.extra=so.name_".$this->classMain->defLang.")
					WHERE so.name_tech='item_time' AND cp.value_type='".$type."' ORDER BY ABS(cp.extra) ASC");
				while ($row = $result->fetch(PDO::FETCH_OBJ))
				{
					$row->selected = (($row->extra == $selected) || (empty($selected) && $no == 1));
					$this->classMain->dataTPLarrayList($type, $row);
					$no++;
				}
				$this->promoInfo($type);
			break;
		}
	}

	private function promoInfo($type)
	{
		$promoInfo = unserialize($this->mainConfig->promo_info);
		$dataTPL['name_'.$type] = $promoInfo['promo_name'][$type];
		$dataTPL['text_'.$type] = $promoInfo['promo_text'][$type];
		$this->classMain->dataTPLarray($dataTPL);
	}

	public function getChildCategories()
	{
		global $template;

		if (isset($_REQUEST))
		{
			$id = $this->formatSQL($_REQUEST['parent_id'], 'int');
			$name = ($_REQUEST['name_id']) ? $this->formatSQL($_REQUEST['name_id']) : 'cat_id[]';
			$type = ($_REQUEST['type']) ? $this->formatSQL($_REQUEST['type']) : false;

			if (empty($id)) exit;

			$query = "SELECT * FROM ".DB_PREFIX.$this->catsDBname." WHERE left_id=".$id." ORDER BY position ASC";

			$results  = $this->db->query($query);
			$num_rows = $results->rowCount();

			if($num_rows > 0)
			{
				$this->classMain->dataTPLarray(array(
					'name' => $name,
					'type' => $type
				));
				while ($row = $results->fetch(PDO::FETCH_OBJ))
				{
					$row->name = $this->classMain->setLangVar('name', $row);
					$this->classMain->dataTPLarrayList('c', $row);
				}

				$this->classMain->tpl('tpl_get_categories.tpl');
			} else exit;
		}
		exit;
	}

	public function setDateRange()
	{
		return date('d/m/Y').' - '.date('d/m/Y', $this->classUser->memberInfo('time_time'));
	}
	public function addPermission()
	{
		$this->saveRedirect();
		if ($this->mainConfig->item_login && !$this->classUser->is_user()) $this->classMain->redirect('funcs.php?name=user', 'error', $this->errorMsg('PERMISSION_LOGIN'));
		if ($this->mainConfig->item_member == 1 && !$this->classUser->is_member()) $this->classMain->redirect('funcs.php?name=user&file=member', 'error', $this->errorMsg('PERMISSION_MEMBER'));
		if ($this->mainConfig->item_login == 0 && !$this->classUser->is_user()) $this->classMain->recaptcha();
	}
	private function checkMemberPosition($type='ads', $user_id=0, $i_id=0)
	{
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_member_data WHERE user_id=".$user_id." AND type='".$type."' AND i_id=".$i_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		return ($row) ? true : false;
	}
	private function addMemberPosition($type='ads', $user_id=0, $i_id=0)
	{
		if (!$this->classUser->is_user()) return false;
		$memberData = $this->getMemberData($type, $user_id);

		$this->db->query("INSERT INTO ".DB_PREFIX."_users_member_data VALUES (
			NULL,
			".$user_id.",
			".$memberData->id.",
			".$i_id.",
			'".$type."',
			".time().",
			'".$_SERVER['REMOTE_ADDR']."'
		)");
		switch ($type)
		{
			case 'ads':
				$this->db->query("UPDATE ".DB_PREFIX."_items SET active=1 WHERE id=".$i_id." LIMIT 1");
			break;
		}
	}

	private function getMemberData($type='ads', $user_id=0)
	{
		$row = $this->db->query("SELECT us.id
															FROM ".DB_PREFIX."_users_member us
															LEFT JOIN ".DB_PREFIX."_member_periods mp ON (mp.id=us.m_id)
															LEFT JOIN ".DB_PREFIX."_member m ON (m.id=mp.m_id)
															WHERE us.user_id=".$user_id." ORDER BY us.id DESC LIMIT 1")->fetch(PDO::FETCH_OBJ);
		return $row;
	}

	public function checkItemVisible()
	{
		$id = $this->classMain->formatSQL($_GET['id'], 'int');
		$row = $this->db->query("SELECT user_id, active, save_only FROM ".DB_PREFIX."_items WHERE id=".$id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if (!$row || (($row->save_only == 1 || $row->active == '0' || $row->veryfi == '0') && !$this->classMain->is_admin()))
		{
			if($this->classUser->userinfo->user_id != $row->user_id) $this->classMain->redirect('index.php', 'error', $this->infoMsg('ITEM_UNACTIVE'));
			if (!$row) $this->classMain->redirect('index.php', 'error', $this->infoMsg('ITEM_UNACTIVE'));
		}
	}

	public function actualLink()
	{
		return 'funcs.php?'.$_SERVER['QUERY_STRING'];
	}

	public function addWatch($id, $type)
	{
		global $classUser;

		if (!$classUser->is_user())
		{
			$this->saveRedirect();
			$this->redirect('funcs.php?name=user', 'info', $this->errorMsg('MUST_LOGIN'));
		}
		else
		{
			$id = $this->formatSQL($id, 'int');

			switch($type)
			{
				case 'item':
					$row = $this->db->query("SELECT user_id FROM ".DB_PREFIX."_items WHERE id=".$id." AND user_id=".$classUser->userinfo->user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
					$msg = 'WATCH_ADDED_ITEM';
				break;
				case 'user':
					if ($id == $classUser->userinfo->user_id) $row = true;
					$msg = 'WATCH_ADDED_USER';
				break;
			}

			if ($row) throw new Exception($this->errorMsg('WATCH_USER_USER'));
			else
			{
				$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_watch WHERE user_id=".$classUser->userinfo->user_id." AND type='".$type."' AND x_id=".$id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
				if (empty($row)) $this->db->query("INSERT INTO ".DB_PREFIX."_users_watch VALUES (NULL, ".$classUser->userinfo->user_id.", '".$type."', ".$id.")");
				throw new Exception($this->infoMsg($msg));
			}
		}
	}

	public function phonesList($user_id=false)
	{
		global $classUser;
		$user_id = ($user_id) ? $user_id : $classUser->userinfo->user_id;
		if (!$user_id) return;
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_phones WHERE user_id=".$user_id." ORDER BY number ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ)) $this->classMain->dataTPLarrayList('phones', $row);
	}

	public function changeLang($lang, $type='items')
	{
		$id = $this->formatSQL($_GET['id'], 'int');
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE name_def='".$this->formatSQL($lang)."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
		$_SESSION[$type]['langs']['id'][] = $id;
		$_SESSION[$type]['langs']['lang'][$id] = $row->name_def;

		$this->redirect(false);
	}

	public function itemHref($id, $title, $city)
	{
		#return 'funcs.php?name=items&amp;id='.$id;
		return 'funcs.php?name=items&amp;id='.$id.'&amp;title='.main::convertString($title).'&amp;city='.main::convertString($city);
	}

	private function setLang($id, $type='items')
	{
		if (is_array($_SESSION[$type]['langs']['id']) && in_array($id, $_SESSION[$type]['langs']['id'])) $this->lang = $_SESSION[$type]['langs']['lang'][$id];
	}

	private function itemOfferList($id, $tplPrefix=false)
	{
		if ($tplPrefix) $tplPrefix .= '.';
		$no = 1;
		$result = $this->db->query("SELECT io.*, u.company_name
			FROM ".DB_PREFIX."_items_offers io
			RIGHT JOIN ".DB_PREFIX."_users u ON (u.user_id=io.user_id)
			WHERE io.i_id=".$id."
			ORDER BY io.date DESC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->no = $no;
			$row->date = date('d-m-Y H:i', $row->date);
			$row->href = self::CV_UPLOAD_FOLDER.'/'.$row->file;
			$this->classMain->dataTPLarrayList($tplPrefix.'o', $row);
			$no++;
		}
	}
	public function getItemTPLdata($id)
	{
		$id = $this->formatSQL($id, 'int');
		$this->setLang($id, 'items');
		$itemData = $this->setItemData($id);
		#$this->getOfferList($id);
		$this->classMain->dataTPLarray($itemData);
		$this->getImagesTPL($id, false, $itemData->dir);
		$this->getYTTPL($id);
		$this->breadcrumb($itemData->cat_id);

		//add view
		$this->addView($id);
	}

	public function setItemData($id, $user_id=false)
	{
		global $classUser;

		if ($user_id) $queryWhere = " AND i.user_id=".$this->formatSQL($user_id, 'int');

		$row = $this->db->query("SELECT i.*, u.date_reg, u.user_id, u.username, u.user_email, u.phone AS u_phone, u.veryfi AS u_veryfi
												FROM ".DB_PREFIX."_items i
												LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
												WHERE i.id=".$id.$queryWhere." LIMIT 1"
		)->fetch(PDO::FETCH_OBJ);
		$row->image_main = $this->getImageMain($row->id, $row->dir);
		$row->title = $this->classMain->setLangVar('title', $row, $this->lang);
		$row->item_desc = htmlspecialchars_decode($this->classMain->setLangVar('description', $row, $this->lang));
		$row->date = date('d.m.Y H:i', $row->date);
		$row->date_start = date('d.m.Y', $row->start);
		$row->date_end = date('d.m.Y', $row->end);
		$row->date_reg = date('d.m.Y', $row->date_reg);
		$row->item_href = $this->itemHref($row->id, $row->title, $row->city);
		$row->avatar = $classUser->userAvatar($row->user_id);
		$row->unit = $this->optName($row->unit);
		$row->phone_lang = $this->phoneLang($row->user_id);
		$row->country = $row->country;
		$row->item = true;
		$row->from_start = $this->timeStart($row->start);
		$row->meta_keywords = $this->classMain->setLangVar('keywords', $row, $this->lang);
		$row->meta_desc = strip_tags($this->classMain->setLangVar('description', $row, $this->lang));
		$row->price = $this->itemPrice($row->price);
		#$row->user_email = $classUser->userinfo->user_email;
		$row->phone = '+48 '.str_replace(array(' ', '+48', '-'), '', $row->phone);
		$row->phone_start = substr($row->phone, 0, 7);
		$row->phone_end = chunk_split(substr($row->phone, 7), 3, ' ');
		$row->user_email_hidden = $this->obfuscate_email($row->user_email);
		$row->type_id = $row->type;
		$row->type = self::optName($row->type);
		$row->user_profile_href = $this->userProfileHref($row->user_id);

		$row->sitename_string = false;
		$row->sitename_string[] = $row->title;
		$row->sitename_string[] = $row->city;
		$row->sitename_string[] = $this->classMain->mainConfig->sitename;
		$row->sitename_string = implode(' - ', $row->sitename_string);

		$classUser->getWebitesTPL($row->user_id);

		return $row;
	}

	private function obfuscate_email($email)
	{
    $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/2);

    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);
	}

	private function timeToEnd($end) {

		$time = $end-time();

		$daysToEnd = $time/86400;
		$roundToEnd = round($daysToEnd);

		if ($roundToEnd > 0) {
			return ($roundToEnd > 1) ? $roundToEnd.' '.$this->classMain->_LANG['_LANG_535'] : $roundToEnd.' '.$this->classMain->_LANG['_LANG_536'];
		} else {
			$hToEnd = round($time/3600);
			if ($hToEnd > 0) {
				return ($hToEnd <= 5) ? '<span class="text-danger">'.$hToEnd.' '.$this->classMain->_LANG['_LANG_531'].'</span>' : $hToEnd.' '.$this->classMain->_LANG['_LANG_531'];
			} else {
				$minToEnd = round($time/60);
				if ($minToEnd > 0) {
					return '<span class="text-danger">'.$minToEnd.' '.$this->classMain->_LANG['_LANG_532'].'</span>';
				} else if ($end < time()) {
					return '<span class="text-danger">'.$this->classMain->_LANG['_LANG_533'].'</span>';
				} else {
					return '<span class="text-danger">'.$this->classMain->_LANG['_LANG_534'].'</span>';
				}
			}
		}
	}

	private function timeStart($start) {

		$time = time()-$start;

		$daysFromStart = $time/86400;
		$roundStart = round($daysFromStart);

		#return ($roundStart > 1) ? $roundStart.' '.$this->classMain->_LANG['_LANG_573'] : $roundStart.' '.$this->classMain->_LANG['_LANG_574'];
		return ($roundStart > 0) ? $roundStart.' '.$this->classMain->_LANG['_LANG_573'] : $this->classMain->_LANG['_LANG_593'];
	}

	private function itemPrice($price)
	{
		$priceArray = explode('.', $price);
		if ($priceArray[1] != '00') return number_format($price, 2, ',', ' ');
		else return number_format($priceArray[0], 0, ',', ' ');
	}

	private function phoneLang($user_id)
	{
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_phones WHERE user_id=".$user_id." AND langs LIKE '%".$this->defLang."%'");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$this->classMain->dataTPLarrayList('phones', $row);
		}
	}

	private function imageSrc($id, $dir, $photo, $size=false)
	{
		if ($size) $size = $size.'_';
		$photo = $size.$photo;
		if ($size == 'small_') $photo = str_replace('small_duze_', 'duze_', $photo);
		return self::FOLDER_IMAGES.$dir.'/'.$id.'/'.$photo;
	}

	public function getImageMain($id, $dir, $size=false)
	{
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_items_photos WHERE i_id=".$id." AND main=1 LIMIT 1")->fetch(PDO::FETCH_OBJ);
		$imgSrc = $this->imageSrc($row->i_id, $dir, $row->photo, $size);

		if ($row && file_exists($imgSrc)) return $this->classMain->mainConfig->siteurl.'/'.$imgSrc; else return $this->classMain->mainConfig->siteurl.'/'.self::IMAGES_DEFAULT;
	}

	public function getImagesTPL($id, $edit=false, $dir)
	{
		$no = 2;
		$main = ($edit) ? false : ' AND main=0';
		$result = $this->db->query("SELECT i_id, photo FROM ".DB_PREFIX."_items_photos WHERE i_id=".$id.$main." ORDER BY id ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$imgSrc = $this->imageSrc($row->i_id, $dir, $row->photo);
			$row->image = (file_exists($imgSrc)) ? $this->classMain->mainConfig->siteurl.'/'.$imgSrc : false;
			$imgMiniSrc = $this->imageSrc($row->i_id, $dir, $row->photo, 'small');
			$row->photo_small = (file_exists($imgMiniSrc)) ? $this->classMain->mainConfig->siteurl.'/'.$imgMiniSrc : false;
			$row->photo_name = $row->photo;
			$row->no = $no;
			$this->classMain->dataTPLarrayList('p', $row);
			$no++;
		}
	}

	private function getYTTPL($id)
	{
		$row = $this->db->query("SELECT yt FROM ".DB_PREFIX."_items WHERE id=".$id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row && $row->yt)
		{
			$list = explode('|', $row->yt);
			foreach ($list as $key => $value)
			{
				$rowYT['link'] = $this->YTlinkPrepare($value);
				if ($this->checkURL($rowYT['link'])) $this->classMain->dataTPLarrayList('yt', $rowYT);
			}
		}
	}
	private function YTlinkPrepare($link)
	{
		return str_replace('watch?v=', 'embed/', $link);
	}

	public function breadcrumb($id)
	{
		$queryWhere = (preg_match("/\./i", $id)) ? "ip='".$id."'" : "id=".intval($id);
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->catsDBname." WHERE ".$queryWhere." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		$nawigacja[] = $this->classMain->setLangVar('name', $row, $this->lang);
		$nawigacja_id[] = $row->id;
		$liczba = $row->level;
		for ($i=0; $i < $liczba; $i++)
		{
			$row = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->catsDBname." WHERE id=".$row->left_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
			if ($this->classMain->setLangVar('name', $row, $this->lang))
			{
				$nawigacja[] = $this->classMain->setLangVar('name', $row, $this->lang);
				$nawigacja_id[] = $row->id;
			}
		}

		$no = 0;
		for ($i=count($nawigacja); $i >= 0; $i--)
		{
			if ($nawigacja[$i])
			{
				#$data['href'] = 'funcs.php?name=items&amp;file=list&amp;id='.$nawigacja_id[$i];
				$data['href'] = self::catLink($nawigacja_id[$i], $nawigacja[$i]);
				$data['name'] = $nawigacja[$i];
				$this->classMain->dataTPLarrayList('brdcrmbs', $data, false);
			}
		}
	}

	public function sendMsg($type=false)
	{
		global $classUser;

		if (!$classUser->is_user())
		{
			try {
				$this->classMain->checkReCaptcha();
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		$this->sendMessage($type);
		$redirect = ($type == 'profile') ? 'funcs.php?name=items&file=profile&id='.main::formatSQL($_GET['id'], 'int') : false;
		$this->redirect($redirect, 'info', $this->infoMsg('MSG_SEND'));
	}

	private function setMsgItemData()
	{
		global $classUser;
		$id = $this->formatSQL($_POST['id'], 'int');
		$row = $this->db->query("SELECT i.*, u.user_email, u.lang
												FROM ".DB_PREFIX."_users u
												INNER JOIN ".DB_PREFIX."_items i ON (u.user_id=i.user_id)
												WHERE i.id=".$id." LIMIT 1"
		)->fetch(PDO::FETCH_OBJ);
		$row->title = $this->classMain->setLangVar('title', $row, $row->lang);
		$row->sender = ($classUser->is_user()) ? $classUser->userinfo->user_email : $this->formatSQL($_POST['email']);
		$row->href = $this->itemHref($row->id, $row->title, $row->city);
		$this->itemData = $row;
	}
	private function setMsgEmail()
	{
		$this->msgEmail = $this->itemData->user_email;
	}
	private function setMsgSenderEmail()
	{
		global $classUser;
		$this->msgSender = ($classUser->is_user()) ? $classUser->userinfo->user_email : $this->formatSQL($_POST['email']);
	}
	private function setMsgSender()
	{
		global $classUser;
		$this->msgSenderName = ($classUser->is_user()) ? $classUser->userinfo->username : $this->formatSQL($_POST['msg_name']);
	}
	private function saveMsgFile($i_id, $file)
	{
		$this->fileName = $this->classMain->saveFile($file, uniqid(), self::CV_UPLOAD_FOLDER);

		$sql = "INSERT INTO ".DB_PREFIX."_items_offers (user_id, i_id, file, filename, description, date) VALUES (?,?,?,?,?,?)";
		$this->db->prepare($sql)->execute([$this->classUser->userinfo->user_id, $i_id, $this->fileName, $file['name'], $_POST['msg'], time()]);
	}

	private function sendMessage($type=false)
	{
		global $classUser;
		$this->setMsgItemData();
		$this->setMsgEmail();
		$this->setMsgSender();
		$this->setMsgSenderEmail();
		$this->saveMsgFile($this->itemData->id, $_FILES['cv']);
		$this->addCharge($this->itemData->id, 'add_offer');

		#if ($classUser->is_user()) $sender = $this->msgSender;

		if ((empty($this->classMain->mainConfig->member_items_message) || $classUser->is_member($this->itemData->user_id)) && $this->classMain->mainConfig->user_mod_msg == 0)	$this->itemData->message = nl2br($this->formatSQL($_POST['msg']));
		elseif ($this->classMain->mainConfig->user_mod_msg == 1)
		{
			$this->itemData->message = $this->formatSQL($_POST['msg']);
			$this->saveMessage();
		}
		/*$this->classMain->sendEmail(
			$this->infoMsg('MSG_SUBJECT'),
			$this->itemData,
			'email_item_msg.tpl',
			$this->msgEmail,
			$sender,
			$this->msgSenderName,
			$_FILES['cv']['tmp_name'],
			$_FILES['cv']['name'],
			$_FILES['cv']['type']
		);*/
	}
	private function saveMessage()
	{
		global $classUser;
		$sender_id = ($classUser->is_user()) ? $classUser->userinfo->user_id : 0;
		$query = "INSERT INTO ".DB_PREFIX."_users_messages VALUES (
			NULL,
			".$this->itemData->id.",
			".$this->itemData->user_id.",
			".$sender_id.",
			'".$this->msgSender."',
			'".$this->msgSenderName."',
			'".$this->itemData->message."',
			0,
			".time().",
			'".$_SERVER['REMOTE_ADDR']."',
			'".$this->fileName."'
		)";
		$this->db->query($query);
	}

	public function saveReport($type='item')
	{
		global $classUser;

		if (!$classUser->is_user())
		{
			try {
				$this->checkReCaptcha();
			} catch (Exception $e) {
				throw new Exception($e->getMessage());
			}
		}

		$this->addReport($type);
		$this->redirect(false, 'info', $this->infoMsg('REPORT_SEND'));
	}
	private function addReport($type='item')
	{
		global $classUser;
		$this->db->query("INSERT INTO ".DB_PREFIX."_report VALUES (
			NULL,
			".$this->formatSQL($_POST['id'], 'int').",
			'".$type."',
			'".$classUser->userinfo->user_id."',
			'".$this->formatSQL($_POST['abuse-text'])."',
			'".$this->formatSQL($_POST['abuse-name'])."',
			'".$this->formatSQL($_POST['abuse-email'])."',
			'".$this->formatSQL($_POST['abuse-phone'])."',
			".time().",
			'".$_SERVER['REMOTE_ADDR']."',
			0,
			''
		)");
		$this->sendReportInfo($this->formatSQL($_POST['abuse-email']));
	}
	private function sendReportInfo($email)
	{
		$this->classMain->sendEmail(
			$this->infoMsg('REPORT_SUBJECT'),
			false,
			'email_report_msg.tpl',
			$email
		);
	}
	public function endItem($id)
	{
		global $userinfo;
		$row = $this->db->query("SELECT id FROM ".DB_PREFIX."_items WHERE id=".intval(formatSQL($id))." AND user_id=".$userinfo->user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row)
		{
			$this->db->query("INSERT INTO ".DB_PREFIX."_users_payments VALUES (
																																					NULL,
																																					".$userinfo->user_id.",
																																					".$row->id.",
																																					".$this->itemSmiles($row->id).",
																																					0,
																																					".time()."
			)");
			$this->db->query("UPDATE ".DB_PREFIX."_items SET active=0 WHERE id=".$row->id." LIMIT 1");
			include_once 'funcs/konto/classes/class.konto.php';
			$kontoClass = new konto;
			$kontoClass->saveSmilesPayment(-300);
		}
	}
	public function checkData()
	{
		$error = array();
		if (empty($_SESSION['add']['cat_id'])) $error[] = $this->errorMsg('ADD_EMPTY_CAT');
		#if (empty($_SESSION['add']['price'])) $error[] = $this->errorMsg('ADD_EMPTY_PRICE');
		#if (empty($_SESSION['add']['qty'])) $error[] = $this->errorMsg('ADD_EMPTY_QTY');
		if (!is_array($_SESSION['add']['langs'])) $error[] = $this->errorMsg('ADD_EMPTY_LANGS');
		else {
			$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE active=1");
			while ($row = $result->fetch(PDO::FETCH_OBJ))
			{
				if (in_array($row->name_def, $_SESSION['add']['langs']))
				{
					if (empty($_SESSION['add']['title_'.$row->name_def])) $error[] = $this->errorMsg('ADD_EMPTY_TITLE');
					if (empty($_SESSION['add']['description_'.$row->name_def])) $error[] = $this->errorMsg('ADD_EMPTY_DESC');
				}
			}
		}
		if (!empty($error)) throw new Exception(implode('<br />', $error));
	}
	public function delItem($id)
	{
		global $userinfo;
		$this->db->query("DELETE FROM ".DB_PREFIX."_items WHERE id=".intval(formatSQL($id))." AND user_id=".$userinfo->user_id." LIMIT 1");
	}
	public function saveChanges($array)
	{
		$this->db->query("UPDATE ".DB_PREFIX."_items SET
			movie='".formatSQL($_POST['movie'])."',
			description='".formatSQL($_POST['description'])."'
		WHERE id=".formatSQL(intval($_POST['id']))." LIMIT 1");
	}
	private function catLink($id, $title)
	{
		$type = ($_GET['type'] === 'companies') ? '&amp;type=companies' : false;
		return 'funcs.php?name=items&amp;file=list&amp;id='.$id.$type.'&amp;title='.main::convertString($title);
	}

	function catsList($id=0, $limit=false, $activeArray=false, $orderCounter=false)
	{
		if ($limit) $queryLimit = ' LIMIT '.main::formatSQL($limit, 'int');

		$orderBy = ($orderCounter) ? 'counter DESC' : 'position ASC';

		if (is_array($id) && is_array($activeArray))
		{

			foreach ($activeArray as $key => $value)
			{
				$this->classMain->dataTPLarrayList('sc', array());
				$result = $this->db->query("SELECT c2.*
																		FROM ".DB_PREFIX.$this->catsDBname." c1
																		LEFT JOIN ".DB_PREFIX.$this->catsDBname." c2 ON (c2.left_id=c1.left_id)
																		WHERE c1.id=".$this->formatSQL($value, 'int')."
																		ORDER BY c2.".$orderBy);
				while ($row = $result->fetch(PDO::FETCH_OBJ))
				{
					$row->name = $this->classMain->setLangVar('name', $row);
					$row->active = ($row->id == $id || (is_array($activeArray) && in_array($row->id, $activeArray))) ? true : false;
					$this->classMain->dataTPLarrayList('sc.c', $row, false);
				}
			}
		}
		else
		{
			$row = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->catsDBname." WHERE id=".$this->formatSQL($id, 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);

			if ($row)
			{
				if ($row->last == 1)
				{
					$row2 = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->catsDBname." WHERE id=".$row->left_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
					$catUp['cat_up_active'] = ($row2->id == $id);
					$catUp['cat_up_id'] = $row2->id;
					$catUp['cat_up_nazwa'] = $this->classMain->setLangVar('name', $row2);
					$catUp['cat_up_link'] = $this->catLink($row2->left_id, $catUp['cat_up_nazwa']);
				}
				else
				{
					$catUp['cat_up_id'] = $row->id;
					$catUp['cat_up_active'] = ($row->id == $id);
					$catUp['cat_up_nazwa'] = $this->classMain->setLangVar('name', $row);
					$catUp['cat_up_link'] = $this->catLink($row->left_id, $catUp['cat_up_nazwa']);
				}
				$this->classMain->dataTPLarray($catUp, false);
			}

			if ($row->level > 0) $query = ($row->last == 1) ? " left_id=".$row->left_id : " left_id=".$row->id;
			else $query = "left_id=0";

			$dataTPL = array();
			$result = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->catsDBname." WHERE ".$query." ORDER BY ".$orderBy.$queryLimit);
			while ($row = $result->fetch(PDO::FETCH_OBJ))
			{
				$row->name = $this->classMain->setLangVar('name', $row);
				$row->active = ($row->id == $id || (is_array($activeArray) && in_array($row->id, $activeArray))) ? true : false;
				$row->link = $this->catLink($row->id, $row->name);
				$this->classMain->dataTPLarrayList('c', $row, false);

				$result2 = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->catsDBname." WHERE left_id='".$row->id."' ORDER BY ".$orderBy);
				while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
				{
					$row2->name = $this->classMain->setLangVar('name', $row2);
					$row2->active = ($row2->id == $id || (is_array($activeArray) && in_array($row2->id, $activeArray))) ? true : false;
					$row2->link = $this->catLink($row2->id, $row2->name);
					$this->classMain->dataTPLarrayList('c.u', $row2, false);
				}
			}
		}
	}
	public function catName($id)
	{
		if (empty($id)) return;
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->catsDBname." WHERE id=".main::formatSQL($id, 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		return $this->classMain->setLangVar('name', $row);
	}
	private function queryWhereLink()
	{
		$link = array();
		foreach ($_GET as $key => $value)
		{
			if (!empty($value))
			{
				if (is_array($value))
				{
					foreach ($value as $key2 => $value2) if ($value2) $link[$key][$key2] = $value2;
				} else $link[$key] = $value;
			}
		}
		$link['end'] = 1;
		$link = 'funcs.php?'.http_build_query($link);
		$this->redirect($link);
	}
	private function queryFilters()
	{
		$cat_id = $this->formatSQL($_GET['id'], 'int');
		if ($cat_id == 0) return;

		if (is_array($cat_id)) $cat_id = end($cat_id);
		$cat_id = $this->formatSQL($cat_id, 'int');
		$query = str_replace('cat_id', 'cat_ip', $this->queryCat($cat_id));
		$query .= " OR cat_ip=''";
		$query = "SELECT * FROM ".DB_PREFIX."_filters WHERE 1".$query;
		$result = $this->db->query($query);
		$queryReturn = array();
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			switch($row->type)
			{
				case 'ch':
					if (is_array($_GET['par_'.$row->f_id])) foreach ($_GET['par_'.$row->f_id] as $key => $value) $queryReturn[] = "(ifl.f_id=".$row->f_id." AND ifl.value='".$this->formatSQL($value)."')";
				break;
				case 'ft':
					if (is_array($_GET['par_'.$row->f_id]) && $_GET['par_'.$row->f_id][0] && $_GET['par_'.$row->f_id][1])
					$queryReturn[] = "(ifl.f_id=".$row->f_id." AND ifl.value BETWEEN ".$this->formatSQL($_GET['par_'.$row->f_id][0], 'int')." AND ".$this->formatSQL($_GET['par_'.$row->f_id][1], 'int').")";
					elseif (is_array($_GET['par_'.$row->f_id]) && $_GET['par_'.$row->f_id][0] && !$_GET['par_'.$row->f_id][1])
					$queryReturn[] = "(ifl.f_id=".$row->f_id." AND ifl.value >= ".$this->formatSQL($_GET['par_'.$row->f_id][0], 'int').")";
					elseif (is_array($_GET['par_'.$row->f_id]) && !$_GET['par_'.$row->f_id][0] && $_GET['par_'.$row->f_id][1])
					$queryReturn[] = "(ifl.f_id=".$row->f_id." AND ifl.value <= ".$this->formatSQL($_GET['par_'.$row->f_id][1], 'int').")";
				break;
				default:
					if (!is_array($_GET['par_'.$row->f_id]) && $_GET['par_'.$row->f_id]) $queryReturn[] = "(ifl.f_id=".$row->f_id." AND ifl.value='".$this->formatSQL($_GET['par_'.$row->f_id])."')";
				break;
			}
		}
		return $queryReturn;
	}
	private function queryWhere($type=false)
	{
		if ($_GET['search'] == 1)
		{
			if (empty($_GET['end'])) $this->queryWhereLink();

			$query = array();
			$queryOR = array();
			$string = $this->formatSQL($_GET['string']);

			switch($type)
			{
				case 'companies':
					if (isset($_GET['string']) && !empty($_GET['string'])) $query[] = "u.company_name LIKE '%".$string."%'";
					#$query[] = $this->getLangQueryWhere('company_desc', $string, $type);
					if (!empty($_GET['region'])) $query[] = "u.region='".$this->formatSQL($_GET['region'])."'";
				break;
				default:
					if (isset($string) && !empty($string))
					{
						$queryOR[] = $this->getLangQueryWhere('title', $string);
						$queryOR[] = $this->getLangQueryWhere('keywords', $string);
						$queryOR[] = $this->getLangQueryWhere('description', $string);
						if (is_numeric($string)) $query[] = "i.id=".intval($id);
					}
					if (!empty($_GET['region'])) $query[] = "i.region='".$this->formatSQL($_GET['region'])."'";
				break;
			}
			if (!empty($_GET['country'])) $query[] = "u.country=".$this->formatSQL($_GET['country'], 'int');
			if (!empty($_GET['city'])) $query[] = "i.city='".$this->formatSQL($_GET['city'])."'";
			if (!empty($_GET['lang'])) $query[] = "i.langs LIKE '%".$this->formatSQL($_GET['lang'])."%'";
			if (!empty($_GET['veryfi'])) $query[] = "u.veryfi>0";
			if (!empty($_GET['i_type'])) $query[] = "i.type=".self::formatSQL($_GET['i_type'], 'int');
			if (!empty($_GET['user_id'])) $query[] = "i.user_id=".$this->formatSQL($_GET['user_id'], 'int');
			if (!empty($_GET['username'])) $query[] = "(u.username LIKE '%".$this->formatSQL($_GET['username'])."%' OR u.company_name LIKE '%".$this->formatSQL($_GET['username'])."%')";

			$filters = $this->queryFilters();
			if ($filters) $query = array_merge($query, $filters);

			$return = (count($query) > 0) ? ' AND ('.implode(" AND ", $query).')' : false;
			$return .= (count($queryOR) > 0) ? ' AND ('.implode(' OR ', $queryOR).')' : false;

			return $return;
		}
	}
	private function getLangQueryWhere($name, $string)
	{
		return "i.".$name."_".$this->classMain->defLang." LIKE '%".$string."%'";
	}
	private function queryCat($cat_id, $type=false)
	{
		$cat_id = $this->formatSQL($cat_id, 'int');
		if ($cat_id)
		{
			$field = ($type === 'companies') ? 'uc.cat_ip' : 'cat_id';
			$row = $this->db->query("SELECT ip, last FROM ".DB_PREFIX.$this->catsDBname." WHERE id=".$cat_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
			$concat = ($row->last == 1) ? $row->ip : $row->ip.'.%';
			return " AND ".$field." LIKE CONCAT ('".$concat."')";
		}
	}
	private function queryShow($type=false)
	{
		if ($type == 'c') return ' AND u.status=1';
		else return ($_GET['name'] != 'user') ? ' AND i.save_only=0 AND i.active=1 AND i.veryfi=1' : false;
	}
	private function queryLang($type=false)
	{
		if ($type == 'c') return false;
		else return ($_GET['name'] != 'user') ? " AND i.langs LIKE '%".$this->classMain->defLang."%'" : false;
	}
	private function queryMember()
	{
		if ($this->mainConfig->item_member == 0 || ($_GET['name'] == 'user' && $_GET['file'] == 'items_list')) return;
		$maxTime = time()-$this->mainConfig->member_items_visible*86400;
		return " AND um.date_end>".$maxTime;
	}
	private function queryUser()
	{
		global $classUser;
		if ($_GET['name'] == 'user' && $_GET['file'] == 'items_list') return " AND u.user_id=".$classUser->userinfo->user_id;
	}
	private function queryStatus()
	{
		if ($_GET['status'])
		{
			$status = $this->formatSQL($_GET['status']);
			switch ($status) {
				case 'active': return " AND i.active=1 AND i.save_only=0"; break;
				case 'save_only': return " AND i.save_only=1"; break;
				case 'end': return " AND i.end<".time(); break;
			}
		}
	}
	private function orderBy($order=false, $type=false)
	{
		if ($order) return $order;

		$orderBy = $this->formatSQL($_GET['orderby']);

		switch($type) {
			case 'c':
				switch($orderBy)
				{
					case 'dateASC':
						return 'u.date_reg ASC';
					break;
					case 'dateDESC':
						return 'u.date_reg DESC';
					break;
					case 'nameASC':
						return 'u.company_name ASC';
					break;
					case 'RAND()':
						return 'RAND()';
					break;
					default:
						#if (empty($orderBy)) return 'u.user_id DESC';
						return 'u.user_id DESC';
					break;
				}
			break;

			default:
				if (empty($orderBy)) return 'i.distinction DESC, i.bid DESC, i.start DESC';

				switch($orderBy)
				{
					case 'dateASC':
						return 'i.distinction DESC, i.bid DESC, i.date ASC';
					break;
					case 'dateDESC':
						return 'i.distinction DESC, i.bid DESC, i.date DESC';
					break;
					case 'priceASC':
						return 'i.distinction DESC, i.bid DESC, i.price ASC';
					break;
					case 'priceDESC':
						return 'i.distinction DESC, i.bid DESC, i.price DESC';
					break;
					default:
						return 'i.distinction DESC, i.bid DESC, i.start DESC';
					break;
				}
			break;
		}
	}
	private function getCatCounter($c_id, $where=false, $sql=false)
	{
		$c_id = main::formatSQL($c_id, 'int');

		if ($where && $sql)
		{
			return $this->db->query($sql)->num_rows;
		}

		if (empty($c_id) && $_GET['file'] == 'list')
		{
			return $this->mainConfig->items_count;
		}
		else if (empty($_GET['search']))
		{
			$row = $this->db->query("SELECT counter FROM ".DB_PREFIX."_cats WHERE id=".$c_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
			return $row->counter;
		}
	}
	public function itemsList($listName='i', $limit=false, $sql=false, $orderby=false)
	{
		include_once 'funcs/items/classes/items.pager.class.php';

		if (empty($sql))
		{
			$where = $this->queryCat($_GET['id']);
			$where .= $this->queryShow();
			$where .= $this->queryWhere();
			$where .= $this->queryUser();
			$where .= $this->queryStatus();
			$where .= $this->queryLang();
			$where .= $this->queryMember();

			$sql = "SELECT i.*, u.company_name, u.u_type, u.veryfi AS u_veryfi
											FROM ".DB_PREFIX."_items i
											LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=i.user_id)
											WHERE 1".$where." GROUP BY i.id";
		}

		if (!$limit)
		{
			//$result = $this->db->query($sql);
			$catCounter = self::getCatCounter($_GET['id'], $where, $sql);
			//$recordsCount = $catCounter;
			if ($catCounter) $recordsCount = $catCounter;
			else
			{
				$result = $this->db->query($sql);
				$recordsCount = $result->rowCount();//pobranie liczby rekordĂłw
			}

			try{
				$pager = new Pager('');
				$pager->SetTotalRecords($recordsCount);
				$pager->Make(true);
				$pag = $pager->Render();
				$start = $pager->GetIndexRecordStart();
				$end = $pager->GetIndexRecordEnd();
			}
			catch (Exception $e) {
				echo $e->getMessage();
			}
			$stop = $end - $start + 1;

			$sql .= " ORDER BY ";
			$sql .= ($orderby) ? $orderby : $this->orderBy($orderBy);
			$sql .= " LIMIT ".$start.",".$stop;
		}
		else
		{
			$sql .= " ORDER BY ";
			$sql .= ($orderby) ? $orderby : $this->orderBy('i.id DESC');
			$sql .= " LIMIT ".$limit;
		}

		$no = 1;

		$result = $this->db->query($sql);
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->cat_name = $this->catName($this->getCatID($row->cat_id));
			$row->title = $this->classMain->setLangVar('title', $row);
			$row->description = $this->textCut(strip_tags(htmlspecialchars_decode($this->classMain->setLangVar('description', $row))), 105);
			$row->date = date('d-m-Y H:i\r', $row->date);
			$row->href = $this->itemHref($row->id, $row->title, $row->city);
			$row->photo = $this->getImageMain($row->id, $row->dir, 'small');
			$row->userVeryfi = $this->userVeryfi($row->u_veryfi);
			$row->user_profile_href = $this->userProfileHref($row->user_id);
			$row->unit = $this->optName($row->unit);
			$row->to_end = $this->timeToEnd($row->end);
			$row->from_start = $this->timeStart($row->start);
			$row->from_start_count = ((time()-$row->start)/86400);
			$row->active = ($row->end > time() && $row->active == 1);
			#$row->date_start = date('d-m-Y H:i', $row->start);
			$row->date_start = main::dateName($row->start);
			$row->price = $this->itemPrice($row->price);
			$row->type_id = $row->type;
			$row->type = self::optName($row->type);
			$row->ads = ($no == 8);

			$this->classMain->dataTPLarrayList($listName, $row);
			$no++;

			$this->itemLangsList($row->langs, $listName);

			if ($_GET['file'] == 'items_list') $this->itemOfferList($row->id, $listName);

		}
		if ($listName == 'i') $this->classMain->dataTPLarray(array('pager' => $pag), false);
	}

	public function profileList($listName='i', $limit=false, $sql=false, $orderby=false)
	{
		global $classUser;

		include_once 'funcs/items/classes/items.pager.class.php';

		if (empty($sql))
		{
			$where = $this->queryCat($_GET['id'], $_GET['type']);
			$where .= $this->queryShow('c');
			$where .= $this->queryWhere($_GET['type']);
			$where .= $this->queryUser();
			$where .= $this->queryLang('c');
			$where .= $this->queryMember();

			$sql = "SELECT u.*, (SELECT COUNT(id) FROM ".DB_PREFIX."_items WHERE user_id=u.user_id AND active=1) AS items_count
											FROM ".DB_PREFIX."_users u
											LEFT JOIN (SELECT user_id, MAX(date_end) AS date_end FROM ".DB_PREFIX."_users_member GROUP BY user_id) AS um ON (um.user_id=u.user_id)
											LEFT JOIN ".DB_PREFIX."_users_cats uc ON (uc.user_id=u.user_id)
											WHERE 1 AND u_type='business' AND company_name!=''".$where." GROUP BY u.user_id";
		}
		#echo $sql;
		if (!$limit)
		{
			$result = $this->db->query($sql);
			$recordsCount = $result->rowCount();//pobranie liczby rekordĂłw
			try{
				$pager = new Pager('');
				$pager->SetTotalRecords($recordsCount);
				$pager->Make(true);
				$pag = $pager->Render();
				$start = $pager->GetIndexRecordStart();
				$end = $pager->GetIndexRecordEnd();
			}
			catch (Exception $e) {
				echo $e->getMessage();
			}
			$stop = $end - $start + 1;

			$sql .= " ORDER BY ".$this->orderBy($orderby, 'c')." LIMIT ".$start.",".$stop;
		} else $sql .= " ORDER BY ".$this->orderBy($orderby, 'c')." LIMIT ".$limit;

		$no = 1;
		$result = $this->db->query($sql);

		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$avatar = $classUser->userAvatar($row->user_id);
			$row->title = $row->company_name;
			$row->description = $this->textCut(strip_tags($this->classMain->setLangVar('company_desc', $row)), 105);
			$row->href = $this->userProfileHref($row->user_id);
			$row->photo = ($avatar) ? $avatar : 'theme/img/item-big-pic.png';
			$row->userVeryfi = $this->userVeryfi($row->veryfi);
			$row->u_veryfi = $row->veryfi;
			$row->country = $this->optName($row->country);

			$this->classMain->dataTPLarrayList($listName, $row);
			$no++;
		}
		if ($listName == 'i') $this->classMain->dataTPLarray(array('pager' => $pag), false);
	}

	private function userProfileHref($user_id)
	{
		return 'funcs.php?name=items&amp;file=list&amp;user_id=' . $user_id .'&amp;id=0&amp;search=1&amp;end=1';
	}
	private function userVeryfi($date)
	{
		return ($date > 0) ? true : false;
	}
	private function itemLangsList($langs, $tplName)
	{
		$langs = explode('|', $langs);
		foreach ($langs as $key => $value) {
			$rowLangs['name'] = $value;
			$this->classMain->dataTPLarrayList($tplName.'.lng', $rowLangs);
		}
	}
	public function photosList($array, $edit=false)
	{
		if ($edit)
		{
			$this->setNewPhotosFolder($edit);
		}
		else
		{
			if (!is_array($array)) return;
			$this->setPhotosFolder();
			foreach ($array as $key => $value)
			{
				$dataFile = array();
				$file = $this->photosFolder.'/'.$value;
				$fileSmall = $this->photosFolder.'/small_'.$value;
				if ($value && file_exists($file))
				{
					$dataFile['photo'] = $this->classMain->mainConfig->siteurl.'/'.$file;
					$dataFile['photo_small'] = $this->classMain->mainConfig->siteurl.'/'.$fileSmall;
					$dataFile['photo_name'] = $value;
					$this->classMain->dataTPLarrayList('p', $dataFile);
				}
			}
		}
	}

	public function deleteFile()
	{
		if ($_GET['del-file'])
		{
			if ($_GET['file'] === 'item_edit')
			{
				if (file_exists($_GET['del-file']))
				{
					unlink($_GET['del-file']);
				}
				main::redirect('funcs.php?name=user&file=item_edit&id=' . $_GET['id']);
			}
			else
			{
				if (empty($_SESSION['add']['item_file'])) return;

				$this->setPhotosFolder();
			
				$file = $this->photosFolder.'/'.$_SESSION['add']['item_file'];

				if (file_exists($file))
				{
					unlink($file);
					unset($_SESSION['add']['item_file']);
				}
			}
		}
	}

	public function deletePic($admin=false)
	{
		if ($admin) $redirect = ADMIN_FILE.'.php?op=item-edit&id='.$_SESSION['add']['id'];
		elseif ($_GET['file'] == 'add') $redirect = 'funcs.php?name=items&file=add';
		else $redirect = 'funcs.php?name=user&file=item_edit&id='.$_SESSION['add']['id'];

		if (isset($_GET['del-pic']) && !empty($_GET['del-pic']))
		{
			//edit
			if ($_SESSION['add']['edit'] == 1)
			{
				$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_items_photos WHERE photo='".$this->formatSQL($_GET['del-pic'])."' AND i_id=".$this->formatSQL($_SESSION['add']['id'], 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);
				if ($row)
				{
					$this->setNewPhotosFolder($row->i_id);
					$file = $this->photosNewFolder.'/'.$row->photo;
					if ($file && file_exists($file)) unlink($file);
					$this->db->query("DELETE FROM ".DB_PREFIX."_items_photos WHERE id=".$row->id." LIMIT 1");
					$this->photosMainUpdate($row->i_id);
				}
				$this->redirect($redirect.'#photos');
			}
			//add new
			else
			{
				$key = array_search($_GET['del-pic'], $_SESSION['add-photo']['photo']);

				if (isset($key))
				{
					$this->setPhotosFolder();
					$file = $this->photosFolder.'/'.$_SESSION['add-photo']['photo'][$key];
					if ($file && file_exists($file)) unlink($file);
					unset($_SESSION['add-photo']['photo'][$key]);
				}
				$this->redirect($redirect.'#photos');
			}
		}
	}
	private function setPhotosFolder()
	{
		$this->photosFolder = self::FOLDER_IMAGES.session_id();
	}
	private function setNewPhotosFolder($item_id)
	{
		if ($_SESSION['add']['edit'] == 1 && $_SESSION['add']['dir']) $this->photosNewFolder = $_SESSION['add']['dir'];
		else
		{
			$this->setDir();
			$this->photosNewFolder = self::FOLDER_IMAGES.$this->itemDir.'/'.$item_id;
		}
	}
	public function addPhoto($files, $admin=false)
	{
		if ($_SESSION['add']['edit'] == 1)
		{
			$this->setNewPhotosFolder($_SESSION['add']['id']);
			$folderDB = $this->photosNewFolder;
			$folder = self::FOLDER_IMAGES.$folderDB.'/'.$_SESSION['add']['id'];
		}
		else
		{
			$this->setPhotosFolder();
			$folder = $this->photosFolder;
		}


		foreach ($files['name'] as $key => $value) {
			$file['name'] = $value;
			$file['type'] = $files['type'][$key];
			$file['tmp_name'] = $files['tmp_name'][$key];
			$file['error'] = $files['error'][$key];
			$file['size'] = $files['size'][$key];
			$photo = $this->savePhoto($file, $folder);
			if ($photo)
			{
				if ($_SESSION['add']['edit'] == 1) $this->db->query("INSERT INTO ".DB_PREFIX."_items_photos VALUES (
					NULL,
					".$_SESSION['add']['id'].",
					'".$photo."',
					".$this->photosMainCheck($_SESSION['add']['id']).",
					'".$_SERVER['REMOTE_ADDR']."',
					".time()."
				)");
				else $_SESSION['add-photo']['photo'][] = $photo;
			}
		}

		if ($admin) $redirect = ADMIN_FILE.'.php?op=item-edit&id='.$_SESSION['add']['id'];
		else
		{
			if ($_SESSION['add']['edit'] == 1) $redirect = 'funcs.php?name=user&file=item_edit&id='.$_SESSION['add']['id']; else $redirect = 'funcs.php?name=items&file=add';
		}
		$this->redirect($redirect.'#photos');
	}
	public function addFile($file, $admin=false)
	{
		if ($_SESSION['add']['edit'] == 1)
		{
			$this->setNewPhotosFolder($_SESSION['add']['id']);
			$folder = $this->photosNewFolder;
		}
		else
		{
			$this->setPhotosFolder();
			$folder = $this->photosFolder;
		}

		$filename = $this->saveItemFile($file, $folder);
		if ($filename) $_SESSION['add']['item_file'] = $filename;

		if ($admin) $redirect = ADMIN_FILE.'.php?op=item-edit&id='.$_SESSION['add']['id'];
		else
		{
			if ($_SESSION['add']['edit'] == 1) $redirect = 'funcs.php?name=user&file=item_edit&id='.$_SESSION['add']['id']; else $redirect = 'funcs.php?name=items&file=add';
		}
		$this->redirect($redirect.'#file');
	}
	public function savePhoto($file, $folder)
	{
		require_once("inc/classes/class.upload.php");

		$handle = new Verot\Upload\Upload($file, $folder);

		$nazwa_zdjecia = uniqid();

		if ($handle->uploaded)
		{
			if (
				$handle->file_src_mime == 'image/jpeg' ||
				$handle->file_src_mime == 'image/gif' ||
				$handle->file_src_mime == 'image/png'
				)
			{
				$handle->image_resize             = true;
				$handle->image_ratio_fill         = true;
				$handle->image_x                  = 423;
				$handle->image_y                  = 423;
				$handle->image_convert 						= 'webp';
				$handle->image_background_color   = '#FFFFFF';
				#$handle->image_watermark					= 'theme/images/watermark_mini.png';
				#$handle->image_watermark_position = 'BR';
				$handle->file_src_name_body	= 'small_'.$nazwa_zdjecia;
				$handle->Process($folder);

				$handle->image_resize             = true;
				$handle->image_ratio							= true;
				$handle->image_x                  = 700;
				$handle->image_y                  = 500;
				$handle->image_watermark					= 'theme/img/watermark.png';
				$handle->image_watermark_position = 'BR';
				$handle->image_convert 						= 'webp';
				$handle->file_src_name_body	= $nazwa_zdjecia;

				//ustalanie podstawy nazw zdjcęcia
				$photoName = $nazwa_zdjecia.'.'.$handle->file_dst_name_ext;

				if ($handle->Process($folder))
				#throw new Exception($handle->error);
				$handle->Clean();
			}
		} #else throw new Exception($handle->error);

		return $photoName;
	}
	public function saveItemFile($file, $folder)
	{
		require_once("inc/classes/class.upload.php");

		$handle = new Verot\Upload\Upload($file, $folder);

		$filename = uniqid();

		if ($handle->uploaded)
		{
			if ($handle->file_src_mime == 'application/pdf')
			{
				$handle->file_src_name_body	= $filename;
				$handle->Process($folder);

				$filename = $filename.'.'.$handle->file_dst_name_ext;

				$handle->Clean();
			}
		}
		return $filename;
	}
	private function setSaveOnly()
	{
		global $classUser;
		#if ($classUser->is_user() && $classUser->is_member()) $this->saveOnly = $this->formatSQL($_SESSION['add']['save_only'], 'int');
		#else $this->saveOnly = 1;
		$this->saveOnly = 0;
	}
	private function checkAccount($user_email)
	{
		global $classUser;

		$user_email = main::formatSQL($user_email);
		$row = $this->db->query("SELECT user_id FROM ".DB_PREFIX."_users WHERE user_email='".$user_email."' LIMIT 1")->fetch(PDO::FETCH_OBJ);

		if ($row) $this->user_id = $row->user_id;
		else
		{
			$this->userReg = true;
			$this->user_id = $classUser->createAccount($user_email);
		}
	}
	public function addItem()
	{
		global $classUser;

		if (!$classUser->is_user()) $this->checkAccount($_SESSION['add']['user_email']);
		else $this->user_id = $classUser->userinfo->user_id;

		$this->setSaveOnly();
		$this->setDir();

		$query = "INSERT INTO ".DB_PREFIX."_items (
			cat_id,
			type,
			price,
			item_currency,
			qty,
			unit,
			country,
			region,
			city,
			post_code,
			address,
			phone,
			start,
			end,
			time,
			date,
			user_id,
			active,
			veryfi,
			save_only,
			yt,
			langs,
			phone_lang,
			dir,
			file,
			promo_bold,
			promo_backlight,
			promo_distinction,
			promo_mainpage
		) VALUES (
			'".$this->getCatIP($_SESSION['add']['cat_id'])."',
			".$this->formatSQL($_SESSION['add']['type'], 'int').",
			'".$_SESSION['add']['price']."',
			'".$_SESSION['add']['item_currency']."',
			".$this->formatSQL($_SESSION['add']['qty'], 'int').",
			".$this->formatSQL($_SESSION['add']['unit'], 'int').",
			'".$this->formatSQL($_SESSION['add']['country'])."',
			'".$this->formatSQL($_SESSION['add']['region'])."',
			'".$this->formatSQL($_SESSION['add']['city'])."',
			'".$this->formatSQL($_SESSION['add']['post_code'])."',
			'".$this->formatSQL($_SESSION['add']['address'])."',
			'".$this->formatSQL($_SESSION['add']['phone'])."',
			".$this->getDate('start').",
			".$this->getDate('end').",
			".$this->formatSQL($_SESSION['add']['item_time'], 'int').",
			".time().",
			".$this->user_id.",
			".$this->getActive().",
			1,
			".$this->saveOnly.",
			'".$this->getMovies()."',
			'".$this->getLangs()."',
			'".$this->getPhones()."',
			'".$this->itemDir."',
			'".$this->formatSQL($_SESSION['add']['item_file'])."',
			".$this->formatSQL($_SESSION['add']['promo_bold'], 'int').",
			".$this->formatSQL($_SESSION['add']['promo_backlight'], 'int').",
			".$this->formatSQL($_SESSION['add']['promo_distinction'], 'int').",
			".$this->formatSQL($_SESSION['add']['promo_mainpage'], 'int')."
		)";

		$this->db->query($query);

		$this->item_id = $this->db->lastInsertId();

		$this->saveLangsData($_SESSION['add'], 'title', 'id', $this->item_id, 'items');
		$this->saveLangsData($_SESSION['add'], 'description', 'id', $this->item_id, 'items');
		$this->saveLangsData($_SESSION['add'], 'keywords', 'id', $this->item_id, 'items');

		$this->insertPhotos();
		$this->renamePhotosFolder();

		$this->insertFilters($this->item_id);

		$this->addMemberPosition('ads', $this->user_id, $this->item_id);

		//payment page redirect
		$this->checkItemPayment($this->item_id, $_SESSION['add']['item_time'], $_SESSION['add']['promo_bold'], $_SESSION['add']['promo_backlight'], $_SESSION['add']['promo_distinction'], $_SESSION['add']['promo_mainpage']);

		unset($_SESSION['add']);
		unset($_SESSION['add-photo']);

		$msg = $this->infoMsg('ITEM_ADD');
		if ($this->userReg) $msg .= '<br />'.$this->infoMsg('ITEM_ADD_USER_REG');

		throw new Exception($msg);
	}
	private function checkItemPayment($id, $time, $bold, $backlight, $distinction, $main_page, $cat_id=false)
	{
		$this->setItemPrice($id, $time, $bold, $backlight, $distinction, $main_page, $cat_id);
		
		if (($this->classUser->is_user() && !$this->classUser->is_member() && $this->itemPrice > 0) || (!$this->classUser->is_user() && $this->itemPrice > 0))
		{
			$this->db->query("UPDATE ".DB_PREFIX."_items SET active=0 WHERE id=".$id." LIMIT 1");
			$this->redirect('funcs.php?name=items&file=payment&i_id='.$this->item_id);
		}
	}

	public function itemUpdate($admin=false)
	{
		global $classUser;

		$queryUser = ($admin == false) ? ' AND user_id='.$classUser->userinfo->user_id : false;

		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_items WHERE id=".$this->formatSQL($_SESSION['add']['id'], 'int').$queryUser." LIMIT 1")->fetch(PDO::FETCH_OBJ);

		$start = ($row->active == 0 || $admin) ? ", start=".$this->getDate('start') : false;
		$end = ($row->active == 0 || $admin) ? ", end=".$this->getDate('end') : false;
		if ($admin) $active = ($end > time() && empty($_SESSION['add']['save_only'])) ? 1 : 0;
		else $active = (($row->active == 1) ? 1 : ($end > time() && empty($_SESSION['add']['save_only']) && $this->classUser->is_member())) ? 1 : 0;

		if ($admin == true)
		{
			$queryPromo = ", promo_bold=".main::formatSQL($_SESSION['add']['promo_bold'], 'int');
			$queryPromo .= ", promo_backlight=".main::formatSQL($_SESSION['add']['promo_backlight'], 'int');
			$queryPromo .= ", promo_distinction=".main::formatSQL($_SESSION['add']['promo_distinction'], 'int');
			$queryPromo .= ", promo_mainpage=".main::formatSQL($_SESSION['add']['promo_mainpage'], 'int');
		}

		$query = "UPDATE ".DB_PREFIX."_items SET
			cat_id='".$this->getCatIP($_SESSION['add']['cat_id'])."',
			price='".$_SESSION['add']['price']."',
			item_currency='".$_SESSION['add']['item_currency']."',
			unit=".$this->formatSQL($_SESSION['add']['unit'], 'int').",
			type=".$this->formatSQL($_SESSION['add']['type'], 'int').",
			langs='".$this->getLangs()."',
			phone_lang='".$this->getPhones()."',
			region='".$this->formatSQL($_SESSION['add']['region'])."',
			city='".$this->formatSQL($_SESSION['add']['city'])."',
			address='".$this->formatSQL($_SESSION['add']['address'])."',
			post_code='".$this->formatSQL($_SESSION['add']['post_code'])."',
			phone='".$this->formatSQL($_SESSION['add']['phone'])."',
			save_only=".$this->formatSQL($_SESSION['add']['save_only'], 'int').",
			active=".$active."
			".$start."
			".$end."
			".$queryPromo."
		WHERE id=".$row->id." LIMIT 1";

		$this->db->query($query);

		$this->saveLangsData($_SESSION['add'], 'title', 'id', $row->id, 'items');
		$this->saveLangsData($_SESSION['add'], 'description', 'id', $row->id, 'items');
		$this->saveLangsData($_SESSION['add'], 'keywords', 'id', $row->id, 'items');

		throw new Exception($this->infoMsg('ITEM_UPDATE'));
	}
	private function insertFilters($i_id)
	{
		$cat_id = $_SESSION['add']['cat_id'];
		if (is_array($cat_id)) $cat_id = end($cat_id);
		$cat_id = $this->formatSQL($cat_id, 'int');
		$query = str_replace('cat_id', 'cat_ip', $this->queryCat($cat_id));
		$query .= " OR cat_ip=''";

		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_filters WHERE 1".$query." GROUP BY f_id ORDER BY position ASC, id ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			if (!empty($_SESSION['add']['par_'.$row->f_id]))
			{
				switch($row->type)
				{
					case 'ch':
						foreach ($_SESSION['add']['par_'.$row->f_id] as $key => $value)
						{
							$query = "INSERT INTO ".DB_PREFIX."_items_filters VALUES (
																						NULL,
																						".$i_id.",
																						".$row->f_id.",
																						'".$value."'
							)";
							$this->db->query($query);
						}
					break;
					default:
					case 's':
					case 't':
						$query = "INSERT INTO ".DB_PREFIX."_items_filters VALUES (
																					NULL,
																					".$i_id.",
																					".$row->f_id.",
																					'".$_SESSION['add']['par_'.$row->f_id]."'
						)";
						$this->db->query($query);
					break;
				}
			}
		}
	}
	private function getPhones()
	{
		return (is_array($_SESSION['add']['phone_lang'])) ? implode('|', $_SESSION['add']['phone_lang']) : false;
	}
	private function setDir()
	{
		$this->itemDir = date('Y').'/'.date('m').'/'.date('d');
	}
	private function renamePhotosFolder()
	{
		$this->setPhotosFolder();
		$this->setNewPhotosFolder($this->item_id);

		$folderNew = date('Y/m/d/').$id;

		if (!file_exists($this->photosNewFolder) && $this->photosNewFolder) @mkdir($this->photosNewFolder, 0777, true);

		//kopiowanie plików
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_items_photos WHERE i_id=".$this->item_id);
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			#if (file_exists($this->photosFolder.'/duze_'.$row->photo)) @copy($this->photosFolder.'/duze_'.$row->photo, $this->photosNewFolder.'/duze_'.$row->photo);
			#if (file_exists($this->photosFolder.'/srednie_duze_'.$row->photo)) @copy($this->photosFolder.'/srednie_duze_'.$row->photo, $this->photosNewFolder.'/srednie_duze_'.$row->photo);
			if (file_exists($this->photosFolder.'/'.$row->photo)) @copy($this->photosFolder.'/'.$row->photo, $this->photosNewFolder.'/'.$row->photo);
			if (file_exists($this->photosFolder.'/small_'.$row->photo)) @copy($this->photosFolder.'/small_'.$row->photo, $this->photosNewFolder.'/small_'.$row->photo);
		}

		//rename file
		if ($_SESSION['add']['item_file'])
		{
			if (file_exists($this->photosFolder.'/'.$_SESSION['add']['item_file'])) @copy($this->photosFolder.'/'.$_SESSION['add']['item_file'], $this->photosNewFolder.'/'.$_SESSION['add']['item_file']);
		}

		//usuwanie folderu
		$dir = $this->photosFolder;
		if (is_dir($dir))
		{
			$lista = glob($dir."/*");
			for ($i=0; $i < count($lista); $i++) if (file_exists($lista[$i]) && !empty($lista[$i])) if (file_exists($lista[$i])) unlink($lista[$i]);
			if (file_exists($dir)) rmdir($dir);
		}

		return true;

		#if (file_exists($this->photosFolder)) rename($this->photosFolder, $this->photosNewFolder);
	}
	private function insertPhotos()
	{
		if (is_array($_SESSION['add-photo']['photo']))
		{
			$no = 1;
			foreach ($_SESSION['add-photo']['photo'] as $key => $value)
			{
				$main = ($no == 1) ? 1 : 0;
				$this->db->query("INSERT INTO ".DB_PREFIX."_items_photos VALUES (NULL, ".$this->item_id.", '".$value."', ".$main.", '".$_SERVER['REMOTE_ADDR']."', ".time().")");
				$no++;
			}
		}
	}
	private function getCatIP($id)
	{
		$id = (is_array($id)) ? end($id) : $id;
		$row = $this->db->query("SELECT ip FROM ".DB_PREFIX.$this->catsDBname." WHERE id=".$this->formatSQL($id, 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		return $row->ip;
	}
	public function getCatID($ip)
	{
		$row = $this->db->query("SELECT id FROM ".DB_PREFIX.$this->catsDBname." WHERE ip='".$this->formatSQL($ip)."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
		return $row->id;
	}
	private function getDate($type='start')
	{
		$dateRange = $_SESSION['add']['daterange'];
		if ($dateRange) $dates = explode(' - ', $dateRange);

		switch($type)
		{
			case 'start':
				$date = ($dateRange) ? strtotime($dates[0]) : time();
			break;
			case 'end':
				$dates[1] = str_replace('/', '-', $dates[1]);
				$date = ($dateRange) ? strtotime($dates[1]) : $this->getDate('start')+$_SESSION['add']['item_time']*86400;
			break;
		}
		#return strtotime(str_replace('/', '.', $date));
		return $date;
	}
	private function getActive()
	{
		#if ($this->checkMember('ads', $this->user_id)) return 1; else return 0;
		if ($this->classUser->is_user() || $this->userReg == false) return 1; else return 0;
	}
	private function checkMember($type='ads', $user_id=0)
	{
		if (!$this->classUser->is_user()) return false;

		$rowSumExtra = $this->db->query("SELECT SUM(m.extra_".$type.") AS sum
										FROM ".DB_PREFIX."_users_member um
										LEFT JOIN ".DB_PREFIX."_member_periods mp ON (mp.id=um.m_id)
										LEFT JOIN ".DB_PREFIX."_member m ON (m.id=mp.m_id)
										WHERE um.user_id=".$user_id
		)->fetch(PDO::FETCH_ASSOC);
		$rowExtraData = $this->db->query("SELECT COUNT(umd.id) AS sum
															FROM ".DB_PREFIX."_users_member us
															LEFT JOIN ".DB_PREFIX."_users_member_data umd ON (umd.um_id=us.id  AND umd.type='".$type."')
															LEFT JOIN ".DB_PREFIX."_member m ON (m.id=us.m_id)
															WHERE us.user_id=".$user_id)->fetch(PDO::FETCH_ASSOC);

		if ($rowSumExtra['sum'] > $rowExtraData['sum']) return true; else return false;
	}
	private function getMovies()
	{
		if (is_array($_SESSION['add']['movie'])) return implode('|', $_SESSION['add']['movie']);
	}
	private function getLangs()
	{
		if (is_array($_SESSION['add']['langs'])) return implode('|', $_SESSION['add']['langs']);
	}
	private function addView($id)
	{
		$this->db->query("UPDATE ".DB_PREFIX."_items SET views=views+1, view_last_date=".time()." WHERE id=".$id." LIMIT 1");
	}
	private function profileData($id)
	{
		global $classUser;

		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_users WHERE user_id=".$id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if (!$row) throw new Exception($this->errorMsg('PROFILE_EMPTY'));

		$row->id = $row->user_id;
		$row->avatar = $classUser->userAvatar($row->user_id);
		$row->title = $row->company_name;
		$row->item_desc = nl2br($this->classMain->setLangVar('company_desc', $row, $this->lang));
		$row->item_href = $this->userProfileHref($row->user_id);
		$row->date_reg = date('d.m.Y\r.', $row->date_reg);
		$row->country = $this->optName($row->country);
		$row->address = $row->street;
		$row->u_veryfi = $row->veryfi;

		$row->phone = '+48 '.str_replace(array(' ', '+48', '-'), '', $row->phone);
		$row->phone_start = substr($row->phone, 0, 7);
		$row->phone_end = chunk_split(substr($row->phone, 7), 3, ' ');

		$row->profile = true;
		$this->profileData = $row;
	}
	public function profileDataTPL($id)
	{
		global $classUser;
		$id = $this->formatSQL($id, 'int');
		$this->setLang($id, 'profiles');
		$this->profileData($id);
		$this->phonesList($id);
		$classUser->getWebitesTPL($this->profileData->user_id);
		$this->classMain->dataTPLarray($this->profileData, false);

		$this->saveProfileVisit($this->profileData->user_id);
	}
	private function saveProfileVisit($user_id)
	{
		$date = date('d-m-Y');
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_users_visits WHERE user_id=".$user_id." AND date='".$date."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row)
			$this->db->query("UPDATE ".DB_PREFIX."_users_visits SET visits=visits+1 WHERE id=".$row->id." LIMIT 1");
		else
			$this->db->query("INSERT INTO ".DB_PREFIX."_users_visits VALUES (NULL, ".$user_id.", '".$date."', 1)");
	}
	public function deleteItem($id, $user_id)
	{
		$id = $this->formatSQL($id, 'int');
		$user_id = $this->formatSQL($user_id, 'int');
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_items WHERE id=".$id." AND user_id=".$user_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if ($row)
		{
			$this->db->query("DELETE FROM ".DB_PREFIX."_items_photos WHERE i_id=".$row->id);
			$this->db->query("DELETE FROM ".DB_PREFIX."_items WHERE id=".$row->id);
		}
		throw new Exception($this->infoMsg('ITEM_DELETED'));
	}
	public function updateItem($id, $type, $admin=false)
	{
		global $classUser;

		$queryUser = ($admin == false) ? ' AND user_id='.$classUser->userinfo->user_id : false;
		$id = $this->formatSQL($id, 'int');
		switch($type)
		{
			case 'show':
				if ($this->checkMember('ads', $this->classUser->userinfo->user_id))
				{
					$query = 'save_only=0';
					$msg = 'ITEM_HIDE';
					//check member
					if ($this->checkMemberPosition('ads', $classUser->userinfo->user_id, $id) == false) $this->addMemberPosition('ads', $classUser->userinfo->user_id, $id);
				#} else throw new Exception($this->errorMsg('MEMBER_EMPTY'));
			} else $this->redirect('funcs.php?name=items&file=payment&i_id='.$id);
			break;
			case 'hide':
				$query = 'save_only=1';
				$msg = 'ITEM_SHOW';
			break;
			case 'distinction':

				if ($this->classUser->is_member())
				{
					if ($this->checkMember('distinction', $this->classUser->userinfo->user_id))
					{
						$query = 'distinction=1';
						$msg = 'ITEM_DISTINCTION';
						//check member
						if ($this->checkMemberPosition('distinction', $classUser->userinfo->user_id, $id) == false) $this->addMemberPosition('distinction', $classUser->userinfo->user_id, $id);
					} else throw new Exception($this->errorMsg('MEMBER_EMPTY'));
				}
				else $this->redirect('funcs.php?name=items&file=payment&i_id='.$id);

			break;
			case 'bids':
				if ($this->checkMember('bids', $this->classUser->userinfo->user_id))
				{
					$query = 'bid='.time();
					$msg = 'ITEM_BIDS';
					//check member
					#if ($this->checkMemberPosition('bids', $classUser->userinfo->user_id, $id) == false) $this->addMemberPosition('bids', $classUser->userinfo->user_id, $id);
					$this->addMemberPosition('bids', $classUser->userinfo->user_id, $id);
				} else throw new Exception($this->errorMsg('MEMBER_EMPTY'));
			break;
		}

		$this->db->query("UPDATE ".DB_PREFIX."_items SET $query WHERE id=".$id.$queryUser." LIMIT 1");
		throw new Exception($this->infoMsg($msg));
	}
	public function getDateRange($start, $end)
	{
		return date('d-m-Y', $start).' - '.date('d-m-Y', $end);
	}
	public function getItemLangs($langs)
	{
		$langs = explode('|', $langs);
		$return = array();
		foreach ($langs as $key => $value) {
			$return[] = $value;
		}
		return $return;
	}
	private function photosMainCheck($i_id)
	{
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_items_photos WHERE i_id=".$this->formatSQL($i_id, 'int')." AND main=1 LIMIT 1")->fetch(PDO::FETCH_OBJ);
		return ($row) ? 0 : 1;
	}
	private function photosMainUpdate($i_id)
	{
		$i_id = $this->formatSQL($i_id, 'int');
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_items_photos WHERE i_id=".$i_id." AND main=1 LIMIT 1")->fetch(PDO::FETCH_OBJ);
		if (!$row) $this->db->query("UPDATE ".DB_PREFIX."_items_photos SET main=1 WHERE i_id=".$i_id." ORDER BY id ASC LIMIT 1");
	}
	public function filtersInputs($cat_id, $edit=false)
	{
		if ($cat_id == 0) return;

		if (is_array($cat_id)) $cat_id = end($cat_id);
		$cat_id = $this->formatSQL($cat_id, 'int');
		$query = str_replace('cat_id', 'cat_ip', $this->queryCat($cat_id));
		$query .= " OR cat_ip=''";

		$query = "SELECT * FROM ".DB_PREFIX."_filters WHERE 1".$query." GROUP BY f_id ORDER BY position ASC";
		$result = $this->db->query($query);

		$no = 1;
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			if ($edit)
			{
				$rowValue = $this->db->query("SELECT * FROM ".DB_PREFIX."_items_filters WHERE i_id=".$_SESSION['add']['id']." AND f_id=".$row->f_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
				$row->value = $rowValue->parameter;
			}
			else $row->value = $_SESSION['add']['par_'.$row->f_id];

			$this->classMain->dataTPLarrayList('par', $row, false);

			switch($row->type)
			{
				case 'ch':
					$i = 0;
					$result2 = $this->db->query("SELECT * FROM ".DB_PREFIX."_filters WHERE f_id='".$row->f_id."' ORDER BY position ASC, id ASC");
					while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
					{
						if ($edit)
						{
							$rowCh = $this->db->query("SELECT * FROM ".DB_PREFIX."_items_filters WHERE i_id=".$_SESSION['add']['id']." AND f_id=".$row2->f_id." AND value=".$row2->id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
							if ($rowCh) $row2->checked = true;
						}
						else $row2->checked = (is_array($_SESSION['add']['par_'.$row->f_id]) && in_array($row2->id, $_SESSION['add']['par_'.$row->f_id])) ? true : false;
						$this->classMain->dataTPLarrayList('par.ch', $row2);
						$i++;
					}
				break;
				case 's':
					$i = 0;
					$result2 = $this->db->query("SELECT * FROM ".DB_PREFIX."_filters WHERE f_id='".$row->f_id."' ORDER BY position ASC, id ASC");
					while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
					{
						if ($edit)
						{
							$rowCh = $this->db->query("SELECT * FROM ".DB_PREFIX."_items_filters WHERE i_id=".$_SESSION['add']['id']." AND f_id=".$row2->f_id." AND value=".$row2->id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
							if ($rowCh) $row2->selected = true;
						} else $row2->selected = ($_SESSION['add']['par_'.$row->f_id] == $row2->id) ? true : false;
						$this->classMain->dataTPLarrayList('par.s', $row2);
					}
				break;
			}
			if ($no == 4) $no = 0;
			$no++;
		}
	}
	private function filtersQueryCat($cat_id)
	{
		$cat_id = $this->formatSQL($cat_id, 'int');
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX.$this->catsDBname." WHERE id=".$cat_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);

		$query = ' AND cat_id_save';
		$query .= (empty($cat_id)) ? '=0' : ' IN ('.str_replace('.', ',', $row->ip).')';
		$query .= " OR cat_ip=''";
		return $query;
	}
	public function itemsFilters()
	{
		if ($_GET['type'] == 'companies') return;

		$cat_id = main::formatSQL($_GET['id'], 'int');
		//if ($cat_id == 0) return;

		$query = $this->filtersQueryCat($cat_id);
		$query = "SELECT * FROM ".DB_PREFIX."_filters WHERE 1".$query." GROUP BY f_id ORDER BY position ASC";

		$result = $this->db->query($query);
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			switch($row->type)
			{
				case 'ft':
					$row->value_1 = $this->formatSQL($_GET['par_'.$row->f_id][0]);
					$row->value_2 = $this->formatSQL($_GET['par_'.$row->f_id][1]);
				break;
				case 't':
					$row->value = $this->formatSQL($_GET['par_'.$row->f_id]);
				break;
			}
			$this->classMain->dataTPLarrayList('par', $row, false);
			$this->itemsFiltersInputs($row->f_id, $row->type);
		}
	}

	private function itemsFiltersInputs($f_id, $type)
	{
		$no = 0;
		$i = 0;
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_filters WHERE f_id=".$f_id." ORDER BY id ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			switch($type)
			{
				case 's':
					$row->selected = ($_GET['par_'.$f_id] == $row->id) ? true : false;
					$this->classMain->dataTPLarrayList('par.s', $row, false);
				break;
				case 'ch':
					$row->checked = (is_array($_GET['par_'.$f_id]) && in_array($row->id, $_GET['par_'.$f_id])) ? true : false;
					$this->classMain->dataTPLarrayList('par.ch', $row, false);
					if (!empty($checked)) $i++;
				break;
			}
		}
	}
	protected function setPaymentID()
	{
		$this->paymentItemID = $this->formatSQL($_GET['i_id']);
	}
	public function paymentInfo()
	{
		#if (!$this->classUser->is_user()) $this->classMain->redirect('funcs.php?name=user', 'error', $this->errorMsg('PERMISSION_LOGIN'));

		$this->setPaymentID();

		$query = "SELECT i.*, TRUNCATE(IFNULL(p.value, 0), 2) AS price
			FROM ".DB_PREFIX."_items i
			LEFT JOIN ".DB_PREFIX."_prices p ON (p.time=i.time AND p.type='add_cls')
			WHERE i.id=".$this->paymentItemID."
		LIMIT 1";
		$row = $this->db->query($query)->fetch(PDO::FETCH_OBJ);

		if (!$row) $this->redirect(false, $this->lang['_LANG_561']);

		$this->setItemPrice($row->id, $row->time, $row->promo_bold, $row->promo_backlight, $row->promo_distinction, $row->promo_mainpage, $row->cat_id);

		$row->title = $this->setLangVar('title', $row);
		$row->pay_sum = $this->itemPrice;
		$row->item_payment = true;
		$row->onload = 'updateAddPrice(this.value);';

		$this->classMain->dataTPLarray($row);

		$this->promoPrices('promo_bold', false);
		$this->promoPrices('promo_backlight', false);
		$this->promoPrices('promo_distinction', false);
		$this->promoPrices('promo_mainpage', false);
	}
	private function getTimePrice($time, $cat_ip)
	{
		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_prices WHERE type='add_cls' AND time=".$time." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		switch($row->value_type) {
			case 'cnst':
			default:
				return $row->value;
			break;
		}
	}
	private function setItemPrice($id, $time, $bold, $backlight, $distinction, $main_page, $cat_ip)
	{
		$time = ($this->itemInfo->active) ? $this->itemInfo->time : $this->formatSQL($time, 'int');

		$price = array();
		$price[] = $this->promoPrices('promo_bold', ($bold) ? $time : false, true);
		$price[] = $this->promoPrices('promo_backlight', ($backlight) ? $time : false, true);
		$price[] = $this->promoPrices('promo_distinction', ($distinction) ? $time : false, true);
		$price[] = $this->promoPrices('promo_mainpage', ($main_page) ? $time : false, true);
		if ($this->itemInfo->active == 0) $price[] = $this->getTimePrice($time, $cat_ip);

		$this->itemPrice = array_sum($price);
	}
	public function payForAdd($id, $time, $bold, $backlight, $distinction, $main_page)
	{
		include 'funcs/user/classes/payment.class.php';
		$classPayment = new payment;

		$row = $this->db->query("SELECT * FROM ".DB_PREFIX."_items WHERE id=".$this->formatSQL($id)." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		$this->itemInfo = $row;

		$this->setItemPrice($id, $time, $bold, $backlight, $distinction, $main_page, $row->cat_id);

		$funcArray = array(
			'func' => 'add_item',
			'id' => $row->id,
			'name' => $this->classMain->_LANG['_LANG_564'],
			'time' => $time,
			'time_name' => $this->classMain->_LANG['_LANG_489'],
			'promo' => array(
				'bold' => $bold,
				'distinction' => $distinction,
				'backlight' => $backlight,
				'mainpage' => $main_page
			)
		);
		$classPayment->setPayment($this->classUser->userinfo->user_id, $this->itemPrice, $funcArray);
	}
	public function fileDownload($id)
	{
		$row = $this->db->query("SELECT id, file, dir FROM ".DB_PREFIX."_items WHERE id=".main::formatSQL($id, 'int')." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		$fileDir = self::FOLDER_IMAGES.$row->dir.'/'.$row->id.'/'.$row->file;

		header('Content-Type: application/pdf');
		header("Content-disposition: attachment; filename=\"" . basename($fileDir) . "\"");
		readfile($fileDir);
	}
	private function addCharge($i_id, $type='add_offer')
	{
		$rowItem = $this->db->query("SELECT * FROM ".DB_PREFIX."_items WHERE id=".$i_id." LIMIT 1")->fetch(PDO::FETCH_OBJ);
		$rowPrice = $this->db->query("SELECT * FROM ".DB_PREFIX."_prices WHERE type='".$type."' AND cat_id='".$rowItem->cat_ip."' LIMIT 1")->fetch(PDO::FETCH_OBJ);
		$price = (empty($rowPrice)) ? 0 : $rowPrice->value;
		if ($price > 0)
		{
			$this->db->query("INSERT INTO ".DB_PREFIX."_users_balance (
													id,
													user_id,
													amount,
													date,
													ip
												) VALUES (
													NULL,
													".$rowItem->user_id.",
													-".$price.",
													".time().",
													'".$_SERVER['REMOTE_ADDR']."'
												)");
		}
	}
}

?>
