<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreatePictresRequest;
use App\Models\Picture;
use Illuminate\Http\Request;

class PictureController extends Controller
{
    // Get all pictures
    public function index()
    {
        return Picture::all();
    }

    // Get a single picture
    public function show($id)
    {
        return Picture::findOrFail($id);
    }

    // Create a new picture
    public function store(CreatePictresRequest $request)
    {
        $validatedData = $request->validated();
        $pictures=Picture::create($validatedData);
        return response()->json($pictures, 201);
    }

    // Update an existing picture
    public function update(Request $request, $id)
    {
        
        $picture = Picture::findOrFail($id);
        $picture->update($request->all());

        return $picture;
    }

    // Delete a picture
    public function destroy($id)
    {
        return Picture::destroy($id);
    
    }
}
