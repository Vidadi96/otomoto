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
