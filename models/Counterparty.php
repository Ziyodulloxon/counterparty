<?php

namespace app\models;

use Yii;

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
    public static function tableName()
    {
        return 'counterparty';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
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
    public function attributeLabels()
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
    public function getOrders()
    {
        return $this->hasMany(Order::class, ['counterparty_id' => 'id']);
    }

    /**
     * Gets query for [[PriceCounterparties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPriceCounterparties()
    {
        return $this->hasMany(PriceCounterparty::class, ['counterparty_id' => 'id']);
    }
}
