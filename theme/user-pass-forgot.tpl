<!-- INCLUDE theme_header.tpl -->
<section class="user-main">
	<form action="funcs.php?name=user" method="post">
		<div class="col-md-6 offset-md-3 col-12 shadow px-2 px-md-5">
			<h3 class="text-center mb-4 mt-5">{_LANG_314}</h3>
			<div class="d-flex flex-column">
				<!-- IF TOKEN -->
				<p>{_LANG_315}<strong>{_LANG_316}</strong>{_LANG_317}<strong>{_LANG_318}</strong>{_LANG_319}<strong>{_LANG_320}</strong>{_LANG_321}</p>
				<div class="mb-3">
					<label>{_LANG_316}</label>
					<input type="password" name="new_pass" class="form-control" required="required" placeholder="{_LANG_316}" />
				</div>

				<div class="mb-3">
					<label>{_LANG_323}</label>
					<input type="password" name="new_pass2" class="form-control" required="required" placeholder="Powtórz nowe hasło" />
				</div>

				<div class="d-flex justify-content-end">
					<input type="hidden" name="op" value="mailpasswd" />
					<input type="hidden" name="token" value="{TOKEN}" />
					<button type="submit" value="1" class="btn btn-success"><em class="fa fa-unlock-alt"></em> {_LANG_320}</button>
				</div>
				<!-- ELSE -->
				<p>{_LANG_325}<strong>{_LANG_326}</strong>{_LANG_321}</p>
				<div class="mb-3">
					<label>{_LANG_328}</label>
					<input type="email" name="adres_email" class="form-control" required="required" />
				</div>
				<div class="d-flex justify-content-end mb-3">
					<!-- INCLUDE tpl_recaptcha.tpl -->
				</div>
				<div class="mb-3">
					<input type="hidden" name="op" value="mailpasswd" />
					<button type="submit" value="1" class="btn btn-primary w-100"><em class="fa fa-unlock-alt"></em> {_LANG_326}</button>
				</div>
				<!-- ENDIF -->
			</div>
		</div>
	</form>
</section>
<!-- INCLUDE theme_footer.tpl -->
