<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 22/11/2015
 * Time: 1:21
 */

namespace api\modules\v2\controllers;

use backend\models\ComercioProductosRelacionados;
use backend\models\Producto;
use backend\models\RutaDiaria;
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

        $valid = false;

        $arrayStock = $params['stock'];
        $stock = new Stock();
        foreach ($arrayStock as $stockEnv){

            $stock->setAttribute('cantidad',$stockEnv['cant']);
            $stock->setAttribute('id_producto',$stockEnv['id_producto']);
            $rutaDiaria = RutaDiaria::find()->where(['id_usuario'=>$params['id_usuario']])->andWhere(['fecha'=>date('Y-m-d')])->one();
            $rutaDiariaComercio = RutaDiariaComercio::find()->where(['id_comercio'=>'id_comercio'])->andWhere(['id_ruta_diaria'=>$rutaDiaria->id])->one();
            $stock->setAttribute('id_ruta_diaria_com',$rutaDiariaComercio->id);

            if ($stock->validate() && $stock->save()){
                return true;
            }
            else{
                throw new BadRequestHttpException(Yii::t('mobile','Failed to save orders data...'));
            }
        }
        return $valid;

    }
}