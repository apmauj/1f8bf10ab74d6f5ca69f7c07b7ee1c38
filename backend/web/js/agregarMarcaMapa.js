/**
 * Created by El Perro on 22/11/2015.
 */

var bounds = new google.maps.LatLngBounds();
var markersArray = [];

var origen = "Montevideo, Uruguay"; //-34.895247, -56.172498



var map;
var geocoder;
var originIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000';

var ubicacion = new google.maps.LatLng(-34.905647, -56.186787);

function initMap() {
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 12,
        center: ubicacion
    });
    if($("#latitud").val()!="" && $("#longitud").val()!="" && $("#direccion").val()!=""){
        var ubicacionMarker = new google.maps.LatLng($("#latitud").val(), $("#longitud").val());
        addMarkerLatLong(ubicacionMarker,false,map,$("#direccion").val());
    }


}
google.maps.event.addDomListener(window, 'load', initMap);

/*
    if($("#latitud").val()!="" && $("#longitud").val()!=""){
        var ubicacionMarker = new google.maps.LatLng($("#latitud").val(), $("#longitud").val());
        addMarker(ubicacionMarker,false,map);
    }
*/

function calculateDistances(origenes, comercios) {
    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
        origins: origenes, //Dado que es una matriz se pueden especificar varios origenes y destinos
        destinations: comercios,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,

        //avoidHighways: false,
        //avoidTolls: false
    }, callbackMostrarDistancias);
}

//Muestra el resultado de la solicitud
function callbackMostrarDistancias(inicio, response, status) {

    if (status != google.maps.DistanceMatrixStatus.OK) {
        alert('Error was: ' + status);
    }
    else{
        var origins = response.originAddresses;
        var destinations = response.destinationAddresses;
        var outputDiv = document.getElementById('outputDiv');
        outputDiv.innerHTML = '';
        deleteOverlays();

        for (var i = 0; i < origins.length; i++) {
            var results = response.rows[i].elements;
            addMarker(origins[i], false);
            //Muestra el resultado con el detalle de las distancias a cada punto, en kilometros y en metros
            for (var j = 0; j < results.length; j++) {
                addMarker(destinations[j], true);
                outputDiv.innerHTML += '<i>' + origins[i] + '</i> a <i>' + destinations[j] + '</i>'
                    + ': <b>' + results[j].distance.text
                    + ' ( ' + results[j].distance.value + ' mts )</b> en '
                    + results[j].duration.text + '<br>';
            }
        }
    }
}

//Agrega una marca al mapa

function addMarker(location, isDestination,map) {
    var icon;
    if (isDestination) {
        icon = destinationIcon;
    } else {
        icon = originIcon;
    }
    geocoder.geocode({'address': location}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            bounds.extend(results[0].geometry.location);
            map.fitBounds(bounds);
            map.zoom = 12;
            map.center= results[0].geometry.location;
            var infowindow = new google.maps.InfoWindow({
                content: location
            });

            var marker = new google.maps.Marker({
                map: map,
                draggable:true,
                animation: google.maps.Animation.DROP,
                position: results[0].geometry.location,
                icon: icon,
                title: location
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });
            google.maps.event.addListener(marker, 'dragend', function (event) {
                document.getElementById("latitud").value = this.getPosition().lat();
                document.getElementById("longitud").value = this.getPosition().lng();
            });

            markersArray.push(marker);
            $("#latitud").val(marker.getPosition().lat());
            $("#longitud").val(marker.getPosition().lng());
            return marker;
        } else {
            alert('Geocode was not successful for the following reason: '+ status);
        }
    });
}

//limpia las marcas del mapa
function deleteOverlays() {
    for (var i = 0; i < markersArray.length; i++) {
        markersArray[i].setMap(null);
    }
    $("#latitud").val("");
    $("#longitud").val("");

    markersArray = [];
}

function addMarkerLatLong(location, isDestination,map,direccion) {
    var icon;
    if (isDestination) {
        icon = destinationIcon;
    } else {
        icon = originIcon;
    }
    bounds.extend(location);
    map.fitBounds(bounds);
    map.zoom = 12;
    map.center= location;
    var infowindow = new google.maps.InfoWindow({
        content: direccion
    });

    var marker = new google.maps.Marker({
        map: map,
        draggable:true,
        animation: google.maps.Animation.DROP,
        position: location,
        icon: icon,
        title: direccion
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
    });
    google.maps.event.addListener(marker, 'dragend', function (event) {
        document.getElementById("latitud").value = this.getPosition().lat();
        document.getElementById("longitud").value = this.getPosition().lng();
    });

    markersArray.push(marker);
    $("#latitud").val(marker.getPosition().lat());
    $("#longitud").val(marker.getPosition().lng());
    return marker;
}

