var geocoder;
var map;
var marker;

function initialize() {
	var latlng = new google.maps.LatLng( -25.0945, -50.1633);
	var options = {
		zoom: 5,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("mapa"), options);	
	geocoder = new google.maps.Geocoder();
	marker = new google.maps.Marker({
		map: map,
		draggable: true
	});
	
	marker.setPosition(latlng);
}

var $a = jQuery.noConflict();


//script da biblioteca jQuery

$a(document).ready(function(){

	var latlng = new google.maps.LatLng( -25.0945, -50.1633);
	var options = {
		zoom: 5,
		center: latlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	map = new google.maps.Map(document.getElementById("mapa"), options);	
	geocoder = new google.maps.Geocoder();
	marker = new google.maps.Marker({
		map: map,
		draggable: true
	});
	
	marker.setPosition(latlng);
	
	function carregarNoMapa(endereco) {
		geocoder.geocode({ 'address': endereco + ', Brasil', 'region': 'BR' }, function (results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				if (results[0]) {
					var latitude = results[0].geometry.location.lat();
					var longitude = results[0].geometry.location.lng();
		
					$a('#endereco').val(results[0].formatted_address);
					$a('#txtLatitude').val(latitude);
                                        $a('#txtLongitude').val(longitude);
		
					var location = new google.maps.LatLng(latitude, longitude);
					marker.setPosition(location);
					map.setCenter(location);
					map.setZoom(16);
				}
			}
		});
	}
        
        function mudaMapa(endereco){
            document.getElementById("endereco").value = endereco;
            carregarNoMapa($a("#endereco").val());
        }
        
	$a("body").mouseover(function() {
			carregarNoMapa($a("#endereco").val());
	});        
	$a("#conteudo").mouseover(function() {
			carregarNoMapa($a("#endereco").val());
	});
	$a("#localizacao").click(function(){
                        mudaMapa($a("#endereco").val());
        });
	google.maps.event.addListener(marker, 'drag', function () {
		geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				if (results[0]) {  
					$a('#endereco').val(results[0].formatted_address);
					$a('#txtLatitude').val(marker.getPosition().lat());
					$a('#txtLongitude').val(marker.getPosition().lng());
				}
			}
		});
	});
	
	$a('#endereco').autocomplete({
		source: function (request, response) {
			geocoder.geocode({ 'address': request.term + ', Brasil', 'region': 'BR' }, function (results, status) {
				response($.map(results, function (item) {
					return {
						label: item.formatted_address,
						value: item.formatted_address,
						latitude: item.geometry.location.lat(),
          				longitude: item.geometry.location.lng()
					};
				}));
			});
		},
		select: function (event, ui) {
			$a("#txtLatitude").val(ui.item.latitude);
                        $a("#txtLongitude").val(ui.item.longitude);
			var location = new google.maps.LatLng(ui.item.latitude, ui.item.longitude);
			marker.setPosition(location);
			map.setCenter(location);
			map.setZoom(16);
		}
	});
        
});

        function mudaMapa(endereco){
            document.getElementById("endereco").value = endereco;
        }	