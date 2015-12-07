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
use scotthuangzl\googlechart\GoogleChart;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Charts');

?>

<div class="col-sm-5">
    <h2><?= Yii::t('app', 'Store Charts') ?></h2>
    <?php $form = ActiveForm::begin([ 'action' => ['graficas/comercio-venta'],'method' => 'post']); ?>
        <?php
        $listData=ArrayHelper::map($comercios,'id','nombre');
        echo $form->field($model, 'opcionComercio')->dropDownList($listData,
            [
                'prompt'=>Yii::t('app','Select one...')
            ]);
        ?>
        <input name="boton2" type="image" src="..\img\buttons\PieChart_clean.png" width="160px" height="120px" align="center" alt="Submit Form">
    <?php ActiveForm::end(); ?>
    <br>

    <h2><?= Yii::t('app', 'Relevator Charts') ?></h2>
    <?php $form = ActiveForm::begin([ 'action' => ['graficas/comercio-venta'],'method' => 'post']); ?>
    <?php
        $listData=ArrayHelper::map($relevadores,'id','username');
        echo $form->field($model, 'opcionRelevador')->dropDownList($listData,[
            'prompt'=>Yii::t('app','Select one...')
        ]);
    ?>
        <input name="boton2" type="image" src="..\img\buttons\PieChart_clean.png" width="160px" height="120px" align="center" alt="Submit Form">
    <?php ActiveForm::end(); ?>
    <br>

    <h2><?= Yii::t('app', 'Store-Sales Charts') ?></h2>
    <?php $form = ActiveForm::begin([ 'action' => ['graficas/comercio-venta'],'method' => 'post']); ?>
    <?php
        $listData=ArrayHelper::map($comercios,'id','nombre');
        echo $form->field($model, 'opcionComercio2')->dropDownList($listData,
            [
                'prompt'=>Yii::t('app','Select one...')
            ]);
    ?>
    <input name="boton2" type="image" src="..\img\buttons\PieChart_clean.png" width="160px" height="120px" align="center" alt="Submit Form">

    <?php ActiveForm::end(); ?>


</div>



