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
    <script src="https://maps.googleapis.com/maps/api/js?v=3&signed_in=true&libraries=geometry"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/js/funcionesMapaRuta.js"></script>

    <style>
        #rutas, #map-canvas { width: 100%; height: 100%; padding: 0; }
    </style>
    <script>
        var token;
        if (typeof window.localStorage != "undefined") {
            token = localStorage.getItem("muli_token");
            if(token === null){
                window.location = '/frontend/web/mobile/login';
            }
        }
    </script>
</head>
<body>

<div data-role="page" id="home">
    <div data-role="header">
        <h1><?php echo $this->title ?></h1>
        <div data-role="navbar">
            <ul>
                <li><a href="#" class="ui-btn-active ui-state-persist" data-icon="home"><?= Yii::t('mobile', 'Home');?></a></li>
                <li><a href="#rutas" data-icon="location"><?= Yii::t('mobile', 'Routes');?></a></li>
                <li><a href="#pedidos" data-icon="edit"><?= Yii::t('mobile', 'Orders');?></a></li>
                <li><a href="#stock" data-icon="gear"><?= Yii::t('mobile', 'Stock');?></a></li>
            </ul>
        </div>
    </div>

    <div data-role="main" class="ui-content">
        <img src="<?=$baseUrl?>/images/mulirelevadores/logo.png" style="height: 50%; width: 100%;" alt="logo">
        <p><?= Yii::t('mobile', 'Welcome back!');?> </p>
        <p><?= Yii::t('mobile', 'To use our app, select an option from the nav menu.');?></p>
        <br>
    </div>

    <div id="logout">
        <input type="button" id="boton-logout" data-inline="true" value='<?= Yii::t('mobile', 'Logout');?>'>
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
                <li><a href="#home" data-icon="home"><?= Yii::t('mobile', 'Home');?></a></li>
                <li><a href="#" class="ui-btn-active ui-state-persist" data-icon="location"><?= Yii::t('mobile', 'Routes');?></a></li>
                <li><a href="#pedidos" data-icon="edit"><?= Yii::t('mobile', 'Orders');?></a></li>
                <li><a href="#stock" data-icon="gear"><?= Yii::t('mobile', 'Stock');?></a></li>
            </ul>
        </div>
    </div>

    <div data-role="message" class="ui-content" id="mensaje-rutas"><p><p></div>
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
                <li><a href="#home" data-icon="home"><?= Yii::t('mobile', 'Home');?></a></li>
                <li><a href="#rutas" data-icon="location"><?= Yii::t('mobile', 'Routes');?></a></li>
                <li><a href="#" class="ui-btn-active ui-state-persist" data-icon="edit"><?= Yii::t('mobile', 'Orders');?></a></li>
                <li><a href="#stock" data-icon="gear"><?= Yii::t('mobile', 'Stock');?></a></li>
            </ul>
        </div>
    </div>

    <div data-role="main" class="ui-content">
        <div class="ui-field-contain">
            <select name="select-native-1" id="selComercioPedido">
                <option><?= Yii::t('mobile', 'Select store...');?></option>
            </select>
        </div>
    </div>

    <div class="ui-field-contain" id="sliderPedido">

    </div>

    <div class="ui-field-contain" id="textoTaProto">
        <h3 style="margin-left: 10px;"><?= Yii::t('mobile', 'You completed all your tasks for today!!');?></h3>
    </div>

    <div id="pedidoBoton">
        <input type="button" data-inline="true" value='<?= Yii::t('mobile', 'Submit');?>'>
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

    </div>

    <div class="ui-field-contain" id="textoTaProtoStock">
        <h3 style="margin-left: 10px;"><?= Yii::t('mobile', 'You completed all your tasks for today!!');?></h3>
    </div>

    <div id="stockBoton">
        <input type="button" data-inline="true" value='<?= Yii::t('mobile', 'Submit');?>'>
    </div>

    <div data-role="footer">
        <h1><?php echo $footer ?></h1>
    </div>
</div>


</body>
</html>

<script>
    $( document ).on( "pagecreate", "#home", function() {
        $("#boton-logout").on('click', function(){
            alert("<?= Yii::t('mobile', 'Thank you for use our app!!');?>");
            if (typeof window.localStorage != "undefined") {
                localStorage.removeItem("muli_token");
                //localStorage.removeItem("id_usuario");
                window.location = '/frontend/web/mobile/login';
            }
        });
    });
</script>

<script>
    $('#pedidoBoton').hide();
    $('#textoTaProto').hide();
    var arrayPedido = [];
    var idProductos = [];
    var arrayComercio = [];
    $( document ).on( "pagecreate", "#pedidos", function() {
        $.ajax({
            url: '/api/web/v2/comercio/'+ localStorage.getItem('muli_token'),
            method: 'GET',
            dataType: 'json',
            success: function (results) {
                var selComP = $('#selComercioPedido');
                var html = '';
                if (results.status === "ok") {
                    html += '<option value=""></option>';
                    $.each(results.data, function (key, comercio) {
                        arrayComercio.push({idCom:comercio.id, comNombre:comercio.nombre});
                    });
                    $.each(arrayComercio, function(key, comer){
                        html += '<option value=' + comer.idCom + '>' + comer.comNombre + '</option>';
                    });
                    selComP.html(html);
                }
                else if (results.status === "error") {
                    alert("<?= Yii::t('mobile', 'Not able to load stores!!!');?>")
                }
            },
            error: function () {
                alert("<?= Yii::t('mobile', 'Error on initialization!!');?>")
            }
        });

        $('#selComercioPedido').on('change', function () {
            arrayPedido = [];
            $.ajax({
                url: '/api/web/v2/pedido/' + $('#selComercioPedido').val(),
                method: 'GET',
                dataType: 'json',
                success: function (producto) {
                    var sliSto = $('#sliderPedido');
                    var html = '';
                    idProductos = [];
                    $('#sliderPedido').show();
                    $.each(producto, function (key, producto) {
                        idProductos.push(producto.id);
                        html += '<input name="sliderProdsPedido" id="slider-' + producto.id + '" value="0" min="0" max="100" data-highlight="true" type="number"  class="ui-shadow-inset ui-body-inherit ui-corner-all ui-slider-input" style="margin:15px"> <h4> ' + producto.nombre + ' </h4>';
                        html += '</br>';
                    });
                    sliSto.html(html);
                    $('#pedidoBoton').show();
                },
                error: function () {
                    alert("<?= Yii::t('mobile', 'Error when loading Store products!!');?>")
                }
            });
        });

        function showValues() {
            var comercio = $('#selComercioPedido').val();
            var cant = $(":input[name=sliderProdsPedido]").serializeArray();
            var exito = false;
            $.each(idProductos, function (key, producto) {
                arrayPedido.push({id_producto:producto,cant:cant[key].value});
            });
            $.ajax({
                url: '/api/web/v2/pedido',
                method: 'POST',
                data: {
                    'productos' : arrayPedido,
                    'id_comercio': comercio,
                    'muli_token': localStorage.getItem("muli_token")
                },
                dataType: 'json',
                success: function () {
                    exito = true;
                    alert("<?= Yii::t('mobile', 'Your order has been saved...thanks!!');?>");
                },
                error: function () {
                    alert("<?= Yii::t('mobile', 'Error while trying to save the order!!');?>")
                }
            });

            $('#sliderPedido').hide();
            $('#pedidoBoton').hide();

            $("#selComercioPedido option[value='"+comercio+"']").remove();
            if ($("#selComercioPedido option[value!='']").length == 0) {
                $("#selComercioPedido").remove();
                $('#textoTaProto').show();
            }
        }
        $("#pedidoBoton").on('click', showValues);
    });
</script>

<script>
    $('#stockBoton').hide();
    $('#textoTaProtoStock').hide();
    var arrayStock = [];
    var idProductosStock = [];
    var arrayComercioStock = [];
    $( document ).on( "pagecreate", "#stock", function() {
        $.ajax({
            url: '/api/web/v2/comercio/'+ localStorage.getItem('muli_token'),
            method: 'GET',
            dataType: 'json',
            success: function (results) {
                var selCom = $('#selComercio');
                var html = '';
                if (results.status === "ok") {
                    html += '<option value=""></option>';
                    $.each(results.data, function (key, comercio) {
                        arrayComercioStock.push({idCom:comercio.id, comNombre:comercio.nombre});
                    });
                    $.each(arrayComercioStock, function(key, comer){
                        html += '<option value=' + comer.idCom + '>' + comer.comNombre + '</option>';
                    });
                    selCom.html(html);
                }
                else if(results.status === "error"){
                    alert("<?= Yii::t('mobile', 'Not able to load stores!!!');?>")
                }
            },
            error: function () {
                alert("<?= Yii::t('mobile', 'Error on initialization!!');?>")
            }
        });

        $('#selComercio').on('change', function () {
            arrayStock = [];
            $.ajax({
                url: '/api/web/v2/stock/' + $('#selComercio').val(),
                method: 'GET',
                dataType: 'json',
                success: function (producto) {
                    var sliSto = $('#sliderStock');
                    var html = '';
                    idProductosStock = [];
                    $('#sliderStock').show();
                    $.each(producto, function (key, producto) {
                        idProductosStock.push(producto.id);
                        html += '<input name="sliderProds" id="slider-' + producto.id + '" value="0" min="0" max="100" data-highlight="true" type="number"  class="ui-shadow-inset ui-body-inherit ui-corner-all ui-slider-input" style="margin:15px"> <h4> ' + producto.nombre + ' </h4>';
                        html += '</br>';
                    });
                    sliSto.html(html);
                    $('#stockBoton').show();
                },
                error: function () {
                    alert("<?= Yii::t('mobile', 'Error when loading Store products!!');?>")
                }
            });
        });

        function showValues() {
            var comercio = $('#selComercio').val();
            var cant = $(":input[name=sliderProds]").serializeArray();
            var exito = false;
            $.each(idProductosStock, function (key, producto) {
                arrayStock.push({id_producto:producto,cant:cant[key].value})
            });
            $.ajax({
                url: '/api/web/v2/stock',
                method: 'POST',
                data: {
                    'stock' : arrayStock,
                    'id_comercio': comercio,
                    'muli_token': localStorage.getItem("muli_token")                },
                dataType: 'json',
                success: function () {
                    exito = true;
                    alert("<?= Yii::t('mobile', 'The stock has been saved succesfully!!');?>");
                },
                error: function () {
                    alert("<?= Yii::t('mobile', 'Error while trying to save the stock!!');?>")
                }
            });
            $('#sliderStock').hide();
            $('#stockBoton').hide();
            $("#selComercio option[value='"+comercio+"']").remove();
            if ($("#selComercio option[value!='']").length == 0) {
                $("#selComercio").remove();
                $('#textoTaProtoStock').show();
            }
        }
        $("#stockBoton").on('click', showValues);
    });
</script>

<script>
    $( document ).on( "pagecreate", "#rutas", function() {
        $('#mensaje-rutas').hide();
        var ubicacion = new google.maps.LatLng(-34.905647, -56.186787);
        var directionsDisplay = new google.maps.DirectionsRenderer();
        var directionsService = new google.maps.DirectionsService();
        $.ajax({
            url: '/api/web/v2/ruta/' + localStorage.getItem("muli_token"),
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
                    $('#mensaje-rutas').show();
                    var map = drawMap(ubicacion);
                }
            },
            error : function(){
                alert('error')
            }
        });

        function drawMap(latlng) {
            var myOptions = {
                zoom: 13,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
            return map;
        }
    });
</script>