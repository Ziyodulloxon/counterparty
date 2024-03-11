<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $date_time
 * @property int|null $counterparty_id
 * @property int $amount
 * @property string $status
 *
 * @property Counterparty $counterparty
 * @property OrderProduct[] $orderProducts
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_time', 'amount', 'status'], 'required'],
            [['date_time'], 'safe'],
            [['counterparty_id', 'amount'], 'integer'],
            [['status'], 'string', 'max' => 30],
            [['counterparty_id'], 'exist', 'skipOnError' => true, 'targetClass' => Counterparty::class, 'targetAttribute' => ['counterparty_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_time' => 'Date Time',
            'counterparty_id' => 'Counterparty ID',
            'amount' => 'Amount',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Counterparty]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCounterparty()
    {
        return $this->hasOne(Counterparty::class, ['id' => 'counterparty_id']);
    }

    /**
     * Gets query for [[OrderProducts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::class, ['order_id' => 'id']);
    }
}
