<!-- INCLUDE theme_header.tpl -->
<form method="post" class="row my-md-5 my-0 py-md-5 py-0">
	<div class="col-lg-4 offset-lg-4 col-md-8 offset-md-2 col-12">
		<div class="card login-form">
			<div class="card-header">
				<strong>{_LANG_110}</strong>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>{_LANG_275}</label>
					<input type="text" name="username" class="d-block form-control" />
				</div>
				<div class="form-group">
					<label>{_LANG_276}</label>
					<input type="password" name="user_pwd" class="d-block form-control" />
				</div>
				<div class="clearfix"><a class="text-success float-right" href="funcs.php?name=user&amp;op=pass_lost"><small>{_LANG_278}</small></a></div>
				<!-- IF RECAPTCHA -->
				<div class="text-right mt-3"><!-- INCLUDE tpl_recaptcha.tpl --></div>
				<!-- ENDIF -->
			</div>
			<div class="card-footer">
				<button type="submit" class="btn btn-main btn-block">{_LANG_277} <em class="fa fa-chevron-right"></em></button>
				<input type="hidden" name="op" value="login" />
				<!-- IF GOOGLE-LOGIN-LINK || FB-LOGIN-LINK -->
				<!-- IF GOOGLE-LOGIN-LINK --><a class="btn btn-danger btn-block my-3" href="{GOOGLE-LOGIN-LINK}"><span class="fa fa-google"></span> Logowanie przez Google</a><!-- ENDIF -->
				<!-- IF FB-LOGIN-LINK --><a class="btn btn-primary btn-block my-3" href="{FB-LOGIN-LINK}"><span class="fa fa-facebook"></span> Logowanie przez Facebook</a><!-- ENDIF -->
				<!-- ENDIF -->
				<p class="text-center text-secondary">lub</p>
				<a href="{SITEURL}/funcs.php?name=user&amp;file=register" class="btn btn-primary-light btn-block">Zarejestruj się</a>
			</div>
		</div>
	</div>
</form>
<!-- INCLUDE theme_footer.tpl -->
