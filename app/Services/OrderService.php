<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function createOrder(array $data)
    {
        return Order::create($data);
    }
}