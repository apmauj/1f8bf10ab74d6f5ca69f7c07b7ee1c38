<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Pedido */

$this->title = Yii::t('core', 'Create Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
