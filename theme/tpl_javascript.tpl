<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="{SITEURL}/theme/js/bootstrap.min.js"></script>
<script src="{SITEURL}/theme/js/whcookies.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
<!-- IF RECAPTCHA --><script src='https://www.google.com/recaptcha/api.js'></script><!-- ENDIF -->
<!-- IF FUNC_NAME == 'news' --><script src="{SITEURL}/theme/js/autosize.js"></script><!-- ENDIF -->
<!-- IF MAIN-PAGEc-->  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script><!-- ENDIF -->

<script>
$(document).ready(function() {
	var offset = 150;
	var duration = 200;
	$(window).scroll(function() {
  	if ($(this).scrollTop() > offset) {
  		$('.menu-sticky').fadeIn(duration);
  	} else {
  		$('.menu-sticky').fadeOut(duration);
  	}
  });
});
</script>

<!-- IF MAIN-PAGE -->
<script type="text/javascript">
  $(document).ready(function(){
    $('.slick-carousel').slick({
		  centerMode: true,
		  centerPadding: '60px',
		  slidesToShow: 3,
		  responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 3
		      }
		    },
		    {
		      breakpoint: 480,
		      settings: {
		        arrows: true,
		        centerMode: true,
		        centerPadding: '40px',
		        slidesToShow: 1
		      }
		    }
		  ]
		});
  });
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'items_list' || FUNC_FILE == 'import' -->
<script>
$('.alert-import').fadeOut(0);
$('select[name=import-type]').on('change', function() {
  if ($(this).children("option:selected").val() == 'other') $('.alert-import').fadeIn(300);
  else $('.alert-import').fadeOut(0);

});
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'payment' -->
<script>
$('.box-payment-bt').fadeOut(0);
$('input[name=operator]').click(function() {
  if ($(this).val() == 'bt') {
    $('.box-payment-bt').fadeIn(500);
    $('.footer-box').fadeOut(0);
  } else {
    $('.box-payment-bt').fadeOut(0);
    $('.footer-box').fadeIn(250);
  }
});
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'messages_show' -->
<script>
  $("#file").hide();
  $("#show").click(function(){
    $("#file").show();
  });
  document.getElementById("upload").onchange = function () {
      document.getElementById("uploadFile").value = this.value;
  };
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'items_auctions' -->
<script>
$('#auction_photo').on('change', function(){
	$('[for=' + $(this).attr('id') + ']').html('<img style="height:95px;" src="' + window.URL.createObjectURL(this.files[0]) + '" />');
});

$('[id^=auction_photo_').on('change', function(){
	$('[for=' + $(this).attr('id') + ']').html('<img style="height:95px;" src="' + window.URL.createObjectURL(this.files[0]) + '" />');
});

$('body').on('click', '[data-target="#auctionAdd"]', function(){
	$('#date-view-block > div .date-view-delete').hide();
	$('#date-pickup-block > div .date-pickup-delete').hide();
});
$('body').on('click', '.edit-button', function(){
	$('#date-view-block > div .date-view-delete').show();
	$('#date-pickup-block > div .date-pickup-delete').show();
});

$('body').on('click', '[name=date-view-add]', function(){
	var box = $('.date-view-inputs:first').clone();
	box.find('.date-view-delete').show();
	box.find('.date-view-add').hide();
	box.appendTo('#date-view-block');
});

$('body').on('click', '[name=date-view-delete]', function(){
	$(this).closest('.date-view-inputs').remove();
});

$('body').on('click', '[name=date-pickup-add]', function(){
	var box = $('.date-pickup-inputs:first').clone();
	box.find('.date-pickup-delete').show();
	box.find('.date-pickup-add').hide();
	box.appendTo('#date-pickup-block');
});

$('body').on('click', '[name=date-pickup-delete]', function(){
	$(this).closest('.date-pickup-inputs').remove();
});
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'add' || ITEM-EDIT -->
<script>

var maxLength = $('.lang-title').attr('maxLength');
$('#rchars').text(maxLength);
$('.lang-title').keyup(function() {
  var textlen = maxLength - $(this).val().length;
  $('#rchars').text(textlen);
});
<!-- IF (TYPE_AD == '' || TYPE_AD == 0) && ITEM_TYPE_AD && IS_USER -->$('.box-price-ad').fadeOut(0);<!-- ENDIF -->
<!-- IF (ITEM_TYPE_AD && ITEM_TYPE_BN == '') || TYPE_AD -->
$('.box-price-ad').fadeIn(0);
$('input[name=price_ad]').prop('min', false);
<!-- ENDIF -->
<!-- IF (TYPE_BID == '' || TYPE_BID == 0) && (ITEM_TYPE_BN || ITEM_TYPE_AD) -->$('.box-price-bid').fadeOut(0);<!-- ENDIF -->
<!-- IF ITEM-EDIT && TYPE_BN == '' && (ITEM_TYPE_BN || ITEM_TYPE_AD) -->$('.box-price-bn').fadeOut(0);<!-- ENDIF -->
<!-- IF ITEM-EDIT && TYPE_BID -->
//$('input[name=qty]').prop('disabled', true);
//$('input[name=qty]').val(1);
//$('input[name=qty_min]').prop('disabled', true);
<!-- ENDIF -->
$('input[name=type_bid]').click(function() {
  if ($(this).is(':checked')) {
    $(this).prop('required', true);
    $('.box-price-bid').fadeIn(300);
    $('input[name=qty]').prop('disabled', true);
    $('input[name=qty]').val(1);
    $('input[name=qty_min]').prop('disabled', true);
    $('input[name=type_ad]').prop('checked', false);
    $('.box-price-ad').fadeOut(0);
  } else {
    $(this).prop('required', false);
    $('.box-price-bid').fadeOut(0);
    $('input[name=qty]').prop('disabled', false);
    $('input[name=qty_min]').prop('disabled', false);
  }
  if ($('input[name=type_bn]').prop('checked') == false && $('input[name=type_bid]').prop('checked') == false && $('input[name=type_ad]').prop('checked') == false) {
    $('.custom-checkbox-price-ad label').addClass('text-danger');
    $('.custom-checkbox-price-bid label').addClass('text-danger');
    $('.custom-checkbox-price-bn label').addClass('text-danger');
  } else if ($('input[name=type_bn]').prop('checked') == false || $('input[name=type_bid]').prop('checked') == false || $('input[name=type_ad]').prop('checked') == false) {
    $('.custom-checkbox-price-ad label').removeClass('text-danger');
    $('.custom-checkbox-price-bid label').removeClass('text-danger');
    $('.custom-checkbox-price-bn label').removeClass('text-danger');
  }
});
$('input[name=type_bn]').click(function() {
  if ($(this).is(':checked')) {
    $('.box-price-bn').fadeIn(300);
    $(this).prop('required', true);
    $('input[name=price]').prop('required', true);
		$('input[name=price_net]').prop('required', true);
    $('select[name=tax]').prop('required', true);
    $('select[name=item_currency]').prop('required', true);
    $('input[name=type_ad]').prop('checked', false);
    $('.box-price-ad').fadeOut(0);
    $('.box-price-bn input[name=price]').prop('required', true).prop('disabled', false);
		$('.box-price-bn input[name=price_net]').prop('required', true).prop('disabled', false);
    $('input[name=qty]').prop('required', true).prop('disabled', false);
    $('input[name=qty_min]').prop('required', true).prop('disabled', false);
  } else {
    $('.box-price-bn').fadeOut(0);
    $(this).prop('required', false);
    $('input[name=price]').prop('required', false);
		$('input[name=price_net]').prop('required', false);
    $('select[name=tax]').prop('required', false);
    $('select[name=item_currency]').prop('required', false);
  }
  if ($('input[name=type_bn]').prop('checked') == false && $('input[name=type_bid]').prop('checked') == false && $('input[name=type_ad]').prop('checked') == false) {
    $('.custom-checkbox-price-ad label').addClass('text-danger');
    $('.custom-checkbox-price-bid label').addClass('text-danger');
    $('.custom-checkbox-price-bn label').addClass('text-danger');
  } else if ($('input[name=type_bn]').prop('checked') == false || $('input[name=type_bid]').prop('checked') == false || $('input[name=type_ad]').prop('checked') == false) {
    $('.custom-checkbox-price-ad label').removeClass('text-danger');
    $('.custom-checkbox-price-bid label').removeClass('text-danger');
    $('.custom-checkbox-price-bn label').removeClass('text-danger');
  }
});
$('input[name=type_ad]').click(function() {
  if ($(this).is(':checked')) {
    $('.box-price-ad input[name=price]').prop('required', true);
		$('.box-price-ad input[name=price_net]').prop('required', true);
    $('.box-price-ad').fadeIn(300);
    $('.box-price-bn').fadeOut(0);
    $('input[name=type_bn]').prop('checked', false);
    $('.box-price-bid').fadeOut(0);
    $('input[name=type_bid]').prop('checked', false);
    $('input[name=qty]').prop('disabled', false);
    $('input[name=qty_min]').prop('disabled', false);
    $('.box-price-bn input[name=price]').prop('required', false).prop('disabled', true);
		$('.box-price-bn input[name=price_net]').prop('required', false).prop('disabled', true);
  } else {
    $('.box-price-ad').fadeOut(0);
    $('.box-price-ad input[name=price]').prop('required', false);
		$('.box-price-ad input[name=price_net]').prop('required', false);
    $('input[name=qty]').prop('disabled', false);
    $('input[name=qty_min]').prop('disabled', false);
  }
  if ($('input[name=type_bn]').prop('checked') == false && $('input[name=type_bid]').prop('checked') == false && $('input[name=type_ad]').prop('checked') == false) {
    $('.custom-checkbox-price-ad label').addClass('text-danger');
    $('.custom-checkbox-price-bid label').addClass('text-danger');
    $('.custom-checkbox-price-bn label').addClass('text-danger');
  } else if ($('input[name=type_bn]').prop('checked') == false || $('input[name=type_bid]').prop('checked') == false || $('input[name=type_ad]').prop('checked') == false) {
    $('.custom-checkbox-price-ad label').removeClass('text-danger');
    $('.custom-checkbox-price-bid label').removeClass('text-danger');
    $('.custom-checkbox-price-bn label').removeClass('text-danger');
  }
});

$('.photos.photos-modal img').on('click', function(){
  var image_desc = $('textarea.item-desc').val();
  var src = $(this).attr('src');
  CKEDITOR.instances.item_desc.insertHtml('<img width="500" src="'+src+'" /></img>');
  $('#imagemodal').modal('hide');
  //$('textarea.item-desc').html('<img src="'+src+'" />');
});

<!-- IF ITEMS_PROMO_PRICES -->
<!-- IF PRICE_PROMO == '' || PRICE_PROMO == 0 -->$('.price_nonpromo_show').hide(0);<!-- ENDIF -->
$('input[name=price_promo]').on('click', function(){
  if ($(this).prop('checked')) $('.price_nonpromo_show').show(100);
  else $('.price_nonpromo_show').hide(100);
});
multiplyBy();
$('input[name=price]').change(function(){
  multiplyBy();
});
$('input[name=price_nonpromo]').change(function(){
  multiplyBy();
});
function multiplyBy()
{
	num2 = $('input[name=price_nonpromo]').val();
	num1 = $('input[name=price]').val();
	//alert(num1+'+'+num2);
	if (num1=='' || num1==0 || num2=='' || num2==0) count = 0.00;
  else {
		count = Math.round((100/(num2/(num2-num1)))*-1);
		$('input[name=price_nonpromo]').attr('min', num1);
	}
	$('.price_promo_pr').text(count+'%');
  $('input[name=price_promo_pr]').val(count);
}
<!-- ENDIF -->
$('#add-payment').on('click', function(){
	var extraPaymentForm = $('#extra-payment .row:first').clone();
	extraPaymentForm = extraPaymentForm.removeClass('d-none').removeAttr('id');
	extraPaymentForm.find('input').attr('disabled', false);
	extraPaymentForm.appendTo('#extra-payment');
});

$('#extra-payment').on('click', 'button[name=delete-payment-extra]', function(){
	$(this).closest('.row').remove();
});

</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'categories' -->
<script>
$('input.check_id').click(function() {
  if ($(this).is(':checked')) {
    $(".op-menu").addClass("position-sticky");
  } else {
    $(".op-menu").toggleClass("position-sticky position-static");
  };
});
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'items_sale' -->
<script src="https://geowidget.easypack24.net/js/sdk-for-javascript.js"></script>
<script type="text/javascript">
$('input[name=shipping_type]').on('click', function(){
	var shipping_type = $(this).val();
	var shipping_price = $(this).data('price');
	if (shipping_type == 'inpost_locker_standard') {
		$('#locker-map').show();
		$('.alert-chose').show();
	} else {
		$('#locker-map').hide();
		$('.alert-chose').hide();
		$('button[value=shipping-create]').attr('disabled', false);
	}
	$('#shipping-price').html(shipping_price);
});
$('.show-shipping-details').on('click', function(){
	var o_id = $(this).data('id');
	var text = $('#id-' + o_id).html();
	$('#buyer-info').html(text);
	$('input[name=shipping_o_id]').val(o_id);
});
window.easyPackAsyncInit = function () {
	easyPack.init({
		defaultLocale: 'pl',
		mapType: 'osm',
		searchType: 'osm',
		points: {
			types: ['parcel_locker']
		},
		map: {
			initialTypes: ['parcel_locker']
		}
	});
};
function openModalMap() {
	easyPack.modalMap(function(point, modal) {
		modal.closeModal();
		$('input[name=shipping_point]').val(point.name);
		$('#shippingPoint').html(point.address.line1 + '<br>' + point.address.line2 + '<br>' + point.name);
		$('button[value=shipping-create]').attr('disabled', false);
		$('.alert-chose').hide(50);
	}, { width: 500, height: 600 });
}
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'items_orders' || FUNC_FILE == 'items_list' || FUNC_FILE == 'items_sale' || PROFILE -->
<script src="{SITEURL}/theme/js/jquery.raty.min.js"></script>
<script>
var buttonOrdersPay = $('button[value=orders-pay]');
buttonOrdersPay.hide();

$('input.id-input').click(function() {
	var checkedIDs = $('input.id-input:checked');
	var countChecked = checkedIDs.length;

	if (countChecked > 0) {
		for (var a=0; a<countChecked; a++) {
			var checkboxUserID = $(checkedIDs[a]).data('user_id');
			if (a == 0) var checkboxUserIdMain = checkboxUserID;
			if (checkboxUserIdMain == checkboxUserID)
			{
				buttonOrdersPay.show();
			}
			else {
				buttonOrdersPay.hide();
				break;
			}
		}
    $(".op-menu").addClass("position-sticky");
  } else {
    $(".op-menu").toggleClass("position-sticky position-static");
  };
});
$(function() {
  $.fn.raty.defaults.path = '../theme/img';
  $('#rating-1').raty({
    cancel: false,
    target: '#rating-1-text',
    targetKeep: true,
    <!-- IF COMMENT_TYPE && RATING1 -->
    score: {RATING1},
    readOnly: true
    <!-- ENDIF -->
  });
  $('#rating-2').raty({
    cancel: false,
    target: '#rating-2-text',
    targetKeep: true,
    <!-- IF COMMENT_TYPE && RATING2 -->
    score: {RATING2},
    readOnly: true
    <!-- ENDIF -->
  });
  $('#rating-3').raty({
    cancel: false,
    target: '#rating-3-text',
    targetKeep: true,
    <!-- IF COMMENT_TYPE && RATING3 -->
    score: {RATING3},
    readOnly: true
    <!-- ENDIF -->
  });
  $('#rating-4').raty({
    cancel: false,
    target: '#rating-4-text',
    targetKeep: true,
    <!-- IF COMMENT_TYPE && RATING4 -->
    score: {RATING4},
    readOnly: true
    <!-- ENDIF -->
  });
});
$(".btn-cmt").click(function() {
$('html, body').animate({
    scrollTop: $("#comments").offset().top
}, 1000);
});
</script>
<!-- ENDIF -->

<script>
$('#string-main').change(function() {
  $('#string-copy').val($(this).val());
});
</script>

<!-- IF FUNC_FILE == 'items_list' -->
<script>
$('input[name=import-link]').on("change", function() {
  if( $('input[name=import-link]').val() == '') {
    $('input[name=import-file]').prop("disabled", false);
    $('input[name=import-link]').prop("disabled", false);
  } else {
    $('input[name=import-file]').prop("disabled", true);
    $('input[name=import-link]').prop("disabled", false);
  }
});
$('input[name=import-file]').on("change", function() {
  if( $('input[name=import-file]').val() == '') {
    $('input[name=import-file]').prop("disabled", false);
    $('input[name=import-link]').prop("disabled", false);
  } else {
    $('input[name=import-file]').prop("disabled", false);
    $('input[name=import-link]').prop("disabled", true);
  }
});
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'categories' -->
<script>
  function chkListCountInputs() {
    var chklist = $('.chk-list');
    for (var a=0; a<chklist.length; a++) {
      var chklistCheckboxes = $(chklist[a]).find('label input[type=checkbox]').length;
      if (chklistCheckboxes>3) $(chklist[a]).find('span').text('więcej').append(' ('+(chklistCheckboxes-3)+')')
    }
  };
  $(function () {
    chkListCountInputs();
  });
  $('.filter-list .chk-list span').click(function () {
    var thisSpan = $(this);
    var chkID = $(this).data('parid');
    $('.filter-list .chk-list.chk-list-'+chkID+' label:hidden').slice(0).show().css('display', 'block');
    if ($('.filter-list .chk-list.chk-list-'+chkID+' label').length == $('.filter-list .chk-list.chk-list-'+chkID+' label:visible').length) {
      var btnID = $('.filter-list .chk-list.chk-list-'+chkID+' span').attr('id');
      if (btnID == 'btn-hide') {
        $(this).attr('id', 'btn-show');
        $('.filter-list .chk-list.chk-list-'+chkID+' span').text('więcej');
        $('.filter-list .chk-list.chk-list-'+chkID+' label').slice(3,99).hide().css('display', 'none');
        chkListCountInputs(thisSpan);
      } else {
        $(this).attr('id', 'btn-hide');
        $('.filter-list .chk-list.chk-list-'+chkID+' span').text('ukryj');
      }
    }
  });

  $('.link-cats').click(function(){
    var id = $(this).data('id');
    var uif_id = $(this).data('uif_id');
    var cat_name = $(this).data('name');
    $('input[name=cat_name]').val(cat_name);
    $('input[name=uif_id]').val(uif_id);
    $('input[name=id]').val(id);
  });
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'basket' -->
<script>
	$("input[name^='id']").on('click', function(){
		var tr = '#details'+$(this).val();

		if ($("input[name^='id']:checked").length <=0) $('input#chkbox').attr('checked', false);
		if ($("input[name^='id']:checked").length == $("input[name^='id']").length) $('input#chkbox').attr('checked', true);

		if ($(this).prop('checked') == true) {
			$(tr).css('opacity', 1);
			$(tr+' input, '+tr+' select, '+tr+' button').attr('disabled', false);
			$(tr+' input[type=checkbox]').attr('checked', true);
		} else {
			$(tr).css('opacity', 0.5);
			$(tr+' input[type=checkbox]').attr('checked', false);
			$(tr+' input, '+tr+' select, '+tr+' button').attr('disabled', true);
		}
	});
  sumAll();
  $('input.pmt').change(function() {
    var user_id = $(this).data('user_id');
    var dataSum = $('#user'+user_id).find('.data-sum').data('sum');
    var shipping = $(this).data('cost');
    var sum = (shipping*100 + dataSum*100)/100;
    $('#user'+user_id).find('.data-sum').each(function() {
      $(this).html(sum.toFixed(2));
      $(this).data('sum-new', sum);
      $(this).data('shipping', shipping);
    });
    sumAll();
  });
  function sumAll() {
    var sumAll = 0;
    $('.data-sum').each(function(){
      var sum = $(this).data('sum-new');
      //sumAll += parseInt(sum,10);
			sumAll += sum;
    });
    $('.sum-all').html(sumAll.toFixed(2));

    var sumItem = 0;
    $('.data-sum').each(function(){
      var sum = $(this).data('sum');
      //sumItem += parseInt(sum,10);
			sumItem += sum;
    });

    $('.sum-items').html(sumItem.toFixed(2));

    var sumShipping = 0;
    $('.data-sum').each(function(){
      var sum = $(this).data('shipping');
      sumShipping += parseInt(sum,10);
    });
    if (sumShipping > 0) $('.sum-shipping').html(sumShipping.toFixed(2));
  }
</script>
<!-- ENDIF -->
<!-- IF FUNC_FILE == 'register' || USER_EDIT -->
<script src="{SITEURL}/theme/js/register.js"></script>
<script src="{SITEURL}/theme/js/bootstrap-datepicker.min.js"></script>
<script src="{SITEURL}/theme/js/locales/bootstrap-datepicker.{DEF_LANG}.min.js"></script>

<script>
function checkAvailability1() {
  $("#loaderIcon1").show();
  jQuery.ajax({
    url: "{SITEURL}/user/register?check-available=1",
    data:'username='+$("#username1").val(),
    type: "POST",
    success:function(data){
      $("#username-status1").html(data);
    },
    error:function (){}
  });
}
function checkAvailability2() {
  $("#loaderIcon2").show();
  jQuery.ajax({
    url: "{SITEURL}/user/register?check-available=1",
    data:'username='+$("#username2").val(),
    type: "POST",
    success:function(data){
      $("#username-status2").html(data);
    },
    error:function (){}
  });
}
$(function() {
  $('#lang-desc').change(function(){
    $('.lang-desc').hide();
    $('#desc_' + $(this).val()).show();
  });
});
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#avatar-preview').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$("#avatar").change(function() {
  readURL(this);
});
$('.input-daterange').datepicker({
    format: "dd/mm/yyyy",
    language: "pl",
    autoclose: true,
    todayHighlight: true
});
</script>
<!-- ENDIF -->

<!-- IF EDITOR -->
<script src="{SITEURL}/theme/js/ckeditor/ckeditor.js"></script>
<script>
  <!-- IF MULTILANG -->
  <!-- BEGIN langs -->
  CKEDITOR.replace('description_{langs.NAME_DEF}', {
    height: '350px',
    language: '{DEF_LANG}'
  });
  <!-- END langs -->
  <!-- ELSE -->
  CKEDITOR.replace('description_{DEF_LANG}', {
    height: '430px',
    language: '{DEF_LANG}'
  });
  <!-- ENDIF -->
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'add' || ITEM-EDIT || USER_EDIT || ITEM_PAYMENT || FUNC_FILE == 'categories' || FUNC_FILE == 'settings' || FUNC_FILE == 'items_list' || FUNC_FILE == 'import' -->
<script src="{SITEURL}/theme/js/items_add.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="{SITEURL}/theme/js/jquery.selectBoxIt.min.js"></script>
<script src="{SITEURL}/theme/js/jquery.livequery.js"></script>
<script src="{SITEURL}/theme/js/bootstrap-datepicker.min.js"></script>
<script src="{SITEURL}/theme/js/locales/bootstrap-datepicker.{DEF_LANG}.min.js"></script>
<script>
/*$('.preview').hide();
$('.item-box').mouseenter(function(){
	var itemBox = $(this);
	var itemBoxImg = $(itemBox).find('img');
	var itemBoxPreview =$(itemBox).find('.preview');
	$(itemBoxImg).mouseenter(function(){
		$(itemBoxPreview).show();
	});
	$(itemBoxPreview).mouseleave(function(){
		$(itemBoxPreview).hide();
	});
});*/
$('input[name=date_start]').datepicker({
    format: "DD, dd MM yyyy",
    language: "pl",
    autoclose: true,
    todayHighlight: true,
    endDate: "+1m",
    startDate: "-0d"
});
$('input[name=date_start]').on('click', function() {
  $('input[name=date_start_type]').attr('checked', true);
});
$('input[name=date_start_type]').on('click', function() {
  if ($(this).val() == 2) $('input[name=date_start]').attr('required', true);
  else $('input[name=date_start]').attr('required', false);
});
$(function() {
  <!-- IF DATE_START_HOUR == false || DATE_START_MINUTE == false -->
  var dt = new Date();
  var time_hour = dt.getHours();
  var time_minute = dt.getMinutes();
  $('input[name=date_start_hour]').val(dt.getHours());
  $('input[name=date_start_minute]').val(dt.getMinutes());
  <!-- ENDIF -->
  var currency_info = $('select[name=item_currency] option:selected').text();
  if (currency_info) $('.currency-info').text(currency_info);
  <!-- IF TIME_TYPE === 0 -->$('.time-list').hide();<!-- ENDIF -->
  $('#lang-title').change(function(){
    $('.lang-title').hide();
    $('#' + $(this).val()).show();
  });
  $('#lang-desc').change(function(){
    $('.lang-desc').hide();
    $('#desc_' + $(this).val()).show();
  });
  $('#lang-keywords').change(function(){
    $('.lang-keywords').hide();
    $('#keywords_' + $(this).val()).show();
  });
  $('select[name=unit]').change(function(){
    var unit_info = $('select[name=unit] option:selected').text();
    $('.unit-info').text(unit_info);
  });
  $('select[name=item_currency]').change(function(){
    var currency_info = $('select[name=item_currency] option:selected').text();
    $('.currency-info').text(currency_info);
  });
  $('input.chk-payment').change(function(){
    var value = $(this).val();
    if ($(this).prop('checked')) {
      $('input.chk-payment').prop('required',false);
      $('.pmt'+value).show(200);
      $('.pmt'+value+' input').prop('required',true);
    } else {
      $('input.chk-payment').prop('required',false);
      $('.pmt'+value).hide(200);
      $('.pmt'+value+' input').prop('required',false);
    }
    if ($('input.chk-payment:checked').length == 0) {
      $('input.chk-payment').prop('required', true);
    }
  });
  if ($('input.chk-payment').filter(':checked').length > 0){
    $('input.chk-payment').prop('required',false);
  } else {
    $('input.chk-payment').prop('required',true);
  }
  $('input[name=time_type]').change(function(){
    if ($(this).val() == 2) $('input[name=item_time_date]').prop('required', true);
    else $('input[name=item_time_date]').prop('required', false);
  });
  var selectBox = $("#lang-title").selectBoxIt();
  var select_currency = $('select[name=item_currency] > option');
  if(select_currency.length == 1){
    $('#item_currencys').hide();
  }
});
function updatepicture() {
  var file_location = document.getElementById('loading');
  file_location.innerHTML='<span><p>{_LANG_550}</p></span>';
}
function updateform() {
  var file_location = document.getElementById('loading');
  file_location.innerHTML='<span><p>{_LANG_551}</p></span>';
}
function checkPrice() {
  var price = document.forms["form"]["price"].value;
  if (price == null || price == '') {
    confirm('{_LANG_571}');
  }
}
function promoPrice(time) {
  var promo_types = document.getElementById('promo-list').getElementsByTagName('li');
  for (var a=0; a<promo_types.length; a++) {
    var prices = promo_types[a].getElementsByTagName('span');
    for (var b=0; b<prices.length; b++)
    {
      var day = prices[b].getAttribute('data-value');
      var name = prices[b].getAttribute('data-name');
      var price = prices[b].getAttribute('data-price');
      if (day)
      {
        if(day==time) {
          prices[b].className = 'd-inline active';
        } else {
          prices[b].className = 'd-none';
        }
      }
    }
  }
}
function updateAddPrice(name) {
  var input_price = $('#promo-list').find('input:enabled').data('price');
  var price_time = $('select[name=time]:enabled:not(:disabled)').find(':selected').data('price');
  if (price_time) var sum = Number(price_time);
  else var sum = Number(0);
  var promo_list = document.getElementById('promo-list').getElementsByTagName('li');
  for(var i=0;i<promo_list.length;i++) {
    var promo_price = $(promo_list[i]).find('input:enabled:checked');
    if (promo_price.length == 1)
    {
      var this_price = $(promo_list[i]).find('span.active').data('price');
      if (this_price == undefined) this_price = 0;
      sum=sum+Number(this_price);
    }
  }
  if (sum) document.getElementById('pay_sum').innerHTML = sum.toFixed(2);
}
$(document).ready(function(){
  updateAddPrice();
});

$(document).ready(function() {
  $('.parent').livequery('change', function() {
    $('.cats-select input[type="submit"]').css('display','none');
    $(this).nextAll('.parent').remove();
    $(this).nextAll('label').remove();
    var _this=this;
    $.post("{SITEURL}/items/add<!-- IF USER_EDIT -->?type=companies<!-- ENDIF -->", {
      parent_id: $(this).val(),
      <!-- IF USER_EDIT -->name_id: this.attributes["name"].value,<!-- ENDIF -->
    }, function(response){
      if(response!='') {
        setTimeout(function(){$('#loader').remove();$(_this).parent().append(response);},0);
      } else {
        <!-- IF USER_EDIT == '' -->
        updateform();
        document.getElementById('item-add').submit();
        <!-- ENDIF -->
      }
    });
    return false;
  });
});

<!-- IF ITEM_USER_ADD_NOT_LOGGED && IS_USER == '' -->
var cardQty = $('.card-qty');
cardQty.find('input').prop('required', false);
cardQty.find('select').prop('required', false);
cardQty.hide();
<!-- ENDIF -->

</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'settings' -->
<script>
$('input[name=pay_paypal]').click(function() {
  if ($(this).is(':checked')) {
    $("input[name=pay_paypal_email]").addClass("border border-danger").attr("disabled", false).attr("required", true);
  } else {
    $("input[name=pay_paypal_email]").toggleClass("border border-danger").attr("disabled", true).attr("required", false);
  };
});
$('input[name=pay_przelewy24]').click(function() {
  if ($(this).is(':checked')) {
    $("input[name=pay_przelewy24_id]").addClass("border border-danger").attr("disabled", false).attr("required", true);
  } else {
    $("input[name=pay_przelewy24_id]").toggleClass("border border-danger").attr("disabled", true).attr("required", false);
  };
});
$('input[name=pay_transfer]').click(function() {
  if ($(this).is(':checked')) {
    $("textarea[name=pay_transfer_text]").addClass("border border-danger").attr("disabled", false).attr("required", true);
  } else {
    $("textarea[name=pay_transfer_text]").toggleClass("border border-danger").attr("disabled", true).attr("required", false);
  };
});
$('input[name=pay_im]').click(function() {
	if ($(this).is(':checked')) {
    $("input[name=pay_im_merchant_id]").addClass("border border-danger").attr("disabled", false).attr("required", true);
		$("input[name=pay_im_service_id]").addClass("border border-danger").attr("disabled", false).attr("required", true);
		$("input[name=pay_im_service_key]").addClass("border border-danger").attr("disabled", false).attr("required", true);
  } else {
    $("input[name=pay_im_merchant_id]").toggleClass("border border-danger").attr("disabled", true).attr("required", false);
		$("input[name=pay_im_service_id]").toggleClass("border border-danger").attr("disabled", true).attr("required", false);
		$("input[name=pay_im_service_key]").toggleClass("border border-danger").attr("disabled", true).attr("required", false);
  };
});
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'add' || ITEM-EDIT || FUNC_FILE == 'categories' -->
<script>
$('.chk-dropdown .dropdown-menu').on({
  "click":function(e) {
    e.stopPropagation();
  }
});
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'member' -->
<script>
$(document).on('click', '.div-toggle', function() {
  var target = $(this).data('target');
  var show = $("input:checked", this).data('show');
  $(target).children().addClass('hide');
  $(show).removeClass('hide');
});
$(document).ready(function(){
  $('.div-toggle').trigger('change');
});
</script>
<!-- ENDIF -->

<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
</script>
<script type="text/javascript">
  $('.carousel').carousel({
    interval: 5000
  })
  setTimeout(function() {
    $('.alert-hide').fadeOut('fast');
  }, 5000);
  function showhide(id){
    if (document.getElementById) {
      var divid = document.getElementById(id);
      var divs = document.getElementsByClassName("hide");
      for(var i=0;i<divs.length;i++) {
         divs[i].style.display = "none";
      }
      divid.style.display = "block";
    }
    return false;
  }
</script>

<!-- IF FUNC_FILE == 'bid' -->
<!--
<script>
	var websocket = new WebSocket("ws://localhost:8090");
	websocket.onopen = function() {
		var messageJSON = {
			box_id: 'bid-current',
			user: 'HELLO2',
			message: 'DAWAJXX'
		};
		websocket.send(JSON.stringify(messageJSON));
	};
</script>
-->
<!-- ENDIF -->

<!-- IF ITEM_SHOW || FUNC_FILE == 'profile' -->
<script src="{SITEURL}/theme/js/lightgallery.min.js"></script>
<script src="{SITEURL}/theme/js/lg-thumbnail.js"></script>
<script src="{SITEURL}/theme/js/jquery.countdown.min.js"></script>
<script>

  <!-- IF RECAPTCHA -->
  $('#msgSendApp form').submit(function(event) {
    var $form = $(this);
    var recaptcha = $form.find('.g-recaptcha-response').val();
    if (recaptcha === "") {
      event.preventDefault();
      alert('Prosimy uzupełnić recaptche');
    }
  });
  <!-- ENDIF -->

	<!-- IF TYPE_BID && ACTIVE -->
	function showMessage(box_id, message) {
		$('#' + box_id).html(message);
	}

	/*setTimeout(function(){
		$('form#item-bid').find('input').attr('disabled', true);
		$('form#item-bid').find('button').attr('disabled', true);
		$('form#item-bid').prepend('<div class="alert alert-danger w-100 d-block">Aukcja została zakończona</div>');
	}, {TO_END_SEC});*/

	var normalForm = true;
	var websocket = new WebSocket('ws://localhost:8090');
	websocket.onopen = function(event) {
		//showMessage('bid-current', 'Connection is established!');
		normalForm = false;
	}
	websocket.onmessage = function(event) {
		var Data = JSON.parse(event.data);
		showMessage(Data.box_id, Data.text);
		normalForm = false;
	};
	websocket.onerror = function(event){
		//showMessage('bid-current', 'Problem due to some Error');
		normalForm = true;
	};
	websocket.onclose = function(event){
		//showMessage('bid-current', 'Connection Closed');
		normalForm = true;
	};
	console.log(normalForm);

	//submit offer
	//if (normalForm == false) {
		$('body').submit('form#item-bid', function(e){
			e.preventDefault();
			//remove alert box
			$('form#item-bid').find('.alert').remove();
			//form
			var form = $(this);
			//disabled submit button
			form.find('button').attr('disabled', true);
			//disabled input
			form.find('input[name=offer]').attr('disabled', true);
			//get input value
			var bid = form.find('input[name=offer]').val();
			//get item id
			var i_id = form.find('input[name=i_id]').val();

			$.ajax(
				'{SITEURL}/items/bid', {
					type: 'POST',
					data: {
						'offer': bid,
						'offer-add': 1,
						'i_id': i_id
					},
					success: function (data, status, xhr) {
						var data = JSON.parse(data);
						if (data.box_type && data.box_text) {
							$('form#item-bid').prepend('<div class="alert alert-' + data.box_type + ' w-100 d-block">' + data.box_text + '</div>');
						}
						if (data.value_minimum) $('form#item-bid').find('#bid-minimum').text(data.value_minimum);
						var websocket = new WebSocket('ws://localhost:8090');
						websocket.onopen = function() {
							var messageJSON = {
								box_id: 'bid-current',
								user: 'HELLO2',
								message: data.value
							};
							websocket.send(JSON.stringify(messageJSON));
						};
						//enabled button
						form.find('button').attr('disabled', false);
						//enabled input
						form.find('input[name=offer]').attr('disabled', false);
						//clear input value
						form.find('input[name=offer]').val('');
					},
					error: function (jqXhr, textStatus, errorMessage) {
						//$('p').append('błąd');
					}
				}
			);
		});
	//}

	<!-- ENDIF -->

	<!-- IF ITEM_BUY == 0 -->
	$('#forms-buy').find('input').attr('disabled', true);
	$('#forms-buy').find('button').attr('disabled', true);
	<!-- ENDIF -->

  $('#countdown').countdown('{DATE_COUNTDOWN}', function(event) {
    $(this).html(event.strftime('%D {_LANG_489} %H:%M:%S'));
  });
  $(document).ready(function(){
      $('#lightgallery').lightGallery({
        'download': false,
        'share': false
      });
  });
  <!-- IF MSG_SHOW -->$('#msgSend').modal('show');<!-- ENDIF -->
  <!-- IF PRIVACY_ACCEPTED == '' -->$('#privacy').modal('show');<!-- ENDIF -->
  $('#number').click(function() {
    $(this).find('span.phone-end').text( $(this).data('last') );
    $(this).find('span.btn').hide();
  });
  $('#number2').click(function() {
    $(this).find('span.phone-end').text( $(this).data('last') );
    $(this).find('span.btn').hide();
  });
</script>
<!-- ENDIF -->
<!-- IF FUNC_FILE == 'profile' -->
<script>
function updatepicture() {
  var file_location = document.getElementById('loading');
  file_location.innerHTML='<span><p>Ładowanie zdjęcia...</p></span>';
}
</script>
<!-- ENDIF -->
<!-- IF PROMO-CODE-SHOW -->
<script>
$('#promo-code').modal({show:true});
</script>
<!-- ENDIF -->

<script>
jQuery(document).ready(function() {
  var offset = 800;
  var offset2 = 130;
  var duration = 500;
  var duration2 = 0;
  jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > offset) {
      jQuery('.to-top-arrow').fadeIn(duration);
    } else {
      jQuery('.to-top-arrow').fadeOut(duration);
    }
  });
  jQuery('.to-top-arrow').click(function(event) {
    event.preventDefault();
    jQuery('html, body').animate({scrollTop: 0}, duration);
    return false;
  })
});
</script>
<script>
  function openModal() {
    document.getElementById('myModal').style.display = "block";
  }
  function closeModal() {
    document.getElementById('myModal').style.display = "none";
  }

  <!-- IF ITEM_SHOW && FUNC_NAME == 'items' && FUNC_FILE != 'payment' -->
  var slideIndex = 1;
  showSlides(slideIndex);
  function plusSlides(n) {
    showSlides(slideIndex += n);
  }
  function currentSlide(n) {
    showSlides(slideIndex = n);
  }
  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    captionText.innerHTML = dots[slideIndex-1].alt;
  }
  <!-- ENDIF -->

  $('#privacy').modal('show');

  function do_this(){
    var checkboxes = document.getElementsByName('id[]');
    var button = document.getElementById('chkbox');
    if(button.value == 'select'){
      for (var i in checkboxes){
        checkboxes[i].checked = 'FALSE';
      }
      button.value = 'deselect'
    }else{
      for (var i in checkboxes){
        checkboxes[i].checked = '';
      }
      button.value = 'select';
    }
  }

  <!-- IF FUNC_FILE == 'basket' -->
  var invoideData = $('#invoice-data');
  var g_invoice = $('input[name=g_invoice]');
  var g_invoice_type = $('input[name=g_invoice_type]');
  var g_inv_company_name = $('#g_inv_company_name');
  var g_inv_tax_number = $('#g_inv_tax_number');
  invoideData.hide();
  g_invoice.on('click', function(){
    if ($(this).prop('checked'))
    {
      invoideData.show(300);
      $('input#g_invoice_type1').prop('checked', true);
      invoideData.find('input').prop('required', true);
      if (g_invoice_type.val() == 'company') {
        g_inv_company_name.show('fast');
        g_inv_company_name.find('input[name=g_inv_company_name]').prop('required', true);
        g_inv_company_name.find('input[name=g_inv_tax_number]').prop('required', true);
      } else {
        g_inv_company_name.hidebas('fast');
        g_inv_company_name.find('input[name=g_inv_company_name]').prop('required', false);
        g_inv_company_name.find('input[name=g_inv_tax_number]').prop('required', false);
      }
    }
    else
    {
      invoideData.hide(300);
      g_invoice_type.prop('checked', true);
    }
    g_invoice_type.on('click', function (){
      if ($(this).val() == 'company') {
        g_inv_company_name.show('fast');
        g_inv_company_name.find('input[name=g_inv_company_name]').prop('required', true);
        g_inv_tax_number.show('fast');
        g_inv_tax_number.find('input[name=g_inv_tax_number]').prop('required', true);
      } else {
        g_inv_company_name.hide('fast');
        g_inv_company_name.find('input[name=g_inv_company_name]').prop('required', false);
        g_inv_tax_number.hide('fast');
        g_inv_tax_number.find('input[name=g_inv_tax_number]').prop('required', false);
      }
    });
  });
  $('button[name=copy-data]').on('click', function(){
    $('input[name=g_inv_name]').val($('input[name=g_name]').val());
    $('input[name=g_inv_sure_name]').val($('input[name=g_sure_name]').val());
    $('input[name=g_inv_company_name]').val($('input[name=g_company_name]').val());
    $('input[name=g_inv_address]').val($('input[name=g_address]').val());
    $('input[name=g_inv_post_code]').val($('input[name=g_post_code]').val());
    $('input[name=g_inv_city]').val($('input[name=g_city]').val());
  });

  <!-- IF RECAPTCHA -->
  $("form").submit(function(event) {
    var recaptcha = $form.find('.g-recaptcha-response').val();
    if (recaptcha === "") {
      event.preventDefault();
      alert('Prosimy uzupełnić recaptche');
    }
  });
  <!-- ENDIF -->
  
  <!-- ENDIF -->

	<!-- IF FUNC_NAME == 'news' && ID -->
	autosize($('textarea'));
	$('button[name=parent_id]').on('click', function(){
		var value = $(this).val();
		$('form#cmts textarea').prop('required', false);
		$('form#cmts textarea.cmts-comment-text-'+value).prop('required', true);
	});

	<!-- IF IS_USER -->
	$('.cmts-fav-add').on('click', function(){
		$(this).prop('disabled', true)
		$(this).find('i').removeClass('far').addClass('fas');
		$.ajax(
			'{SITEURL}/funcs.php?name=news&amp;id={ID}', {
				type: 'POST',
				data: {
					cmt_id: $(this).val(),
					op: 'cmt-fav-add'
				},
				success: function (data, status, xhr) {
					//$('p').append('wysłane');
				},
				error: function (jqXhr, textStatus, errorMessage) {
					//$('p').append('błąd');
				}
			}
		);
	});
	$('.cmts-vote-button').on('click', function(){
		$(this).prop('disabled', true);
		$(this).next('button').prop('disabled', true);
		$(this).prev('button').prop('disabled', true);

		var count = $(this).find('.count').text();
		var name = $(this).attr('name');

		if (name == 'cmts-vote-plus') var value = 1;
		else var value = -1;

		$(this).find('.count').html(parseInt(count)+parseInt(1));

		$.ajax(
			'{SITEURL}/funcs.php?name=news&amp;id={ID}', {
				type: 'POST',
				data: {
					cmt_id: $(this).val(),
					op: 'cmt-vote-add',
					value: value
				},
				success: function (data, status, xhr) {
					//$('p').append('wysłane');
				},
				error: function (jqXhr, textStatus, errorMessage) {
					//$('p').append('błąd');
				}
			}
		);
	});
	<!-- ENDIF -->

	<!-- ENDIF -->

	$('#search-form').hide();
	$('#search-form-button').on('click', function(){
		$('#search-form').show();
	});

</script>
