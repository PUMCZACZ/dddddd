
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
<script src="{SITEURL}/theme/js/bootstrap.min.js"></script>
<script src="{SITEURL}/theme/js/whcookies.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.0.7/js/swiper.min.js"></script>
<!-- IF RECAPTCHA --><script src='https://www.google.com/recaptcha/api.js'></script><!-- ENDIF -->
<!-- IF MAIN-PAGEc--><script src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script><!-- ENDIF -->

<!-- IF MAIN-PAGE -->
<script type="text/javascript">
  $(document).ready(function(){
    $('.slick-carousel').slick({
          centerMode: true,
      arrows: true,
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

<!-- IF FUNC_FILE == 'register' || USER_EDIT -->
<script src="{SITEURL}/theme/js/register.js"></script>
<script>
function checkAvailability1() {
  $("#loaderIcon1").show();
  jQuery.ajax({
    url: "{SITEURL}/funcs.php?name=user&file=register&check-available=1",
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
    url: "{SITEURL}/funcs.php?name=user&file=register&check-available=1",
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
</script>
<!-- ENDIF -->

<!-- IF EDITOR -->
<script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/32.0.0/inline/translations/pl.js"></script>
<script>
  <!-- BEGIN langs -->
  ClassicEditor.create(document.querySelector("[name=description_{langs.NAME_DEF}]"), {
    language: "pl",
  });
  <!-- END langs -->
    </script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'add' || ITEM-EDIT || USER_EDIT || ITEM_PAYMENT -->
<script src="{SITEURL}/theme/js/items_add.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
<script src="https://gregfranko.com/jquery.selectBoxIt.js/js/jquery.selectBoxIt.min.js"></script>
<script type="text/javascript" src="theme/js/jquery.livequery.js"></script>
<script type="text/javascript">
$(function() {
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
  var selectBox = $("#lang-title").selectBoxIt();
});
function updatepicture() {
  var file_location = document.getElementById('loading');
  file_location.innerHTML='<span><p>{_LANG_550}</p></span>';
}
function updateform() {
  var file_location = document.getElementById('loading');
  file_location.innerHTML='<span><p>{_LANG_551}</p></span>';
}
$(document).ready(function() {
  //$('#loader').hide();
  $('.parent').livequery('change', function() {
    $('.cats-select input[type="submit"]').css('display','none');
    $(this).nextAll('.parent').remove();
    $(this).nextAll('label').remove();
    var _this=this;
    $.post("funcs.php?name=items&file=add<!-- IF USER_EDIT -->&type=companies<!-- ENDIF -->", {
      parent_id: $(this).val(),
      <!-- IF USER_EDIT -->name_id: this.attributes["name"].value,<!-- ENDIF -->
    }, function(response){
      if(response!='') {
        setTimeout(function(){$('#loader').remove();$(_this).parent().append(response);},0);
      } else {
        updateform();
        document.getElementById('item-add').submit();
      }
    });
    return false;
  });
});

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
function updateAddPrice(name)
{
  var input_price = $('#promo-list').find('input').data('price');
  var price_time = $('select[name=time]:not(:disabled)').find(':selected').data('price');

  if (price_time == undefined) price_time = 0;

  var sum = Number(price_time);
  var promo_list = document.getElementById('promo-list').getElementsByTagName('li');
  for (var i=0; i<promo_list.length; i++) {
    var promo_price = $(promo_list[i]).find('input:checked');
    if (promo_price.length == 1)
    {
      var this_price = $(promo_list[i]).find('span.active').data('price');
      if (this_price == undefined) this_price = 0;
      sum=sum+Number(this_price);
    }
  }
  document.getElementById('pay_sum').innerHTML = sum.toFixed(2);
}
</script>
<!-- ENDIF -->

<!-- IF FUNC_FILE == 'add' || ITEM-EDIT || FUNC_FILE == 'list' -->
<script>
$(".chkbox-dropdown dt a").on('click', function() {
  $(".chkbox-dropdown dd ul").slideToggle('fast');
});

$(".chkbox-dropdown dd ul li a").on('click', function() {
  $(".chkbox-dropdown dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("chkbox-dropdown")) $(".chkbox-dropdown dd ul").hide();
});

$('.mutliSelect input[type="checkbox"]').on('click', function() {
  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').data('name'),
  title = $(this).data('name') + ", ";
  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();
  } else {
    $('span[title="' + title + '"]').remove();
    var ret = $(".hida");
    $('.chkbox-dropdown dt a').append(ret);

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

<!-- IF ITEM_SHOW || FUNC_FILE == 'profile' -->
<script src="{SITEURL}/theme/js/lightgallery.js"></script>
<script src="{SITEURL}/theme/js/lg-thumbnail.js"></script>
<script>
  lightGallery(document.getElementById('lightgallery'), {
    download: false
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
<!-- IF ITEM_SHOW && FUNC_FILE != '' && FUNC_FILE != 'payment' -->
<script>
  function openModal() {
    document.getElementById('myModal').style.display = "block";
  }
  function closeModal() {
    document.getElementById('myModal').style.display = "none";
  }
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
  $('#privacy').modal('show');
</script>
<!-- ENDIF -->