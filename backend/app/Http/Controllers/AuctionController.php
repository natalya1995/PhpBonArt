<?php
namespace App\Http\Controllers;

use App\Models\Auction;
use App\Http\Requests\CreateAuctionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


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
        $auction = Auction::with(['items.bids' => function ($query) {
            $query->orderBy('bin_amount', 'desc');
        }])->findOrFail($id);

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
    public function completeAuction($auctionId)
    {
        Log::info('Starting auction completion process for auction ID: ' . $auctionId);
    
        $auction = Auction::with('items.bids')->findOrFail($auctionId);
    
        foreach ($auction->items as $item) {
            if ($item->bids->isNotEmpty()) {
                $winningBid = $item->bids->sortByDesc('bin_amount')->first();
    
                Log::info('Updating item ID: ' . $item->id . ' with winning bid ID: ' . $winningBid->id);
    
                $item->update([
                    'winning_bid_id' => $winningBid->id,
                    'current_price' => $winningBid->bin_amount,
                    
                ]);
            } else {
                Log::info('No bids found for item ID: ' . $item->id);
            }
        }
    
        $auction->update([
            'status' => 'completed',
        ]);
    
        Log::info('Auction completion process finished for auction ID: ' . $auctionId);
    
        return response()->json(['message' => 'Аукцион завершен и победители определены.'], 200);
    }
}
