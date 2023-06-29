@extends('layouts.user')
@section('count-cart', $countCart)
@section('count-wishlist', $countWish)

@section('content')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
            <div class="d-inline-flex">
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop</p>
                <p class="m-0 px-2">-</p>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- Price Start -->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by selling price</h5>
                    <form action="{{ route('shop.price') }}" method="GET" id="price-form">
                        @csrf
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-all" name="price-all" {{request()->get('price-all') ? 'checked' : ''}}>
                            <label class="custom-control-label" for="price-all">All Price</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1" name="price-1" {{request()->get('price-1') ? 'checked' : ''}}>
                            <label class="custom-control-label" for="price-1">0 - 5000000 VNĐ</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2" name="price-2" {{request()->get('price-2') ? 'checked' : ''}}>
                            <label class="custom-control-label" for="price-2">5000000 - 10000000 VNĐ</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3" name="price-3" {{request()->get('price-3') ? 'checked' : ''}}>
                            <label class="custom-control-label" for="price-3">10000000 - 20000000 VNĐ</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4" name="price-4" {{request()->get('price-4') ? 'checked' : ''}}>
                            <label class="custom-control-label" for="price-4">20000000 - 50000000VNĐ</label>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">

                            <form action="{{ route('shop.search') }}" method="GET">
                                @csrf
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ request()->get('searchTerm') }}"
                                        placeholder="Search by name" name="searchTerm">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <span class="text-danger">
                                    @error('searchTerm')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </form>

                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sort by
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item"
                                        href="{{ route('shop.sort', ['sort' => 'status']) }}">Popular</a>
                                    <a class="dropdown-item"
                                        href="{{ route('shop.sort', ['sort' => 'trending']) }}">Trending</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';
                    @endphp

                    @if (empty($searchTerm) && !isset($priceCheck))
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                <div class="card product-item border-0 mb-4">
                                    <div
                                        class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('assets/uploads/product/' . $product->image) }}" alt="">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3">{{ $product->name }}</h6>

                                        <div class="d-flex justify-content-center align-items-center">
                                            <label class="text-muted ml-2">Price: </label>
                                            <h6>{{ number_format($product->selling_price) }}.VNĐ</h6>
                                            <h6 class="text-muted ml-2">
                                                <del>{{ number_format($product->original_price) }}.VNĐ</del></h6>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <label class="text-muted ml-2">Quantity: </label>
                                            <h6> {{ $product->qty }}</h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="{{url('detail/'.$product->id)}}" class="btn btn-sm text-dark p-0"><i
                                                class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                        <div class="btn btn-sm text-dark p-0">
                                            <i class="fas fa-heart text-primary mr-1"></i>
                                            <span class="badge wishlist-count">{{$product->wishlist_count}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12 pb-1">
                            {{ $products->links('pagination::bootstrap-4') }}
                        </div>
                    @elseif(!empty($searchTerm) && !isset($priceCheck))
                        @foreach ($productSearch as $products)
                            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                <div class="card product-item border-0 mb-4">
                                    <div
                                        class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('assets/uploads/product/' . $products->image) }}" alt="">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3">{{ $products->name }}</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6>{{ number_format($products->selling_price) }}.VNĐ</h6>
                                            <h6 class="text-muted ml-2">
                                                <del>{{ number_format($products->original_price) }}.VNĐ</del></h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="" class="btn btn-sm text-dark p-0"><i
                                                class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                        <div class="btn btn-sm text-dark p-0">
                                            <i class="fas fa-heart text-primary mr-1"></i>
                                            <span class="badge wishlist-count">{{$products->wishlist_count}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12 pb-1">
                            {{ $productSearch->links('pagination::bootstrap-4') }}
                        </div>
                    @elseif($priceCheck)
                        @foreach ($productPrice as $product)
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div
                                    class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid w-100"
                                        src="{{ asset('assets/uploads/product/' . $product->image) }}"
                                        alt="">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">{{ $product->name }}</h6>
                                    <div class="d-flex justify-content-center">
                                        <h6>${{ number_format($product->selling_price) }}</h6>
                                        <h6 class="text-muted ml-2">
                                            <del>${{ number_format($product->original_price) }}</del></h6>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="" class="btn btn-sm text-dark p-0"><i
                                            class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                    <div class="btn btn-sm text-dark p-0">
                                        <i class="fas fa-heart text-primary mr-1"></i>
                                        <span class="badge wishlist-count">{{$product->wishlist_count}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12 pb-1">
                        {{ $productPrice->links('pagination::bootstrap-4') }}
                    </div>
                    @endif

                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>

    <script>
        const checkboxes = document.querySelectorAll('input[type=checkbox]');
        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    checkboxes.forEach((other) => {
                        if (other !== checkbox) {
                            other.checked = false;
                        }
                    });
                }
            });
        });

        checkboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', function() {
                const form = document.getElementById('price-form');
                form.submit();
            });
        });

    </script>

@endsection
