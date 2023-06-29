@extends('layouts.user')

@section('count-cart', $countCart)
@section('count-wishlist', $countWish)


@section('content')
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Trending Products</span></h2>
        </div>
        <div class="owl-carousel featured-carousel owl-theme">
            @foreach ($productTrending as $trending)
                <div class="item">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{asset('assets/uploads/product/'. $trending->image)}}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{$trending->name}}</h6>
                            <div class="d-flex justify-content-center align-items-center">
                                <label class="text-muted ml-2">Price: </label>
                                <h6>{{number_format($trending->selling_price)}}.VNĐ</h6><h6 class="text-muted ml-2"><del>{{number_format($trending->original_price)}}.VNĐ</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{url('detail/'.$trending->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <div class="btn btn-sm text-dark p-0">
                                <i class="fas fa-heart text-primary mr-1"></i>
                                <span class="badge wishlist-count">{{$trending->wishlist_count}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container-fluid pt-5">

        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Popular Products</span></h2>
        </div>

        <div class="owl-carousel featured-carousel owl-theme">
            @foreach ($productPopular as $popular)
                <div class="item">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{asset('assets/uploads/product/' . $popular->image)}}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{$popular->name}}</h6>
                            <div class="d-flex justify-content-center align-items-center">
                                <label class="text-muted ml-2">Price: </label>
                                <h6> {{number_format($popular->selling_price)}}.VNĐ</h6><h6 class="text-muted ml-2"><del> {{number_format($popular->original_price)}}.VNĐ</del></h6>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{url('detail/'.$popular->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            <div class="btn btn-sm text-dark p-0">
                                <i class="fas fa-heart text-primary mr-1"></i>
                                <span class="badge wishlist-count">{{$popular->wishlist_count}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Category</span></h2>
        </div>

        <div class="owl-carousel featured-carousel owl-theme">
            @foreach ($categoryAll as $category)
                <div class="item">
                    <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                        <p class="text-right">{{$category->slug}}</p>
                        <a href="" class="cat-img position-relative overflow-hidden mb-3">
                            <img class="img-fluid" src="{{asset('assets/uploads/category/'. $category->image)}}" alt="">
                        </a>
                        <h5 class="font-weight-semi-bold m-0">{{$category->name}}</h5>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })

        $('.trending-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    </script>
@endsection
