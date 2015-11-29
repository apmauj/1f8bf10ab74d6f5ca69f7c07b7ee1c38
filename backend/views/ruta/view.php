<?php

use backend\helpers\sysconfigs;
use dektrium\user\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Ruta */

$this->title = Yii::t('app', 'Route number ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Routes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('/Alertas', [
]) ?>

<div class="ruta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
        $usuario = User::findOne($model->id_usuario)->username;
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'dia',
                'label'=>Yii::t('app','Open on'),
                'format'=>'raw',
                'value'=> Yii::t('app',sysconfigs::getNombreDia($model->dia)), // $diaVisita,
            ],
            [
                'attribute'=>'esActivo',
                'label'=>Yii::t('app','Active?'),
                'format'=>'raw',
                'value'=>$model->esActivo ?
                    '<span class="label label-success">'.Yii::t('app',sysconfigs::getNombreEsActivo($model->esActivo)) .'</span>' :
                    '<span class="label label-danger">'.Yii::t('app',sysconfigs::getNombreEsActivo($model->esActivo)) .'</span>',
                'widgetOptions'=>[
                    'pluginOptions'=>[
                        'onText'=>'Yes',
                        'offText'=>'No',
                    ]
                ]
            ],
            [
                'attribute'=>'id_usuario',
                'label'=>Yii::t('app', 'User'),
                'format'=>'raw',
                'value'=> $usuario,
            ],        ],
    ]) ?>
    <?php
    if(isset($tieneRecorrido)){
        echo Html::hiddenInput('jsonRequest', $requestRuta,['id'=>'jsonRequest']);
     ?>

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&signed_in=true&libraries=geometry"></script>
        <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/js/mapaRutas.js"></script>
        <div id="map-canvas" style="height: 500px; width: 100%;border: 1px solid black"></div>
    <?php } ?>



</div>
