<?php

namespace backend\controllers;

use backend\models\Categoria;
use backend\models\Producto;
use backend\models\ProductoSearch;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends SiteController
{

    /**
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
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
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Producto();
        $categoria = new Categoria();
        $categoriasActivas = $categoria->getCategoriasActivas();
        if ($model->load(Yii::$app->request->post())) {

            $nombreImagen = $model->nombre;

            $model->file = UploadedFile::getInstance($model,'file');

            $model->imagen = 'img/'.$nombreImagen.'.'.$model->file->extension;

            if($model->validate()){
                $model->save();
                $model->file->saveAs( 'img/'.$model->nombre.'.'.$model->file->extension );
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return $this->render('create', [
                    'model' => $model,'categorias'=> $categoriasActivas
                ]);
            }



        } else {
            return $this->render('create', [
                'model' => $model,'categorias'=> $categoriasActivas
            ]);
        }
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $categoria = new Categoria();
        $categoriasActivas = $categoria->getCategoriasActivas();

        if ($model->load(Yii::$app->request->post())) {
            $subioArchivo = false;
            if ($model->file = UploadedFile::getInstance($model,'file'))
            {
                $subioArchivo = true;
                $nombreImagen = $model->nombre;
                $model->imagen = 'img/'.$nombreImagen.'.'.$model->file->extension;
            }
            if($model->validate()) {

                $model->save();
                if($subioArchivo){
                    $model->file->saveAs( 'img/'.$model->nombre.'.'.$model->file->extension );
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                return $this->render('update', [
                    'model' => $model,'categorias'=> $categoriasActivas
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,'categorias'=> $categoriasActivas
            ]);
        }
    }

    /**
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model= $this->findModel($id);
        $mensaje = Yii::t('app','Product has been deleted!');
        $validar=$model->esValidoBorrar();
        if($validar=="OK") {
            Yii::$app->getSession()->setFlash('success', $mensaje);
            $model->delete();
        }else{
            Yii::$app->getSession()->setFlash('danger',$validar);
        }
        return $this->redirect(['index']);
    }
}
