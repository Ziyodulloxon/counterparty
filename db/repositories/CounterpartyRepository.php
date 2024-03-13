<?php

namespace app\db\repositories;

use app\db\models\Counterparty;

class CounterpartyRepository
{
    public function getAllCounterpartiesName(): array
    {
        return Counterparty::find()
            ->select("name")
            ->indexBy("id")
            ->column();
    }
}