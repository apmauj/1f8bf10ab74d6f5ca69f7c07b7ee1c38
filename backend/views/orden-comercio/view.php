<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OrdenComercio */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core', 'Store Order'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orden-comercio-view">

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
            'id',
            [
                'attribute'=>'orden',
                'label'=>Yii::t('core', 'Name'),
            ],
            [
                'attribute'=>'id_ruta',
                'label'=>Yii::t('core', 'Route Id'),
            ],
            [
                'attribute'=>'id_comercio',
                'label'=>Yii::t('core', 'Store Id'),
            ],
        ],
    ]) ?>

</div>
