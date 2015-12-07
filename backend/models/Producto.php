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
            [['nombre'],'unique'],
            [['precio'], 'number','numberPattern'=>'/^\s*[-+]?[0-9]{1,7}\.?[0-9]{1,2}?\s*$/','message'=>Yii::t('core','price is incorrect, see the instructions')],
            [['file'],'file','extensions'=>'jpg , png'],
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
            'id' => Yii::t('core', 'ID'),
            'nombre' => Yii::t('core', 'Name'),
            'imagen' => Yii::t('core', 'Image'),
            'id_categoria' => Yii::t('core', 'Category'),
            'esActivo' => Yii::t('core', 'Active?'),
            'precio' => Yii::t('core', 'Price'),
            'file' => Yii::t('core', 'Image'),
        ];
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
        if($this->getComercioProductos()->count()>0 || $this->getComercioProductoRelacionados()->count()>0){
            return Yii::t('core',"There are Stores that depends on this Product");
        }

        return "OK";
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComercioProductos()
    {
        return $this->hasMany(ComercioProducto::className(), ['id_producto' => 'id']);
    }

    public function getComercioProductoRelacionados(){
        return $this->hasMany(ComercioProductosRelacionados::className(), ['id_producto' => 'id']);
    }


}
