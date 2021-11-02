
var token = $('#token').val();

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

var id = $('input[name="id"]').val();

$(document).ready(function() {
  $.ajax ({
    type: "POST",
    url: "/car_showroom/showroom_counter",
    data: {otomoto: token, id: id}
  });
});


var elem = 0;

$(document).ready(function() {
  elem = $('.mobile_call_jquery').offset().top;
});

$(window).scroll(function() {
  if (window.scrollY - elem + (window.innerHeight - 125) > 0) {
    $('.mobile_call_jquery').removeClass('mobile_call_fixed');
    $('.mobile_call_jquery').addClass('mobile_call');
    $('.button_zamena').hide();
  } else {
    $('.mobile_call_jquery').removeClass('mobile_call');
    $('.mobile_call_jquery').addClass('mobile_call_fixed');
    $('.button_zamena').show();
  }
});

$(document).on('click', '.mobile_call_jquery', function(){
  $('.call_curtain').css('display', 'flex');
});

$(document).on('click', '.call_close_button', function(){
  $('.call_curtain').hide();
});
