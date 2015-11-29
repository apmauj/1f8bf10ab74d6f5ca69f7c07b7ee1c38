<?php

namespace api\modules\v2\controllers;

use frontend\models\LoginForm;
use Yii;
use yii\rest\ActiveController;
use yii\web\BadRequestHttpException;

class LoginController extends ActiveController
{
    public $modelClass = 'frontend\models\LoginForm';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate(){
        $params = Yii::$app->request->post();

        $model = Yii::createObject(LoginForm::className());

        $model->load($params);

        if($model->login()){
            //Yii::$app->session->set('user',$model->getAttributes());
            return $model->getAttributes();
        }else{
            throw new BadRequestHttpException('error de login');
        }
    }
}