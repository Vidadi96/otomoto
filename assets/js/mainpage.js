var main_token = $('#main_token').val();

/*----- GET MODEL LIST -----*/

$(document).on('change', 'select[name="mark"]', function(){
  if ($(this).val()) {
    $('select[name="model"]').html('<option>Bütün modellər</option>');
    var thiss = $(this);

    $.ajax({
      url: '/pages/get_model_list2',
      type: 'POST',
      data: { otomoto: main_token, mark: thiss.val() },
      success: function(data){
        var res = $.parseJSON(data);
        main_token = res['otomoto'];
        $('#main_token').val(res['otomoto']);

        var html = '<option>Bütün modellər</option>';
        for(var i=0; i < res['model'].length; i++)
          html = html + '<option value="'+ res['model'][i].id +'">'+ res['model'][i].model +'</option>';
        $('select[name="model"]').html(html);
      }
    });
  } else {
    $('select[name="model"]').html('<option>Bütün modellər</option>');
  }
});

document.addEventListener('DOMContentLoaded', function() {
    const ele = document.getElementById('drag');
    ele.style.cursor = 'grab';

    let pos = { top: 0, left: 0, x: 0, y: 0 };

    const mouseDownHandler = function(e) {
        ele.style.cursor = 'grabbing';
        ele.style.userSelect = 'none';

        pos = {
            left: ele.scrollLeft,
            top: ele.scrollTop,
            // Get the current mouse position
            x: e.clientX,
            y: e.clientY
        };

        document.addEventListener('mousemove', mouseMoveHandler);
        document.addEventListener('mouseup', mouseUpHandler);
    };

    const mouseMoveHandler = function(e) {
        // How far the mouse has been moved
        const dx = e.clientX - pos.x;
        const dy = e.clientY - pos.y;

        // Scroll the element
        ele.scrollTop = pos.top - dy;
        ele.scrollLeft = pos.left - dx;
    };

    const mouseUpHandler = function() {
        ele.style.cursor = 'grab';
        ele.style.removeProperty('user-select');

        document.removeEventListener('mousemove', mouseMoveHandler);
        document.removeEventListener('mouseup', mouseUpHandler);
    };

    // Attach the handler
    ele.addEventListener('mousedown', mouseDownHandler);
});

document.addEventListener('DOMContentLoaded', function() {
    const ele2 = document.getElementById('drag');
    ele2.style.cursor = 'grab';

    let pos = { top: 0, left: 0, x: 0, y: 0 };

    const mouseDownHandler2 = function(e) {
        ele2.style.cursor = 'grabbing';
        ele2.style.userSelect = 'none';

        pos2 = {
            left: ele2.scrollLeft,
            top: ele2.scrollTop,
            // Get the current mouse position
            x: e.touches[0].pageX,
            y: e.touches[0].pageY,
        };

        document.addEventListener('touchmove', mouseMoveHandler2);
        document.addEventListener('touchend', mouseUpHandler2);
    };

    const mouseMoveHandler2 = function(e) {
        // How far the mouse has been moved
        const dx = e.touches[0].pageX - pos2.x;
        const dy = e.touches[0].pageY - pos2.y;

        // Scroll the element
        ele2.scrollTop = pos2.top - dy;
        ele2.scrollLeft = pos2.left - dx;
    };

    const mouseUpHandler2 = function() {
        ele2.style.cursor = 'grab';
        ele2.style.removeProperty('user-select');

        document.removeEventListener('touchmove', mouseMoveHandler2);
        document.removeEventListener('touchend', mouseUpHandler2);
    };

    // Attach the handler
    ele2.addEventListener('touchstart', mouseDownHandler2);
});

$('.filter_button').click(function(){
  $(".all_marks_window").animate({width: '100%'}, 200);
  window.scrollTo(0,0);
});

$('.mark_back').click(function(){
  $(".all_marks_window").animate({width: '0px'}, 100);
});


$(document).on('input', '.mark_search', function(){
  var value = $(this).val();

  $('.popular_mark_block').each(function() {
    if (value) {
      if (~$(this).find('.popular_mark_block_content span:first-child').text().toLowerCase().indexOf(value.toLowerCase()))
        $(this).show()
      else
        $(this).hide();
    } else {
      $(this).show();
    }
  });
});

$(document).on('click', '.popular_mark_block', function(){
  var mark = $(this).attr('data');
  var mark_name = $(this).attr('data_name');

  if ($(this).hasClass('popular_mark')) {
    $(this).find('.for_loader').html('<div class="lds-spinner lds-spinner-white"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
  } else {
    $(this).find('.for_loader').html('<div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
  }

  $.ajax ({
      type: "POST",
      url: "/pages/get_model_list3",
      data: {otomoto: main_token, mark: mark},
      success: function(data)
      {
        var res = $.parseJSON(data);
        main_token = res['otomoto'];
        $('#main_token').val(res['otomoto']);

        var count = 0;
        for (var i=0; i < res['model'].length; i++) {
          var countt1 = res['model'][i].count?res['model'][i].count:0;
          count = count + parseInt(countt1);
        }

        var html =  '<div class="popular_model_block" style="background: #dc3545; width: calc(100% - 10px);" model="" model_name="" mark="'+ mark +'" mark_name="'+ mark_name +'">'
                    + '<div class="popular_model_block_content">'
                      + '<span style="color: #fff">Bütün modellər</span>'
                      + '<span style="color: #fff">'+ count +'</span>'
                    + '</div>'
                  + '</div>';

        for (var i=0; i < res['model'].length; i++) {
          var countt = res['model'][i].count?res['model'][i].count:0;
          html = html + '<div class="popular_model_block" model="'+ res['model'][i].id +'" model_name="'+ res['model'][i].model +'" mark="'+ mark +'" mark_name="'+ mark_name +'">'
                        + '<div class="popular_model_block_content">'
                          + '<span>'+ res['model'][i].model +'</span>'
                          + '<span>'+ countt +'</span>'
                        + '</div>'
                      + '</div>';
        }

        $('.model_row').html(html);
        $('.for_loader').html('');

        $('.all_models_window').animate({width: '100%'}, 200);
        window.scrollTo(0,0);
      }
  });
});

$('.model_back').click(function(){
  $(".all_models_window").animate({width: '0px'}, 100);
});

$(document).on('input', '.model_search', function(){
  var value2 = $(this).val();

  $('.popular_model_block').each(function() {
    if (value2) {
      if (~$(this).find('.popular_model_block_content span:first-child').text().toLowerCase().indexOf(value2.toLowerCase()))
        $(this).show()
      else
        $(this).hide();
    } else {
      $(this).show();
    }
  });
});

$(document).on('click', '.popular_model_block', function(){
  var mark2 = $(this).attr('mark');
  var mark_name2 = $(this).attr('mark_name');
  var model2 = $(this).attr('model');
  var model_name2 = $(this).attr('model_name');

  $('.mobile_mark').val(mark2);
  $('.mobile_model').val(model2);

  $('.filter_button').text(mark_name2 + ' ' + model_name2);
  $('.null_button').css('display', 'flex');
  $('.all_marks_window').animate({width: 0}, 200);
  $('.all_models_window').animate({width: 0}, 200);
});

$(document).on('click', '.null_button', function(){
  $('.mobile_mark').val('');
  $('.mobile_model').val('');

  $('.filter_button').text('Bütün markalar');
  $(this).hide();
});

$(document).on('click', '.mark_list',function(){
  var mark = $(this).attr('data');
  var thiss = $(this);
  $(this).append('<div class="lds-spinner" style="left: 0px; top: -8px; "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');

  $.ajax ({
      type: "POST",
      url: "/pages/get_model_list3",
      data: {otomoto: main_token, mark: mark},
      success: function(data)
      {
        var res = $.parseJSON(data);
        main_token = res['otomoto'];
        $('#main_token').val(res['otomoto']);

        var count = 0;
        for (var i=0; i < res['model'].length; i++) {
          var countt1 = res['model'][i].count?res['model'][i].count:0;
          count = count + parseInt(countt1);
        }

        var html =  '<div class="popular_model_block2" style="background: #dc3545; width: calc(100% - 10px);" model="" mark="'+ mark +'">'
                    + '<div class="popular_model_block_content2">'
                      + '<span style="color: #fff">Bütün modellər</span>'
                      + '<span style="color: #fff">'+ count +'</span>'
                    + '</div>'
                  + '</div>';

        for (var i=0; i < res['model'].length; i++) {
          var countt = res['model'][i].count?res['model'][i].count:0;
          html = html + '<div class="popular_model_block2" model="'+ res['model'][i].id +'" mark="'+ mark +'">'
                        + '<div class="popular_model_block_content2">'
                          + '<span>'+ res['model'][i].model +'</span>'
                          + '<span>'+ countt +'</span>'
                        + '</div>'
                      + '</div>';
        }

        $('.model_row2').html(html);
        thiss.find('.lds-spinner').remove();

        $('.all_models_window2').animate({width: '100%'}, 200);
        window.scrollTo(0,0);
      }
  });
});

$('.model_back2').click(function(){
  $(".all_models_window2").animate({width: '0px'}, 100);
});

$(document).on('click', '.popular_model_block2', function(){
  var mark3 = $(this).attr('mark');
  var model3 = $(this).attr('model');

  $('.mobile_mark').val(mark3);
  $('.mobile_model').val(model3);
  var thiss = $(this);

  $(this).append('<div class="lds-spinner" style="right: 0px; top: 0px; "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');

  $.ajax ({
      type: "POST",
      url: "/pages/get_years_list",
      data: {otomoto: main_token, mark: mark3, model: model3},
      success: function(data)
      {
        var res = $.parseJSON(data);
        main_token = res['otomoto'];
        $('#main_token').val(res['otomoto']);

        var count = 0;
        for (var i=0; i < res['years'].length; i++) {
          var countt1 = res['years'][i].count?res['years'][i].count:0;
          count = count + parseInt(countt1);
        }

        var html =  '<div class="popular_years_block" style="background: #dc3545; width: calc(100% - 10px);">'
                    + '<div class="popular_years_block_content">'
                      + '<span style="color: #fff">Bütün illər</span>'
                      + '<span style="color: #fff">'+ count +' elan</span>'
                    + '</div>'
                  + '</div>';

        for (var i=0; i < res['years'].length; i++) {
          var countt = res['years'][i].count?res['years'][i].count:0;
          html = html + '<div class="popular_years_block" year="'+ res['years'][i].year +'">'
                        + '<div class="popular_years_block_content">'
                          + '<span>'+ res['years'][i].year +'</span>'
                          + '<span>'+ countt +' elan</span>'
                        + '</div>'
                      + '</div>';
        }

        $('.years_row').html(html);
        thiss.find('.lds-spinner').remove();

        $('.all_years_window').animate({width: '100%'}, 200);
        window.scrollTo(0,0);
      }
  });

  //$('.filter_button2').trigger('click');
});

$('.years_back').click(function(){
  $(".all_years_window").animate({width: '0px'}, 100);
});

$(document).on('input', '.model_search2', function(){
  var value3 = $(this).val();

  $('.popular_model_block2').each(function() {
    if (value3) {
      if (~$(this).find('.popular_model_block_content2 span:first-child').text().toLowerCase().indexOf(value3.toLowerCase()))
        $(this).show()
      else
        $(this).hide();
    } else {
      $(this).show();
    }
  });
});

$(document).on('input', '.years_search', function(){
  var value3 = $(this).val();

  $('.popular_years_block').each(function() {
    if (value3) {
      if (~$(this).find('.popular_years_block_content span:first-child').text().toLowerCase().indexOf(value3.toLowerCase()))
        $(this).show()
      else
        $(this).hide();
    } else {
      $(this).show();
    }
  });
});

$(document).on('click', '.popular_years_block', function(){
  var year = parseInt($(this).attr('year'));

  $('.min_year_mobile').val(year);
  $('.max_year_mobile').val(year);

  $('.filter_button2').trigger('click');
});

$(document).on('change', '.select_mobile', function(){
    let searchParams = new URLSearchParams(window.location.search);
    var url = '/pages/index?' + (location.search.slice(location.search.indexOf('?')+1));
    var regEx = /([?&]order)=([^#&]*)/g;

    if (searchParams.has('order'))
        var newurl = url.replace(regEx, '$1=' + $(this).val());
    else
        var newurl = '/pages/index?order='+ $(this).val() +'&' + (location.search.slice(location.search.indexOf('?')+1));

    window.location.replace(newurl);
});

$(document).on('change', '.ad_order', function(){
    let searchParams = new URLSearchParams(window.location.search);
    var url = '/pages/index?' + (location.search.slice(location.search.indexOf('?')+1));
    var regEx = /([?&]order)=([^#&]*)/g;

    if (searchParams.has('order'))
        var newurl = url.replace(regEx, '$1=' + $(this).val());
    else
        var newurl = '/pages/index?order='+ $(this).val() +'&' + (location.search.slice(location.search.indexOf('?')+1));

    window.location.replace(newurl);
});


/*----- PAGINATION -----*/

var from = 12;
var allow = 1;

var simple_count = 0;
$(document).ready(function() {
  simple_count = parseInt($('input[name="simple_count"]').val());
});

$(window).scroll(function(){
  if (from < simple_count)
  {
    if ($(window).scrollTop() + window.innerHeight > $(document).height()*2/3)
    {
      if (allow)
      {
        $('.for_pagination_loader').css('display', 'flex');
        allow = 0;
        $.ajax ({
            type: "POST",
            url: "/pages/main_pagination?"  + location.search.slice(location.search.indexOf('?')+1),
            data: {otomoto: main_token, from: from},
            success: function(data)
            {
              var res = $.parseJSON(data);
              main_token = res['otomoto'];
              $('#main_token').val(res['otomoto']);
              $(res['data']).insertAfter($('.insert_after').last());

              $('.for_pagination_loader').hide();
              from = from + 12;
              allow = 1;
            }
        });
      }
    }
  }
});

$(document).on('click', '.p_block_like', function(){
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
    data: {otomoto: main_token, id: p_id, fav: fav},
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

/*----- RECOVERY PASSWORD -----*/

$(document).ready(function() {
  let rec_pass = $('input[name="rec_pass"]').val();

  if (rec_pass) {
    if (rec_pass == 1)
      toastr.success('Şifrəni yeniləmə linki poçt ünvanınıza göndərilmişdir', "Uğur");
    else if (rec_pass == 2)
      toastr.error('Daxil etdiyiniz e-poçt ünvanı mövcud deyil', "Xəta");
    else if (rec_pass == 3)
      toastr.success('Şifrəniz uğurla dəyişdirildi', "Uğur");
  }
});
