<!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>M & N Service Center - Cart</title>
        <link rel="icon" href="{{ asset('M&NLogo.ico') }}" type="image/x-icon">
    </head>
    
@include('Libraries.style') 



<!-- Spinner Start -->
@include('components.spinner') 
<!-- Spinner End -->

<!-- Topbar Start -->
@include('components.topbar') 
<!-- Topbar End -->

<!-- Navbar Start -->
@include('components.navbar') 
<!-- Navbar End -->

<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 p-0" style="background-image: url(img/carousel-bg-1.jpg);">
        <div class="container-fluid page-header-inner py-5">
            <div class="container text-center">
                @yield('header')
            </div>
        </div>
    </div>
<!-- Page Header End -->

    <body>
        <div class="container-fluid  py-5 product-cover">
            <div class="container-xl">
                <div class="row">
                   @yield('content')
                </div>
            </div>
        </div>
        
       <!-- Footer Start -->
@include('components.footer')   
<!-- Footer End -->


<!-- Back to Top -->
@include('components.backtotop') 


<!-- JavaScript Libraries -->
@include('scripts.scripts') 

@include('scripts.productsscript') 
        
<script>
    $(document).ready(function() {
        function updateCartRow(row, quantity) {
            var price = parseFloat(row.find('td:nth-child(4)').text().replace('Rs. ', ''));
            var total = price * quantity;
            row.find('.item-total').text('Rs. ' + total.toFixed(2));
        }

        $(".quantity").on('change', function(e) {
            e.preventDefault();

            var ele = $(this);
            var id = ele.data('id');

            $.ajax({
                url: '<?php echo e(route('cart.update')); ?>',
                method: "post",
                data: {
                    _token: '<?php echo e(csrf_token()); ?>',
                    id: id,
                    quantity: ele.val()
                },
                success: function(response) {
                    if(response.success) {
                        updateCartRow(ele.closest('tr'), ele.val());
                    } else {
                        alert('Error updating quantity');
                    }
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Remove Item
        $(".remove-from-cart").click(function(e) {
            e.preventDefault();

            var ele = $(this);
            var id = ele.data('id');

            if(confirm("Are you sure?")) {
                $.ajax({
                    url: '<?php echo e(route('cart.remove')); ?>',
                    method: "post",
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        id: id
                    },
                    success: function(response) {
                        if(response.success) {
                            window.location.reload();
                        } else {
                            alert('Error removing item');
                        }
                    }
                });
            }
        });
    });
</script>
        
</body>
   
</html>