<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdenComercioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Route Order');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orden-comercio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Generate Itinerary'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'orden',
                'label'=>Yii::t('app', 'Name'),

            ],
            [
                'attribute'=>'ruta',
                'label'=>Yii::t('app', 'Route Id'),
                        ],
            [
                'attribute'=>'comercio',
                'label'=>Yii::t('app', 'Store Id'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
