<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf8" />
	<title>{SITENAME}</title>
</head>
<body>
	<div style="font-family: Arial; font-size: 10pt; color: #000000">
		<p>Nowy użytkownik został zarejestrowany w serwisie <b>{SITENAME}</b></p>
		<p>
			Informacje o użytkowniku:
			<ul>
				<li><b>Nazwa użytkownika:</b> {USERNAME} (ID: {USER_ID})</li>
				<li><b>Adres e-mail:</b> {USER_EMAIL}</li>
				<li><b>Data rejestracji:</b> {DATE}</li>
				<li><b>Typ konta:</b> <!-- IF U_TYPE == 'standard' -->Zwykłe<!-- ELSE -->Firmowe<!-- ENDIF --></li>
			</ul>
		</p>
	</div>
	<div style="text-align: right; font-family: Arial; font-size: 8pt; color: #999999">&copy; {SITENAME}</div>
</body>
</html>
