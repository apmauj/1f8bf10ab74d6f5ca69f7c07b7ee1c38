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
            [['dia', 'esActivo', 'id_usuario'], 'required'],
            [['dia', 'esActivo', 'id_usuario'], 'integer']
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
            'id_usuario' => Yii::t('app', 'Usuario'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdenComercios()
    {
        return $this->hasMany(OrdenComercio::className(), ['id_ruta' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'id_usuario']);
    }


    public function findBusqueda(){
        $data = $this->find();

        $resultado = [];
        foreach($data as $ruta){
            $resultado[$ruta->id] = ['id'=>$ruta->id,
                'dia' => $ruta->dia,
                'esActivo' => $ruta->esActivo,
                'user' => User::findOne($ruta->id_usuario)->username
            ];
        }
        return $resultado;
    }




}
