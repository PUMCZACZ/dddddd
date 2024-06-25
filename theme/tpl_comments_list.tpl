<table class="table table-borderless row">
  <!-- BEGIN c -->
  <tr>
    <td colspan="2" class="pb-2">
      {c.USERNAME}
    </td>
  </tr>
  <tr>
    <td class="pt-0">
      <!-- IF c.COMMENT_TYPE == 1 --><strong class="text-success">{_LANG_650}</strong><!-- ENDIF -->
      <!-- IF c.COMMENT_TYPE == 0 --><strong class="">{_LANG_651}</strong><!-- ENDIF -->
      <!-- IF c.COMMENT_TYPE == -1 --><strong class="text-danger">{_LANG_652}</strong><!-- ENDIF -->
      <small class="d-block mt-1">{c.DATE}</small>
    </td>
    <td class="pt-0 row">
      <div class="col-6 rating">{_LANG_654}<span class="rating-stars rating-stars-{c.RATING1}"></span></div>
      <div class="col-6 rating">{_LANG_655}<span class="rating-stars rating-stars-{c.RATING2}"></span></div>
      <div class="col-6 rating">{_LANG_656}<span class="rating-stars rating-stars-{c.RATING3}"></span></div>
      <div class="col-6 rating">{_LANG_657}<span class="rating-stars rating-stars-{c.RATING4}"></span></div>
    </td>
  </tr>
  <tr>
    <td colspan="2" class="border-bottom">
      <p class="mb-1"><i>{c.COMMENT}</i></p>
      <p><a class="text-primary" href="{c.HREF}">{c.TITLE}</i></p>
    </td>
  </tr>
  <!-- END c -->
</table>
