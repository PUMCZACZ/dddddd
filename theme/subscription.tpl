<!-- INCLUDE theme_header.tpl -->
<div class="row">
	<div class="col-md-6 col-12 offset-md-3">
		<div class="card">
			<div class="card-header">Subskrypcja newslettera</div>
			<form method="post" class="card-body">
				<p>
					Zapisz się i otrzymuj kody zniżkowe, oferty pracy oraz newsy z branży medycznej. Dołącz już teraz!
				</p>
				<div class="form-group">
					<label>Adres e-mail</label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">@</span>
						</div>
						<input type="email" name="email" value="{EMAIL}" class="form-control" required="required" placeholder="Adres e-mail" />
					</div>
				</div>
				<div class="form-group">
					<label>Kategoria</label>
					<select name="cat_id" class="form-control" required>
						<option value="">-- wybierz --</option>
						<!-- BEGIN c -->
						<option value="{c.ID}"<!-- IF c.ID == CAT_ID --> selected<!-- ENDIF -->>{c.NAME}</option>
						<!-- END c -->
					</select>
				</div>
				<div class="form-group">
					<input type="checkbox" name="rules" value="1" id="input-rules" required>
					<label for="input-rules" class="d-inline">Wyrażam zgodę na otrzymywanie od Medtalento.pl drogą elektroniczną na podany w formularzu adres poczty elektronicznej, newsy branżowe i kody promocyjne na znacznie tańszą publikację ogłoszeń o pracę. Przyjmuję do wiadomości, że zgoda ta może być przeze mnie w dowolnym momencie wycofana.</label>
					<a href="{CONTENT_HREF_9}" target="_blank"><b class="text-danger">Zobacz klauzurę informacyjną zapisu na newsletter</b></a>
				</div>
				<div class="form-group">
					<div class="text-right"><!-- INCLUDE tpl_recaptcha.tpl --></div>
				</div>
				<div class="form-group text-right">
					<button type="submit" name="zapisz" value="1" class="btn btn-main">Wyślij <em class="fa fa-paper-plane-o"></em></button>
				</div>
			</div>
		</form>
	</div>
</div>
<!-- INCLUDE theme_footer.tpl -->
