<?php

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t('core', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . ' ' . $user->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('core', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $user->id, 'url' => ['view', 'id' => $user->id]];
$this->params['breadcrumbs'][] = Yii::t('core', 'Update');
?>
<div class="user-update">

    <?= $this->render('_form', [
        'user' => $user,
    ]) ?>

</div>
