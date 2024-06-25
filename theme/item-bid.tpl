<!-- INCLUDE theme_header.tpl -->
<div class="container my-3">
	<div class="card col-md-8 offset-md-2 col-12 p-3">
		<form method="post" action="">
		<h4 class="border-bottom pb-3 mb-3">Potwierdź swoją ofertę</h4>
		<div class="row">
			<div class="col-md-3 col-12">
				<img class="mw-100" alt="{TITLE}" src="{IMAGE_MAIN}" />
			</div>
			<div class="col-md-9 col-12">
			<table class="table table-striped">
				<tr>
					<th class="text-nowrap">Tytuł aukcji:</th>
					<td>{TITLE}</td>
				</tr>
				<tr>
					<th class="text-nowrap">Aktualna cena:</th>
					<td>{PRICE_BID_CURRENT} {ITEM_CURRENCY}</td>
				</tr>
				<tr>
					<th class="text-nowrap">Twoja oferta:</th>
					<td class="form-inline">
						<div class="input-group">
							<input type="number" name="offer" value="{OFFER}" step="{PRICE_BID_STEP}"<!-- IF TYPE_AD --><!-- ELSE --> min="{PRICE_BID_MINIMUM}"<!-- ENDIF --> class="form-control text-right" required />
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">{ITEM_CURRENCY}</span>
	  					</div>
						</div>
						<!-- IF TYPE_AD --><!-- ELSE --><small class="form-text text-muted d-block w-100">Minimalna oferta: {PRICE_BID_MINIMUM} {ITEM_CURRENCY}</small><!-- ENDIF -->
					</td>
				</tr>
				<tr>
				<td colspan="2">
					<p class="text-center">Klikając przycisk poniżej, zobowiązujesz się zapłacić oferowaną kwotę za licytowany przedmiot sprzedającemu jeżeli wygrasz licytację.</p>
					<p class="text-center"><button type="submit" name="offer-add" value="1" class="btn btn-main">Potwierdź ofertę</button></p>
					<input type="hidden" name="i_id" value="{ID}" />
				</td>
				</tr>
			</table>
			</div>
		</div>
		</form>
	</div>
</div>
<!-- INCLUDE theme_footer.tpl -->
