/**
 * Created by Cacho on 28/11/2015.
 */


var ubicacion = new google.maps.LatLng(-34.905647, -56.186787);

var directionsDisplay = new google.maps.DirectionsRenderer();
var directionsService = new google.maps.DirectionsService();
var map;
var geocoder;

function initMap() {
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 16,
        center: ubicacion
    });
    if($('#jsonRuta').val()!= null){
        var jsonRuta = JSON.parse($('#jsonRuta').val());
        var jsonRequest = JSON.parse($('#jsonRequest').val());
        jsonRuta.routes = typecastRoutes(jsonRuta.routes);
        renderDirections(map,normalizeRequest(jsonRequest));
    }

}
google.maps.event.addDomListener(window, 'load', initMap);

function typecastRoutes(routes){
    routes.forEach(function(route){
        route.bounds = asBounds(route.bounds);
        // I don't think `overview_path` is used but it exists on the
        // response of DirectionsService.route()
        route.overview_path = asPath(route.overview_polyline);

        route.legs.forEach(function(leg){
            leg.start_location = asLatLng(leg.start_location);
            leg.end_location   = asLatLng(leg.end_location);

            leg.steps.forEach(function(step){
                step.start_location = asLatLng(step.start_location);
                step.end_location   = asLatLng(step.end_location);
                step.path = asPath(step.polyline);
            });

        });
    });
    return routes;
}
function normalizeRequest(request){
    request.origin = asLatLng(request.origin);
    request.destination = asLatLng(request.destination);
    request.travelMode = google.maps.DirectionsTravelMode.WALKING;
    return request;
}

function asBounds(boundsObject){
    return new google.maps.LatLngBounds(asLatLng(boundsObject.southwest),
        asLatLng(boundsObject.northeast));
}

function asLatLng(latLngObject){
    return new google.maps.LatLng(latLngObject.lat, latLngObject.lng);
}

function asPath(encodedPolyObject){
    return google.maps.geometry.encoding.decodePath( encodedPolyObject.points );
}

function renderDirections(map, request){
    directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setMap(map);
            directionsDisplay.setDirections(response);
        }
    });


    /*
            directions : {
                routes : typecastRoutes(response.routes),
                // "ub" is important and not returned by web service it's an
                // object containing "origin", "destination" and "travelMode"
                ub : normalizeRequest(request)
            },
            draggable : true,
            map : map
        });
    */
}
