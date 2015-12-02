<?php
/**
 * Created by PhpStorm.
 * User: El Perro
 * Date: 29/11/2015
 * Time: 23:57
 */

namespace frontend\controllers;


use backend\models\Producto;
use backend\models\RutaDiaria;
use backend\models\Stock;
use backend\models\Pedido;
use backend\models\User;
use backend\models\Comercio;
use backend\helpers\sysconfigs;
use backend\models\RutaDiariaComercio;
use backend\models\RutaDiariaSearch;
use frontend\controllers\SiteController;
use Yii;

class RutaDiariaController extends SiteController{



    /**
     * Lists all RutaDiaria models.
     * @return mixed
     */
    public function actionRutas()
    {
        $searchModel = new RutaDiariaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('rutas', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {

        $model = $this->findModel($id);

        $comerciosOrdenados = $model->getComerciosOrdenados();
        $usuario = User::findOne($model->id_usuario);
        $comercios = [];
        $datosGrillaPasos = [];
        $datosGrillaPasos[0] = ['orden' => 0, 'tipo' => Yii::t('app', 'User'), 'nombre' => $usuario->username, 'direccion' => $usuario->direccion];
        $i = 0;
        foreach ($comerciosOrdenados as $comercio) {

            $datosGrillaPasos[$i + 1] = ['orden' => $i + 1, 'tipo' => Yii::t('app', 'Store'), 'nombre' => $comercio->nombre, 'direccion' => $comercio->direccion];
            $i++;
        }
        $requestRuta = json_encode(sysconfigs::getRutaRequestParaMostrar($usuario, $comerciosOrdenados));

        return $this->render('view', [
            'model' => $this->findModel($id),
            'requestRuta' => $requestRuta,
            'datosGrillaPasos' => $datosGrillaPasos,
        ]);

    }

    public function stockPedidos($id){

        $datosStock = findStockComercio($id);
        $datosPedidos = $this->findPedidosComercio($id);


        $datosGrillaStock = [];
        $datosGrillaPedidos = [];
        $i = 0;
        foreach ($datosStock as $stock){
            $nombreProducto = nombreProducto($stock->id_producto);
            $datosGrillaStock[$i] = ['tipo' => Yii::t('app', 'Stock'), 'producto'=> $nombreProducto, 'cantidad' => $stock->cantidad];
            $i++;
        }

        $i = 0;
        foreach ($datosPedidos as $pedido){
            $nombrePedido = nombreProducto($pedido->id_producto);
            $datosGrillaPedidos[$i] = ['tipo' => Yii::t('app', 'Order'), 'producto'=> $nombrePedido, 'cantidad' => $pedido->cantidad];
            $i++;
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
            'datosGrillaStock' => $datosGrillaStock,
            'datosGrillaPedidos' => $datosGrillaPedidos,
        ]);

    }

    //Devuelve las rutas_comercio asociadas a una ruta diaria.
    public function findRutasComercio($id)
    {
        if (($models = RutaDiariaComercio::find()->where(['id_ruta_diaria' => $id])->all() !== null)) {
            return $models;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //Devuelve los stocks asociados a una ruta_diaria_comercio
    public function findStockComercio($id){
        if (($models = Stock::find()->where(['id_ruta_diaria_comercio' => $id])->all() !== null)) {
            return $models;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //Devuelve los pedidos asociados a una ruta_diaria_comercio
    public function findPedidosComercio($id)
    {
        if (($models = Pedidos::find()->where(['id_ruta_diaria_comercio' => $id])->all() !== null)) {
            return $models;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function nombreProducto($id){

        if (($resp = Pedidos::find()->where(['id' => $id])->one() !== null)) {
            $nombre = $resp->nombre;
            return $nombre;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModel($id)
    {
        if (($model = RutaDiaria::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}