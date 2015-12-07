<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput([
        'label' => Yii::t('core', 'Name'),
        'maxlength' => true
    ])
    ?>

    <?= $form->field($model, 'descripcion')->textInput(
        [
            'label' => Yii::t('core', 'Description'),
            'maxlength' => true
        ])
    ?>

    <?php echo $form->field($model, 'esActivo')->dropDownList(
        [
            'label' => Yii::t('core', 'Active?'),
            '1' => Yii::t('core', 'Yes'),
            '0' => Yii::t('core', 'No'),
        ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('core', 'Create') : Yii::t('core', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
