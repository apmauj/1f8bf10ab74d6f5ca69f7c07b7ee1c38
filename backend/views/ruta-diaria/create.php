<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\RutaDiaria */

$this->title = Yii::t('app', 'Create Daily Route');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Daily Route'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ruta-diaria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
