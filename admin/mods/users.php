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

if (!defined('ADMIN_FILE')) {
	die ("Access Denied");
}

require_once 'funcs/user/classes/user.class.php';
$classUser = new user;
require_once 'funcs/user/classes/register.class.php';
$classRegister = new register;
require_once 'funcs/user/classes/member.class.php';
$classMember = new member;
require_once 'admin/mods/classes/users.class.php';
$userAdminClass = new usersAdmin;

$op = $classMain->getOP();

$classMain->langs();

switch ($op)
{
	case 'user':

		require_once 'admin/mods/classes/pager.class.all.php';

		if (isset($_POST['save-online']) && isset($_POST['online']))
		{
			$userAdminClass->saveOnLine($_POST['user_id'], $_POST['online']);
			$classMain->redirect(ADMIN_FILE.".php?op=user&info=Zmiany+zostały+zapisane");
		}

		if (isset($_POST['save-group-online']) && !empty($_POST['id']))
		{
			$userAdminClass->saveGroupOnLine($_POST['id'], $_POST['group-online']);
			$classMain->redirect(ADMIN_FILE.".php?op=user&info=Zmiany+zostały+zapisane");
		}

		if (isset($_POST['save-group-wallet']) && !empty($_POST['id']))
		{
			$userAdminClass->saveGroupWallets($_POST['id'], $_POST['group-wallet-type'], $_POST['group-wallet-value']);
			$classMain->redirect(ADMIN_FILE.".php?op=user&info=Zmiany+zostały+zapisane");
		}

		if (isset($_GET['send']) && !empty($_GET['send']) && is_numeric($_GET['send'])) $userAdminClass->emailActivate($_GET['send']);

		if (isset($_POST['save']) && !empty($_POST['save'])) $userAdminClass->saveWallets($_POST['update_user_id'], $_POST['wallet'], $_POST['wallet-old']);

		//wyszukiwanie
		if (isset($_POST['search']) && !empty($_POST['search'])) $querySearch = $userAdminClass->searchQuery($_POST);

		if ($_GET['search'] == 1 && isset($_GET['status'])) $querySearch .= ' AND u.status='.$classMain->formatSQL($_GET['status']);
		if ($_GET['search'] == 1 && $_GET['veryfi'] == 1) $querySearch .= ' AND u.veryfi>0';
		if ($_GET['search'] == 1 && $_GET['veryfi'] == '0') $querySearch .= ' AND u.veryfi=0';
		if ($_GET['search'] == 1 && isset($_GET['veryfi_waiting'])) $querySearch .= ' AND uv.status=0';

		$query = "SELECT u.*, uv.status AS app_status FROM ".DB_PREFIX."_users u
					LEFT JOIN ".DB_PREFIX."_users_veryfi uv ON (uv.user_id=u.user_id)
					WHERE 1".$querySearch." GROUP BY u.user_id
					ORDER BY u.user_id DESC";
		$result = $db->query($query);
		$recordsCount = $result->rowCount();
		try{
			$pager = new Pager('p');
			$pager->SetTotalRecords($recordsCount);
			$pager->Make(true);
			$pag = $pager->Render();
			$start = $pager->GetIndexRecordStart();
			$end = $pager->GetIndexRecordEnd();
		}
		catch (Exception $e) {
			echo $e->getMessage();
		}
		$result = $db->query($query." LIMIT ".$start.",50");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->premium = ($classUser->is_member($row->user_id)) ? true : false;
			$row->member_name = $classMember->userMember($row->user_id, 'name');
			$row->member_time = $classMember->userMember($row->user_id, 'time');
			$row->date_login = (!empty($row->date_login)) ? date('d-m-Y H:i', $row->date_login) : false;
			$row->status_txt = $classUser->userStatus($row->status);
			$row->veryfi = ($row->veryfi) ? date('d-m-Y', $row->veryfi) : false;
			$classMain->dataTPLarrayList('usr', $row, false);
		}

		//stats
		$adminClass->userStats();

		$dataTPL = $_POST;
		$dataTPL['pagination'] = $pag;
		$dataTPL['status'] = (isset($_GET['status'])) ? intval($_GET['status']) : false;
		$dataTPL['veryfi'] = (isset($_GET['veryfi'])) ? intval($_GET['veryfi']) : false;
		$dataTPL['veryfi_waiting'] = ($_GET['veryfi_waiting'] == 1) ? true : false;

		$dataTPL['stats_all'] = $adminClass->userStats->all->count;
		$dataTPL['stats_active'] = $adminClass->userStats->active->count;
		$dataTPL['stats_suspended'] = $adminClass->userStats->suspended->count;
		$dataTPL['stats_unactive'] = $adminClass->userStats->unactive->count;
		$dataTPL['stats_deleted'] = $adminClass->userStats->deleted->count;
		$dataTPL['stats_veryfi'] = $adminClass->userStats->veryfi->count;
		$dataTPL['stats_unveryfi'] = $adminClass->userStats->unveryfi->count;
		$dataTPL['stats_unveryfi_waiting'] = $adminClass->userStats->unveryfi_waiting->count;

		$classMain->dataTPLarray($dataTPL);

	break;

	case 'user-edit':

		if ($_GET['delete-phone'])
		{
			$db->query("DELETE FROM ".DB_PREFIX."_users_phones WHERE id=".$classMain->formatSQL($_GET['delete-phone'], 'int')." AND user_id=".$classMain->formatSQL($_GET['id'], 'int')." LIMIT 1");
		}
		if ($_GET['delete-website'])
		{
			$db->query("DELETE FROM ".DB_PREFIX."_users_websites WHERE id=".$classMain->formatSQL($_GET['delete-website'], 'int')." AND user_id=".$classMain->formatSQL($_GET['id'], 'int')." LIMIT 1");
		}

		$dataTPL = $classUser->getUserTPLdata($_GET['id']);
		$classRegister->phonesList(true, $dataTPL['user_id']);
		$classRegister->websitesList(true, $dataTPL['user_id']);
		$classRegister->userCatsList(true, $dataTPL['user_id']);

#$classRegister->emailActivate($dataTPL['user_id']);

		$classMain->langsList('desc_langs', 'company_desc', $dataTPL);
		$dataTPL['date_login'] = ($dataTPL['date_login']) ? date('d-m-Y H:i:s', $dataTPL['date_login']) : false;
		$dataTPL['date_reg'] = date('d-m-Y H:i:s', $dataTPL['date_reg']);
		$dataTPL['veryfi'] = ($dataTPL['veryfi']) ? date('d-m-Y', $dataTPL['veryfi']) : false;
		$dataTPL['premium'] = ($classUser->is_member($dataTPL['user_id'])) ? true : false;
		$dataTPL['member_name'] = $classMember->userMember($dataTPL['user_id'], 'name');
		$dataTPL['member_time'] = $classMember->userMember($dataTPL['user_id'], 'time');

		$dataTPL['tab'] = (isset($_GET['tab'])) ? $classMain->formatSQL($_GET['tab']) : false;

		//member
		$userAdminClass->memberList($dataTPL['user_id']);
		$classMember->memberList(0, 'm', true);

		//invoices
		$classUser->paymentsList($dataTPL['user_id']);

		//veryfi
		$veryfiInfo = $userAdminClass->veryfiApp($dataTPL['user_id']);
		$dataTPL['veryfi_comment'] = $veryfiInfo->comment;
		$dataTPL['veryfi_status'] = $veryfiInfo->status;

		$classMain->dataTPLarray($dataTPL);

		$classUser->profilePhotos($dataTPL['user_id']);

		//generate invoice
		if ($_POST['invoice-create'])
		{
			$info = $userAdminClass->createInvoice($_POST['invoice-create']);
			if (empty($info)) $info = 'Faktura+została+wygenerowana';
			$classMain->redirect(ADMIN_FILE.'.php?op=user-edit&id='.$dataTPL['user_id'].'&tab=member&info='.$info);
		}

		//member price update
		if ($_POST['member-price-save'])
		{
			$userAdminClass->updateMember($_POST['member-price']);
			$classMain->redirect(ADMIN_FILE.'.php?op=user-edit&id='.$dataTPL['user_id'].'&tab=member&info=Zmiany+zostały+zapisane');
		}

		//delete member
		if ($_POST['delete-member'])
		{
			$userAdminClass->deleteMember($_POST['id']);
			$classMain->redirect(ADMIN_FILE.'.php?op=user-edit&id='.$dataTPL['user_id'].'&tab=member&info=Zmiany+zostały+zapisane');
		}

		//add member
		if ($_POST['activate'] && $_POST['m_id'])
		{
			$userAdminClass->saveMember($dataTPL['user_id'], $_POST['m_id']);
			$classMain->redirect(ADMIN_FILE.'.php?op=user-edit&id='.$dataTPL['user_id'].'&tab=member&info=Zmiany+zostały+zapisane');
		}

		//delete photo
		if ($_GET['delete-photo'])
		{
			$classUser->deleteProfilePhoto($_GET['delete-photo'], $dataTPL['user_id']);
			$classMain->redirect(ADMIN_FILE.'.php?op=user-edit&id='.$dataTPL['user_id'].'&tab=photos');
		}

		//login to account
		if ($_GET['log-in-user'])
		{
			$userAdminClass->logInUser($dataTPL['user_id'], $datTPL['username'], $dataTPL['user_pass']);
			$classMain->redirect($classMain->mainConfig->siteurl, 'info', 'Zostałeś zalogowany na konto <strong>'.$dataTPL['username'].'</strong>');
		}

		//delete photos
		if ($_POST['photos-delete'])
		{
			if (is_array($_POST['p_id']))
			{
				require_once 'funcs/user/classes/photos.class.php';
				$classPhotos = new photos;
				foreach ($_POST['p_id'] as $key => $value) {
					$classPhotos->delete($classMain->formatSQL($value, 'int'), $classMain->formatSQL($_GET['p_id'], 'int'));
				}
			}
			$classMain->redirect(ADMIN_FILE.'.php?op=user-edit&id='.intval($_GET['id']).'&info=Zdjęcia+zostały+usunięte.');
		}

		//save changes/delete user
		if (isset($_POST['save-changes']))
		{
			if ($_POST['delete']) $userAdminClass->deleteUser(intval($_POST['delete']));
			else
			{
				try {
					$classUser->updateUser(true);
				} catch (Exception $e) {
					$classMain->redirect(ADMIN_FILE.'.php?op=user-edit&id='.intval($_GET['id']).'&info=Zmiany+zostały+zapisane.');
				}
			}
		}

	break;
	case 'user-photos':

		if ($_POST['save'] == 1)
		{
			require_once 'funcs/user/classes/photos.class.php';
			$classPhotos = new photos;
			foreach ($_POST['p_id'] as $key => $value) {
				$row = $db->query("SELECT * FROM ".DB_PREFIX."_users_photos WHERE id=".$value." LIMIT 1")->fetch(PDO::FETCH_OBJ);
				if ($_POST['action'][$row->id] == 'delete') $classPhotos->delete($classMain->formatSQL($value, 'int'), $row->user_id);
				if ($_POST['action'][$row->id] == 'approve') $db->query("UPDATE ".DB_PREFIX."_users_photos SET status=1 WHERE id=".$row->id." LIMIT 1");
			}
			$classMain->redirect(ADMIN_FILE.'.php?op=user-photos&info=Zmiany+zostały+zapisane.');
		}

		$no = 1;
		$result = $db->query("SELECT up.*, u.username, u.user_email
													FROM ".DB_PREFIX."_users_photos up
													LEFT JOIN ".DB_PREFIX."_users u ON (u.user_id=up.user_id)
													WHERE up.status=0 ORDER BY up.id ASC");
		while ($row = $result->fetch(PDO::FETCH_OBJ))
		{
			$row->no = $no;
			$row->pic_src = $row->dir.'/'.$row->photo;
			$row->date = date('d-m-Y H:i:s', $row->date_add);
			$classMain->dataTPLarrayList('p', $row);
			$no++;
		}
	break;
}

$classMain->dataTPLarray(array(
	'OP' => $op
));

$adminClass->setTPL('users.tpl');
?>
