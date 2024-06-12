<?php

namespace App\Http\Controllers;
use App\Models\Auction;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
  
    public function index()
    {
        return Auction::all();
    }

  
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'img' => 'required|string|max:255',
            'creator_id' => 'nullable|integer',
            'description' => 'required|string', 
            'num_pages' => 'nullable|integer',
            'num_copy' => 'nullable|integer',
            'estimate' => 'required|numeric',
            'location_id' => 'nullable|integer',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
