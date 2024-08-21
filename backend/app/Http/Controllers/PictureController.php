<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreatePictresRequest;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    public function index()
    {
      
        $pictures = Picture::with('location')->get();
    
       
        $filteredPictures = $pictures->filter(function ($picture) {
            return $picture->location && $picture->location->name != 'Продана';
        });
    
        return $filteredPictures->values();
    }
    
    
 
    public function show($id)
    {
        return Picture::findOrFail($id);
    }

   
    public function store(CreatePictresRequest $request)
    {
        $validatedData = $request->validated();
        $pictures=Picture::create($validatedData);
        return response()->json($pictures, 201);
    }

 
    public function update(Request $request, $id)
    {
        $picture = Picture::findOrFail($id);
    
     
        if ($request->has('location_id')) {
            $picture->location_id = $request->input('location_id');
        }
    

        $picture->update($request->except('location_id'));
    
        return $picture;
    }
  
    public function destroy($id)
    {
        return Picture::destroy($id);
    
    }
}
