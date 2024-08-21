<?php
namespace App\Http\Controllers;

use App\Models\Location;
use App\Http\Requests\LocationRequest;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return Location::all();
    }

    public function store(LocationRequest $request)
    {  
        $validatedData = $request->validated();
        $location = Location::create($validatedData);
        return response()->json($location, 201);
    }

    public function show($id)
    {
        return Location::findOrFail($id);
    }

    public function update(LocationRequest $request, $id)
    {  
        $location = Location::findOrFail($id);
        $location->update($request->all());
        return $location;
    }

    public function destroy($id)
    {
        return Location::destroy($id);
    }

   
    public function updateLocationForPicture(Request $request, $id)
    {
        $location = Location::findOrFail($id);
        
       
        $pictures = $location->pictures;
        foreach ($pictures as $picture) {
            $picture->update(['location_id' => $location->id]);
        }

        return response()->json(['message' => 'Location updated for all pictures'], 200);
    }
}

