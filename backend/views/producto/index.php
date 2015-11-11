<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
                    $webroot='http://localhost:8080/yii/backend/web/';
                    return Html::img( $webroot . $data['imagen'],
                        ['width' => '50px']);
                },
            ],
            'id_categoria',
            'precio',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
