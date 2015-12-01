<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 22/11/2015
 * Time: 1:09
 */

namespace api\modules\v2\controllers;

use yii\rest\ActiveController;
use backend\models\ComercioProductosRelacionados;
use backend\models\Producto;
use backend\models\RutaDiaria;
use Yii;
use yii\helpers\ArrayHelper;
use backend\models\Pedido;
use backend\models\RutaDiariaComercio;
use yii\web\BadRequestHttpException;

class PedidoController extends ActiveController
{
    public $modelClass = 'backend\models\Pedido';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        $actions1 = ArrayHelper::merge(['actionPedido'], $actions);
        return $actions1;
    }

    /**
     * Displays a single RutaDiariaComercio model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    private function findModel($id){
        $listaComercioProductos = ComercioProductosRelacionados::find()->where(['id_comercio'=>$id])->all();
        $listaProductos = [];
        foreach($listaComercioProductos as $comercioProductos){
            $producto = Producto::find()->where(['id'=>$comercioProductos->id_producto])->one();
            $listaProductos[]=$producto;
        }
        return $listaProductos;
    }

    public function actionPedido(){

        $params = Yii::$app->getRequest()->post();

        $arrayProductos = $params['productos'];
        return $params;
        $pedido = new Pedido();
//        $pedido->setAttribute('id_producto',$params['id_producto']);
//        $pedido->setAttribute('cantidad',$params['cantidad']);
        $valid = false;
        foreach ($arrayProductos as $productos){
            $pedido->setAttribute('cantidad',$productos['cant']);
            $pedido->setAttribute('id_producto',$productos['id_producto']);
            $rutaDiaria = RutaDiaria::find()->where(['id_usuario'=>$params['id_usuario']])->andWhere(['fecha'=>date('Y-m-d')])->one();
            $rutaDiariaComercio = RutaDiariaComercio::find()->where(['id_comercio'=>'id_comercio'])->andWhere(['id_ruta_diaria'=>$rutaDiaria->id])->one();
            $pedido->setAttribute('id_ruta_diaria_com',$rutaDiariaComercio->id);
            if ($pedido->validate() && $pedido->save()){
                $valid = true;
            }
            else{
                throw new BadRequestHttpException(Yii::t('mobile','Failed to save route with id: '.$rutaDiariaComercio->id.''));
            }
        }
        return $valid;

//        $rutaDiaria = RutaDiaria::find()->where(['id_usuario'=>$params['id_usuario']])->andWhere(['fecha'=>date('Y-m-d')])->one();
//        $rutaDiariaComercio = RutaDiariaComercio::find()->where(['id_comercio'=>'id_comercio'])->andWhere(['id_ruta_diaria'=>$rutaDiaria->id])->one();
//        $pedido->setAttribute('id_ruta_diaria_com',$rutaDiariaComercio->id);
//
//        if ($pedido->save()){
//            return true;
//        }
//        else{
//            throw new BadRequestHttpException(Yii::t('mobile','Failed to save orders data...'));
//        }
    }
}
