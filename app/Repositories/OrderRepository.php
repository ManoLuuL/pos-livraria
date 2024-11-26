<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function all()
    {
        return Order::all();
    }

    public function create(array $data)
    {
        return Order::create($data);
    }

    public function find(int $id)
    {
        return Order::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $order = $this->find($id);
        $order->update($data);
        return $order;
    }

    public function delete(int $id)
    {
        $order = $this->find($id);
        return $order->delete();
    }
}
