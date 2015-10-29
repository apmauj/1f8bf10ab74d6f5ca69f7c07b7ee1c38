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
            [['nombre', 'latitud', 'longitud', 'dia', 'prioridad', 'esActivo'], 'required'],
            [['latitud', 'longitud'], 'number'],
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
        ];
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
