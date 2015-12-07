<?php

use backend\helpers\sysconfigs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Comercio */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core', 'Stores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

<script>
    /*
     * Este codigo no anda ni pa los costados xD
     */
    var map;
    var geocoder;
    var originIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000';

    var ubicacion = new google.maps.LatLng("<?php echo $model->latitud; ?>", "<?php echo $model->longitud; ?>");
    var titulo = "<?php echo Yii::t('core', 'Name: ').$model->nombre;?> \n<?php echo Yii::t('core', 'Adress: ').$model->direccion; ?>";

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
        <?= Html::a(Yii::t('core', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('core', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('core', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'nombre',
                'label'=>Yii::t('core','Name'),
            ],
            [
                'attribute'=>'direccion',
                'label'=>Yii::t('core','Adress'),
            ],
            [
                'attribute'=>'dia',
                'label'=>Yii::t('core','Open on'),
                'format'=>'raw',
                'value'=> Yii::t('core',sysconfigs::getNombreDia($model->dia)), // $diaVisita,
            ],
            [
                'attribute'=>'$prioridadVisita',
                'label'=>Yii::t('core','Priority'),
                'format'=>'raw',
                'value'=> Yii::t('core',sysconfigs::getNombrePrioridad($model->prioridad)),
            ],
            [
                'attribute'=>'esActivo',
                'label'=>Yii::t('core','Active?'),
                'format'=>'raw',
                'value'=>$model->esActivo ?
                    '<span class="label label-success">'.Yii::t('core',sysconfigs::getNombreEsActivo($model->esActivo)) .'</span>' :
                    '<span class="label label-danger">'.Yii::t('core',sysconfigs::getNombreEsActivo($model->esActivo)) .'</span>',
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

<div id="map-canvas" style="height: 300px; width: 200px;border: 1px solid black"></div>

