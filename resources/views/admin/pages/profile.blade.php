@extends('admin/layouts/home_layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome {{auth('web')->user()->name}}</h3>
                    <!-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> -->
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <form action="{{route('admin_profile_update')}}" method="POST">
            <div class="row">
                <div class="col-xl-3 col-md-3">
                    @if(auth('web')->user()->avatar)
                    <img src="{{ asset('assets/'.auth('web')->user()->avatar) }}" alt="default_avatar" class="user_image">
                    @else
                    <img src="{{ asset('default_assets/default_avatar.jpg') }}" alt="default_avatar" class="user_image">
                    @endif
                    <div class="form-group mt-4 py-3">
                        <input type="file" name="avatar" class="form-control">
                    </div>
                </div>
                <div class="col-xl-9 col-md-9">
                    <div class="card px-4 py-4">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8 mb-4">
                                <label for="" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{auth('web')->user()->name}}">
                            </div>
                            <div class="col-md-8 mb-4">
                                <label for="" class="form-label">Mobile Number</label>
                                <input type="text" class="form-control" name="mobile" value="{{auth('web')->user()->mobile}}">
                            </div>
                            <div class="col-md-8 mb-4">
                                <label for="" class="form-label">Email</label>
                                <input type="email" name="email" id="" class="form-control" value="{{auth('web')->user()->email}}">
                            </div>
                            <div class="col-md-4"></div>

                            <div class="col-md-4 mb-4">
                                <label for="" class="form-label">Age</label>
                                <input type="text" class="form-control" name="age" value="{{auth('web')->user()->age}}">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label for="" class="form-label">Gender</label>
                                <input type="text" class="form-control" name="gender" value="{{auth('web')->user()->gender}}">
                            </div>
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Update and Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .user_image {
        border-radius: 20px;
        height: 200px;
        width: 250px;
    }
</style>
@endsection('content')