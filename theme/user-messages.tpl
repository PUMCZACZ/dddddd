<!-- INCLUDE tpl_user_open.tpl -->
<div class="bg-white border rounded px-2">
  <h4 class="title">{_LANG_682}</h4>
  <!-- IF I_ID --><div class="alert alert-info">{_LANG_683} <strong>{MAIL_BOX_COUNT}</strong> {_LANG_684} <strong>{MAIL_BOX_UNREADED}</strong>.</div><!-- ENDIF -->
  <!-- IF .m -->
	<div class="row">
		<div class="col-4 font-weight-bold border-bottom py-2">{_LANG_685}</div>
    <div class="col-4 font-weight-bold border-bottom py-2">{_LANG_686}</div>
		<div class="col-4 font-weight-bold border-bottom py-2">{_LANG_687}</div>
	</div>
	<!-- BEGIN m -->
  <a href="{SITEURL}/funcs.php?name=user&amp;file=messages_show&amp;id={m.SENDER_ID}&amp;i_id={m.I_ID}" class="row py-3 border-bottom<!-- IF m.NIEPRZECZYTANA --> bg-info<!-- ENDIF -->">
	  <div class="col-4">{m.SENDER}</div>
		<div class="col-4">
      <!-- IF m.TITLE --><strong>{m.TITLE}</strong><!-- ELSE --><em class="text-secondary">{_LANG_688}</em><!-- ENDIF -->
		</div>
		<div class="col-4">{m.DATA}</div>
	</a>
  <!-- END m -->
	<!-- ENDIF -->
</div>
<!-- INCLUDE tpl_user_close.tpl -->
