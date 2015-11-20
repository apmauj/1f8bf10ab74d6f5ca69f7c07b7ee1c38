<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('user', 'Manage user');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', [
    'module' => Yii::$app->getModule('user'),
]) ?>

<?= $this->render('/admin/_menu') ?>

<div class="user-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            [
                'attribute' => 'registration_ip',
                'value' => function ($model) {
                    return $model->registration_ip == null
                        ? '<span class="not-set">' . Yii::t('user', '(not set)') . '</span>'
                        : $model->registration_ip;
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    if (extension_loaded('intl')) {
                        return Yii::t('user', '{0, date, MMMM dd, YYYY HH:mm}', [$model->created_at]);
                    } else {
                        return date('Y-m-d G:i:s', $model->created_at);
                    }
                },
                'filter' => DatePicker::widget([
                    'model'      => $searchModel,
                    'attribute'  => 'created_at',
                    'dateFormat' => 'php:Y-m-d',
                    'options' => [
                        'class' => 'form-control',
                    ],
                ]),
            ],
            [
                'header' => Yii::t('app','Es activo?'),
                'format' => 'raw',
                'value'=> function ($model) {
                    if ($model->esActivo == 1) return '<span class="label label-success">'.Yii::t('app','Si').'</span>';
                    else return '<span class="label label-danger">'.Yii::t('app','No').'</span>';
                },
            ],
            [
                'header' => Yii::t('app','Direccion'),
                'value'=> function ($model) {
                    return $model->direccion==null ?  Yii::t('app','Desconocido') :  $model->direccion;

                },
            ],

//            'password_hash',
//            'auth_key',
            // 'confirmed_at',
            // 'unconfirmed_email:email',
            // 'blocked_at',
            // 'registration_ip',
            // 'created_at',
            // 'updated_at',
            // 'flags',
            // 'latitud',
            // 'longitud',
            // 'direccion',
            // 'esActivo',

            ['class' => 'yii\grid\ActionColumn',
             'template' => '{update} {delete}'],
        ],
    ]); ?>

</div>
