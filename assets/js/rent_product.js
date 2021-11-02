
var id = $('input[name="id"]').val();
var token = $('#token').val();

$(document).ready(function() {
  var status = $('input[name="status"]').val();
  if (status == 'edit_error' || status == 'delete_error')
    toastr.error('Daxil etdiyiniz pin kod yanlışdır', "Xəta");
  else if (status == 'send_success')
    toastr.success('Şikayətiniz uğurla göndərildi', 'Uğur');
  else if (status == 'send_success2')
    toastr.success('Sifarişiniz uğurla göndərildi', 'Uğur');
  else if (status == 'date_error')
    toastr.error('Bitmə tarixi başlama tarixi ilə eyni və ya böyük olmalıdır', 'Xəta');
  else if (status == 'login_error')
    toastr.error('Sifariş etmək üçün xaiş olunur giriş edəsiniz', 'Xəta');

  var code = parseInt($('input[name="code"]').val());
  if (code === 1)
    toastr.success('Təklif uğurla edildi', "Uğur");
  else if (code === 99)
    toastr.error('Elanın sahibi iştirakçılarda məhdudiyyət qoymuşdur', 'Xəta');
  else if (code === 999)
    toastr.error('Elanın sahibi elanı artıq satılmış kimi qeyd edib', 'Xəta');
  else if (code === 9999)
    toastr.error('Xəta baş verdi. Xaiş edirik yenidən cəhd edin', 'Xəta');

  var autosalon = $('input[name="autosalon"]').val();

  $.ajax ({
    type: "POST",
    url: "/pages/rent_product_counter",
    data: {otomoto: token, id: id}
  });
});

$('.add_favorit').click(function(){
  var thiss = $(this);
  var fav = 0;

  if ($(this).hasClass('active')) {
    fav = 0;
  } else {
    fav = 1;
  }

  $.ajax ({
    type: "POST",
    url: "/pages/change_favourite",
    data: {otomoto: token, id: id, fav: fav},
    success: function(){
      if (fav == 0) {
        thiss.removeClass('active')
        thiss.html('<i class="fa fa-heart-o" aria-hidden="true"></i> Seçilmişlərə əlavə et');
      } else {
        thiss.addClass('active');
        thiss.html('<i style="color: #9f2d2d" class="fa fa-heart" aria-hidden="true"></i> Seçilmişlərdən sil');
      }

      toastr.success('Uğurla dəyişdirildi', "Uğur");
    }
  });
});

$('.p_block_like').click(function(){
  var thiss = $(this);
  var fav = 0;
  var p_id = $(this).attr('name');

  if ($(this).hasClass('active')) {
    fav = 0;
  } else {
    fav = 1;
  }

  $.ajax ({
    type: "POST",
    url: "/pages/change_favourite",
    data: {otomoto: token, id: p_id, fav: fav},
    success: function(){
      if (fav == 0) {
        thiss.removeClass('active')
        thiss.html('<img src="/Images/heart-red.svg" alt="">');
        thiss.attr('title', 'Seçilmişlərə əlavə et');
      } else {
        thiss.addClass('active');
        thiss.html('<img src="/Images/heart-red-full.svg" alt="">');
        thiss.attr('title', 'Seçilmişlərdən sil');
      }

      toastr.success('Uğurla dəyişdirildi', "Uğur");
    }
  });
});

$('.p_edit_car').click(function(){
  $('.p_pin_curtain').css('display', 'flex');
});

$('.p_edit_cancel').click(function(){
  $('.p_pin_curtain').hide();
});

$('.p_delete_car').click(function(){
  $('.p_pin_curtain2').css('display', 'flex');
});

$('.p_edit_cancel2').click(function(){
  $('.p_pin_curtain2').hide();
});

$('.p_complain_car').click(function(){
  $('.p_pin_curtain3').css('display', 'flex');
});

$('.p_edit_cancel3').click(function(){
  $('.p_pin_curtain3').hide();
});

$('#p_do_top').click(function(){
  $('.p_pin_curtain4').css('display', 'flex');
});

$('.p_edit_cancel4').click(function(){
  $('.p_pin_curtain4').hide();
});

$('.top_payment_type').click(function(){
  if ($('#top_balance').is(':checked')) {
    $('.p_top_card_types').slideUp(100);
  } else {
    $('.p_top_card_types').slideDown(100);
  }
});

$('#p_do_top_plus').click(function(){
  $('.p_pin_curtain5').css('display', 'flex');
});

$('.p_edit_cancel5').click(function(){
  $('.p_pin_curtain5').hide();
});

$('.top_plus_payment_type').click(function(){
  if ($('#top_plus_balance').is(':checked')) {
    $('.p_top_plus_card_types').slideUp(100);
  } else {
    $('.p_top_plus_card_types').slideDown(100);
  }
});

var elem = 0;

$(document).ready(function() {
  elem = $('.mobile_call_jquery').offset().top;
});

$(window).scroll(function() {
  if (window.scrollY - elem + (window.innerHeight - 275) > 0) {
    $('.mobile_call_jquery').removeClass('mobile_call_fixed');
    $('.mobile_call_jquery').addClass('mobile_call');
  } else {
    $('.mobile_call_jquery').removeClass('mobile_call');
    $('.mobile_call_jquery').addClass('mobile_call_fixed');
  }
});

$(document).on('click', '.open_call_curtain', function(event){
  event.preventDefault();
  $('.call_curtain').css('display', 'flex');
});

$(document).on('click', '.call_close_button', function(){
  $('.call_curtain').hide();
});

var last_price = 0;

$('#open_offer_form').click(function(){
  if($(this).hasClass('not_authorized')) {
    if (window.screen.width > 1150) {
      toastr.info('Təklif etmək üçün daxil olun', 'Bildiriş');
    } else {
      $('.mobile_open2 i').trigger('click');
    }
  } else {
    var thiss = $(this);
    $(this).append('<div class="lds-spinner" style="left: -2.5px; top: -4.5px; "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');

    $.ajax ({
      type: "POST",
      url: "/pages/get_last_price",
      data: {otomoto: token,
             auction_id: $('input[name="auction_id"]').val(),
             car_id: $('input[name="id"]').val(),
             discount: $('input[name="discount"]').val()
            },
      success: function(data){
        last_price = data?parseFloat(data):0;
        $('.for_auction_calc_price .change').text(((last_price*101)/100).toFixed(2));
        thiss.find('.lds-spinner').remove();
        $('.p_pin_curtain6').css('display', 'flex');
      }
    });
  }
});

$(document).on('click', 'input[name="offer_procent"]', function(){
  if ($(this).hasClass('offer_1'))
    $('.for_auction_calc_price .change').text(((last_price*101)/100).toFixed(2));
  else if ($(this).hasClass('offer_2'))
    $('.for_auction_calc_price .change').text(((last_price*102)/100).toFixed(2));
  else if ($(this).hasClass('offer_3'))
    $('.for_auction_calc_price .change').text(((last_price*103)/100).toFixed(2));
});

$('.p_edit_cancel6').click(function(){
  $('.p_pin_curtain6').hide();
});

$(document).on('click', '.auction_sell', function() {
  if(confirm('Satılmış qeyd etməyə əminsiniz?'))
  {
    var offer_id = $(this).attr('data');
    var thisss = $(this);

    $.ajax ({
      type: "POST",
      url: "/pages/auction_sell",
      data: {otomoto: token, offer_id: offer_id},
      success: function (data) {
        if (data == 1) {
          toastr.success('Satılmış kimi qeyd olundu', 'Uğur');
          thisss.closest('td').html('<span style="color: #12bf5a; font-weight: 600">Satıldı</span>');
        } else {
          toastr.error('Xəta baş verdi. Yenidən cəhd edin', 'Xəta');
        }
      }
    });
  }
});

$(document).ready(function() {
  $("#datetimepicker1").datetimepicker({
    format: 'DD-MM-YYYY HH:mm:ss'
  });
  $("#datetimepicker2").datetimepicker({
    format: 'DD-MM-YYYY HH:mm:ss'
  });
});

/*------ CLOSE ICON ------*/

$(document).ready(function() {
  $('.fotorama__stage').append('<i class="fa fa-close full_screen_close" aria-hidden="true"></i>');
});

$(document).on('click', '.full_screen_close', function(){
  $('.fotorama__fullscreen-icon').trigger('click');
});

/*------ PHONE CLICK ------*/

$(document).on('click', '.click_phone', function(){
  $.ajax({
    url: '/Pages/rent_phone_click',
    type: 'POST',
    data: { otomoto: token, id: $('input[name="id"]').val() },
    success: function(){
      console.log('success');
    }
  });
});
