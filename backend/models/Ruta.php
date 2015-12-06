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
            'dia' => Yii::t('app', 'Day'),
            'esActivo' => Yii::t('app', 'Active?'),
            'id_usuario' => Yii::t('app', 'User'),
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

    public function validar(){
        if($this->esActivo){
            if($this->id != null){
                if($this->find()->where('id!='.$this->id)->andWhere(['id_usuario'=>$this->id_usuario])->andWhere(['dia'=>$this->dia])->andWhere(['esActivo'=>'1'])->count()>0){
                    return Yii::t('app',"Exists another active Route for this User for this Day");
                }
            }else{
                if($this->find()->where(['id_usuario'=>$this->id_usuario])->andWhere(['dia'=>$this->dia])->andWhere(['esActivo'=>'1'])->count()>0){
                    return Yii::t('app',"There is another active Route for this User for this Day");
                }

            }

        }

        return "OK";

    }


}
