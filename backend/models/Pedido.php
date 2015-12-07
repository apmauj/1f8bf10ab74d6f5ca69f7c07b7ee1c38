<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pedido".
 *
 * @property integer $id
 * @property integer $cantidad
 * @property integer $id_producto
 * @property integer $id_ruta_diaria_com
 *
 * @property Producto $idProducto
 * @property RutaDiariaComercio $idRutaDiariaCom
 */
class Pedido extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pedido';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cantidad', 'id_producto', 'id_ruta_diaria_com'], 'required'],
            [['cantidad', 'id_producto', 'id_ruta_diaria_com'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('core', 'ID'),
            'cantidad' => Yii::t('core', 'Quantity'),
            'id_producto' => Yii::t('core', 'Product ID'),
            'id_ruta_diaria_com' => Yii::t('core', 'Daily Store Route ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'id_producto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRutaDiariaCom()
    {
        return $this->hasOne(RutaDiariaComercio::className(), ['id' => 'id_ruta_diaria_com']);
    }
}
