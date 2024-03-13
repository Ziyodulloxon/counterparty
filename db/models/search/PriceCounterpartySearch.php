<?php

namespace app\db\models\search;

use app\db\models\PriceCounterparty;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PriceCounterpartySearch represents the model behind the search form of `app\models\PriceCounterparty`.
 */
class PriceCounterpartySearch extends PriceCounterparty
{
    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id', 'product_id', 'price', 'counterparty_id'], 'integer'],
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
        $query = PriceCounterparty::find();

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
            'counterparty_id' => $this->counterparty_id,
        ]);

        return $dataProvider;
    }
}
