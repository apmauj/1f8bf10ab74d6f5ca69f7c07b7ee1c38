<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 22/11/2015
 * Time: 5:25
 */

namespace api\modules\v2\controllers;

use backend\models\RutaDiaria;
use backend\models\User;
use yii\rest\ActiveController;
use Yii;
use backend\helpers\sysconfigs;
class RutaController extends ActiveController
{
    public $modelClass = 'backend\models\Ruta';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        return $actions;
    }


    public static function actionView($id){
        $user = User::find()->where(['id'=>$id])->one();
        if($user->tieneRutaDiariaActiva()){
            $rutaDiaria = RutaDiaria::find()->where(['id_usuario'=>$user->id])->andWhere(['fecha'=>date('Y-m-d')])->one();
            $comercios = $rutaDiaria->getComerciosOrdenados();
            return ['status'=>'ok','requestJson'=>sysconfigs::getRutaRequestParaMostrar($user,$comercios)];
        }else return ['status'=>'error',"mensaje"=> Yii::t('app','there are no routes for today')];

    }

}