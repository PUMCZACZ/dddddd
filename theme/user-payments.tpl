<!-- INCLUDE tpl_user_open.tpl -->

<div class="row">
	<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
		<div class="card mb-3">
			<div class="card-body">{_LANG_800} <span class="font-weight-bold float-right">{BALLANCE} {CURRENCY}</span></div>
		</div>
		<form method="post" class="card">
			<div class="card-header">{_LANG_797}</div>
			<div class="card-body">
				<label>{_LANG_798}</label>
				<div class="form-group row">
					<div class="input-group col-md-6 offset-md-3 col-12">
						<input type="number" step="any" name="amount" value="{VALUE}" min="1" required class="form-control text-center" />
						<div class="input-group-prepend">
							<span class="input-group-text">{CURRENCY}</span>
						</div>
					</div>
				</div>
				<div class="form-group text-center mb-0"><button type="submit" name="add-amount" value="1" class="btn btn-main">{_LANG_799}</button></div>
			</div>
		</form>
	</div>
</div>

<ul class="nav nav-tabs mb-3 mt-5 font-weight-bold" id="pills-tab" role="tablist">
  <li class="nav-item ml-3">
    <a class="nav-link active" id="pills-balance-tab" data-toggle="pill" href="#pills-balance" role="tab" aria-controls="pills-balance" aria-selected="true"><big>Operacje</big></a>
  </li>
  <li class="nav-item ml-3">
    <a class="nav-link" id="pills-invoices-tab" data-toggle="pill" href="#pills-invoices" role="tab" aria-controls="pills-invoices" aria-selected="false"><big>Faktury</big></a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">

  <div class="tab-pane fade show active" id="pills-balance" role="tabpanel" aria-labelledby="pills-balance-tab">
		<h5 class="mt-1 border-bottom mb-3 pb-3">Operacje</h5>

		<table class="table table-striped table-bordered">
			<tr>
				<th class="text-left">Rodzaj</th>
				<th class="text-center">Wartość</th>
				<th class="text-center">Data</th>
				<th class="text-center">IP</th>
				<th class="text-center">ID przedmiotu</th>
			</tr>
			<!-- BEGIN ub -->
			<tr>
				<td class="text-left align-middle">{ub.TYPE_NAME}</td>
				<td class="text-right align-middle">{ub.AMOUNT} {CURRENCY}</td>
				<td class="text-center align-middle">{ub.DATE}</td>
				<td class="text-center align-middle">{ub.IP}</td>
				<td class="text-center align-middle"><!-- IF ub.I_ID -->{ub.I_ID}<!-- ELSE --><i class="text-secondary">Brak</i><!-- ENDIF --></td>
			</tr>
			<!-- END  ub -->
		</table>
	</div>

  <div class="tab-pane fade" id="pills-invoices" role="tabpanel" aria-labelledby="pills-invoices-tab">
		<h5 class="mt-1 border-bottom mb-3 pb-3">Wystawione faktury</h5>

		<!-- IF .i -->
		<table class="table table-striped">
			<tr>
				<th>{_LANG_340}</th>
				<th class="text-center">{_LANG_341}</th>
				<th class="text-center">{_LANG_342}</th>
				<th></th>
			</tr>
			<!-- BEGIN i -->
			<tr>
				<td class="align-middle">{i.INVOICE}</td>
				<td class="text-right align-middle">{i.PRICE} {CURRENCY}</td>
				<td class="text-center align-middle">{i.DATE}</td>
				<td class="text-center align-middle"><a class="btn btn-primary" href="{SITEURL}/user/payments?dwnl={i.ID}">{_LANG_343}</a></td>
			</tr>
			<!-- END i -->
		</table>
		<!-- ELSE -->
		<h4 class="text-secondary text-center">{_LANG_344}</h4>
		<!-- ENDIF -->
	</div>

</div>
<!-- INCLUDE tpl_user_close.tpl -->
