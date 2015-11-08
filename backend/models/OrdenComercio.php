<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orden_comercio".
 *
 * @property integer $id
 * @property integer $orden
 * @property integer $id_ruta
 * @property integer $id_comercio
 *
 * @property Comercio $idComercio
 * @property Ruta $idRuta
 */
class OrdenComercio extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orden_comercio';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orden', 'id_ruta', 'id_comercio'], 'required'],
            [['orden', 'id_ruta', 'id_comercio'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'orden' => Yii::t('app', 'Orden'),
            'id_ruta' => Yii::t('app', 'Id Ruta'),
            'id_comercio' => Yii::t('app', 'Id Comercio'),
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
    public function getIdRuta()
    {
        return $this->hasOne(Ruta::className(), ['id' => 'id_ruta']);
    }
}
