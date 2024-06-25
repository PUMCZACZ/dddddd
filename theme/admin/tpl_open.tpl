<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<LINK REL="stylesheet" HREF="theme/admin/style.css" TYPE="text/css">
	<link rel="stylesheet" type="text/css" href="theme/css/bootstrap.css" />
	<title>Panel Administracyjny</title>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" crossorigin="anonymous"></script>
	<script src="theme/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<script src="theme/js/jquery.countdown.min.js"></script>
	<!-- IF SITE_EDITOR --><script type="text/javascript" src="theme/js/ckeditor/ckeditor.js"></script><!-- ENDIF -->
</head>
<body>
	<table>
		<tr>
			<td colspan="2" style="border-bottom:1px solid #BBBBBB; padding:0 20px 0 0">
				<a href="{ADMIN_FILE}"><img src="theme/admin/logo.png" /></a>
				<a class="pull-right btn btn-default mt-3" href="{ADMIN_FILE}?op=logout"><em class="fa fa-sign-out"></em>wyloguj</a>
				<a class="pull-right btn btn-success mt-3 mr-3" target="_blank" href="{SITEURL}"><em class="fa fa-home"></em> Strona Główna</a>
				<span class="pull-right clock">Sesja wygasa za <span id="clock"></span></span>
			</td>
		</tr>
		<tr>
			<td class="align-top px-3">
				<h3 class="my-4"><em class="fa fa-user"></em> Menu administracyjne</h3>
				<div class="list-group">
					<!-- BEGIN a_l -->
					<a href="{a_l.LINK}" class="list-group-item list-group-item-action<!-- IF OP == a_l.TITLE --> active<!-- ENDIF -->">{a_l.NAME}</a>
					<!-- END a_l -->
				</div>
				<h3 class="my-4"><em class="fa fa-gears"></em> Zarządzanie</h3>
				<div class="list-group">
					<!-- BEGIN m_l -->
					<a href="{m_l.LINK}" class="list-group-item list-group-item-action<!-- IF OP == m_l.TITLE --> active<!-- ENDIF -->">{m_l.NAME}</a>
					<!-- END m_l -->
				</div>
			</td>
			<td class="align-top" style="width:80%">
				<!-- IF ALERT_INFO -->
				<div class="alert alert-success">{ALERT_INFO}</div>
				<!-- ENDIF -->
				<!-- IF ALERT_ERROR -->
				<div class="alert alert-danger">{ALERT_ERROR}</div>
				<!-- ENDIF -->
				<div class="card">
