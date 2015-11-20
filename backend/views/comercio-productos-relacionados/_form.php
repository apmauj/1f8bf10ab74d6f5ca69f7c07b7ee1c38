<?php

use backend\models\Comercio;
use backend\models\Producto;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComercioProductosRelacionados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comercio-productos-relacionados-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        //$categoria=array(Comercio::find()->all());
        $listData=ArrayHelper::map(Comercio::find()->all(),'id','nombre');
        echo $form->field($model, 'id_comercio')->dropDownList($listData,
            ['prompt'=>Yii::t('app', 'Select...')]);
    ?>

    <?php
        $listData=ArrayHelper::map(Producto::find()->all(),'id','nombre');
        echo $form->field($model, 'id_producto')->checkboxList($listData);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
