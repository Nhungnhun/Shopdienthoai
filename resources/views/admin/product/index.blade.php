@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 style="font-weight: bold;">Product Pages</h4>
            <form action="{{route('product.search')}}"  method="GET" class="navbar-form">
                @csrf
                <div class="input-group no-border" >
                    <input type="text" name="searchTerm" value="{{ request()->get('searchTerm') }}" class="form-control" placeholder="Search...">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
                <span class="text-danger">
                    @error('searchTerm')
                        {{ $message }}
                    @enderror
                </span>
            </form>
        </div>

        @if (empty($productSearch))
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:5%; text-align:center;">No</th>
                            <th style="width:15%; text-align:center;">Image</th>
                            <th style="width:5%; text-align:center;">Category</th>
                            <th style="width:10%; text-align:center;">Name</th>
                            <th style="width:5%; text-align:center;">Number of warehouses</th>
                            <th style="width:5%; text-align:center;">Quantity on sale</th>
                            <th style="width:15%; text-align:center;">Selling Price</th>
                            <th style="width:15%; text-align:center;">Original Price</th>
                            <th style="width:25%; text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img src="{{asset('assets/uploads/product/'.$item->image)}}" class="cate-image" alt="Image here">
                                </td>
                                <td>{{$item->category->name}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->tax}}</td>
                                <td>{{$item->qty}}</td>
                                <td>${{number_format($item->selling_price)}}</td>
                                <td>${{number_format($item->original_price)}}</td>
                                <td>
                                    <a href="{{url('edit-product/'. $item->id)}}" class="btn btn-primary">Edit</a>
                                    <button onclick="confirmDelete('{{ url('delete-product/' . $item->id) }}')"
                                        class="btn btn-danger">Delete</button>
                                    <script>
                                        function confirmDelete(deleteUrl) {
                                            swal({
                                                title: "Are you sure you want to do this?",
                                                buttons: ["Cancel", "Delete"],
                                                dangerMode: true,
                                            })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    window.location.href = deleteUrl;
                                                } else {
                                                    swal("Your product is safe!");
                                                }
                                            });
                                        }
                                    </script>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="text-align:center;">No</th>
                            <th style="text-align:center;">Image</th>
                            <th style="text-align:center;">Category</th>
                            <th style="text-align:center;">Name</th>
                            <th style="text-align:center;">Number of warehouses</th>
                            <th style="text-align:center;">Quantity on sale</th>
                            <th style="text-align:center;">Selling Price</th>
                            <th style="text-align:center;">Original Price</th>
                            <th style="text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productSearch as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img src="{{asset('assets/uploads/product/'.$item->image)}}" class="cate-image" alt="Image here">
                                </td>
                                <td>{{$item->category->name}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->tax}}</td>
                                <td>{{$item->qty}}</td>
                                <td>${{number_format($item->selling_price)}}</td>
                                <td>${{number_format($item->original_price)}}</td>
                                <td>
                                    <a href="{{url('edit-product/'. $item->id)}}" class="btn btn-primary">Edit</a>
                                    <button onclick="confirmDelete('{{ url('delete-product/' . $item->id) }}')"
                                        class="btn btn-danger">Delete</button>
                                    <script>
                                        function confirmDelete(deleteUrl) {
                                            swal({
                                                title: "Are you sure you want to do this?",
                                                buttons: ["Cancel", "Delete"],
                                                dangerMode: true,
                                            })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    window.location.href = deleteUrl;
                                                } else {
                                                    swal("Your product is safe!");
                                                }
                                            });
                                        }
                                    </script>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $productSearch->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection
