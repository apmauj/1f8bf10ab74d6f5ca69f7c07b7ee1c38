<?php
/**
 * Created by PhpStorm.
 * User: El Perro
 * Date: 30/11/2015
 * Time: 03:04
 */
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;

$this->title = Yii::t('core', 'Charts');

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="col-sm-5" style="overflow: scroll" height="400px">
    <h2><?= Yii::t('core', 'Store Sales Charts') ?></h2>
    <?php $form = ActiveForm::begin([ 'action' => ['graficas/comercio-venta'],'method' => 'post']); ?>
        <?php
        $listData=ArrayHelper::map($comercios,'id','nombre');
        echo $form->field($model1, 'opcionComercio')->dropDownList($listData,
            [
                'prompt'=>Yii::t('core','Select one...')
            ]);
        ?>
        <input name="boton2" type="image" src="..\img\buttons\PieChart_clean.png" width="160px" height="120px" align="center" alt="Submit Form">
    <?php ActiveForm::end(); ?>
    <br>

    <h2><?= Yii::t('core', 'Relevator Charts') ?></h2>
    <?php $form = ActiveForm::begin([ 'action' => ['graficas/comercio-venta'],'method' => 'post']); ?>
    <?php
        $listData=ArrayHelper::map($relevadores,'id','username');
        echo $form->field($model1, 'opcionRelevador')->dropDownList($listData,[
            'prompt'=>Yii::t('core', 'Select one...')
        ]);
    ?>
        <input name="boton2" type="image" src="..\img\buttons\PieChart_clean.png" width="160px" height="120px" align="center" alt="Submit Form">
    <?php ActiveForm::end(); ?>
    <br>

    <h2><?= Yii::t('core', 'Store Orders Charts') ?></h2>
    <?php $form = ActiveForm::begin([ 'action' => ['graficas/pedidos-comercio'],'method' => 'post']); ?>
    <?php
        $listData=ArrayHelper::map($comercios,'id','nombre');
        echo $form->field($model2, 'opcionComercio2')->dropDownList($listData,
            [
                'prompt'=>Yii::t('core','Select one...')
            ]);
    ?>
    <p>
            <?= $form->field($model2, 'fechaDesde')->widget(DatePicker::classname(), [
                'dateFormat' => 'yyyy-MM-dd',
                'options'=> ['readonly'=>true],
                ])
            ?>
            <?= $form->field($model2, 'fechaHasta')->widget(DatePicker::classname(), [
                'dateFormat' => 'yyyy-MM-dd',
                'options'=> ['readonly'=>true],
            ])
            ?>

    </p>

    <input name="boton2" type="image" src="..\img\buttons\PieChart_clean.png" width="160px" height="120px" align="center" alt="Submit Form">

    <?php ActiveForm::end(); ?>


</div>



