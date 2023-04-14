@extends('admin/layouts/auth_layout')
@section('auth_content')
<form class="pt-3" method="POST" action="{{route('resetpassword', $token)}}">
    @csrf
    <div class="form-group">
        <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Password" name="password">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Confirm Password" name="confirm_password">
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
            Reset
        </button>
    </div>
</form>

@endsection('auth_content')