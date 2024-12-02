<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
    ];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'order_books')->withPivot('quantity')->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
