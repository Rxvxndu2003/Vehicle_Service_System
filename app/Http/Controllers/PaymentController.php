<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function show($orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('pages.payment', compact('order'));
    }

    public function process(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        
        // Process payment logic goes here
        // Example: Charge via a payment gateway like Stripe, PayPal, etc.

        // If payment successful
        $order->payment_status = 'Paid';
        $order->save();

        // Redirect to a confirmation page
        return redirect()->route('order.confirmation', ['order' => $order->id]);
    }

    public function confirmation($orderId)
{
    $order = Order::findOrFail($orderId);
    return view('order.confirmation', compact('order'));
}

}
