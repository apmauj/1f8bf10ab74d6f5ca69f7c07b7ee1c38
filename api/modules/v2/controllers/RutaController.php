<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 22/11/2015
 * Time: 5:25
 */

namespace api\modules\v2\controllers;

use backend\helpers\sysconfigs;
use backend\models\RutaDiaria;
use backend\models\User;
use Yii;
use yii\rest\ActiveController;

class RutaController extends ActiveController
{
    public $modelClass = 'backend\models\Ruta';

    public static function actionView($id){
        $user = User::findIdentityByAccessToken($id);//find()->where(['id'=>$id])->one();
        if($user->tieneRutaDiariaActiva()){
            $rutaDiaria = RutaDiaria::find()->where(['id_usuario'=>$user->id])->andWhere(['fecha'=>date('Y-m-d')])->one();
            $comercios = $rutaDiaria->getComerciosOrdenados();
            return ['status'=>'ok','requestJson'=>sysconfigs::getRutaRequestParaMostrar($user,$comercios)];
        }else return ['status'=>'error',"mensaje"=> Yii::t('core','there are no routes for today')];

    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        return $actions;
    }

}