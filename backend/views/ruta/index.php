<?php

use backend\helpers\sysconfigs;
use dektrium\user\models\User;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RutaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core', 'Routes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ruta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('core', 'Create Route'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'dia',
                'label'=>Yii::t('core', "Open on"),
                'format'=>'raw',
                'value' => function ($data) {
                    return Yii::t('core', sysconfigs::getNombreDia($data->dia));
                }
            ],
            [
                'attribute'=>'esActivo',
                'label'=>Yii::t('core', 'Active?'),
                'format'=>'raw',
                'value'=>function ($data) {
                    if ($data->esActivo == 0)
                        return '<span class="label label-danger">'.Yii::t('core', sysconfigs::getNombreEsActivo($data->esActivo)).'</span>';
                    else
                        return '<span class="label label-success">'.Yii::t('core', sysconfigs::getNombreEsActivo($data->esActivo)).'</span>';
                },
            ],
            [
                'attribute'=>'id_usuario',
                'label'=>Yii::t('core', 'User'),
                'format'=>'raw',
                'value'=>function ($data) {
                    return $usuario = User::findOne($data->id_usuario)->username;
                },
            ],
            [
                'header' => 'Options',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{info} {view} {update} ',
            ],
        ],
    ]); ?>

</div>
