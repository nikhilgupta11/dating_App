@extends('admin/layouts/home_layout')
@section('content')
<div class="content-wrapper">
    <div class="col-xl-12 col-md-12">
        <div class="card px-4 py-4">
            <div class="row mb-4">
                <div class="col-md-10">
                    <h3>Setting's</h3>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary"><a href="{{ route('setting_update', $data->id) }}" class="text-white text-decoration-none">Edit</a></button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <label for="" class="form-label">Logo</label>
                    <div>
                        <img src="{{asset('assets/'.$data->logo)}}" alt="logo" class="logo_image">
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="" class="form-label">Banner</label>
                    <div>
                        <img src="{{asset('assets/'.$data->banner)}}" alt="banner" class="logo_image">
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="" class="form-label">Default Currency</label>
                    <div>
                        {{$data->deafult_currency}}
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="" class="form-label">Company Name</label>
                    <div>
                        {{$data->company_name}}
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="" class="form-label">Default Cuntry Code</label>
                    <div>
                        {{$data->deafult_country_code}}
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="" class="form-label">Language</label>
                    <div>
                        {{$data->language}}
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="" class="form-label">SMTP Email</label>
                    <div>
                        {{$data->smtp_mail}}
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="" class="form-label">SMTP Username</label>
                    <div>
                        {{$data->smtp_username}}
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="" class="form-label">SMTP Password</label>
                    <div>
                        {{$data->smtp_password}}
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="" class="form-label">SMTP Host</label>
                    <div>
                        {{$data->smtp_host}}
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <label for="" class="form-label">SMTP Port</label>
                    <div>
                        {{$data->smtp_port}}
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <label for="" class="form-label">SMTP Encryption Type</label>
                    <div>
                        {{$data->smtp_encryption}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .logo_image {
        width: 150px;
        height: 100px;
    }
</style>
@endsection('content')