<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    protected $service;

    public function __construct(OrderService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $filters = request()->only('user_id');
        $orders = $this->service->getAllOrders($filters);
        return OrderResource::collection($orders);
    }
    

    public function store(StoreOrderRequest $request)
    {
        $order = $this->service->createOrder($request->validated());
        return new OrderResource($order);
    }

    public function show($id)
    {
        $order = $this->service->getOrderById($id);
        return new OrderResource($order);
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $order = $this->service->updateOrder($id, $request->validated());
        return new OrderResource($order);
    }

    public function destroy($id)
    {
        $this->service->deleteOrder($id);
        return response()->json(['message' => 'Order deleted successfully']);
    }
}
