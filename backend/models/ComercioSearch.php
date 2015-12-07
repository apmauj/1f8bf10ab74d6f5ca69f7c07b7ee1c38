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
            [['id'], 'integer'],
            [['nombre', 'direccion'], 'safe'],
            [['esActivo', 'dia', 'prioridad'], 'string'],
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
            //'dia' => $this->dia,
            //'prioridad' => $this->prioridad,
            //'esActivo' => $this->esActivo,
            'direccion' => $this->direccion,
        ]);
        if(strtolower($this->esActivo)==strtolower(Yii::t('core', 'Yes'))){
            $query->andFilterWhere([
                'esActivo' => $this->esActivo == 0
            ]);
        }else if(strtolower($this->esActivo)==strtolower(Yii::t('core', 'No'))){
            $query->andFilterWhere([
                'esActivo' => $this->esActivo == 1
            ]);
        }

        if(strtolower($this->dia)==strtolower(Yii::t('core', 'Monday'))){
            $query->andFilterWhere([
                'dia' => 1
            ]);
        }else if(strtolower($this->dia)==strtolower(Yii::t('core', 'Tuesday'))) {
            $query->andFilterWhere([
                'dia' => 2
            ]);
        }else if(strtolower($this->dia)==strtolower(Yii::t('core', 'Wednesday'))){
            $query->andFilterWhere([
                'dia' => 3
            ]);
        }else if(strtolower($this->dia)==strtolower(Yii::t('core', 'Thursday'))){
            $query->andFilterWhere([
                'dia' => 4
            ]);
        }else if(strtolower($this->dia)==strtolower(Yii::t('core', 'Friday'))){
            $query->andFilterWhere([
                'dia' => 5
            ]);
        }else if(strtolower($this->dia)==strtolower(Yii::t('core', 'Saturday'))){
            $query->andFilterWhere([
                'dia' => 6
            ]);
        }else if(strtolower($this->dia)==strtolower(Yii::t('core', 'Sunday'))){
            $query->andFilterWhere([
                'dia' => 7
            ]);
        }

        if(strtolower($this->prioridad)==strtolower(Yii::t('core', 'Very High'))){
            $query->andFilterWhere([
                'prioridad' => 1
            ]);
        }else if(strtolower($this->prioridad)==strtolower(Yii::t('core', 'High'))){
            $query->andFilterWhere([
                'prioridad' => 2
            ]);
        }else if(strtolower($this->prioridad)==strtolower(Yii::t('core', 'Normal'))){
            $query->andFilterWhere([
                'prioridad' => 3
            ]);
        }else if(strtolower($this->prioridad)==strtolower(Yii::t('core', 'Low'))){
            $query->andFilterWhere([
                'prioridad' => 4
            ]);
        }else if(strtolower($this->prioridad)==strtolower(Yii::t('core', 'Very Low'))){
            $query->andFilterWhere([
                'prioridad' => 5
            ]);
        }


        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
