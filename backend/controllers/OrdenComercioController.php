<?php

namespace backend\controllers;

use backend\models\Comercio;
use backend\models\User;
use backend\models\Ruta;
use backend\models\OrdenComercio;
use backend\models\OrdenComercioSearch;
use Yii;
use yii\db\Query;
use yii\web\NotFoundHttpException;

/**
 * OrdenComercioController implements the CRUD actions for OrdenComercio model.
 */
class OrdenComercioController extends SiteController
{

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

    public function comerciosSinRutasActivas(){

        //ruta: las rutas creadas
        //orden_comercio
        //comercio

        //Devuelve todas las rutas activas
        $query = new Query();
        $query->select('id')->from('ruta')->where('esActivo',true);

        //Devuelve los comercios en rutas activas
        $query2 = new Query();
        $query2->select('id_comercio')->from('orden_comercio')->where(['in','id_ruta',$query]);

        //Devuelve los comercios sin rutas activas
        //$comercios = [];
        $comercios = Comercio::find()->where(['not in','id',$query2]);

        return $comercios;
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
}
