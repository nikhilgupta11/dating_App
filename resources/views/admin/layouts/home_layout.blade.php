@include('admin/layout_content/links/header_link')
<!-- footer -->

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('admin/layout_content/content/navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-right.html -->
            @include('admin/layout_content/content/right_side_bar')
            <!-- partial -->
            <!-- partial:partials/_sidebar-left.html -->
            @include('admin/layout_content/content/left_side_bar')
            <!-- partial -->
            <div class="main-panel">
                @if (Session::has('success'))
                <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show mt-4 mx-4 " role="alert">
                    {{ Session::get('success') }}
                    <!-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button> -->
                </div>
                @elseif(Session::has('error'))
                <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show mt-4 mx-4" role="alert">
                    {{ Session::get('error') }}
                    <!-- <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button> -->
                </div>
                @endif
                <!-- content-wrapper -->
                @yield('content')
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('admin/layout_content/content/footer')
                <!-- partial -->
            </div>
        </div>
    </div>
    <!-- footer -->
    @include('admin/layout_content/links/footer_link')
</body>

</html>