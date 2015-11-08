<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * OrdenComercioSearch represents the model behind the search form about `backend\models\OrdenComercio`.
 */
class OrdenComercioSearch extends OrdenComercio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'orden', 'id_ruta', 'id_comercio'], 'integer'],
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
        $query = OrdenComercio::find();

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
            'id_ruta' => $this->id_ruta,
            'id_comercio' => $this->id_comercio,
        ]);

        return $dataProvider;
    }
}
