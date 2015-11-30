<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<script src="https://maps.googleapis.com/maps/api/js?v=3&signed_in=true"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/js/agregarMarcaMapa.js"></script>
<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($user, 'direccion')->textInput(['maxlength' => true,'id'=>'direccion','onchange' => 'javascript:cambioDireccion()']) ?>

    <?= $form->field($user, 'esActivo')->dropDownList(['1' => Yii::t('app','Yes'), '0' => Yii::t('app','No')]); ?>

    <?= $form->field($user, 'latitud')->hiddenInput(
        [
            'id'=>'latitud',
        ]
    )->label(false); ?>
    <?= $form->field($user, 'longitud')->hiddenInput(
        [
            'id'=>'longitud',
        ]
    )->label(false); ?>

    <div id="map-canvas" style="height: 600px; width: 80%;border: 1px solid black"></div>

    <div class="form-group">
        <?= Html::submitButton($user->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script>
    function cambioDireccion(){
        deleteOverlays();
        addMarker($("#direccion").val(),false,map);
    }


</script>
