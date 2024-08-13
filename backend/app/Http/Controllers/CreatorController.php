<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Creator;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCreatorRequest;

class CreatorController extends Controller
{
    public function index()
    {
        return Creator::all();
    }

    public function store(CreateCreatorRequest $request)
    {
        $validatedData = $request->validated();
        $creator=Creator::create($validatedData);
        return response()->json($creator, 201);
    }

    public function show($id)
    {
        $creator = Creator::with('pictures')->findOrFail($id);
        return response()->json([
            'creator' => $creator,
            'paintings' => $creator->pictures,
        ]);
    }

    public function update(Request $request, $id)
    {
        $creator = Creator::findOrFail($id);
        $creator->update($request->all());
        return $creator;
    }

    public function destroy($id)
    {
        return Creator::destroy($id);
      
    }
}