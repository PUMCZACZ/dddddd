<form method="post" action="funcs.php?name=user">
  <div class="form-group">
    <label>{_LANG_165}</label>
    <input type="text" name="name_user" value="{USER_NAME}" placeholder="{_LANG_165}" class="form-control" />
  </div>
  <!-- IF USER_GENDER == 'p' -->
  <div class="form-group">
    <label>{_LANG_165} partnera</label>
    <input type="text" name="name_user2" value="{USER_NAME2}" placeholder="{_LANG_165} partnera" class="form-control" />
  </div>
  <!-- ENDIF -->
  <div class="form-group">
    <label>{_LANG_167}</label>
    <input type="text" name="city" value="{USER_CITY}" placeholder="{_LANG_167}" class="form-control" />
  </div>
	<div class="form-group text-right mb-0">
		<button type="submit" name="finish-register" value="1" class="btn btn-block btn-danger text-uppercase">{_LANG_168}</button>
		<input type="hidden" name="finish-register" value="1" />
	</div>
</form>
