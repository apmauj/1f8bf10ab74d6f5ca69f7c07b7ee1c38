<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OrdenComercio */

$this->title = Yii::t('app', 'Create Orden Comercio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orden Comercios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orden-comercio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
