<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Stock */

$this->title = Yii::t('core', 'Create Stock');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core', 'Stocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
