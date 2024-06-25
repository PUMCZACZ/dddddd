<!-- INCLUDE tpl_user_open.tpl -->

<div class="user-items user-orders">

  <!-- IF OP == 'info' -->
  <div class="order-info row">
    <div class="col-12">
      <div class="rounded border">
        <!-- INCLUDE tpl_items_list.tpl -->
      </div>
      <div class="rounded border p-3 my-3">
        <h4 class="border-bottom pb-2 mb-3">{_LANG_645}</h4>
        <div class="row">
          <address class="col">
            <h6 class="text-uppercase text-secondary font-weight-bold">{_LANG_646}</h6>
            <a class="text-primary" href="{SITEURL}/items/categories?user_id={USER_ID}&amp;id=0&amp;search=1&amp;end=1">{USERNAME}</a><br />
            {COMPANY_NAME}
          </address>
          <address class="col">
            <h6 class="text-uppercase text-secondary font-weight-bold">{_LANG_647}</h6>
            {STREET}<br />
            {POST_CODE} {CITY}
          </address>
          <address class="col">
            <h6 class="text-uppercase text-secondary font-weight-bold">{_LANG_648}</h6>
            <!-- IF PHONE --><a class="text-primary mb-2" href="tel:{PHONE}">{PHONE}</a><br /><!-- ENDIF -->
            <a class="text-primary" href="mailto:{USER_EMAIL}">{USER_EMAIL}</a>
          </address>
        </div>
      </div>
      <!-- IF ITEMS_COMMENTS -->
      <form method="post" class="rounded border p-3 my-3">
        <h4 class="border-bottom pb-2 mb-3" id="comment">{_LANG_649}</h4>
        <!-- IF COMMENT_TYPE -->
        <p class="text-<!-- IF COMMENT_TYPE == 1 -->success<!-- ELSEIF COMMENT_TYPE == 0 -->dark<!-- ELSEIF COMMENT_TYPE == -1 -->danger<!-- ENDIF -->">
          <!-- IF COMMENT_TYPE == 1 -->{_LANG_650}<!-- ELSEIF COMMENT_TYPE == 0 -->{_LANG_651}<!-- ELSEIF COMMENT_TYPE == -1 -->{_LANG_652}<!-- ENDIF -->
        </p>
        <!-- IF COMMENT --><p><q><i>{COMMENT}</i></q></p><!-- ENDIF -->
        <div class="row">
          <div class="col-xl-6">
            <div class="form-group row mb-2">
              <div class="col-lg-7">{_LANG_654}</div>
              <div class="col-lg-5 text-right">
                <span class="ocena" id="rating-1"></span>
                <input id="rating-1-text" name="rating-1" type="hidden" />
              </div>
            </div>
            <div class="form-group row mb-2">
              <div class="col-lg-7">{_LANG_655}</div>
              <div class="col-lg-5 text-right">
                <span class="ocena" id="rating-2"></span>
                <input id="rating-2-text" name="rating-2" type="hidden" />
              </div>
            </div>
            <div class="form-group row mb-2">
              <div class="col-lg-7">{_LANG_656}</div>
              <div class="col-lg-5 text-right">
                <span class="ocena" id="rating-3"></span>
                <input id="rating-3-text" name="rating-3" type="hidden" />
              </div>
            </div>
            <!--
            <div class="form-group row">
              <div class="col-lg-7">{_LANG_657}</div>
              <div class="col-lg-5 text-right">
                <span class="ocena" id="rating-4"></span>
                <input id="rating-4-text" name="rating-4" type="hidden" />
              </div>
            </div>
            -->
          </div>
        </div>
        <!-- ELSE -->
        <div class="row">
          <div class="col-xl-6">
            <div class="form-group">
              <div class="custom-control custom-radio d-inline">
                <input type="radio" name="type" value="1" checked id="type1" class="custom-control-input">
                <label class="custom-control-label text-success" for="type1">{_LANG_650}</label>
              </div>
              <div class="custom-control custom-radio d-inline mx-4">
                <input type="radio" name="type" value="0" id="type2" class="custom-control-input">
                <label class="custom-control-label" for="type2">{_LANG_651}</label>
              </div>
              <div class="custom-control custom-radio d-inline">
                <input type="radio" name="type" value="-1" id="type3" class="custom-control-input">
                <label class="custom-control-label text-danger" for="type3">{_LANG_652}</label>
              </div>
            </div>
            <div class="form-group">
              <textarea name="comment" class="form-control" rows="3" placeholder="{_LANG_653}"></textarea>
            </div>
            <div class="form-group row mb-2">
              <div class="col-lg-7">{_LANG_654}</div>
              <div class="col-lg-5 text-right">
                <span class="ocena" id="rating-1"></span>
                <input id="rating-1-text" name="rating-1" type="hidden" />
              </div>
            </div>
            <div class="form-group row mb-2">
              <div class="col-lg-7">{_LANG_655}</div>
              <div class="col-lg-5 text-right">
                <span class="ocena" id="rating-2"></span>
                <input id="rating-2-text" name="rating-2" type="hidden" />
              </div>
            </div>

            <div class="form-group row mb-2">
              <div class="col-lg-7">{_LANG_656}</div>
              <div class="col-lg-5 text-right">
                <span class="ocena" id="rating-3"></span>
                <input id="rating-3-text" name="rating-3" type="hidden" />
              </div>
            </div>
            <!--
            <div class="form-group row">
              <div class="col-lg-7">{_LANG_657}</div>
              <div class="col-lg-5 text-right">
                <span class="ocena" id="rating-4"></span>
                <input id="rating-4-text" name="rating-4" type="hidden" />
              </div>
            </div>
            -->
            <div class="text-right border-top pt-2">
              <input type="hidden" name="o_id" value="{ID}" />
              <button type="submit" name="comment-add" value="1" class="btn btn-primary"><i class="fas fa-clipboard-check mr-2"></i>{_LANG_658}</button>
            </div>
          </div>
        </div>
        <!-- ENDIF -->
      </form>
      <!-- ENDIF -->
    </div>
  </div>

  <!-- ELSE -->

    <div class="row mb-3">
      <div class="col">
        <!-- IF FUNC_FILE != 'items_bids' -->
        <div class="custom-control custom-checkbox ml-1">
          <input type="checkbox" value="select" class="custom-control-input id-input" id="chkbox" onclick="do_this();">
          <label class="custom-control-label" for="chkbox">{_LANG_643}</label>
        </div>
        <!-- ENDIF -->
      </div>
      <form method="get" class="col">
        <input type="hidden" name="name" value="user" />
        <input type="hidden" name="file" value="{FUNC_FILE}" />
        <input type="hidden" name="status" value="active" />
        <div class="input-group">
          <input type="text" name="string" value="{STRING}" class="form-control" placeholder="{_LANG_644}" />
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" name="search" value="1"><i class="fas fa-search"></i></button>
          </div>
        </div>
      </form>
    </div>

  <form method="post">

    <!-- IF .o -->
    <div class="row">
      <div class="col-12">
        <!-- BEGIN o -->
        <!-- IF .o.i -->
        <div class="items my-3" id="list">
          <div class="items-list bg-light rounded border p-2">

            <div class="item-box col-12">
              <div class="row item rounded bg-white" style="margin-bottom:10px;">
                <div class="col-6 order-date">
                  <!-- IF OP == 'info' -->
                  <a class="text-danger" href="{SITEURL}/items/categories?user_id={o.SELLER_ID}&amp;id=0&amp;search=1&amp;end=1">{o.SELLER_NAME}</a>
                  <!-- ELSE -->
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="id[]" value="{o.ID}" class="custom-control-input id-input" id="u-{o.SELLER_ID}-o-{o.ID}" data-user_id="{o.SELLER_ID}">
                    <label class="custom-control-label" for="u-{o.SELLER_ID}-o-{o.ID}"></label>
                    {o.SELLER_NAME}
                  </div>
                  <!-- ENDIF -->
                </div>
                <div class="col-6 order-date">
                  {o.DATE}
                </div>
              </div>
            </div>

            <!-- BEGIN i -->
            <div class="item-box col-12">
              <div class="row item rounded bg-white" style="margin-bottom:10px;">
                <div class="img px-md-2 p-0 d-flex align-items-center justify-content-center col-md-1 col-12 img-height">
                  <a title="{i.TITLE}" href="{i.HREF}">
                    <!-- IF i.PRICE_PROMO && i.PRICE_NONPROMO && i.PRICE_PROMO_PR -->
                    <div class="d-block price-promo position-absolute" style="top:5px; left:5px;">
                      <!-- IF i.PRICE_PROMO_PR --><span class="badge badge-warning mr-2">{i.PRICE_PROMO_PR}%</span><!-- ENDIF -->
                    </div>
                    <!-- ENDIF -->
                    <img class="mw-100" alt="{i.TITLE}" src="{i.PHOTO}" />
                  </a>

                </div>
                <div class="<!-- IF FUNC_FILE == 'categories' || FUNC_FILE == 'profile' || MAIN-PAGE || ITEM --><!-- IF VIEW-MODE == 'tiles' -->col-12<!-- ELSE -->col-lg-9 col-md-9 col-12<!-- ENDIF --><!-- ELSEIF FUNC_FILE == 'items_orders' || FUNC_FILE == 'items_sale' || FUNC_FILE == 'items_bids' -->col-11<!-- ELSE -->col-md-8 col-12<!-- ENDIF -->">

                  <!-- IF FUNC_FILE == 'items_orders' || FUNC_FILE == 'items_sale' -->

                  <div class="row">
                    <div class="col-7">
                      <h2 class="mt-0">
                        <a title="{i.TITLE}" href="{i.HREF}">{i.TITLE}  <small class="text-secondary">({i.ID})</small></a>
                      </h2>
                    </div>
                    <div class="col text-right">
                    </div>
                    <div class="col text-right">
                      <span class="d-block">{i.ITEM_PRICE_SUM} {i.ITEM_CURRENCY}</span>
                      <!-- IF i.TYPE_NAME --><span class="mt-2 badge badge-<!-- IF i.TYPE == 270 -->success<!-- ELSEIF i.TYPE == 271 -->danger<!-- ENDIF --> d-inline-block text-uppercase p-2">{i.TYPE_NAME}</span><!-- ENDIF -->
                    </div>
                  </div>

                  <!-- ELSEIF LIST_TYPE == '' && VIEW-MODE == '' -->

                  <div class="float-right text-right item-price">

                    <!-- IF i.TYPE_BID -->
                    <big class="d-block"><strong class="text-main">{i.PRICE_BID_CURRENT} {i.ITEM_CURRENCY}</strong></big>
                    <small class="d-block mb-2"><!-- IF i.BID_OFFERS == 0 -->{_LANG_826}<!-- ELSE -->{i.BID_OFFERS} <!-- IF i.BID_OFFERS == 1 -->{_LANG_823}<!-- ELSEIF i.BID_OFFERS <= 4 -->{_LANG_824}<!-- ELSE -->{_LANG_825}<!-- ENDIF --><!-- ENDIF --></small>
                    <!-- IF i.TYPE_BN --><small class="d-block"><span class="text-main">{_LANG_813}</span> {i.PRICE_BN} {i.ITEM_CURRENCY}</small><!-- ENDIF -->
                    <!-- ELSE -->
                    <big class="d-block text-nowrap">

                      <!-- IF i.PRICE_PROMO && i.PRICE_NONPROMO -->
                      <div class="d-block price-promo">
                        <del class="text-muted font-weight-normal mr-2">{i.PRICE_NONPROMO} {i.ITEM_CURRENCY}<!-- IF i.UNIT --> / {i.UNIT}<!-- ENDIF --></del>
                      </div>
                      <!-- ENDIF -->


                      <strong class="text-main"><!-- IF i.PRICE == 0 -->{_LANG_512}<!-- ELSE -->{i.PRICE} {i.ITEM_CURRENCY}<!-- IF i.UNIT --> / {i.UNIT}<!-- ENDIF --><!-- ENDIF --></strong>

                      <!-- IF i.PRICE_CURRENCY --><small class="d-block text-right mb-2">~ {i.PRICE_CURRENCY} {i.PRICE_ITEM_CURRENCY}</small><!-- ENDIF -->

                    </big>

                    <small class="d-block">{_LANG_692} {i.SHIPPING_COST_MIN} {i.ITEM_CURRENCY}</small>

                    <!-- IF i.TYPE_NAME --><span class="mt-2 badge badge-<!-- IF i.TYPE == 270 -->success<!-- ELSEIF i.TYPE == 271 -->danger<!-- ENDIF --> d-inline-block text-uppercase p-2">{i.TYPE_NAME}</span><!-- ENDIF -->

                    <!-- ENDIF -->

                  </div>
                  <!-- ENDIF -->

                  <!-- IF i.USERNAME && VIEW-MODE == 'tiles' && (FUNC_FILE == 'categories' || FUNC_FILE == '') -->
                  <p class="mt-2 mb-0">{i.USERNAME}</p>
                  <!-- ENDIF -->

                  <!-- IF LIST_TYPE == '' && VIEW-MODE == 'tiles' -->
                  <div class="details details-tiles mt-2">

                    <big class="d-block text-right font-weight-bold">
                      <!-- IF i.PRICE == 0 -->{_LANG_512}<!-- ELSE -->{i.PRICE} {i.ITEM_CURRENCY}<!-- IF i.UNIT --> / {i.UNIT}<!-- ENDIF --><!-- ENDIF -->
                    </big>
                    <!-- IF i.PRICE_CURRENCY --><small class="d-block text-right">~ {i.PRICE_CURRENCY} {i.PRICE_ITEM_CURRENCY}</small><!-- ENDIF -->

                  </div>

                  <!-- ELSE -->

                  <!-- IF FUNC_FILE == 'items_list' -->
                  <!-- IF i.VERYFI == 0 --><span class="badge badge-warning text-uppercase mb-0 mr-1">{_LANG_172}</span><!-- ENDIF -->
                  <!-- IF i.ACTIVE == 0 --><span class="badge badge-danger text-uppercase mb-0 mr-1">{_LANG_173}</span><!-- ENDIF -->
                  <!-- IF i.VERYFI == 1 && i.SAVE_ONLY == 1 --><span class="badge badge-secondary text-uppercase mb-0">{_LANG_174}</span><!-- ENDIF -->
                  <!-- ENDIF -->

                  <!-- ENDIF -->

                  <!-- IF VIEW-MODE == '' && FUNC_FILE != 'items_orders' && FUNC_FILE != 'items_sale' -->
                  <h2 class="mt-0 mb-3<!-- IF i.PROMO_BOLD --> bold<!-- ENDIF -->">
                    <a title="{i.TITLE}" href="{i.HREF}">{i.TITLE}<!-- IF i.ID -->  <small class="text-secondary">({i.ID})</small><!-- ENDIF --></a>
                  </h2>
                  <!-- ENDIF -->

                  <!-- IF FUNC_FILE == 'items_orders' && OP == '' -->
                  <div class="border-top pt-3">
                    <div class="row">
                      <div class="col">
                        <a href="{SITEURL}/user/items_orders?op=info&amp;id={i.O_ID}" class="btn btn-link text-uppercase">{_LANG_640}</a>
                        <!--<!-- IF ITEMS_COMMENTS --><a href="{SITEURL}/user/items_orders?op=info&amp;id={i.O_ID}#comment" class="btn btn-link text-uppercase">{_LANG_641}</a><!-- ENDIF -->-->
                      </div>
                      <div class="col">
                        <h5 class="text-right">{_LANG_341} <strong class="text-success">{i.SUM_ALL} {i.ITEM_CURRENCY}</strong></h5>
                      </div>
                    </div>
                  </div>
                  <!-- ELSEIF FUNC_FILE != 'items_list' && FUNC_FILE != 'items_orders' && FUNC_FILE != 'items_sale' -->
                  <p class="my-3 d-md-block d-none">
                    {i.DESCRIPTION}
                  </p>
                  <!-- ENDIF -->

                  <!-- IF LIST_TYPE == '' -->
                  <div class="row">
                    <!-- IF VIEW-MODE == '' && (FUNC_FILE == 'categories' || FUNC_FILE == 'profile' || FUNC_FILE == 'items_bids') -->
                    <div class="col-12">
                      <!-- IF FUNC_FILE == 'items_bids' -->
                      <small>Najwyższa oferta:</small>
                      <!-- IF i.USERNAME_BID_HIGHEST -->{i.USERNAME_BID_HIGHEST}<!-- ELSE --><small><i class="text-secondary">Brak</i></small><!-- ENDIF -->
                      <!-- ELSE -->
                      <small>{_LANG_169}:</small>
                      {i.USERNAME}
                      <!-- ENDIF -->
                      <span class="mx-2">/</span>
                      <small>{_LANG_537} {i.TO_END}</small>
                      <span class="mx-2">/</span>
                      <!-- IF FUNC_FILE == 'items_bids' && i.USER_BID_HIGHEST -->
                      <small class="px-2 py-0 text-uppercase text-success"><i class="fas fa-check mr-2"></i> Twoja oferta jest najwyższa</small>
                      <!-- ELSEIF FUNC_FILE == 'items_bids' -->
                      <small class="px-2 py-0 text-uppercase text-danger"><i class="fas fa-sort-amount-down mr-2"></i> Twoja oferta została przelicytowana</small>
                      <a href="{i.HREF}"><small class="bg-light border border-success rounded text-uppercase px-2 py-0"><i class="fas fa-sort-amount-up mr-2"></i> Licytuj</small></a>
                      <!-- ENDIF -->
                    </div>
                    <!-- ENDIF -->
                  </div>
                  <!-- ENDIF -->

                  <!-- IF FUNC_FILE == 'items_list' || FUNC_FILE == 'watching' -->
                  <div class="mt-3">
                    <small>
                      {_LANG_178} {i.DATE}
                      <strong class="mx-4">&bull;</strong>
                      {_LANG_180} {i.VIEWS}
                    </small>
                  </div>
                  <!-- ENDIF -->

                </div>

              </div>
            </div>

            <!-- IF i.TYPE_BID && i.BID_OFFERS > 0 -->
            <div class="modal fade" id="offers-{i.ID}" tabindex="-1" aria-labelledby="offers-{i.ID}Label" aria-hidden="true">
              <div class="modal-dialog modal-lg	">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="offers-{i.ID}Label">Lista ofert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table">
                      <tr>
                        <th>Użytkownik</th>
                        <th class="text-center">Data</th>
                        <th class="text-center">Oferta</th>
                        <th class="text-center">Usuń</th>
                      </tr>
                      <!-- BEGIN o -->
                      <tr>
                        <td>{o.USERNAME}</td>
                        <td class="text-center">{o.DATE}</td>
                        <td class="text-right">{o.PRICE_OFFER} {i.ITEM_CURRENCY}</td>
                        <td class="text-center">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="delete-offer-id[{o.USER_ID}]" value="{o.ID}" class="custom-control-input" id="delete-o-{o.ID}">
                            <label class="custom-control-label" for="delete-o-{o.ID}"></label>
                          </div>
                        </td>
                      </tr>
                      <!-- END o -->
                    </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" data-toggle="modal" data-target="#deleteOfferInfo" class="btn btn-danger mr-auto"><i class="fas fa-trash"></i> Usuń</button>
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Zamknij</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="deleteOfferInfo" tabindex="-1" aria-labelledby="deleteOfferInfoLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deleteOfferInfoLabel">Uzasadnienie</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <textarea name="delete-offer-info" class="form-control" rows="3" placeholder="Podaj powód usunięcia oferty"></textarea>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" name="delete-offer" value="{i.ID}" class="btn btn-danger mr-auto"><i class="fas fa-trash"></i> Usuń</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- ENDIF -->

            <!-- END i -->
            <div class="text-right mb-2">
              <!-- IF i.PAY --><a href="{SITEURL}/user/items_orders?op=pay&amp;id={i.O_ID}" class="btn btn-sm btn-warning text-uppercase"><i class="fas fa-cart-arrow-down mr-2"></i>{_LANG_795}</a><!-- ENDIF -->
            </div>
          </div>
        </div>
        <!-- ENDIF -->
        <!-- END o -->
        <ul class="pagination justify-content-center">{PAGER}</ul>
      </div>
    </div>

    <!-- IF FUNC_FILE != 'items_bids' -->
    <div class="op-menu bg-dark p-3 clearfix" style="bottom:0; margin:0 -10px 10px;">
      <div class="row">
        <div class="col text-right"><button type="submit" name="delete" value="1" class="btn btn-sm btn-light"><i class="far fa-trash-alt mr-2"></i>{_LANG_182}</button></div>
      </div>
    </div>
    <!-- ENDIF -->

    <!-- ELSE -->
    <div class="text-center alert alert-info">
      <h4>
        <!-- IF STRING -->{_LANG_107}<!-- ELSE --><!-- IF FUNC_FILE == 'items_bids' -->{_LANG_847}<!-- ELSE -->{_LANG_639}<!-- ENDIF --><!-- ENDIF -->
      </h4>
    </div>
    <!-- ENDIF -->

  </form>

  <!-- ENDIF -->

</div>

<!-- INCLUDE tpl_user_close.tpl -->
