<?php

namespace backend\models;

use backend\helpers\sysconfigs;
use Yii;

/**
 * This is the model class for table "comercio".
 *
 * @property integer $id
 * @property string $nombre
 * @property double $latitud
 * @property double $longitud
 * @property integer $dia
 * @property integer $prioridad
 * @property integer $esActivo
 *
 * @property ComercioProducto[] $comercioProductos
 * @property OrdenComercio[] $ordenComercios
 * @property RutaDiariaComercio[] $rutaDiariaComercios
 */
class Comercio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    //public $direccion;

    public static function tableName()
    {
        return 'comercio';
    }


/*    public function scenarios()
    {
        return [
            'create' => ['nombre', 'dia', 'direccion','esActivo','prioridad','latitud','longitud'],
        ];
    }*/
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'latitud', 'longitud', 'dia', 'prioridad', 'esActivo', 'direccion'], 'required'],
            [['nombre'],'unique'],
            [['latitud', 'longitud'], 'number'],
            [['direccion'],'string','max'=>255],
            [['dia', 'prioridad', 'esActivo'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['direccion'],function ($attribute,$params) {
                if ($this->direccion !== null) {
                     if (!sysconfigs::getCoordinates($this->direccion)) {
                            $this->addError($attribute, \Yii::t('app', 'Address doesnt exist'));
                        }
                    }
                }
            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Name'),
            'latitud' => Yii::t('app', 'Latitude'),
            'longitud' => Yii::t('app', 'Longitude'),
            'dia' => Yii::t('app', 'Day'),
            'prioridad' => Yii::t('app', 'Priority'),
            'esActivo' => Yii::t('app', 'Active?'),
            'direccion' => Yii::t('app', 'Adress'),
        ];
    }

    public function getCoordinates($direccion){
        $direccion = urlencode($direccion);
        $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=" . $direccion;
        $response = file_get_contents($url);
        $json = json_decode($response,true);

        $lat = $json['results'][0]['geometry']['location']['lat'];
        $lng = $json['results'][0]['geometry']['location']['lng'];

        return array($lat, $lng);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComercioProductos()
    {
        return $this->hasMany(ComercioProducto::className(), ['id_comercio' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenComercios()
    {
        return $this->hasMany(OrdenComercio::className(), ['id_comercio' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRutaDiariaComercios()
    {
        return $this->hasMany(RutaDiariaComercio::className(), ['id_comercio' => 'id']);
    }

    public function getComercioProductosRelacionados()
    {
        return $this->hasMany(ComercioProductosRelacionados::className(), ['id_comercio' => 'id']);
    }

    public function esValidoBorrar(){
        if($this->getRutaDiariaComercios()->count()>0 || $this->getOrdenComercios()->count()>0){
            return Yii::t('app',"There are Routes that depends on this Store");
        }
        return "OK";
    }


}
