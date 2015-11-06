<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Categoria;
/* @var $this yii\web\View */
/* @var $model backend\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imagen')->textInput(['maxlength' => true]) ?>

    <?php
    /*var_dump(Categoria::find()->all());*/

    $categoria=array(Categoria::find()->all());
	$listData=ArrayHelper::map(Categoria::find()->all(),'id','nombre');
	echo $form->field($model, 'id_categoria')->dropDownList($listData,
	                                ['prompt'=>'Seleccionar...']);

    /*$form->field($model, 'id_categoria')->textInput() */?>

    <?= $form->field($model, 'esActivo')->textInput() ?>

    <?= $form->field($model, 'precio')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
