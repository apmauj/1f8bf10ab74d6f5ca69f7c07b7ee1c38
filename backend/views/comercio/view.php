<?php

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

    if ($diaVisita == 1) $diaVisita = "Lunes";
    if ($diaVisita == 2) $diaVisita = "Martes";
    if ($diaVisita == 3) $diaVisita = "Miercoles";
    if ($diaVisita == 4) $diaVisita = "Jueves";
    if ($diaVisita == 5) $diaVisita = "Viernes";
    if ($diaVisita == 6) $diaVisita = "Sabado";
    if ($diaVisita == 7) $diaVisita = "Domingo";

    if ($prioridadVisita == 1) $prioridadVisita = "Muy Alta";
    if ($prioridadVisita == 2) $prioridadVisita = "Alta";
    if ($prioridadVisita == 3) $prioridadVisita = "Normal";
    if ($prioridadVisita == 4) $prioridadVisita = "Baja";
    if ($prioridadVisita == 5) $prioridadVisita = "Muy Baja";

    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'direccion',
            [
                'attribute'=>'dia',
                'label'=>'Dia abierto?',
                'format'=>'raw',
                'value'=> $diaVisita,
           ],
            [
                'attribute'=>'$prioridadVisita',
                'label'=>'Prioridad',
                'format'=>'raw',
                'value'=> $prioridadVisita,
            ],
            [
                'attribute'=>'esActivo',
                'label'=>'Comercio Activo?',
                'format'=>'raw',
                'value'=>$model->esActivo ?
                    '<span class="label label-success">Si</span>' :
                    '<span class="label label-danger">No</span>',
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

