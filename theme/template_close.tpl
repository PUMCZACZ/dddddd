  </main>

  <nav class="col-lg-3 col-12 pr-0">
    <div class="list-group cats-list">
      <div class="d-lg-block d-none list-group-item list-group-item-secondary">
        <strong>{_LANG_430}</strong>
      </div>
      <button type="button" class="d-lg-none d-block list-group-item list-group-item-secondary" data-toggle="collapse" data-target="#demo"><strong>{_LANG_430}</strong></button>
      <div class="d-lg-block collapse" id="demo">
        <!-- IF CAT_UP_LINK && CAT_UP_NAZWA -->
        <a href="{CAT_UP_LINK}" class="list-group-item list-group-item-action<!-- IF CAT_UP_ACTIVE --> active<!-- ELSE --> cat-up<!-- ENDIF -->">{CAT_UP_NAZWA}<i class="fas fa-level-up-alt"></i></a>
        <!-- ENDIF -->
        <!-- BEGIN c -->
        <a href="{c.LINK}" class="list-group-item list-group-item-action<!-- IF c.ACTIVE --> active<!-- ENDIF -->">{c.NAME}<small class="ml-2 text-secondary">({c.COUNTER})</small></a>
        <!-- END c -->
      </div>
    </div>
    <div class="list-group cats-list d-md-block d-none mt-5">
      <div class="d-lg-block d-none list-group-item list-group-item-secondary">
        <strong>Subskrypcja newsletteru</strong>
      </div>
      <form class="list-group-item" method="post" action="funcs.php?name=subscription">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">@</span>
          </div>
          <input type="email" name="email" placeholder="{_LANG_569}" class="form-control" required="required" />
        </div>
        <div class="text-right mt-2"><button type="submit" class="btn btn-info btn-sm">{_LANG_570} <em class="fa fa-angle-double-right"></em></button></div>
      </form>
    </div>

    <!-- IF ADV_11 --><p class="text-center py-5 d-md-block d-none" style="position: -webkit-sticky; position: sticky;top: 0;">{ADV_11}</p><!-- ENDIF -->

  </nav>
</section>
<!-- INCLUDE theme_footer.tpl -->
