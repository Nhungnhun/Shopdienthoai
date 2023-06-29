@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex flex-row-reverse justify-content-between align-items-center">
            <a href="{{url('order')}}" class="btn btn-danger">back</a>
            <h4 style="font-weight: bold;">Orders Detail</h4>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 10%">No</th>
                        <th style="width: 20%">Image</th>
                        <th style="width: 30%">Name</th>
                        <th style="width: 20%">Quantity</th>
                        <th style="width: 20%">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders->orderitems as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <img src="{{asset('assets/uploads/product/'. $item->products->image)}}" alt="" width="30%">
                            </td>
                            <td>{{ $item->products->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->price) }}</td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

