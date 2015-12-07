/**
 * Created by Cacho on 30/11/2015.
 */

function normalizeRequest(request){
    request.origin = asLatLng(request.origin);
    request.destination = asLatLng(request.destination);
    request.travelMode = google.maps.DirectionsTravelMode.WALKING;
    var waypts = [];

    if (typeof request.waypoints != 'undefined') {
        request.waypoints.forEach(function(waypoint){
            waypts.push(asDirectionsWaypoint(asLatLng(waypoint)));
        });
        request.waypoints = waypts;
    }

    return request;
}

function asLatLng(latLngObject){
    return new google.maps.LatLng(latLngObject.lat, latLngObject.lng);
}

function asDirectionsWaypoint(latLong){
    var waypoint ={location:latLong,stopover:true};
    //waypoint.setStopover(true);
    //waypoint.setLocation(latLong);
    return waypoint;
}

function renderDirections(directionsService,directionsDisplay,map, request) {
    directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setMap(map);
            directionsDisplay.setDirections(response);
        }
    });
}

