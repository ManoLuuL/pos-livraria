<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Services\OrderService;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
        $orders = $this->orderService->list();
        return OrderResource::collection($orders);
    }

    public function store(OrderRequest $request)
    {
        $order = $this->orderService->create($request->validated());
        return new OrderResource($order);
    }

    public function update(OrderRequest $request, $id)
    {
        $order = $this->orderService->update($id, $request->validated());
        return new OrderResource($order);
    }

    public function destroy($id)
    {
        $this->orderService->delete($id);
        return response()->json(['message' => 'Order deleted successfully']);
    }
}

