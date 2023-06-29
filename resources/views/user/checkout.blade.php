@extends('layouts.user')
@section('count-cart', $countCart)
@section('count-wishlist', $countWish)

@section('content')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
            <div class="d-inline-flex">
                <p class="m-0 px-2">-</p>
                <p class="m-0">Checkout</p>
                <p class="m-0 px-2">-</p>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5">
        <form action="{{ url('place-order') }}" method="post">
            @csrf
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" type="text" placeholder="">
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" name="email" value="{{ Auth::user()->email }}" type="text"
                                    readonly placeholder="">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile</label>
                                <input class="form-control" name="mobile" type="text" placeholder="">
                                <span class="text-danger">
                                    @error('mobile')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address</label>
                                <input class="form-control" name="address" type="text" placeholder="">
                                <span class="text-danger">
                                    @error('address')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                        </div>

                        <div class="card-body">
                            <style>
                                .table-header {
                                    font-weight: bold;
                                    text-align: center;
                                    background-color: #eee;
                                }

                                .table-data {
                                    text-align: center;
                                }
                            </style>
                            <table>
                                <thead>
                                    <tr>
                                        <th class="table-header">Products</th>
                                        <th class="table-header">Quantity</th>
                                        <th class="table-header">Price</th>
                                        <th class="table-header">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($cartItems as $item)
                                        @php
                                            $total += $item->products->selling_price * $item->product_quantity;
                                        @endphp
                                        <tr>
                                            <td class="table-data">{{ $item->products->name }}</td>
                                            <td class="table-data">{{ $item->product_quantity }}</td>
                                            <td class="table-data">{{ number_format($item->products->selling_price) }}.VNĐ</td>
                                            <td class="table-data">
                                                {{ number_format($item->products->selling_price * $item->product_quantity)}}.VNĐ
                                            </td>
                                        </tr>
                                    @endforeach
                                    @php
                                        $total_vnd = round($total * 2400);
                                    @endphp
                                </tbody>
                            </table>
                            <hr class="mt-0">
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
                        </div>
                    </div>
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">Payment</h4>
                        </div>

                        <div class="card-footer border-secondary bg-transparent">
                            <button type="submit" class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">Place
                                Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

