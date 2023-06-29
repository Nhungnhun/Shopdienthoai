@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-8 d-flex justify-content-center">
                    <div class="card card-profile">
                        <div class="card-avatar">
                            <a href="javascript:;">
                                <img class="img" src="{{ asset('../assets/img/faces/marc.jpg') }}" />
                            </a>
                        </div>
                        <div class="card-body">
                            <h6 class="card-category text-gray">CEO / Co-Founder</h6>
                            <h4 class="card-title">{{ Auth::user()->name }}</h4>
                            <form>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Username:</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" value="{{ Auth::user()->name }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Password:</label>
                                            <div class="col-md-8">
                                                <i class='fa fa-lock' style='font-size:36px'></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Email:</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Type:</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" value="Admin" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 text-center mt-2">
                                        <button type="submit" class="btn btn-primary btn-round">Detail Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
