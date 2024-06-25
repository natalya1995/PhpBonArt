<?php

namespace App\Http\Controllers;
use App\Models\Auction;
use Illuminate\Http\Request;
use App\Http\Requests\CreateAuctionRequest;

class AuctionController extends Controller
{
  
    public function index()
    {
        return Auction::all();
    }

  
    public function store(CreateAuctionRequest $request)
    {
        $validatedData = $request->validated();
        $auction=Auction::create('validatedData');
        return response()->json($auction, 201);
    }


    public function show( $id)
    {
        return Auction::findOrFail($id);
    }

 
    public function update(Request $request, $id)
    {
        $auction = Auction::findOrFail($id);
        $auction->update($request->all());
        return $auction;
    }

    public function destroy($id)
    {    $auction->delete();
        return response(null,204);
    }
}
