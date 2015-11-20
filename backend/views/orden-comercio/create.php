<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OrdenComercio */

$this->title = Yii::t('app', 'Create Store Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Store Order'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orden-comercio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
