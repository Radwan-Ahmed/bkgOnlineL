@extends('layouts.app')
@section('title', 'Home')

@section('content')

<div class="container my-4">
    <div class="d-flex overflow-auto gap-3 pb-2">
        @foreach(App\Models\Category::all() as $category)
            <div class="text-center flex-shrink-0" style="width:90px;">
                <a href="{{ route('category.show', $category->id) }}" class="text-decoration-none text-dark">
                    <div class="rounded-circle border bg-white d-flex align-items-center justify-content-center shadow-sm mx-auto"
                         style="width:80px; height:80px; overflow:hidden;">
                        @if($category->image)
                            <img src="{{ asset('images/categories/'.$category->image) }}"
                                 alt="{{ $category->name }}"
                                 class="img-fluid"
                                 style="object-fit: cover; width: 100%; height: 100%;">
                        @else
                            <span class="fs-4 fw-bold">{{ substr($category->name, 0, 1) }}</span>
                        @endif
                    </div>
                    <small class="d-block mt-2 text-truncate">{{ $category->name }}</small>
                </a>
            </div>
        @endforeach
    </div>
</div>


<!-- Carousel Banner -->
<div class="container mt-4">
    <div class="row">
        <!-- Left carousel -->
        <div class="col-md-8 mb-3">
            <div id="bigBannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <!-- Indicators -->
                <div class="carousel-indicators">
                    @foreach(App\Models\Banner::all() as $key => $banner)
                        <button type="button" data-bs-target="#bigBannerCarousel" data-bs-slide-to="{{ $key }}"
                                class="{{ $key == 0 ? 'active' : '' }}" aria-current="{{ $key == 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $key+1 }}"></button>
                    @endforeach
                </div>

                <!-- Carousel items -->
                <div class="carousel-inner" style="height: 450px;">
                    @foreach(App\Models\Banner::all() as $key => $banner)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img src="{{ asset('images/banners/'.$banner->image) }}"
                                 class="d-block w-100 h-100 object-fit-cover rounded"
                                 alt="{{ $banner->title }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right fixed 3 images -->
        <div class="col-md-4 d-flex flex-column gap-2">
            @foreach(App\Models\Banner::take(3)->get() as $banner)
                <div class="flex-fill">
                    <img src="{{ asset('images/banners/'.$banner->image) }}"
                         class="d-block w-100 object-fit-cover rounded"
                         style="height: 130px;"
                         alt="{{ $banner->title }}">
                </div>
            @endforeach
        </div>
    </div>
</div>





<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0">🆕 Latest Products</h2>
        <a href="{{ route('product.index') }}" class="btn btn-outline-primary btn-sm">
            View All →
        </a>
    </div>

    <div class="row g-4">
        @foreach(App\Models\Product::latest()->take(8)->get() as $product)
            <div class="col-6 col-md-3">
                <div class="card h-100 shadow-sm border-0 product-card">
                    {{-- Product Image --}}
                    <a href="{{ route('product.show', $product->id) }}" class="position-relative d-block">
                    <div class="ratio ratio-1x1 bg-light rounded-top overflow-hidden product-img-wrapper">
                        @if($product->image)
                            <img src="{{ asset('images/products/'.$product->image) }}"
                                alt="{{ $product->name }}"
                                class="img-fluid w-100 h-100"
                                style="object-fit: cover;">
                        @else
                            <span class="d-flex align-items-center justify-content-center h-100 text-muted">
                                No Image
                            </span>
                        @endif

                        {{-- Hover Wishlist Icon --}}
                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="position-absolute top-0 end-0 m-2">
                            @csrf
                               <button type="submit" class="btn btn-light rounded-circle shadow-sm wishlist-btn" title="Add to Wishlist">
                                             ❤️
                                </button>
                        </form>

                    </div>
                </a>


                    {{-- Product Details --}}
                    <div class="card-body text-center">
                        <h6 class="card-title text-truncate mb-2">{{ $product->name }}</h6>
                        <p class="fw-bold text-primary mb-2">৳{{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('product.show', $product->id) }}"
                           class="btn btn-sm btn-outline-primary">
                            👁 View
                        </a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">🛒 Add to Cart</button>
                        </form>
                        <a href="{{ route('checkout', $product->id) }}" class="btn btn-warning w-100 mt-2">
                        Buy Now
                       </a>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


<style>

    .product-img-wrapper img {
    transition: transform 0.3s ease-in-out;
}

.product-img-wrapper:hover img {
    transform: scale(1.05); /* zoom effect */
}

.wishlist-btn {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.product-img-wrapper:hover .wishlist-btn {
    opacity: 1; /* show wishlist button on hover */
}

/* Make carousel responsive on mobile */
@media (max-width: 768px) {
    #homeCarousel .carousel-inner {
        height: 250px; /* smaller height for mobile */
    }
}


</style>

@endsection
