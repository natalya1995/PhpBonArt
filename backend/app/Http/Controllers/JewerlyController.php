<?php

namespace App\Http\Controllers;

use App\Models\Jewerly;
use App\Http\Requests\JewerlyRequest;
use Illuminate\Http\Request;

class JewerlyController extends Controller
{
    public function index()
    {
        
        return Jewerly::all();
    }

    public function store(JewerlyRequest $request)
    {
        $validatedData = $request->validated();
        $jewerly=Jewerly::create($validatedData);
        return response()->json($jewerly, 201);
    }

    public function show($id)
    {
        return Jewerly::findOrFail($id);
    }

    public function update(JewerlyRequest $request,$id)
    {
        $jewerly = Jewerly::findOrFail($id);
        $jewerly->update($request->all());
        return $jewerly;
    }

    public function destroy($id)
    {
        return Jewerly::destroy($id);
    }
}
