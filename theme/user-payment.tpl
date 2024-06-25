
<!-- IF SUBMIT_REDIRECT -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
<link rel="stylesheet" href="{SITEURL}/theme/css/bootstrap.css" type="text/css" />
<link rel="stylesheet" href="{SITEURL}/theme/css/style.css" type="text/css" />
<title>{SITENAME}</title>
</head>
<body class="redirect" onload="document.payment.submit();">
<!--<body>-->
	<div class="payment-redirect container">
		<div class="row my-5">
			<div class="col-lg-6 col-12 mx-auto">
				<img class="logo mw-100" src="{SITEURL}/theme/img/logo.png" />
			</div>
		</div>
		<div class="row">
			<div class="col-lg-6 col-12 mx-auto">
				<img class="logoOperator mw-100" src="{SITEURL}/theme/img/payment_{OPERATOR}.png" />
			</div>
		</div>
		<!-- IF OPERATOR == 'd' -->
		<form method="post" action="https://ssl.dotpay.pl" name="payment">
			<input type="hidden" name="kwota" value="{SUM}" />
			<input type="hidden" name="imie" value="{IMIE}" />
			<input type="hidden" name="nazwisko" value="{NAZWISKO}" />
			<input type="hidden" name="ulica" value="{ULICA}" />
			<input type="hidden" name="miasto" value="{MIASTO}" />
			<input type="hidden" name="telefon" value="{TELEFON}" />
			<input type="hidden" name="email" value="{EMAIL}" />
			<input type="hidden" name="id" value="{DOTPAY_ID}" />
			<input type="hidden" name="control" value="{CONTROL}" />
			<input type="hidden" name="opis" value="{FUNC}" />
			<input type="hidden" name="waluta" value="{DOTPAY_WALUTA}" />
			<input type="hidden" name="typ" value="3" />
			<input type="hidden" name="urlc" value="{URLC}" />
			<input type="hidden" name="url" value="{URL}" />
			</form>
		<!-- ENDIF -->
		<!-- IF OPERATOR == 'pp' -->
		<form action="{SITEURL}/funcs.php?name=user&amp;file=paypal" method="post" name="payment">
			<input type="hidden" name="itemname" value="{FUNC}" />
			<input type="hidden" name="custom" value="{CONTROL}" />
			<input type="hidden" name="itemprice" value="{SUM}" />
			<input type="hidden" name="currency" value="{PAYPAL_WALUTA}" />
			<input type="hidden" name="image_url" value="{LOGO}" />
			<input type="hidden" name="return" value="{URL}" />
			<input type="hidden" name="notify_url" value="{URL}" />
		</form>
		<!-- ENDIF -->
		<!-- IF OPERATOR == 'p24' -->
		<form method="post" name="payment" action="{P24_ACTION}">
			<input type="hidden" name="p24_amount" value="{P24_AMOUNT}" />
			<input type="hidden" name="p24_sign" value="{P24_SIGN}" />
			<input type="hidden" name="redirect" value="1" />
			<input type="hidden" name="p24_merchant_id" value="{P24_ID}" />
			<input type="hidden" name="p24_pos_id" value="{P24_ID}" />
			<input type="hidden" name="p24_session_id" value="{P24_SESSION_ID}" />
			<input type="hidden" name="p24_currency" value="{P24_WALUTA}" />
			<input type="hidden" name="p24_description" value="{FUNC}" />
			<input type="hidden" name="p24_email" value="{EMAIL}" />
			<input type="hidden" name="p24_language" value="PL" />
			<input type="hidden" name="p24_url_return" value="{URL}" />
			<input type="hidden" name="p24_url_status" value="{P24_URL_STATUS}" />
			<input type="hidden" name="p24_time_limit" value="29" />
			<input type="hidden" name="p24_wait_for_result" value="1" />
			<input type="hidden" name="p24_api_version" value="{P24_VERSION}" />
		</form>
		<!-- ENDIF -->
		<!-- IF OPERATOR == 'bp' -->
		<form action="{SITEURL}/funcs.php?name=user&amp;file=bitpay" method="post" name="payment">
			<input type="hidden" name="itemname" value="{FUNC}" />
			<input type="hidden" name="custom" value="{CONTROL}" />
			<input type="hidden" name="itemprice" value="{SUM}" />
		</form>
		<!-- ENDIF -->
		<!-- IF OPERATOR == 'hp' -->
		<form action="https://platnosc.hotpay.pl/" method="post" name="payment">
			<input name="SEKRET" value="{CONTROL}" type="hidden">
			<input name="KWOTA" value="{SUM}" type="hidden">
			<input name="NAZWA_USLUGI" value="{FUNC}" type="hidden">
			<input name="ADRES_WWW" value="{URLC}" type="hidden">
			<input name="ID_ZAMOWIENIA" value="{CONTROL}" type="hidden">
			<input name="EMAIL" value="{EMAIL}" type="hidden">
			<input name="DANE_OSOBOWE" value="{IMIE} {NAZWISKO}" type="hidden">
		</form>
		<!-- ENDIF -->
		<!-- IF OPERATOR == 'sms' -->
		<div class="card mt-5">
			<h5 class="card-header">Zapłać przez SMS - szybko i wygodnie</h5>
			<div class="card-body">
		  	<div class="card-text">
					<p><big>Wyślij SMS o treści:</big></p>
					<p><big><strong>{SMS_TEXT}</strong> na numer <strong>{SMS_NUMBER}</strong></big></p>
					<hr />
		  		<p>Otrzymasz zwrotny SMS z kodem dostępu. Poniżej wpisz kod, który otrzymałeś SMSem</p>
				  <form method="post" class="form-row">
						<div class="col-2 text-right offset-2"><strong>Wpisz kod:</strong></div>
						<div class="col-3"><input type="text" name="sms-code" class="form-control text-center" required /></div>
						<div class="col-2"><input name="sms-code-check" value="Wyślij" type="submit" class="btn btn-block btn-primary" /></div>
					</form>
					<div class="text-muted text-center mt-3"><small>Koszt SMS to {SMS_PRICE}{CURRENCY} ({SMS_PRICE_TAX}{CURRENCY} z VAT)</small></div>
			</div>
		</div>
		<div class="card-footer">
			<a href="http://www.przelewy24.pl" class="text-muted" target="_blank"><small>Przelewy24.pl</small></a>
		</div>
		<!-- ENDIF -->
	</div>
</body>
</html>

<!-- ELSEIF BREAK == '' -->

<!-- INCLUDE theme_header.tpl -->
<section class="user-payment py-4 my-5">
	<h3 class="text-center mb-4"><strong>{_LANG_331}</strong></h3>
	<div class="row">
		<div class="col-auto mx-auto">
			<ul class="list-group">
				<li class="list-group-item">
					<strong>{_LANG_332}</strong>
					<!-- IF MEMBER_NAME && MEMBER_TIME && MEMBER_TIME_NAME -->
					{_LANG_333} <strong>{MEMBER_NAME}<!-- IF MEMBER_TIME -->, {MEMBER_TIME} {MEMBER_TIME_NAME}<!-- ENDIF --></strong>
					<!-- ELSE -->
					{FUNC}
					<!-- ENDIF -->
				</li>
				<li class="list-group-item">
					<strong>{_LANG_334}</strong>
					<!-- IF FREE -->
					0.00 {CURRENCY}
					<!-- ELSE -->
					<!-- IF SUM_PROMO -->
					<del>{SUM} {CURRENCY}</del> {SUM_PROMO} {CURRENCY}
					<!-- ELSE -->
					{SUM} {CURRENCY}
					<!-- IF FUNC_FUNC != 'order_payment' --> <a class="float-right btn btn-primary btn-sm px-2 py-1" style="font-size:0.8em;" href="{SITEURL}/funcs.php?name=user&amp;file=member&amp;promo-code-show=1">{_LANG_501}</a><!-- ENDIF -->
					<!-- ENDIF -->
					<!-- ENDIF -->
				</li>
			</ul>
			<form method="post">
				<!-- IF FREE == '' -->
				<ul class="list-group mt-2 list-operators">
					<!--<li class="list-group-item">
						<input type="hidden" name="operator" value="hp" id="o_hp">
						<label class="" for="o_hp"><span></span><img class="mw-100" alt="HotPay" src="{SITEURL}/theme/img/payment_hp.png" /></label>
					</li>-->
					<!-- IF OPERATOR_PP -->
					<li class="list-group-item custom-control custom-radio d-flex align-items-center">
						<input class="custom-control-input" type="radio" name="operator" value="pp" id="o_p"<!-- IF (OPERATOR_PP == '' && OPERATOR_D == '') || OPERATOR_PP --> checked<!-- ENDIF --> />
						<label class="custom-control-label ml-3" for="o_p"><img class="ml-2" alt="PayPal" src="{SITEURL}/theme/img/payment_pp.png" /></label>
					</li>
					<!-- ENDIF -->
					<!-- IF OPERATOR_D -->
					<li class="list-group-item custom-control custom-radio d-flex align-items-center">
						<input class="custom-control-input" type="radio" name="operator" value="d" id="o_d"<!-- IF OPERATOR_D --> checked<!-- ENDIF --> />
						<label class="custom-control-label ml-3" for="o_d"><img class="ml-2" alt="DotPay" src="{SITEURL}/theme/img/payment_d.png" /></label>
					</li>
					<!-- ENDIF -->
					<!-- IF OPERATOR_P24 -->
					<li class="list-group-item d-flex align-items-center">
						<input class="" type="radio" name="operator" value="p24" id="o_p24"<!-- IF OPERATOR_P24 --> checked<!-- ENDIF --> />
						<label class="ml-3" for="o_p24"><img class="ml-2" alt="Przelewy24" src="{SITEURL}/theme/img/payment_p24.png" /></label>
					</li>
					<!-- ENDIF -->
					<!-- IF OPERATOR_BP -->
					<li class="list-group-item custom-control custom-radio">
						<input class="custom-control-input" type="radio" name="operator" value="bp" id="o_bp"<!-- IF OPERATOR_BP --> checked<!-- ENDIF --> />
						<label class="custom-control-label ml-3" for="o_bp"><span></span><img alt="BitPay" src="{SITEURL}/theme/img/payment_bp.png" /></label>
					</li>
					<!-- ENDIF -->
					<!-- IF OPERATOR_BT -->
					<li class="list-group-item px-0 pb-0">
						<div class="custom-control custom-radio pb-2">
							<input class="custom-control-input" type="radio" name="operator" value="bt" id="o_bt" />
							<label class="custom-control-label ml-3 px-3" for="o_bt"><img class="ml-2" alt="{_LANG_811}" src="{SITEURL}/theme/img/payment_bt.png" /> <strong>{_LANG_811}</strong></label>
						</div>
						<div class="box-payment-bt bg-light border-top p-3">
							<p>{PAYMENT_BANK_TRANSFER}</p>
							<p>{_LANG_812} <b>{USERNAME} ({USER_ID})</b></p>
						</div>
					</li>
					<!-- ENDIF -->
					<!-- IF OPERATOR_SMS -->
					<li class="list-group-item custom-control custom-radio">
						<input class="custom-control-input" type="radio" name="operator" value="sms" id="o_sms" />
						<label class="custom-control-label ml-3" for="o_sms"><img class="ml-2" alt="SMS" src="{SITEURL}/theme/img/payment_sms.png" /></label>
					</li>
					<!-- ENDIF -->
				</ul>
				<!-- ENDIF -->
				<div class="footer-box">
					<div class="form-group mt-2 text-right">
			    	<label><input type="checkbox" name="accept1" value="1" required /> {_LANG_475} <a target="_blank" href="{CONTENT_HREF_1}" class="text-primary">{_LANG_264}</a></label>
					</div>
					<p class="text-right mt-3 mb-0"><button class="btn btn-success" name="submitRedirect" value="1">{_LANG_339} <em class="fa fa-angle-double-right"></em></button></p>
				</div>
			</form>
		</div>
	</div>
</section>

<!-- INCLUDE theme_footer.tpl -->

<!-- ENDIF -->
