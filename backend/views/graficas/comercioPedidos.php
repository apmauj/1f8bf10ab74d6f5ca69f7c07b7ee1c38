<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 7/12/2015
 * Time: 3:58
 */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use scotthuangzl\googlechart\GoogleChart;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Store-Sales Charts');

$this->params['breadcrumbs'][] = $this->title;

?>


<div class="col-sm-8">
    <h2> <?= Yii::t('app','Store').': '.$nombreTienda ?></h2>
    <h4> <?= Yii::t('app', 'These are the Orders requested for this Store') ?></h4>
    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?php


    echo GoogleChart::widget(array('visualization' => 'BarChart',
        'data' => $arrayPedidos,
//        'data' => array(
//            array('Task', 'Hours per Day'),
//            array('Work', 5),
//            array('Eat', 5),
//            array('Commute', 5),
//            array('Watch TV', 2),
//            array('Sleep', 7)
//        ),
        'options' => array('title' => Yii::t('app','Orders Requested'))));

    ?>
    <?php ActiveForm::end(); ?>
</div>


