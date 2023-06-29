@extends('layouts.user')
@section('count-cart', $countCart)
@section('count-wishlist', $countWish)

@section('content')

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{url('/add-rating')}}" method="GET">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá {{ $product->name }}</h1>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-css d-flex align-items-center">
                            <div class="star-icon d-flex align-items-center">
                                <input type="radio" value="1" name="product_rating" checked id="rating1">
                                <label for="rating1" class="fa fa-star"></label>
                                <input type="radio" value="2" name="product_rating" id="rating2">
                                <label for="rating2" class="fa fa-star"></label>
                                <input type="radio" value="3" name="product_rating" id="rating3">
                                <label for="rating3" class="fa fa-star"></label>
                                <input type="radio" value="4" name="product_rating" id="rating4">
                                <label for="rating4" class="fa fa-star"></label>
                                <input type="radio" value="5" name="product_rating" id="rating5">
                                <label for="rating5" class="fa fa-star"></label>
                            </div>
                        </div>
                        <style>
                            .rating-css label.fa-star {
                                font-size: 20px;
                            }

                            .rating-css div {
                                color: #ffe400;
                                font-size: 10px;
                                font-family: sans-serif;
                                font-weight: 400;
                                text-align: center;
                                text-transform: uppercase;
                                padding: 20px 0;
                            }

                            .rating-css input {
                                display: none;
                            }

                            .rating-css input+label {
                                font-size: 60px;
                                text-shadow: 1px 1px 0 #8f8420;
                                cursor: pointer;
                            }

                            .rating-css input:checked+label~label {
                                color: #b4afaf;
                            }

                            .rating-css label:active {
                                transform: scale(0.8);
                                transition: 0.3s ease;
                            }
                        </style>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shop Detail</h1>
            <div class="d-inline-flex">
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shop Detail</p>
                <p class="m-0 px-2">-</p>
            </div>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="row px-xl-5 product_data">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ asset('assets/uploads/product/' . $product->image) }}"
                                alt="Image">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 pb-5 ">
                <h3 class="font-weight-semi-bold">{{ $category->name }} / {{ $product->name }}</h3>
                @if ($product->trending == '1')
                    <label style="font-size: 16px" class="float-end badge bg-danger trending_tag"> Trending</label>
                @endif
                <div class="d-flex mb-3">
                    <div class="text-primary mr-2 n">
                        @php $round_rate = number_format($rating_value) @endphp
                        @for ($i = 1; $i <= $round_rate; $i ++)
                            <small class="fas fa-star"></small>
                        @endfor
                        @for ($j = $round_rate + 1; $j <= 5; $j ++)
                            <small class="far fa-star"></small>
                        @endfor

                    </div>
                    <small class="pt-1">({{$ratings->count()}} Reviews)</small>
                </div>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Đánh giá sao sản phẩm
                </button>
                <br>
                <h3 class="font-weight-semi-bold mb-4">{{ number_format($product->selling_price) }}.VNĐ</h3>
                <p class="mb-4">{{ $product->description }}</p>
                @if ($product->qty > 0)
                    <label class="badge bg-success">In stock</label>
                @else
                    <label class="badge bg-danger">Out of stock</label>
                @endif
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="input-group quantity mr-3" style="width: 130px;">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-minus">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="hidden" value="{{ $product->id }}" class="product_id">
                        <input type="text" name="quantity" class="form-control qty-input bg-secondary text-center"
                            value="1">
                        <div class="input-group-btn">
                            <button class="btn btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>

                    @if ($product->qty > 0)
                        <button class="btn btn-primary px-3 AddToWishlist" style=" margin-right: 10px;"><i
                                class="fas fa-heart mr-1"></i>Add to Wishlist</button>
                        <button class="btn btn-primary px-3 AddToCartBtn"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    @else
                        <button class="btn btn-primary px-3 addToWishlist"><i class="fas fa-heart mr-1"></i>Add to
                            Wishlist</button>
                    @endif
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Reviews ({{ count($reviews) }})</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-4">{{ count($reviews) }} review for "{{$product->name}}"</h4>
                                @foreach ($reviews as $review)
                                <div class="media mb-4">
                                    
                                    <div class="media-body">
                                        <h6>{{ $review->user_id ? Auth::user()->find($review->user_id)->name : '' }}<small> - <i>{{ $review->created_at->format('d M Y H:i') }}</i></small></h6>
                                        <p>{{ $review->user_review }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-4">Leave a review</h4>
                                <small>Your email address will not be published. Required fields are marked *</small>
                                <form action="{{url('add-review/'. $product->id)}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="message">Your Review *</label>
                                        <textarea id="message" name="content" cols="30" rows="5" class="form-control"></textarea>
                                    </div>
                                    <span class="text-danger">
                                        @error('content')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                    <div class="form-group mb-0">
                                        <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

        document.querySelector(".AddToCartBtn").addEventListener("click", function(e) {
            e.preventDefault();
            var product_id = $(this).closest('.product_data').find('.product_id').val();
            var product_qty = $(this).closest('.product_data').find('.qty-input').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/add-to-cart",
                data: {
                    'product_id': product_id,
                    'product_quantity': product_qty,
                },
                success: function(response) {
                    window.location.reload();
                    swal(response.status)
                }

            })
        });

        document.querySelector(".AddToWishlist").addEventListener("click", function(e) {
            e.preventDefault();
            var product_id = $(this).closest('.product_data').find('.product_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/add-to-wishlist",
                data: {
                    'product_id': product_id,
                },
                success: function(response) {
                    window.location.reload();
                    swal(response.status);
                }

            })
        });
    </script>
@endsection
