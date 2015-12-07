<?php
/**
 * Created by PhpStorm.
 * User: El Perro
 * Date: 29/11/2015
 * Time: 23:57
 */

namespace frontend\controllers;


use backend\helpers\sysconfigs;
use backend\models\RutaDiaria;
use backend\models\RutaDiariaComercio;
use backend\models\RutaDiariaSearch;
use backend\models\Stock;
use backend\models\User;
use Yii;

class RutaDiariaController extends SiteController{



    /**
     * Lists all RutaDiaria models.
     * @return mixed
     */
    public function actionRutas($idRelevador)
    {
        $searchModel = new RutaDiariaSearch();
        $searchModel->id_usuario = $idRelevador;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//        $usuario = User::find()->where(['id'=>$idRelevador])->one();
//        $rutasDiariasUsuario = $usuario->getRutasDiarias();
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
        $datosGrillaPasos[0] = ['orden' => 0, 'tipo' => Yii::t('core', 'User'), 'nombre' => $usuario->username, 'direccion' => $usuario->direccion, 'id_ruta_diaria' => $model->id, "id_comercio"=>''];
        $i = 0;
        foreach ($comerciosOrdenados as $comercio) {

            $datosGrillaPasos[$i + 1] = ['orden' => $i + 1, 'tipo' => Yii::t('core', 'Store'), 'nombre' => $comercio->nombre, 'direccion' => $comercio->direccion, 'id_ruta_diaria' => $model->id, "id_comercio"=>$comercio->id];
            $i++;
        }
        $requestRuta = json_encode(sysconfigs::getRutaRequestParaMostrar($usuario, $comerciosOrdenados));

        return $this->render('view', [
            'model' => $this->findModel($id),
            'requestRuta' => $requestRuta,
            'datosGrillaPasos' => $datosGrillaPasos,
        ]);

    }

    protected function findModel($id)
    {
        if (($model = RutaDiaria::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //Devuelve las rutas_comercio asociadas a una ruta diaria.

    public function actionStockPedidos($idComercio,$idRutaDiaria){

        $rutaDiaria = RutaDiaria::find()->where(['id'=>$idRutaDiaria])->one();
        $usuario = User::find()->where(['id'=>$rutaDiaria->id_usuario])->one();
        $rutaDiariaComercio = $this->findRutaDiariaComercio($idComercio,$idRutaDiaria);

        $datosGrillaStock = [];
        $datosGrillaPedidos = [];
        $i = 0;
        if($rutaDiariaComercio->getStocks()->count()>0){
            $datosStock = $this->findStockComercio($rutaDiariaComercio->id);
            foreach ($datosStock as $stock){
                $nombreProducto = nombreProducto($stock->id_producto);
                $datosGrillaStock[$i] = ['tipo' => Yii::t('core', 'Stock'), 'producto'=> $nombreProducto, 'cantidad' => $stock->cantidad];
                $i++;
            }

        }

        $i = 0;
        if($rutaDiariaComercio->getPedidos()->count()>0) {
            $datosPedidos = $this->findPedidosComercio($rutaDiariaComercio->id);
            foreach ($datosPedidos as $pedido) {
                $nombrePedido = nombreProducto($pedido->id_producto);
                $datosGrillaPedidos[$i] = ['tipo' => Yii::t('core', 'Order'), 'producto' => $nombrePedido, 'cantidad' => $pedido->cantidad];
                $i++;
            }
        }
        return $this->render('stockPedidos', [
            'model' => $rutaDiariaComercio,
            'datosGrillaStock' => $datosGrillaStock,
            'datosGrillaPedidos' => $datosGrillaPedidos,
            'fecha' => $rutaDiaria->fecha,
            'usuario' =>$usuario->username,
            'ruta'=>$rutaDiaria->id
        ]);

    }

    //Devuelve las rutas_comercio asociadas a una ruta diaria.

    public function findRutaDiariaComercio($idComercio,$idRutaDiaria)
    {
        return $model = RutaDiariaComercio::find()->where(['id_ruta_diaria' => $idRutaDiaria])->andWhere(['id_comercio'=>$idComercio])->one();

    }

    //Devuelve los stocks asociados a una ruta_diaria_comercio
    public function findStockComercio($id){
        if (($models = Stock::find()->where(['id_ruta_diaria_com' => $id])->all() !== null)) {
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

    public function findRutasComercio($id)
    {
        if (($models = RutaDiariaComercio::find()->where(['id_ruta_diaria' => $id])->all() !== null)) {
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


}