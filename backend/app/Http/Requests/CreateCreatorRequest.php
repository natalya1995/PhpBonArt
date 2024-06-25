<?php

namespace App\Http\Requests;
use App\Models\Creator;
use Illuminate\Foundation\Http\FormRequest;

class CreateCreatorRequest extends FormRequest
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
            'name' => 'sometimes|required|string|max:255',
            'YY' => 'sometimes|required|string|max:255',
            'biography' => 'sometimes|required|string',
            'picture_id' => 'nullable|exists:pictures,id', ];
    }
}
