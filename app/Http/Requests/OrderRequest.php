<?php

namespace App\Http\Requests;
use App\Models\Order;
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
            'user_id' => 'nullable|exists:users,id',
            'status_order' => 'nullable|string|max:255',
            'sum' => 'required|numeric',
         
        ];
    }
}
