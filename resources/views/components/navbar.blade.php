<!-- Navbar Start -->

    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img src="{{ asset('img/M&NLogo.png') }}" alt="" width="100" height="100"/>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="/" class="nav-item nav-link active">Home</a>
                <a href="/about" class="nav-item nav-link">About</a>
                <a href="/service" class="nav-item nav-link">Services</a>
                <a href="/products" class="nav-link ">Products</a>              
                <a href="/contact" class="nav-item nav-link">Contact</a>
                <a href="/cart" class="nav-item nav-link ms-3"><i class="fa-solid fa-cart-plus fa-2xl" style="color: #e32400;"></i></a>
            </div>
            @if (Route::has('login'))
            <div class="nav-item dropdown me-5 ms-3">
                <div class="navbar-nav ms-4 p-4 p-lg-0">
                     <i class="fa-solid fa-circle-user fa-2xl" style="color: #e32400;"></i>
                </div>
                <div class="dropdown-menu fade-up mt-4">
                        @auth
                                    <a
                                        href="{{ url('/appointments') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        Appointments
                                    </a>
                                    <a
                                        href="{{ url('/orders') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        Orders
                                    </a>
                                    
                        @else
                            <li><a href="{{ route('login') }}" class="dropdown-item">Login</a></li>
                            @if (Route::has('register'))
                            <li><a href="{{ route('register') }}" class="dropdown-item">SignUp</a></li> 
                            @endif  
                        @endauth       
                </div>
            </div>
            @endif
            <a href="" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Book Now<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
<!-- Navbar End -->

<Style>
    .navbar-nav .nav-item.dropdown .dropdown-menu {
    background-color: #fff;
    border: none;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    margin-top: 0.5rem;
    border-radius: 0.25rem;
    transition: all 0.3s ease;
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
}

.navbar-nav .nav-item.dropdown:hover .dropdown-menu {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.navbar-nav .nav-item.dropdown .dropdown-menu a {
    color: #333;
    padding: 10px 20px;
    display: block;
    text-decoration: none;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.navbar-nav .nav-item.dropdown .dropdown-menu a:hover {
    background-color: #f8f9fa;
    color: #e32400;
}

.navbar-nav .nav-item.dropdown .dropdown-menu a:focus {
    outline: none;
    background-color: #f8f9fa;
    color: #e32400;
}

.navbar-nav .nav-item.dropdown .dropdown-menu a.active {
    background-color: #e32400;
    color: #fff;
}
</Style>