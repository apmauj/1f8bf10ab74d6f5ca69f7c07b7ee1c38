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

    <?= $form->field($model, 'dia')->dropDownList(
        [
            '1' => Yii::t('app', 'Monday'),
            '2' => Yii::t('app', 'Tuesday'),
            '3' => Yii::t('app', 'Wednesday'),
            '4' => Yii::t('app', 'Thursday'),
            '5' => Yii::t('app', 'Friday'),
            '6' => Yii::t('app', 'Saturday'),
            '7' => Yii::t('app', 'Sunday'),
        ]);
    ?>

    <?= $form->field($model, 'esActivo')->dropDownList(
        [
            'label' => Yii::t('app', 'Active?'),
            '1' => Yii::t('app', 'Yes'),
            '0' => Yii::t('app', 'No'),
        ]);
    ?>

    <?php
        //$usuarios=array(User::find()->all());
        $listData=ArrayHelper::map(User::find()->all(),'id','username');
        echo $form->field($model, 'id_usuario')->dropDownList($listData,
            ['prompt'=>Yii::t('app', 'Select...')]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
