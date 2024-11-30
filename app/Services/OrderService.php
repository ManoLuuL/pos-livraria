<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderService
{
    protected $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllOrders($filters = [])
    {
        $query = Order::with('books');
    
        if (!empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }
    
        return $query->paginate();
    }
    
    public function getOrderById($id)
    {
        return $this->repository->getById($id);
    }

    public function createOrder(array $data)
    {
        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $data['user_id'],
                'total_price' => $data['total_price'],
            ]);

          
            foreach ($data['book_ids'] as $book) {
                $order->books()->attach($book['id'], ['quantity' => $book['quantity']]);
            }

           
            DB::commit();

            return $order;
        } catch (\Exception $e) {
           
            DB::rollBack();
            throw $e;
        }
    }

    public function updateOrder($id, array $data)
{
   

   
        $order = $this->repository->getById($id);

        if (!empty($data['book_ids'])) {
          
            $order->books()->detach();

            foreach ($data['book_ids'] as $book) {
                $order->books()->attach($book['id'], ['quantity' => $book['quantity']]);
            }
        }

       
        return $order;
   
}


    public function deleteOrder($id)
    {
        $order = $this->repository->getById($id);
        return $this->repository->delete($order);
    }
}
