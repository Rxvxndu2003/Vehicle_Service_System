@extends('Layout.layoutorder')

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
    <h2>Your Orders</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Postal Code</th>
                <th>Phone</th>
                <th>Payment Details</th>
                <th>Total</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->full_name }}</td>
                <td>{{ $order->email }}</td>
                <td>{{ $order->address }}</td>
                <td>{{ $order->postal_code }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->payment_details }}</td>
                <td>Rs. {{ $order->total }}</td>
                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection