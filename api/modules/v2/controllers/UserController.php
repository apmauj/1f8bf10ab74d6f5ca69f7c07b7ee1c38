<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 1/12/2015
 * Time: 3:38
 */

namespace api\modules\v2\controllers;

use backend\models\User;
use yii\rest\ActiveController;

class UserController extends ActiveController
{
    public $modelClass = 'backend\models\User';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        return $actions;
    }

    public function actionView($id){
       return $user =  User::findIdentityByAccessToken($id);

    }

}