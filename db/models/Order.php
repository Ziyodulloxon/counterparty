<?php

namespace app\db\models;

use app\db\OrderStatus;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
class Order extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['date_time', 'amount', 'status'], 'required'],
            [['date_time'], 'safe'],
            [['counterparty_id', 'amount'], 'integer'],
            [['status'], 'in', 'range' => array_map(fn($case) => $case->value, OrderStatus::cases())],
            [
                ['counterparty_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Counterparty::class,
                'targetAttribute' => ['counterparty_id' => 'id']
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
            'date_time' => 'Date Time',
            'counterparty_id' => 'Counterparty ID',
            'amount' => 'Amount',
            'status' => 'Status',
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
     * Gets query for [[OrderProducts]].
     *
     * @return ActiveQuery
     */
    public function getOrderProducts(): ActiveQuery
    {
        return $this->hasMany(OrderProduct::class, ['order_id' => 'id']);
    }
}
