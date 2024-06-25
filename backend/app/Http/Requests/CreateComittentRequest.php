<?php

namespace App\Http\Requests;
use App\Models\Comittent;
use Illuminate\Foundation\Http\FormRequest;

class CreateComittentRequest extends FormRequest
{

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
            'name' => 'required|string|max:255',
            'IIN' => 'required|string|max:255', 
            'num_udv' => 'required|string|max:255',
            'picture_id' => 'nullable|exists:pictures,id',
            'entry_price' => 'required|numeric|min:0',
        ];
    }
}
