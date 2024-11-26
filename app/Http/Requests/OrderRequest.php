<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'book_ids' => 'required|array',
            'book_ids.*' => 'exists:books,id',
            'total_price' => 'required|numeric|min:0',
        ];
    }
}

