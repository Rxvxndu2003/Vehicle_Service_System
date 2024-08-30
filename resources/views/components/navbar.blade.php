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
                <a href="/cart" class="nav-item nav-link ms-3">
    <i class="fa-solid fa-cart-plus fa-2xl" style="color: #e32400;"></i>
    <span id="cart-count" class="badge bg-danger rounded-circle" style="position: absolute; top: 10px; right: 350px;">0</span>
</a>

            </div>
            @if (Route::has('login'))
            <div class="nav-item dropdown me-5 ms-3">
                <div class="navbar-nav ms-4 p-4 p-lg-0">
                     <i class="fa-solid fa-circle-user fa-2xl" style="color: #e32400;"></i>
                </div>
                <div class="dropdown-menu fade-up mt-4">
            @auth
                <a
                   href="{{ url('/dashboard') }}"
                   class="dropdown-item rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                >
                   Dashboard
                </a>
                 <a
                   href="{{ url('/appointments') }}"
                   class="dropdown-item rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                 >
                   Appointments
                </a>
                <a
                   href="{{ url('/vehicles') }}"
                   class="dropdown-item rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                 >
                   Vehicles
                </a>
                <a
                   href="{{ url('/orders') }}"
                   class="dropdown-item rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                >
                   Orders
                </a>
                <form method="POST" action="{{ route('logout') }}" class="dropdown-item">
                @csrf
                    <button type="submit" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                      Logout
                    </button>
                </form>
            @else
               <li><a href="{{ route('login') }}" class="dropdown-item">Login</a></li>
            @if (Route::has('register'))
               <li><a href="{{ route('register') }}" class="dropdown-item">SignUp</a></li>
            @endif
            @endauth
            </div>

            </div>
            @endif
            <a href="#" id="bookNowButton" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block" data-authenticated="{{ Auth::check() ? 'true' : 'false' }}">Book Now<i class="fa fa-arrow-right ms-3"></i></a>

        </div>
    </nav>
<!-- Navbar End -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const bookNowButton = document.getElementById('bookNowButton');
    const isAuthenticated = bookNowButton.getAttribute('data-authenticated') === 'true';

    bookNowButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (isAuthenticated) {
            window.location.href = '/appointments';
        } else {
            window.location.href = '/login';
        }
    });
});

</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to update the cart count
        function updateCartCount() {
            $.ajax({
                url: '{{ route('cart.count') }}', // Route to get the cart count
                method: 'GET',
                success: function(data) {
                    $('#cart-count').text(data.count);
                }
            });
        }

        // Call the function to update the cart count on page load
        updateCartCount();

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
                    updateCartCount(); // Update the cart count after adding a product
                }
            });
        });

        // Buy now functionality
        $(document).on('click', '.buy-now-btn', function(e) {
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
                    // Redirect to the cart page after adding the product to the cart
                    window.location.href = '{{ route('cart.index') }}';
                }
            });
        });
    });
</script>

