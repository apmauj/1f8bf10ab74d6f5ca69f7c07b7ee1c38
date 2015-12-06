<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComercioProductosRelacionadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Store Related Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comercio-productos-relacionados-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Assign Products'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'id_comercio',
                'label'=>Yii::t('app', 'Store'),
                'format'=>'text',
                'content'=>function($data){
                    return $data->getComercioNombre();
                }
            ],
            [
                'attribute'=>'id_producto',
                'label'=>Yii::t('app', 'Product'),
                'format'=>'text',
                'content'=>function($data){
                    return $data->getProductoNombre();
                }
            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}'],
        ],
    ]); ?>

</div>
