<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Producto */

$this->title = Yii::t('core', 'Update {modelClass}: ', [
    'modelClass' => 'Producto',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('core', 'Update');
?>
<div class="producto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,'categorias'=>$categorias,
    ]) ?>

</div>
