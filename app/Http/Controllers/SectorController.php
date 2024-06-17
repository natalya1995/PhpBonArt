<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use App\Http\Requests\SectorRequest;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::with('pictures')->get();
        return response()->json($sectors);
    }

    public function store(SectorRequest $request)
    {
        $sector = Sector::create($request->validated());
        return response()->json($sector, 201);
    }

    public function show($id)
    {
        return response()->json($sector->load('pictures'));
    }

    public function update(SectorRequest $request,$id)
    {
        $sector->update($request->validated());
        return response()->json($sector);
    }

    public function destroy($id)
    {
        $sector->delete();
        return response()->json(null, 204);
    }
}
