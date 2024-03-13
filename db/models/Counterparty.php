<?php

namespace app\db\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "counterparty".
 *
 * @property int $id
 * @property string $name
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Order[] $orders
 * @property PriceCounterparty[] $priceCounterparties
 */
class Counterparty extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'counterparty';
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
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
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
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders(): \yii\db\ActiveQuery
    {
        return $this->hasMany(Order::class, ['counterparty_id' => 'id']);
    }

    /**
     * Gets query for [[PriceCounterparties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPriceCounterparties(): \yii\db\ActiveQuery
    {
        return $this->hasMany(PriceCounterparty::class, ['counterparty_id' => 'id']);
    }
}
