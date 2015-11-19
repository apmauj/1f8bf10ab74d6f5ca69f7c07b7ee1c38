<?php

use dektrium\user\models\User;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RutaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Rutas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ruta-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ruta'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'dia',
                'label'=>Yii::t("app", "Open?"),
                'format'=>'raw',
                'value' => function ($data) {
                    if ($data->dia == 1) return Yii::t("app", "Monday");
                    if ($data->dia == 2) return Yii::t("app", "Tuesday");
                    if ($data->dia == 3) return Yii::t("app", "Wednesday");
                    if ($data->dia == 4) return Yii::t("app", "Thursday");
                    if ($data->dia == 5) return Yii::t("app", "Friday");
                    if ($data->dia == 6) return Yii::t("app", "Saturday");
                    if ($data->dia == 7) return Yii::t("app", "Sunday");
                    return 0;}
            ],
            [
                'attribute'=>'esActivo',
                'label'=>Yii::t('app', 'Active?'),
                'format'=>'raw',
                'value'=>function ($data) {
                    if ($data->esActivo == 1) return '<span class="label label-success">'.Yii::t("app", "Yes").'</span>';
                    else return '<span class="label label-danger">' . Yii::t("app", "No") . ' </span>';
                },
            ],
            [
                'attribute'=>'id_usuario',
                'label'=>Yii::t('app', 'User'),
                'format'=>'raw',
                'value'=>function ($data) {
                    return $usuario = User::findOne($data->id_usuario)->username;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
