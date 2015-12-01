<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $imagen
 * @property integer $id_categoria
 * @property integer $esActivo
 * @property double $precio
 *
 * @property ComercioProducto[] $comercioProductos
 * @property Pedido[] $pedidos
 * @property Categoria $idCategoria
 * @property Stock[] $stocks
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $file;

    public static function tableName()
    {
        return 'producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'imagen', 'id_categoria', 'esActivo'], 'required'],
            [['id_categoria', 'esActivo'], 'integer'],
            [['precio'], 'number'],
            [['file'],'file'],
            [['nombre'], 'string', 'max' => 50],
            [['imagen'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Name'),
            'imagen' => Yii::t('app', 'Image'),
            'id_categoria' => Yii::t('app', 'Category'),
            'esActivo' => Yii::t('app', 'Active?'),
            'precio' => Yii::t('app', 'Price'),
            'file' => Yii::t('app', 'Image'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComercioProductos()
    {
        return $this->hasMany(ComercioProducto::className(), ['id_producto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPedidos()
    {
        return $this->hasMany(Pedido::className(), ['id_producto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'id_categoria']);
    }

    /**
     * Para obtener el nombre de la categoria (lo usamos en GridView)
     */

    public function getCategoriaNombre(){
        $model=$this->idCategoria;
        return $model?$model->nombre:'';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStocks()
    {
        return $this->hasMany(Stock::className(), ['id_producto' => 'id']);
    }

    public function esValidoBorrar(){
        if($this->getComercioProductos()->count()>0){
            return Yii::t('app',"There are Stores that depends on this Product");
        }

        return "OK";
    }


}
