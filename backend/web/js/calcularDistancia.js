/**
 * Created by El Perro on 22/11/2015.
 */

function calculateDistances() {
    var service = new google.maps.DistanceMatrixService();
    service.getDistanceMatrix({
        origins: [origen], //Dado que es una matriz se pueden especificar varios origenes y destinos
        destinations: [canelones, san_jose, las_piedras, aeropuerto, florida],
        travelMode: google.maps.TravelMode.WALKING,
        unitSystem: google.maps.UnitSystem.METRIC,

        //avoidHighways: false,
        //avoidTolls: false
    }, callbackMostrarDistancias);
}

