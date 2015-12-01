<?php

namespace api\modules\v2\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\filters\Cors;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;
use filsh\yii2\oauth2server\filters\auth\CompositeAuth;
use yii\rest\ActiveController;
use Yii;
use yii\web\HttpException;

class BaseActiveController extends ActiveController
{
    protected $authenticatorExceptions = ['options'];

    public function beforeAction($event){
        return parent::beforeAction($event);
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge([
            [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => true,
                    'Access-Control-Expose-Headers' => [
                        'Link',
                        'X-Pagination-Current-Page',
                        'X-Pagination-Page-Count',
                        'X-Pagination-Per-Page',
                        'X-Pagination-Total-Count',
                    ]
                ],
            ],
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'except' => $this->authenticatorExceptions,
                'authMethods' => [
                    ['class' => HttpBearerAuth::className()],
                    ['class' => QueryParamAuth::className(), 'tokenParam' => 'accessToken'],
                ]
            ],
            'exceptionFilter' => [
                'class' => ErrorToExceptionFilter::className()
            ],
        ], parent::behaviors());
    }

    /**
     * Returns current OAuthToken
     * @return String Access Token
     */
    public function getAccessToken() {
        $headers = Yii::$app->request->getHeaders();
        $authorization = $headers['authorization'];
        preg_match('/Bearer\s*(.*)/', $authorization, $matches);
        if (!isset($matches[1])) {
            throw new HttpException(400);
        }
        return $matches[1];
    }
}