<?php

use backend\helpers\sysconfigs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Categoria */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'nombre',
                'label'=>Yii::t('app','Name'),
            ],
            [
                'attribute'=>'descripcion',
                'label'=>Yii::t('app','Description'),
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
        ],
    ]) ?>

</div>
