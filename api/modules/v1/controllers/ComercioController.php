<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;

/**
 * Comercio Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class ComercioController extends ActiveController
{
    public $modelClass = 'backend\models\Comercio';


	public function behaviors()
	{
	    $behaviors = parent::behaviors();
	    /*$behaviors['authenticator'] = [
	        'class' => HttpBasicAuth::className(),
	        'class' => HttpBearerAuth::className()
	    ];*/

	    return $behaviors;
	}

	/*public function actionLogin(){
		 $model = new LoginForm();
 
	     if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->login()) {
	        return ['access_token' => Yii::$app->user->identity->getAuthKey()];
	     } else {
	        $model->validate();
	        return $model;
	     }
	}*/
}


