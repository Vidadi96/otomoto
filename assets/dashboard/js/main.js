
$(document).ready(function(){
  // $(".img").mouseover(function(){
  //   $(this).find(".onhover").show();
  // });
  // $(".img").mouseleave(function(){
  //   $(this).find(".onhover").hide();
  // });
  // $(".user-info").mouseover(function(){
  //   $(".navbar-dropdown-list").show();
  // })
  // $(".user-info").mouseout(function(){
  //   $(".navbar-dropdown-list").hide();
  // })
});

/*----- OPEN SIDE BAR -----*/

$(document).on('click', '.open_left_side', function() {
	if ($(this).hasClass('opened')) {
		$('.left-side').hide(100);
		$(this).removeClass('opened');
		$(this).find('i').removeClass('fa-times');
		$(this).find('i').addClass('fa-bars');
	} else {
		$('.left-side').show(200);
		$(this).addClass('opened');
		$(this).find('i').addClass('fa-times');
		$(this).find('i').removeClass('fa-bars');
	}
})

/*----- DISABLE SELECTS WHEN WINDOW WIDTH LESS THAN 576 -----*/

$(document).ready(function() {
  if (window.innerWidth < 576) {
    $('.remove_mobile_disable').prop('disabled', false);
    $('.add_mobile_disable').prop('disabled', true);
  } else {
    $('.remove_mobile_disable').prop('disabled', true);
    $('.add_mobile_disable').prop('disabled', false);
  }

});
