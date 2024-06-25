<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{SITENAME}</title>
</head>
<body style="font-family: 'Century Gothic', Tahoma, Arial, sans-serif; font-size: 10pt; color: black; background: #F6F6F6;">
	<div style="background:#FFF; border:1px solid #E1E1E1; padding:10px; width:700px; margin:0 auto;">
		<div style="border-bottom: 2px solid #CCC; color: #515151;">
			<img style="float:right" alt="{SITENAME}" src="{SITEURL}/theme/img/logo.png" />
			<h4>{_LANG_538}</h4>
		</div>
		<p>{_LANG_539}</p>
		<table width="550" cellspacing="0" cellpadding="5" style="background: white; border-bottom: 1px solid #c3c3c3; font-size:10pt; font-family:'Century Gothic', Tahoma, Arial, sans-serif;">
			<tr>
				<th width="30%" style="border-top: 1px solid #c3c3c3; background: #eeeeee; vertical-align: top; padding: 3px; padding-top: 10px;">{_LANG_540}</th>
				<td style="border-top: 1px solid #c3c3c3; border-left: 1px solid #c3c3c3; vertical-align: top; padding: 3px; padding-top: 10px;"><a href="{SITEURL}/funcs.php?name=items&amp;id={ID}" target="_blank">{TITLE}</a> <small>({ID})</small></td>
			</tr>
			<tr>
				<th width="30%" style="border-top: 1px solid #c3c3c3; background: #eeeeee; vertical-align: top; padding: 3px; padding-top: 10px;">{_LANG_541}</th>
				<td style="border-top: 1px solid #c3c3c3; border-left: 1px solid #c3c3c3; vertical-align: top; padding: 3px; padding-top: 10px;"><!-- IF OFFER_PRICE -->{OFFER_PRICE} {CURRENCY}<!-- ELSE -->{_LANG_545}<!-- ENDIF --></td>
			</tr>
			<tr>
				<th width="30%" style="border-top: 1px solid #c3c3c3; background: #eeeeee; vertical-align: top; padding: 3px; padding-top: 10px;">{_LANG_542}</th>
				<td style="border-top: 1px solid #c3c3c3; border-left: 1px solid #c3c3c3; vertical-align: top; padding: 3px; padding-top: 10px;">{DATE_OFFER}</td>
			</tr>
			<tr>
				<th width="30%" style="border-top: 1px solid #c3c3c3; background: #eeeeee; vertical-align: top; padding: 3px; padding-top: 10px;">{_LANG_543}</th>
				<td style="border-top: 1px solid #c3c3c3; border-left: 1px solid #c3c3c3; vertical-align: top; padding: 3px; padding-top: 10px;">{DATE_END}</td>
			</tr>
		</table>
		<hr />
		<div>
			<a href="{SITEURL}/funcs.php?name=contact">{_LANG_544}</a>
		</div>
		<hr />
	</div>
</body>
</html>
