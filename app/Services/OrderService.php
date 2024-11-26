<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function list()
    {
        return $this->orderRepository->all();
    }

    public function create(array $data)
    {
        return $this->orderRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->orderRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->orderRepository->delete($id);
    }
}
