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
            [['id_comercio', 'id_producto'], 'integer'],
            'repetidoValidator'=>['id_comercio',function ($attribute) {
                if(ComercioProductosRelacionados::find()->where(['id_comercio'=>$this->id_comercio])->andWhere(['id_producto'=>$this->id_producto])->count()>0){
                    $this->addError($attribute, \Yii::t('core', 'Some of the products added are already related with this store '));
                }
            }]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_comercio' => Yii::t('core', 'Store'),
            'id_producto' => Yii::t('core', 'Product'),
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

    public function beforeValidate()
    {
        //var_dump($this->id_producto);
        //$integerIDs = array_map('intval', explode(',', $this->id_producto));
        //var_dump($integerIDs);

        /*$long_string = implode(',', $this->id_producto);

        $result_array = array();
        $strings_array = explode(',', $long_string);

        foreach ($strings_array as $each_number) {
            $result_array[] = (int) $each_number;
        }

        $this->id_producto = $result_array;*/

        /*if ($this->id_producto != null) {

            foreach($this->id_producto as $producto){
                $this->id_comercio = $this->id_comercio;
                $this->id_producto=(int)$producto;
                var_dump($this->id_producto);
                //$this->save();
            }
            //$this->productos = array();
        }*/

        return parent::beforeValidate();
    }


}
