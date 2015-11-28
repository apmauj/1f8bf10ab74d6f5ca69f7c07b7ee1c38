<?php
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
        <input type="text" name="name" id="name" value=""  style="width: 5px"/>
    </div>

    <div data-role="fieldcontain">
        <label for="password"><?= Yii::t('mobile', 'Password');?></label>
        <input type="password" name="password" id="password" value="" style="width: 100%"/>
    </div>

    <div data-role="controlgroup" data-type="vertical">
        <input type='button' value='<?= Yii::t('mobile', 'Log In');?>'>
    </div>

    <script>
        $(function () {
            $('a').on('click', function () {
                var Status = $(this).val();
                $.ajax({
                    url: 'Ajax/StatusUpdate.php',
                    data: {
                        text: $("textarea[name=Status]").val(),
                        Status: Status
                    },
                    dataType : 'json'
                });
            });
        });
    </script>


</div>

</body>
</html>