@extends('admin/layouts/error_layout')
@section('error_content')
<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center text-center error-page bg-primary">
        <div class="row flex-grow">
            <div class="col-lg-7 mx-auto text-white">
                <div class="row align-items-center d-flex flex-row">
                    <div class="col-lg-12">
                        <img src="{{ asset('default_assets/logo.png') }}" alt="logo" class="display-1 mb-0">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12 text-center mt-xl-2">
                        <a class="text-white font-weight-medium" href="{{route('login_screen')}}">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>
@endsection('error_content')