<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Pedido */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cantidad')->textInput(
        [
            'label'=>Yii::t('core', 'Quantity'),
        ]
    ) ?>

    <?= $form->field($model, 'id_producto')->textInput(
        [
            'label'=>Yii::t('core', 'Product Id'),
        ]
    ) ?>

    <?= $form->field($model, 'id_ruta_diaria_com')->textInput(
        [
            'label'=>Yii::t('core', 'Daily Store Route Id'),
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('core', 'Create') : Yii::t('core', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
