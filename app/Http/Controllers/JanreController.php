<?php

namespace App\Http\Controllers;
use App\Models\Janre;
use Illuminate\Http\Request;

class JanreController extends Controller
{
   
    public function index()
    {
        return Janre::all();
    }

    public function show($id)
    {
      return Janre::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'picture_id'=>'nullable|integer',
        ]);
     return Janre::create($request->all());
  }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'picture_id'=>'nullable|integer',
        ]);
        $janre=Janre::find($id);
        $janre->update($request->all());
    return $janre;

    }

    
    public function destroy($id)
    {
        return Janre::destroy($id);
    }
}
