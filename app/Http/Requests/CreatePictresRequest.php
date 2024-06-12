<?php

namespace App\Http\Requests;
use App\Models\Picture;
use Illuminate\Foundation\Http\FormRequest;

class CreatePictresRequest extends FormRequest
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
           'title' => 'required|string|max:255',
            'img' => 'required|string',
            'creator_id' => 'nullable|integer',
            'size' => 'required|string',
            'description' => 'required|string',
            'janre_id' => 'nullable|integer',
            'location_id' => 'nullable|integer',
            'sector_id' => 'nullable|integer',
            'committent_id' => 'nullable|integer',
            'estimate' => 'required|numeric',
        ];
    }
}
