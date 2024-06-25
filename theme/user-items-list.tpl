<!-- INCLUDE tpl_user_open.tpl -->

<div class="user-items">
  <!-- IF .i -->
  <!-- INCLUDE tpl_items_list.tpl -->
  <ul class="pagination justify-content-center">{PAGER}</ul>

  <!-- BEGIN i -->
  <div class="modal fade" id="offersList-{i.ID}" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="offersList-{i.ID}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="offersList-{i.ID}Label">Lista złożonych CV</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-striped">
            <tr>
              <th>#</th>
              <th>Nazwa pliku</th>
              <th></th>
              <th class="text-center">Data dodania</th>
            </tr>
            <!-- BEGIN o -->
            <tr>
              <td>{o.NO}</td>
              <td>{o.FILENAME}</td>
              <td class="text-center"><a target="_blank" class="btn btn-main" href="{o.HREF}">Pobierz</a></td>
              <td class="text-center">{o.DATE}</td>
            </tr>
            <!-- END o -->
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- END i -->

  <!-- ELSE -->
  <div class="text-center alert alert-info">
    <h4>{_LANG_575}</h4>
    <p class="mt-3 mb-0 text-center"><a href="funcs.php?name=items&amp;file=add&amp;new=1" class="btn btn-primary"><i class="fas fa-plus"></i> {_LANG_576}</a></p>
  </div>
  <!-- ENDIF -->
</div>

<!-- INCLUDE tpl_user_close.tpl -->
