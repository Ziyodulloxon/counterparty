<?php

namespace app\db\forms;

use app\db\models\Counterparty;
use yii\base\Model;
use yii\helpers\VarDumper;

class OrderCreateForm extends Model
{
    public $counterparty_id;

    public $order_items;

    public function rules(): array
    {
        return [
            ['counterparty_id', 'integer'],
            ['counterparty_id', 'required'],
            [
                'counterparty_id',
                'exist',
                'targetClass' => Counterparty::class,
                'targetAttribute' => ['counterparty_id' => 'id']
            ],
            ['order_items', "validateOrderItems"],
        ];
    }

    public function validateOrderItems(): void
    {
        foreach ($this->order_items as $item) {
            $model = new OrderItemForm();
            $model->attributes = $item;
            if (!$model->validate()) {
                foreach ($model->errors as $attribute => $errors) {
                    $this->addError("order_item", $model->getFirstError($attribute));
                }
            }
        }
    }

    public function attributeLabels(): array
    {
        return [
            'counterparty_id' => 'Counterparty',
            'order_items' => 'Order items'
        ];
    }
}
