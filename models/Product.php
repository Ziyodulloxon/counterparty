<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property OrderProduct[] $orderProducts
 * @property PriceCounterparty[] $priceCounterparties
 * @property PriceRetail[] $priceRetails
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[OrderProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[PriceCounterparties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPriceCounterparties()
    {
        return $this->hasMany(PriceCounterparty::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[PriceRetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPriceRetails()
    {
        return $this->hasMany(PriceRetail::class, ['product_id' => 'id']);
    }
}
