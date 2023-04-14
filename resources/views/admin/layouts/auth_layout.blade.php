@include('admin/layout_content/links/header_link')
<!-- footer -->
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        @if (Session::has('success'))
                        <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show mt-4" role="alert">
                            {{ Session::get('success') }}
                            <!-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button> -->
                        </div>
                        @elseif(Session::has('error'))
                        <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show mt-4" role="alert">
                            {{ Session::get('error') }}
                            <!-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button> -->
                        </div>
                        @endif
                        <div class="brand-logo">
                            <a href="{{url('/')}}">
                                <img src="{{ asset('default_assets/logo.png') }}" alt="logo">
                            </a>
                        </div>
                        <h4>Hello! let's get started</h4>
                        <h6 class="font-weight-light">Sign in to continue.</h6>

                        @yield('auth_content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer -->
@include('admin/layout_content/links/footer_link')
</body>

</html>