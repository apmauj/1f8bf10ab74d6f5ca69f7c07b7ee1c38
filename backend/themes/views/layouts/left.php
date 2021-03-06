<?php
use yii\bootstrap\Nav;

$profile = isset(Yii::$app->user->identity->profile) ? Yii::$app->user->identity->profile : null;

if (isset(Yii::$app->user->identity)) :
?>
<aside class="main-sidebar">

    <section class="sidebar">
        
        <?php if (!Yii::$app->user->getIsGuest()) :?>
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="http://gravatar.com/avatar/<?= isset($profile) ? $profile->gravatar_id : -1 ?>?s=160" class="img-circle" alt="User Image"/>
                </div>
                <div class="pull-left info">
                    <p><?php if (!Yii::$app->user->getIsGuest()) echo Yii::$app->user->identity->username; ?></p>

                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                  </span>
                </div>
            </form>
        <!-- /.search form -->
        <?php endif; ?>

        <?=        
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => '<i class="fa fa-users"></i><span>'. Yii::t('core','Categories').'</span>', 'url' => ['/categoria']],
                    ['label' => '<i class="fa fa-users"></i><span>'. Yii::t('core','Stores').'</span>', 'url' => ['/comercio']],
                    ['label' => '<i class="fa fa-users"></i><span>'. Yii::t('core','Store Products').'</span>', 'url' => ['/comercio-productos-relacionados']],
                    ['label' => '<i class="fa fa-users"></i><span>'. Yii::t('core','Products').'</span>', 'url' => ['/producto']],
                    ['label' => '<i class="fa fa-users"></i><span>'. Yii::t('core','Routes').'</span>', 'url' => ['/ruta']],
                    ['label' => '<i class="fa fa-users"></i><span>'. Yii::t('core','Manage Users').'</span>', 'url' => ['/user/admin']],
                    ['label' => '<i class="fa fa-users"></i><span>'. Yii::t('core','Graphics').'</span>', 'url' => ['/graficas']],
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Gii</span>', 'url' => ['/gii']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Debug</span>', 'url' => ['/debug']],
                ],
            ]
        );
        ?>

<!--        <ul class="sidebar-menu">-->
<!--            <li class="treeview">-->
<!--                <a href="#">-->
<!--                    <i class="fa fa-share"></i> <span>Same tools</span>-->
<!--                    <i class="fa fa-angle-left pull-right"></i>-->
<!--                </a>-->
<!--                <ul class="treeview-menu">-->
<!--                    <li><a href="--><?//= \yii\helpers\Url::to(['/gii']) ?><!--"><span class="fa fa-file-code-o"></span> Gii</a>-->
<!--                    </li>-->
<!--                    <li><a href="--><?//= \yii\helpers\Url::to(['/debug']) ?><!--"><span class="fa fa-dashboard"></span> Debug</a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>-->
<!--                        <ul class="treeview-menu">-->
<!--                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>-->
<!--                            <li>-->
<!--                                <a href="#">-->
<!--                                    <i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i>-->
<!--                                </a>-->
<!--                                <ul class="treeview-menu">-->
<!--                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>-->
<!--                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>-->
<!--                                </ul>-->
<!--                            </li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
<!--        </ul>-->

    </section>

</aside>
<?php endif; ?>