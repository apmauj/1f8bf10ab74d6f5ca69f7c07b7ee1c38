<?php

use backend\helpers\sysconfigs;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Producto */
/* @var $searchModel backend\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('core', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('core', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'nombre',
                'label' => Yii::t('core', 'Name'),
            ],
            [
                'attribute' => 'imagen',
                'format' => 'html',
                'label' => Yii::t('core', 'Image'),
                'value' => function ($data) {
                    $webroot='../../backend/web/';
                    return Html::img( $webroot . $data['imagen'],
                        ['width' => '50px']);
                },
            ],
            [
                'attribute'=>'id_categoria',
                'label'=>Yii::t('core', 'Category'),
                'format'=>'text',
                'content'=>function($data){
                    return $data->getCategoriaNombre();
                }
            ],
            [
                'attribute'=>'precio',
                'label'=>Yii::t('core', 'Price'),
            ],
            [
                'attribute'=>'esActivo',
                'label'=>Yii::t('core', 'Active?'),
                'format'=>'raw',
                'value'=>function ($data) {
                    if ($data->esActivo == 0)
                        return '<span class="label label-danger">'.Yii::t('core', sysconfigs::getNombreEsActivo($data->esActivo)).'</span>';
                    else
                        return '<span class="label label-success">'.Yii::t('core', sysconfigs::getNombreEsActivo($data->esActivo)).'</span>';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
