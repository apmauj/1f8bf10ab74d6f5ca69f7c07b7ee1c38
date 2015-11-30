<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PedidoSearch represents the model behind the search form about `backend\models\Pedido`.
 */
class PedidoSearch extends Pedido
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cantidad', 'id_producto', 'id_ruta_diaria_com'], 'integer'],
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
        $query = Pedido::find();

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
            'cantidad' => $this->cantidad,
            'id_producto' => $this->id_producto,
            'id_ruta_diaria_com' => $this->id_ruta_diaria_com,
        ]);

        return $dataProvider;
    }
}
