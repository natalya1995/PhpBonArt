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
            'items' => 'required|array',
            'items.*.picture_id' => 'required|integer|exists:pictures,id',
            'items.*.price' => 'required|numeric',
            'status_order' => 'required|string|in:В ожидании,оплачен,canceled',
            'address' => 'required|string|max:255',
            'paymentMethod' => 'required|string|in:credit_card,paypal',
        ];
    }
    
}
