/**
 * Created by El Perro on 22/11/2015.
 */

var map;
var geocoder;
var bounds = new google.maps.LatLngBounds();
var markersArray = [];

var origen = "Montevideo, Uruguay"; //-34.895247, -56.172498

var canelones = new google.maps.LatLng(-34.524391, -56.269235 );
var san_jose  = new google.maps.LatLng(-34.333339, -56.733043);
var las_piedras = new google.maps.LatLng(-34.716018, -56.219623);
var aeropuerto = new google.maps.LatLng(-34.839392, -56.031976);
var florida = new google.maps.LatLng(-34.097349, -56.217163);

var destinationIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=D|FF0000|000000';
var originIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000';

function initialize() {
    var opts = {
        center: new google.maps.LatLng(-34.895247, -56.172498),
        zoom: 8
    };
    map = new google.maps.Map(document.getElementById('map-canvas'), opts);
    geocoder = new google.maps.Geocoder();
}

function calculateDistances() {
    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
        origins: [origen], //Dado que es una matriz se pueden especificar varios origenes y destinos
        destinations: [canelones, san_jose, las_piedras, aeropuerto, florida],
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,

        //avoidHighways: false,
        //avoidTolls: false
    }, callbackMostrarDistancias);
}

//Muestra el resultado de la solicitud
function callbackMostrarDistancias(response, status) {
    if (status != google.maps.DistanceMatrixStatus.OK) {
        alert('Error was: ' + status);
    }
    else
    {
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

function addMarker(location, isDestination) {
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

            var infowindow = new google.maps.InfoWindow({
                content: location
            });

            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                icon: icon,
                title: location
            });

            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open(map,marker);
            });

            markersArray.push(marker);

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
    markersArray = [];
}

google.maps.event.addDomListener(window, 'load', initialize);
