var map;
var icy_location = new google.maps.LatLng(parseFloat(icyMap.coordX),parseFloat(icyMap.coordY));
var icy_zoom = parseInt(icyMap.zoom);

function initialize() {

  var styles = [
    

  ];

  var mapOptions = {
    zoom:icy_zoom,
    center: icy_location,
    sensor: false,
    mapTypeControlOptions: {
       mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'bestfromgoogle']
    }
  };
  map = new google.maps.Map(document.getElementById("map_canvas"),
      mapOptions);

  var styledMapOptions = {
      name: icyMap.heading
  }

  var jayzMapType = new google.maps.StyledMapType(
      styles, styledMapOptions);

  map.mapTypes.set('bestfromgoogle', jayzMapType);
  map.setMapTypeId('bestfromgoogle');
  
  	var contentString = '<div class="icy-map-description">'+
					'<h3 id="firstHeading" class="firstHeading">'+icyMap.heading+'</h3>'+
					'<div id="bodyContent">'+
					'<p>'+icyMap.address+'</p>'+
					'</div>'+
					'</div>';
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
				
				var companyImage = new google.maps.MarkerImage(icyMap.pinImg,
					new google.maps.Size(51,70)					
				);				

				var companyPos = new google.maps.LatLng(parseFloat(icyMap.pincoordX),parseFloat(icyMap.pincoordY));

				var companyMarker = new google.maps.Marker({
					position: companyPos,
					map: map,
					icon: companyImage,					
					title:icyMap.heading,
					zIndex: 3});
				
				google.maps.event.addListener(companyMarker, 'click', function() {
					infowindow.open(map,companyMarker);
				});
				
}