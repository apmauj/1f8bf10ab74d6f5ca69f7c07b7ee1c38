<?php

namespace api\modules\v2\controllers;

use yii\rest\ActiveController;

class LoginController extends ActiveController
{
    public $modelClass = 'backend\models\LoginForm';
	
}