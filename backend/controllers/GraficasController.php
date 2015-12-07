<?php
/**
 * Created by PhpStorm.
 * User: El Perro
 * Date: 02/12/2015
 * Time: 21:15
 */
namespace backend\controllers;

use backend\models\ComercioProducto;
use backend\models\ComercioProductosRelacionados;
use backend\models\GraficasForm;
use backend\models\Comercio;
use backend\models\User;
use Yii;

class GraficasController extends SiteController{

    public function actionIndex()
    {
        $model = new GraficasForm();
        $comercios = $this->chargeStoreArray();
        $relevadores = $this->chargeRelevatorsArray();
        return $this->render('index', ['model'=>$model, 'comercios'=>$comercios, 'relevadores'=>$relevadores]);
    }

    public function chargeStoreArray(){

        $comercios = Comercio::find()->all();
        return $comercios;

    }

    public function chargeRelevatorsArray(){


        $relevadores = Comercio::find()->where(['not in','username','admin']);

        return $relevadores;

    }

    public function actionComercioVenta(){

        $model = new GraficasForm();
        $model->setScenario('storeSells');
        //die(var_dump(Yii::$app->request->post()['orden-ruta-form']));
        $model->load(Yii::$app->request->post());
        $nombreTienda = "Tienda1";

        if($model->opcionComercio != null){
            $carga = cargarArrayVentas($model->opcionComercio);
            return $this->render('comercioVenta', ['model'=>$model, 'nombreTienda'=>$nombreTienda, 'arrayVentas'=>$carga]);
        }else{
            Yii::$app->getSession()->setFlash('danger',Yii::t('app','You must select a store to see his most selled products...!'));
            $this->redirect(['index']);
        }
    }

    public function cargarArrayVentas($id){

        $productosDelComercio = ComercioProductosRelacionados::find()->where(['id_comercio'=>$id])->all();
        $respuesta = [];
        $i = 0;
        foreach($productosDelComercio as $prod){
            $ventas = ComercioProducto::find()->where(['id_producto'=>$prod->id])->all();

            $cantidad = 0;
            foreach($ventas as $venta){
                $cantidad = $cantidad + $venta->vendidos;
            }
            $row = ['id_producto'=>$prod,'cantidad'=> $cantidad];
            $respuesta[$i] = $row;
            $i++;
        }

        return $respuesta;
    }


}