<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>M & N Service Center - About Us</title>
    <link rel="icon" href="{{ asset('M&NLogo.ico') }}" type="image/x-icon">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
</head>

<body>

@include('Libraries.address_style') 


<!-- Topbar Start -->
@include('components.topbar') 
<!-- Topbar End -->

<!-- Navbar Start -->
@include('components.navbar') 
<!-- Navbar End -->
<div class="container mt-5">
@yield('content')
</div>
<!-- Footer Start -->
@include('components.footer')   
<!-- Footer End -->


<!-- Back to Top -->
@include('components.backtotop') 


<!-- JavaScript Libraries -->
@include('scripts.scripts') 
</body>

</html>