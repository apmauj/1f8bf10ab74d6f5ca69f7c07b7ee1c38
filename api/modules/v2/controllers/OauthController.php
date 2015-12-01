<?php
namespace api\modules\v2\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\Cors;
use filsh\yii2\oauth2server\models\OauthClients;
use filsh\yii2\oauth2server\models\OauthAccessTokens;
use yii\helpers\ArrayHelper;
use filsh\yii2\oauth2server\filters\ErrorToExceptionFilter;

/**
 * Oauth controller
 */
class OauthController extends BaseActiveController
{
    protected $authenticatorExceptions = ['options', 'revoke', 'token'];
    public $modelClass = 'filsh\yii2\oauth2server\models\OauthAccessTokens';

    public function actions()
    {
        return [];
    }

    public function actionOptions()
    {
        if (Yii::$app->getRequest()->getMethod() !== 'OPTIONS') {
            Yii::$app->getResponse()->setStatusCode(405);
        }

        Yii::$app->getResponse()->getHeaders()->set('Allow', implode(', ', ['POST', 'HEAD', 'OPTIONS']));
    }

    public function actionRevoke()
    {
        if (Yii::$app->user->logout()) {
            $token = OauthAccessTokens::find()->where(['access_token' => $this->accessToken])->one();
            if ($token) {
                $token->expires = new \yii\db\Expression('NOW()');
                $token->save();
            }
            return ['success' => true];
        } else {
            Yii::$app->getResponse()->setStatusCode(500);
            return ['success' => false];
        }
    }

    public function actionToken()
    {
        $server = Yii::$app->getModule('oauth2')->getServer();
        $request = Yii::$app->getModule('oauth2')->getRequest();
        $response = $server->handleTokenRequest($request);

        return $response->getParameters();
    }

    public function actionAuthorize()
    {
        $server = Yii::$app->getModule('oauth2')->getServer();
        $request = Yii::$app->getModule('oauth2')->getRequest();
        $response = new \OAuth2\Response();

        // validate the authorize request
        if (!$server->validateAuthorizeRequest($request, $response)) {
            $response->send();
            die();
        }

        if (Yii::$app->request->isPost) {
            // print the authorization code if the user has authorized your client
            $is_authorized = (Yii::$app->request->post('authorized') === 'yes');
            $server->handleAuthorizeRequest($request, $response, $is_authorized, Yii::$app->user->identity->id);
            if (Yii::$app->request->get('test')) {
                // this is only here so that you get to see your code in the cURL request. Otherwise, we'd redirect back to the client
                $code = substr($response->getHttpHeader('Location'), strpos($response->getHttpHeader('Location'), 'code=')+5, 40);
                exit("Result: Authorized. Authorization Code: $code");
            }
            $response->send();
            die();
        }

        // Get client
        $client = OauthClients::findOne([
            'client_id' => Yii::$app->request->get('client_id')
        ]);
        return $this->render('authorize', ['client' => $client]);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return ['error'=>$exception->getMessage()];
        }
    }
}