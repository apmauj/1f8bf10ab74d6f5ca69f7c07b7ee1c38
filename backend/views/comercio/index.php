<?php

use backend\helpers\sysconfigs;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComercioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Stores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comercio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Store'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'nombre',
                'label'=>Yii::t('app', 'Name'),
            ],
            [
                'attribute'=>'dia',
                'label'=>Yii::t('app', 'Open on'),
                'format'=>'raw',
                'value' => function ($data) {
                    return Yii::t('app', sysconfigs::getNombreDia($data->dia));
                }
            ],
            [
                'attribute'=>'prioridad',
                'label'=>Yii::t('app', 'Priority'),
                'format'=>'raw',
                'value'=> function ($data) {
                    return Yii::t('app', sysconfigs::getNombreDia($data->prioridad));
                },
            ],
            [
                'attribute'=>'esActivo',
                'label'=>Yii::t('app', 'Active'),
                'format'=>'raw',
                'value'=>function ($data) {
                    if ($data->esActivo == 0)
                        return '<span class="label label-danger">'.Yii::t('app', sysconfigs::getNombreEsActivo($data->esActivo)).'</span>';
                    else
                        return '<span class="label label-success">'.Yii::t('app', sysconfigs::getNombreEsActivo($data->esActivo)).'</span>';
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
