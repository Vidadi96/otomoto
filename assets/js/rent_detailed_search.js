$(document).ready(function() {
  if (window.innerWidth < 500) {
    $('#body_picker').prop('disabled', true);
    $('#color_picker').prop('disabled', true);
    $('#city_picker').prop('disabled', true);
    $('#fuel_picker').prop('disabled', true);
    $('#drive_picker').prop('disabled', true);
    $('#transmission_picker').prop('disabled', true);
  } else {
    $('.select_style').prop('disabled', true);
    $('#mark_picker').selectpicker();
    $('#model_picker').selectpicker();
    $('#body_picker').selectpicker();
    $('#color_picker').selectpicker();
    $('#city_picker').selectpicker();
    $('#fuel_picker').selectpicker();
    $('#drive_picker').selectpicker();
    $('#transmission_picker').selectpicker();
  }

});

    var token = $('#token').val();

    $(document).on('changed.bs.select', '#mark_picker', function(){
      var array = $(this).val()?$(this).val():[];
      $.ajax({
				url: '/pages/get_model_list',
				type: 'POST',
				data: { otomoto: token,	mark: JSON.stringify(array) },
				success: function(data){
            $('#model_picker option').remove();
            var res = $.parseJSON(data);
            for (var i=0; i<res.length; i++)
              $('#model_picker').append('<option value="' + res[i].id + '">' + res[i].model + '</option>');
            $('#model_picker').selectpicker('refresh');
        }
      });
    });



    $('.filter_button').click(function(){
      $(".all_classes_window").animate({width: '100%'}, 200);
      window.scrollTo(0,0);
    });

    $('.class_back').click(function(){
      $(".all_classes_window").animate({width: '0px'}, 100);
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

    $(document).on('click', '.class_block2', function(){
      var classs = $(this).attr('data');

      $(this).find('.for_loader').html('<div class="lds-spinner lds-spinner-white"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');

      $.ajax ({
          type: "POST",
          url: "/pages/get_rent_mark_list",
          data: {otomoto: token, class: classs},
          success: function(data)
          {
            var res = $.parseJSON(data);
            main_token = res['otomoto'];
            $('#main_token').val(res['otomoto']);

            var count = 0;
            for (var i=0; i < res['mark'].length; i++) {
              var countt1 = res['mark'][i].count?res['mark'][i].count:0;
              count = count + parseInt(countt1);
            }

            var html = '';

            for (var i=0; i < res['mark'].length; i++) {
              var countt = res['mark'][i].count?res['mark'][i].count:0;
              html = html + '<div class="popular_mark_block" data="'+ res['mark'][i].id +'" data_name="'+ res['mark'][i].mark +'">'
                            + '<div class="popular_mark_block_content">'
                              + '<span>'+ res['mark'][i].mark +'</span>'
                              + '<span>'+ countt +'</span>'
                            + '</div>'
                          + '</div>';
            }

            $('.mark_row').html(html);
            $('.for_loader').html('');

            $('.all_marks_window').animate({width: '100%'}, 200);
            window.scrollTo(0,0);
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
          url: "/pages/get_rent_model_list3",
          data: {otomoto: token, mark: mark},
          success: function(data)
          {
            var res = $.parseJSON(data);
            token = res['otomoto'];
            $('#token').val(res['otomoto']);

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
      $('.all_classes_window').animate({width: 0}, 200);
      $('.all_marks_window').animate({width: 0}, 200);
      $('.all_models_window').animate({width: 0}, 200);
    });

    $(document).on('click', '.null_button', function(){
      $('.mobile_mark').val('');
      $('.mobile_model').val('');

      $('.filter_button').text('Hamısı');
      $(this).hide();
    });

    $(document).on('click', '.open_subs', function(){
      if ($(this).hasClass('opened')) {
        $(this).removeClass('fa-minus').addClass('fa-plus').removeClass('opened');
        $('.subs').slideUp(300);
      } else {
        $(this).removeClass('fa-plus').addClass('fa-minus').addClass('opened');
        $('.subs').slideDown(300);
      }
    });

    $(window).load(function() {
      $('.all_models_window').height($('.all_marks_window').outerHeight(true));
    });
