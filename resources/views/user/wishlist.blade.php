@extends('layouts.user')
@section('count-cart', $countCart)
@section('count-wishlist', $countWish)

@section('content')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">WISH LIST</h1>
            <div class="d-inline-flex">
                <p class="m-0 px-2">-</p>
                <p class="m-0">Wishlist</p>
                <p class="m-0 px-2">-</p>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="card-header bg-secondary border-0">
            <h4 class="font-weight-semi-bold m-0">List wishlist</h4>
        </div>
        <div class="card shadow">
            <div class="card-body">
                @if ($wishlist->count() > 0)
                    @foreach ($wishlist as $item)
                        <div class="row product-data">
                            <div class="col-md-2 my-auto">
                                <img src="{{ asset('assets/uploads/product/' . $item->products->image) }}" width="30%"
                                    alt="">
                            </div>
                            <div class="col-md-3 my-auto">
                                <h6>{{ $item->products->name }}</h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <h6>{{ number_format($item->products->selling_price) }} VNĐ</h6>
                            </div>
                            <div class="col-md-2 my-auto">
                                <input type="hidden" class="product_id" value="{{ $item->product_id }}">
                                @if ($item->products->qty > 0)
                                    <h6 class="badge bg-success">Còn hàng</h6>
                                @else
                                    <h6 class="badge bg-danger">Hết hàng</h6>
                                @endif
                            </div>
                            <div class="col-md-2 my-auto">
                                <button class="btn btn-danger delete-wishlist"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h4>There are not products in your wishlist.</h4>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelectorAll(".delete-wishlist").forEach(function (button) {
            button.addEventListener("click", function (e) {
                e.preventDefault();
                var product_id = $(this).closest('.product-data').find('.product_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "/delete-to-wishlist",
                    data: {
                        'product_id': product_id,
                    },
                    success: function (response) {
                        window.location.reload();
                        swal(response.status);
                    }

                })
            });
        });
    </script>
@endsection

