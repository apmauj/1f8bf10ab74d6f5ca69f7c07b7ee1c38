<?php

namespace backend\controllers;

use backend\helpers\sysconfigs;
use backend\models\Comercio;
use backend\models\OrdenRutaForm;
use backend\models\User;
use backend\models\Ruta;
use backend\models\OrdenComercio;
use backend\models\OrdenComercioSearch;
use Yii;
use yii\db\Query;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;
/**
 * OrdenComercioController implements the CRUD actions for OrdenComercio model.
 */
class OrdenComercioController extends SiteController
{

    public function actions()
    {
        return ArrayHelper::merge(['generarRutaAuto'], parent::actions());
    }



    /**
     * Lists all OrdenComercio models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrdenComercioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrdenComercio model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the OrdenComercio model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrdenComercio the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrdenComercio::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new OrdenComercio model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrdenComercio();
        //$comercios = $this->comerciosSinRutasActivas();
        $inicio = new User();
        $inicio->latitud = -34.895247;
        $inicio->longitud = -56.172498;
        $inicio->username = "DonDog";

        $come1 = new User();
        $come1->latitud = -34.524391;
        $come1->longitud = -56.269235;
        $come1->username = "Canelones";

        $come2 = new User();
        $come2->latitud = -34.333339;
        $come2->longitud = -56.733043;
        $come2->username = "san_jose";

        $come3 = new User();
        $come3->latitud = -34.716018;
        $come3->longitud = -56.219623;
        $come3->username = "las_piedras";

        $come4 = new User();
        $come4->latitud = -34.839392;
        $come4->longitud = -56.031976;
        $come4->username = "aeropuerto";

        $come5 = new User();
        $come5->latitud = -34.097349;
        $come5->longitud = -56.217163;
        $come5->username = "florida";


        $comercios = [$come1, $come2, $come3, $come4, $come5];


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', ['model' => $model, 'comercios' => $comercios, 'inicio' => $inicio]);
        }
    }

    public function actionGenerarRutaAuto($idRuta,$idRelevador,$dia){

        $resultado = $this->obtenerRuta($dia,$idRelevador);
        $usuario = User::findOne($idRelevador);
        $model = new OrdenRutaForm();
        $model->dia = $dia;
        $model->idUsuario = $usuario->id;
        $model->username = $usuario->username;
        $model->idRuta = $idRuta;
        $model->jsonRuta = json_encode($resultado['jsonRuta']);
        $model->jsonRequestRuta = json_encode($resultado['jsonRequest']);
        //die("jsonRequest:".$model->jsonRequestRuta);
        return $this->render('rutaAuto', ['model' => $model]);

    }

    public function relevador(){

    }

    /**
     * Updates an existing OrdenComercio model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OrdenComercio model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function comerciosPorDiaSinRutasActivas($dia){

        //ruta: las rutas creadas
        //orden_comercio
        //comercio

        //Devuelve todas las rutas activas
        //$query = new Query();
        $query =Ruta::find()->select('id')->where(['esActivo'=>"1"]);

        //Devuelve los comercios en rutas activas
        //$query2 = new Query();
        $query2= OrdenComercio::find()->select('id_comercio')->where(['in','id_ruta',$query]);

        //Devuelve los comercios sin rutas activas
        //$comercios = [];
        $comercios = Comercio::find()->where(['not in','id',$query2])->andWhere(['dia'=>$dia])->andWhere(['esActivo'=>'1'])->all();

        return $comercios;
    }


    /**
     * Retorna los comercios que cumplan los siguientes requisitos:
     * -El comercio es activo
     * -El comercio no pertenece a una ruta activa
     * -El dia del comercio es el pasado por parametro
     * -El comercio esta en el radio del usuario con el id pasado por parametro
     * @param $dia : numero del dia elegido, donde 1 es Lunes y 7 es Domingo
     * @param $idUsuario
     */
    public function obtenerComerciosDisponiblesUsuario($dia, $usuario){

        $comercios = $this->comerciosPorDiaSinRutasActivas($dia);
        $comerciosValidos = [];
        $coordenadasUsuario = ['latitud'=>$usuario->latitud,'longitud'=>$usuario->longitud];
        $i=0;
        foreach($comercios as $comercio){
            $i++;
            $coordenadasComercio = ['latitud'=>$comercio->latitud,'longitud'=>$comercio->longitud];
            $distanciaUsuarioComercio = sysconfigs::getDistanciaEntreCoordenadas($coordenadasUsuario,$coordenadasComercio);
            if($distanciaUsuarioComercio<=sysconfigs::RADIO_RELEVADOR){
                $comerciosValidos[$comercio->id] = $comercio;
            }
        }
        return $comerciosValidos;
    }

    private function obtenerRuta($dia,$idUsuario){
        $usuario = User::findOne($idUsuario);
        $comerciosValidos = $this->obtenerComerciosDisponiblesUsuario($dia,$usuario);
        return $this->calcularRuta($usuario,$comerciosValidos);

    }

    private function calcularRuta($usuario,$comerciosValidos){
        //obtenemos las coordenadas del usuario (punto de partida en la ruta) y los comercios.
        $coordenadasUsuario = ['latitud'=>$usuario->latitud,'longitud'=>$usuario->longitud];
        $latitudModificada= $usuario->latitud + 0.000100;
        $longitudModificada= $usuario->longitud + 0.000100;
        //$coordenadasUsuarioMod = ['latitud'=>$latitudModificada,'longitud'=>$longitudModificada];
        $coordenadasComercios = $this->obtenerCoordenadasComercios($comerciosValidos);
        $request = ['origin'=>['lat'=>$coordenadasUsuario['latitud'],'lng'=>$coordenadasUsuario['longitud']],'travelMode'=>'walking'];
        $comerciosOrdenados=[];
        //si tenemos mas de un comercio armamos la ruta con waypoints...
        if(count($comerciosValidos)>1){

            //armamos la primera url que nos ordena los comercios, de ahi sacamos el ultimo. En esta instancia el user es origen y destino.
            $comerciosIndexados = [];
            $url1 = "https://maps.googleapis.com/maps/api/directions/json?origin=".$coordenadasUsuario['latitud'].",".$coordenadasUsuario['longitud']."&destination=".$coordenadasUsuario['latitud'].",".$coordenadasUsuario['longitud']."&key=".sysconfigs::API_KEY_GMAPS_RUTAS."&mode=walking&waypoints=optimize:true";
            $i=0;
            //guardamos los comercios por el indice en el cual se agrego en los waypoints.
            foreach($coordenadasComercios as $idComercio => $coordenadasComercio){
                $comercio = Comercio::findOne($idComercio);
                $url1 = $url1.'|'.$coordenadasComercio['latitud'].','.$coordenadasComercio['longitud'];
                $comerciosIndexados[$i] = $comercio;
                $i++;
            }
            $response = file_get_contents($url1);
            $json1 = json_decode($response,true);
            if($json1['status']=='OK'){
                //obtenemos los waypoints ordenados y armamos la ruta desde el user hasta el ultimo waypoint recibido
                $ordenComercios = $json1['routes'][0]['waypoint_order'];
                $comercioDestino = $comerciosIndexados[end($ordenComercios)];
                $url2 = "https://maps.googleapis.com/maps/api/directions/json?origin=".$coordenadasUsuario['latitud'].",".$coordenadasUsuario['longitud']."&destination=".$comercioDestino->latitud.",".$comercioDestino->longitud."&key=".sysconfigs::API_KEY_GMAPS_RUTAS."&mode=walking&waypoints=optimize:true";;
                foreach($coordenadasComercios as $idComercio => $coordenadasComercio){
                    if($idComercio != $comercioDestino->id){
                        $url2 = $url2.'|'.$coordenadasComercio['latitud'].','.$coordenadasComercio['longitud'];
                    }
                }
                $response = file_get_contents($url2);
                $json2 = json_decode($response,true);
                if($json2['status']=='OK') {
                    $distancia = 0;
                    //calculamos la distancia total de la ruta.
                    $legs = $json2['routes'][0]['legs'];
                    foreach($legs as $leg){
                        $distancia = $distancia + $leg['distance']['value'];
                    }
                    if($distancia <= sysconfigs::DISTANCIA_RELEVADOR){

                        $request['destination'] = ['lat'=>$comercioDestino->latitud,'lng'=>$comercioDestino->longitud];
                        $request['optimizeWaypoints'] = true;
                        $ordenComercios = $json1['routes'][0]['waypoint_order'];
                        die("ordenComercios:".var_dump($ordenComercios));
                        $request['waypoints'] =[];


                        return $json2;
                    }else{
                        //desechamos uno de los comercios con menor prioridad que este lo mas cerca del final del recorrido.
                        $keyComercio = null;
                        $comercioDesechable = null;
                        foreach($comerciosIndexados as $key => $comercio){
                            if($keyComercio == null){
                                $keyComercio= $key;
                                $comercioDesechable = $comercio;
                            }
                            else if($comercio->prioridad >= $comercio->prioridad){
                                $keyComercio = $key;
                                $comercioDesechable = $comercio;
                            }
                        }
                        unset($comerciosIndexados[$keyComercio]);
                        return $this->calcularRuta($usuario,$comerciosIndexados);
                    }

                }else{
                    //algo fallo!
                    return false;
                }
            }else{
                return false;
            }
        }else{
            //tenemos solo un comercio, por tanto la ruta generada es solo entre el usuario y el comercio.
            foreach($coordenadasComercios as $coordenadasComercio) {
                $url3 = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $coordenadasUsuario['latitud'] . "," . $coordenadasUsuario['longitud'] . "&destination=" . $coordenadasComercio['latitud'] . "," . $coordenadasComercio['longitud'] . "&key=".sysconfigs::API_KEY_GMAPS_RUTAS."&mode=walking";
                $response = file_get_contents($url3);
                $json3 = json_decode($response, true);
                if ($json3['status'] == 'OK') {
                    //vemos si la ruta generada no se pasa de la distancia
                    $distancia = 0;
                    //calculamos la distancia total de la ruta.
                    $legs = $json3['routes'][0]['legs'];
                    foreach ($legs as $leg) {
                        $distancia = $distancia + $leg['distance']['value'];
                    }
                    if ($distancia <= sysconfigs::DISTANCIA_RELEVADOR) {
                        $request['destination'] = ['lat'=>$coordenadasComercio['latitud'],'lng'=>$coordenadasComercio['longitud']];
                        return ['jsonRuta'=>$json3,'jsonRequest'=>$request];
                    } else {
                        //no se puede generar una ruta cumpliendo las reglas, por tanto se retorna false
                        return false;
                    }

                } else {
                    return false;
                }
            }
        }

    }


    /** Obtenemos un array que lleva como clave el id del comercio y como elemento un array con las coordenadas del mismo.
     * @param $comercios
     * @return array
     */
    private function obtenerCoordenadasComercios($comercios){
        $coordenadasComercios = [];
        foreach($comercios as $comercio){
            $coordenadasComercios[$comercio->id] = ['latitud'=>$comercio->latitud,'longitud'=>$comercio->longitud];
        }
        return $coordenadasComercios;
    }

}
