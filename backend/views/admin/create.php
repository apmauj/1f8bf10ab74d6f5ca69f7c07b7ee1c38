<?php


/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t('core', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('core', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_form', [
        'user' => $user,
    ]) ?>

</div>
