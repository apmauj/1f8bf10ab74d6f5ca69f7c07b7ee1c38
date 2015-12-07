<?php

use backend\helpers\sysconfigs;
use dektrium\user\models\User;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Ruta */

$this->title = Yii::t('core', 'Route number ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core', 'Routes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ruta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('core', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php
        $usuario = User::findOne($model->id_usuario)->username;
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'dia',
                'label'=>Yii::t('core', 'Open on'),
                'format'=>'raw',
                'value'=> Yii::t('core', sysconfigs::getNombreDia($model->dia)), // $diaVisita,
            ],
            [
                'attribute'=>'esActivo',
                'label'=>Yii::t('core', 'Active?'),
                'format'=>'raw',
                'value'=>$model->esActivo ?
                    '<span class="label label-success">'.Yii::t('core', sysconfigs::getNombreEsActivo($model->esActivo)) .'</span>' :
                    '<span class="label label-danger">'.Yii::t('core', sysconfigs::getNombreEsActivo($model->esActivo)) .'</span>',
                'widgetOptions'=>[
                    'pluginOptions'=>[
                        'onText'=>'Yes',
                        'offText'=>'No',
                    ]
                ]
            ],
            [
                'attribute'=>'id_usuario',
                'label'=>Yii::t('core', 'User'),
                'format'=>'raw',
                'value'=> $usuario,
            ],        ],
    ]) ?>
    <?php
    if(isset($tieneRecorrido)){
        echo Html::hiddenInput('jsonRequest', $requestRuta,['id'=>'jsonRequest']);
    ?>
    <h2><?= Html::encode(Yii::t('core', 'Schedule')) ?></h2>
    <?php
        $provider = new ArrayDataProvider([
            'allModels' => $datosGrillaPasos,
            'sort' => [
                'attributes' => ['orden','tipo', 'nombre', 'direccion'],
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        echo GridView::widget([
            'dataProvider' => $provider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'orden',
                'tipo',
                'nombre',
                'direccion',
            ],
        ]); ?>



    ?>

        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&signed_in=true&libraries=geometry"></script>
        <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/js/mapaRutas.js"></script>
        <div id="map-canvas" style="height: 500px; width: 100%;border: 1px solid black"></div>
    <?php } ?>



</div>
