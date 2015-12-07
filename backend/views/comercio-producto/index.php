<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComercioProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core', 'Store Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comercio-producto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('core', 'Create Store Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'fecha',
                'label'=>Yii::t('core', 'Date'),
            ],
            [
                'attribute'=>'vendidos',
                'label'=>Yii::t('core', 'Sold'),
            ],
            'id_comercio',
            'id_producto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
