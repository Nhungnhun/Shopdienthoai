@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 style="font-weight: bold;">Orders Pages</h4>
            <form action=""  method="GET" class="navbar-form">
                @csrf
                <div class="input-group no-border" >
                    <input type="text" name="searchTerm" value="" class="form-control" placeholder="Search...">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                        <th>Total price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->mobile}}</td>
                            <td>{{$item->address}}</td>
                            <td>{{number_format($item->total_price)}} VNĐ</td>
                            <td>
                                @if ($item->status == 0)
                                      <a style="font-weight: bold" href="{{URL::to('/unpaid/'.$item->id)}}">Thanh toán khi nhận hàng</a>   
                                    @else
                                    <a style="font-weight: bold;">Đã thanh toán</a> 
                                   @endif
                                </td>
                            <td>
                                <a href="{{url('order-detail/' . $item->id)}}" class="btn btn-primary">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $orders->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection

