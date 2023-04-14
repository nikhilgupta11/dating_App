@extends('admin/layouts/home_layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Create content Page</h4>
                        </div>
                        <div class="col-md-2">
                            <h5><button class="btn btn-primary"><a href="{{route('cms_index')}}" class="text-decoration-none text-white">Back</a></button></h5>
                        </div>
                    </div>
                    <form action="{{ route('create_cms') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="" class="form-label">Name <span class="required danger">*</span></label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Slug <span class="required danger">*</span></label>
                                <input type="text" class="form-control" name="slug">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">Status</label>
                                <input type="checkbox" class="form-control form-check-Success checkbox_width" name="status">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="" class="form-label">Description</label>
                                <textarea class="ckeditor form-control" name="description"></textarea>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="" class="form-label">Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary">Save and Back</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')