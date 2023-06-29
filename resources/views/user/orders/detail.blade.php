@extends('layouts.user')

@section('content')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Detail order</h1>
            <div class="d-inline-flex">
                <p class="m-0 px-2">-</p>
                <p class="m-0">Detail order</p>
                <p class="m-0 px-2">-</p>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white d-flex justify-content-between align-items-center">Detail orders
                            <a href="{{url('my-order')}}" class="btn btn-danger float-end">back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-details">
                                <h4>Shipping order</h4>
                                <hr>
                                <label>Name</label>
                                <div class="border p-2">{{ $orders->name }}</div>
                                <label>Email</label>
                                <div class="border p-2">{{ $orders->email }}</div>
                                <label>Phone</label>
                                <div class="border p-2">{{ $orders->mobile }}</div>
                                <label>Address</label>
                                <div class="border p-2">{{ $orders->address }}</div>
                            </div>

                            <div class="col-md-6">
                                <h4>Order detail</h4>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">No</th>
                                            <th style="width: 30%">Image</th>
                                            <th style="width: 30%">Name</th>
                                            <th style="width: 10%">Quantity</th>
                                            <th style="width: 20%">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderitems as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <img src="{{asset('assets/uploads/product/'. $item->products->image)}}" alt="" width="30%">
                                                </td>
                                                <td>{{ $item->products->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->price) }} VNĐ</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h4 style="color: green;" class="px-2">Grand total: <span>{{number_format($orders->total_price)}} VNĐ</span></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
