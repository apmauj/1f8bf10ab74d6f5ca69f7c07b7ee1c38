<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "comercio_productos_relacionados".
 *
 * @property integer $id_comercio
 * @property integer $id_producto
 *
 * @property Comercio $idComercio
 * @property Producto $idProducto
 */
class ComercioProductosRelacionados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comercio_productos_relacionados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_comercio', 'id_producto'], 'required'],
            [['id_comercio', 'id_producto'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comercio' => Yii::t('app', 'Comercio'),
            'id_producto' => Yii::t('app', 'Producto'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdComercio()
    {
        return $this->hasOne(Comercio::className(), ['id' => 'id_comercio']);
    }

    public function getComercioNombre(){
        $model=$this->idComercio;
        return $model?$model->nombre:'';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProducto()
    {
        return $this->hasOne(Producto::className(), ['id' => 'id_producto']);
    }

    public function getProductoNombre(){
        $model=$this->idProducto;
        return $model?$model->nombre:'';
    }
}
