<?php

use dektrium\user\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Ruta */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ruta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dia')->dropDownList(['1' => 'Lunes', '2' => 'Martes', '3' => 'Miercoles', '4' => 'Jueves', '5' => 'Viernes', '6' => 'Sabado', '7' => 'Domingo']); ?>

    <?= $form->field($model, 'esActivo')->dropDownList(['1' => 'SI', '0' => 'NO']); ?>

    <?php
    //$usuarios=array(User::find()->all());
    $listData=ArrayHelper::map(User::find()->all(),'id','username');
    echo $form->field($model, 'id_usuario')->dropDownList($listData,
        ['prompt'=>'Seleccionar...']);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
