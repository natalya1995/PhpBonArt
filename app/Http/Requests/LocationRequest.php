<?php

namespace App\Http\Requests;
use App\Models\Location;
use Illuminate\Foundation\Http\FormRequest;

class LocationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'picture_id' => 'required|exists:pictures,id',
        ];
    }
}
