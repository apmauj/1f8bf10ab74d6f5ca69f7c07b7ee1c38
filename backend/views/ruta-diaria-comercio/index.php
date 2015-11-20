<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RutaDiariaComercioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daily Store Route');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ruta-diaria-comercio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Ruta Diaria Comercio'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'orden',
                'label'=>Yii::t('app', 'Order'),
            ],
            [
                'attribute'=>'id_ruta_diaria',
                'label'=>Yii::t('app', 'Daily Route Id'),
            ],
            [
                'attribute'=>'id_comercio',
                'label'=>Yii::t('app', 'Store Id'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
