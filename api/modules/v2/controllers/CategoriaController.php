<?php

namespace api\modules\v2\controllers;

use yii\rest\ActiveController;

/**
 * Categoria Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class CategoriaController extends ActiveController
{
    public $modelClass = 'backend\models\Categoria';


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


