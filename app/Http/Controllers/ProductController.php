<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    //public function showProducts()
    public function fetchProducts(Request $request)
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function getProductDetails($id)
{
    $product = Product::findOrFail($id); // Fetch product details from the database
    return response()->json([
        'image' => $product->image,
        'name' => $product->name,
        'rating' => $product->rating,
        'price' => $product->price,
    ]);
}
public function show($id)
{
    $product = Product::findOrFail($id); // Fetch the product by ID
    return view('pages.item', compact('product')); // Pass product details to the view
}

}
