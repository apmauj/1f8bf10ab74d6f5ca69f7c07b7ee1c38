<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ComercioProductosRelacionados */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Comercio Productos Relacionados',
]) . ' ' . $model->id_comercio;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Related Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_comercio, 'url' => ['view', 'id_comercio' => $model->id_comercio, 'id_producto' => $model->id_producto]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="comercio-productos-relacionados-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
