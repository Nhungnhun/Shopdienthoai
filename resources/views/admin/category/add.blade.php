@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add Category</h4>
        </div>
        <div class="card-body">
            <form method="post" action="{{url('insert-category')}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name">
                        <span class="text-danger">@error('name') {{$message}} @enderror</span>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Slug</label>
                        <input type="text" class="form-control" name="slug">
                        <span class="text-danger">@error('slug') {{$message}} @enderror</span>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="">Description</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                        <span class="text-danger">@error('description') {{$message}} @enderror</span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" name="status">

                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Popular</label>
                        <input type="checkbox" name="popular">
                    </div>

                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control">
                        <span class="text-danger">@error('image') {{$message}} @enderror</span>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
