<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property integer $esActivo
 *
 * @property Producto[] $productos
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'esActivo'], 'required'],
            [['esActivo'], 'integer'],
            [['nombre'],'unique'],
            [['nombre'], 'string', 'max' => 50],
            [['descripcion'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('core', 'ID'),
            'nombre' => Yii::t('core', 'Name'),
            'descripcion' => Yii::t('core', 'Description'),
            'esActivo' => Yii::t('core', 'Active?'),
        ];
    }

    public function getCategoriasActivas(){
        return $this->find()->where(['esActivo'=>1])->all();
    }

    public function esValidoBorrar(){
        if($this->getProductos()->count()>0){
            return Yii::t('core',"There are Products that depends on this Category");
        }

        return "OK";
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::className(), ['id_categoria' => 'id']);
    }

}
