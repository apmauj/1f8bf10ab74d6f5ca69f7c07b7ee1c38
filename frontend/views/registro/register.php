<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View              $this
 * @var yii\widgets\ActiveForm    $form
 * @var dektrium\user\models\User $user
 */

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3&signed_in=true"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/js/agregarMarcaMapa.js"></script>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'registration-form',
                ]); ?>

                <?= $form->field($model, 'username') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'direccion')->textInput(['maxlength' => true,'id'=>'direccion','onchange' => 'javascript:cambioDireccion()']) ?>

                <?= $form->field($model, 'latitud')->hiddenInput(
                    [
                        'id'=>'latitud',
                    ]
                )->label(false); ?>
                <?= $form->field($model, 'longitud')->hiddenInput(
                    [
                        'id'=>'longitud',
                    ]
                )->label(false); ?>

                <div id="map-canvas" style="height: 600px; width: 80%;border: 1px solid black"></div>

                <br/>
                <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
        </p>
    </div>
</div>

<script>
    function cambioDireccion(){
        deleteOverlays();
        addMarker($("#direccion").val(),false,map);
    }


</script>

