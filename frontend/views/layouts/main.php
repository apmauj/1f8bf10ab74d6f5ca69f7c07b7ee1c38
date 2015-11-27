<?php
use yii\bootstrap\Nav;
use yii\helpers\Html;

if (Yii::$app->controller->action->id === 'login' && Yii::$app->controller->id === 'mobile') {
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {
    $asset = frontend\assets\AppAsset::register($this);
    $baseUrl = $asset->baseUrl;
    $this->title = Yii::t('app', 'Muli Relevators');
    $modo = Yii::$app->params['devicedetect'];


?>

<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title><?php echo Html::encode($this->title); ?></title>
    <meta property='og:site_name' content='<?php echo Html::encode($this->title); ?>' />
    <meta property='og:title' content='<?php echo Html::encode($this->title); ?>' />
    <meta property='og:description' content='<?php echo Html::encode($this->title); ?>' />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <?php $this->head(); ?>
</head>

<body class="homepage">

    <header id="header">

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><img src="<?=$baseUrl?>/images/mulirelevadores/logo.png" style="height: 180%; width: 130%;" alt="logo"></a>
                </div>
                <h2 style="color: white;margin-left: 150px;"><?php echo $this->title; ?></h2>

                <div class="collapse navbar-collapse navbar-right">
                    <?php if (Yii::$app->user->isGuest == false || $modo["isMobile"]) { ?>

                        <?=
                        Nav::widget([
                            'options' => [
                                'class' => 'nav navbar-nav',
                            ],
                            'items' => [
                                [
                                    'label' => Yii::t('app', 'Home'),
                                    'url' => ['site/index'],
                                ],
                                [
                                    'label' => Yii::t('app', 'Routes'),
                                    'url' => ['site/rutas'],
                                ],
                                [
                                    'label' => Yii::t('app', 'Contact'),
                                    'url' => ['site/contact'],
                                ],
                                [
                                    'label' => Yii::t('app', 'Profile'),
                                    'url' => ['site/profile'],
                                ],
                                [
                                    'label' => Yii::t('app', 'Logout'),
                                    'url' => ['site/logout'],
                                ],
                            ],
                        ]);
                        ?>
                    <?php } ?>
                </div>
            </div>
        </nav>

    </header>

    <?php $this->beginBody(); ?>

    <section id="feature" >
<!--        <div class="container">-->
        <?= $this->render(
            'content.php',
            ['content' => $content,]
        ) ?>

    </section><!--/#feature-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2015 <a target="_blank" href="http://mulirelevadores.com/" title="Home"><?= Yii::t('app', 'Muli Relevators')?></a>. <?= Yii::t('app', 'All Rights Reserved.')?>
                </div>

                <div class="col-sm-6">

                    <?php if (Yii::$app->user->isGuest == false || $modo["isMobile"]) { ?>

                    <?=
                        Nav::widget([
                             'options' => [
                                 'class' => 'pull-right',
                             ],
                             'items' => [
                                 [
                                     'label' => Yii::t('app', 'Home'),
                                     'url' => ['site/index'],
                                 ],
                                 [
                                     'label' => Yii::t('app', 'Contact'),
                                     'url' => ['site/contact'],
                                 ],
                             ],
                         ]);

                    ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <?php $this->endBody(); ?>

</body>
</html>
<?php $this->endPage();

} ?>