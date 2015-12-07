<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Comercio */
/* @var $form yii\widgets\ActiveForm */
?>

<script src="https://maps.googleapis.com/maps/api/js?v=3&signed_in=true"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/js/agregarMarcaMapa.js"></script>
<div class="comercio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(
        [
            'label' => Yii::t('core', 'Name'),
            'maxlength' => true
        ])
    ?>

    <?= $form->field($model, 'direccion')->textInput(
        [
            'label' => Yii::t('core', 'Adress'),
            'maxlength' => true,
            'id' => 'direccion',
            'onchange' => 'javascript:cambioDireccion()',

        ]);
    ?>

    <?= $form->field($model, 'dia')->dropDownList(
        [
            '1' => Yii::t('core', 'Monday'),
            '2' => Yii::t('core', 'Tuesday'),
            '3' => Yii::t('core', 'Wednesday'),
            '4' => Yii::t('core', 'Thursday'),
            '5' => Yii::t('core', 'Friday'),
            '6' => Yii::t('core', 'Saturday'),
            '7' => Yii::t('core', 'Sunday'),
        ]);
    ?>

    <?= $form->field($model, 'prioridad')->dropDownList(
        [
            'label' => Yii::t('core', 'Priority'),
            '1' => Yii::t('core', 'Very High'),
            '2' => Yii::t('core', 'High'),
            '3' => Yii::t('core', 'Normal'),
            '4' => Yii::t('core', 'Low'),
            '5' => Yii::t('core', 'Very Low'),
        ]);
    ?>

    <?= $form->field($model, 'esActivo')->dropDownList(
        [
            'label' => Yii::t('core', 'Active?'),
            '1' => Yii::t('core', 'Yes'),
            '0' => Yii::t('core', 'No'),
        ]);
    ?>


    <?= $form->field($model, 'latitud')->hiddenInput(
        [
            'id'=>'latitud',
        ]
    )->label(false); ?>
    <?= $form->field($model, 'longitud')->hiddenInput(
        [
            'id'=>'longitud',
        ]
    )->label(false); ?>

    <div id="map-canvas" style="height: 600px; width: 80%;border: 1px solid black"></div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('core', 'Create') : Yii::t('core', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function cambioDireccion(){
        deleteOverlays();
        addMarker($("#direccion").val(),false,map);
    }



/*
    var map;
    var geocoder;
    var originIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000';

    var ubicacion = new google.maps.LatLng(-34.905647, -56.186787);

    function initMap() {
        geocoder = new google.maps.Geocoder();
        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 16,
            center: ubicacion
        });

/!*
        var marker = new google.maps.Marker({
            position: ubicacion,
            map: map,
            title: titulo
        });
*!/
    }
    google.maps.event.addDomListener(window, 'load', initMap);
*/

</script>
