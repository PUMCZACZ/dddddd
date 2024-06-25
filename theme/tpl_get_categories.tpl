<select name="{NAME}" class="form-control parent">
	<option value=""<!-- IF TYPE != 'all' --> disabled selected<!-- ENDIF -->><!-- IF TYPE != '' -->-- wszystkie --<!-- ELSE -->{_LANG_446}<!-- ENDIF --></option>
	<!-- BEGIN c -->
	<option value="{c.ID}">{c.NAME}</option>
	<!-- END c -->
</select>
