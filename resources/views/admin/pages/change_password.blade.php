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
        <div class="col-xl-9 col-md-9">
            <div class="card px-4 py-4">
                <form action="{{ route('admin_change_password') }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="col-md-9 mb-4">
                            <label for="" class="form-label">Old Password<span class="require text-danger">*</span></label>
                            <input type="text" name="oldpassword" id="" class="form-control">
                        </div>
                        <div class="col-md-9 mb-4">
                            <label for="" class="form-label">New Password<span class="require text-danger">*</span></label>
                            <input type="text" name="password" class="form-control">
                        </div>
                        <div class="col-md-9 mb-4">
                            <label for="" class="form-label">Confirm Password<span class="require text-danger">*</span></label>
                            <input type="text" name="confirmpassword" class="form-control">
                        </div>
                    </div>

                    <div>
                        <button class="btn btn-primary" type="submit">Save and Back</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection('content')