<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Comercio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comercio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(
        [
            'label' => Yii::t('app', 'Name'),
            'maxlength' => true
        ])
    ?>

    <?= $form->field($model, 'direccion')->textInput(
        [
            'label' => Yii::t('app', 'Adress'),
        ]);
    ?>

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

    <?= $form->field($model, 'prioridad')->dropDownList(
        [
            'label' => Yii::t('app', 'Priority'),
            '1' => Yii::t('app', 'Muy Alta'),
            '2' => Yii::t('app', 'Alta'),
            '3' => Yii::t('app', 'Normal'),
            '4' => Yii::t('app', 'Baja'),
            '5' => Yii::t('app', 'Muy Baja'),
        ]);
    ?>

    <?= $form->field($model, 'esActivo')->dropDownList(
        [
            'label' => Yii::t('app', 'Active?'),
            '1' => Yii::t('app', 'Yes'),
            '0' => Yii::t('app', 'No'),
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
