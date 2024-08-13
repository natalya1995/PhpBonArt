<?php
namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        // Получаем все лоты
        $items = Item::with('auction', 'winningBid')->get();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        // Валидация запроса
        $validatedData = $request->validate([
            'auction_id' => 'required|exists:auctions,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'starting_price' => 'required|numeric',
        ]);

        // Создание нового лота
        $item = Item::create($validatedData);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        // Получаем конкретный лот
        $item = Item::with('auction', 'bids', 'winningBid')->findOrFail($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        // Валидация запроса
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'starting_price' => 'sometimes|required|numeric',
            'current_price' => 'sometimes|required|numeric',
            'winning_bid_id' => 'nullable|exists:bids,id',
        ]);

        // Обновление лота
        $item = Item::findOrFail($id);
        $item->update($validatedData);
        return response()->json($item);
    }

    public function destroy($id)
    {
        // Удаление лота
        $item = Item::findOrFail($id);
        $item->delete();
        return response()->json(null, 204);
    }
}
