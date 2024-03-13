<?php

namespace app\db\repositories;

use app\db\forms\OrderCreateForm;
use app\db\models\Order;
use app\db\models\OrderProduct;
use app\db\OrderStatus;
use yii\helpers\VarDumper;

class OrderRepository
{
    public function persist(Order $order): bool
    {
        return $order->save();
    }

    public function persistOrderProducts(array $orderItems): void
    {
        $prototype = new OrderProduct();
        \Yii::$app->db->createCommand()
            ->batchInsert(
                OrderProduct::tableName(),
                $prototype->attributes(),
                array_map(fn(OrderProduct $item) => $item->attributes, $orderItems)
            )
            ->execute();
    }
}
