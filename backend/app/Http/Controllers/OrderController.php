<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        try {
            $orders = Order::with('orderDetails')->where('user_id', auth()->id())->get();
            return response()->json($orders);
        } catch (\Exception $e) {
            Log::error('Error fetching orders: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function store(OrderRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $order = Order::create([
                'user_id' => auth()->id(),
                'status_order' => $validatedData['status_order'] ?? 'pending',
                'sum' => $validatedData['sum'],
            ]);

            foreach ($validatedData['items'] as $item) {
                $order->orderDetails()->create($item);
            }

            return response()->json($order, 201);
        } catch (\Exception $e) {
            Log::error('Error creating order: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function show($id)
    {
        try {
            $order = Order::with('orderDetails')->findOrFail($id);
            return response()->json($order);
        } catch (\Exception $e) {
            Log::error('Error fetching order: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function update(OrderRequest $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->update($request->all());
            return response()->json($order);
        } catch (\Exception $e) {
            Log::error('Error updating order: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            Order::destroy($id);
            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('Error deleting order: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function addToCart(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'picture_id' => 'required|integer|exists:pictures,id',
                'price' => 'required|numeric',
                'bids_id' => 'nullable|integer',
                'purchase_type' => 'nullable|string',
            ]);
    
            $order = Order::firstOrCreate(
                ['user_id' => $request->user()->id, 'status_order' => false],
                ['sum' => 0]
            );
    
            $orderDetail = new OrderDetail([
                'picture_id' => $validatedData['picture_id'],
                'price' => $validatedData['price'],
                'bids_id' => $validatedData['bids_id'] ?? null,
                'Purchase_type' => $validatedData['purchase_type'] ?? null,
            ]);
    
            $order->orderDetails()->save($orderDetail);
            $order->sum += $orderDetail->price;
            $order->save();
    
            return response()->json($order->load('orderDetails'), 201);
        } catch (\Exception $e) {
            \Log::error('Error adding to cart: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
    

public function getCart(Request $request)
{
    try {
        $user = $request->user();

       
        $order = Order::where('user_id', $user->id)
            ->where('status_order', false)
            ->with('orderDetails.picture')
            ->first();

        if ($order) {
            return response()->json($order->orderDetails);
        } else {
            return response()->json([]);
        }
    } catch (\Exception $e) {
        \Log::error('Error fetching cart: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}
public function payOrder(Request $request)
{
    try {
        $user = $request->user();
        
       
        $order = Order::where('user_id', $user->id)
            ->where('status_order', false)
            ->with('orderDetails.picture')
            ->first();
        
        if (!$order) {
            return response()->json(['message' => 'No pending order found'], 404);
        }

        $order->status_order = true;
        $order->save();

        
        $soldLocationId = \App\Models\Location::where('name', 'Продана')->first()->id;

        foreach ($order->orderDetails as $orderDetail) {
            $picture = $orderDetail->picture;
            $picture->location_id = $soldLocationId;
            $picture->save();
        }

        return response()->json(['message' => 'Order paid successfully'], 200);
    } catch (\Exception $e) {
        \Log::error('Error updating order status: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}


    
}
