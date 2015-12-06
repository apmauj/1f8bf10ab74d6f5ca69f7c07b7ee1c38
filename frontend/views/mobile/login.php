<?php
$asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;
/* @var $this yii\web\View */
$this->title = Yii::t('mobile', 'Muli Relevators');
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Yii::t('mobile', 'Muli Relevators Mobile');?></title>
    <link rel="stylesheet" href="/frontend/views/mobile/themes/mulisrelevadores.min.css" />
    <link rel="stylesheet" href="/frontend/views/mobile/themes/jquery.mobile.icons.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body >

    <div class="ui-content ui-page-theme-a" data-form="ui-page-theme-a" data-theme="a" role="main" data-role="page" id="rutas"
         style="background-image: url(<?=$baseUrl?>/images/mulirelevadores/background.png);background-size: 100% 100%;background-repeat: no-repeat;background-position: center">

        <img src="<?=$baseUrl?>/images/mulirelevadores/banner.jpg" style="height: 100px; width: 90%;" alt="logo"><br>

        <div data-role="fieldcontain" style="width: 90%;">
            <label for="name" style="color: white;"><?= Yii::t('mobile', 'Username');?></label>
            <input type="text" name="name" id="name" value=""   />
        </div>

        <div data-role="fieldcontain" style="width: 90%;">
            <label for="password" style="color: white;"><?= Yii::t('mobile', 'Password');?></label>
            <input type="password" name="password" id="password"/>
        </div>

        <div data-role="controlgroup" data-type="vertical" style="width: 90%;">
            <input type='button' id="login" value='<?= Yii::t('mobile', 'Log In');?>'>
        </div>

        <div id="mensaje">

        </div>

        <div id="producto">

        </div>

        <footer id="footer" class="midnight-blue">
            <div class="col-sm-6" style="text-align: right; width: 90%;">
                <b><?= Yii::t('app', 'All Rights Reserved. &copy; 2015.')?></b>
            </div>
        </footer><!--/#footer-->

    </div>

    <script>
        if (typeof window.localStorage != "undefined") {
            localStorage.removeItem("muli_token");
        }
        $('#mensaje').hide();
        $( document ).ready(function() {
            $('#login').on('click', function () {
                $.ajax({
                    url: '/api/web/v2/login',
                    method : 'POST',
                    data: {
                        'username': $("#name").val(),
                        'password': $("#password").val(),
                        'grant_type': 'password',
                        'client_id' : 'testclient',
                        'client_secret' : 'testpass'
                    },
                    dataType : 'json',
                    success : function(response){
                        console.log(response);
                        if (typeof response.access_token != "undefined") {
                            if (typeof window.localStorage != "undefined") {
                                localStorage.setItem("muli_token", response.access_token);
                                window.location = '/frontend/web/mobile/index';
                            }else{
                                alert("Error... su navegador deberia soportar almacenamiento local. Pero no. Tremenda Basura");
                            }
                        }else{
                            $('#mensaje').innerHTML = response.message;
                        }
                    },
                    error : function(xhr, ajaxOptions, thrownError){
                        var err = eval("(" + xhr.responseText + ")");
                        $('#mensaje').html('<p class="error">'+err.message+'</p>') ;
                        $('#mensaje').show()
                    }
                });
            });
        });
    </script>

</body>
</html>