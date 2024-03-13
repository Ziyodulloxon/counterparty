<?php

namespace app\db\models;

use app\db\PriceInterface;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "price_retail".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $price_date
 * @property int|null $price
 *
 * @property Product $product
 */
class PriceRetail extends ActiveRecord implements PriceInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'price_retail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['product_id', 'price'], 'integer'],
            [['price_date'], 'safe'],
            [
                ['product_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Product::class,
                'targetAttribute' => ['product_id' => 'id']
            ],
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
        ];
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
