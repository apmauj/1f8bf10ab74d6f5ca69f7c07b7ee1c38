<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 22/11/2015
 * Time: 1:21
 */

namespace api\modules\v2\controllers;

use backend\models\ComercioProducto;
use backend\models\ComercioProductosRelacionados;
use backend\models\Pedido;
use backend\models\Producto;
use backend\models\RutaDiaria;
use backend\models\User;
use Yii;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;
use backend\models\Stock;
use backend\models\RutaDiariaComercio;
use yii\web\BadRequestHttpException;

/**
 * StockController implements the CRUD actions for Stock model.
 */
class StockController extends ActiveController
{
    public $modelClass = 'backend\models\Stock';

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        $actions1 = ArrayHelper::merge(['actionStock'], $actions);
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

    public function actionStock(){

        $params = Yii::$app->getRequest()->post();
        $user = User::findIdentityByAccessToken($params['muli_token']);
        $valid = false;
        //return $params;
        $arrayStock = $params['stock'];
        foreach ($arrayStock as $stockEnv){
            $rutaDiaria = RutaDiaria::find()->where(['id_usuario'=>$user->id])->andWhere(['fecha'=>date('Y-m-d')])->one();
            $rutaDiariaComercio = RutaDiariaComercio::find()->where(['id_comercio'=>$params['id_comercio']])->andWhere(['id_ruta_diaria'=>$rutaDiaria->id])->one();
            $stockIdProd = Stock::find()->where(['id_producto'=>$stockEnv['id_producto']])->andWhere(['id_ruta_diaria_com'=>$rutaDiariaComercio->id])->one();

            if ($stockIdProd != null){
                $stock = $stockIdProd;
                $stock->setAttribute('cantidad',$stockEnv['cant']);
            }
            else{
                $stock = new Stock();
                $stock->setAttribute('id_ruta_diaria_com',$rutaDiariaComercio->id);
                $stock->setAttribute('id_producto',$stockEnv['id_producto']);
                $stock->setAttribute('cantidad',$stockEnv['cant']);
            }

            if($stock->cantidad != 0){
                if ($stock->validate()){
                    if ($stockIdProd != null){
                        //es un update del Stock, podemos haber realizado ya el calculo de la venta.
                        $rutaDiariaComercioFecha = RutaDiariaComercio::find()->where('ruta_diaria_comercio.id !='.$rutaDiariaComercio->id)->andWhere('ruta_diaria_comercio.id_ruta_diaria!='.$rutaDiariaComercio->id_ruta_diaria)->andWhere(['ruta_diaria_comercio.id_comercio'=>$rutaDiariaComercio->id_comercio])->joinWith([
                            'idRutaDiaria' => function ($query) {
                                //$query->where('MAX(ruta_diaria.fecha)');
                                $query->groupBy('ruta_diaria.id')->having('MAX(ruta_diaria.fecha)')->orderBy('fecha DESC');
                            }
                        ])->one();
                        $stockAnterior = Stock::find()->where(['id_producto'=>$stock->id_producto])->andWhere(['id_ruta_diaria_com'=>$rutaDiariaComercioFecha->id])->one();
                        $pedidoAnterior = Pedido::find()->where(['id_producto'=>$stock->id_producto])->andWhere(['id_ruta_diaria_com'=>$rutaDiariaComercioFecha->id])->one();

                        if ($stockAnterior != null) {
                            $vendidos = $stockAnterior->cantidad - $stock->cantidad;
                            if($pedidoAnterior != null){
                                $vendidos = $vendidos + $pedidoAnterior->cantidad;
                            }
                            $compraProducto = ComercioProducto::find()->where(['id_comercio'=>$params['id_comercio']])->andWhere(['id_producto'=>$stock->id_producto])->andWhere(['fecha'=>date('Y-m-d')])->one();
                            $compraProducto->setAttribute('vendidos',$vendidos);
                            $compraProducto->save();
                        }
                    }
                    else {
                        $rutaDiariaComercioFecha = RutaDiariaComercio::find()->where('ruta_diaria_comercio.id !='.$rutaDiariaComercio->id)->andWhere('ruta_diaria_comercio.id_ruta_diaria!='.$rutaDiariaComercio->id_ruta_diaria)->andWhere(['ruta_diaria_comercio.id_comercio'=>$rutaDiariaComercio->id_comercio])->joinWith([
                            'idRutaDiaria' => function ($query) {
                                //$query->where('MAX(ruta_diaria.fecha)');
                                $query->groupBy('ruta_diaria.id')->having('MAX(ruta_diaria.fecha)')->orderBy('fecha DESC');
                            }
                        ])->one();
                        if($rutaDiariaComercioFecha!=null) {
                            //return "existe?:".$stock->id_producto;
                            $stockAnterior = Stock::find()->where(['id_producto' => $stock->id_producto])->andWhere(['id_ruta_diaria_com' => $rutaDiariaComercioFecha->id])->one();
                            $pedidoAnterior = Pedido::find()->where(['id_producto' => $stock->id_producto])->andWhere(['id_ruta_diaria_com' => $rutaDiariaComercioFecha->id])->one();

                            if ($stockAnterior != null) {
                                $vendidos = $stockAnterior->cantidad - $stock->cantidad;
                                if ($pedidoAnterior != null) {
                                    $vendidos = $vendidos + $pedidoAnterior->cantidad;
                                }
                                $compraProducto = new ComercioProducto();
                                $compraProducto->setAttribute('vendidos', $vendidos);
                                $compraProducto->setAttribute('id_comercio', $params['id_comercio']);
                                $compraProducto->setAttribute('id_producto', $stock->id_producto);
                                $compraProducto->setAttribute('fecha', date('Y-m-d'));
                                $compraProducto->save();
                            }
                        }
                    }

                    if ($stock->save()){
                        $valid = true;
                    }
                    else{
                        $valid = false;
                    }
                }
                else{
                    throw new BadRequestHttpException(Yii::t('mobile','Failed to save orders data...'));
                }
            }
            else {
                if ($stock->validate()){
                    $valid = true;
                }
                else{
                    throw new BadRequestHttpException(Yii::t('mobile','Failed to save orders data...'));
                }
            }
        }
        return $valid;

    }
}