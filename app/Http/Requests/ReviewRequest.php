<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'product_id' => 'required|required|integer|exists:products,id',
            'user_id'    => 'required|required|integer|exists:users,id',
            'rating'     => 'required|numeric',
            'comment'    => 'required|string',
        ];
    }
}
