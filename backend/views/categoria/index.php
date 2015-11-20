<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'nombre',
                'label'=>Yii::t('app', 'Name'),
            ],
            [
                'attribute'=>'descripcion',
                'label'=>Yii::t('app', 'Description'),
            ],
            [
                'attribute'=>'esActivo',
                'label'=>Yii::t('app', 'Active?'),
                'format'=>'raw',
                'value'=>function ($data) {
                    if ($data->esActivo == 1) return '<span class="label label-success">'.Yii::t("app", "Yes").'</span>';
                    else return '<span class="label label-danger">' . Yii::t("app", "No") . ' </span>';
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
