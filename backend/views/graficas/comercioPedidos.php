<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 7/12/2015
 * Time: 3:58
 */
use scotthuangzl\googlechart\GoogleChart;
use yii\widgets\ActiveForm;

$this->title = Yii::t('core', 'Store Sales Charts');

$this->params['breadcrumbs'][] = $this->title;

?>


<div class="col-sm-8">
    <h2> <?= Yii::t('core', 'Store').': '.$nombreTienda ?></h2>
    <h4> <?= Yii::t('core', 'These are the Orders requested for this Store') ?></h4>
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
        'options' => array('title' => Yii::t('core', 'Requested Orders'))));

    ?>
    <?php ActiveForm::end(); ?>
</div>
