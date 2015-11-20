<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OrdenComercio */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Order'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orden-comercio-view">

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
            'id',
            [
                'attribute'=>'orden',
                'label'=>Yii::t('app', 'Name'),
            ],
            [
                'attribute'=>'id_ruta',
                'label'=>Yii::t('app', 'Route Id'),
            ],
            [
                'attribute'=>'id_comercio',
                'label'=>Yii::t('app', 'Store Id'),
            ],
        ],
    ]) ?>

</div>
