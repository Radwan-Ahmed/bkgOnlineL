<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        {{-- Store Name / Logo --}}
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            BKG Online
        </a>

        {{-- Toggle for Mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Navbar Content --}}
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            {{-- 🔍 Search Form (center) --}}
            <form class="d-flex mx-auto w-50" action="{{ route('product.index') }}" method="GET">
                <input class="form-control me-2" type="search" name="query" placeholder="Search products..."
                       value="{{ request('query') }}">
                <button class="btn btn-outline-primary" type="submit">Search</button>
            </form>

            {{-- Right side --}}
            <ul class="navbar-nav ms-auto">
                {{-- Account Dropdown --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        My Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        @auth
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                           <a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">@csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        @else
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                        @endauth
                    </ul>
                </li>

                {{-- Wishlist --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('wishlist.index') }}">❤️ Wishlist</a>
                </li>

                {{-- Cart --}}
                <li class="nav-item">
                    @if(session('cart') && count(session('cart')) > 0)
                            <span class="badge bg-danger" >{{ count(session('cart')) }}</span>
                        @endif
                </li>
                    <a class="nav-link" href="{{ route('cart.index') }}">🛒 Cart</a>

            </ul>
        </div>
    </div>
</nav>
