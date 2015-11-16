<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComercioProductosRelacionadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Comercio Productos Relacionados');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comercio-productos-relacionados-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Assign Productos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'id_comercio',
                'label'=>'Comercio',
                'format'=>'text',
                'content'=>function($data){
                    return $data->getComercioNombre();
                }
            ],
            [
                'attribute'=>'id_producto',
                'label'=>'Producto',
                'format'=>'text',
                'content'=>function($data){
                    return $data->getProductoNombre();
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
