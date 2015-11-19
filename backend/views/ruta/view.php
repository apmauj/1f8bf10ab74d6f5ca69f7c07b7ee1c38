<?php

use dektrium\user\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Ruta */

$this->title = Yii::t('app', 'Route number ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rutas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
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
    $diaVisita = $model->dia;
    $usuario = User::findOne($model->id_usuario)->username;

    if ($diaVisita == 1) $diaVisita = Yii::t("app", "Monday");
    if ($diaVisita == 2) $diaVisita = Yii::t("app", "Tuesday");
    if ($diaVisita == 3) $diaVisita = Yii::t("app", "Wednesday");
    if ($diaVisita == 4) $diaVisita = Yii::t("app", "Thursday");
    if ($diaVisita == 5) $diaVisita = Yii::t("app", "Friday");
    if ($diaVisita == 6) $diaVisita = Yii::t("app", "Saturday");
    if ($diaVisita == 7) $diaVisita = Yii::t("app", "Sunday");

    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'dia',
                'label'=>Yii::t('app', 'Open?'),
                'format'=>'raw',
                'value'=> $diaVisita,
            ],
            [
                'attribute'=>'esActivo',
                'label'=>Yii::t('app', 'Active?'),
                'format'=>'raw',
                'value'=>$model->esActivo ?
                    '<span class="label label-success">'.Yii::t("app", "Yes").'</span>' :
                    '<span class="label label-danger">'.Yii::t("app", "No").'</span>',
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

</div>
