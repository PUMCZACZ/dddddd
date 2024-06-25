<!-- IF OP == 'items-orders' -->

<h2 class="p-2 border-bottom mb-3">Transakcje</h2>

<table class="table table-striped">
	<tr>
		<td>
			<form method="get" class="form-inline">
				<input type="hidden" name="op" value="items-orders" />
				Szukaj sprzedającego: <input type="text" name="seller" value="{SELLER_NAME}" placeholder="id użytkownika lub nazwa" class="form-control mx-2 w-50" /> <input type="submit" class="btn btn-primary" value="Szukaj" />
			</form>
		</td>
		<td>
			<form method="get" class="form-inline">
				<input type="hidden" name="op" value="items-orders" />
				Szukaj kupujacego: <input type="text" name="buyer" value="{BUYER}" placeholder="id użytkownika lub nazwa" class="form-control mx-2 w-50" /> <input type="submit" class="btn btn-primary" value="Szukaj" />
			</form>
		</td>
		<td>
			<form method="get" class="form-inline">
				<input type="hidden" name="op" value="items-orders" />
				Okres:
				<input type="date" name="date_start" value="{DATE_START}" placeholder="Data od" class="form-control mx-2" style="width:160px;" />
				<input type="date" name="date_end" value="{DATE_END}" placeholder="data do" class="form-control mx-2"  style="width:160px;" />
				<input type="submit" class="btn btn-primary" value="Szukaj" />
			</form>
		</td>
	</tr>
</table>
<form method="post">
	<table class="table table-striped table-bordered">
		<tr>
			<th>Nr</th>
			<th>Sprzedający</th>
			<th>Kupujący</th>
			<th>Dostawa</th>
			<th class="text-center">Suma całkowita</th>
			<th>Data</th>
			<th></th>
		</tr>
		<!-- BEGIN o -->
		<tr class="accordion">
			<td class="text-center">{o.ID}</td>
			<td><a target="_blank" href="{ADMIN_FILE}?op=user-edit&amp;id={o.SELLER_ID}">{o.SELLER_NAME} ({o.SELLER_ID})</a></td>
			<td><a target="_blank" href="{ADMIN_FILE}?op=user-edit&amp;id={o.BUYER_ID}">{o.BUYER_NAME} ({o.BUYER_ID})</a></td>
			<td class="text-right">
				{o.SHIPPING_NAME} - {o.SHIPPING_COST} {o.ITEM_CURRENCY}
			</td>
			<td class="text-right">{o.ORDER_SUM} {o.ITEM_CURRENCY}</td>
			<td class="text-center">{o.DATE}</td>
			<td class="text-center"><a href="{ADMIN_FILE}?op=items-orders-details&amp;id={o.ID}" class="btn btn-dark"><i class="fa fa-chevron-right mr-2"></i>Szczegóły</a></td>
		</tr>
		<!-- END o -->
		<tr>
			<td colspan="4" class="text-right">Ilość transakcj: {T_COUNT}</td>
			<td class="text-right">{T_SUM_ALL} {CURRENCY}</td>
			<td></td>
			<td></td>
		</tr>
	</table>
</form>
<!-- IF .p -->
<table class="table table-striped">
	<tr>
		<td class="text-center">
			<!-- BEGIN p -->
			<!-- IF p.ACTIVE --><strong>{p.PAGE_NAME}</strong><!-- ELSE --><a href="{ADMIN_FILE}?op=items-orders&amp;p={p.PAGE_NUMBER}">{p.PAGE_NAME}</a><!-- ENDIF -->
			<!-- END p -->
		</td>
	</tr>
</table>
<!-- ENDIF -->

<form method="post" class="text-right p-3"><button name="generate-summary" value="1" class="btn btn-primary">Generuj zestawienie</button></form>

<!-- ELSEIF OP == 'items-orders-details' -->
<h2 class="p-2 border-bottom mb-3">Szczegóły transakcji</h2>

<form method="post" class="p-3">
	<table class="table table-striped table-bordered">
		<tr>
			<th>Przedmiot</th>
			<th class="text-center">Ilość</th>
			<th class="text-center">Cena</th>
			<th class="text-center">Suma całkowita</th>
		</tr>
		<!-- BEGIN i -->
		<tr>
			<td><a target="_blank" href="{i.HREF}">{i.TITLE}</a></td>
			<td class="text-center">{i.QTY_ORDER}</td>
			<td class="text-right">{i.PRICE} {i.ITEM_CURRENCY}</td>
			<td class="text-right">{i.ITEM_PRICE_SUM} {i.ITEM_CURRENCY}</td>
		</tr>
		<!-- END i -->
		<tr>
			<td class="text-right">{SHIPPING_NAME}</td>
			<td class="text-center">1</td>
			<td class="text-right">{SHIPPING_COST} {ITEM_CURRENCY}</td>
			<td class="text-right">{SHIPPING_COST} {ITEM_CURRENCY}</td>
		</tr>
		<tr>
			<td colspan="3" class="text-right font-weight-bold">Suma:</td>
			<td class="text-right">{ORDER_SUM} {ITEM_CURRENCY}</td>
		</tr>
	</table>
	<hr />
	<div class="row">
		<div class="col-6">
			<h5 class="font-weight-bold border-bottom pb-3 mb-3">Kupujący</h5>
			<div class="row">
				<address class="col">
					<h6 class="text-uppercase text-secondary font-weight-bold">Nazwa</h6>
					<a class="text-primary" href="{ADMIN_FILE}?op=user-edit&amp;id={BUYER_USER_ID}">{BUYER_USERNAME}</a><br />
					{BUYER_COMPANY_NAME}
				</address>
				<address class="col">
					<h6 class="text-uppercase text-secondary font-weight-bold">Adres</h6>
					{BUYER_STREET}<br />
					{BUYER_POST_CODE} {BUYER_CITY}
				</address>
				<address class="col">
					<h6 class="text-uppercase text-secondary font-weight-bold">Kontakt</h6>
					<!-- IF BUYER_PHONE --><a class="text-primary mb-2" href="tel:{BUYER_PHONE}">{BUYER_PHONE}</a><br /><!-- ENDIF -->
					<a class="text-primary" href="mailto:{BUYER_USER_EMAIL}">{BUYER_USER_EMAIL}</a>
				</address>
			</div>
		</div>
		<div class="col-6 border-left">
			<h5 class="font-weight-bold border-bottom pb-3 mb-3">Sprzedający</h5>
			<div class="row">
				<address class="col">
					<h6 class="text-uppercase text-secondary font-weight-bold">Nazwa</h6>
					<a class="text-primary" href="{ADMIN_FILE}?op=user-edit&amp;id={USER_ID}">{USERNAME}</a><br />
					{COMPANY_NAME}
				</address>
				<address class="col">
					<h6 class="text-uppercase text-secondary font-weight-bold">Adres</h6>
					{STREET}<br />
					{POST_CODE} {CITY}
				</address>
				<address class="col">
					<h6 class="text-uppercase text-secondary font-weight-bold">Kontakt</h6>
					<!-- IF PHONE --><a class="text-primary mb-2" href="tel:{PHONE}">{PHONE}</a><br /><!-- ENDIF -->
					<a class="text-primary" href="mailto:{USER_EMAIL}">{USER_EMAIL}</a>
				</address>
			</div>
		</div>
	</div>
</form>
<!-- ENDIF -->
