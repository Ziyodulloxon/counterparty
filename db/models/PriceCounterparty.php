<?php

namespace app\db\models;

use app\db\PriceInterface;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "price_counterparty".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $price_date
 * @property int|null $price
 * @property int|null $counterparty_id
 *
 * @property Counterparty $counterparty
 * @property Product $product
 */
class PriceCounterparty extends ActiveRecord implements PriceInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'price_counterparty';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['product_id', 'price', 'counterparty_id'], 'integer'],
            [['price_date'], 'safe'],
            [
                ['counterparty_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Counterparty::class,
                'targetAttribute' => ['counterparty_id' => 'id']
            ],
            [
                ['product_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Product::class,
                'targetAttribute' => ['product_id' => 'id']
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'price_date' => 'Price Date',
            'price' => 'Price',
            'counterparty_id' => 'Counterparty ID',
        ];
    }

    /**
     * Gets query for [[Counterparty]].
     *
     * @return ActiveQuery
     */
    public function getCounterparty(): ActiveQuery
    {
        return $this->hasOne(Counterparty::class, ['id' => 'counterparty_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return ActiveQuery
     */
    public function getProduct(): ActiveQuery
    {
        return $this->hasOne(Product::class, ['id' => 'product_id']);
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }
}
