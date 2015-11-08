<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ComercioProducto */

$this->title = Yii::t('app', 'Create Comercio Producto');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comercio Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comercio-producto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
