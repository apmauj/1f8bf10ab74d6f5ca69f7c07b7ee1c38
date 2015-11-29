<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Ruta */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ruta',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Routes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ruta-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(isset($tieneRecorrido)){  ?>
    <?= $this->render('_form', [
        'model' => $model,'tieneRecorrido'=>$tieneRecorrido,'requestRuta'=>$requestRuta
    ]) ?>
    <?php }else{  ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php }  ?>

</div>
