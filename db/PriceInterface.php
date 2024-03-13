<?php

namespace app\db;

interface PriceInterface
{
    public function getPrice(): int;

    public function getProductId(): int;
}
