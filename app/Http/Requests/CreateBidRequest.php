<?php

namespace App\Http\Requests;
use App\Models\Bid;
use Illuminate\Foundation\Http\FormRequest;

class CreateBidRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'auction_id' => 'required|integer|exists:auctions,id',
            'user_id' => 'required|integer|exists:users,id',
            'bin_amount' => 'required|numeric',
            'bin_time' => 'required|date_format:Y-m-d H:i:s',
        ];
    }
}
