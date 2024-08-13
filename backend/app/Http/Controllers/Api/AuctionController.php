<?php
namespace App\Http\Controllers;

use App\Models\Auction;
use App\Http\Requests\CreateAuctionRequest;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index()
    {
        $auctions = Auction::with('items')->get();
        return response()->json($auctions);
    }

    public function store(CreateAuctionRequest $request)
    {
        $auction = Auction::create($request->validated());
        return response()->json($auction, 201);
    }

    public function show($id)
    {
        $auction = Auction::with('items.bids')->findOrFail($id);
        return response()->json($auction);
    }

    public function update(Request $request, $id)
    {
        $auction = Auction::findOrFail($id);
        $auction->update($request->all());
        return response()->json($auction);
    }

    public function destroy($id)
    {
        Auction::destroy($id);
        return response()->json(null, 204);
    }
}
