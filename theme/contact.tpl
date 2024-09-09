<!-- INCLUDE theme_header.tpl -->
<div class="col-md-9 col-12 mx-auto mt-5">
  <section class="border p-3">
    <h3 class="text-center my-3">Kontakt</h3>
    <!-- IF CONTENT_NAME_16 -->
    <h3>{CONTENT_NAME_16}</h3>

    <!-- ENDIF -->
    <!-- IF CONTENT_TEXT_16 -->
    <p>{CONTENT_TEXT_16}</p>
    <!-- ENDIF -->
    <form class="contact-form" method="post" enctype="multipart/form-data">
      <div class="form-group row">
        <div class="col-12 col-md-4 mb-2">
          <label>Kim jesteś? <b class="text-danger">*</b></label>
          <select name="kim_jestes" class="form-control" required>
            <option value="">Proszę wybrać</option>
            <!-- BEGIN contact_type -->
            <option>{contact_type.NAME}</option>
            <!-- END contact_type -->
          </select>
        </div>
        <div class="col-12 col-md-4 mb-2">
          <label>Imię <b class="text-danger">*</b></label>
          <input type="text" name="imie" class="form-control" required />
        </div>
        <div class="col-12 col-md-4 mb-2">
          <label>Nazwisko <b class="text-danger">*</b></label>
          <input type="text" name="nazwisko" class="form-control" required />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-12 col-md-6 mb-2">
          <label>{_LANG_328} <b class="text-danger">*</b></label>
          <input type="email" name="email" class="form-control" required />
        </div>
        <div class="col-12 col-md-6 mb-2">
          <label>Numer telefonu <b class="text-danger">*</b></label>
          <input type="text" name="nr_telefonu" class="form-control" required />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-12 col-md-6 mb-2">
          <label>Nazwa firmy <b class="text-danger">*</b></label>
          <input type="text" name="nazwa_firmy" class="form-control" required />
        </div>
      </div>
      <div class="form-group">
        <label>Treść zapytania <b class="text-danger">*</b></label>
        <textarea name="message" class="form-control" rows="4" required></textarea>
      </div>
      <div class="form-group form-check">
        <input type="checkbox" name="allow" value="1" id="allow" class="form-check-input" required style="width: 20px; height: 20px" />
        <label class="form-check-label ml-2" for="allow">
          {_LANG_554}
        </label>
      </div>
      <div class="">
        <div><!-- INCLUDE tpl_recaptcha.tpl --></div>
        <button type="submit" name="send" value="1" class="btn btn-primary">{_LANG_0}</button>
      </div>
    </form>
  </section>
</div>
<!-- INCLUDE theme_footer.tpl -->
