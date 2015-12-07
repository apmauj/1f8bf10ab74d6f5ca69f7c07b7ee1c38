<?php
/**
 * Created by PhpStorm.
 * User: El Perro
 * Date: 06/12/2015
 * Time: 04:19
 */
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use scotthuangzl\googlechart\GoogleChart;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Store-Sales Charts');

?>

<div class="col-sm-5">
    <h2> Store: <?= $nombreTienda ?></h2>
    <h4> <?= Yii::t('app', 'This are the 5 more selled products of this store') ?></h4>
    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?php
    echo GoogleChart::widget(array('visualization' => 'BarChart',
        'data' => array(
            array('Task', 'Hours per Day'),
            array('Work', 5),
            array('Eat', 5),
            array('Commute', 5),
            array('Watch TV', 2),
            array('Sleep', 7)
        ),
        'options' => array('title' => 'My Daily Activity')));

    ?>
    <?php ActiveForm::end(); ?>
</div>
