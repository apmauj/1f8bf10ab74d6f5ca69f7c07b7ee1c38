<?php
return [
    'language' => 'es',//'en',//
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages',
                ],
            ],
        ],

        'authClientCollection' => [
            'class'   => \yii\authclient\Collection::className(),
            'clients' => [
                'google' => [
                    'class'        => 'dektrium\user\clients\Google',
                    'clientId'     => '259324332868-8qpid5o610psfefsr946uof26v6po813.apps.googleusercontent.com',
                    'clientSecret' => 'a25NO-XvNaoTtdZ1vVnjbJyR',
                ],
                'facebook' => [
                    'class'        => 'dektrium\user\clients\Facebook',
                    'clientId'     => '1696107530612303',
                    'clientSecret' => 'a90d0d7c7f9f2166797871ec854f8bf1',
                ],
                'twitter' => [
                    'class'          => 'dektrium\user\clients\Twitter',
                    'consumerKey'    => 'i4SBVlp9sHcmFxtCfbD43egjP',
                    'consumerSecret' => 'iIj5F6wUtjlmj1dDx0xYTBjtZbNiNJF2ArfzKFDF3xsuhKcYaK',
                ],
            ],
        ],

    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            // you will configure your module inside this file
            // or if need different configuration for frontend and backend you may
            // configure in needed configs
        ]
/*    	'gii' => [
		    'class' => 'yii\gii\Module',
		    'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '192.168.178.20'] // adjust this to your needs
		],*/
    ]
];
