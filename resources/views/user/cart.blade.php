@extends('layouts.user')
@section('count-cart', $countCart)
@section('count-wishlist', $countWish)

@section('content')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
                <p class="m-0 px-2">-</p>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5">
        @if ($cartItems->count() > 0)
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>

                        <tbody class="align-middle">
                            @php
                                $total = 0;
                            @endphp
                            @foreach ($cartItems as $item)
                                <tr class="product-data">
                                    <td class="align-middle"><img
                                            src="{{ asset('assets/uploads/product/' . $item->products->image) }}" alt=""
                                            style="width: 50px;"></td>
                                    <td class="align-middle">{{ $item->products->name }}</td>
                                    <td class="align-middle">{{ number_format($item->products->selling_price) }}.VNĐ</td>
                                    <td class="align-middle">
                                        @if ($item->products->qty > $item->product_quantity)
                                            @php
                                                $total += $item->product_quantity * $item->products->selling_price;
                                            @endphp
                                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary changeQuantity btn-minus">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="hidden" class="product_id" value="{{ $item->product_id }}">
                                                <input type="text" name="quantity"
                                                    class="form-control qty-input form-control-sm bg-secondary text-center"
                                                    value="{{$item->product_quantity }}">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-primary changeQuantity btn-plus">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                        @else
                                            <h6>Out of Stock</h6>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        {{number_format($item->product_quantity * $item->products->selling_price)}} VNĐ</td>
                                    <td class="align-middle"><button class="btn btn-sm btn-primary delete-cart-item"><i class="fa fa-times"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">{{ number_format($total) }} VNĐ</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">0 VNĐ</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">{{ number_format($total) }} VNĐ</h5>
                        </div>
                        <a href="{{ url('checkout') }}" class="btn btn-block btn-primary my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
        @else
            <div class="card-body text-center">
                <h2>Your <i class="fa fa-shopping-cart"></i>Cart is empty</h2>
                <a href="{{url('shop')}}" class="btn btn-outline-primary float-end">Continue shopping</a>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        document.querySelector(".btn-minus").addEventListener("click", function() {
            var quantityInput = document.querySelector("input[name='quantity']");
            var quantityValue = parseInt(quantityInput.value);

            if (quantityValue > 1) {
                quantityInput.value = quantityValue - 1;
            } else {
                quantityInput.value = 1;
            }
        });

        document.querySelectorAll(".delete-cart-item").forEach(function(item) {
            item.addEventListener("click", function(e) {
                e.preventDefault();

                var product_id = $(this).closest('.product-data').find('.product_id').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "delete-cart-item",
                    data: {
                        'product_id': product_id,
                    },
                    success: function(response) {
                        window.location.reload();
                        swal(response.status);
                    }
                });
            });
        });

        document.querySelectorAll(".qty-input").forEach(function(item) {
            item.addEventListener("input", function(e) {
                var product_id = $(this).closest('.product-data').find('.product_id').val();
                var product_quantity = $(this).val();

                data = {
                    'product_id': product_id,
                    'product_quantity': product_quantity,
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "update-cart",
                    data: data,
                    success: function(response) {
                        window.location.reload();
                        swal(response.status);
                    }
                });
            });
        });
    </script>
@endsection
