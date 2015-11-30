<?php
/* @var $this yii\web\View */
$asset = frontend\assets\AppAsset::register($this);
$this->title = Yii::t('mobile', 'Muli Relevators');
$footer = Yii::t('mobile', 'Muli Relevators. All Right Reserved.');
$baseUrl = $asset->baseUrl;
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->title ?></title>
    <link rel="stylesheet" href="/frontend/views/mobile/themes/mulisrelevadores.min.css" />
    <link rel="stylesheet" href="/frontend/views/mobile/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="http://maps.google.com/maps-api-v3/api/js/23/1/common.js" charset="UTF-8" type="text/javascript"></script>
    <script src="http://maps.google.com/maps-api-v3/api/js/23/1/util.js" charset="UTF-8" type="text/javascript"></script>
    <script src="http://maps.google.com/maps-api-v3/api/js/23/1/stats.js" charset="UTF-8" type="text/javascript"></script>
    <script src="http://maps.google.com/maps-api-v3/api/js/23/1/map.js" charset="UTF-8" type="text/javascript"></script>
    <script src="http://maps.google.com/maps-api-v3/api/js/23/1/marker.js" charset="UTF-8" type="text/javascript"></script>
    <script src="http://maps.google.com/maps-api-v3/api/js/23/1/onion.js" charset="UTF-8" type="text/javascript"></script>
    <script src="http://maps.google.com/maps-api-v3/api/js/23/1/controls.js" charset="UTF-8" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&signed_in=true&libraries=geometry"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/js/funcionesMapaRuta.js"></script>

    <style>
        #rutas, #map-canvas { width: 100%; height: 100%; padding: 0; }
    </style>

</head>
<body>

<div data-role="page" id="home">
    <div data-role="header">
        <h1><?php echo $this->title ?></h1>
        <div data-role="navbar">
            <ul>
                <li><a href="#" class="ui-btn-active ui-state-persist" data-icon="home"><?= Yii::t('app', 'Home');?></a></li>
                <li><a href="#rutas" data-icon="location"><?= Yii::t('app', 'Routes');?></a></li>
                <li><a href="#pedidos" data-icon="edit"><?= Yii::t('app', 'Orders');?></a></li>
                <li><a href="#stock" data-icon="gear"><?= Yii::t('app', 'Stock');?></a></li>
            </ul>
        </div>
    </div>

    <div data-role="main" class="ui-content">
        <img src="<?=$baseUrl?>/images/mulirelevadores/logo.png" style="height: 50%; width: 100%;" alt="logo">
        <p><?= Yii::t('app', 'Welcome back!');?> </p>
        <p><?= Yii::t('app', 'To use our app, select an option from the nav menu.');?></p>
        <br>
    </div>

    <div data-role="footer">
        <h1><?php echo $footer ?></h1>
    </div>
</div>

<div data-url="rutas" data-role="page" id="rutas">
    <div data-role="header">
        <h1><?php echo $this->title ?></h1>
        <div data-role="navbar">
            <ul>
                <li><a href="#home" data-icon="home"><?= Yii::t('app', 'Home');?></a></li>
                <li><a href="#" class="ui-btn-active ui-state-persist" data-icon="location"><?= Yii::t('app', 'Routes');?></a></li>
                <li><a href="#pedidos" data-icon="edit"><?= Yii::t('app', 'Orders');?></a></li>
                <li><a href="#stock" data-icon="gear"><?= Yii::t('app', 'Stock');?></a></li>
            </ul>
        </div>
    </div>

    <div data-role="message" class="ui-content" id="mensaje-rutas" ><p>something<p></div>
    <div data-role="main" class="ui-content" id="map-canvas">

    </div>

    <div data-role="footer">
        <h1><?php echo $footer ?></h1>
    </div>
</div>




<div data-role="page" id="pedidos">
    <div data-role="header">
        <h1><?php echo $this->title ?></h1>
        <div data-role="navbar">
            <ul>
                <li><a href="#home" data-icon="home"><?= Yii::t('app', 'Home');?></a></li>
                <li><a href="#rutas" data-icon="location"><?= Yii::t('app', 'Routes');?></a></li>
                <li><a href="#" class="ui-btn-active ui-state-persist" data-icon="edit"><?= Yii::t('app', 'Orders');?></a></li>
                <li><a href="#stock" data-icon="gear"><?= Yii::t('app', 'Stock');?></a></li>
            </ul>
        </div>
    </div>

    <div data-role="main" class="ui-content" style="height: 100%">
        <p><?= Yii::t('app', 'Orders');?></p>

        <div data-role="fieldcontain">
            <input type="range" name="slider" value="50" min="0" max="100" data-form="ui-body-a" data-theme="a" data-highlight="true" />
        </div>
        <div data-role="fieldcontain">
            <input type="range" name="slider" value="50" min="0" max="100" data-form="ui-body-a" data-theme="a" data-highlight="true" />
        </div>

    </div>

    <div data-role="footer">
        <h1><?php echo $footer ?></h1>
    </div>
</div>



<div data-role="page" id="stock">
    <div data-role="header">
        <h1><?php echo $this->title ?></h1>
        <div data-role="navbar">
            <ul>
                <li><a href="#home" data-icon="home"><?= Yii::t('mobile', 'Home');?></a></li>
                <li><a href="#rutas" data-icon="location"><?= Yii::t('mobile', 'Routes');?></a></li>
                <li><a href="#pedidos" data-icon="edit"><?= Yii::t('mobile', 'Orders');?></a></li>
                <li><a href="#" class="ui-btn-active ui-state-persist" data-icon="gear"><?= Yii::t('mobile', 'Stock');?></a></li>
            </ul>
        </div>
    </div>

    <div data-role="main" class="ui-content">
            <div class="ui-field-contain">
                <select name="select-native-1" id="selComercio">
                    <option><?= Yii::t('mobile', 'Select store...');?></option>
                </select>
            </div>
    </div>

    <div class="ui-field-contain" id="sliderStock">
       <label for="slider-1"><?= Yii::t('mobile', 'Slider:');?></label>
       <input name="slider-1" id="slider-1" value="50" min="0" max="100" data-highlight="true" type="range">
    </div>

    <div id="stockBoton">
        <input type="button" data-inline="true" value='<?= Yii::t('mobile', 'Submit');?>'>
    </div>

    <p><b><?= Yii::t('mobile', 'Results:');?></b> <span id="results"></span></p>

    <div data-role="footer">
        <h1><?php echo $footer ?></h1>
    </div>
</div>


</body>
</html>

<script>
    $('#stockBoton').hide();
    $( document ).ready(function() {
        $.ajax({
            url: '/api/web/v2/comercio',
            method : 'GET',
            dataType : 'json',
                success : function(comercio){
                    console.log('comercio', comercio);
                    var selCom = $('#selComercio');
                    var html = '';
                    $.each( comercio, function(key, comercio ){
                        console.log(comercio.nombre);
                        html += '<option value=' + comercio.id +'>' + comercio.nombre + '</option>';
                    });
                    selCom.html(html);
                },
                error : function(){
                    alert(<?= Yii::t('mobile', 'Error on initialization!!');?>)
                }
        });

        var idProductos = [];

        $('#selComercio').on('change', function () {
            $.ajax({
                url: '/api/web/v2/stock/' + $('#selComercio').val(),
                method : 'GET',
                dataType : 'json',
                success : function(producto){
                    console.log('producto', producto);
                    var sliSto = $('#sliderStock');
                    var html = '';
                    $.each( producto, function(key, producto ){
                        idProductos.push(producto.id);
                        html += '<label for="sliderProds">'+producto.nombre+'</label>';
                        html += '<input name="sliderProds" id="slider-'+ producto.id +'" value="50" min="0" max="100" data-highlight="true" type="number"  class="ui-shadow-inset ui-body-inherit ui-corner-all ui-slider-input" style="margin:15px"> <h4> '    + producto.nombre  + ' </h4>';
                        html += '</br>';
                    });
                    sliSto.html(html);
                    $('#stockBoton').show();
                },
                error : function(){
                    alert(<?= Yii::t('mobile', 'Error when loading Store products!!');?>)
                }
            });
        });

        function showValues(){
            var cant = $( ":input[name=sliderProds]" ).serializeArray();
            $.each( idProductos, function(key, producto ){
                $.ajax({
                    url: '/api/web/v2/stock',
                    method : 'POST',
                    data : {
                        'id_producto' : producto,
                        'cantidad' : cant[key].value
                    },
                    dataType : 'json',
                    success : function(response){
                        console.log(response);
                        alert('OK');
                    },
                error : function(){
                    alert(<?= Yii::t('mobile', 'Error while trying to get quantities!!');?>)
                }
            });
        }

        $( "#stockBoton" ).on('click', showValues );

    });
</script>

<script>
    $( document ).on( "pagecreate", "#rutas", function() {
        var ubicacion = new google.maps.LatLng(-34.905647, -56.186787);
        var directionsDisplay = new google.maps.DirectionsRenderer();
        var directionsService = new google.maps.DirectionsService();

        $.ajax({
            url: '/api/web/v2/ruta/' + 22,
            method : 'GET',
            dataType : 'json',
            success : function(results){
                console.log('results', results);
                var html = '';
                if(results.status === "ok"){
                    var map = drawMap(ubicacion);
                    var normalizedRequest = normalizeRequest(results.requestJson);
                    renderDirections(directionsService,directionsDisplay,map,normalizedRequest);
                }else if(results.status === "error"){
                    document.getElementById("mensaje-rutas").innerHTML = "<p>"+results.mensaje+"<p>";
                    var map = drawMap(ubicacion);

                }
//                $.each( producto, function(key, producto ){
//                      html += '<div class="ui-field-contain">';
//                      html += '<label for="slider-'+ producto.id + '">Slider:</label>';
//                      html += '<input name="slider-'+ producto.id + '" id="slider-'+ producto.id + '" value="50" min="0" max="100" data-highlight="true" type="range">';
//                      html += '</div>';
//                      html += '<label for="slider-'+ producto.id + '" id="slider-'+ producto.id + '-label">' + producto.nombre + '</label>';
                    //html += '<div class="ui-slider">';
//                    html += '<input name="slider-'+ producto.id +'" id="slider-'+ producto.id +'" value="50" min="0" max="100" data-highlight="true" type="number"  class="ui-shadow-inset ui-body-inherit ui-corner-all ui-slider-input" style="margin:15px"> <h4> '    + producto.nombre  + ' </h4>';
//                      html += '<div role="application" class="ui-slider-track ui-shadow-inset ui-bar-inherit ui-corner-all">';
//                      html += '<div class="ui-slider-bg ui-btn-active" style="width: 50%;">';
                    //html += '</div>';
//                      html += '<a href="#" class="ui-slider-handle ui-btn ui-shadow" role="slider" aria-valuemin="0" aria-valuemax="100" aria-valuenow="50" aria-valuetext="50" title="50" aria-labelledby="slider-1-label" style="left: 50%;">';
//                      html += '</a>';
//                    html += '</br>';
//                });
//                sliSto.html(html);
//                $('#stockBoton').show();
            },
            error : function(){
                alert('error')
            }
        });


/*
        var defaultLatLng = new google.maps.LatLng(34.0983425, -118.3267434);  // Default to Hollywood, CA when no geolocation support

        if ( navigator.geolocation ) {
            function success(pos) {
                // Location found, show map with these coordinates
                drawMap(new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude));
            }
            function fail(error) {
                drawMap(defaultLatLng);  // Failed to find location, show default map
            }
            // Find the users current position.  Cache the location for 5 minutes, timeout after 6 seconds
            navigator.geolocation.getCurrentPosition(success, fail, {maximumAge: 500000, enableHighAccuracy:true, timeout: 6000});
        }
        else {
            drawMap(defaultLatLng);  // No geolocation support, show default map
        }
*/

        function drawMap(latlng) {
            var myOptions = {
                zoom: 13,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
            return map;
//            // Add an overlay to the map of current lat/lng
//            var marker = new google.maps.Marker({
//                position: latlng,
//                map: map,
//                title: "<?php echo Yii::t('mobile', 'Greetings!!');?>"
//            });
        }
    });
</script>


<!--<div class="site-index">-->
<!---->
<!--    <div class="jumbotron">-->
<!--        var_dump(file_get_contents('http://localhost/yii2-grupo8/api/web/v1/productos'));-->
<!--    </div>-->
<!---->
<!--</div>-->

<!---->
<!--// $('#mensaje').html('texto xxxxxx')-->
<!---->
<!--//            setTimeout(function(){-->
<!--//                $('#mensaje').show();-->
<!--//            }, 3000);-->


<!--//divPRod.prepend('<h1>' + producto.nombre + '</h1> ');-->
