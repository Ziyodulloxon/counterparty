<?php

namespace app\db\repositories;

use app\db\models\Product;

class ProductRepository
{
    public function getAllProductNames(): array
    {
        return Product::find()
            ->select("name")
            ->indexBy("id")
            ->column();
    }
}
