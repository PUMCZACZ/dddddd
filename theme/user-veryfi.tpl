<!-- INCLUDE theme_header.tpl -->
<section class="user-veryfi mt-3 row">
  <div class="col-6 offset-3">
    <h4 class="mb-5 font-weight-bold">{_LANG_421}</h4>
    <!-- IF STATUS === '1' || STATUS === '0' -->
    <!-- IF STATUS === '1' --><div class="alert alert-info">{_LANG_422}</div><!-- ENDIF -->
    <!-- IF STATUS === '0' --><div class="alert alert-warning">{_LANG_423}</div><!-- ENDIF -->
    <!-- ELSE -->
    <form method="post" enctype="multipart/form-data" class="card">
      <div class="card-body">
        <p>{_LANG_424}</p>
        <hr />
        <div class="form-group">
          <label>{_LANG_425}</label>
          <input type="file" name="attachment[]" multiple class="form-control" required />
        </div>
        <div class="form-group">
          <label>{_LANG_426}</label>
          <textarea name="comment" class="form-control" rows="3"></textarea>
        </div>
        <div class="form-group text-right">
          <button type="submit" name="save-veryfi" value="1" class="btn btn-primary">{_LANG_427}</button>
        </div>
      </div>
    </form>
    <!-- ENDIF -->
  </div>
</section>

<!-- INCLUDE theme_footer.tpl -->
