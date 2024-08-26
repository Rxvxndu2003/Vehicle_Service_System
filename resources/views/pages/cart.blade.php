@extends('Layout.layoutcart')

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
    <div class="row">
        <div class="col-md-12">
            <h3>Shopping Cart</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('cart', []) as $id => $details)
                    <tr data-id="{{ $id }}">
                        <td><img src="/storage/{{ $details['image'] }}" width="100" height="100" alt="{{ $details['name'] }}"></td>
                        <td>{{ $details['name'] }}</td>
                        <td>
                            <div class="input-group">
                                <input type="number" value="{{ $details['quantity'] }}" class="form-control quantity" data-id="{{ $id }}" />
                            </div>
                        </td>
                        <td>Rs. {{ $details['price'] }}</td>
                        <td class="item-total">Rs. {{ $details['price'] * $details['quantity'] }}</td>
                        <td>
                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">Remove</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="float-right">
                <a href="{{ route('checkout.index') }}" class="btn btn-success">Proceed to Checkout</a>
            </div>
        </div>
    </div>
</div>
@endsection

