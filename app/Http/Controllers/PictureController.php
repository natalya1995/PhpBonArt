<?php

namespace App\Http\Controllers;

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
        return Picture::find($id);
    }

    // Create a new picture
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'img' => 'required|string',
            'creator_id' => 'nullable|integer',
            'size' => 'required|string',
            'description' => 'required|string',
            'janre_id' => 'nullable|integer',
            'location_id' => 'nullable|integer',
            'sector_id' => 'nullable|integer',
            'committent_id' => 'nullable|integer',
            'estimate' => 'required|numeric',
        ]);

        return Picture::create($request->all());
    }

    // Update an existing picture
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'img' => 'required|string',
            'creator_id' => 'nullable|integer',
            'size' => 'required|string',
            'description' => 'required|string',
            'janre_id' => 'nullable|integer',
            'location_id' => 'nullable|integer',
            'sector_id' => 'nullable|integer',
            'committent_id' => 'nullable|integer',
            'estimate' => 'required|numeric',
        ]);

        $picture = Picture::find($id);
        $picture->update($request->all());

        return $picture;
    }

    // Delete a picture
    public function destroy($id)
    {
        return Picture::destroy($id);
    }
}
