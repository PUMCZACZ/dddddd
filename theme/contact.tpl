<!-- INCLUDE theme_header.tpl -->
<div class="col-md-6 col-12 mx-auto">
  <section class="bg-light border p-3">
    <!-- IF CONTENT_NAME_16 -->
    <h3>{CONTENT_NAME_16}</h3>
    <hr />
    <!-- ENDIF -->
    <!-- IF CONTENT_TEXT_16 -->
    <p>{CONTENT_TEXT_16}</p>
    <!-- ENDIF -->
    <form method="post" enctype="multipart/form-data">
      <div class="form-group row">
        <div class="col-6">
          <label>Imię <b class="text-danger">*</b></label>
          <input type="text" name="imie" class="form-control" required />
        </div>
        <div class="col-6">
          <label>Nazwisko <b class="text-danger">*</b></label>
          <input type="text" name="nazwisko" class="form-control" required />
        </div>
      </div>
      <div class="form-group">
        <label>Kim jesteś? <b class="text-danger">*</b></label>
        <select name="kim_jestes" class="form-control" required>
          <option value="">Proszę wybrać</option>
          <!-- BEGIN contact_type -->
          <option>{contact_type.NAME}</option>
          <!-- END contact_type -->
        </select>
      </div>
      <div class="form-group">
        <label>{_LANG_328} <b class="text-danger">*</b></label>
        <input type="email" name="email" class="form-control" required />
      </div>
      <div class="form-group">
        <label>Nazwa firmy <b class="text-danger">*</b></label>
        <input type="text" name="nazwa_firmy" class="form-control" required />
      </div>
      <div class="form-group">
        <label>Numer telefonu <b class="text-danger">*</b></label>
        <input type="text" name="nr_telefonu" class="form-control" required />
      </div>
      <div class="form-group">
        <label>Treść zapytania <b class="text-danger">*</b></label>
        <textarea name="message" class="form-control" rows="4" required></textarea>
      </div>
      <div class="form-group form-check">
        <input type="checkbox" name="allow" value="1" id="allow" class="form-check-input" required /><label class="form-check-label" for="allow" style="line-height:13px; font-size:11px;">{_LANG_554}</label>
      </div>
      <div class="text-right">
        <div><!-- INCLUDE tpl_recaptcha.tpl --></div>
        <button type="submit" name="send" value="1" class="btn btn-success">{_LANG_0}</button>
      </div>
    </form>
  </section>
</div>
<!-- INCLUDE theme_footer.tpl -->
