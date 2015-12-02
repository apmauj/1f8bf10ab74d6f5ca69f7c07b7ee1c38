<?php
use yii\grid\GridView;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about" style="margin-left: 5%;width: 90%">
    <h1 style="color: black"><?= Yii::t('app', "Route History") ?></h1>

    <h2 style="color: black"><?= Yii::t('app', "Routes along service") ?></h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'fecha',
                'label'=>Yii::t('app', 'Date'),
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view}'],
        ],
    ]); ?>

</div>
