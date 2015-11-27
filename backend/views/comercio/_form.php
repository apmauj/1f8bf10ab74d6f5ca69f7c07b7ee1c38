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
            'label' => Yii::t('app', 'Name'),
            'maxlength' => true
        ])
    ?>

    <?= $form->field($model, 'direccion')->textInput(
        [
            'label' => Yii::t('app', 'Adress'),
            'maxlength' => true,
            'id' => 'direccion',
            'onchange' => 'javascript:cambioDireccion()',

        ]);
    ?>

    <?= $form->field($model, 'dia')->dropDownList(
        [
            '1' => Yii::t('app', 'Monday'),
            '2' => Yii::t('app', 'Tuesday'),
            '3' => Yii::t('app', 'Wednesday'),
            '4' => Yii::t('app', 'Thursday'),
            '5' => Yii::t('app', 'Friday'),
            '6' => Yii::t('app', 'Saturday'),
            '7' => Yii::t('app', 'Sunday'),
        ]);
    ?>

    <?= $form->field($model, 'prioridad')->dropDownList(
        [
            'label' => Yii::t('app', 'Priority'),
            '1' => Yii::t('app', 'Muy Alta'),
            '2' => Yii::t('app', 'Alta'),
            '3' => Yii::t('app', 'Normal'),
            '4' => Yii::t('app', 'Baja'),
            '5' => Yii::t('app', 'Muy Baja'),
        ]);
    ?>

    <?= $form->field($model, 'esActivo')->dropDownList(
        [
            'label' => Yii::t('app', 'Active?'),
            '1' => Yii::t('app', 'Yes'),
            '0' => Yii::t('app', 'No'),
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
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
