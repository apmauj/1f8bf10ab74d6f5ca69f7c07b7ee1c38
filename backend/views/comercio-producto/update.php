<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ComercioProducto */

$this->title = Yii::t('core', 'Update {modelClass}: ', [
    'modelClass' => 'Comercio Producto',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core', 'Store Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('core', 'Update');
?>
<div class="comercio-producto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
