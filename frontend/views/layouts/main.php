<?php
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\debug\Toolbar;
use yii\helpers\Html;


// You can use the registerAssetBundle function if you'd like
//$this->registerAssetBundle('app');
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

<link rel='stylesheet' type='text/css' href='<?php echo $this->theme->baseUrl; ?>/files/main_style.css' title='wsite-theme-css' />
<?php $this->head(); ?>

</head>
<body class='wsite-theme-dark tall-header-page wsite-page-index weeblypage-index'>
  <?php $this->beginBody(); ?>
<div id="wrapper">
  <div id="container">
    <div id="leftcolumn">
<!--            --><?php //echo Menu::widget(array(
//        'options' => array('class' => 'nav'),
//        'items' => array(
//          array('label' => 'Home', 'url' => array('/site/index')),
//          array('label' => 'About', 'url' => array('/site/about')),
//          array('label' => 'Contact', 'url' => array('/site/contact')),
//          Yii::$app->user->isGuest ?
//            array('label' => 'Login', 'url' => array('/user/login')) :
//            array('label' => 'Logout (' . Yii::$app->user->identity->username .')' ,
//                'url' => array('/user/logout'),
//                'linkOptions' => ['data-method' => 'post']),
//        ),
//      )); ?><!--      -->
        <?php
        NavBar::begin([
            'brandLabel' => Yii::t('app', 'My Company'),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = [
                'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                'url' => [
                    '/site/logout',
                    'linkOptions' => [
                        'data-method' => 'post'
                    ]
                ]
            ];
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>
    </div>
    <div id="rightcolumn">
      <table id="header">
        <tr>
          <td id="logo"><span class='wsite-logo'><a href='/'><span id="wsite-title"><?php echo Html::encode(\Yii::$app->name); ?></span></a></span></td>
          <td id="header-right">
            <table>
              <tr>
                <td class="phone-number"></td>
                <td class="social"></td>
              </tr>
            </table>
            <div class="search"></div>
          </td>
        </tr>
      </table>
      <div id="banner" class="noborder">
        <div class="wsite-header"></div>
        <div class="clear"></div>
      </div>
      <div id="content"><div id='wsite-content' class='wsite-not-footer'>
        <?php echo $content; ?>
</div>
</div>
      <div id="footer"><?php echo Html::encode(\Yii::$app->name); ?>
</div>
    </div>
    <div class="clear"></div>
  </div>
</div>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>