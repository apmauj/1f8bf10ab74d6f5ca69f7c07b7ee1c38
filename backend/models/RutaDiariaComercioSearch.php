<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RutaDiariaComercioSearch represents the model behind the search form about `backend\models\RutaDiariaComercio`.
 */
class RutaDiariaComercioSearch extends RutaDiariaComercio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'orden', 'id_ruta_diaria', 'id_comercio'], 'integer'],
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
        $query = RutaDiariaComercio::find();

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
            'orden' => $this->orden,
            'id_ruta_diaria' => $this->id_ruta_diaria,
            'id_comercio' => $this->id_comercio,
        ]);

        return $dataProvider;
    }
}
