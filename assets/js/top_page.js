/*----- PAGINATION -----*/

var from = 12;
var allow = 1;

var simple_count = 0;
$(document).ready(function() {
  simple_count = parseInt($('input[name="pagination_count"]').val());
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
            url: "/pages/top_pagination?"  + location.search.slice(location.search.indexOf('?')+1),
            data: {otomoto: token, from: from},
            success: function(data)
            {
              var res = $.parseJSON(data);
              console.log(res);
              token = res['otomoto'];
              $('#token').val(res['otomoto']);
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
