<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RutaDiaria */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ruta Diaria',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daily Route'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ruta-diaria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
