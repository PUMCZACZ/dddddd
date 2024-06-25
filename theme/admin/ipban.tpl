<!-- IF OP == 'ipban' -->

<h3>System Blokowania IP</h3>
<div class="well">
	<p class="text-center"><strong>Zablokuj nowy adres IP</strong></p>
	<form action="{ADMIN_FILE}" method="post">
		<p class="text-center">
			<!-- IF IP != 0 -->
			<input type="text" name="ip1" size="4" maxlength="3" value="{IP_0}"> . <input type="text" name="ip2" size="4" maxlength="3" value="{IP_1}"> . <input type="text" name="ip3" size="4" maxlength="3" value="{IP_2}" /> . <input type="text" name="ip4" size="4" maxlength="3" value="{IP_3}">
			<!-- ELSE -->
			<input type="text" name="ip1" size="4" maxlength="3"> . <input type="text" name="ip2" size="4" maxlength="3"> . <input type="text" name="ip3" size="4" maxlength="3"> . <input type="text" name="ip4" size="4" maxlength="3">
			<!-- ENDIF -->
		</p>
		<p class="text-center"><strong>Powód:</strong></p>
		<p class="text-center"><input type="text" name="reason" size="50" maxlength="255"></p>
		<p class="text-center">
			<input type="hidden" name="op" value="save_banned">
			<input type="submit" value="Zablokuj adres IP" class="btn btn-primary">
		</p>
		<p class="text-center"><font class="tiny">Znak * jest dozwolony jako ostatni numer, ale spowoduje to kompletne zablokowanie Klasy C sieci. Używaj tego znaku ostrożnie i tylko w wyjątkowych przypadkach.</font></p>
	</form>
</div>
<!-- IF .b -->
<h4>Zablokowane adresy IP</h4>
<table class="table table-striped">
	<tr>
		<th>Zablokowany adres IP</th>
		<th>Powód</th>
		<th class="text-center">Data zablokowania</th>
		<th class="text-center">Funkcje</th>
	</tr>
	<!-- BEGIN b -->
	<tr>
		<td>{b.IP_ADDRESS}</td>
		<td>{b.REASON}</td>
		<td class="text-center">{b.DATE}</td>
		<td class="text-center">
			<a title="Edytuj" class="btn btn-default" href="{ADMIN_FILE}?op=ipban_edit&amp;id={b.ID}"><em class="fa fa-edit"></em></a>
			<a title="Odblokuj" class="btn btn-default" href="{ADMIN_FILE}?op=ipban_delete&amp;id={b.ID}&amp;ok=0"><em class="fa fa-unlock"></em></a>
		</td>
	</tr>
	<!-- END b -->
</table>
<!-- ENDIF -->

<!-- ELSEIF OP == 'ipban_edit' -->

<h3>System Blokowania IP</h3>
<div class="well">
	<h4 class="text-center">Edytowanie zablokowanego adresu IP</h4>
	<form action="{ADMIN_FILE}" method="post">
		<p class="text-center">
			<input type="text" name="ip1" size="4" maxlength="3" value="{IP_0}"> . <input type="text" name="ip2" size="4" maxlength="3" value="{IP_1}" /> . <input type="text" name="ip3" size="4" maxlength="3" value="{IP_2}"> . <input type="text" name="ip4" size="4" maxlength="3" value="{IP_3}">
		</p>
		<p class="text-center">
			Powód:<br />
			<input type="text" name="reason" size="50" maxlength="255" value="{REASON}">
		</p>
		<p class="text-center">
			<input type="hidden" name="id" value="{ID}"><input type="hidden" name="op" value="ipban_save">
			<input type="submit" value="Zapisz zmiany" class="btn btn-primary">
		</p>
		<div class="alert alert-info text-center"><small>Znak * jest dozwolony jako ostatni numer, ale spowoduje to kompletne zablokowanie Klasy C sieci. Używaj tego znaku ostrożnie i tylko w wyjątkowych przypadkach.</small></div>
	</form>
</div>

<!-- ELSEIF OP == 'ipban_delete' -->

<h3>System Blokowania IP</h3>
<div class="well text-center">
	<p class="text-center">Potwierdź odblokowanie adresu <strong>{IP_ADDRESS}</strong></p>
	<p class="text-center">[ <a href="{ADMIN_FILE}?op=ipban_delete&amp;id={ID}&amp;ok=1">Odblokuj</a> | <a href="{ADMIN_FILE}.php?op=ipban">Wróć</a> ]</p>
</div>

<!-- ENDIF -->
