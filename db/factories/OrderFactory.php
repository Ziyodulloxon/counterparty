<?php

namespace app\db\factories;

use app\db\forms\OrderCreateForm;
use app\db\models\Order;
use app\db\models\OrderProduct;
use app\db\OrderStatus;
use app\db\PriceInterface;

class OrderFactory
{
    public function makeNewOrder(OrderCreateForm $form, array $prices): Order
    {
        $order = new Order();
        $order->date_time = date("Y-m-d");
        $order->counterparty_id = $form->counterparty_id;
        $order->amount = $this->calculateAmount($form->order_items, $prices);
        $order->status = OrderStatus::NEW->value;
        return $order;
    }

    /**
     * @param PriceInterface[] $prices
     * */
    private function calculateAmount(array $orderItems, array $prices): int
    {
        return array_reduce($orderItems, function ($sum, array $item) use ($prices) {
            $price = $prices[$item["product_id"]];
            $sum += $price->getPrice() * $item["quantity"];
            return $sum;
        });
    }

    /**
     * @param PriceInterface[] $prices
     * @return OrderProduct[]
     * */
    public function makeOrderItems(int $orderId, array $orderItems, array $prices): array
    {
        return array_map(function (array $orderItem) use ($orderId, $prices) {
            $price = $prices[$orderItem["product_id"]];
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $orderId;
            $orderProduct->product_id = $price->getProductId();
            $orderProduct->price = $price->getPrice();
            $orderProduct->quantity = $orderItem["quantity"];
            $orderProduct->price_id = $price->id;
            return $orderProduct;
        }, $orderItems);
    }
}
