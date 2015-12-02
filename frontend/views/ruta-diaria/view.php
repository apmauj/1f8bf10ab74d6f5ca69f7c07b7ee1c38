<?php
/**
 * Created by PhpStorm.
 * User: El Perro
 * Date: 30/11/2015
 * Time: 03:04
 */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

?>
<div class="site-about">
    <h1><?= Html::encode("View Route Info") ?></h1>

    <h2><?=Html::encode("Route Info") ?></h2>

    <?php
        echo Html::hiddenInput('jsonRequest', $requestRuta,['id'=>'jsonRequest']);
    ?>
    <?php
    $provider = new ArrayDataProvider([
        'allModels' => $datosGrillaPasos,
        'sort' => [
            'attributes' => ['orden','tipo', 'nombre', 'direccion'],
        ],
        'pagination' => [
            'pageSize' => 10,
        ],
    ]);
    echo GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'orden',
            'tipo',
            'nombre',
            'direccion',
        ],

    ]);
    ?>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&signed_in=true&libraries=geometry"></script>
    <script type="text/javascript" src="<?php echo Yii::$app->request->baseUrl; ?>/js/mapaRutas.js"></script>
    <div id="map-canvas" style="height: 500px; width: 100%;border: 1px solid black"></div>

</div>
