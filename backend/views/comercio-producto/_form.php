<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use \backend\models\Comercio;
use \backend\models\Producto;

/* @var $this yii\web\View */
/* @var $model backend\models\ComercioProducto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comercio-producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'vendidos')->textInput() ?>

    <?php
    $comercio=array(Comercio::find()->all());
    $listData=ArrayHelper::map(Comercio::find()->all(),'id','nombre');
    echo $form->field($model, 'id_comercio')->dropDownList($listData,
        ['prompt'=>'Seleccionar...']);
    ?>

    <?php
    //$comercio=array(Comercio::find()->all());
    $listData=ArrayHelper::map(Producto::find()->all(),'id','nombre');
    echo $form->field($model, 'id_producto')->dropDownList($listData,
        ['prompt'=>'Seleccionar...']);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
