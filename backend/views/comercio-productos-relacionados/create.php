<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ComercioProductosRelacionados */

$this->title = Yii::t('app', 'Create Store Related Products');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Related Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comercio-productos-relacionados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
