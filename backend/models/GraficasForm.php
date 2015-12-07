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
        $scenarios['storeOrders'] = ['opcionComercio2','fechaDesde','fechaHasta'];

        return $scenarios;
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'opcionComercio'        => Yii::t('core', 'Store: '),
            'opcionRelevador'       => Yii::t('core', 'Relevator: '),
            'opcionComercio2'       => Yii::t('core', 'Store: '),
            'fechaDesde'            => Yii::t('core', 'From: '),
            'fechaHasta'            => Yii::t('core', 'To: '),
        ];
    }

    /** @inheritdoc */
    public function formName()
    {
        return 'graficas-form';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['opcionComercio'], 'required','on' => ['storeSells']],
            [['opcionComercio2','fechaDesde','fechaHasta'], 'required','on' => ['storeOrders']],
            [['fechaDesde','fechaHasta'], 'safe'],
            ['fechaDesde', 'date', 'format' => 'Y-m-d'],
        ];
    }


}