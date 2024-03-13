<?php

namespace app\db\models;

use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
    public static function tableName(): string
    {
        return 'product';
    }

    public function behaviors(): array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ]
            ],
            [
                'class' => SluggableBehavior::class,
                'attribute' => 'name',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
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
    public function attributeLabels(): array
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
     * @return ActiveQuery
     */
    public function getOrderProducts(): ActiveQuery
    {
        return $this->hasMany(OrderProduct::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[PriceCounterparties]].
     *
     * @return ActiveQuery
     */
    public function getPriceCounterparties(): ActiveQuery
    {
        return $this->hasMany(PriceCounterparty::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[PriceRetails]].
     *
     * @return ActiveQuery
     */
    public function getPriceRetails(): ActiveQuery
    {
        return $this->hasMany(PriceRetail::class, ['product_id' => 'id']);
    }
}
