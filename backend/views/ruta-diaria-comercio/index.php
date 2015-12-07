<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RutaDiariaComercioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core', 'Daily Store Route');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ruta-diaria-comercio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('core', 'Create Daily Store Route'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'orden',
                'label'=>Yii::t('core', 'Order'),
            ],
            [
                'attribute'=>'id_ruta_diaria',
                'label'=>Yii::t('core', 'Daily Route Id'),
            ],
            [
                'attribute'=>'id_comercio',
                'label'=>Yii::t('core', 'Store Id'),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
