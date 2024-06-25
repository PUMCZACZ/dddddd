  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link<!-- IF OP == 'items' --> active<!-- ENDIF -->" href="{ADMIN_FILE}?op=items">Ogłoszenia</a>
      </li>
    </ul>
  </div>
  <div class="card-body">

<!-- IF OP == 'items' -->
<h3>Ogłoszenia</h3>
<form method="get">
  <input type="hidden" name="op" value="items" />
  <table class="table table-striped table-hover">
  	<tr>
  		<th>Wyszukiwanie ogłoszeń:</th>
  		<td>
  			<select name="search-type" class="form-control">
  				<option value="title"<!-- IF SEARCH-TYPE == 'title' --> selected<!-- ENDIF -->>Tytuł</option>
  				<option value="id"<!-- IF SEARCH-TYPE == 'id' --> selected<!-- ENDIF -->>ID ogłoszenia</option>
  				<option value="username"<!-- IF SEARCH-TYPE == 'username' --> selected<!-- ENDIF -->>Nazwa użytkownika</option>
          <option value="user_id"<!-- IF SEARCH-TYPE == 'user_id' --> selected<!-- ENDIF -->>ID użytkownika</option>
  			</select>
  		</td>
  		<td>
  			<input type="text" name="query" value="{QUERY}" class="form-control" />
  		</td>
  		<td>
  			<button type="submit" name="search" value="1" class="btn btn-primary">Szukaj</button>
  		</td>
  	</tr>
  </table>
</form>
<hr />

<div class="btn-group btn-group-toggle mb-3">
  <a href="admin-panel.php?op=items" class="btn btn-secondary<!-- IF ACTIVE === false --> active<!-- ENDIF -->">Wszystkie ({STATS_ITEMS_ALL})</a>
  <a href="admin-panel.php?op=items&amp;search=1&amp;active=1" class="btn btn-success<!-- IF ACTIVE === 1 --> active<!-- ENDIF -->">Aktywne ({STATS_ITEMS_ACTIVE})</a>
  <!-- <a href="admin-panel.php?op=items&amp;search=1&amp;veryfi=1" class="btn btn-success<!-- IF VERYFI === 1 --> active<!-- ENDIF -->">Zweryfikowane ({STATS_ITEMS_VERYFI})</a>
  <a href="admin-panel.php?op=items&amp;search=1&amp;veryfi=0" class="btn btn-info<!-- IF VERYFI === 0 --> active<!-- ENDIF -->">Niezweryfikowane ({STATS_ITEMS_UNVERYFI})</a> -->
  <a href="admin-panel.php?op=items&amp;search=1&amp;active=0" class="btn btn-warning<!-- IF ACTIVE === 0 --> active<!-- ENDIF -->">Nieaktywne ({STATS_ITEMS_UNACTIVE})</a>
</div>

<!-- IF .i -->
<form method="post">
  <table class="table table-striped table-hover">
  	<thead>
  		<tr>
        <th></th>
        <th class="text-center">ID</th>
  			<th>Tytuł</th>
        <th class="text-center">Użytkownik</th>
        <th>Kategoria</th>
  			<th>Cena</th>
        <th class="text-center">Data dodania</th>
        <th class="text-center">Zweryfikowane</th>
        <th class="text-center">Aktywne</th>
  			<th></th>
  		</tr>
  	</thead>
  	<tbody>
    	<!-- BEGIN i -->
    	<tr class="<!-- IF i.VERYFI == 0 -->table-info<!-- ENDIF -->">
        <td class="text-center"><input type="checkbox" name="i_id[]" value="{i.ID}" /></td>
        <td class="text-center">{i.ID}</td>
    		<td>
          <a target="_blank" href="{i.HREF}"><em class="fa fa-search"></em></a>
          <img style="width:50px;" class="border mx-2" alt="{i.TITLE}" src="{i.PHOTO}" />
          {i.TITLE_PL}
          <!-- IF i.IMPORT_NAME && i.IMPORT_ID --><small class="d-block text-secondary text-capitalize">({i.IMPORT_NAME} ID: {i.IMPORT_ID})</small><!-- ENDIF -->
        </td>
        <td class="text-center">{i.USERNAME} (ID: {i.USER_ID})</td>
    		<td>{i.CAT_NAME}</td>
        <td>{i.PRICE}</td>
        <td class="text-center">{i.DATE}</td>
        <td class="text-center">
          <input type="checkbox" name="veryfi[{i.ID}]" value="1"<!-- IF i.VERYFI == 1 --> checked<!-- ENDIF --> />
        </td>
        <td class="text-center">
          <input type="checkbox" name="active[{i.ID}]" value="1"<!-- IF i.ACTIVE == 1 --> checked<!-- ENDIF --> />
          <input type="hidden" name="id[]" value="{i.ID}" />
        </td>
    		<td style="text-align:center;"><a href="{ADMIN_FILE}?op=item-edit&amp;id={i.ID}">Edytuj</a></td>
    	</tr>
    	<!-- END u -->
    </tbody>
    <tfoot>
      <tr>
        <td colspan="10" class="text-right">
          <!-- IF VERYFI === 0 --><button type="submit" name="veryfi" value="1" class="btn btn-info"><em class="fa fa-check"></em> Zweryfikowane</button><!-- ENDIF -->
          <button type="button" data-toggle="modal" data-target="#delete" class="btn btn-danger"><em class="fa fa-trash"></em> Usuń</button>
          <button type="submit" name="save" value="1" class="btn btn-primary"><em class="fa fa-save"></em> Zapisz zmiany</button>
        </td>
      </tr>
    </tfoot>
    </tfoot>
  </table>

  <!-- IF PAGER -->
  <nav aria-label="Page navigation example" class="text-center">
    <ul class="pagination justify-content-center">
      {PAGER}
    </ul>
  </nav>
  <!-- ENDIF -->

  <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div method="post" class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Uzasadnienie usunięcia ogłoszenia</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="delete-subject" class="form-control" placeholder="Temat wiadomości" />
          </div>
          <div class="form-group">
            <textarea name="delete-reason" class="form-control" rows="5" placeholder="Wiadomość"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="delete" value="1" class="btn btn-primary" onclick="return confirm('Usunąć wybrane pozycje?');">Zawieś</button>
        </div>
      </div>
    </div>
  </div>

</form>

<!-- ELSE -->
<div id="error_box">Brak ogłoszeń spełniającyh twoje kryteria</div>
<!-- ENDIF -->

<!-- ELSEIF OP == 'item-edit' -->
<!-- ENDIF -->

</div>

<script type="text/javascript">
function do_this(){
  var checkboxes = document.getElementsByName('id[]');
  var button = document.getElementById('chkbox');
  if(button.value == 'select'){
    for (var i in checkboxes){
      checkboxes[i].checked = 'FALSE';
    }
    button.value = 'deselect'
  }else{
    for (var i in checkboxes){
      checkboxes[i].checked = '';
    }
    button.value = 'select';
  }
}
</script>
