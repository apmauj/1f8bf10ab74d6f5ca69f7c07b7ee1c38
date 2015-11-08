<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "comercio_producto".
 *
 * @property integer $id
 * @property string $fecha
 * @property integer $vendidos
 * @property integer $id_comercio
 * @property integer $id_producto
 *
 * @property Comercio $idComercio
 * @property Producto $idProducto
 */
class ComercioProducto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comercio_producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'vendidos', 'id_comercio', 'id_producto'], 'required'],
            [['fecha'], 'safe'],
            [['vendidos', 'id_comercio', 'id_producto'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha' => Yii::t('app', 'Fecha'),
            'vendidos' => Yii::t('app', 'Vendidos'),
            'id_comercio' => Yii::t('app', 'Id Comercio'),
            'id_producto' => Yii::t('app', 'Id Producto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdComercio()
    {
        return $this->hasOne(Comercio::className(), ['id' => 'id_comercio']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'id_producto']);
    }
}
