<?php

use backend\models\Categoria;
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
            'label'=>Yii::t('app','Name'),
            'maxlength' => true
        ])
    ?>

    <?= $form->field($model, 'file')->fileInput(
        [
            'label'=>Yii::t('app','File...'),
            'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'
        ])
    ?>

    <?php
        //$categoria=array(Categoria::find()->all());
	    $listData=ArrayHelper::map($categorias,'id','nombre');
	    echo $form->field($model, 'id_categoria')->dropDownList($listData,
	                                [
                                        'prompt'=>Yii::t('app','Select one...')
                                    ]);
    ?>

    <?php echo $form->field($model, 'esActivo')->dropDownList(
        [
            'label' => Yii::t('app', 'Active?'),
            '1' => Yii::t('app', 'Yes'),
            '0' => Yii::t('app', 'No'),
        ]);
    ?>

    <?= $form->field($model, 'precio')->textInput(
        [
            'label' => Yii::t('app', 'Price'),
        ])->hint(Yii::t('app','*price accept at top 7 integers and 2 decimals'));
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
