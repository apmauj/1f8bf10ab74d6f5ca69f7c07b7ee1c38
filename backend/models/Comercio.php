<?php

namespace backend\models;

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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'latitud', 'longitud', 'dia', 'prioridad', 'esActivo', 'direccion'], 'required'],
            [['latitud', 'longitud'], 'number'],
            [['direccion'],'string'],
            [['dia', 'prioridad', 'esActivo'], 'integer'],
            [['nombre'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'latitud' => Yii::t('app', 'Latitud'),
            'longitud' => Yii::t('app', 'Longitud'),
            'dia' => Yii::t('app', 'Dia'),
            'prioridad' => Yii::t('app', 'Prioridad'),
            'esActivo' => Yii::t('app', 'Es Activo'),
            'direccion' => Yii::t('app', 'Direccion'),
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
}
