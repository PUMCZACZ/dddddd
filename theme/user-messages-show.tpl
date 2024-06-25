<!-- INCLUDE tpl_user_open.tpl -->
<div class="bg-white border rounded p-2">
  <h4 class="border-bottom pb-3">Skrzynka odbiorcza</h4>
  <!-- IF I_ID -->
	<div class="mess mb-2">
		<div class="card">
			<div class="card-body">
				<a href="{ITEM_URL}" class="d-block w-100 border-bottom pb-2 mb-3">
					<img src="{PHOTO}" alt="{TITLE}" style="width:80px;" />
					{TITLE} <small>(ID: {ID})</small>
				</a>
			</div>
		</div>
	</div>
  <!-- ENDIF -->
  <div class="row">
  	<!-- BEGIN m -->
  	<div class="col-8 mb-2<!-- IF m.IS_SENDER --><!-- ELSE --> offset-4<!-- ENDIF -->">
  		<div class="card<!-- IF m.IS_SENDER --> bg-light<!-- ENDIF --><!-- IF m.READED == 0 --> border-info<!-- ENDIF -->">
  			<div class="card-header">{m.SENDER} <small class="pull-right">{m.DATE}</small></div>
  			<div class="card-body">
  				{m.MSG}
  				<!-- IF m.ATTACHMENT -->
  				<p class="mt-3 mb-0">
  					<a class="paperclip label label-default btn btn btn-outline-secondary btn-sm" href="{m.ATTACHMENT}"><em class="fa fa-paperclip"></em> Zobacz załącznik</a>
  				</p>
  				<!-- ENDIF -->
  			</div>
  			<!-- IF m.READED --><div class="card-footer text-right py-1"><small>Przeczytana {m.READED}</small></div><!-- ENDIF -->
  		</div>
  	</div>
  	<!-- END m -->
  </div>
	<form method="post" class="border-top mt-2 pt-3" enctype="multipart/form-data">
		<div class="row">
			<div class="col-7">
				<textarea name="msg" class="form-control" rows="3" placeholder="Odpowiedź"></textarea>
        <p class="text-right mt-2"><button type="submit" name="odpowiedz" value="1" class="btn btn-main"{DISABLED}>Wyślij wiadomość <em class="fa fa-send"></em></button></p>
			</div>
			<div class="col-5">

			</div>
		</div>
		<input type="hidden" name="id" value="{I_ID}" />
	</form>
</div>
<!-- INCLUDE tpl_user_close.tpl -->
