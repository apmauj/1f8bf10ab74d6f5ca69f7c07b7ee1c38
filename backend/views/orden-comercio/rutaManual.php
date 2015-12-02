<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 1/12/2015
 * Time: 17:55
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrdenComercio */

$this->title = Yii::t('app', 'Manual Route');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manual Route'), 'url' => ['ruta/update']];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="orden-comercio">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="orden-comercio-form">
        <?php $form = ActiveForm::begin([ 'action' => ['orden-comercio/salvar-ruta-manual'],'method' => 'post']); ?>
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
        <div class="form-group">
            <?= Html::textarea('comerciosElegidos','',['id'=> 'comerciosElegidos','rows'=>'8','width'=>'50%','height'=>'200px',"disabled"=>"true"]) ?>
            <span style="margin-left: 10px;vertical-align:top "><?= Html::Button(Yii::t('app', 'Erase Selection'), ['class' => 'btn btn-danger','id'=>'eraseSelection' ]) ?> </span>
        </div>


        <?= $form->field($model, 'jsonRequestRuta')->hiddenInput([
            'id'=>'jsonMarcas',
        ])->label(false);
        ?>
        <?= $form->field($model, 'ordenComercios')->hiddenInput([
            'id'=>'ordenComercios'
        ])->label(false);
        ?>
        <?= $form->field($model, 'idUsuario')->hiddenInput([
        ])->label(false);
        ?>
        <?= $form->field($model, 'dia')->hiddenInput([
        ])->label(false);
        ?>
        <?= Html::hiddenInput('coordenadasUsuario',$ubicacionUsuario,['id'=>'coordenadasUsuario']); ?>
        <?= Html::submitButton(Yii::t('app', 'Confirm'), ['class' => 'btn btn-success' ]) ?>

        <?php ActiveForm::end(); ?>


    </div>
</div>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&signed_in=true"></script>
<script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/js/marcaMapas.js"></script>
<div id="map-canvas" style="height: 500px; width: 100%;border: 1px solid black"></div>

<script>
    $("#eraseSelection").on('click', function(){
        $("#comerciosElegidos").val("");
        $("#ordenComercios").val("");
    });
</script>


