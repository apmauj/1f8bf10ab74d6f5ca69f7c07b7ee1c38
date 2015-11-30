<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ComercioProductosRelacionadosSearch represents the model behind the search form about `backend\models\ComercioProductosRelacionados`.
 */
class ComercioProductosRelacionadosSearch extends ComercioProductosRelacionados
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_comercio', 'id_producto'], 'integer'],
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
        $query = ComercioProductosRelacionados::find();

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
            'id_comercio' => $this->id_comercio,
            'id_producto' => $this->id_producto,
        ]);

        return $dataProvider;
    }
}
