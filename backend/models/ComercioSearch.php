<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ComercioSearch represents the model behind the search form about `backend\models\Comercio`.
 */
class ComercioSearch extends Comercio
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'dia', 'prioridad'], 'integer'],
            [['nombre', 'direccion'], 'safe'],
            [['esActivo'], 'string'],
            [['latitud', 'longitud'], 'number'],
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
        $query = Comercio::find();

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
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'dia' => $this->dia,
            'prioridad' => $this->prioridad,
            //'esActivo' => $this->esActivo,
            'direccion' => $this->direccion,
        ]);
        if($this->esActivo=='Yes' || $this->esActivo=='yes' || $this->esActivo=='YES' || $this->esActivo=='Si' || $this->esActivo=='si' || $this->esActivo=='SI'){
            $query->andFilterWhere([
                'esActivo' => $this->esActivo == 0
            ]);
        }
        else if($this->esActivo=='no' || $this->esActivo=='No' || $this->esActivo=='NO'){
            $query->andFilterWhere([
                'esActivo' => $this->esActivo == 1
            ]);
        }


        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
