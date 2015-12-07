<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Pedido */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-view">

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
                'attribute'=>'cantidad',
                'label'=>Yii::t('core', 'Quantity'),
            ],
            [
                'attribute'=>'id_producto',
                'label'=>Yii::t('core', 'Product Id'),
            ],
            [
                'attribute'=>'id_ruta_diaria_com',
                'label'=>Yii::t('core', 'Daily Store Route Id'),
            ],
        ],
    ]) ?>

</div>
