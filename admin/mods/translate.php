<?php

/****************************************************************/
/*	UWAGA! SKRYPT NIE JEST DARMOWY.								*/
/*	DALSZE ROZPOWSZECHNIANIE BEZ ZGODY 							*/
/*	FIRMY JMLNET JEST ZABRONIONE.								*/
/****************************************************************/
/****************************************************************/
/*	PRODUCENT OPROGRAMOWANIA	JMLnet							*/
/*	name SKRYPTU:				SKRYPT AUKCYJNY	PRO				*/
/*	WERSJA:						1.31							*/
/*	KONTAKT:					INFO@JMLNET.PL					*/
/****************************************************************/
/* Copyright (c) JMLnet. Wszelkie prawa zastrzeone.				*/
/****************************************************************/

if (!defined('ADMIN_FILE')) die ("Access Denied");

switch($op)
{
	default:
		if ($_POST['zapisz'] == 1)
		{
			$rowLT = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE id=".intval($classMain->formatSQL($_POST['lang_id']))." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

			$file = 'lang/lang-'.$rowLT['name_def'].'.php';

			#if (!file_exists($file))
			#{
				$dane = '<?php'."\n"
				."\n"
				.'/****************************************************************/'."\n"
				.'/*	UWAGA! SKRYPT NIE JEST DARMOWY.								*/'."\n"
				.'/*	DALSZE ROZPOWSZECHNIANIE BEZ ZGODY 							*/'."\n"
				.'/*	FIRMY JMLNET JEST ZABRONIONE.								*/'."\n"
				.'/****************************************************************/'."\n"
				.'/****************************************************************/'."\n"
				.'/*	PRODUCENT OPROGRAMOWANIA	JMLnet							*/'."\n"
				.'/*	name SKRYPTU:				SERWIS OGLOSZEN JMLNET					*/'."\n"
				.'/*	WERSJA:						1.01							*/'."\n"
				.'/*	KONTAKT:					INFO@JMLNET.PL					*/'."\n"
				.'/****************************************************************/'."\n"
				.'/* Copyright (c) JMLnet. Wszelkie prawa zastrzeone.				*/'."\n"
				.'/****************************************************************/'."\n"
				."\n"
				.'$_LANG = array('."\n";
			#}
			#else
			#{
				include($file);
				$langArray = $_LANG;
				$_LANG = false;
			#}

			for ($i=0; $i < count($_POST['lang-key']); $i++)
			{
				unset($langArray[$_POST['lang-key'][$i]]);
				$dane .= '\''.$_POST['lang-key'][$i].'\' => \''.addslashes($_POST['lang-text'][$i]).'\','."\n";
			}

			$langArrayKeys = array_keys($langArray);
			for ($i=0; $i < count($langArrayKeys); $i++)
			{
				$dane .= '\''.$langArrayKeys[$i].'\' => \''.addslashes($langArray[$langArrayKeys[$i]]).'\','."\n";
			}

			$dane .= ');';

			$fp = fopen($file, 'w');
			fwrite($fp, $dane);
			fclose($fp);
		}

		//get default lang data
		$rowLD = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE def=1 LIMIT 1")->fetch(PDO::FETCH_ASSOC);

		//get lang to translate
		if ($_GET['lang-file'])
		{
			$rowLT = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE id=".intval($classMain->formatSQL($_GET['lang-file']))." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

			include 'lang/lang-'.$rowLD['name_def'].'.php';
			$langD = $_LANG;
			$_LANG = false;

			if (file_exists('lang/lang-'.$rowLT['name_def'].'.php'))
			{
				include 'lang/lang-'.$rowLT['name_def'].'.php';
				$langT = $_LANG;
				$_LANG = false;
			}

			$arrayKeys = array_keys($langD);

			//words list
			if ($_GET['file'])
			{
				$result = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs_keys WHERE file='".$_GET['file']."' ORDER BY id ASC");
				while ($row = $result->fetch(PDO::FETCH_OBJ))
				{
					$info['id'] = $row->key_lang;
					$info['name'] = htmlspecialchars($langT[$info['id']], ENT_QUOTES);
					$info['name_default'] = $langD[$info['id']];
					if ($info['name_default']) $classMain->dataTPLarrayList('lt', $info);
				}
			}
			else
			{
				$limit = 100;
				$count = count($arrayKeys);
				$page = intval($_GET['page']);
				$start = $page*$limit;
				$stop = $start+$limit;
				$stop = ($stop > $count) ? $count : $stop;

				for ($i=$start; $i < $stop; $i++)
				{
					$info['id'] = $arrayKeys[$i];
					$info['name'] = htmlspecialchars($langT[$info['id']], ENT_QUOTES);
					$info['name_default'] = $langD[$info['id']];
					$classMain->dataTPLarrayList('lt', $info);
				}

				//pagination
				for ($i=0; $i < round($count/$limit); $i++)
				{
					$pag['page'] = $i;
					$pag['page_name'] = $i+1;
					$pag['active'] = ($_GET['page'] == $i) ? true : false;
					$pag['lang-file'] = $_GET['lang-file'];
					$classMain->dataTPLarrayList('pag', $pag);
				}
			}
		}

		if (isset($_POST['save']))
		{
			//add new lang
			if ($_POST['name'] && $_POST['name_def'])
			{
				$name_def = strtolower($classMain->convertString($_POST['name_def']));
				if ($_POST['def'] == 1) $db->query("UPDATE ".DB_PREFIX."_config_langs SET def=0 WHERE def=1");

				$db->query("INSERT INTO ".DB_PREFIX."_config_langs VALUES (NULL, '".$_POST['name']."', '".$name_def."', ".intval($_POST['def']).", ".intval($_POST['aktywny']).")");
				$db->query("ALTER TABLE ".DB_PREFIX."_cats
					ADD name_".$name_def." VARCHAR(255) NOT NULL,
					ADD meta_desc_".$name_def." VARCHAR(255) NOT NULL,
					ADD meta_keywords_".$name_def." VARCHAR(255) NOT NULL
				");
				$db->query("ALTER TABLE ".DB_PREFIX."_cats_profiles
					ADD name_".$name_def." VARCHAR(255) NOT NULL,
					ADD meta_desc_".$name_def." VARCHAR(255) NOT NULL,
					ADD meta_keywords_".$name_def." VARCHAR(255) NOT NULL
				");
				$db->query("ALTER TABLE ".DB_PREFIX."_select_options ADD name_".$name_def." VARCHAR(255) NOT NULL");

				//contents
				$db->query("ALTER TABLE ".DB_PREFIX."_contents
					ADD title_".$name_def." VARCHAR(255) NOT NULL,
					ADD text_".$name_def." TEXT NOT NULL,
					ADD meta_desc_".$name_def." VARCHAR(255) NOT NULL,
					ADD meta_keywords_".$name_def." VARCHAR(255) NOT NULL
				");

				//news
				$db->query("ALTER TABLE ".DB_PREFIX."_news
					ADD title_".$name_def." VARCHAR(255) NOT NULL,
					ADD text_intro_".$name_def." TEXT NOT NULL,
					ADD text_".$name_def." TEXT NOT NULL
				");
			}

			//save changes
			for ($i=0; $i < count($_POST['edytuj_name']); $i++)
			{
				$namename_defu = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE id=".$_POST['id'][$i])->fetch(PDO::FETCH_ASSOC);
				$name_def = strtolower($classMain->convertString($_POST['edytuj_name'][$i]));
				$db->query("UPDATE ".DB_PREFIX."_config_langs SET
															name='".$_POST['edytuj_name'][$i]."',
															name_def='".$name_def."',
															def=".intval($_POST['edytuj_domyslny'][$i]).",
															active=".intval($_POST['edytuj_aktywny'][$i])."
															WHERE id=".intval($_POST['id'][$i])." LIMIT 1");
				$db->query("ALTER TABLE ".DB_PREFIX."_cats CHANGE name_".$namename_defu['name_def']." name_".$name_def." VARCHAR(255) NOT NULL");
				$db->query("ALTER TABLE ".DB_PREFIX."_cats_profiles CHANGE name_".$namename_defu['name_def']." name_".$name_def." VARCHAR(255) NOT NULL");
				$db->query("ALTER TABLE ".DB_PREFIX."_select_options CHANGE name_".$namename_defu['name_def']." name_".$name_def." VARCHAR(255) NOT NULL");
				//aktualnosci
				$db->query("ALTER TABLE ".DB_PREFIX."_news
													CHANGE text_intro_".$namename_defu['name_def']." text_intro_".$name_def." TEXT NOT NULL,
													CHANGE text_".$namename_defu['name_def']." text_".$name_def." TEXT NOT NULL,
													CHANGE title_".$namename_defu['name_def']." title_".$name_def." TEXT NOT NULL
				");
			}

			//delete position
			for ($i=0; $i < count($_POST['usun']); $i++)
			{
				$row = $db->query("SELECT name_def FROM ".DB_PREFIX."_config_langs WHERE id=".$_POST['usun'][$i])->fetch(PDO::FETCH_ASSOC);
				$db->query("DELETE FROM ".DB_PREFIX."_config_langs WHERE id=".$_POST['usun'][$i]);
				$db->query("ALTER TABLE ".DB_PREFIX."_cats DROP name_".$row['name_def']);
				$db->query("ALTER TABLE ".DB_PREFIX."_cats_profiles DROP name_".$row['name_def']);
				$db->query("ALTER TABLE ".DB_PREFIX."_select_options DROP name_".$row['name_def']);
				$db->query("ALTER TABLE ".DB_PREFIX."_news
					DROP title_".$row['name_def'].",
					DROP text_".$row['name_def'].",
					DROP text_intro_".$row['name_def']."
				");
			}

			header('Location: '.ADMIN_FILE.'.php?op=translate&info=Ustawienia+serwisu+zostały+zapisane');
			exit;
		}

		//langs to transalte
		$result = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs ORDER BY def DESC, name ASC");
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) $classMain->dataTPLarrayList('lang', $row);

		//lang list
		$no = 0;
		$result = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs ORDER BY def DESC, name ASC");
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$row['no'] = $no;
			$classMain->dataTPLarrayList('t_langs', $row);
			$no++;
		}

		$files = scandir('theme');
		$files2 = scandir('theme/emails');
		$files = array_merge($files, $files2);
		foreach ($files as $key => $value)
		{
			if (preg_match("/.tpl/i", $value) || preg_match("/.php/i", $value)) $classMain->dataTPLarrayList('f', array('file' => $value));
		}

		$dataTPL =array(
								'TRYB_MULTI_N' => ($mainConfig['tryb_multijezykowy'] == 'n') ? ' checked' : '',
								'TRYB_MULTI_Y' => ($mainConfig['tryb_multijezykowy'] == 'y') ? ' checked' : '',

								'OP' => $_GET['op'],

								'LANG' => $classMain->formatSQL($_GET['lang-file']),
								'LANG_DEFAUL' => $rowLD['name'],
								'LANG_TRANSLATE' => $rowLT['name'],
								'FILE' => $_GET['file']
		);
	break;

	case "translate-cats":

		if ($_POST['zapisz'])
		{
			for ($i=0; $i < count($_POST['id']); $i++)
			{
				//lista pól dla języków
				$result2 = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE def!=1 ORDER BY name ASC");
				while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
				{
					$query = "UPDATE ".DB_PREFIX."_cats SET
										name_".$row2['name_def']."='".$classMain->formatSQL($_POST[$row2['name_def']][$_POST['id'][$i]])."',
										meta_desc_".$row2['name_def']."='".$classMain->formatSQL($_POST['meta_desc_'.$row2['name_def']][$_POST['id'][$i]])."',
										meta_keywords_".$row2['name_def']."='".$classMain->formatSQL($_POST['meta_keywords_'.$row2['name_def']][$_POST['id'][$i]])."'
										WHERE id=".intval($_POST['id'][$i])." LIMIT 1";
					$db->query($query);
				}
			}
		}

		$poziom = ($_GET['poziom']) ? $classMain->formatSQL($_GET['poziom'], 'int') : 1;
		$cat_id_DB = ($_GET['cat_id']) ? " AND left_id=".$classMain->formatSQL($_GET['cat_id'], 'int') : false;

		//pobieranie kategorii wyżej
		$cat_up = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE id=".$classMain->formatSQL($_GET['cat_id'], 'int')." LIMIT 1")->fetch(PDO::FETCH_ASSOC);
		if ($cat_up) $cat_up_data = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE id=".$cat_up['left_id']." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

		$result = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE def!=1 ORDER BY name ASC");
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) $classMain->dataTPLarrayList('lang', $row);

		$result = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE level='".$poziom."'".$cat_id_DB." ORDER BY position ASC");
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$classMain->dataTPLarrayList('tcats', array(
													'POZIOM_WYZEJ' => $poziom+1,

													'ID' => $row['id'],
													'NAZWA' => $row['name_'.$classMain->defLang],

													'POLA_JEZYKOW' => $TPL_polaJezykow,
			));

			//lista pól dla języków
			$result2 = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE def!=1 ORDER BY name ASC");
			while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
			{
				$jezyk = $db->query("SELECT * FROM ".DB_PREFIX."_cats WHERE id=".$row['id']." LIMIT 1")->fetch(PDO::FETCH_ASSOC);
				$row2['value'] = $jezyk['name_'.$row2['name_def']];
				$row2['meta_desc'] = $jezyk['meta_desc_'.$row2['name_def']];
				$row2['meta_keywords'] = $jezyk['meta_keywords_'.$row2['name_def']];
				$classMain->dataTPLarrayList('tcats.langs', $row2);
			}

		}

		$dataTPL = array(
								'OP' => $op,

								'POZIOM' => $_GET['poziom'],
								'NAZWA_NIZEJ' => (!$cat_up_data['name_'.$classMain->defLang]) ? 'Start' : $cat_up_data['name_'.$classMain->defLang],
								'POZIOM_NIZEJ' => $_GET['poziom']-1,
								'CAT_ID' => $cat_up_data['id'],

								'JEZYKI_TOP' => $TPL_jezyki
		);
	break;

	case 'translate-options':

		if ($_POST['zapisz'])
		{
			for ($i=0; $i < count($_POST['id']); $i++)
			{
				//lista pól dla języków
				$result2 = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE def!=1 ORDER BY name ASC");
				while ($row2 = $result2->fetch(PDO::FETCH_ASSOC)) $db->query("UPDATE ".DB_PREFIX."_select_options SET name_".$row2['name_def']."='".$_POST[$row2['name_def']][$_POST['id'][$i]]."' WHERE id=".$_POST['id'][$i]." LIMIT 1");
			}
		}

		//lista języków
		$result = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE def!=1 ORDER BY name ASC");
		while ($row = $result->fetch(PDO::FETCH_ASSOC)) $classMain->dataTPLarrayList('lang', $row);

		$result = $db->query("SELECT * FROM ".DB_PREFIX."_select_options ORDER BY name_tech ASC");
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$row['opcja'] = $row['name_'.$classMain->defLang];
			$classMain->dataTPLarrayList('ow', $row);

			//lista pól dla języków
			$result2 = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE def!=1 ORDER BY name ASC");
			while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
			{
				$jezyk = $db->query("SELECT * FROM ".DB_PREFIX."_select_options WHERE id=".$row['id']." LIMIT 1")->fetch(PDO::FETCH_ASSOC);
				$row2['value'] = $jezyk['name_'.$row2['name_def']];
				$classMain->dataTPLarrayList('ow.langs', $row2);
			}
		}
		$dataTPL = array('OP' => $op);
	break;

	case 'translate-parms':
		$nr = 0;
		$result = $db->query("SELECT * FROM ".DB_PREFIX."_parametry GROUP BY par_id ORDER BY nazwa_".$classMain->defLang." ASC");
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$classMain->dataTPLarrayList('parametry', array(
													'NAZWA' => $row['nazwa_'.$classMain->defLang],
													'ID' => $row['id'],
													'PAR_ID' => $row['par_id'],
													'TYP' => $row['typ'],
													'KATEGORIA' => kategoria($row['cat_id_save']),
													'NO' => $nr
			));
			$nr++;
		}
		$dataTPL = array('OP' => $op);
	break;
	case 'translate-parms-list':

		if (isset($_POST['zapisz']))
		{
			//save name and parms
			for ($i=0; $i < count($_POST['parms_id']); $i++)
			{
				$result = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE def!=1");
				while ($row = $result->fetch(PDO::FETCH_ASSOC))
				{
					$db->query("UPDATE ".DB_PREFIX."_parametry SET
						nazwa_".$row['name_def']."='".$_POST['nazwa_'.$row['name_def']]."',
						parametr_".$row['name_def']."='".$classMain->formatSQL($_POST['parms_'.$row['name_def']][$_POST['parms_id'][$i]])."'
						WHERE id=".intval($_POST['parms_id'][$i])." LIMIT 1");
				}
			}
			$classMain->redirect($_SERVER['REQUEST_URI'].'&info=Zmiany+zostały+zapisane');
		}

		$query = "SELECT * FROM ".DB_PREFIX."_parametry WHERE par_id=".intval($_GET['par_id']);

		//lista parametrów
		$result = $db->query($query.' ORDER BY id ASC');
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$classMain->dataTPLarrayList('parms', array(
													'ID' => $row['id'],
													'NAZWA' => $row['parametr_'.$classMain->defLang],
			));
		}

		//ogólne dane parametru
		$daneParametru = $db->query($query." LIMIT 1")->fetch(PDO::FETCH_ASSOC);

		$dataTPL = array();
		$result = $db->query("SELECT * FROM ".DB_PREFIX."_config_langs WHERE def!=1 ORDER BY name ASC");
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$row['value'] = $daneParametru['nazwa_'.$row['name_def']];
			$classMain->dataTPLarrayList('lang', $row);

			$result2 = $db->query($query.' ORDER BY id ASC');
			while ($row2 = $result2->fetch(PDO::FETCH_ASSOC))
			{
				$row2['nazwa'] = $row2['parametr_'.$row['name_def']];
				$classMain->dataTPLarrayList('lang.parms', $row2);
			}
		}

		$dataTPL = array(
								'OP' => $op,

								'NAZWA' => $daneParametru['nazwa_'.$classMain->defLang],
								'PAR_ID' => $daneParametru['par_id'],

								'MARK_L' => $daneParametru['mark_l'],
								'MARK_R' => $daneParametru['mark_r']
		);
	break;
}

$classMain->dataTPLarray($dataTPL);

$adminClass->setTPL('translate.tpl');
?>
