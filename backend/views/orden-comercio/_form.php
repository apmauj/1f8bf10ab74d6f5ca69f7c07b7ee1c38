<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrdenComercio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orden-comercio-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'orden')->textInput(
        [
            'label'=>Yii::t('app','Order'),
        ]
    ) ?>

    <?= $form->field($model, 'id_ruta')->textInput(
        [
            'label'=>Yii::t('app','Route Id'),
        ]
    ) ?>

    <?= $form->field($model, 'id_comercio')->textInput(
        [
            'label'=>Yii::t('app','Store Id'),
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
