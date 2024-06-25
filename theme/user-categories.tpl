<!-- INCLUDE tpl_user_open.tpl -->
<form method="get" class="">
  <input type="hidden" name="name" value="user" />
  <input type="hidden" name="file" value="categories" />
  <input type="hidden" name="search" value="1" />
  <div class="form-inline">
    <label>{_LANG_714}</label>
    <select name="uif_id" class="form-control ml-3 mr-5<!-- IF UIF_ID == '' --> border-danger<!-- ENDIF -->" onchange="this.form.submit();">
      <option value=""<!-- IF UIF_ID == '' --> selected<!-- ENDIF -->>{_LANG_713}</option>
      <!-- BEGIN uif -->
      <option value="{uif.ID}"<!-- IF uif.ID == UIF_ID --> selected<!-- ENDIF -->><!-- IF uif.FILELINK -->{uif.FILELINK}<!-- ELSE -->{uif.FILENAME}<!-- ENDIF --></option>
      <!-- END uif -->
    </select>
  </div>
</form>
<!-- IF UIF_ID -->
<hr />
<form method="post">
  <table class="table table-striped mt-3 user-cats">
    <tr>
      <th class="text-center">
        <input type="checkbox" name="checkall" id="chkbox" value="select" onClick="do_this();" />
      </th>
      <th>{_LANG_712}</th>
      <th>{_LANG_711}</th>
      <th></th>
    </tr>
    <!-- BEGIN uc -->
    <tr>
      <td class="text-center">
        <input type="checkbox" name="id[]" value="{uc.ID}" class="check_id" />
      </td>
      <td>{uc.NAME}</td>
      <td class="cats-main text-nowrap">
        <!-- IF .uc.clist -->
        <!-- BEGIN clist --><span>{clist.NAME}</span><!-- END clist -->
        <!-- ELSE -->
        <i class="text-secondary">Brak</i>
        <!-- ENDIF -->
      </td>
      <td class="text-center">
        <a href="#{uc.ID}" data-id="{uc.ID}" data-uif_id="{uc.UIF_ID}" data-name="{uc.NAME}" data-toggle="modal" data-target="#catInfo" class="btn btn-outline-dark btn-sm link-cats"><i class="fas fa-link"></i></a>
      </td>
    </tr>
    <!-- END uc -->
  </table>

  <div class="op-menu bg-dark p-3" style="bottom:0; margin:0 -10px 10px;">
    <a href="#" class="btn btn-outline-light" data-toggle="modal" data-target="#cats-group"><i class="fas fa-ellipsis-v mr-2"></i>{_LANG_720}</a>
  </div>

  <div class="modal fade" id="cats-group" tabindex="-1" role="dialog" aria-labelledby="cats-group" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">{_LANG_721}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>{_LANG_722}</label>
            <select name="cat_id[]" class="form-control parent mb-2" required>
              <option value="">-- wybierz --</option>
              <!-- BEGIN c -->
              <option value="{c.ID}">{c.NAME}</option>
              <!-- END c -->
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <input type="hidden" name="uif_id" value="{UIF_ID}" />
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{_LANG_723}</button>
          <button type="submit" class="btn btn-primary" name="save-group" value="1"><i class="fas fa-save"></i> {_LANG_724}</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ENDIF -->

</form>

<!-- IF PAGER -->
<nav aria-label="navigation" class="float-right">
  <ul class="pagination">
    {PAGER}
  </ul>
</nav>
<!-- ENDIF -->

<div class="modal fade" id="catInfo" tabindex="-1" role="dialog" aria-labelledby="catInfo" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="catInfo">Przyporządkowanie kategorii do sklepu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nazwa kategorii sklepu</label>
          <input type="text" class="form-control" name="cat_name" disabled readonly />
          <input type="hidden" name="uif_id" />
          <input type="hidden" name="id" />
        </div>
        <div class="form-group">
          <label>Kategoria serwisu</label>
          <select name="cat_id[]" class="form-control parent mb-2" required>
            <option value="">-- wybierz --</option>
            <!-- BEGIN c -->
            <option value="{c.ID}">{c.NAME}</option>
            <!-- END c -->
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Anuluj</button>
        <button type="submit" class="btn btn-primary" name="save" value="1"><i class="fas fa-save"></i> Zapisz</button>
      </div>
    </form>
  </div>
</div>
<!-- INCLUDE tpl_user_close.tpl -->
