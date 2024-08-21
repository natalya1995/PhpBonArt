<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['auction', 'winningBid', 'picture', 'book', 'jewerly'])->get();
        return response()->json($items);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'auction_id' => 'required|exists:auctions,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'starting_price' => 'required|numeric',
            'current_price' => 'nullable|numeric',
            'winning_bid_id' => 'nullable|exists:bids,id',
            'picture_id' => 'nullable|exists:pictures,id', 
            'book_id' => 'nullable|exists:books,id',     
            'jewerly_id' => 'nullable|exists:jewelries,id', 
        ]);

  
        $item = Item::create($validatedData);

     
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = Item::with(['auction', 'winningBid', 'picture', 'book', 'jewerly'])->findOrFail($id); 
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'starting_price' => 'sometimes|required|numeric',
            'current_price' => 'sometimes|required|numeric',
            'winning_bid_id' => 'nullable|exists:bids,id',
            'picture_id' => 'nullable|exists:pictures,id', 
            'book_id' => 'nullable|exists:books,id',     
            'jewerly_id' => 'nullable|exists:jewelries,id',
        ]);

        $item = Item::findOrFail($id);
        $item->update($validatedData);

        return response()->json($item);
    }

    public function destroy($id)
    {
        Item::destroy($id);
        return response()->json(null, 204);
    }
}
