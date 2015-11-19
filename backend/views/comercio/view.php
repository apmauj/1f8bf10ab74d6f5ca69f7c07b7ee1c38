<?php

use backend\helpers\sysconfigs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Comercio */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comercios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

<script>
    /*
     * Este codigo no anda ni pa los costados
     */
    var map;
    var geocoder;
    var originIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000';

    var ubicacion = new google.maps.LatLng("<?php echo $model->latitud; ?>", "<?php echo $model->longitud; ?>");
    var titulo = "Nombre: <?php echo $model->nombre;?> \nDireccion: <?php echo $model->direccion; ?>";

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map-canvas'), {
            zoom: 16,
            center: ubicacion
        });

        var marker = new google.maps.Marker({
            position: ubicacion,
            map: map,
            title: titulo
        });

        console.log(marker);
    }
    google.maps.event.addDomListener(window, 'load', initMap);

</script>

<div class="comercio-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php
    $diaVisita = $model->dia;
    $prioridadVisita = $model->prioridad;

    if ($diaVisita == 1) $diaVisita = Yii::t("app", "Monday");
    if ($diaVisita == 2) $diaVisita = Yii::t("app", "Tuesday");
    if ($diaVisita == 3) $diaVisita = Yii::t("app", "Wednesday");
    if ($diaVisita == 4) $diaVisita = Yii::t("app", "Thursday");
    if ($diaVisita == 5) $diaVisita = Yii::t("app", "Friday");
    if ($diaVisita == 6) $diaVisita = Yii::t("app", "Saturday");
    if ($diaVisita == 7) $diaVisita = Yii::t("app", "Sunday");

    if ($prioridadVisita == 1) $prioridadVisita = Yii::t("app", "Very High");
    if ($prioridadVisita == 2) $prioridadVisita = Yii::t("app", "High");
    if ($prioridadVisita == 3) $prioridadVisita = Yii::t("app", "Normal");
    if ($prioridadVisita == 4) $prioridadVisita = Yii::t("app", "Low");
    if ($prioridadVisita == 5) $prioridadVisita = Yii::t("app", "Very Low");

    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'direccion',
            [
                'attribute'=>'dia',
                'label'=>Yii::t('app','Open on'),
                'format'=>'raw',
                'value'=> Yii::t('app',sysconfigs::getNombreDia($model->dia)), // $diaVisita,
           ],
            [
                'attribute'=>'$prioridadVisita',
                'label'=>Yii::t('app','Priority'),
                'format'=>'raw',
                'value'=> Yii::t('app',sysconfigs::getNombrePrioridad($model->prioridad)),
            ],
            [
                'attribute'=>'esActivo',
                'label'=>'Active?',
                'format'=>'raw',
                'value'=>$model->esActivo ?
                    '<span class="label label-success">'.Yii::t('app',sysconfigs::getNombreEsActivo($model->esActivo)) .'</span>' :
                    '<span class="label label-danger">'.Yii::t('app',sysconfigs::getNombreEsActivo($model->esActivo)) .'</span>',
                'widgetOptions'=>[
                    'pluginOptions'=>[
                        'onText'=>'Yes',
                        'offText'=>'No',
                    ]
                ]
            ],
        ],
    ]) ?>

</div>

<div id="map-canvas" style="height: 500px; width: 100%;border: 1px solid black"></div>

