<div class="card-body">
	<h3 class="my-3">Zarządzanie administratorami</h3>
	<!-- IF OP == 'mod_authors' -->

	<table class="table table-striped">
		<tr>
			<th>ID administratora</th>
			<th class="text-center">Funkcje</th>
		</tr>
		<!-- BEGIN a -->
		<tr>
			<td>
				{a.A_ID}<!-- IF a.NAME == 'God' --> <span class="badge badge-secondary">Konto Główne</span><!-- ENDIF -->
			</td>
			<td class="text-center">
				<a class="btn btn-primary" href="{ADMIN_FILE}?op=modifyadmin&amp;chng_aid={a.A_ID}"><em class="fa fa-edit" title="Modyfikuj info"></em></a>
				<!-- IF a.NAME == 'God' --><span class="btn btn-danger disabled" title="Główne konto"><em class="fa fa-times"></em></span>
				<!-- ELSE --><a class="btn btn-danger" href="{ADMIN_FILE}?op=deladmin&amp;del_aid={a.A_ID}"><span class="fa fa-times" title="Usuń administratora"></span></a>
				<!-- ENDIF -->
			</td>
		</tr>
		<!-- END a -->
	</table>
	<p align="center"><font class="tiny">*(konto Główne nie może być skasowane)</font></p>
	<h4 class="text-center">Dodaj nowego administratora</h4>
	<form action="{ADMIN_FILE}" method="post" class="row">
		<div class="col-md-8 col-xs-12 col-md-offset-2">
			<table class="table table-striped">
				<tr>
					<th style="white-space:nowrap">Nazwa administratora:</th>
					<td colspan="3">
						<input type="text" name="add_aid" maxlength="25" class="form-control" required> <font class="tiny">*wymagane</font>
						<input type="hidden" name="add_radminsuper" value="1">
					</td>
				</tr>
				<tr>
					<th>Hasło</th>
					<td colspan="3">
						<input type="password" name="add_pwd" maxlength="40" class="form-control" required> <font class="tiny">*wymagane</font>
					</td>
				</tr>
				<tr>
					<th>Dostęp</th>
					<td colspan="3">
						<ul class="list list-inline row">
							<!-- BEGIN f -->
							<li class="col-md-3"><input type="checkbox" name="funcs[]" value="{f.MID}" /> {f.CUSTOM_TITLE}</li>
							<!-- END f -->
							<li class="col-md-12"><input type="checkbox" name="add_name" value="God" /> <strong>Główny administrator</strong></li>
						</ul>
						<input type="hidden" name="op" value="AddAuthor">
					</td>
				</tr>
				<tr>
					<td colspan="4" class="text-right">
						<input type="submit" class="btn btn-primary" value="Dodaj administratora">
					</td>
				</tr>
			</table>
		</div>
	</form>

	<!-- ELSEIF OP == 'modifyadmin' -->

	<form action="{ADMIN_FILE}" method="post">
	<table class="table table-striped">
		<tr>
			<th style="white-space:nowrap;">Nazwa administratora:</th>
			<td>
				<input type="text" name="chng_aid" value="{CHNG_AID}" maxlength="25" class="form-control" required> <font class="tiny">(wymagane)</font>
				<input type="hidden" name="chng_radminsuper" value="1">
			</td>
		</tr>
		<tr>
			<th>Hasło:</th>
			<td colspan="3">
				<input type="password" name="chng_pwd" maxlength="40" class="form-control">
				<font class="tiny">(tylko do zmian)</font>
			</td>
		</tr>
		<tr>
			<th>Powtórz hasło:</th>
			<td colspan="3">
				<input type="password" name="chng_pwd2" maxlength="40" class="form-control">
				<font class="tiny">(tylko do zmian)</font>
			</td>
		</tr>
		<tr>
			<th>Dostęp</th>
			<td colspan="3">
				<ul class="list list-inline">
				<!-- BEGIN f -->
				<li class="col-md-3"><input type="checkbox" name="funcs[]" value="{f.MID}"<!-- IF f.CHECKED --> checked<!-- ENDIF --> /> {f.CUSTOM_TITLE}</li>
				<!-- END f -->
				<li class="col-md-12"><input type="checkbox" name="add_name" value="God"<!-- IF CHNG_RADMINSUPER --> checked<!-- ENDIF --> /> <strong>Główny administrator</strong></p>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="text-right">
				<input type="hidden" name="adm_aid" value="{ADM_AID}">
				<input type="hidden" name="op" value="UpdateAuthor">
				<input type="submit" value="Zapisz" class="btn btn-primary">
			</td>
		</tr>
	</table>
	</form>

	<!-- ELSEIF OP == 'deladmin' -->

	<h3 class="text-center">Zarządzanie administratorami</h3>
	<div class="well">
		<h4 class="text-center">Skasuj administratora</h4>
		<p class="text-center">Czy na pewno chcesz skasować <strong><em>{DEL_AID}</em></strong></p>
		<p class="text-center">[ <a href="{ADMIN_FILE}?op=deladmin2&amp;del_aid={DEL_AID}">Tak</a> | <a href="{ADMIN_FILE}?op=mod_authors">Nie</a> ]</p>
	</div>

	<!-- ENDIF -->
</div>
