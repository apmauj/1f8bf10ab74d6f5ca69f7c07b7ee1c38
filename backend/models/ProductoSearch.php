<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductoSearch represents the model behind the search form about `backend\models\Producto`.
 */
class ProductoSearch extends Producto
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_categoria'], 'integer'],
            [['nombre', 'imagen'], 'safe'],
            [['precio'], 'number'],
            [['esActivo'], 'string'],
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
        $query = Producto::find();

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
            'id_categoria' => $this->id_categoria,
            //'esActivo' => $this->esActivo,
            'precio' => $this->precio,
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

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'imagen', $this->imagen]);

        return $dataProvider;
    }
}
