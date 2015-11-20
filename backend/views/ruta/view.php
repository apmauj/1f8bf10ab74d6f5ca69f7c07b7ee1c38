<?php

use backend\helpers\sysconfigs;
use dektrium\user\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Ruta */

$this->title = Yii::t('app', 'Route number ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Routes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ruta-view">

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
        $usuario = User::findOne($model->id_usuario)->username;
    4?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'dia',
                'label'=>Yii::t('app','Open on'),
                'format'=>'raw',
                'value'=> Yii::t('app',sysconfigs::getNombreDia($model->dia)), // $diaVisita,
            ],
            [
                'attribute'=>'esActivo',
                'label'=>Yii::t('app','Active?'),
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
            [
                'attribute'=>'id_usuario',
                'label'=>Yii::t('app', 'User'),
                'format'=>'raw',
                'value'=> $usuario,
            ],        ],
    ]) ?>

</div>
