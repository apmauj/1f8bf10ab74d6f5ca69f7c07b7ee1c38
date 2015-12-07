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
    <h2> <?= Yii::t('core','Relevator').': '.$nombreRelevador ?></h2>
    <h4> <?= Yii::t('core', 'These are the completitude of theroutes for this relevator') ?></h4>
    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?php
    echo GoogleChart::widget(array('visualization' => 'LineChart',
        'data' => $arrayCompletitud,

        'options' => array('title' => Yii::t('core','Accomplishment percentage'))));

    ?>
    <?php ActiveForm::end(); ?>
</div>