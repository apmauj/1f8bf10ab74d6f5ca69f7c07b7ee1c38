<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\OrdenComercio */

$this->title = Yii::t('app', 'Automatic Route');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Automatic Route'), 'url' => ['ruta/update']];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="orden-comercio">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="orden-comercio-form">
        <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'dia')->textInput([
                'readonly'=>true,
            ])
            ?>
            <?= $form->field($model, 'username')->textInput([
                'readonly'=>true,
            ])
            ?>
            <?= $form->field($model, 'idRuta')->textInput([
                'readonly'=>true,
            ])
            ?>
            <?= $form->field($model, 'jsonRuta')->hiddenInput([
                'id'=>'jsonRuta',
            ])->label(false);
            ?>
            <?= $form->field($model, 'jsonRequestRuta')->hiddenInput([
                'id'=>'jsonRequest',
            ])->label(false);
            ?>
        <?php ActiveForm::end(); ?>


    </div>
</div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&signed_in=true&libraries=geometry"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/js/mapaRutas.js"></script>
<div id="map-canvas" style="height: 500px; width: 100%;border: 1px solid black"></div>