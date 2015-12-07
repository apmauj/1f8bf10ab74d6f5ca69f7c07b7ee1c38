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
            'id' => Yii::t('core', 'ID'),
            'fecha' => Yii::t('core', 'Date'),
        ];
    }

    public function getComerciosOrdenados(){

        $rutaDiariaComercios = $this->getRutaDiariaComercios()->orderBy('orden')->all();
        $comerciosOrdenados = [];
        $i = 0;
        foreach($rutaDiariaComercios as $rutaDiariaComercio){
            $comercio = Comercio::find()->where(['id'=>$rutaDiariaComercio->id_comercio])->one();
            $comerciosOrdenados[$i] = $comercio;
            $i++;
        }
        return $comerciosOrdenados;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRutaDiariaComercios()
    {
        return $this->hasMany(RutaDiariaComercio::className(), ['id_ruta_diaria' => 'id']);
    }

}
