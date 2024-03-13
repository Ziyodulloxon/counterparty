<?php

namespace app\db;

enum OrderStatus: string
{
    case NEW = "new";
    case COMPLETED = "completed";
}
