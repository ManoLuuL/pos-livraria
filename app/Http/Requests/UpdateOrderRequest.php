<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function rules()
    {
        return [
            'book_ids' => 'nullable|array',
            'book_ids.*.id' => 'exists:books,id',
            'book_ids.*.quantity' => 'required_with:book_ids|integer|min:1',
        ];
    }
}
