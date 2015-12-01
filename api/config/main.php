<?php

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),    
    'bootstrap' => ['log'],
    'modules' => [
        'v1' => [
            'basePath' => '@app/modules/v1',
            'class' => 'api\modules\v1\Module'
        ],
        'v2' => [
            'basePath' => '@app/modules/v2',
            'class' => 'api\modules\v2\Module'
        ],
        'oauth2' => [
            'class' => 'filsh\yii2\oauth2server\Module',
            'tokenParamName' => 'accessToken',
            'tokenAccessLifetime' => 3600 * 24, // Value in seconds (3600s -1h- * 24hs, one day)
            //'tokenAllowImplicit' => true,
            'storageMap' => [
                'user_credentials' => 'backend\models\User'
            ],
            'grantTypes' => [
                'client_credentials' => [
                    'class' => 'OAuth2\GrantType\ClientCredentials',
                    'allow_public_clients' => true
                ],
                'user_credentials' => [
                    'class' => 'OAuth2\GrantType\UserCredentials',
                    'public' => true
                ],
                'authorization_code' => [
                    'class' => 'OAuth2\GrantType\AuthorizationCode',
                ],
                'refresh_token' => [
                    'class' => 'OAuth2\GrantType\RefreshToken',
                    'always_issue_new_refresh_token' => true,
                    'refresh_token_lifetime'         => 3600 * 24 * 14 // Value in seconds (3600s -1h- * 24hs * 14days)

                ]
            ],
        ],
    ],
    'components' => [        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableSession' => false,
            //'loginUrl' => null,
        ],
        'request' => [
            'enableCookieValidation' => false,
            'enableCsrfValidation' => false,
            // Enable JSON Input:
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                'HEAD <apiv:v\d+>/<controller:\w+>'              => '<apiv>/<controller>/index',
                'GET <apiv:v\d+>/<controller:\w+>'               => '<apiv>/<controller>/index',
                'HEAD <apiv:v\d+>/<controller:\w+>/<id:(.)+>'    => '<apiv>/<controller>/view',
                'GET <apiv:v\d+>/<controller:\w+>/<id:(.)+>'     => '<apiv>/<controller>/view',
                'POST <apiv:v\d+>/<controller:\w+>/<id:(.)+>'    => '<apiv>/<controller>/create',
                //'POST <apiv:v\d+>/<controller:\w+>'              => '<apiv>/<controller>/create',
                'PUT <apiv:v\d+>/<controller:\w+>/<id:(.)+>'     => '<apiv>/<controller>/update',
                'PATCH <apiv:v\d+>/<controller:\w+>/<id:(.)+>'   => '<apiv>/<controller>/update',
                'DELETE <apiv:v\d+>/<controller:\w+>/<id:(.)+>'  => '<apiv>/<controller>/delete',

                'POST <apiv:v\d+>/login' => '<apiv>/oauth/token',

                'POST <apiv:v\d+>/stock' => '<apiv>/stock/stock',
                'POST <apiv:v\d+>/pedido' => '<apiv>/pedido/pedido',

                //'POST <apiv:v\d+>/stock/relevar-stock-comercio' => '<apiv>/stock/relevar-stock-comercio',
            ]
        ]
    ],
    'params' => $params,
];



