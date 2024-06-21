<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\OrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return Order::all();
    }

    public function store(OrderRequest $request)
    {
        $validatedData = $request->validated();
        $order=Order::create($validatedData);
        return response()->json($order, 201);
    }

    public function show($id)
    {
        return Order::findOrFail($id);
    }

    public function update(OrderRequest $request,$id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return $order;
    }

    public function destroy($id)
    {
        return Order::destroy($id);
    }
}
