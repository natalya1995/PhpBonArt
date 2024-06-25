<?php

namespace App\Http\Controllers;
use App\Models\Janre;
use Illuminate\Http\Request;
use App\Http\Requests\CreateJanreRequest;
class JanreController extends Controller
{
   
    public function index()
    {
        return Janre::all();
    }

    public function show($id)
    {
      return Janre::findOrFail($id);
    }

    public function store(CreateJanreRequest $request)
    { 
        $validatedData = $request->validated();
        $janre=Janre::create($validatedData);
        return response()->json($janre, 201);
    }

    public function update(Request $request, $id)
    {
        $janre = Janre::findOrFail($id);
        $janre->update($request->all());
        return $janre;

    }

    
    public function destroy($id)
    {
        return Janre::destroy($id);
    }
}
