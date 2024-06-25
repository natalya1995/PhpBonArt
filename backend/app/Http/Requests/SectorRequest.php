<?php

namespace App\Http\Requests;
use App\Models\Sector;
use Illuminate\Foundation\Http\FormRequest;

class SectorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'num' => 'required|integer',
            'picture_id' => 'nullable|exists:pictures,id'
        ];
    }
}
