
(function($) {

	$(function() {
		
		//Mapa
			var mapProp = {
				center:new google.maps.LatLng(-33.490475,-60.95326),
				zoom:18,
				mapTypeId:google.maps.MapTypeId.SATELLITE
			};
			var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
			var rootContext = this.rootContext;
			var companyLogo = new google.maps.MarkerImage('../images/marcador.png',
				new google.maps.Size(60,90),
				new google.maps.Point(0,0),
				new google.maps.Point(28, 77)
			);
			var companyPos = new google.maps.LatLng(-33.490475,-60.95326);
			var companyMarker = new google.maps.Marker({
				position: companyPos,
				map: map,
				icon: companyLogo,
				title:"NeweN"
			});
  
			google.maps.event.addDomListener(window, 'load', this);
			
	});
	
})(jQuery);
