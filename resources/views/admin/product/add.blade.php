@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Add Product</h4>
        </div>
        <div class="card-body">
            <form method="post" action="{{ url('insert-product') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="cate_id" aria-label="Default select example">
                            <option selected>Select category</option>
                            @foreach ($category as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">@error('cate_id') {{$message}} @enderror</span>
                    </div>

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
                        <label for="">Original Price</label>
                        <input type="number" class="form-control" name="original_price" id="original_price">
                        <span class="text-danger">@error('original_price') {{$message}} @enderror</span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Selling Price</label>
                        <input type="number" class="form-control" name="selling_price" id="original_price">
                        <span class="text-danger">@error('selling_price') {{$message}} @enderror</span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Tax</label>
                        <input type="number" class="form-control" name="tax" id="original_price">
                        <span class="text-danger">@error('tax') {{$message}} @enderror</span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Quantity</label>
                        <input type="number" class="form-control" name="qty" id="original_price">
                        <span class="text-danger">@error('qty') {{$message}} @enderror</span>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Status</label>
                        <input type="checkbox" name="status">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">Trending</label>
                        <input type="checkbox"  name="trending" id="original_price">
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
