@extends('Layout.layoutcheckout')

@section('header')
<h1 class="display-3 text-white mb-3 animated slideInDown">Checkout</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center text-uppercase">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item text-white active" aria-current="page">Checkout</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <!-- Billing Details Form -->
        <div class="col-md-7">
            <h3>Billing Details</h3>
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="first_name">Full name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="address">Street address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="House number and street name" required>
                </div>

                <div class="form-group">
                    <label for="postal_code">Postcode / ZIP <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="payment_method">Payment Method <span class="text-danger">*</span></label>
                    <select class="form-control" id="payment_method" name="payment_method" required>
                        <option value="credit_card">Cash On Delivery</option>
                        <option value="paypal">Koko: Buy Now Pay Later</option>
                        <option value="bank_transfer">Bank Transfer</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="create_account" name="create_account">
                    <label for="create_account">Create an account?</label>
                </div>

                <!-- Order Summary and Payment Methods -->
                <div class="col-md-5">
                    <h3>Your Order</h3>
                    <div class="order-summary">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loop through cart items -->
                                @foreach(session('cart', []) as $id => $details)
                                <tr>
                                    <td>{{ $details['name'] }} × {{ $details['quantity'] }}</td>
                                    <td>Rs. {{ $details['price'] * $details['quantity'] }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>Subtotal</td>
                                    <td>Rs. {{ $subtotal }}</td>
                                </tr>
                                <tr>
                                    <td>Delivery Charge</td>
                                    <td>Rs. {{ $delivery_charge }}</td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td>Rs. {{ $total }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3>Payment Methods</h3>
                    <div class="payment-methods">
                        <div class="form-group">
                            <input type="radio" id="cash_on_delivery" name="payment_method" value="cash_on_delivery" checked>
                            <label for="cash_on_delivery">Cash on delivery</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" id="koko" name="payment_method" value="koko">
                            <label for="koko">Koko: Buy Now Pay Later</label>
                        </div>
                        <div class="form-group">
                            <input type="radio" id="webxpay" name="payment_method" value="webxpay">
                            <label for="webxpay">Bank Transfer</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="checkbox" id="terms_conditions" name="terms_conditions" required>
                        <label for="terms_conditions">I have read and agree to the website terms and conditions <span class="text-danger">*</span></label>
                    </div>

                    <!-- Place the submit button inside the form -->
                    <button id="checkoutButton" class="btn btn-primary btn-block">Checkout</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="payNowModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Thank you for Your Order !!!</h2>
        <p>Click the button below to proceed with the payment.</p>
        <button class="close">Pay Now</button>
    </div>
</div>

@endsection

