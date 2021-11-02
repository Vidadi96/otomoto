$(document).ready(function() {
  $('.p_for_map').css('height', (window.innerHeight*80/100));

  var lat = ($('input[name="map_lat"]').val())?$('input[name="map_lat"]').val():40.3892737;
  var lng = ($('input[name="map_lng"]').val())?$('input[name="map_lng"]').val():49.7889018;

  $(window).on("load", function(){
    init_map(parseFloat(lat), parseFloat(lng));
  });

  function init_map(lat, lng) {
    const coordinates = { lat: lat, lng: lng}

    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 11,
      center: coordinates,
    });

    const marker = new google.maps.Marker({
      position: coordinates,
      map: map,
    });
  }
});

$('.p_showroom_location').click(function(){
  $('.p_curtain').css('display', 'flex');
});

$('.p_mobile_map').click(function(){
  $('.p_curtain').css('display', 'flex');
});

$('.p_mobile_map2').click(function(){
  $('.p_curtain').css('display', 'flex');
});

$('.p_showroom_bottom_location').click(function(){
  $('.p_curtain').css('display', 'flex');
});

$('.p_map_close').click(function(){
  $('.p_curtain').hide();
});
