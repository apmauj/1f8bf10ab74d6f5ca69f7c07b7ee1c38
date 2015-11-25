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
        $comercios = $this->comerciosSinRutasActivas();
        $inicio = new User();
        $inicio->latitud = -34.895247;
        $inicio->longitud = -56.172498;
        $inicio->username = "Don Dog";

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
