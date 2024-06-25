<!-- INCLUDE theme_header.tpl -->
<section class="main-sec row mt-3">

  <form method="get" action="funcs.php" class="search-bar search-bar-items bg-light border col-md-10 offset-md-1 p-4 mb-4">
    <input type="hidden" name="name" value="items" />
    <input type="hidden" name="file" value="list" />
    <div class="row">
      <div class="col-md-6 col-12 mb-3">
        <input class="form-control" type="text" name="string" value="{STRING}" placeholder="{_LANG_119}" />
      </div>
      <!-- IF MULTILANG -->
      <div class="col-md-3 col-6 mb-3">
        <select class="form-control" name="country" onchange="this.form.submit()">
          <option value="">{_LANG_95}</option>
          <!-- BEGIN kraj -->
          <option value="{kraj.ID}"<!-- IF COUNTRY == kraj.ID --> selected<!-- ENDIF -->>{kraj.NAME}</option>
          <!-- END kraj -->
        </select>
      </div>
      <!-- ENDIF -->
      <!-- IF .region -->
      <div class="col-md-3 col-6 mb-3">
        <select class="form-control" name="region" onchange="this.form.submit()">
          <option value="">{_LANG_579}</option>
          <!-- BEGIN region -->
          <option value="{region.NAME}"<!-- IF REGION == region.NAME --> selected<!-- ENDIF -->>{region.NAME}</option>
          <!-- END region -->
        </select>
      </div>
      <!-- ENDIF -->
      <div class="col-md-3 col-12 mb-3">
        <input class="form-control" type="text" name="city" value="{CITY}" placeholder="{_LANG_232}" />
      </div>
      <!-- IF LIST_TYPE == '' && .item_type -->
      <div class="col-md-3 col-12">
        <select name="i_type" class="form-control" onchange="this.form.submit()">
          <option value="">{_LANG_446}</option>
          <!-- BEGIN item_type -->
          <option value="{item_type.ID}"<!-- IF I_TYPE == item_type.ID --> selected<!-- ENDIF --> />{item_type.NAME}</option>
          <!-- END item_type -->
        </select>
      </div>
      <!-- ENDIF -->
      <div class="col-md-3 col-12">
        <select class="form-control" name="orderby" onchange="this.form.submit()">
          <option value="">{_LANG_600}</option>
          <option value="dateDESC"<!-- IF ORDERBY == 'dateDESC' --> selected<!-- ENDIF -->>{_LANG_103}</option>
          <option value="dateASC"<!-- IF ORDERBY == 'dateASC' --> selected<!-- ENDIF -->>{_LANG_102}</option>
          <!-- IF LIST_TYPE == '' -->
          <option value="priceDESC"<!-- IF ORDERBY == 'priceDESC' --> selected<!-- ENDIF -->>{_LANG_104}</option>
          <option value="priceASC"<!-- IF ORDERBY == 'priceASC' --> selected<!-- ENDIF -->>{_LANG_105}</option>
          <!-- ENDIF -->
        </select>
      </div>
      <div class="col-auto my-2 ml-auto">
        <button type="submit" name="search-button" value="1" class="btn btn-main btn-block text-uppercase"><i class="fas fa-search"></i> {_LANG_119}</button>
      </div>
    </div>
    <!-- IF LIST_TYPE == '' -->
    <!-- IF .par -->
    <div class="form-inline filter-list">
      <!-- BEGIN par -->
        <!-- IF par.TYPE == 't' -->
        <input type="text" name="par_{par.F_ID}" value="{par.VALUE}" class="form-control" placeholder="{par.NAME}" />
        <!-- ELSEIF par.TYPE == 'ch' -->
        <dl class="chkbox-dropdown mt-3">
          <dt>
            <a href="#" class="form-control">
              <span class="hida font-weight-normal">{par.NAME}</span>
              <span class="multiSel font-weight-normal"></span>
            </a>
          </dt>
          <dd>
            <div class="mutliSelect">
              <ul>
                <!-- BEGIN ch -->
                <li>
                  <label class="d-block font-weight-normal">
                    <input type="checkbox" name="par_{par.F_ID}[]" value="{ch.ID}" data-name="{ch.PARAMETER}"<!-- IF ch.CHECKED --> checked<!-- ENDIF --> /> {ch.PARAMETER}
                  </label>
                </li>
                <!-- END ch -->
              </ul>
            </div>
          </dd>
        </dl>
        <!-- ELSEIF par.TYPE == 's' -->
        <select name="par_{par.F_ID}" class="form-control">
          <option value="">{par.NAME}</option>
          <!-- BEGIN s -->
          <option value="{s.ID}"<!-- IF s.SELECTED --> selected<!-- ENDIF -->>{s.PARAMETER}</option>
          <!-- END s -->
        </select>
        <!-- ELSEIF par.TYPE == 'ft' -->
        <input type="number" step="any" name="par_{par.F_ID}[0]" value="{par.VALUE_1}" class="form-control" placeholder="{par.NAME} {_LANG_552}" />
        <input type="number" step="any" name="par_{par.F_ID}[1]" value="{par.VALUE_2}" class="form-control" placeholder="{par.NAME} {_LANG_553}" />
        <!-- ENDIF -->
      <!-- END par -->
      <button type="submit" class="btn btn-primary"><em class="fa fa-search"></em></button>
    </div>
    <!-- ENDIF -->
    <!-- ENDIF -->
    <input type="hidden" name="id" value="{ID}" />
    <input type="hidden" name="search" value="1" />
    <!-- IF LIST_TYPE == 'companies' --><input type="hidden" name="type" value="companies" /><!-- ENDIF -->
  </form>

  <main class="col-lg-7 offset-lg-1 col-12">
