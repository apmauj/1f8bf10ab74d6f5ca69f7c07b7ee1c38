<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 22/11/2015
 * Time: 5:25
 */

namespace api\modules\v2\controllers;

use backend\models\RutaDiaria;
use yii\rest\ActiveController;

class RutaDiariaComercioController extends ActiveController
{
    public $modelClass = 'backend\models\RutaDiariaComercio';

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
        $model = RutaDiaria::findOne($id);
        $listaRutasComercios = $model->getRutaDiariaComercios();
        $listaComercios = [];
        foreach($listaRutasComercios as $rutaComercio){
            $listaComercios[]=$rutaComercio->getIdComercio();
        }
        return $listaComercios;
    }

}