@extends('layouts.user')

@section('content')
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">My order</h1>
            <div class="d-inline-flex">
                <p class="m-0 px-2">-</p>
                <p class="m-0">My order</p>
                <p class="m-0 px-2">-</p>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="text-white">List my orders</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tracking Number</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($orders as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                        <td>{{$item->tracking_no}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->mobile}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>{{number_format($item->total_price)}}.VNĐ</td>
                                        <td style="color:{{$item->status == '0' ? 'orange' : 'green'}};">{{$item->status == '0' ? 'pending' : 'completed'}}</td>
                                        <td>
                                            <a href="{{url('view-order/'.$item->id)}}" class="btn btn-primary">View</a>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-12 pb-1">
                            {{ $orders->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
