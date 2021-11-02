$(document).ready(function(){

    $(window).on("load", function(){
    	init_map();
    });
		map_init_count = 1;

		/*** Google map ***/
		var marker = [];
		function init_map()
		{
			var mapOptions =
			{
				zoom: 11,
				/*scrollwheel: false,*/
				center: new google.maps.LatLng(40.3892737, 49.7889018),
				mapTypeControl: false,
				mapTypeId: google.maps.MapTypeId.roadmap,
				panControl: true,
				panControlOptions: {
					position: google.maps.ControlPosition.RIGHT
				},
				zoomControl: true,
				//scaleControl: true,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.LARGE,
					position: google.maps.ControlPosition.RIGHT
				},
			}
			map = new google.maps.Map($("#map").get(0), mapOptions);

			/*** Google autocomplete ***/
			var input = (document.getElementById('google_search_input'));
			var autocomplete = new google.maps.places.Autocomplete(input);
			autocomplete.bindTo('bounds', map);
			var marker = new google.maps.Marker({
				map: map,
				anchorPoint: new google.maps.Point(0, -29)
			});
			google.maps.event.addListener(autocomplete, 'place_changed', function() {
				var place = autocomplete.getPlace();
				if (!place.geometry) {
				return;
				}
				if (place.geometry.viewport) {
				map.fitBounds(place.geometry.viewport);
				} else {
				map.setCenter(place.geometry.location);
				map.setZoom(17);  // Why 17? Because it looks good ))))
				}
			});
      var item = $.parseJSON($('input[name="map_data"]').val());

      var marker_icon = "/img/shop_marker.png";
      var pillar_lat_lng = new google.maps.LatLng(item.lat, item.lng);
      marker[item.map_id] = new google.maps.Marker({
        position: pillar_lat_lng,
        map: map,
        draggable:true,
        animation: google.maps.Animation.DROP,
        title:"",
        cursor: "pointer",
        icon: marker_icon,
        optimized: true
      });
      marker[item.map_id].setValues({map_id: item.map_id});
      google.maps.event.addListener(marker[item.map_id], 'click', function() {
        var map_id = this.map_id;
        update_edit(map_id);
      })
      google.maps.event.addListener(marker[item.map_id], 'dragend', function() {
        var map_id = this.map_id;
        update_edit(map_id);
      });

      function update_edit(map_id)
      {
        $.get("/dashboard/maps/?map_id="+map_id, function(data){
          $(".map_edit_container").html(data);
          $(".map_edit_container input[name=map_id]").val(map_id);
          $(".map_edit_container input[name=lat]").val(marker[map_id].position.lat());
          $(".map_edit_container input[name=lng]").val(marker[map_id].position.lng());
        });
      }

			$(".change_marker_position").click(function(){
				set_anmimate_marker();
			});
      $(document).on("click",".save_marker",function(){
        var vars = $(this).closest("form").serialize();
        $.post("/dashboard/maps/?action=save_marker",{data: vars, otomoto: $("#token").val()},function(data){
          if(data)
            toastr.success("Marker uğurla yeniləndi", "Uğurlu");
					else
            toastr.error("Xəta baş verdi, təkrar cəhd edin.", "Xəta");
        });
      });

			$(".save_map").click(function(){
				$(".loader").fadeIn(100);
				$.post("/cadmin/save_map/", {lat:marker.getPosition().lat(), lng:marker.getPosition().lng(), zoom: map.getZoom(),  tim:$("input[name=tim]").val()}, function(data){
					obj = $.parseJSON(data);
					if(obj.status=="success")
						toastr.success(obj.msg, obj.header);
					else
						toastr.error(obj.msg, obj.header);
					$(".loader").fadeOut(100);
				});
			});

      $("input[name=lat]").val(map.getCenter().lat);
      $("input[name=lng]").val(map.getCenter().lng);
		}
	});
