<?php
namespace App\Http\Controllers;

use App\Models\Bid;
use App\Http\Requests\CreateBidRequest;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function index()
    {
        $bids = Bid::with('auction', 'item', 'user')->get();
        return response()->json($bids);
    }

    public function store(CreateBidRequest $request)
    {
        $bid = Bid::create($request->validated());
        return response()->json($bid, 201);
    }

    public function show($id)
    {
        $bid = Bid::with('auction', 'item', 'user')->findOrFail($id);
        return response()->json($bid);
    }

    public function update(Request $request, $id)
    {
        $bid = Bid::findOrFail($id);
        $bid->update($request->all());
        return response()->json($bid);
    }

    public function destroy($id)
    {
        Bid::destroy($id);
        return response()->json(null, 204);
    }
}
