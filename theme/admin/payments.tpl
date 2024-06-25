  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'payments' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=payments">Zgłoszone wypłaty</a>
      </li>
			<li class="nav-item">
        <a class="nav-link<!-- IF OP == 'payments-end' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=payments-end">Zrealizowane wypłaty</a>
      </li>
    </ul>
  </div>
  <div class="card-body">

  	<h3 class="my-3">
  		<!-- IF OP == 'payments' -->Zgłoszone wypłaty<!-- ENDIF -->
  		<!-- IF OP == 'payments-end' -->Zrealizowane wypłaty<!-- ENDIF -->
  	</h3>
  	<form method="post">
    	<table class="table table-striped">
    		<tr>
    			<th>Użytkownik</th>
    			<th class="text-center">Kredyty</th>
    			<th class="text-right">Wartość</th>
    			<th>Dane do przelewu</th>
    			<th class="text-center">Data</th>
    			<!-- IF OP == 'payments' --><th>Wypłacone</th><!-- ENDIF -->
    		</tr>
    		<!-- BEGIN ps -->
    		<tr>
    			<td>
    				{ps.USERNAME},<br />
    				{ps.NAME}, {ps.AGE}
    			</td>
    			<td class="text-center">
    				{ps.CREDITS}
    			</td>
    			<td class="text-right">
    				{ps.PRICE}
    			</td>
    			<td>
    				{ps.NAME}<br />
    				{ps.BANK_ACCOUNT}
    			</td>
    			<td class="text-center">
    				{ps.DATE}
    			</td>
          <!-- IF OP == 'payments' -->
    			<td class="text-center">
    				<input type="checkbox" name="payment[]" value="{ps.ID}" />
    			</td>
          <!-- ENDIF -->
    		</tr>
    		<!-- END ps -->
        <!-- IF OP == 'payments' -->
    		<tr>
    			<td colspan="6" class="text-right"><button type="submit" name="save" value="1" class="btn btn-primary">Zapisz zmiany</button></td>
    		</tr>
        <!-- ENDIF -->
    	</table>
    </form>
  </div>
