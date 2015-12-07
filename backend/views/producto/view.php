<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Producto */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$webroot='../../web/';
?>
<div class="producto-view">

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
                'label'=>Yii::t('core', 'Name'),
            ],
            [
                'attribute'=>'imagen',
                'label'=>Yii::t('core', 'Image'),
                'value'=>$webroot.$model->imagen,
                'format' => ['image',['width'=>'100','height'=>'100']],
            ],
            [
                'attribute'=>'id_categoria',
                'label'=>Yii::t('core', 'Category'),
                'value'=>($model->idCategoria->getAttribute('nombre'))
            ],
            [
                'attribute'=>'precio',
                'label'=>Yii::t('core', 'Price'),
            ],
        ],
    ]) ?>

</div>
