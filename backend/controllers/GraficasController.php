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
use backend\models\Producto;
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
            $nombreComercio = Comercio::Find()->select('nombre')->where(['id'=>$model->opcionComercio])->one()->nombre;
            $carga = $this->cargarArrayVentas($model->opcionComercio);
            $cargaAdaptadaParaChart= [];
            $cargaAdaptadaParaChart[0]= [Yii::t('app','Product'),Yii::t('app','Units sold')];
            $i=1;
            foreach($carga as $venta){
                $nombreProducto = Producto::Find()->select('nombre')->where(['id'=>$venta['id_producto']])->one()->nombre;
                $cargaAdaptadaParaChart[$i]= [$nombreProducto,$venta['cantidad']];
                $i++;
            }

            return $this->render('comercioVenta', ['model'=>$model, 'nombreTienda'=>$nombreComercio, 'arrayVentas'=>$cargaAdaptadaParaChart]);
        }else{
            Yii::$app->getSession()->setFlash('danger',Yii::t('app','You must select a store to see his most selled products...!'));
            $this->redirect(['index']);
        }
    }

    public function cargarArrayVentas($id){

        $productosDelComercio = ComercioProductosRelacionados::find()->where(['id_comercio'=>$id])->all();
        $ventasGenerales = [];
        $respuesta = [];
        $i = 0;
        foreach($productosDelComercio as $prod){
            $ventas = ComercioProducto::find()->where(['id_producto'=>$prod->id_producto])->all();

            $cantidad = 0;

            foreach($ventas as $venta){
                $cantidad = $cantidad + $venta->vendidos;
            }
            $row = ['id_producto'=>$prod->id_producto,'cantidad'=> $cantidad];
            $ventasGenerales[$prod->id_producto] = $row;
            $i++;
        }

        foreach($ventasGenerales as $venta){
            $respuesta = $this->actualizarMasVendidos($respuesta,$venta);
        }

        return $respuesta;
    }

    private function actualizarMasVendidos($respuesta,$venta){
        if(count($respuesta)<=5){
            $respuesta[$venta['id_producto']]= $venta;
        }else{
            $ventaMenor = null;
            foreach($respuesta as $ventaArray){
                if($ventaMenor == null) $ventaMenor = $ventaArray;
                else if($ventaMenor['cantidad']>$ventaArray['cantidad']) $ventaMenor = $ventaArray;
            }
            if($ventaMenor['cantidad']<$venta['cantidad']){
                unset($respuesta[$ventaMenor['id_producto']]);
                $respuesta[$venta['id_producto']] = $venta;
            }
        }
        return $respuesta;
    }


}