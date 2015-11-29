<?php

namespace api\modules\v2\controllers;

use frontend\models\LoginForm;
use Yii;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;

use dektrium\user\controllers\SecurityController;
use dektrium\user\Finder;
use dektrium\user\models\Account;
use dektrium\user\models\User;
use dektrium\user\Module;
use dektrium\user\traits\AjaxValidationTrait;
use yii\authclient\AuthAction;
use yii\authclient\ClientInterface;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;


class LoginController extends SecurityController
{
   // public $modelClass = 'frontend\models\LoginForm';

//    public function actions()
//    {
//        $actions = parent::actions();
//        unset($actions['create']);
//        return $actions;
//    }

    public function actions()
    {
        $actions = parent::actions();
        return $actions;
    }



    public function actionLogin(){
        \Yii::$app->response->format = Response::FORMAT_JSON;
        /** @var LoginForm $model */
        $model = Yii::createObject(LoginForm::className());
        $model->rememberMe = 0;
        $this->performAjaxValidation($model);
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            $user = $this->finder->findUserByUsernameOrEmail($model->login);
            unset($user['password_hash']);
            unset($user['auth_key']);
            return $user;
        }
        return false;
    }
//
//    public function actionCreate(){
//        $params = Yii::$app->request->post();
//
//        $model = Yii::createObject(LoginForm::className());
//
//        $model->load($params);
//
//        if($model->login()){
//            //Yii::$app->session->set('user',$model->getAttributes());
//            return $model->getAttributes();
//        }else{
//            throw new BadRequestHttpException('error de login');
//        }
//    }
}