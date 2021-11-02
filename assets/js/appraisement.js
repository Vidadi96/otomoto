$(document).on('input', '.mark_search', function(){
  var value = $(this).val();

  $('.appraisement_mark_block').each(function() {
    if (value) {
      if (~$(this).find('span').text().toLowerCase().indexOf(value.toLowerCase()))
        $(this).show()
      else
        $(this).hide();
    } else {
      $(this).show();
    }
  });
});

var token = $('#token').val();
var mark = '';

$(document).on('click', '.appraisement_mark_block', function(){
  $(this).append('<div class="lds-spinner" style="left: -2px; top: -6px; "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
  mark = $(this).attr('data');
  var mark_text = $(this).find('span').text();
  var thiss = $(this);

  $.ajax ({
      type: "POST",
      url: "/pages/get_appraisement_model_list",
      data: {otomoto: token, mark: mark},
      success: function(data){
        var res = $.parseJSON(data);
        var html = '';
        for (var i=0; i < res.length; i++) {
          html = html + '<div class="appraisement_model_block">' + res[i].model + '</div>';
        }
        thiss.find('.lds-spinner').remove();
        $('.mark_select_block').addClass('selected');
        $('.model_selected_block').hide();
        $('.year_selected_block').hide();
        $('.calculate_button').hide();
        $('.appraisement_result').hide();
        $('.mark_select_block').hide();
        $('.mark_selected_block .selected_content').text(mark_text);
        $('.mark_selected_block').show();
        $('.model_select_block').slideDown(200);
        $('.for_model_block').html(html);
      }
  });
});

$(document).on('input', '.model_search', function(){
  var value = $(this).val();

  $('.appraisement_model_block').each(function() {
    if (value) {
      if (~$(this).text().toLowerCase().indexOf(value.toLowerCase()))
        $(this).show()
      else
        $(this).hide();
    } else {
      $(this).show();
    }
  });
});

var model = '';

$(document).on('click', '.appraisement_model_block', function(){
  $(this).append('<div class="lds-spinner" style="right: 0px; top: -3px; "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
  model = $(this).text();
  var thiss = $(this);

  $.ajax ({
      type: "POST",
      url: "/pages/get_appraisement_year_list",
      data: {otomoto: token, model: model, mark: mark},
      success: function(data){
        var res = $.parseJSON(data);
        var html = '';
        for (var i=0; i < res.length; i++) {
          html = html + '<div class="appraisement_year_block">' + res[i].year + '</div>';
        }
        thiss.find('.lds-spinner').remove();
        $('.model_select_block').addClass('selected');
        $('.year_selected_block').hide();
        $('.calculate_button').hide();
        $('.appraisement_result').hide();
        $('.model_select_block').hide();
        $('.model_selected_block .selected_content').text(model);
        $('.model_selected_block').show();
        $('.year_select_block').slideDown(200);
        $('.for_year_block').html(html);
      }
  });
});

$(document).on('input', '.year_search', function(){
  var value = $(this).val();

  $('.appraisement_year_block').each(function() {
    if (value) {
      if (~$(this).text().toLowerCase().indexOf(value.toLowerCase()))
        $(this).show()
      else
        $(this).hide();
    } else {
      $(this).show();
    }
  });
});

var year = 0;

$(document).on('click', '.appraisement_year_block', function(){
  year = $(this).text();

  $('.year_select_block').addClass('selected');
  $('.appraisement_result').hide();
  $('.year_select_block').hide();
  $('.year_selected_block .selected_content').text(year);
  $('.year_selected_block').show();
  $('.calculate_button').slideDown(200);
});

$(document).on('click', '.calculate_button', function(){
  $(this).append('<div class="lds-spinner" style="right: -40px; top: -1px; "><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>');
  var thiss = $(this);

  $.ajax ({
      type: "POST",
      url: "/pages/get_appraisement_result",
      data: {otomoto: token, model: model, mark: mark, year: year},
      success: function(data){
        thiss.find('.lds-spinner').remove();
        $('.calculate_button').hide();
        $('.appraisement_result .result_content').text(data + ' azn');
        $('.appraisement_result').show();
      }
  });
});

$(document).on('click', '.mark_selected_block', function(){
  $(this).hide();
  $('.mark_select_block').slideDown(200);
});

$(document).on('click', '.mark_select_block .select_title', function(){
  if ($('.mark_select_block').hasClass('selected')) {
    $('.mark_select_block').hide();
    $('.mark_selected_block').show();
  }
});

$(document).on('click', '.model_selected_block', function(){
  $(this).hide();
  $('.model_select_block').slideDown(200);
});

$(document).on('click', '.model_select_block .select_title', function(){
  if ($('.model_select_block').hasClass('selected')) {
    $('.model_select_block').hide();
    $('.model_selected_block').show();
  }
});

$(document).on('click', '.year_selected_block', function(){
  $(this).hide();
  $('.year_select_block').slideDown(200);
});

$(document).on('click', '.year_select_block .select_title', function(){
  if ($('.year_select_block').hasClass('selected')) {
    $('.year_select_block').hide();
    $('.year_selected_block').show();
  }
});
