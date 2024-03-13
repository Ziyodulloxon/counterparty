<?php

namespace app\db\models\search;

use app\db\models\PriceRetail;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PriceRetailSearch represents the model behind the search form of `app\models\PriceRetail`.
 */
class PriceRetailSearch extends PriceRetail
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'product_id', 'price'], 'integer'],
            [['price_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = PriceRetail::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'product_id' => $this->product_id,
            'price_date' => $this->price_date,
            'price' => $this->price,
        ]);

        return $dataProvider;
    }
}
