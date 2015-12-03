<?php
/**
 * Created by PhpStorm.
 * User: El Perro
 * Date: 02/12/2015
 * Time: 21:15
 */
namespace backend\controllers;

class GraficasController extends SiteController{

    public function actionIndex()
    {
        return $this->render('index', []);
    }



}