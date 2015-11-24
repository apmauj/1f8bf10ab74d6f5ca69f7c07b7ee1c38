<?php
use yii\bootstrap\Nav;
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
//      )); ?>

    <?=
    Nav::widget(
        [
            'encodeLabels' => false,
            'options' => ['class' => 'sidebar-menu'],
            'items' => [
                '<li class="header" style="font-size: large;color: white;text-align: center">Menu</li>',
                ['label' => '<i class="fa fa-users"></i><span>'. Yii::t('app','Routes').'</span>', 'url' => ['/ruta']],
                ['label' => '<i class="fa fa-users"></i><span>'. Yii::t('app','Profile').'</span>', 'url' => ['/user/profile/show','id'=>isset(Yii::$app->user->identity) ? Yii::$app->user->identity->id : -1], 'visible' =>!Yii::$app->user->isGuest],
                ['label' => 'Logout (' ./* Yii::$app->user->identity->username .*/')' ,
                    'url' => ['/user/logout'],
                   // 'linkOptions' => ['data-method' => 'post'],
                ],
            ],
        ]
    );
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