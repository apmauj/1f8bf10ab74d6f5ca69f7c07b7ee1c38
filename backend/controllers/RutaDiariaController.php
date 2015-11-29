<?php

namespace backend\controllers;

use backend\models\OrdenComercio;
use backend\models\Ruta;
use backend\models\RutaDiaria;
use backend\models\RutaDiariaComercio;
use backend\models\RutaDiariaSearch;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * RutaDiariaController implements the CRUD actions for RutaDiaria model.
 */
class RutaDiariaController extends SiteController
{

    /**
     * Lists all RutaDiaria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RutaDiariaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RutaDiaria model.
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
     * Finds the RutaDiaria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RutaDiaria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RutaDiaria::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new RutaDiaria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($idRuta)
    {
        $model = new RutaDiaria();
        $ruta = Ruta::find()->where(['id'=>$idRuta])->one();
        $ordenComercios = OrdenComercio::find()->where(['id_ruta'=>$idRuta])->all();
        $model->id_usuario = $ruta->id_usuario;
        $model->fecha = date("Y-m-d");

        $idRutaDiaria =$model->save();
        if($idRutaDiaria!== false){
            $orden= 1;
            foreach($ordenComercios as $ordenComercio){
                $rutaDiariaComercio = new RutaDiariaComercio();
                $rutaDiariaComercio->id_comercio = $ordenComercio->id_comercio;
                $rutaDiariaComercio->link("idRutaDiaria",$model);
                $rutaDiariaComercio->orden = $orden;
                $rutaDiariaComercio->save();

                $orden++;
            }
        }
        Yii::$app->getSession()->setFlash('success', Yii::t('app', 'Daily Route has been created'));

        return $this->redirect(['ruta/view', 'id' => $idRuta]);

/*        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
    }

    /**
     * Updates an existing RutaDiaria model.
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
     * Deletes an existing RutaDiaria model.
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
