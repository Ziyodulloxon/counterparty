<?php

namespace app\services;

use app\db\factories\OrderFactory;
use app\db\forms\OrderCreateForm;
use app\db\models\Order;
use app\db\repositories\OrderRepository;
use app\db\repositories\PriceRepository;

class OrderService
{
    public function __construct(
        private readonly OrderFactory $factory,
        private readonly PriceRepository $prices,
        private readonly OrderRepository $orders
    ) {}

    public function create(OrderCreateForm $form): ?Order
    {
        $orderItemsPrices = $this->prices->getOrderItemsPrices($form);
        $order = $this->factory->makeNewOrder($form, $orderItemsPrices);

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $this->orders->persist($order);
            $orderItems = $this->factory->makeOrderItems($order->id, $form->order_items, $orderItemsPrices);
            $this->orders->persistOrderProducts($orderItems);
            $transaction->commit();
            return $order;
        } catch (\Exception $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }
}