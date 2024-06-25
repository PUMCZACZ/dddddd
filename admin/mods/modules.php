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

global $prefix, $db, $admin_file;
$aid = substr("$aid", 0,25);
$row = $db->query("SELECT radminsuper FROM " . $prefix . "_authors WHERE aid='$aid'")->fetch_array(MYSQLI_ASSOC);
if ($row['radminsuper'] == 1) {

	function modules() {

		global $prefix, $admin_file, $adminClass, $db;

		$modlist = glob('funcs/*', GLOB_ONLYDIR);
		for ($i=0; $i < count($modlist); $i++) {
			$modlist[$i] = str_replace('funcs/', '', $modlist[$i]);
			if(!empty($modlist[$i])) {
				$row = $db->query("SELECT mid FROM " . $prefix . "_funcs WHERE title='".$modlist[$i]."'")->fetch_array(MYSQLI_ASSOC);
				$mid = intval($row['mid']);
				if (empty($mid)) $db->query("INSERT INTO ".$prefix."_funcs VALUES (NULL, '".$modlist[$i]."', '".$modlist[$i]."', 0, 0, 1, 0, '')");
			}
		}
		$result2 = $db->query("SELECT title from " . $prefix . "_funcs");
		while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
			$title = $row2['title'];
			$a = 0;
			$handle=opendir('funcs');
			while ($file = readdir($handle)) {
				if ($file == $title) {
					$a = 1;
				}
			}
			closedir($handle);
			if ($a == 0) {
				#$db->query("DELETE FROM ".$prefix."_funcs WHERE title='".$title."'");
			}
		}
		$adminClass->OpenTableAdmin();
		?>
		<div id="menuAdmin">
			<ul>
				<li><a href="<?php echo $admin_file; ?>.php?op=mod_authors">Administratorzy</a></li>
				<li><a href="<?php echo $admin_file; ?>.php?op=backup">Kopia zapasowa bazy danych</a></li>
				<li><a href="<?php echo $admin_file; ?>.php?op=ipban">IP Ban</a></li>
				<li><a href="<?php echo $admin_file; ?>.php?op=optimize">Optymalizacja bazy danych</a></li>
				<li><a href="<?php echo $admin_file; ?>.php?op=modules">Ustawienia modułów</a></li>
			</ul>
		</div>
		<h3>Administracja modułami</h3>
		<form action="<?php echo $admin_file; ?>.php" method="post">
		<table id="adminTable">
			<tr>
				<td align="center"><strong>Nazwa</strong></td>
				<td align="center"><strong>Status</strong></td>
				<td align="center"><strong>Opcje</strong></td>
			</tr>
			<?php
			$main_m = $db->query("SELECT main_func from " . $prefix . "_main")->fetch_array(MYSQLI_ASSOC);
			$main_module = $main_m['main_func'];
			$result3 = $db->query("SELECT mid, title, custom_title, active, view, inmenu, mod_group FROM ".$prefix."_funcs ORDER BY title ASC");
			while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)) {
				$mid = intval($row3['mid']);
				$title = $row3['custom_title'];
				$active = intval($row3['active']);
				$view = intval($row3['view']);
				$inmenu = intval($row3['inmenu']);
				$mod_group = intval($row3['mod_group']);
				if (empty($custom_title)) {
					$custom_title = str_replace("_", " ", $title);
					$db->query("update " . $prefix . "_funcs set custom_title='".$custom_title."' where mid='".$mid."'");
				}
				if ($active == 1) {
					$active = '<img src="images/active.gif" alt="Aktywny" title="Aktywny" border="0">';
					$change = '<img src="images/inactive.gif" alt="Deaktywuj" title="Deaktywuj" border="0">';
					$act = 0;
				} else {
					$active = '<img src="images/inactive.gif" alt="Nieaktywny" title="Nieaktywny" border="0">';
					$change = '<img src="images/active.gif" alt="Aktywuj" title="Aktywuj" border="0">';
					$act = 1;
				}
			if (empty($custom_title)) {
				$custom_title = ereg_replace("_", " ", $title);
			}
			if ($row3['title'] == $main_module) {
				$title = '<strong>'.$title.'</strong>';
				$active = $active.' <img src="images/key.gif" alt="Na stronie głównej" title="Na stronie głównej" border="0">';
				$puthome = '<img src="images/key_x.gif" alt="Na stronie głównej" title="Na stronie głównej" border="0">';
				$change_status = $change;
			} else {
				$puthome = '<a href="'.$admin_file.'.php?op=home_module&mid='.$mid.'"><img src="images/key.gif" alt="Ustaw na głównej" title="Ustaw na głównej" border="0"></a>';
				$change_status = '<a href="'.$admin_file.'.php?op=module_status&mid='.$mid.'&active='.$act.'">'.$change.'</a>';
			}
			?>
			<tr>
				<td><?php echo $title;?></td>
				<td align="center"><?php echo $active;?></td>
				<td align="center" nowrap>
					<a href="<?php echo $admin_file;?>.php?op=module_edit&mid=<?php echo $mid;?>"><img src="images/edit.gif" alt="Edytuj" title="Edytuj" border="0"></a><?php echo $change_status;?>  <?php echo $puthome;?>
				</td>
			</tr>
		<?php
		}
		?>
		</table>
		</form>
		<?php
		$adminClass->CloseTableAdmin();
	}

	function home_module($mid, $ok=0) {
		global $prefix, $admin_file, $adminClass, $db;
		$mid = intval($mid);
		if ($ok == 0) {

			$adminClass->OpenTableAdmin();
			echo '<h4>Konfiguracja strony głównej</h4>';
			$row = $db->query("SELECT title from " . $prefix . "_funcs where mid='$mid'")->fetch_array(MYSQLI_ASSOC);
			$new_m = $row['title'];
			$row2 = $db->query("SELECT main_func from " . $prefix . "_main")->fetch_array(MYSQLI_ASSOC);
			$old_m = $row2['main_func'];
			?>
			<p align="center">Ustawienie strony głównej</p>
			<p align="center">Jesteś pewien, że chcesz zamienić wyświetlany moduł na stronie głównej z <strong><?php echo $old_m;?></strong> na <strong><?php echo $new_m;?></strong>?</p>
			<p align="center">[ <a href="<?php echo $admin_file;?>.php?op=modules">Nie</a> | <a href="<?php echo $admin_file;?>.php?op=home_module&mid=<?php echo $mid;?>&ok=1">Tak</a> ]</p>
			<?php
			$adminClass->CloseTableAdmin();
		} else {
			$row3 = $db->query("SELECT title from " . $prefix . "_funcs where mid='".$mid."'")->fetch_array(MYSQLI_ASSOC);
			$title = $row3['title'];
			$active = 1;
			$view = 0;
			$res = $db->query("update " . $prefix . "_main set main_func='$title'");
			$res2 = $db->query("update " . $prefix . "_funcs set active='$active', view='$view' where mid='$mid'");
			header("Location: ".$admin_file.".php?op=modules");
			exit;
		}
	}

	function module_status($mid, $active) {

		global $prefix, $admin_file, $adminClass, $db;

		$mid = intval($mid);
		$active = intval($active);
		$db->query("update " . $prefix . "_funcs set active='$active' where mid='$mid'");

		header("Location: ".$admin_file.".php?op=modules");
		exit;
	}

	function module_edit($mid) {
		global $prefix, $admin_file, $adminClass, $db;
		$main_m = $db->query("SELECT main_func from " . $prefix . "_main")->fetch_array(MYSQLI_ASSOC);
		$main_module = $main_m['main_func'];
		$mid = intval($mid);
		$row = $db->query("SELECT title, custom_title, view, inmenu, mod_group from " . $prefix . "_funcs where mid='$mid'")->fetch_array(MYSQLI_ASSOC);
		$title = $row['title'];
		$custom_title = $row['custom_title'];
		$view = intval($row['view']);
		$inmenu = intval($row['inmenu']);
		$mod_group = intval($row['mod_group']);

		$adminClass->OpenTableAdmin();
		if ($title == $main_module) $a = " - wyświetlany na stronie głównej";
		else $a = "";
		?>
		<div id="menuAdmin">
			<ul>
				<li><a href="<?php echo $admin_file; ?>.php?op=mod_authors">Administratorzy</a></li>
				<li><a href="<?php echo $admin_file; ?>.php?op=backup">Kopia zapasowa bazy danych</a></li>
				<li><a href="<?php echo $admin_file; ?>.php?op=ipban">IP Ban</a></li>
				<li><a href="<?php echo $admin_file; ?>.php?op=optimize">Optymalizacja bazy danych</a></li>
				<li><a href="<?php echo $admin_file; ?>.php?op=modules">Ustawienia modułów</a></li>
			</ul>
		</div>
		<h3>Edycja modułu</h4>
		<p align="center"><strong>Zmiana modułu:</strong><br>(<?php echo $title.$a;?>)</p><br>
		<form action="<?php echo $admin_file;?>.php" method="post">
		<table id="adminTable">
			<tr>
				<td>Zmiana nazwy modułu:</td>
				<td><input type="text" name="custom_title" value="<?php echo $custom_title;?>" class="tekst"></td>
			</tr>
			<input type="hidden" name="view" value="0">
			<input type="hidden" name="inmenu" value="<?php echo $inmenu;?>">
		</table>
		<input type="hidden" name="mid" value="<?php echo $mid;?>">
		<input type="hidden" name="op" value="module_edit_save">
		<input type="submit" value="Zapisz zmiany" class="przycisk">
		</form>
		<?php
		$adminClass->CloseTableAdmin();
	}

	function module_edit_save($mid, $custom_title, $view, $inmenu, $mod_group) {
		global $prefix, $admin_file, $adminClass, $db;
		$mid = intval($mid);
		if ($view != 1) { $mod_group = 0; }
		$result = $db->query("update " . $prefix . "_funcs set custom_title='$custom_title', view='$view', inmenu='$inmenu', mod_group='$mod_group' where mid='$mid'");
		header("Location: ".$admin_file.".php?op=modules");
		exit;
	}

	switch ($op){

		case "modules":
		modules();
		break;

		case "module_status":
		module_status($mid, $active);
		break;

		case "module_edit":
		module_edit($mid);
		break;

		case "module_edit_save":
		module_edit_save($mid, $custom_title, $view, $inmenu, $mod_group);
		break;

		case "home_module":
		home_module($mid, $ok);
		break;

	}

} else {
	echo "Access Denied";
}

?>
