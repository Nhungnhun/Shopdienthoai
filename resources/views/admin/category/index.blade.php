@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 style="font-weight: bold;">Category Pages</h4>
            <form action="{{route('category.search')}}" class="navbar-form" method="GET">
                @csrf
                <div class="input-group no-border">
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

        @php
            $searchTerm = isset($_GET['searchTerm']) ? $_GET['searchTerm'] : '';
        @endphp

        @if (empty($categorySearch))
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:5%; text-align:center;">No</th>
                            <th style="width:15%; text-align:center;">Image</th>
                            <th style="width:25%; text-align:center;">Name</th>
                            <th style="width:35%; text-align:center;">Description</th>
                            <th style="width:20%; text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($category as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('assets/uploads/category/' . $item->image) }}" class="cate-image"
                                            alt="Image here">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <a href="{{ url('edit-category/' . $item->id) }}" class="btn btn-primary">Edit</a>
                                        <button onclick="confirmDelete('{{ url('delete-category/' . $item->id) }}')"
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
                                                        swal("Your category is safe!");
                                                    }
                                                });
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
                {{ $category->links('pagination::bootstrap-4') }}
            </div>
        @else
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width:5%; text-align:center;">No</th>
                            <th style="width:15%; text-align:center;">Image</th>
                            <th style="width:25%; text-align:center;">Name</th>
                            <th style="width:35%; text-align:center;">Description</th>
                            <th style="width:20%; text-align:center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @foreach ($categorySearch as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('assets/uploads/category/' . $item->image) }}" class="cate-image"
                                            alt="Image here">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td>
                                        <a href="{{ url('edit-category/' . $item->id) }}" class="btn btn-primary">Edit</a>
                                        <button onclick="confirmDelete('{{ url('delete-category/' . $item->id) }}')"
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
                                                        swal("Your category is safe!");
                                                    }
                                                });
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                </table>
                {{ $categorySearch->links('pagination::bootstrap-4') }}
            </div>
        @endif
    </div>
@endsection
