<?php

namespace backend\controllers;

use Yii;
use backend\models\ComercioProductosRelacionados;
use backend\models\ComercioProductosRelacionadosSearch;
use backend\controllers\SiteController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ComercioProductosRelacionadosController implements the CRUD actions for ComercioProductosRelacionados model.
 */
class ComercioProductosRelacionadosController extends SiteController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ComercioProductosRelacionados models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ComercioProductosRelacionadosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ComercioProductosRelacionados model.
     * @param integer $id_comercio
     * @param integer $id_producto
     * @return mixed
     */
    public function actionView($id_comercio, $id_producto)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_comercio, $id_producto),
        ]);
    }

    /**
     * Creates a new ComercioProductosRelacionados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ComercioProductosRelacionados();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_comercio' => $model->id_comercio, 'id_producto' => $model->id_producto]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ComercioProductosRelacionados model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_comercio
     * @param integer $id_producto
     * @return mixed
     */
    public function actionUpdate($id_comercio, $id_producto)
    {
        $model = $this->findModel($id_comercio, $id_producto);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_comercio' => $model->id_comercio, 'id_producto' => $model->id_producto]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ComercioProductosRelacionados model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_comercio
     * @param integer $id_producto
     * @return mixed
     */
    public function actionDelete($id_comercio, $id_producto)
    {
        $this->findModel($id_comercio, $id_producto)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ComercioProductosRelacionados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_comercio
     * @param integer $id_producto
     * @return ComercioProductosRelacionados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_comercio, $id_producto)
    {
        if (($model = ComercioProductosRelacionados::findOne(['id_comercio' => $id_comercio, 'id_producto' => $id_producto])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
