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

switch ($op)
{
	case 'prices-add-offer':

		if ($_POST['save'])
		{
			//add
			if ($_POST['new_value'])
			{
				$cat_id = (is_array($_POST['new_cat_id'])) ? end(array_filter($_POST['new_cat_id'])) : 0;
				$db->query("INSERT INTO ".DB_PREFIX."_prices VALUES (
					NULL,
					'add_offer',
					'',
					'".$classMain->formatSQL($_POST['new_value'])."',
					'".$classMain->formatSQL($_POST['new_value_type'])."',
					'".$classMain->formatSQL($_POST['new_time'])."',
					".$classMain->formatSQL($cat_id, 'int').",
					''
				)");
			}
			//update
			if (is_array($_POST['id']))
			{
				foreach ($_POST['id'] as $key => $value)
				{
					$cat_id = (is_array($_POST['cat_id'][$value])) ? $classMain->formatSQL(end(array_filter($_POST['cat_id'][$value])), 'int') : 0;
					$query = "UPDATE ".DB_PREFIX."_prices SET
						value='".$classMain->formatSQL($_POST['value'][$value])."',
						value_type='".$classMain->formatSQL($_POST['value_type'][$value])."',
						time='".$classMain->formatSQL($_POST['time'][$value], 'int')."',
						cat_id=".$cat_id."
						WHERE id=".$classMain->formatSQL($value, 'int')."
					";
					$db->query($query);
				}
			}
			//delete
			if (is_array($_POST['delete']))
			{
				foreach ($_POST['delete'] as $key => $value) $db->query("DELETE FROM ".DB_PREFIX."_prices WHERE id=".$classMain->formatSQL($value, 'int')." LIMIT 1");
			}
		}

		//list
		$result = $db->query("SELECT p.*, c.ip FROM ".DB_PREFIX."_prices p LEFT JOIN ".DB_PREFIX."_cats c ON (c.id=p.cat_id) WHERE 1 AND p.type='add_offer' ORDER BY p.value ASC, c.ip ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->name = $classMain->setLangVar('name', $row);
			$classMain->dataTPLarrayList('p', $row);

			//edit cats
			$ipArray = explode('.', $row->ip);
			foreach ($ipArray as $key => $value)
			{
				$classMain->dataTPLarrayList('p.c', array('id' => $value));
				$left_id = ($value == 0) ? 0 : "(SELECT left_id FROM ".DB_PREFIX."_cats WHERE id=".$classMain->formatSQL($value, 'int')." LIMIT 1)";
				$result2 = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE left_id=".$left_id);
				while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
				{
					$row2->name = $classMain->setLangVar('name', $row2);
					$classMain->dataTPLarrayList('p.c.cats', $row2);
				}
			}
			//edit time
			$result2 = $db->query("SELECT * FROM ".DB_PREFIX."_select_options WHERE name_tech='item_time' ORDER BY id ASC");
			while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
			{
				$row2->name = $classMain->setLangVar('name', $row2);
				$classMain->dataTPLarrayList('p.item_time', $row2);
			}
		}

		//add cats
		$result = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE level=1 ORDER BY position ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->name = $classMain->setLangVar('name', $row);
			$classMain->dataTPLarrayList('cats', $row);
		}
		//add time
		$classMain->optList('item_time');
	break;

	case 'prices-add-cls':

		if ($_POST['save'])
		{
			//add
			if ($_POST['new_value'])
			{
				$cat_id = (is_array($_POST['new_cat_id'])) ? end(array_filter($_POST['new_cat_id'])) : 0;
				$db->query("INSERT INTO ".DB_PREFIX."_prices VALUES (
					NULL,
					'add_cls',
					'',
					'".$classMain->formatSQL($_POST['new_value'])."',
					'".$classMain->formatSQL($_POST['new_value_type'])."',
					'".$classMain->formatSQL($_POST['new_time'])."',
					".$classMain->formatSQL($cat_id, 'int').",
					''
				)");
			}
			//update
			if (is_array($_POST['id']))
			{
				foreach ($_POST['id'] as $key => $value)
				{
					$cat_id = (is_array($_POST['cat_id'][$value])) ? $classMain->formatSQL(end(array_filter($_POST['cat_id'][$value])), 'int') : 0;
					$query = "UPDATE ".DB_PREFIX."_prices SET
						value='".$classMain->formatSQL($_POST['value'][$value])."',
						value_type='".$classMain->formatSQL($_POST['value_type'][$value])."',
						time='".$classMain->formatSQL($_POST['time'][$value], 'int')."',
						cat_id=".$cat_id."
						WHERE id=".$classMain->formatSQL($value, 'int')."
					";
					$db->query($query);
				}
			}
			//delete
			if (is_array($_POST['delete']))
			{
				foreach ($_POST['delete'] as $key => $value) $db->query("DELETE FROM ".DB_PREFIX."_prices WHERE id=".$classMain->formatSQL($value, 'int')." LIMIT 1");
			}
		}

		//list
		$result = $db->query("SELECT p.*, c.ip FROM ".DB_PREFIX."_prices p LEFT JOIN ".DB_PREFIX."_cats c ON (c.id=p.cat_id) WHERE 1 AND p.type='add_cls' ORDER BY p.value ASC, c.ip ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->name = $classMain->setLangVar('name', $row);
			$classMain->dataTPLarrayList('p', $row);

			//edit cats
			$ipArray = explode('.', $row->ip);
			foreach ($ipArray as $key => $value)
			{
				$classMain->dataTPLarrayList('p.c', array('id' => $value));
				$left_id = ($value == 0) ? 0 : "(SELECT left_id FROM ".DB_PREFIX."_cats WHERE id=".$classMain->formatSQL($value, 'int')." LIMIT 1)";
				$result2 = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE left_id=".$left_id);
				while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
				{
					$row2->name = $classMain->setLangVar('name', $row2);
					$classMain->dataTPLarrayList('p.c.cats', $row2);
				}
			}
			//edit time
			$result2 = $db->query("SELECT * FROM ".DB_PREFIX."_select_options WHERE name_tech='item_time' ORDER BY id ASC");
			while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
			{
				$row2->name = $classMain->setLangVar('name', $row2);
				$classMain->dataTPLarrayList('p.item_time', $row2);
			}
		}

		//add cats
		$result = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE level=1 ORDER BY position ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->name = $classMain->setLangVar('name', $row);
			$classMain->dataTPLarrayList('cats', $row);
		}
		//add time
		$classMain->optList('item_time');

		//item member info
		$dataTPL['item_member'] = $classMain->mainConfig->item_member;
	break;

	case 'prices-sms':
		if ($_POST['save'])
		{
			//add
			if ($_POST['new_text'])
			{
				$db->query("INSERT INTO ".DB_PREFIX."_sms VALUES (
					NULL,
					'".$classMain->formatSQL($_POST['new_text'])."',
					'".$classMain->formatSQL($_POST['new_number'])."',
					'".$classMain->formatSQL($_POST['new_price'])."',
					'".$classMain->formatSQL($_POST['new_tax'], 'int')."'
				)");
			}
			//update
			if (is_array($_POST['id']))
			{
				foreach ($_POST['id'] as $key => $value)
				{
					$db->query("UPDATE ".DB_PREFIX."_sms SET
						text='".$classMain->formatSQL($_POST['text'][$value])."',
						number='".$classMain->formatSQL($_POST['number'][$value])."',
						price='".$classMain->formatSQL($_POST['price'][$value])."',
						tax='".$classMain->formatSQL($_POST['tax'][$value], 'int')."'
					WHERE id=".$value." LIMIT 1");
				}
			}
			//delete
			if (is_array($_POST['delete']))
			{
				foreach ($_POST['delete'] as $key => $value) $db->query("DELETE FROM ".DB_PREFIX."_sms WHERE id=".$classMain->formatSQL($value, 'int')." LIMIT 1");
			}
		}

		//list
		$result = $db->query("SELECT * FROM ".DB_PREFIX."_sms ORDER BY price ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ)) $classMain->dataTPLarrayList('sms', $row);
	break;

	case 'prices-items-promo':

		$promoTypes = array(
			'promo_bold' => 'Pogrubienie',
			'promo_backlight' => 'Podświetlenie',
			'promo_distinction' => 'Wyróżnienie',
			'promo_mainpage' => 'Strona Główna'
		);
		$promoInfo = unserialize($classMain->mainConfig->promo_info);

		if ($_POST['save'])
		{
			foreach ($promoTypes as $key => $value)
			{
				foreach ($_POST['item_price'][$key] as $key2 => $value2)
				{
					#foreach ($_POST['item_price'][$key][$key2] as $key3 => $value3)
					#{
						$value2 = $classMain->formatSQL($value2);
						$value2 = (empty($value2)) ? 0 : str_replace(array(',', ' '), array('.', ''), $value2);
						$row = $db->query("SELECT * FROM ".DB_PREFIX."_config_prices WHERE value_type='".$key."' AND extra='".$key2."'")->fetch(PDO::FETCH_OBJ);
						if ($row) $query = "UPDATE ".DB_PREFIX."_config_prices SET value_from=".$value2." WHERE id=".$row->id." LIMIT 1";
						else $query = "INSERT INTO ".DB_PREFIX."_config_prices (value_from, value_type, extra) VALUES (".$value2.", '".$key."', '".$key2."')";
						$db->query($query);
					#}
				}
			}
			$promoInfoArray = array('promo_name' => $_POST['promo_name'], 'promo_text' => $_POST['promo_text']);
			$db->query("UPDATE ".DB_PREFIX."_config SET promo_info='".serialize($promoInfoArray)."' WHERE 1 LIMIT 1");

			$classMain->redirect(ADMIN_FILE.'.php?op=prices-items-promo');
		}

		foreach ($promoTypes as $key => $value)
		{
			$query = "SELECT so.name_".$classMain->defLang.", cf.value_from AS price FROM ".DB_PREFIX."_select_options so
			LEFT JOIN ".DB_PREFIX."_config_prices cf ON (cf.extra=so.name_".$classMain->defLang." AND cf.value_type='".$key."')
			WHERE so.name_tech='item_time'
			ORDER BY ABS(so.name_".$classMain->defLang.") ASC";
			$result = $db->query($query);
			while ($row = $result->fetch(PDO::FETCH_OBJ))
			{
				$row->item_promo_key = $key;
				$row->item_promo_value = $value;
				$row->name = $classMain->setLangVar('name', $row);
				$classMain->dataTPLarrayList('p', $row);
			}

			$dataTPL = array();
			$dataTPL['name_main'] = $value;
			$dataTPL['name'] = $key;
			$dataTPL['value_name'] = $promoInfo['promo_name'][$key];
			$dataTPL['value_text'] = $promoInfo['promo_text'][$key];
			$classMain->dataTPLarrayList('pi', $dataTPL);
		}

	break;

	case 'prices-stats':

		$dataTPL['daterange'] = ($_GET['daterange']) ? $_GET['daterange'] : date('01/m/Y').' - '.date('t/'.date('m/Y'));

		$date = str_replace('/', '-', $dataTPL['daterange']);
		$date = explode(' - ', $date);

		$queryWhere = " AND date BETWEEN ".strtotime($date[0])." AND ".strtotime($date[1]);
		$queryWhereActive = " AND date_end>".strtotime($date[1]);
		$queryWhereEnded = " AND date_end BETWEEN ".strtotime($date[0])." AND ".strtotime($date[1]);

		$dataTPL['sum'] = 0;
		$dataTPL['count'] = 0;

		$result = $db->query("SELECT * FROM ".DB_PREFIX."_member ORDER BY id ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$classMain->dataTPLarrayList('m', $row);

			$result2 = $db->query("SELECT * FROM ".DB_PREFIX."_member_periods WHERE m_id=".$row->id." ORDER BY price ASC");
			while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
			{
				$rowCountNew = $db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users_member WHERE m_id=".$row2->id.$queryWhere)->fetch(PDO::FETCH_OBJ);
				$rowCountActive = $db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users_member WHERE m_id=".$row2->id.$queryWhere)->fetch(PDO::FETCH_OBJ);
				$rowCountEnded = $db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users_member WHERE m_id=".$row2->id.$queryWhereEnded)->fetch(PDO::FETCH_OBJ);
				$rowSum = $db->query("SELECT SUM(price) AS sum FROM ".DB_PREFIX."_users_member WHERE m_id=".$row2->id.$queryWhere)->fetch(PDO::FETCH_OBJ);
				$row2->count_new = $rowCountNew->count;
				$row2->count_active = $rowCountActive->count;
				$row2->count_ended = $rowCountEnded->count;
				$row2->sum = number_format($rowSum->sum, 2);
				switch($row2->time_type)
				{
					case 'd': $row2->time = $row2->time; break;
					case 'w': $row2->time = $row2->time*7; break;
					case 'm': $row2->time = $row2->time*30; break;
				}
				$classMain->dataTPLarrayList('m.mp', $row2);
				$dataTPL['sum'] = $dataTPL['sum']+$row2->sum;
				$dataTPL['count_new'] = $dataTPL['count_new']+$row2->count_new;
				$dataTPL['count_active'] = $dataTPL['count_active']+$row2->count_active;
				$dataTPL['count_ended'] = $dataTPL['count_ended']+$row2->count_ended;
			}
			$dataTPL['sum'] = number_format($dataTPL['sum'], 2);
		}

		$date[0] = strtotime($date[0]);
		$date[1] = strtotime($date[1]);

		$result = $db->query("SELECT mp.*, m.name FROM ".DB_PREFIX."_member_periods mp LEFT JOIN ".DB_PREFIX."_member m ON (m.id=mp.m_id) ORDER BY mp.price ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			switch($row->time_type) {
				case 'd': $row->time = $row->time; break;
				case 'w': $row->time = $row->time*7; break;
				case 'm': $row->time = $row->time*30; break;
			}
			$classMain->dataTPLarrayList('mp', $row);
			$result2 = $db->query("SELECT um.*, u.username
				FROM ".DB_PREFIX."_users_member um
				LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=um.user_id)
				WHERE um.m_id=".$row->id." AND (date BETWEEN ".$date[0]." AND ".$date[1]." OR date_end>".$date[1]." OR date_end BETWEEN ".$date[0]." AND ".$date[1].")");
			while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
			{
				$row2->type_new = ($row2->date >= $date[0] && $row2->date <=$date[1]);
				$row2->type_active = ($row2->date_end >= $date[0] && $row2->date_end <=$date[1]);
				$row2->type_end = ($row2->date_end >= $date[0] && $row2->date_end <=$date[1]);
				$row2->date = date('d-m-Y', $row2->date);
				$row2->date_end = date('d-m-Y', $row2->date_end);
				if ($row2->type_new || $row2->type_active || $row2->type_end) $classMain->dataTPLarrayList('mp.um', $row2);
			}
		}
	break;
	case 'prices-else':

		if ($_POST['save-periods'])
		{
			if ($_POST['new_time'])
			{
				$db->query("INSERT INTO ".DB_PREFIX."_member_periods (
					id,
					m_id,
					time,
					time_type,
					price,
					f_product_id_pl
				) VALUES (
					NULL,
					".$classMain->formatSQL($_POST['m_id'], 'int').",
					".$classMain->formatSQL($_POST['new_time'], 'int').",
					'".$classMain->formatSQL($_POST['new_time_type'])."',
					'".$classMain->formatSQL($_POST['new_price'])."',
					'".$classMain->formatSQL($_POST['new_f_product_id'])."'
				)");
			}
			if (is_array($_POST['id']))
			{
				foreach ($_POST['id'] as $key => $value)
				{
					$query = "UPDATE ".DB_PREFIX."_member_periods SET
						time=".$classMain->formatSQL($_POST['time'][$value], 'int').",
						time_type='".$classMain->formatSQL($_POST['time_type'][$value])."',
						price='".$classMain->formatSQL($_POST['price'][$value])."',
						free_once='".$classMain->formatSQL($_POST['free_once'][$value], 'int')."'
						WHERE id=".$value." LIMIT 1";
					$db->query($query);
					$result = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs");
					while ($row = $result->fetch(PDO::FETCH_OBJ)) $db->query("UPDATE ".DB_PREFIX."_member_periods SET f_product_id_".$row->name_def."='".$_POST['f_product_id'][$value][$row->name_def]."' WHERE id=".$value." LIMIT 1");
				}
			}
			if (is_array($_POST['delete'])) foreach ($_POST['delete'] as $key => $value) $db->query("DELETE FROM ".DB_PREFIX."_member_periods WHERE id=".$value." LIMIT 1");
		}

		if ($_POST['save'])
		{
			if ($_POST['new_qty'])
			{
				switch ($_POST['new_type']) {
					case 'extra_ads':
						$extra_ads = $_POST['new_qty'];
					break;
					case 'extra_photos':
						$extra_photos = $_POST['new_qty'];
					break;
					case 'extra_bids':
						$extra_bids = $_POST['new_qty'];
					break;
					case 'extra_distinction':
						$extra_distinction = $_POST['new_qty'];
					break;
					case 'extra_main_page':
						$extra_main_page = $_POST['new_qty'];
					break;
				}
				$db->query("INSERT INTO ".DB_PREFIX."_member VALUES (
					NULL,
					1,
					'',
					".$classMain->formatSQL($extra_ads, 'int').",
					".$classMain->formatSQL($extra_photos, 'int').",
					".$classMain->formatSQL($extra_bids, 'int').",
					".$classMain->formatSQL($extra_distinction, 'int').",
					".$classMain->formatSQL($extra_main_page, 'int').",
					".$classMain->formatSQL($_POST['new_active'], 'int').",
					'".strtotime($classMain->formatSQL($_POST['new_active_end']))."',
					".$classMain->formatSQL($_POST['new_free'], 'int').",
					'".strtotime($classMain->formatSQL($_POST['new_free_end']))."'
				)");
			}
			if (is_array($_POST['id']))
			{
				foreach ($_POST['id'] as $key => $value)
				{
					$query = "UPDATE ".DB_PREFIX."_member SET
						extra_ads=0,
						extra_photos=0,
						extra_bids=0,
						extra_distinction=0,
						extra_main_page=0,
						".$classMain->formatSQL($_POST['type'][$value])."='".$classMain->formatSQL($_POST['qty'][$value], 'int')."',
						active=".$classMain->formatSQL($_POST['active'][$value], 'int').",
						active_end='".strtotime($classMain->formatSQL($_POST['active_end'][$value]))."',
						free=".$classMain->formatSQL($_POST['free'][$value], 'int').",
						free_end='".strtotime($classMain->formatSQL($_POST['free_end'][$value]))."'
						WHERE id=".$value." LIMIT 1";
					$db->query($query);
				}
			}
			if (is_array($_POST['delete'])) foreach ($_POST['delete'] as $key => $value) $db->query("DELETE FROM ".DB_PREFIX."_member WHERE id=".$value." LIMIT 1");
		}

		$result = $db->query("SELECT * FROM ".DB_PREFIX."_member WHERE type=1 ORDER BY id ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->active_end = ($row->active_end) ? date('d-m-Y', $row->active_end) : false;
			$row->free_end = ($row->free_end) ? date('d-m-Y', $row->free_end) : false;
			$classMain->dataTPLarrayList('m', $row);

			$result2 = $db->query("SELECT * FROM ".DB_PREFIX."_member_periods WHERE m_id=".$row->id." ORDER BY price ASC");
			while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
			{
				$classMain->dataTPLarrayList('m.mp', $row2);
				$result3 = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs");
				while ($row3 = $result3->fetch(PDO::FETCH_OBJ))
				{
					$row3->f_product_id = $classMain->setLangVar('f_product_id', $row2, $row3->name_def);
					$classMain->dataTPLarrayList('m.mp.lngs', $row3);
				}
				$result4 = $db->query("SELECT * FROM ".DB_PREFIX."_sms ORDER BY price ASC");
				while ($row4 = $result4->fetch(PDO::FETCH_OBJ)) $classMain->dataTPLarrayList('m.mp.sms', $row4);
			}
			$result4 = $db->query("SELECT * FROM ".DB_PREFIX."_sms ORDER BY price ASC");
			while ($row4 = $result4->fetch(PDO::FETCH_OBJ)) $classMain->dataTPLarrayList('m.sms', $row4);
		}
	break;
	case 'prices-members':

		if ($_POST['save-periods'])
		{
			if ($_POST['new_time'])
			{
				$query = "INSERT INTO ".DB_PREFIX."_member_periods  (id, m_id, time, time_type, price, f_product_id_pl, free_once, sms_id) VALUES (
					NULL,
					".$classMain->formatSQL($_POST['m_id'], 'int').",
					".$classMain->formatSQL($_POST['new_time'], 'int').",
					'".$classMain->formatSQL($_POST['new_time_type'])."',
					'".$classMain->formatSQL($_POST['new_price'])."',
					'".$classMain->formatSQL($_POST['new_f_product_id'])."',
					".$classMain->formatSQL($_POST['new_free_once'], 'int').",
					".$classMain->formatSQL($_POST['new_sms_id'], 'int')."
				)";

				$db->query($query);
			}
			if (isset($_POST['id']) && is_array($_POST['id']))
			{
				foreach ($_POST['id'] as $key => $value)
				{
					$db->query("UPDATE ".DB_PREFIX."_member_periods SET
						time=".$classMain->formatSQL($_POST['time'][$value], 'int').",
						time_type='".$classMain->formatSQL($_POST['time_type'][$value])."',
						price='".$classMain->formatSQL($_POST['price'][$value])."',
						free_once='".$classMain->formatSQL($_POST['free_once'][$value], 'int')."',
						sms_id='".$classMain->formatSQL($_POST['sms_id'][$value], 'int')."'
						WHERE id=".$value." LIMIT 1");

					$result = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs");
					while ($row = $result->fetch(PDO::FETCH_OBJ)) $db->query("UPDATE ".DB_PREFIX."_member_periods SET f_product_id_".$row->name_def."='".$_POST['f_product_id'][$value][$row->name_def]."' WHERE id=".$value." LIMIT 1");
				}
			}
			if (is_array($_POST['delete'])) foreach ($_POST['delete'] as $key => $value) $db->query("DELETE FROM ".DB_PREFIX."_member_periods WHERE id=".$value." LIMIT 1");
		}

		if ($_POST['save'])
		{
			if ($_POST['new_name'])
			{
				$_POST['new_active_end'] = (empty($_POST['new_active_end'])) ? 0 : intval(strtotime($classMain->formatSQL($_POST['new_active_end'])));
				$_POST['new_free_end'] = (empty($_POST['new_free_end'])) ? 0 : intval(strtotime($classMain->formatSQL($_POST['new_free_end'])));
				$query = "INSERT INTO ".DB_PREFIX."_member VALUES (
					NULL,
					0,
					'".$classMain->formatSQL($_POST['new_name'])."',
					".$classMain->formatSQL($_POST['new_extra_ads'], 'int').",
					".$classMain->formatSQL($_POST['new_extra_photos'], 'int').",
					".$classMain->formatSQL($_POST['new_extra_bids'], 'int').",
					".$classMain->formatSQL($_POST['new_extra_distinction'], 'int').",
					".$classMain->formatSQL($_POST['new_extra_main_page'], 'int').",
					".$classMain->formatSQL($_POST['new_active'], 'int').",
					".$_POST['new_active_end'].",
					".$classMain->formatSQL($_POST['new_free'], 'int').",
					".$_POST['new_free_end']."
				)";
				$db->query($query);
			}
			foreach ($_POST['id'] as $key => $value)
			{
				$query = "UPDATE ".DB_PREFIX."_member SET
					name='".$classMain->formatSQL($_POST['name'][$value])."',
					extra_ads=".$classMain->formatSQL($_POST['extra_ads'][$value], 'int').",
					extra_photos=".$classMain->formatSQL($_POST['extra_photos'][$value], 'int').",
					extra_bids=".$classMain->formatSQL($_POST['extra_bids'][$value], 'int').",
					extra_distinction=".$classMain->formatSQL($_POST['extra_distinction'][$value], 'int').",
					active=".$classMain->formatSQL($_POST['active'][$value], 'int').",
					active_end=".intval(strtotime($classMain->formatSQL($_POST['active_end'][$value]))).",
					free=".$classMain->formatSQL($_POST['free'][$value], 'int').",
					free_end=".intval(strtotime($classMain->formatSQL($_POST['free_end'][$value])))."
					WHERE id=".$value." LIMIT 1";

				$db->query($query);
			}
			if (is_array($_POST['delete'])) foreach ($_POST['delete'] as $key => $value) $db->query("DELETE FROM ".DB_PREFIX."_member WHERE id=".$value." LIMIT 1");
		}

		$result = $db->query("SELECT * FROM ".DB_PREFIX."_member WHERE type=0 ORDER BY id ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->active_end = ($row->active_end) ? date('d-m-Y', $row->active_end) : false;
			$row->free_end = ($row->free_end) ? date('d-m-Y', $row->free_end) : false;
			$classMain->dataTPLarrayList('m', $row);

			$result2 = $db->query("SELECT * FROM ".DB_PREFIX."_member_periods WHERE m_id=".$row->id." ORDER BY price ASC");
			while ($row2 = $result2->fetch(PDO::FETCH_OBJ))
			{
				$classMain->dataTPLarrayList('m.mp', $row2);
				$result3 = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs");
				while ($row3 = $result3->fetch(PDO::FETCH_OBJ))
				{
					$row3->f_product_id = $classMain->setLangVar('f_product_id', $row2, $row3->name_def);
					$classMain->dataTPLarrayList('m.mp.lngs', $row3);
				}
				$result4 = $db->query("SELECT * FROM ".DB_PREFIX."_sms ORDER BY price ASC");
				while ($row4 = $result4->fetch(PDO::FETCH_OBJ)) $classMain->dataTPLarrayList('m.mp.sms', $row4);
			}
			$result4 = $db->query("SELECT * FROM ".DB_PREFIX."_sms ORDER BY price ASC");
			while ($row4 = $result4->fetch(PDO::FETCH_OBJ)) $classMain->dataTPLarrayList('m.sms', $row4);
		}

		$result = $db->query("SELECT * FROM ".DB_PREFIX."_sms ORDER BY price ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$classMain->dataTPLarrayList('sms', $row);
		}

	break;
	case 'promo-codes':

		 if ($_POST['save'])
		 {
			 for ($i=0; $i < $_POST['quantity']; $i++)
			 {
				 $db->query("INSERT INTO ".DB_PREFIX."_promo_codes VALUES (
					 NULL,
					 0,
					 '".strtoupper(uniqid())."',
					 '".$classMain->formatSQL($_POST['discount'])."',
					 ".time().",
					 ".strtotime($_POST['date_end']).",
					 0
					)");
			 }
		 }
		 $result = $db->query("SELECT pc.*, u.username FROM ".DB_PREFIX."_promo_codes pc LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=pc.user_id) ORDER BY pc.id DESC");
		 while ($row = $result->fetch(PDO::FETCH_OBJ))
		 {
			 $row->date_start = date('d-m-Y', $row->date_start);
			 $row->date_end = date('d-m-Y', $row->date_end);
			 $row->date_used = date('d-m-Y', $row->date_used);
			 $classMain->dataTPLarrayList('pc', $row);
		 }
	break;
}

$dataTPL['op'] = $op;
$classMain->dataTPLarray($dataTPL);
$adminClass->OpenTableAdmin();
$classMain->tpl('prices.tpl');
$adminClass->CloseTableAdmin();
?>
