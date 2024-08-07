<?php

namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $this->route('user')->id,
            'password' => 'sometimes|required|string|min:8',
            'phone'=>'nullable|integer',
            'bit_id' => 'nullable|exists:bids,id',
        ];
    }
}
