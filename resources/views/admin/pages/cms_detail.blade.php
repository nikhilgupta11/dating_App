@extends('admin/layouts/home_layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Detail</h4>
                        </div>
                        <div class="col-md-2">
                            <h5><button class="btn btn-primary"><a href="{{route('cms_index')}}" class="text-decoration-none text-white">Back</a></button></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="form-label">Name</label>
                            <div>
                                {{$data->name}}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="form-label">Slug</label>
                            <div>
                                {{$data->slug}}
                            </div>
                        </div>
                        @if(isset($data->title))
                        <div class="col-md-3">
                            <label for="" class="form-label">Title</label>
                            <div>
                                {{$data->title}}
                            </div>
                        </div>
                        @endif
                        <div class="col-md-3">
                            <label for="" class="form-label">Status</label>
                            <div>
                                @if($data->title == 1)
                                <label class="badge badge-success">Active</label>
                                @else
                                <label class="badge badge-danger">InActive</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="" class="form-label">Description</label>
                            <div>
                                {!! $data->description !!}
                            </div>
                        </div>
                        @if(isset($data->image))
                        <div class="col-md-3 mt-3">
                            <label for="" class="form-label">Image</label>
                            <div>
                                <img src="{{ asset('assets/'. $data->image) }}" alt="image">
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')