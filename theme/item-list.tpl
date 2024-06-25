<!-- INCLUDE template_open.tpl -->
<section class="items">

  <div class="clearfix mt-2">
    <!-- IF .i -->
    <div class="view-mode float-right d-md-inline d-none">
      <a class="<!-- IF VIEW-MODE == '' -->active<!-- ENDIF -->" href="{ADDRESS_VIEW_MODE_DEF}"><em class="fa fa-list"></em></a>
      <a class="<!-- IF VIEW-MODE == 'tiles' -->active<!-- ENDIF -->" href="{ADDRESS_VIEW_MODE_TILES}"><em class="fa fa-th"></em></a>
    </div>
    <!-- ENDIF -->
  </div>

  <!-- IF ADV_6 --><div class="adv-show">{ADV_6}</div><!-- ENDIF -->

  <div class="mt-2">

    <!-- IF TYPE == 'c' && IS_USER && USER_TYPE == 'business' && USER_MEMBER == 'xxx' -->
    <div class="alert alert-danger text-center">
      <p>Twoja wizytówka firmowa nie jest widoczna w naszym katalogu.</p>
      <p class="mb-0"><a href="funcs.php?name=user&amp;file=member"><strong>Aktywuj abonament</strong></a> aby być widocznym dla internautów!</div></p>
    <!-- ENDIF -->

    <!-- IF .i -->
    <!-- INCLUDE tpl_items_list.tpl -->
    <!-- ELSE -->
    <h4 class="text-secondary text-center mt-3">{_LANG_107}</h4>
    <h6 class="text-secondary text-center">{_LANG_108}</h6>
    <!-- ENDIF -->
  </div>

  <!-- IF PAGER -->
  <nav aria-label="navigation" class="mt-5">
    <ul class="pagination pagination-lg justify-content-center">
      {PAGER}
    </ul>
  </nav>
  <!-- ENDIF -->

  <!-- IF ADV_7 --><div class="adv-show">{ADV_7}</div><!-- ENDIF -->

</section>
<!-- INCLUDE template_close.tpl -->
