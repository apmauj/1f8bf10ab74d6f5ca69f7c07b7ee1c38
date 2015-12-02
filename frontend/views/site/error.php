<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */
$asset = frontend\assets\AppAsset::register($this);
$baseUrl = $asset->baseUrl;

$this->title = $name;
?>
<style>
    .img404 {
        float: left;
        margin: 0px 50px 10px 10px;
        width: 300px;
        height: 300px;
        overflow: auto;
    }
</style>
<div class="site-error">

    <div class="alert alert-danger" style="color: black; margin-left: 100px;width: 80%">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <br>

    <div style="margin-left: 100px;">
        <div style="color: black;margin-left: 30px;height: 300px;">
            <img class="img404" src="<?=$baseUrl?>/images/mulirelevadores/404.png" alt="ERROR 404">
            <h2 style="margin-left: 100px;width: 60%">
                <br>
                <p><?= Yii::t('app', 'This is Boggy the mysterious unbrained armadillo on the server...'); ?></p>
                <br>
                <p><?= Yii::t('app', 'Looks like he messed something while the Web server was processing your request.'); ?></p>
                <br>
                <p><?= Yii::t('app', 'Please contact us if you think this is a server error.'); ?></p>
                <br>
                <p><?= Yii::t('app', 'Thank you.'); ?></p>
            </h2>
        </div>
    </div>

</div>
