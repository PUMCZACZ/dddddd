<form method="post">
	<div class="card-body">
		<h3>Zgłoszenia użytkowników</h3>
		<div>
			<table class="table table-striped">
				<tr>
					<th></th>
					<th>Zgłaszający</th>
					<th>Zgłoszone</th>
					<th>Opis</th>
					<th class="text-center"><a href="{ADMIN_FILE}?op=report&amp;orderby=veryfi">Zweryfikowane</a></th>
					<th class="text-center"><a href="{ADMIN_FILE}?op=report&amp;orderby=active">Zawieszenie</a></th>
					<th class="text-center"><a href="{ADMIN_FILE}?op=report&amp;orderby=date">Data</a></th>
					<th class="text-center">IP</th>
					<th></th>
				</tr>
				<!-- BEGIN r -->
				<tr>
					<td class="text-center"><input type="checkbox" name="id[]" value="{r.ID}" /></td>
					<td>
						<!-- IF r.USER_ID -->
						{r.USERNAME} (ID: {r.USER_ID})
						<!-- ELSE -->
						<em>Niezalogowany</em>
						<!-- ENDIF -->
						<!-- IF r.ABUSE-EMAIL --><br /><strong>E-mail:</strong> {r.ABUSE-EMAIL}<!-- ENDIF -->
						<!-- IF r.ABUSE-NAME --><br /><strong>Imię i nazwisko:</strong> {r.ABUSE-NAME}<!-- ENDIF -->
						<!-- IF r.ABUSE-PHONE --><br /><strong>Telefon:</strong> {r.ABUSE-PHONE}<!-- ENDIF -->
					</td>
					<td>
						<!-- IF r.TYPE == 'item' -->Ogłoszenie: <a target="_blank" href="funcs.php?name=items&amp;id={r.X_ID}">{r.TITLE} (ID: {r.X_ID})</a><!-- ENDIF -->
						<!-- IF r.TYPE == 'user' -->Użytkownik: <a target="_blank" href="funcs.php?name=items&amp;file=profile&amp;id={r.X_ID}">{r.REPORT_USERNAME} (ID: {r.X_ID})</a><!-- ENDIF -->
					</td>
					<td>
						<p>{r.ABUSE-TEXT}</p>
						<!-- IF r.COMMENT -->
						<p class="text-secondary">
							<strong>Uwagi:</strong><br />
							<em>{r.COMMENT}</em>
						</p>
						<!-- ENDIF -->
					</td>
					<td class="text-center"><!-- IF r.VERYFI == 1 -->Tak<!-- ELSE -->Nie<!-- ENDIF --></td>
					<td class="text-center"><!-- IF r.TYPE == 'item' --><!-- IF r.ACTIVE == 1 -->Nie<!-- ELSE -->Tak<!-- ENDIF --><!-- ELSE --><em class="text-secondary">N/D</em><!-- ENDIF --></td>
					<td class="text-center">{r.DATE}</td>
					<td class="text-center">{r.IP}</td>
					<td class="text-center"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#report{r.ID}">Uwagi</button></td>
				</tr>
				<!-- END r -->
				<tr>
					<td colspan="9" class="text-right">
						<button type="submit" name="delete" value="1" class="btn btn-danger">Usuń</button>
						<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#deactive">Zawieś</button>
						<button type="submit" name="veryfi" value="1" class="btn btn-success">Zweryfikuj</button>
					</td>
				</tr>
			</table>
		</div>
	</div>

	<div class="modal fade" id="deactive" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div method="post" class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Uzasadnienie zawieszenia ogłoszenia</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<input type="text" name="deactive-subject" class="form-control" placeholder="Temat wiadomości" />
					</div>
					<div class="form-group">
						<textarea name="deactive-reason" class="form-control" rows="5" placeholder="Wiadomość"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" name="deactive" value="1" class="btn btn-primary">Zawieś</button>
				</div>
			</div>
		</div>
	</div>

</form>

<!-- BEGIN r -->
<div class="modal fade" id="report{r.ID}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Uwagi do zgłoszenia #{r.ID}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea name="comment" class="form-control" rows="5">{r.COMMENT}</textarea>
      </div>
      <div class="modal-footer">
				<input type="hidden" name="id" value="{r.ID}" />
        <button type="submit" name="save-comment" value="1" class="btn btn-primary">Zapisz</button>
      </div>
    </form>
  </div>
</div>
<!-- END r -->
