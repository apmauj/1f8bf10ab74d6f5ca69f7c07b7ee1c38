<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'nombre')->textInput(
        [
            'label'=>Yii::t('core', 'Name'),
            'maxlength' => true
        ])
    ?>

    <?= $form->field($model, 'file')->fileInput(
        [
            'label'=>Yii::t('core', 'File...'),
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
        ])
    ?>

    <?php
        //$categoria=array(Categoria::find()->all());
	    $listData=ArrayHelper::map($categorias,'id','nombre');
	    echo $form->field($model, 'id_categoria')->dropDownList($listData,
	                                [
                                        'prompt'=>Yii::t('core', 'Select one...')
                                    ]);
    ?>

    <?php echo $form->field($model, 'esActivo')->dropDownList(
        [
            'label' => Yii::t('core', 'Active?'),
            '1' => Yii::t('core', 'Yes'),
            '0' => Yii::t('core', 'No'),
        ]);
    ?>

    <?= $form->field($model, 'precio')->textInput(
        [
            'label' => Yii::t('core', 'Price'),
        ])->hint(Yii::t('core', '*price accept at top 7 integers and 2 decimals'));
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('core', 'Create') : Yii::t('core', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
