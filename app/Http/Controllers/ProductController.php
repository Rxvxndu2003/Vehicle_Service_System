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
}
