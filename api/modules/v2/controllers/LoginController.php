<?php

namespace api\modules\v2\controllers;

use dektrium\user\controllers\SecurityController;
use dektrium\user\models\User;
use dektrium\user\models\LoginForm;
use Yii;
use yii\rest\ActiveController;
use yii\web\Response;


class LoginController extends SecurityController //ActiveController
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
        //$this->performAjaxValidation($model);
        $model->login = Yii::$app->getRequest()->post()['login-form']['login'];
        $model->password = Yii::$app->getRequest()->post()['login-form']['password'];
        //$model->user = $this->finder->findUserByUsernameOrEmail($model->login);
        //$model->user = User::find()->where(['username'=>$model->login])->one();
        if ($model->login()) {
            //$user = $this->finder->findUserByUsernameOrEmail($model->login);
            //unset($user['password_hash']);
            //unset($user['auth_key']);
            //return $user;
            return !Yii::$app->user->isGuest;
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