<?php

namespace backend\controllers;

use backend\helpers\sysconfigs;
use backend\models\Comercio;
use backend\models\Ruta;
use backend\models\RutaSearch;
use backend\models\User;
use Yii;
use yii\web\NotFoundHttpException;

/**
 * RutaController implements the CRUD actions for Ruta model.
 */
class RutaController extends SiteController
{

    /**
     * Lists all Ruta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RutaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ruta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if($model->getOrdenComercios()->count()!=0){
            $ordenComercios = $model->getOrdenComercios()->all();
            $usuario = User::findOne($model->id_usuario);
            $comercios = [];
            $datosGrillaPasos = [];
            $datosGrillaPasos[0] = ['orden'=>0,'tipo'=>Yii::t('core','User'),'nombre'=>$usuario->username,'direccion'=>$usuario->direccion];
            $i=0;
            foreach($ordenComercios as $ordenComercio){
                $comercios[$i] = Comercio::find()->where(['id'=>$ordenComercio->id_comercio])->one();
                $datosGrillaPasos[$i+1] = ['orden'=>$i+1,'tipo'=>Yii::t('core','Store'),'nombre'=>$comercios[$i]->nombre,'direccion'=>$comercios[$i]->direccion];
                $i++;
            }
            $requestRuta = json_encode(sysconfigs::getRutaRequestParaMostrar($usuario,$comercios));

            return $this->render('view', [
                'model' => $this->findModel($id),
                'tieneRecorrido'=>true,
                'requestRuta'=> $requestRuta,
                'datosGrillaPasos'=>$datosGrillaPasos,
            ]);
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }

    }

    /**
     * Finds the Ruta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ruta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ruta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Ruta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Ruta();

        if ($model->load(Yii::$app->request->post())) {
            $validar = $model->validar();
            if($validar=='OK' && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else{
                Yii::$app->getSession()->setFlash('danger',$validar);
                return $this->render('create', ['model' => $model]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Ruta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);



        if ($model->load(Yii::$app->request->post())) {
            $validar = $model->validar();
            if($validar=='OK' && $model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                Yii::$app->getSession()->setFlash('danger',$validar);
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            if($model->getOrdenComercios()->count()!=0){

                $ordenComercios = $model->getOrdenComercios()->all();
                $usuario = User::findOne($model->id_usuario);
                $comercios = [];
                $i=0;
                foreach($ordenComercios as $ordenComercio){
                    $comercios[$i] = Comercio::find()->where(['id'=>$ordenComercio->id_comercio])->one();
                    $i++;
                }
                $requestRuta = json_encode(sysconfigs::getRutaRequestParaMostrar($usuario,$comercios));

                return $this->render('update', [
                    'model' => $this->findModel($id),
                    'tieneRecorrido'=>true,
                    'requestRuta'=> $requestRuta,
                ]);
            }else{
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }

    /**
     * Deletes an existing Ruta model.
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
