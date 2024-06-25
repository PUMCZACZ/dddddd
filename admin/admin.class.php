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

class adminClass {

	public function __construct()
	{
		global $db, $classMain;

		$this->db = $db;
		$this->classMain = $classMain;
	}

	function adminmenu($url, $title) {
		echo '<li><a href="'.$url.'">'.$title.'</a></li>';
	}

	function GraphicAdmin()
	{
		echo '<h3><em class="fa fa-user"></em> Menu administracyjne</h3>'."\n";
		include('admin/links.php');
	}

	public function login()
	{
		include_once 'inc/nocsrf.php';

		$this->classMain->dataTPLarray(array(
			'ADMIN_FILE' => ADMIN_FILE.'.php',
			'G_RECAPTCHA_SITEKEY' => $this->classMain->mainConfig->g_recaptcha_sitekey,
			'CSRF_TOKEN' => NoCSRF::generate('csrf_token')
		));

		$this->classMain->tpl('login.tpl');
	}

	public function userStats()
	{
		$this->userStats = new stdClass();
		$this->userStats->all = $this->db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users")->fetch(PDO::FETCH_OBJ);
		$this->userStats->active = $this->db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users WHERE status=1")->fetch(PDO::FETCH_OBJ);
		$this->userStats->suspended = $this->db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users WHERE status=2")->fetch(PDO::FETCH_OBJ);
		$this->userStats->unactive = $this->db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users WHERE status=0")->fetch(PDO::FETCH_OBJ);
		$this->userStats->deleted = $this->db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users WHERE status=3")->fetch(PDO::FETCH_OBJ);
		$this->userStats->veryfi = $this->db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users WHERE veryfi>0")->fetch(PDO::FETCH_OBJ);
		$this->userStats->unveryfi = $this->db->query("SELECT COUNT(*) AS count FROM ".DB_PREFIX."_users WHERE veryfi=0")->fetch(PDO::FETCH_OBJ);
		$this->userStats->unveryfi_waiting = $this->db->query("SELECT COUNT(uv.id) AS count FROM ".DB_PREFIX."_users_veryfi uv WHERE uv.status=0")->fetch(PDO::FETCH_OBJ);
	}

	function adminMain()
	{
		global $rname;

		$this->OpenTableAdmin();
		$guest_online = $this->db->query("SELECT COUNT(*) AS num FROM ".DB_PREFIX."_session_login WHERE login=0 AND time>".(time()-1800)." GROUP BY session_id");
		$guest_online = $guest_online->rowCount();
		$member_online = $this->db->query("SELECT COUNT(user_id) AS num FROM ".DB_PREFIX."_users WHERE date_login>".(time()-(15*3600)))->fetch(PDO::FETCH_ASSOC);
		$who_online = $guest_online+$member_online['num'];

		//użytkownicy
		$this->userStats();

		?>
		<h3 align="center">Kto jest on-line</h3>
		<p align="center">
			Gości on-line: <strong><?php echo $who_online; ?></strong> w tym użytkowników: <strong><?php echo $member_online['num']; ?></strong>
		</p>
		<?php
		if ($rname == 'God')
		{
			?>
			<table class="table table-striped table-bordered">
				<tr>
					<td colspan="7"><strong>Użytkownicy</strong></td>
				</tr>
				<tr>
					<th class="text-center">Wszyscy</th>
					<th class="text-center">Aktywni</th>
					<th class="text-center">Zawieszeni</th>
					<th class="text-center">Niepotwierdzeni</th>
					<th class="text-center">Zweryfikowani</th>
					<th class="text-center">Niezweryfikowani</th>
					<th class="text-center">Oczekujący na weryfikację</th>
				</tr>
				<tr class="text-center">
					<td><a href="<?php echo ADMIN_FILE.'.php'; ?>?op=user"><?php echo $this->userStats->all->count; ?></a></td>
					<td><a href="<?php echo ADMIN_FILE.'.php'; ?>?op=user&amp;search=1&amp;status=1"><?php echo $this->userStats->active->count; ?></a></td>
					<td><a href="<?php echo ADMIN_FILE.'.php'; ?>?op=user&amp;search=1&amp;status=2"><?php echo $this->userStats->suspended->count; ?></a></td>
					<td><a href="<?php echo ADMIN_FILE.'.php'; ?>?op=user&amp;search=1&amp;status=0"><?php echo $this->userStats->unactive->count; ?></a></td>
					<td><a href="<?php echo ADMIN_FILE.'.php'; ?>?op=user&amp;search=1&amp;veryfi=1"><?php echo $this->userStats->veryfi->count; ?></a></td>
					<td><a href="<?php echo ADMIN_FILE.'.php'; ?>?op=user&amp;search=1&amp;veryfi=0"><?php echo $this->userStats->unveryfi->count; ?></a></td>
					<td><a href="<?php echo ADMIN_FILE.'.php'; ?>?op=user&amp;search=1&amp;veryfi_waiting=1"><?php echo $this->userStats->unveryfi_waiting->count; ?></a></td>
				</tr>
			</table>
			<?php
		}
		$this->CloseTableAdmin();
	}

	private function mainMenu()
	{
		global $rname;

		$whereAdmin = ($rname != 'God') ? "admins LIKE '%".$raid.",%' AND " : false;
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."_funcs WHERE ".$whereAdmin."inmenu=1 ORDER BY custom_title ASC");
		while ($row = $result->fetch(PDO::FETCH_ASSOC))
		{
			$row['link'] = ADMIN_FILE.'.php?op='.$row['title'];
			$row['name'] = $row['custom_title'];
			$this->classMain->dataTPLarrayList('m_l', $row);
		}
	}

	private function adminLinks()
	{
		global $rname;

		if ($rname == 'God')
		{
			$array= array(
				'mod_authors' => 'Administracja',
				'backup' => 'Kopia zapasowa',
				'ipban' => 'Blokada IP',
				'prices-members' => 'Cennik',
				'select-options' => 'Opcje wyboru',
				'cats' => 'Kategorie',
				'settings' => 'Ustawienia'
			);
			foreach ($array as $key => $value) {
				$dataTPL = array();
				$dataTPL['link'] = ADMIN_FILE.'.php?op='.$key;
				$dataTPL['title'] = $key;
				$dataTPL['name'] = $value;
				$this->classMain->dataTPLarrayList('a_l', $dataTPL);
			}
		}
	}

	function OpenTableAdmin() {
		global $ERROR, $aid, $admin;

		$this->mainMenu();
		$this->adminLinks();

		$this->classMain->dataTPLarray(array(
								'CURRENCY' => $this->classMain->mainConfig->currency,
								'SITEURL' => $this->classMain->mainConfig->siteurl,
								'SESSION_ADMIN' => $this->classMain->mainConfig->session_admin,
								'ADMIN_FILE' => ADMIN_FILE.'.php',
								'OP' => $this->classMain->formatSQL($_GET['op']),
								'GOD' => ($rname == 'God'),

								'ALERT_INFO' => ((isset($INFO) && !empty($INFO)) || (isset($_GET['info']) && !empty($_GET['info']))) ? $INFO.$_GET['info'] : false,
								'ALERT_ERROR' => ((isset($ERROR) && !empty($ERROR)) || (isset($_GET['error']) && !empty($_GET['error']))) ? $ERROR.$_GET['error'] : false,
								'SITE_EDITOR' => (defined('SITE_EDITOR') == 1)
		));
		$this->classMain->tpl('tpl_open.tpl');
	}

	public function CloseTableAdmin()
	{
		$this->classMain->tpl('tpl_close.tpl');
	}
	public function setTPL($tpl)
	{
		$this->OpenTableAdmin();
		$this->classMain->template->set_filenames(array(
			'body' => $tpl
		));
		$this->classMain->template->display('body');
		$this->CloseTableAdmin();
	}
}

?>
