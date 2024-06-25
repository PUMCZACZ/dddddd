  <div class="card-body">

  	<h4 class="my-3">Kalendarz wydarzeń</h4>
  	<form method="post">
    	<table class="table table-striped">
    		<tr>
          <th></th>
    			<th>Nazwa</th>
    			<th class="text-center">Data</th>
          <th>Link</th>
    			<th class="text-center">Strona główna</th>
    		</tr>
    		<!-- BEGIN c -->
    		<tr>
          <td class="text-center"><input type="checkbox" name="id[]" value="{c.ID}" /></td>
    			<td>
            <!-- BEGIN langs -->
    				<span class="text-uppercase">{langs.NAME_DEF}</span>: <input type="text" name="name_{langs.NAME_DEF}[{c.ID}]" value="{langs.NAME}" class="form-control" />
            <!-- END langs -->
            <input type="hidden" name="edit_id[]" value="{c.ID}" />
    			</td>
    			<td class="text-center">
    				<input type="text" name="date[{c.ID}]" value="{c.DATE}" class="form-control" placeholder="DD-MM-YYY" />
    			</td>
          <td class="text-center">
    				<input type="text" name="link[{c.ID}]" value="{c.LINK}" class="form-control" placeholder="http://" />
    			</td>
    			<td class="text-center">
    				<input type="checkbox" name="main_page[{c.ID}]" value="1"<!-- IF c.MAIN_PAGE == 1 --> checked<!-- ENDIF --> />
    			</td>
    		</tr>
    		<!-- END c -->
    		<tr>
    			<td colspan="5" class="text-right">
            <button type="submit" name="delete" value="1" class="btn btn-danger" onclick="return confirm('Usunąć wybrane pozycje?');">Usuń</button>
            <button type="submit" name="update" value="1" class="btn btn-primary">Zapisz zmiany</button>
          </td>
    		</tr>
    	</table>
    </form>

    <h5>Nowe wydarzenie</h5>
    <form method="post">
      <table class="table table-striped">
        <tr>
          <th></th>
          <th>Nazwa</th>
          <th class="text-center">Data</th>
          <th>Link</th>
          <th class="text-center">Strona główna</th>
        </tr>
        <tr>
          <td class="text-center"></td>
          <td>
            <input type="text" name="name" class="form-control" />
          </td>
          <td class="text-center">
            <input type="text" name="date" class="form-control" placeholder="DD-MM-YYY" />
          </td>
          <td>
            <input type="text" name="link" class="form-control" placeholder="http://" />
          </td>
          <td class="text-center">
            <input type="checkbox" name="main_page" value="1" />
          </td>
        </tr>
        <tr>
          <td colspan="5" class="text-right"><button type="submit" name="add" value="1" class="btn btn-primary">Zapisz zmiany</button></td>
        </tr>
      </table>
    </form>

  </div>
