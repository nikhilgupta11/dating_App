@extends('admin/layouts/home_layout')
@section('content')
<div class="content-wrapper">
    @if($data != null)
    <form action="{{route('store_setting',$data->id)}}" method="POST">
        @else
        <form action="{{route('store_setting')}}" method="POST">
            @endif
            <div class="col-xl-12 col-md-12">
                <div class="card px-4 py-4">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="" class="form-label">Logo</label>
                            <input type="file" name="logo" class="form-control">
                            @if($data != null)
                            <img src="{{asset('assets/'.$data->logo)}}" alt="logo" class="logo_image">
                            @endif
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="" class="form-label">Banner</label>
                            <input type="file" name="banner" id="" class="form-control">
                            @if($data != null)
                            <img src="{{asset('assets/'.$data->banner)}}" alt="banner" class="logo_image">
                            @endif
                        </div>
                        <div class="col-md-2 mb-4">
                            <label for="" class="form-label">Default Currency</label>
                            @if($data != null)
                            <input type="text" class="form-control" name="deafult_currency" value="{{$data->deafult_currency}}">
                            @else
                            <input type="text" class="form-control" name="deafult_currency">
                            @endif
                        </div>
                        <div class="col-md-2 mb-4">
                            <label for="" class="form-label">Default Country Code</label>
                            @if($data != null)
                            <input type="text" class="form-control" name="deafult_country_code" value="{{$data->deafult_country_code}}">
                            @else
                            <input type="text" class="form-control" name="deafult_country_code">
                            @endif
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="" class="form-label">Company Name</label>
                            @if($data != null)
                            <input type="text" class="form-control" name="company_name" value="{{$data->company_name}}">
                            @else
                            <input type="text" class="form-control" name="company_name">
                            @endif
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="" class="form-label">SMTP Email</label>
                            @if($data != null)
                            <input type="text" class="form-control" name="smtp_mail" value="{{$data->smtp_mail}}">
                            @else
                            <input type="text" class="form-control" name="smtp_mail">
                            @endif
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="" class="form-label">SMTP Username</label>
                            @if($data != null)
                            <input type="text" class="form-control" name="smtp_username" value="{{$data->smtp_username}}">
                            @else
                            <input type="text" class="form-control" name="smtp_username">
                            @endif
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="" class="form-label">SMTP Password</label>
                            @if($data != null)
                            <input type="text" class="form-control" name="smtp_password" value="{{$data->smtp_password}}">
                            @else
                            <input type="text" class="form-control" name="smtp_password">
                            @endif
                        </div>
                        <div class="col-md-2 mb-4">
                            <label for="" class="form-label">SMTP Host</label>
                            @if($data != null)
                            <input type="text" class="form-control" name="smtp_host" value="{{$data->smtp_host}}">
                            @else
                            <input type="text" class="form-control" name="smtp_host">
                            @endif
                        </div>
                        <div class="col-md-2 mb-4">
                            <label for="" class="form-label">SMTP Port</label>
                            @if($data != null)
                            <input type="text" class="form-control" name="smtp_port" value="{{$data->smtp_port}}">
                            @else
                            <input type="text" class="form-control" name="smtp_port">
                            @endif
                        </div>

                        <div class="col-md-2 mb-4">
                            <label for="" class="form-label">SMTP Encryption Type</label>
                            @if($data != null)
                            <input type="text" class="form-control" name="smtp_encryption" value="{{$data->smtp_encryption}}">
                            @else
                            <input type="text" class="form-control" name="smtp_encryption">
                            @endif
                        </div>
                        <div class="col-md-2 mb-4">
                            <label for="" class="form-label">Language</label>
                            @if($data != null)
                            <input type="text" class="form-control" name="language" value="{{$data->language}}">
                            @else
                            <input type="text" class="form-control" name="language">
                            @endif
                        </div>
                        <div class="col-md-12">
                            @if($data != null)
                            <button class="btn btn-primary" type="submit">Update and Back</button>
                            @else
                            <button class="btn btn-primary" type="submit">Save and Back</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>

<style>
    .logo_image {
        margin-top: 10px;
        width: 150px;
        height: 100px;
    }
</style>
@endsection('content')