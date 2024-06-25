<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<title>{SITENAME}</title>
</head>
<body style="background:#F0F0F0;">
	<div style="width:680px; margin:auto; font-family: Arial; font-size: 14px; color: #000000; background:#FFFFFF; padding:10px;">
		<img style="height:50px; display:block; margin:auto;" src="{SITEURL}/theme/img/logo.png">
		<h4 style="font-size:18px; border-top:1px solid #DDDDDD; border-bottom:1px solid #DDDDDD; padding-top:10px; padding-bottom:10px;">{_LANG_729}</h4>
		<p style="font-size:14px;"><b>{_LANG_730}</b></p>
		<table style="width:100%; font-size: 14px;" cellpadding="5">
			<tr style="text-align:left;">
				<th>{_LANG_731}</th>
				<th style="text-align:center;">{_LANG_732}</th>
				<th style="text-align:center;">{_LANG_733}</th>
				<th style="text-align:center;">{_LANG_734}</th>
			</tr>
			{ITEMS_LIST}
			<tr>
				<td colspan="4" style="text-align:right; border-top:1px solid #DDDDDD;">{_LANG_735} <b>{SUMMARY} {ITEM_CURRENCY}</b></td>
			</tr>
		</table>

		<table style="width:100%; font-size: 14px;">
			<tr>
				<td style="width:50%;">
					<p><b>{_LANG_736}</b></p>
					<!-- IF SELLER_U_TYPE == 'business' -->{SELLER_COMPANY_NAME}<!-- ELSE -->{SELLER_NAME}<!-- ENDIF --><br />
					{SELLER_STREET}<br />
					{SELLER_POST_CODE} {SELLER_CITY}
					<!-- IF SELLER_U_TYPE == 'business' --><br />NIP: {SELLER_NIP}<!-- ENDIF -->
					<p>
						e-mail: {SELLER_EMAIL}
						<!-- IF SELLER_PHONE --><br />{_LANG_738}: {SELLER_PHONE}<!-- ENDIF -->
					</p>
				</td>
				<td style="width:50%;">
					<p><b>{_LANG_737}</b></p>
					<!-- IF BUYER_U_TYPE == 'business' -->{BUYER_COMPANY_NAME}<!-- ELSE -->{BUYER_NAME}<!-- ENDIF --><br />
					{BUYER_STREET}<br />
					{BUYER_POST_CODE} {BUYER_CITY}
					<!-- IF BUYER_U_TYPE == 'business' --><br />NIP: {BUYER_NIP}<!-- ENDIF -->
					<p>
						e-mail: {BUYER_EMAIL}
						<!-- IF BUYER_PHONE --><br />{_LANG_738}: {BUYER_PHONE}<!-- ENDIF -->
					</p>
				</td>
			</tr>
		</table>

		<!-- IF EXTRA_INFO -->
		<p><b>Wiadomość dla sprzedającego</b></p>
		<p>{EXTRA_INFO}</p>
		<!-- ENDIF -->

		<!-- IF SELLER_MESSAGE -->
		<p><b>{_LANG_741}</b></p>
		<p>{SELLER_MESSAGE}</p>
		<!-- ENDIF -->

		<!-- IF PAY_TRANSFER && PAY_TRANSFER_TEXT -->
		<p><b>{_LANG_806}</b></p>
		<p>{PAY_TRANSFER_TEXT}</p>
		<!-- ENDIF -->

	</div>
	<div style="text-align: center; font-family: Arial; font-size: 8pt; color: #999999; margin-top:10px;">{SITENAME} &copy; {YEAR}</div>
</body>
</html>
