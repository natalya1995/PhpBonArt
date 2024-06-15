<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PictureJanreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'picture_id' => 'required|exists:pictures,id',
            'janre_id' => 'required|exists:janres,id',
        ];
    }
}
