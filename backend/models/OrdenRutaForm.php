<?php
/**
 * Created by PhpStorm.
 * User: Cacho
 * Date: 27/11/2015
 * Time: 23:22
 */

namespace backend\models;


use Yii;

class OrdenRutaForm extends \yii\db\ActiveRecord
{
    public $idUsuario;

    public $username;

    public $jsonRuta;

    public $dia;

    public $idRuta;

    public $jsonRequestRuta;

    public $ordenComercios;

    public function __construct( $config = [])
    {
        parent::__construct($config);
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['idUsuario','ordenComercios','idRuta','dia'];
        return $scenarios;
    }


    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'username'      => Yii::t('core', 'Username'),
            'idRuta'        => Yii::t('core', 'Route Id'),
            'dia'           => Yii::t('core', 'Day'),
        ];
    }

    /** @inheritdoc */
    public function formName()
    {
        return 'orden-ruta-form';
    }



}