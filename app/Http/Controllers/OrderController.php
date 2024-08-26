<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        // Fetch orders for the authenticated user
        $orders = Order::where('user_id', auth()->id())->get();

        // Pass orders to the view
        return view('pages.order', compact('orders'));
    }
}