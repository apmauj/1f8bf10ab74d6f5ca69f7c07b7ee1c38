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
use backend\models\Stock;
use backend\models\StockSearch;
use Yii;
use yii\rest\ActiveController;

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
        return $actions;
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

    /**
     * Lists all Stock models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Stock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Stock();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Stock model.
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
     * Deletes an existing Stock model.
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
