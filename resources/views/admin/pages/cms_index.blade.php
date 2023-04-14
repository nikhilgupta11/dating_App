@extends('admin/layouts/home_layout')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
                            <h4 class="card-title">Content Pages</h4>
                        </div>
                        <div class="col-md-2">
                            <h5><button class="btn btn-primary"><a href="{{route('create_cms_screen')}}" class="text-decoration-none text-white">Create</a></button></h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $sr_no=>$data1)
                                <tr>
                                    <td>{{ $sr_no + 1 }}</td>
                                    <td>{{ $data1->name }}</td>
                                    <td>{{ $data1->slug }}</td>
                                    <td>
                                        @if($data1->status == 1)
                                        <label class="badge badge-success">Active</label>
                                        @else
                                        <label class="badge badge-danger">InActive</label>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('show_cms', $data1->id) }}" class="text-decoration-none px-2"><i class="ti-eye"></i></a>
                                        <a href="{{ route('edit_cms', $data1->id) }}" class="text-decoration-none px-2"><i class="ti-pencil"></i></a>
                                        <a href="{{ route('delete_cms', $data1->id) }}" class="text-decoration-none"><i class="ti-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')