<?php

namespace app\db\forms;

use yii\base\Model;

class OrderItemForm extends Model
{
    public $product_id;

    public $quantity;

    public function rules(): array
    {
        return [
            [["product_id", "quantity"], "required"],
            [["product_id", "quantity"], "integer"],
//            [
//                "product_id",
//                'exist',
//                'targetClass' => Product::class,
//                'targetAttribute' => ['product_id' => 'id']
//            ]
        ];
    }
}
