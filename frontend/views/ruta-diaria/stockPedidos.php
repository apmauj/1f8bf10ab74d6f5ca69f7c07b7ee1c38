<?php
/**
 * Created by PhpStorm.
 * User: El Perro
 * Date: 02/12/2015
 * Time: 00:47
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

?>

<div class="site-about">
    <h1><?= Html::encode("Información stock-pedido") ?></h1>
    <h2><?=Html::encode("Date: ").$fecha ?></h2>
    <h2><?=Html::encode("Route: ").$ruta ?></h2>
    <h2><?=Html::encode("User: ").$usuario ?></h2>

    <h3><?=Html::encode("Stock") ?></h3>
    <?php
    $provider1 = new ArrayDataProvider([
        'allModels' => $datosGrillaStock,
        'sort' => [
            'attributes' => ['producto','cantidad'],
        ],
        'pagination' => [
            'pageSize' => 6,
        ],
    ]);
    echo GridView::widget([
        'dataProvider' => $provider1,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cantidad',
            'producto',
        ],

    ]);
    ?>

    <h3><?=Html::encode("Pedido") ?></h3>
    <?php
    $provider2 = new ArrayDataProvider([
        'allModels' => $datosGrillaPedidos,
        'sort' => [
            'attributes' => ['producto','cantidad'],
        ],
        'pagination' => [
            'pageSize' => 6,
        ],
    ]);
    echo GridView::widget([
        'dataProvider' => $provider2,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cantidad',
            'producto',
        ],

    ]);
    ?>


</div>
