<?php

namespace App\Http\Controllers;

use App\Models\Jewerly;
use App\Http\Requests\JewerlyRequest;
use Illuminate\Http\Request;

class JewerlyController extends Controller
{
    public function index()
    {
        $jewerlies = Jewerly::all();
        return response()->json($jewerlies);
    }

    public function store(JewerlyRequest $request)
    {
        $jewerly = Jewerly::create($request->validated());
        return response()->json($jewerly, 201);
    }

    public function show(Jewerly $jewerly)
    {
        return response()->json($jewerly);
    }

    public function update(JewerlyRequest $request, Jewerly $jewerly)
    {
        $jewerly->update($request->validated());
        return response()->json($jewerly);
    }

    public function destroy(Jewerly $jewerly)
    {
        $jewerly->delete();
        return response()->json(null, 204);
    }
}
