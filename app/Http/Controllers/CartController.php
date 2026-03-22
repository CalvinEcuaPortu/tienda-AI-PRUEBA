<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Display the shopping cart
    public function index()
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        
        if (!$cart) {
            return response()->json(['items' => [], 'total' => 0]);
        }

        $items = $cart->items()->with('product')->get();
        $total = $items->sum(function($item) {
            return $item->price * $item->quantity;
        });

        return response()->json(['items' => $items, 'total' => $total]);
    }

    // Add item to cart
    public function addItem(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = Cart::firstOrCreate(['user_id' => auth()->id()]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->price
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Item added to cart']);
    }

    // Update cart item
    public function updateItem(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['success' => true, 'message' => 'Item updated']);
    }

    // Remove item from cart
    public function removeItem($itemId)
    {
        $cartItem = CartItem::findOrFail($itemId);
        $cartItem->delete();

        return response()->json(['success' => true, 'message' => 'Item removed from cart']);
    }

    // Clear entire cart
    public function clear()
    {
        $cart = Cart::where('user_id', auth()->id())->first();
        
        if ($cart) {
            $cart->items()->delete();
        }

        return response()->json(['success' => true, 'message' => 'Cart cleared']);
    }
}