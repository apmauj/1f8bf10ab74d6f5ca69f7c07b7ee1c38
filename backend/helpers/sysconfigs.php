<?php
/**
 * Created by PhpStorm.
 * User: Sensei
 * Date: 19/11/2015
 * Time: 17:39
 */

namespace backend\helpers;

class sysconfigs
{

    const TIEMPO_RELEVANDO = 30;
    const RADIO_RELEVADOR = 2000;
    const DISTANCIA_RELEVADOR = 2000;

    //conversion de d�a a texto
    public static function getNombreDia($dia){
        if ($dia == 1) return "Monday";
        if ($dia == 2) return "Tuesday";
        if ($dia == 3) return "Wednesday";
        if ($dia == 4) return "Thursday";
        if ($dia == 5) return "Friday";
        if ($dia == 6) return "Saturday";
        if ($dia == 7) return "Sunday";
    }

    //conversion de d�a a n�mero
    public static function getNumeroDia($dia){
        if ($dia == "Monday") return 1;
        if ($dia == "Tuesday") return 2;
        if ($dia == "Wednesday") return 3;
        if ($dia == "Thursday") return 4;
        if ($dia == "Friday") return 5;
        if ($dia == "Saturday") return 6;
        if ($dia == "Sunday") return 7;
    }

    //conversion de prioridad a texto
    public static function getNombrePrioridad($prioridad){
        if ($prioridad == 1) return "Very High";
        if ($prioridad == 2) return "High";
        if ($prioridad == 3) return "Normal";
        if ($prioridad == 4) return "Low";
        if ($prioridad == 5) return "Very Low";
    }

    //conversion de prioridad a numero
    public static function getNumeroPrioridad($prioridad){
        if ($prioridad == "Very High") return 1;
        if ($prioridad == "High") return 2;
        if ($prioridad == "Normal") return 3;
        if ($prioridad == "Low") return 4;
        if ($prioridad == "Very Low") return 5;
    }

    //conversion de esActivo a texto
    public static function getNombreEsActivo($activo){
        if ($activo == 0) return "No";
        if ($activo == 1) return "Yes";
    }

    //conversion de esActivo a numero
    public static function getNumeroEsActivo($activo){
        if ($activo == "No") return 0;
        if ($activo == "Yes") return 1;
    }

    public static function getCoordinates($direccion){
        $direccion = urlencode($direccion);
        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $direccion;
        $response = file_get_contents($url);
        $json = json_decode($response,true);
        if($json['status']=='OK'){
            $lat = $json['results'][0]['geometry']['location']['lat'];
            $lng = $json['results'][0]['geometry']['location']['lng'];
            return ['latitud'=>$lat,'longitud'=> $lng];
        }else{
            return false;
        }

    }

    public static function getDistanciaEntreCoordenadas($coordenadasOrigen,$coordenadasDestino){
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$coordenadasOrigen['latitud'].",".$coordenadasOrigen['longitud']."&destinations=".$coordenadasDestino['latitud'].",".$coordenadasDestino['longitud']."&key=a25NO-XvNaoTtdZ1vVnjbJyR&mode=walking";
        $response = file_get_contents($url);
        $json = json_decode($response,true);
        if($json['status']=='OK'){
            $distanciaMetros = $json['rows']['elements']['distance']['value'];

            return $distanciaMetros;
        }else{
            return false;
        }
    }


}