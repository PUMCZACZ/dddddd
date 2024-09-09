<!DOCTYPE html>
<html lang="pl">
	<head>
		<link rel="stylesheet" href="theme/admin/style_admin.css" type="text/css" />
		<link rel="stylesheet" type="text/css" href="theme/css/bootstrap.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body style="margin-top:10%">
		<div class="col-4 offset-4">
			<!-- IF ERROR --><div class="alert alert-danger alert-main"><em class="fa fa-exclamation-circle"></em> {ERROR}</div><!-- ENDIF -->
			<!-- IF INFO --><div class="alert alert-success alert-main"><em class="fa fa-check"></em> {INFO}</div><!-- ENDIF -->
			<div class="">
				<div class="card-body">
					<h4 class="card-title text-center">Logowanie do panelu administracyjnego</h4>
					<form class="form-horizontal" action="{ADMIN_FILE}" method="post">
						<div class="form-group row">
							<div class="col-3">Login</div>
							<div class="col-6">
								<input type="text" class="form-control" placeholder="Login" required name="aid" />
							</div>
						</div>
						<div class="form-group row">
							<div class="col-3">Hasło</div>
							<div class="col-sm-6">
								<input type="password" class="form-control" placeholder="Hasło" required name="pwd" />
							</div>
						</div>
						<div class="form-group row">
							<div class="col-8 offset-3">
								<div class="g-recaptcha" data-sitekey="{G_RECAPTCHA_SITEKEY}"></div>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-9 text-right">
								<input type="hidden" name="op" value="login" />
								<input type="hidden" name="csrf_token" value="{CSRF_TOKEN}" />
								<input type="submit" value="Logowanie" class="btn btn-primary" />
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
