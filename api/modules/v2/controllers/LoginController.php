<?php

namespace api\modules\v2\controllers;

use dektrium\user\controllers\SecurityController;
use frontend\models\LoginForm;
use Yii;
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