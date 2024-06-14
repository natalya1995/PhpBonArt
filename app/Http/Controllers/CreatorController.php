<?php

namespace App\Http\Controllers\Api;

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
        $creator=Creator::create('validatedData');
        return response()->json($creator, 201);
    }

    public function show($id)
    {
        return Creator::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $creator = Creator::findOrFail($id);
        $creator->update($request->all());
        return $creator;
    }

    public function destroy($id)
    {
        $creator->delete();

        return response(null, 204);
    }
}