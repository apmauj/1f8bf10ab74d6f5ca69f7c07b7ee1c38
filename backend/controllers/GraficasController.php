<?php
/**
 * Created by PhpStorm.
 * User: El Perro
 * Date: 02/12/2015
 * Time: 21:15
 */
namespace backend\controllers;

use backend\models\Comercio;
use backend\models\ComercioProducto;
use backend\models\ComercioProductosRelacionados;
use backend\models\GraficasForm;
use backend\models\Pedido;
use backend\models\Producto;
use backend\models\RutaDiaria;
use backend\models\RutaDiariaComercio;
use backend\models\User;
use Yii;

class GraficasController extends SiteController{

    public function actionIndex()
    {
        $model1 = new GraficasForm();
        $model1->setScenario('storeSells');
        $model2= new GraficasForm();
        $model2->setScenario('storeOrders');
        $model3= new GraficasForm();
        $model3->setScenario('relevatorSuccess');
        $comercios = $this->chargeStoreArray();
        $relevadores = $this->chargeRelevatorsArray();
        return $this->render('index', ['model1'=>$model1,'model2'=>$model2, 'model3'=>$model3, 'comercios'=>$comercios, 'relevadores'=>$relevadores]);
    }

    public function chargeStoreArray(){

        $comercios = Comercio::find()->all();
        return $comercios;

    }

    public function chargeRelevatorsArray(){


        $relevadores = User::find()->where(['not in','username','admin'])->all();
        //die("lalaal ".count($relevadores));
        return $relevadores;

    }

    //////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////
    ////////////// Grafica Productos mas Vendidos ////////////////////
    //////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////

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
            $cargaAdaptadaParaChart[0]= [Yii::t('core','Product'),Yii::t('core', 'Units sold')];
            $i=1;
            foreach($carga as $venta){
                $nombreProducto = Producto::Find()->select('nombre')->where(['id'=>$venta['id_producto']])->one()->nombre;
                $cargaAdaptadaParaChart[$i]= [$nombreProducto,$venta['cantidad']];
                $i++;
            }
            return $this->render('comercioVenta', ['model'=>$model, 'nombreTienda'=>$nombreComercio, 'arrayVentas'=>$cargaAdaptadaParaChart]);
        }else{
            Yii::$app->getSession()->setFlash('danger',Yii::t('core', 'You must select a store to see it\'s best seller products...!'));
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
        if(count($respuesta)<5){
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

    //////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////
    //////// Grafica Pedidos entre dos fechas por Comercio  //////////
    //////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////

    public function actionPedidosComercio(){

        $model = new GraficasForm();
        $model->setScenario('storeOrders');
        //die(var_dump(Yii::$app->request->post()['orden-ruta-form']));
        $model->load(Yii::$app->request->post());
        $nombreTienda = "Tienda1";

        $nombreComercio = Comercio::Find()->select('nombre')->where(['id'=>$model->opcionComercio2])->one()->nombre;
        $carga = $this->cargarArrayPedidos($model->opcionComercio2,$model->fechaDesde,$model->fechaHasta);
        $cargaAdaptadaParaChart= [];
        $cargaAdaptadaParaChart[0]= [Yii::t('core', 'Order'),Yii::t('core', 'Units Ordered')];
        $i=1;
        foreach($carga as $comercioPedido){
            //$nombreProducto = Producto::Find()->select('nombre')->where(['id'=>$venta['id_producto']])->one()->nombre;
            $cargaAdaptadaParaChart[$i]= [$comercioPedido['nombre'],$comercioPedido['cantidad']];
            $i++;
        }
        if(count($cargaAdaptadaParaChart)>1){
            return $this->render('comercioPedidos', ['nombreTienda'=>$nombreComercio, 'arrayPedidos'=>$cargaAdaptadaParaChart]);
        }else{
            Yii::$app->getSession()->setFlash('danger',Yii::t('core', 'There are no orders for selected store'));
            $this->redirect(['index']);

        }
    }

    private function cargarArrayPedidos($idComercio,$fechaDesde,$fechaHasta){
        $respuesta = [];
        $queryRutaDiaria = RutaDiaria::find()->select('id')->where(['between', 'fecha', $fechaDesde, $fechaHasta]);
        $queryRutaDiariaCom = RutaDiariaComercio::find()->where(['ruta_diaria_comercio.id_comercio'=>$idComercio])->andWhere(['in','id_ruta_diaria',$queryRutaDiaria]);
        if($queryRutaDiariaCom->count()>0){
            $rutaDiariaComercios = $queryRutaDiariaCom->all();
            $pedidos = [];
            $i=0;
            foreach($rutaDiariaComercios as $rutaDiariaComercio){
                if(Pedido::find()->where(['id_ruta_diaria_com'=>$rutaDiariaComercio->id])->count()>0){
                    $pedidosRutaDiariaComercio = Pedido::find()->where(['id_ruta_diaria_com'=>$rutaDiariaComercio->id])->all();
                    foreach ($pedidosRutaDiariaComercio as $pedido) {
                        $pedidos[$i] = $pedido;
                        $i++;
                    }
                }
            }
            if(count($pedidos)>0){
                foreach($pedidos as $pedido){
                    if(isset($respuesta[$pedido->id_producto])){
                        $respuesta[$pedido->id_producto]['cantidad'] = $respuesta[$pedido->id_producto]['cantidad'] + $pedido->cantidad;
                    }else{
                        $nombreProducto = Producto::Find()->select('nombre')->where(['id'=>$pedido->id_producto])->one()->nombre;
                        $respuesta[$pedido->id_producto] = ['nombre'=>$nombreProducto,'cantidad'=>$pedido->cantidad];
                    }
                }
            }

        }
        return $respuesta;

    }

    public function actionRutasRelevadores(){

        $model = new GraficasForm();
        $model->setScenario('relevatorSuccess');

        $model->load(Yii::$app->request->post());
        $idRelevador = $model->opcionRelevador;
        $relevador = User::Find()->where(['id'=>$model->opcionRelevador])->one();
        $cargaAdaptadaParaChart= [];
        $cargaAdaptadaParaChart[0]= [Yii::t('core','Date'),Yii::t('core','Accomplishment percentage')];
        //die(''. $idRelevador);
        $rutas = RutaDiaria::find()->where(['id_usuario'=>$idRelevador])->all();
        //die('Hay rutas: '.count($rutas));
        $i = 1;
        foreach($rutas as $ruta){
            $cargaAdaptadaParaChart[$i]= [$ruta->fecha,$ruta->getCompletitudRecorrido()];
            $i++;
        }

        if(count($cargaAdaptadaParaChart)>1){
            return $this->render('rutasRelevador', ['nombreRelevador'=>$relevador->username, 'arrayCompletitud'=>$cargaAdaptadaParaChart]);
        }else{
            Yii::$app->getSession()->setFlash('danger',Yii::t('core','There are no routes for this relevator'));
            $this->redirect(['index']);
        }

    }


}