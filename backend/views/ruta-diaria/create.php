<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RutaDiaria */

$this->title = Yii::t('app', 'Create Ruta Diaria');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ruta Diarias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ruta-diaria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
