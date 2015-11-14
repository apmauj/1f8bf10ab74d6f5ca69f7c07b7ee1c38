<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Producto */
/* @var $searchModel backend\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Productos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Producto'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            [
                'attribute' => 'imagen',
                'format' => 'html',
                'label' => 'Imagen',
                'value' => function ($data) {
                    $webroot='../../backend/web/';
                    return Html::img( $webroot . $data['imagen'],
                        ['width' => '50px']);
                },
            ],
            [
                'attribute'=>'id_categoria',
                'label'=>'Categoria',
                'format'=>'text',
                'content'=>function($data){
                    return $data->getCategoriaNombre();
                }
            ],
            'precio',
            [
                'attribute'=>'esActivo',
                'label'=>'Producto Activo?',
                'format'=>'raw',
                'value'=>function ($data) {
                    if ($data->esActivo == 1) return '<span class="label label-success">Si</span>';
                    else return '<span class="label label-danger">No</span>';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
