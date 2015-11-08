<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ruta_diaria".
 *
 * @property integer $id
 * @property string $fecha
 *
 * @property RutaDiariaComercio[] $rutaDiariaComercios
 */
class RutaDiaria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ruta_diaria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha'], 'required'],
            [['fecha'], 'safe']
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRutaDiariaComercios()
    {
        return $this->hasMany(RutaDiariaComercio::className(), ['id_ruta_diaria' => 'id']);
    }
}
