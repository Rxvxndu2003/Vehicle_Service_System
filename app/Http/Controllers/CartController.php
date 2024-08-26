<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cart = Session::get('cart', []);
        return view('pages.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'Please log in to add items to the cart'], 401);
        }
    
        $product = Product::find($request->id);
        $cart = Session::get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        
        Session::put('cart', $cart);
    
        // Save to database
        \App\Models\Cart::updateOrCreate(
            ['user_id' => auth()->id(), 'product_id' => $product->id],
            ['quantity' => $cart[$product->id]['quantity']]
        );
    
        return response()->json(['message' => 'Product added to cart']);
    }

    public function update(Request $request)
{
    $cart = session()->get('cart');

    if ($request->id && $request->quantity && isset($cart[$request->id])) {
        $cart[$request->id]['quantity'] = $request->quantity;
        session()->put('cart', $cart);

        // Save to database
        \App\Models\Cart::where('user_id', auth()->id())
            ->where('product_id', $request->id)
            ->update(['quantity' => $request->quantity]);

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Failed to update cart']);
}
    
public function remove(Request $request)
{
    $cart = session()->get('cart');

    if ($request->id && isset($cart[$request->id])) {
        unset($cart[$request->id]);
        session()->put('cart', $cart);

        // Remove from database
        \App\Models\Cart::where('user_id', auth()->id())
            ->where('product_id', $request->id)
            ->delete();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'message' => 'Failed to remove item']);
}
    
}
