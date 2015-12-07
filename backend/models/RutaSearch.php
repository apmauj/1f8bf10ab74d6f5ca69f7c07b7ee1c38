<?php

namespace backend\models;

use dektrium\user\models\User;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RutaSearch represents the model behind the search form about `backend\models\Ruta`.
 */
class RutaSearch extends Ruta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['id_usuario', 'dia', 'esActivo'], 'string'],
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
        $query = Ruta::find();

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
            'dia' => $this->dia,
            //'esActivo' => $this->esActivo
        ]);
        if($this->id_usuario!=null){
            $query->andFilterWhere([
                'id_usuario' => $user!=null?$user->id : 0
            ]);
        }
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
        return $dataProvider;
    }
}
