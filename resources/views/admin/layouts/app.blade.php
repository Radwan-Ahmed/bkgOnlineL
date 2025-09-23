<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { overflow-x: hidden; }
        #sidebar { min-height: 100vh; background: #343a40; color: #fff; }
        #sidebar .nav-link { color: #fff; }
        #sidebar .nav-link:hover { background: #495057; }
        #sidebar .submenu { padding-left: 1rem; }
        main { margin-left: 250px; padding: 20px; }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div id="sidebar" class="flex-column p-3 position-fixed">
        <h3 class="text-center mb-4">Admin Panel</h3>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#categoryMenu" role="button"><i class="bi bi-tags me-2"></i> Categories</a>
                <div class="collapse submenu" id="categoryMenu">
                    <a class="nav-link" href="{{ route('categories.index') }}">All Categories</a>
                    <a class="nav-link" href="{{ route('categories.create') }}">Add Category</a>
                </div>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#productMenu" role="button"><i class="bi bi-box-seam me-2"></i> Products</a>
                <div class="collapse submenu" id="productMenu">
                    <a class="nav-link" href="{{ route('products.index') }}">All Products</a>
                    <a class="nav-link" href="{{ route('products.create') }}">Add Product</a>
                </div>
            </li>
             <li class="nav-item mb-2">
                <a class="nav-link collapsed" data-bs-toggle="collapse" href="#productMenu" role="button"><i class="bi bi-box-seam me-2"></i> Banners</a>
                <div class="collapse submenu" id="productMenu">
                    <a class="nav-link" href="{{ route('banners.index') }}">All Banners</a>
                    <a class="nav-link" href="{{ route('banners.create') }}">Add Banners</a>
                </div>
            </li>
            <li class="nav-item mt-4">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-outline-light w-100"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <!-- Main content -->
    <main class="flex-grow-1">
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
