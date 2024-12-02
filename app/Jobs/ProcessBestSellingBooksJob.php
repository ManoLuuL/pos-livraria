<?php

namespace App\Jobs;

use App\Models\Book;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessBestSellingBooksJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $days;

    /**
     * Create a new job instance.
     */
    public function __construct(int $days)
    {
        $this->days = $days;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $books = Book::withCount(['orders' => function ($query) {
            $query->where('orders.created_at', '>=', now()->subDays($this->days));
        }])
            ->orderBy('orders_count', 'desc')
            ->take(10)
            ->get();

        Log::info("Relatório de Livros Mais Vendidos nos Últimos {$this->days} Dias:", $books->toArray());
    }
}
