var clock;

$(document).ready(function() {
	var clock;

	clock = $('.clock').FlipClock({
      clockFace: 'DailyCounter',
      autoStart: false,
      callbacks: {
      	stop: function() {
      		$('.message').html('Hərrac vaxtı bitmişdir!')
      	}
      }
  });
  clock.setCountdown(true);
  clock.setTime(parseInt($('input[name="elapsed_date"]').val()));
  clock.start();
});
