<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ComercioProductoSearch represents the model behind the search form about `backend\models\ComercioProducto`.
 */
class ComercioProductoSearch extends ComercioProducto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'vendidos', 'id_comercio', 'id_producto'], 'integer'],
            [['fecha'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ComercioProducto::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fecha' => $this->fecha,
            'vendidos' => $this->vendidos,
            'id_comercio' => $this->id_comercio,
            'id_producto' => $this->id_producto,
        ]);

        return $dataProvider;
    }
}
