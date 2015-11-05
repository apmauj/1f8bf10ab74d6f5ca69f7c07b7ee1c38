<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ruta".
 *
 * @property integer $id
 * @property integer $dia
 * @property integer $esActivo
 *
 * @property OrdenComercio[] $ordenComercios
 */
class Ruta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ruta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['dia', 'esActivo'], 'required'],
            [['dia', 'esActivo'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'dia' => Yii::t('app', 'Dia'),
            'esActivo' => Yii::t('app', 'Es Activo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenComercios()
    {
        return $this->hasMany(OrdenComercio::className(), ['id_ruta' => 'id']);
    }
}
