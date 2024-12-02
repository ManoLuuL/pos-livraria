<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class ProcessBestSellingBooksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $fileName;

    /**
     * Cria uma nova instância do Job.
     */
    public function __construct(string $fileName = 'reports/order_report.json')
    {
        $this->fileName = $fileName;
    }

    /**
     * Executa o Job.
     */
    public function handle()
    {
        // Recupera os pedidos com os livros, categorias e autores associados
        $orders = Order::with(['books.category', 'books.author', 'user'])->get();

        // Formata os dados do relatório
        $reportData = $orders->map(function ($order) {
            return [
                'order_id' => $order->id,
                'user' => [
                    'id' => $order->user->id,
                    'name' => $order->user->name,
                ],
                'total_price' => $order->total_price,
                'books' => $order->books->map(function ($book) {
                    return [
                        'book_id' => $book->id,
                        'title' => $book->title,
                        'author' => $book->author->name ?? 'N/A',
                        'category' => $book->category->name ?? 'N/A',
                        'quantity' => $book->pivot->quantity,
                    ];
                }),
                'created_at' => $order->created_at->toDateTimeString(),
            ];
        });

        // Salva o relatório no formato JSON
        Storage::put($this->fileName, $reportData->toJson(JSON_PRETTY_PRINT));
    }
}
