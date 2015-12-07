<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RutaDiariaSearch represents the model behind the search form about `backend\models\RutaDiaria`.
 */
class RutaDiariaSearch extends RutaDiaria
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['fecha'], 'safe'],
            [['id_usuario'], 'string']
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
        $query = RutaDiaria::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $user = User::findOne(['username'=> $this->id_usuario]);
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha' => $this->fecha,
            //'id_usuario' => $this->id_usuario,
        ]);
        if($this->id_usuario!=null){
            $query->andFilterWhere([
                'id_usuario' => $user!=null?$user->id : 0
            ]);
        }

        return $dataProvider;
    }
}
