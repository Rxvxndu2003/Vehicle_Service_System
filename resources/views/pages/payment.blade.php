@extends('Layout.layoutpayment')

@section('header')
<h1 class="display-3 text-white mb-3 animated slideInDown">Cart</h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center text-uppercase">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item text-white active" aria-current="page">Cart</li>
    </ol>
</nav>
@endsection

@section('content')
<div class="container">
    <h2>Complete Your Payment</h2>
    <p>Order Total: Rs. {{ $order->total }}</p>
    <form action="{{ route('payment.process', $order->id) }}" method="POST">
        @csrf
        <!-- Payment methods and details go here -->
        <button type="submit" class="btn btn-primary">Pay Now</button>
    </form>
</div>
@endsection