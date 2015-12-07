<?php
use yii\bootstrap\Nav;
use yii\helpers\Html;

if ((Yii::$app->controller->action->id === 'login' || Yii::$app->controller->action->id === 'index') && Yii::$app->controller->id === 'mobile') {
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {
    $asset = frontend\assets\AppAsset::register($this);
    $baseUrl = $asset->baseUrl;
    $this->title = Yii::t('core', 'Muli Relevators');
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
                    <?= Html::a('<img src="'. $baseUrl .'/images/mulirelevadores/logo.png" style="height: 100px; width: 130px;" alt="logo">', ['site/index']) ?>
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
                                    'label' => Yii::t('core', 'Home'),
                                    'url' => ['site/index'],
                                ],
                                [
                                    'label' => Yii::t('core', 'Routes'),
                                    'url' => ['ruta-diaria/rutas', 'idRelevador' => Yii::$app->user->identity->getId() ],
                                ],
                                [
                                    'label' => Yii::t('core', 'Contact'),
                                    'url' => ['site/contact'],
                                ],
                                [
                                    'label' => Yii::t('core', 'Profile'),
                                    'url' => ['site/profile'],
                                ],
                                [
                                    'label' => Yii::t('core', 'Logout'),
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
                    &copy; 2015 <a target="_blank" href="http://mulirelevadores.com/" title="Home"><?= Yii::t('core', 'Muli Relevators')?></a>. <?= Yii::t('core', 'All Rights Reserved.')?>
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
                                     'label' => Yii::t('core', 'Home'),
                                     'url' => ['site/index'],
                                 ],
                                 [
                                     'label' => Yii::t('core', 'Contact'),
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