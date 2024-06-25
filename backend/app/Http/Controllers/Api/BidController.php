<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use Illuminate\Http\Request;
use App\Http\Requests\CreateBidRequest;

class BidController extends Controller
{
   
    public function index()
    {
        return Bid::all();
    }

    public function store(CreateBidRequest $request)
    {
  
        $validatedData = $request->validated();
        $bid=Bid::create('validatedData');
        return response()->json($bid, 201);
    }

    public function show($id)
    {
        return Bid::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $bid = Bid::findOrFail($id);
        $bid->update($request->all());
        return $bid;
    }
    public function destroy($id)
    {
        $bid = Bid::findOrFail($id);
        $bid->delete();
        return response(null,204);
    }
}
