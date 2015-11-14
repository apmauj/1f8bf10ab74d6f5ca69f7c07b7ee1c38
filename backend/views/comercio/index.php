<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComercioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Comercios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comercio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Comercio'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            //'latitud',
            //'longitud',
            [
                'attribute'=>'dia',
                'label'=>'Dia abierto?',
                'format'=>'raw',
                'value' => function ($data) {
                    if ($data->dia == 1) return "Lunes";
                    if ($data->dia == 2) return "Martes";
                    if ($data->dia == 3) return "Miercoles";
                    if ($data->dia == 4) return "Jueves";
                    if ($data->dia == 5) return "Viernes";
                    if ($data->dia == 6) return "Sabado";
                    if ($data->dia == 7) return "Domingo";
                    return 0;}
            ],
            [
                'attribute'=>'prioridad',
                'label'=>'Prioridad',
                'format'=>'raw',
                'value'=> function ($data) {
                    if ($data->prioridad == 1) return "Muy Alta";
                    if ($data->prioridad == 2) return "Alta";
                    if ($data->prioridad == 3) return "Normal";
                    if ($data->prioridad == 4) return "Baja";
                    if ($data->prioridad == 5) return "Muy Baja";
                    return 0;},
            ],
            [
                'attribute'=>'esActivo',
                'label'=>'Comercio Activo?',
                'format'=>'raw',
                'value'=>function ($data) {
                    if ($data->esActivo == 1) return '<span class="label label-success">Si</span>';
                    else return '<span class="label label-danger">No</span>';
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
