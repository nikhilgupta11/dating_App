@extends('admin/layouts/auth_layout')
@section('auth_content')
<form class="pt-3" method="POST" action="{{route('forgotpass')}}">
    @csrf
    <div class="form-group">
        <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email" name="email">
    </div>
    <div class="mt-3">
        <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
            Reset
        </button>
    </div>
</form>

@endsection('auth_content')