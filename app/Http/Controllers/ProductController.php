<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of the resource.
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    // Display the specified resource.
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    // Show the form for creating a new resource.
    public function create()
    {
        // Display form (if using web views)
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'sometimes|string',
        ]);

        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    // Show the form for editing the specified resource.
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        // Display form (if using web views)
    }

    // Update the specified resource in storage.
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required',
            'price' => 'sometimes|required|numeric',
            'description' => 'sometimes|string',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());
        return response()->json($product);
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }
}