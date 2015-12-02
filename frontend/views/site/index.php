<?php
/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Muli Relevators');
use yii\helpers\Html;

?>

<div class="site-index">

    <div class="center wow fadeInDown">
        <h2><?= Yii::t('app', 'Welcome Back!');?></h2>
        <p class="lead"><?= Yii::t('app', 'You are now logged into our site.');?></p>
    </div>

    <div class="row" style="margin-left: 100px;">
        <div class="features">
            <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                <div class="feature-wrap">
                    <i><?= Html::a(Yii::t('app', ''), ['ruta-diaria/rutas', 'idRelevador' => Yii::$app->user->identity->getId()], ['class' => 'fa fa-map-marker']) ?></i>
                    <h2><?= Yii::t('app', 'Routes.');?></h2>
                    <h3><?= Yii::t('app', 'Here you can check your daily routes.');?></h3>
                </div>
            </div><!--/.col-md-4-->

            <div class="col-md-4 col-sm-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                <div class="feature-wrap">
                    <i class="fa fa-bar-chart-o" onclick="msg()"></i>
                    <h2><?= Yii::t('app', 'Graphics.');?></h2>
                    <h3><?= Yii::t('app', 'Check shit using beauty graphs.');?></h3>
                </div>
            </div><!--/.col-md-4-->

        </div><!--/.services-->

    </div><!--/.row-->

</div><!--/.container-->

<script>
    function msg(){
        alert("<?= Yii::t('app', "Graph system is under construcion, It's coming on next release!!") ?>");
    }
</script>