<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Http\Requests\OrderDetailRequest;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetails = OrderDetail::with(['picture', 'bid'])->get();
        return response()->json($orderDetails);
    }

    public function store(OrderDetailRequest $request)
    {
        $orderDetail = OrderDetail::create($request->validated());
        return response()->json($orderDetail, 201);
    }

    public function show(OrderDetail $orderDetail)
    {
        return response()->json($orderDetail->load(['picture', 'bid']));
    }

    public function update(OrderDetailRequest $request, OrderDetail $orderDetail)
    {
        $orderDetail->update($request->validated());
        return response()->json($orderDetail);
    }

    public function destroy(OrderDetail $orderDetail)
    {
        $orderDetail->delete();
        return response()->json(null, 204);
    }
}
