<?php

namespace App\Http\Requests;
use App\Models\Jewerly;
use Illuminate\Foundation\Http\FormRequest;

class JewerlyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'img' => 'required|url',
            'description' => 'required|string',
            'estimate' => 'required|numeric',
            'location_id' => 'required|exists:locations,id',
        ];
    }
}
