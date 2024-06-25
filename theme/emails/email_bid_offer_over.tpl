<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<title>{SITENAME}</title>
</head>
<body style="background:#F0F0F0;">
	<div style="width:680px; margin:auto; font-family: Arial; font-size: 14px; color: #000000; background:#FFFFFF; padding:10px;">
		<img style="height:50px; display:block; margin:auto; width:200px;" src="{SITEURL}/theme/img/logo.png">
		<h4 style="font-size:18px; border-top:1px solid #DDDDDD; border-bottom:1px solid #DDDDDD; padding-top:10px; padding-bottom:10px;">
			Witaj!<br />Twoja maksymalna oferta została przebita!
		</h4>
		<p style="font-size:14px;"><b>{_LANG_539}</b></p>
		<table style="width:100%; font-size: 14px; text-align:left;" cellpadding="5">
			<tr>
				<th>Nazwa</th>
				<td><a href="{SITEURL}/items?id={ID}" target="_blank">{TITLE}</a> (ID {ID})</td>
			</tr>
			<tr>
				<th>Aktualna oferta</th>
				<td>{PRICE_BID_CURRENT} {ITEM_CURRENCY}</td>
			</tr>
			<tr>
				<th>Data zakończenia aukcji</th>
				<td>{DATE_END}</td>
			</tr>
		</table>
		<p>
			Wciąż możesz wygrać tę licytację! Aby zalicytować, przejdź do strony:<br />
			<a href="{SITEURL}/items?id={ID}" target="_blank">{TITLE}</a> (ID {ID})
		</p>
	</div>
	<div style="text-align: center; font-family: Arial; font-size: 8pt; color: #999999; margin-top:10px;">{SITENAME} &copy; {YEAR}</div>
</body>
</html>
