<!-- INCLUDE theme_header.tpl -->
<section class="user-main">
	<h3 class="text-center mb-4 mt-5">{_LANG_314}</h3>
	<form action="funcs.php?name=user" method="post">
		<div class="col-md-6 offset-md-3 col-12">
			<table class="table table-striped">
				<!-- IF TOKEN -->
				<tr>
					<td colspan="2">{_LANG_315}<strong>{_LANG_316}</strong>{_LANG_317}<strong>{_LANG_318}</strong>{_LANG_319}<strong>{_LANG_320}</strong>{_LANG_321}</td>
				</tr>
				<tr>
					<th style="vertical-align:middle">{_LANG_316}:</th>
					<td><input type="password" name="new_pass" class="form-control" required="required" placeholder="{_LANG_316}" /></td>
				</tr>
				<tr>
					<th style="vertical-align:middle">{_LANG_323}</th>
					<td><input type="password" name="new_pass2" class="form-control" required="required" placeholder="Powtórz nowe hasło" /></td>
				</tr>
				<tr>
					<td colspan="2" class="text-right">
						<input type="hidden" name="op" value="mailpasswd" />
						<input type="hidden" name="token" value="{TOKEN}" />
						<button type="submit" value="1" class="btn btn-success"><em class="fa fa-unlock-alt"></em> {_LANG_320}</button>
					</td>
				</tr>
				<!-- ELSE -->
				<tr>
					<td colspan="2">
						{_LANG_325}<strong>{_LANG_326}</strong>{_LANG_321}
					</td>
				</tr>
				<tr>
					<th class="pt-3">{_LANG_328}</th>
					<td>
						<input type="email" name="adres_email" class="form-control" required="required" />
					</td>
				</tr>
				<tr>
					<td colspan="2" class="text-right"><div class="text-right mt-3"><!-- INCLUDE tpl_recaptcha.tpl --></div></td>
				</tr>
				<tr>
					<td colspan="2" class="text-right">
						<input type="hidden" name="op" value="mailpasswd" />
						<button type="submit" value="1" class="btn btn-primary"><em class="fa fa-unlock-alt"></em> {_LANG_326}</button>
					</td>
				</tr>
				<!-- ENDIF -->
			</table>
		</div>
	</form>
</section>
<!-- INCLUDE theme_footer.tpl -->
