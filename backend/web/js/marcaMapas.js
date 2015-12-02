/**
 * Created by Cacho on 2/12/2015.
 */

/**
 * Created by El Perro on 22/11/2015.
 */

var bounds = new google.maps.LatLngBounds();
var markersArray = [];

var origen = "Montevideo, Uruguay"; //-34.895247, -56.172498



var map;
var geocoder;
var originIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000';
var userIcon = 'http://maps.google.com/mapfiles/marker_purple.png';

var ubicacion = new google.maps.LatLng(-34.905647, -56.186787);

function initMap() {
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 12,
        center: ubicacion
    });

    if($('#jsonMarcas').val()!= null){
        var jsonRequest = JSON.parse($('#jsonMarcas').val());
        jsonRequest.forEach(function(marker){
            //alert('1:'+marker.latitud+' 2:'+marker.longitud+' 3:'+marker.direccion +' 4:'+marker.idComercio +' 5:'+marker.nombre);
            addMarkerLatLong(marker.latitud,marker.longitud,map,marker.direccion,marker.idComercio,marker.nombre);
        });
        var jsonUsuario = JSON.parse($('#coordenadasUsuario').val());
        addMarkerUsuario(jsonUsuario.latitud,jsonUsuario.longitud,map,jsonUsuario.username);
    }
    //    var ubicacionMarker = new google.maps.LatLng($("#latitud").val(), $("#longitud").val());
    //    addMarkerLatLong(ubicacionMarker,false,map,$("#direccion").val());


}
google.maps.event.addDomListener(window, 'load', initMap);

/*
 if($("#latitud").val()!="" && $("#longitud").val()!=""){
 var ubicacionMarker = new google.maps.LatLng($("#latitud").val(), $("#longitud").val());
 addMarker(ubicacionMarker,false,map);
 }
 */

//limpia las marcas del mapa
function deleteOverlays() {
    for (var i = 0; i < markersArray.length; i++) {
        markersArray[i].setMap(null);
    }
    $("#latitud").val("");
    $("#longitud").val("");

    markersArray = [];
}

function addMarkerLatLong(latitud,longitud,map,direccion,idComercio,nombreComercio) {
    var location = new google.maps.LatLng(latitud, longitud);
    bounds.extend(location);
    map.fitBounds(bounds);
    map.zoom = 12;
    map.center= location;
    var texto = nombreComercio +" <br/>" +direccion;
    var infowindow = new google.maps.InfoWindow({
        content: texto
    });

    var marker = new google.maps.Marker({
        map: map,
        draggable:false,
        animation: google.maps.Animation.DROP,
        position: location,
        title: direccion
    });

    google.maps.event.addListener(marker, 'click', function() {
        if($("#comerciosElegidos").val()==null || $("#comerciosElegidos").val()=='' ){
            $("#comerciosElegidos").val(nombreComercio);
            $("#ordenComercios").val(idComercio);
        }else if($("#comerciosElegidos").val().indexOf(nombreComercio)==-1){
            $("#comerciosElegidos").val($("#comerciosElegidos").val()+'\n'+nombreComercio);
            $("#ordenComercios").val($("#ordenComercios").val()+','+idComercio);
        }

    });
    google.maps.event.addListener(marker, 'mouseover', function() {
        infowindow.open(map,marker);
    });
    google.maps.event.addListener(marker, 'mouseout', function() {
        infowindow.close(map,marker);
    });


    markersArray.push(marker);

    return marker;
}
function addMarkerUsuario(latitud,longitud,map,username) {
    var location = new google.maps.LatLng(latitud, longitud);
    bounds.extend(location);
    map.fitBounds(bounds);
    map.zoom = 12;
    map.center= location;
    var texto = username;
    var infowindow = new google.maps.InfoWindow({
        content: texto
    });

    var marker = new google.maps.Marker({
        map: map,
        draggable:false,
        animation: google.maps.Animation.DROP,
        position: location,
        icon: userIcon,
        title: username
    });

    google.maps.event.addListener(marker, 'mouseover', function() {
        infowindow.open(map,marker);
    });
    google.maps.event.addListener(marker, 'mouseout', function() {
        infowindow.close(map,marker);
    });


    //markersArray.push(marker);
    //
    //return marker;
}


