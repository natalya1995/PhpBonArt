<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Http\Requests\SectorRequest;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        return Sector::all();
    }

    public function store(SectorRequest $request)
    {
     
        $validatedData = $request->validated();
        $sectors=Sector::create($validatedData);
        return response()->json($sectors, 201);
    }

    public function show($id)
    {
        return Sector::findOrFail($id);
    }

    public function update(SectorRequest $request,$id)
    {
        $sectors = Sector::findOrFail($id);
        $sectors->update($request->all());

        return $sectors;
    }

    public function destroy($id)
    {
        return Sector::destroy($id);
    
    }
}
