@extends('admin/layouts/auth_layout')
@section('auth_content')
<form class="pt-3" method="POST" action="{{route('admin_login')}}">
    @csrf
    <div class="form-group">
        <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email">
    </div>
    <div class="form-group">
        <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
    </div>
    <div class="my-2 d-flex justify-content-between align-items-center">
        <div class="form-check">
            <label class="form-check-label text-muted">
                <input type="checkbox" class="form-check-input" name="remember">
                Keep me signed in
            </label>
        </div>
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
            Login
        </button>
    </div>
    <div class="my-2 d-flex justify-content-between align-items-center">
        <a href="{{route('forgot_pass_screen')}}" class="auth-link text-black">Forgot password?</a>
    </div>
</form>

@endsection('auth_content')