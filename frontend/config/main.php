<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);


return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'devicedetect'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['admin'],
            'modelMap' => [
                'User' => 'backend\models\User',
                'LoginForm' => 'frontend\models\LoginForm'
            ],
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
            'enableUnconfirmedLogin' => true,
            'controllerMap' => [
                'security' => [
                    'class' => 'frontend\controllers\user\SeguridadController'

                ],
            ],'mailer' => [
                'sender'                => Yii::t('app', 'taller.2015.tecnologo@gmail.com'), // or ['no-reply@myhost.com' => 'Sender name']
                'welcomeSubject'        => Yii::t('app', 'Welcome'),
                'confirmationSubject'   => Yii::t('app', 'Confirmation'),
                'reconfirmationSubject' => Yii::t('app', 'Email Change'),
                'recoverySubject'       => Yii::t('app', 'Account Recovery'),
            ],
        ],
    ],
    'components' => [
//        'view' => [
//             'theme' => [
//                 'basePath' => '/frontend/themes/janux',
//                 'baseUrl' => '/frontend/themes/janux',
//                 'pathMap' => [
////                    '@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app',
////                     '@dektrium/user/views/security' => [
////                         '@frontend/views/seguridad'
////                     ],
////                     '@dektrium/user/views' => [
////                         '@frontend/themes/views/user'
////                     ]
//                     /*'@app/views' => '/frontend/views/layouts',
//                      'baseUrl'   => '@frontend/themes/in-the-mountains/files' */
//                 ],
//
//             ],
//        ],
        'devicedetect' => [
            'class' => 'alexandernst\devicedetect\DeviceDetect'
        ],
/*        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],*/
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
