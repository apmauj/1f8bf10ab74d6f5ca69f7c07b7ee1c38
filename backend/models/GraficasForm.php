<?php
/**
 * Created by PhpStorm.
 * User: El Perro
 * Date: 05/12/2015
 * Time: 23:44
 */

namespace backend\models;

use Yii;

class GraficasForm extends \yii\db\ActiveRecord{


    public $opcion;
    public $opcionComercio;
    public $opcionRelevador;
    public $opcionComercio2;
    public $fechaDesde;
    public $fechaHasta;


    public function __construct( $config = [])
    {
        parent::__construct($config);
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['storeSells'] = ['opcionComercio',];
        return $scenarios;
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'opcionComercio'        => Yii::t('app', 'Store: '),
            'opcionRelevador'       => Yii::t('app', 'Relevator: '),
            'opcionComercio2'       => Yii::t('app', 'Store: '),
            'fechaDesde'            => Yii::t('app', 'Desde: '),
            'fechaHasta'            => Yii::t('app', 'Hasta: '),
        ];
    }

    /** @inheritdoc */
    public function formName()
    {
        return 'graficas-form';
    }

}