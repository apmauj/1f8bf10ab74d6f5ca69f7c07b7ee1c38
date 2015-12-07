<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
         'user' => [
                'class' => 'dektrium\user\Module',
                'admins' => ['admin'],
                'enableUnconfirmedLogin' => true,
                'enableGeneratingPassword' => true,
                'as backend' => 'dektrium\user\filters\BackendFilter',
                'controllerMap' => [
                    'admin' => [
                        'class' => 'backend\controllers\user\AdminController'

                    ],
                ],
                'mailer' => [
                    'sender'                => Yii::t('core', 'taller.2015.tecnologo@gmail.com'), // or ['no-reply@myhost.com' => 'Sender name']
                    'welcomeSubject'        => Yii::t('core', 'Welcome'),
                    'confirmationSubject'   => Yii::t('core', 'Confirmation'),
                    'reconfirmationSubject' => Yii::t('core', 'Email Change'),
                    'recoverySubject'       => Yii::t('core', 'Account Recovery'),
                ],
         ],

    ],
    'components' => [
        /*'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],*/
/*        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
        ],*/
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@backend/views' => [
                        '@backend/themes/views',
                    ],
                    '@dektrium/user/views/admin' => [
                        '@backend/views/admin'
                    ],
                    '@dektrium/user/views/security' => [
                        '@backend/views/seguridad'
                    ],
                    '@dektrium/user/views' => [
                        '@frontend/themes/views/user'
                    ]
                ]
            ]
        ],
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-green',
                ],
            ],
        ],
        /*'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'providers'],
            ],
        ],*/
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
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
