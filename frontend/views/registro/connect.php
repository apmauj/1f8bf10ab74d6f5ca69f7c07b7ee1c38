<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var dektrium\user\models\User $model
 * @var dektrium\user\models\Account $account
 */

$this->title = Yii::t('user', 'Sign in');
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
                <div class="alert alert-info">
                    <p>
                        <?= Yii::t('user', 'In order to finish your registration, we need you to enter following fields') ?>:
                    </p>
                </div>
                <?php $form = ActiveForm::begin([
                    'id' => 'connect-account-form',
                ]); ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'username') ?>

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

                <?= Html::submitButton(Yii::t('user', 'Continue'), ['class' => 'btn btn-success btn-block']) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a(Yii::t('user', 'If you already registered, sign in and connect this account on settings page'), ['/user/settings/networks']) ?>.
        </p>
    </div>
</div>
<script>
    function cambioDireccion(){
        deleteOverlays();
        addMarker($("#direccion").val(),false,map);
    }
</script>

