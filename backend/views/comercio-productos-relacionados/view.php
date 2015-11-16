<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ComercioProductosRelacionados */

$this->title = $model->id_comercio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comercio Productos Relacionados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comercio-productos-relacionados-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id_comercio' => $model->id_comercio, 'id_producto' => $model->id_producto], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id_comercio' => $model->id_comercio, 'id_producto' => $model->id_producto], [
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
                'attribute'=>'id_comercio',
                'value'=>($model->idComercio->getAttribute('nombre'))
            ],
            [
                'attribute'=>'id_producto',
                'value'=>($model->idProducto->getAttribute('nombre'))
            ],
        ],
    ]) ?>

</div>
