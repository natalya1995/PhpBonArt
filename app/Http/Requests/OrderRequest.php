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
            'user_id' => 'required|exists:users,id',
            'status_order' => 'required|string|max:255',
            'sum' => 'required|numeric',
            'order_detail_id' => 'nullable|exists:order_details,id',
        ];
    }
}
