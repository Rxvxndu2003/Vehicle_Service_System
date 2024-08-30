<!doctype html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>M & N Service Center - Checkout</title>
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("payNowModal");
    var btn = document.getElementById("checkoutButton"); // Assuming your checkout button has this ID
    var span = document.getElementsByClassName("close")[10];
    var confirmPaymentButton = document.getElementById("confirmPaymentButton");

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    // Removed the window.onclick event listener
});
</script>
        
</body>
   
</html>