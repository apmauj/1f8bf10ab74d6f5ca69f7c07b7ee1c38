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
            'label'=>Yii::t('core','Order'),
        ]
    ) ?>

    <?= $form->field($model, 'id_ruta')->textInput(
        [
            'label'=>Yii::t('core','Route Id'),
        ]
    ) ?>

    <?= $form->field($model, 'id_comercio')->textInput(
        [
            'label'=>Yii::t('core','Store Id'),
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('core', 'Create') : Yii::t('core', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
