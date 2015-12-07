<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ruta_diaria_comercio".
 *
 * @property integer $id
 * @property integer $orden
 * @property integer $id_ruta_diaria
 * @property integer $id_comercio
 *
 * @property Pedido[] $pedidos
 * @property Comercio $idComercio
 * @property RutaDiaria $idRutaDiaria
 * @property Stock[] $stocks
 */
class RutaDiariaComercio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ruta_diaria_comercio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orden', 'id_ruta_diaria', 'id_comercio'], 'required'],
            [['orden', 'id_ruta_diaria', 'id_comercio'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('core', 'ID'),
            'orden' => Yii::t('core', 'Order'),
            'id_ruta_diaria' => Yii::t('core', 'Daily Route ID'),
            'id_comercio' => Yii::t('core', 'Store ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['id_ruta_diaria_com' => 'id']);
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
    public function getIdRutaDiaria()
    {
        return $this->hasOne(RutaDiaria::className(), ['id' => 'id_ruta_diaria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['id_ruta_diaria_com' => 'id']);
    }
}
