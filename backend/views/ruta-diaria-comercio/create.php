<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RutaDiariaComercio */

$this->title = Yii::t('app', 'Create Ruta Diaria Comercio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ruta Diaria Comercios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ruta-diaria-comercio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>