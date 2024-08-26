<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>CarServ - Car Repair HTML Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
</head>

<body>

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

<!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            @yield('carousel')
        </div>
    </div>
<!-- Carousel End -->

<!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                @yield('service')
            </div>
        </div>
    </div>
<!-- Service End -->


<!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                @yield('about')
            </div>
        </div>
    </div>
<!-- About End -->


<!-- Fact Start -->
    <div class="container-fluid fact bg-dark my-5 py-5">
        <div class="container">
            <div class="row g-4">
               @yield('fact')
            </div>
        </div>
    </div>
<!-- Fact End -->


<!-- Service Start -->
    <div class="container-xxl service py-5">
        <div class="container">
            @yield('service1')
        </div>
    </div>
<!-- Service End -->


<!-- Booking Start -->
    <div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                @yield('booking')
            </div>
        </div>
    </div>
<!-- Booking End -->


<!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            @yield('team')
        </div>
    </div>
<!-- Team End -->


<!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            @yield('testimonial')
        </div>
    </div>
<!-- Testimonial End -->

<!-- Footer Start -->
@include('components.footer')   
<!-- Footer End -->


<!-- Back to Top -->
@include('components.backtotop') 


<!-- JavaScript Libraries -->
@include('scripts.scripts') 
</body>

</html>