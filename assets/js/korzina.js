/*----- PLUS MINUS KOLICHESTVO -----*/

$('.plus').click(function(){
  $(this).prev().text(parseFloat($(this).prev().text()) + 1)
  $(this).closest('div').find('input[name="count[]"]').val(parseFloat($(this).prev().text()))
  var tsena = parseFloat($(this).closest('tr').find('.tsena span').text());
  var yekun = parseFloat($('.yekunQiymet span').text());
  var result = (yekun + tsena);
  $('.yekunQiymet span').text(result.toFixed(2));
  var tsena2 = parseFloat($(this).closest('.row_div').find('.tsena2 span').text());
  var yekun2 = parseFloat($('.yekunQiymet2 span').text());
  var result2 = (yekun2 + tsena2);
  $('.yekunQiymet2 span').text(result2.toFixed(2));
})

$('.minus').click(function(){
  if(parseInt($(this).next().text()) > 1)
  {
    $(this).next().text(parseFloat($(this).next().text()) - 1);
    $(this).closest('div').find('input[name="count[]"]').val(parseFloat($(this).next().text()))
    var tsena = parseFloat($(this).closest('.row_div').find('.tsena span').text());
    var yekun = parseFloat($('.yekunQiymet span').text());
    var result = (yekun - tsena);
    $('.yekunQiymet span').text(result.toFixed(2));
    var tsena2 = parseFloat($(this).closest('.row_div').find('.tsena2 span').text());
    var yekun2 = parseFloat($('.yekunQiymet2 span').text());
    var result2 = (yekun2 - tsena2);
    $('.yekunQiymet2 span').text(result2.toFixed(2));
  }
})

/*----- SECHILMISHLERI SILMEK -----*/

$('#pageHead span:last-child').on("click", function(){
  if($(".checkbox").is(':checked'))
  {
    $('.checkbox').prop("checked", false);
  }
  else
  {
    $('.checkbox').prop("checked", true);
  }
})

/*----- TOASTR -----*/

var lang = $('#language_js').text();

var select_product = [];
select_product['az'] = 'Məhsul seçin';
select_product['ru'] = 'Выберите продукт';
select_product['en'] = 'Select a product';
select_product['tr'] = 'Ürün seçiniz';

var product_is_absent = [];
product_is_absent['az'] = 'Məhsul yoxdur';
product_is_absent['ru'] = 'Продукта нет';
product_is_absent['en'] = 'Product is absent';
product_is_absent['tr'] = 'Ürün yok';

if(searchParams.has('msg'))
{
  let msg = searchParams.get('msg');

  if(msg==0)
    toastr["error"](select_product[lang], product_is_absent[lang]);
}

/*------ DISABLE INPUT ------*/

if ($(window).width() < 1150) {
  $(".cdisable").prop('disabled', false);
  $(".mdisable").prop('disabled', true);
} else {
  $(".cdisable").prop('disabled', true);
  $(".mdisable").prop('disabled', false);
}

/*------ ADD COMMENT ------*/

$('.add_comment').click(function(){
  $('.zanaveska3').show();
  var value = $(this).closest('div').find('input[name="comment[]"]').val();
  $('#login_form2 textarea').val(value);
  $(this).closest('div').find('input[name="comment[]"]').addClass('past_here');
});

$('.add_total_comment').click(function(){
  $('.zanaveska3').show();
  var value = $('input[name="total_comment"]').val();
  $('#login_form2 textarea').val(value);
  $('input[name="total_comment"]').addClass('past_here');
});

$('.yadda_saxla').click(function(){
  var value = $(this).closest('#login_form2').find('textarea').val();
  $('.past_here').val(value);
  $('input[name="comment[]"]').removeClass('past_here');
  $('input[name="total_comment"]').removeClass('past_here');
  $('.zanaveska3').hide();
});

$('#close3').click(function(){
  $('.zanaveska3').hide();
  $('input[name="comment[]"]').removeClass('past_here');
  $('input[name="total_comment"]').removeClass('past_here');
});

$('.imtina').click(function(){
  $('.zanaveska3').hide();
  $('input[name="comment[]"]').removeClass('past_here');
  $('input[name="total_comment"]').removeClass('past_here');
});
