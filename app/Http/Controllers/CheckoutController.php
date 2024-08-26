<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
{
    // Retrieve cart items from the session
    $cartItems = session('cart', []);

    // Calculate subtotal
    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }

    // Define delivery charge
    $delivery_charge = 100; // You can adjust this as needed

    // Calculate total
    $total = $subtotal + $delivery_charge;

    // Pass these values to the view
    return view('pages.checkout', [
        'cartItems' => $cartItems,
        'subtotal' => $subtotal,
        'delivery_charge' => $delivery_charge,
        'total' => $total,
    ]);
}


public function store(Request $request)
{
    $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:255',
        'postal_code' => 'required|string|max:10',
        'phone' => 'required|string|max:20',
        'payment_method' => 'required|string',
        'terms_conditions' => 'accepted',
    ]);

    // Process payment here (e.g., using a payment gateway API)

    // Save order details to the database
    $order = new Order();
    $order->user_id = auth()->id();
    $order->full_name = $request->full_name;
    $order->email = $request->email;
    $order->address = $request->address;
    $order->postal_code = $request->postal_code;
    $order->phone = $request->phone;
    $order->payment_details = $validatedData['payment_method']; // Capture payment method
    $order->total = array_sum(array_column(Session::get('cart', []), 'price'));
    $order->save();

    // Clear the cart
    Session::forget('cart');

    return redirect()->route('orders.index', ['order' => $order->id])->with('success', 'Order placed successfully!');
}
}