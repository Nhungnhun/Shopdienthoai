
<div class="container-fluid">
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border px-3 mr-1">Mobile Shop</span></h1>
            </a>
        </div>

        <div class="col-lg-6 col-6 text-left">
            <marquee direction="right" style="color: green; font-size:20px">Welcome to Mobile Shop</marquee>

        </div>
        <div class="col-lg-3 col-6 text-right">
            <a href="{{url('wishlist')}}" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge">@yield('count-wishlist')</span>
            </a>
            <a href="{{url('/cart')}}" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">@yield('count-cart')</span>
            </a>
        </div>
    </div>
</div>
