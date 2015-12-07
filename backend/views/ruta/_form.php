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
            '1' => Yii::t('core', 'Monday'),
            '2' => Yii::t('core', 'Tuesday'),
            '3' => Yii::t('core', 'Wednesday'),
            '4' => Yii::t('core', 'Thursday'),
            '5' => Yii::t('core', 'Friday'),
            '6' => Yii::t('core', 'Saturday'),
            '7' => Yii::t('core', 'Sunday'),
        ],
        [
            'disabled'=>!$model->isNewRecord
        ]
    );
    ?>

    <?= $form->field($model, 'esActivo')->dropDownList(
        [
            'label' => Yii::t('core', 'Active?'),
            '1' => Yii::t('core', 'Yes'),
            '0' => Yii::t('core', 'No'),
        ]);
    ?>

    <?php
        //$usuarios=array(User::find()->all());
        $listData=ArrayHelper::map(User::find()->all(),'id','username');
        echo $form->field($model, 'id_usuario')->dropDownList($listData,
            ['prompt'=>Yii::t('core', 'Select...'),'disabled'=>!$model->isNewRecord]
        );
    ?>

    <?php if(!$model->isNewRecord && !isset($tieneRecorrido)){ ?>

    <p>
        <?= Html::a(Yii::t('core', 'Automatic generation'), ['orden-comercio/generar-ruta-auto', 'idRuta'=>$model->id,'idRelevador' => $model->id_usuario,'dia'=>$model->dia], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('core', 'Manual generation'), ['orden-comercio/generar-ruta-manual', 'idRuta'=>$model->id,'idRelevador' => $model->id_usuario,'dia'=>$model->dia], ['class' => 'btn btn-success']) ?>
    </p>

    <?php   }   ?>
    <?php if(!$model->isNewRecord && isset($tieneRecorrido) && $model->esActivo){ ?>
        <?= Html::a(Yii::t('core', 'Generate Daily Route'), ['ruta-diaria/create', 'idRuta'=>$model->id], ['class' => 'btn btn-success']) ?>

    <?php   }   ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('core', 'Create') : Yii::t('core', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php
        if(isset($tieneRecorrido)){
            echo Html::hiddenInput('jsonRequest', $requestRuta,['id'=>'jsonRequest']);
        ?>

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&signed_in=true&libraries=geometry"></script>
        <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/js/mapaRutas.js"></script>
        <div id="map-canvas" style="height: 500px; width: 100%;border: 1px solid black"></div>
    <?php } ?>

</div>
