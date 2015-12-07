<?php

namespace api\modules\v2\controllers;

use backend\models\RutaDiaria;
use backend\models\User;
use Yii;
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
	    
	    return $behaviors;
	}

	public function actions()
	{
		$actions = parent::actions();
		unset($actions['view']);
		return $actions;
	}

	public function actionView($id){
		$user = User::findIdentityByAccessToken($id);//->where(['id'=>$id])->one();
		if($user->tieneRutaDiariaActiva()){
			$rutaDiaria = RutaDiaria::find()->where(['id_usuario'=>$user->id])->andWhere(['fecha'=>date('Y-m-d')])->one();
			$comercios = $rutaDiaria->getComerciosOrdenados();
			return ['status'=>'ok','data'=>$comercios];
		}else return ['status'=>'error',"mensaje"=> Yii::t('core','there are no stores available for today')];

	}
}


