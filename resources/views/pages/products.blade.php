@extends('Layout.layoutproducts')

@section('header')
    <h1 class="display-3 text-white mb-3 animated slideInDown">Products</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center text-uppercase">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item text-white active" aria-current="page">Products</li>
        </ol>
    </nav>
@endsection

@section('products')
    <div class="container">
        <div id="product-list" class="row"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fetch products using AJAX
            $.ajax({
                url: "{{ route('products.fetch') }}",
                method: 'GET',
                success: function(data) {
                    let productList = '';
                    data.forEach(function(product) {
                        productList += `
                            <div class="col-lg-4 col-sm-6 mb-4">
                                <div class="bg-white p-2 shadow-md">
                                    <div class="text-center">
                                        <a href="#">
                                            <img src="/storage/${product.image}" alt="${product.name}">
                                        </a>
                                    </div>
                                    <div class="detail p-2">
                                        <h4 class="mb-1 fs-5 fw-bold">${product.name}</h4>
                                        <b class="fs-4 text-danger">Rs.${parseFloat(product.price).toFixed(2)}</b>

                                        <ul class="mt-0 vgth">
                                            <li class="fs-8">
                                                ${Array.from({length: 5}, (_, i) => `<i class="bi text-warning bi-star${i < product.rating ? '-fill' : ''}"></i>`).join('')}
                                            </li>
                                            <li class="float-end gvi">
                                                <i class="bi text-danger bi-heart-fill"></i>
                                            </li>
                                        </ul>
                                        <div class="row pt-2">
                                            <div class="col-md-6">
                                                <button class="btn mb-2 fw-bold w-100 btn-danger">Buy Now</button>
                                            </div>
                                            <div class="col-md-6">
                                                <button class="btn fw-bold w-100 btn-outline-danger add-to-cart-btn" data-id="${product.id}">Add to Cart</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    $('#product-list').html(productList);
                }
            });

            // Add to cart functionality
            $(document).on('click', '.add-to-cart-btn', function(e) {
                e.preventDefault();

                var productId = $(this).data('id');

                $.ajax({
                    url: '{{ route('cart.add') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: productId
                    },
                    success: function(response) {
                        alert(response.message);
                    }
                });
            });
        });
    </script>
@endsection
