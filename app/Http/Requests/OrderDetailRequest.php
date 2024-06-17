<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'picture_id' => 'required|exists:pictures,id',
            'price' => 'required|numeric',
            'bids_id' => 'nullable|exists:bids,id',
            'order_id' => 'nullable|exists:order_details,id',
            'Purchase_type' => 'required|string|max:255',
        ];
    }
}
