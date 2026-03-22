<?php

namespace App\\Http\\Controllers;

use Illuminate\\Http\\Request;
use App\\Models\\Order;

class OrderController extends Controller
{
    // Create a new order
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'customer_id' => 'required|integer',
        ]);
        
        $order = Order::create([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'customer_id' => $request->customer_id,
        ]);

        return response()->json($order, 201);
    }

    // Retrieve all orders
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    // Retrieve a specific order
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return response()->json($order);
    }

    // Update an order
    public function update(Request $request, $id)
    {
        $request->validate([
            'product_id' => 'integer',
            'quantity' => 'integer',
            'customer_id' => 'integer',
        ]);

        $order = Order::findOrFail($id);
        $order->update($request->all());

        return response()->json($order);
    }

    // Delete an order
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(null, 204);
    }
}