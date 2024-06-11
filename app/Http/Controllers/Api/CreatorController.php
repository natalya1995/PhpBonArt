<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Creator;
use Illuminate\Http\Request;

class CreatorController extends Controller
{
    public function index()
    {
        return Creator::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'YY' => 'required|string|max:255',
            'biography' => 'required|string',
            'picture_id' => 'nullable|exists:pictures,id', // Валидация внешнего ключа 
        ]);

        return Creator::create($request->all());
    }

    public function show(Creator $creator)
    {
        return $creator;
    }

    public function update(Request $request, Creator $creator)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'YY' => 'sometimes|required|string|max:255',
            'biography' => 'sometimes|required|string',
            'picture_id' => 'nullable|exists:pictures,id', // Валидация внешнего ключа
        ]);

        $creator->update($request->all());

        return $creator;
    }

    public function destroy(Creator $creator)
    {
        $creator->delete();

        return response(null, 204);
    }
}