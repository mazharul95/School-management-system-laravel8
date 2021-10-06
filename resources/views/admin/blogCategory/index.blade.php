@extends('admin.admin_master')
@push('style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
@endpush
@section('admin')
    <div class="main_content_iner overly_inner ">
        <div class="container-fluid p-0 ">
            <!-- page title  -->
            <div class="row">
                <div class="col-12">
                    <div class="page_title_box d-flex align-items-center justify-content-between">
                        <div class="page_title_left">
                            <ol class="breadcrumb page_bradcam mb-0">
                                <li class="breadcrumb-item active" style="font-size: 20px">Blog Category</li>
                            </ol>
                        </div>
                        <a href="{{route('blog-category.create')}}" class="white_btn3 btn btn-info">Create Blog Category</a>
                    </div>
                </div>
            </div>
        </div>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="card-header"> Blog Category </div>
                            <table id="example" class="table table-striped table-bordered" style="width:100%; padding: 2px">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($categorys as $index=>$category)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>
                                            @if($category->status == 'Active')
                                                <span class="badge badge-success" style="font-size:15px">{{$category->status}}</span>
                                            @else
                                                <span class="badge badge-danger">{{$category->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('blog-category.destroy',$category->id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <a href="{{route('blog-category.edit',$category->id)}}" class="btn btn-info">Edit</a>
                                                <button type="submit" class="btn btn-danger" name="Delete"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </tfoot>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('script')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
@endpush
