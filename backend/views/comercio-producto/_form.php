<?php

use backend\models\Comercio;
use backend\models\Producto;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComercioProducto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comercio-producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha')->textInput(
        [
            'label'=>Yii::t('core', 'Date')
        ]
    )?>

    <?= $form->field($model, 'vendidos')->textInput(
        [
            'label'=>Yii::t('core', 'Sold')
        ])
    ?>

    <?php
    $comercio=array(Comercio::find()->all());
    $listData=ArrayHelper::map(Comercio::find()->all(),'id','nombre');
    echo $form->field($model, 'id_comercio')->dropDownList($listData,
        ['prompt'=>Yii::t('core', 'Select...')]);
    ?>

    <?php
    //$comercio=array(Comercio::find()->all());
    $listData=ArrayHelper::map(Producto::find()->all(),'id','nombre');
    echo $form->field($model, 'id_producto')->dropDownList($listData,
        ['prompt'=>Yii::t('core', 'Select...')]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('core', 'Create') : Yii::t('core', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
