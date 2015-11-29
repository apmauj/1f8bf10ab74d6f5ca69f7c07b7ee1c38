<?php
$asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
/* @var $this yii\web\View */
$this->title = 'My Yii Application';
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery Mobile: Theme Download</title>
    <link rel="stylesheet" href="/frontend/views/mobile/themes/mulisrelevadores.min.css" />
    <link rel="stylesheet" href="/frontend/views/mobile/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>



<div class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main" data-role="page" id="rutas">

    <div data-role="fieldcontain">
        <label for="name"><?= Yii::t('mobile', 'Username');?></label>
        <input type="text" name="name" id="name" value="" />
    </div>

    <div data-role="fieldcontain">
        <label for="password"><?= Yii::t('mobile', 'Password');?></label>
        <input type="password" name="password" id="password" value=""/>
    </div>

    <div data-role="controlgroup" data-type="vertical">
        <input type='button' id="login" value='<?= Yii::t('mobile', 'Log In');?>'>
    </div>

    <div id="mensaje">

    </div>


    <div id="producto">

    </div>






    <script>
        $('#mensaje').hide();
        $( document ).ready(function() {
            $('#login').on('click', function () {
                $.ajax({
                    url: '/api/web/v2/login',
                    method : 'POST',
                    data: {
                        'login-form[login]': $("#name").val(),
                        'login-form[password]': $("#password").val()
                    },
                    dataType : 'json',
                    success : function(){
                        window.location = '/frontend/web/mobile/index';
                        //console.log()
                    },
                    error : function(){
                        alert('error')
                    }
                });
            });

           /* $.ajax({
                url: '/api/web/v2/producto',
                method : 'GET',
                dataType : 'json',
                success : function(productos){
                    console.log('productos', productos)
                    var divPRod = $('#producto');
                    var html = '';

                    $('#mensaje').html('ta todo bien')

                    setTimeout(function(){
                        $('#mensaje').show();
                    }, 3000);

                    $.each( productos, function(key, producto ){
                        console.log(producto.nombre);

                        html += '<h1>' + producto.nombre + '</h1>';
                        html += '<p>' + producto.precio + '</p>';
                        html += '<button>comprar</button>';

                        //divPRod.prepend('<h1>' + producto.nombre + '</h1> ');

                    });

                    divPRod.html(html);
                },
                error : function(){
                    alert('error')
                }
            });*/
        });
    </script>


</div>

</body>
</html>