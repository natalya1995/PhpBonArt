<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function getUserBids(Request $request)
{
    $user = $request->user();

    if (!$user) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    $bids = Bid::with('auction', 'item')
               ->where('user_id', $user->id)
               ->get();

    return response()->json($bids);
}

  public function store(Request $request)
{
    $validatedData = $request->validate([
        'auction_id' => 'required|exists:auctions,id',
        'user_id' => 'required|exists:users,id',
        'item_id' => 'nullable|exists:items,id',
        'bin_amount' => 'required|numeric',
        'bid_time' => 'required|date',
    ]);

    $bid = Bid::create($validatedData);
    return response()->json($bid, 201);
}

    
    public function show($id)
    {
        $bid = Bid::with('auction', 'item', 'user')->findOrFail($id);
        return response()->json($bid);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'auction_id' => 'sometimes|required|exists:auctions,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'item_id' => 'nullable|exists:items,id',
            'bin_amount' => 'sometimes|required|numeric',
            'bid_time' => 'sometimes|required|date',
        ]);

        $bid = Bid::findOrFail($id);
        $bid->update($validatedData);

        return response()->json($bid);
    }

    public function destroy($id)
    {
        Bid::destroy($id);
        return response()->json(null, 204);
    }
}
