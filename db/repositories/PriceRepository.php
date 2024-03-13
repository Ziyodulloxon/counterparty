<?php

namespace app\db\repositories;

use app\db\forms\OrderCreateForm;
use app\db\models\PriceCounterparty;
use app\db\models\PriceRetail;

class PriceRepository
{
    public function getOrderItemsPrices(OrderCreateForm $form): array
    {
        $productIds = array_map(fn($p) => $p["product_id"], $form->order_items);
        $counterpartyPrices = PriceCounterparty::find()
            ->where(["counterparty_id" => $form->counterparty_id])
            ->andWhere(["product_id" => $productIds])
            ->indexBy("product_id")
            ->all();
        $missingProductIds = array_diff($productIds, array_keys($counterpartyPrices));
        $missingPrices = PriceRetail::find()
            ->andWhere(["product_id" => $missingProductIds])
            ->indexBy("product_id")
            ->all();
        return $counterpartyPrices + $missingPrices;
    }
}
